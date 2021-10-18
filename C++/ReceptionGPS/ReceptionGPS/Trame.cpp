#include "Trame.h"

Trame::Trame(Database * db, QObject *parent)
	: QObject(parent)
{
	this->db = db;
	port = new QSerialPort(this);
	QObject::connect(port, SIGNAL(readyRead()), this, SLOT(onSerialPortReadyRead()));
	port->setPortName("COM1");
	port->open(QIODevice::ReadWrite);
	port->setBaudRate(QSerialPort::Baud9600);
	port->setDataBits(QSerialPort::DataBits::Data8);
	port->setParity(QSerialPort::Parity::NoParity);
	port->setStopBits(QSerialPort::StopBits::OneStop);
	port->setFlowControl(QSerialPort::NoFlowControl);
	qDebug() << "ok";
}

Trame::~Trame()
{
}

void Trame::onSerialPortReadyRead() {

	QByteArray dataR = port->readAll();
	data = data + dataR.toStdString().c_str();
	qDebug() << data;

	QRegExp regExp("(.+)*0E");//\\$
	qDebug() << regExp.indexIn(data);

	if (regExp.indexIn(data) > -1)
	{
		dataList = data.split(QLatin1Char(','), Qt::SkipEmptyParts);
		qDebug() << dataList[0] << dataList[11];

		if ( (dataList[0] == "GPGGA") && (dataList[11] == "0000*0E") ) {
			
			// Récuperation du temps
			QString time = dataList[1].toStdString().c_str();
			QStringList ListTime = time.split(QLatin1Char('.'), Qt::SkipEmptyParts);
			QString timeWithoutColon = ListTime[0].toStdString().c_str();
			QTime timeWithColon = QTime::fromString(timeWithoutColon, "hhmmss");
			QString usableTime = timeWithColon.toString("hh:mm:ss");

			//Récuperation latitude N/S
			QString latitude = dataList[2].toUtf8();
			int latitudeDot = latitude.indexOf(".");
			latitude.insert(latitudeDot - 2, ",");
			QStringList latitudeSplit = latitude.split(",");
			//Le nombre avant la virgule de la latitude
			double latitudeIntegerDivide = latitudeSplit.at(1).toDouble() / 60;
			//Le nombre après la virgule de la latitude
			double latitudeDecimalDivide = latitudeSplit.at(0).toDouble();
			double latitudeRes = latitudeIntegerDivide + latitudeDecimalDivide;

			//Si latitude négative
			if (dataList[3] == 'S') {
				latitudeRes = latitudeRes * (-1);
			}

			//Récuperation longitude E/O
			QString longitude = dataList[4].toUtf8();
			int longitudeDot = longitude.indexOf(".");
			longitude.insert(longitudeDot - 2, ",");
			QStringList longitudeSplit = longitude.split(",");
			//Le nombre avant la virgule de la longitude
			double longitudeIntegerDivide = longitudeSplit.at(1).toDouble() / 60;
			//Le nombre après la virgule de la longitude
			double longitudeDecimalDivide = longitudeSplit.at(0).toDouble();
			double longitudeRes = longitudeIntegerDivide + longitudeDecimalDivide;
			
			//Si longitude négative
			if (dataList[5] == 'O') {
				longitudeRes = longitudeRes * (-1);
			}

			db->insertInDB(usableTime, latitudeRes, longitudeRes);
			data.clear();
			dataList.clear();

		}else {
			data.clear();
			dataList.clear();
		}
	
	}

}