#include "Trame.h"

Trame::Trame(Database * db, QObject *parent)
	: QObject(parent)
{
	//ajoute la connexion BDD a la classe 
	this->db = db;
	//Cr�er l'�coute au port 
	port = new QSerialPort(this);
	QObject::connect(port, SIGNAL(readyRead()), this, SLOT(onSerialPortReadyRead()));
	port->setPortName("COM1");
	port->open(QIODevice::ReadWrite);
	port->setBaudRate(QSerialPort::Baud4800);
	port->setDataBits(QSerialPort::DataBits::Data8);
	port->setParity(QSerialPort::Parity::NoParity);
	port->setStopBits(QSerialPort::StopBits::OneStop);
	port->setFlowControl(QSerialPort::NoFlowControl);
	qDebug() << "Port connect�";
}

Trame::~Trame()
{
}

void Trame::onSerialPortReadyRead() {
	//R�cup�re les chaines de caract�res et les ajoutent entre elles jusqu'a ce qu'elles soient compl�tes
	QByteArray dataR = port->readAll();
	data = data + dataR.toStdString().c_str();
	//qDebug() << data;

	QRegExp regExp("\\$GPGGA(.+)(\\*)"); //\\$
	//qDebug() << regExp.indexIn(data);
	qDebug() << data.size();
	//Si la trame est compl�te ( correspond � l'expressi�on r�guli�re )
	if (regExp.indexIn(data) > -1)
	{
		QStringList resData = regExp.capturedTexts();
		QString resDataTemp = resData[0];
		//S�pare la chaine de caract�res en utilisant les virgules de la trame
		dataList = resDataTemp.split(QLatin1Char(','), Qt::SkipEmptyParts);
			
		//Si la trame est correcte on traite la trame
		if ( dataList[0] == "$GPGGA" ) {
			//La r�cup�ration du temps n'est plus utile car r�cup�rer directement par une fonction SQL
			/*// R�cuperation du temps
			QString time = dataList[1].toStdString().c_str();
			//Changement du format de chaine de caract�res � un format d'affichage de l'heure
			QStringList ListTime = time.split(QLatin1Char('.'), Qt::SkipEmptyParts);
			QString timeWithoutColon = ListTime[0].toStdString().c_str();
			QTime timeWithColon = QTime::fromString(timeWithoutColon, "hhmmss");
			QString usableTime = timeWithColon.toString("hh:mm:ss");
			*/

			//R�cuperation latitude N/S
			QString latitude = dataList[2].toUtf8();
			//Calcul pour transformer les chiffres repr�sentant la latitude(chiffre d�cimal) en latitude utilisable(degr�e)
			int latitudeDot = latitude.indexOf(".");
			latitude.insert(latitudeDot - 2, ",");
			QStringList latitudeSplit = latitude.split(",");
			//La partie enti�re du nombre 
			double latitudeIntegerDivide = latitudeSplit.at(1).toDouble() / 60;
			//La partie d�cimale du nombre
			double latitudeDecimalDivide = latitudeSplit.at(0).toDouble();
			double latitudeRes = latitudeIntegerDivide + latitudeDecimalDivide;

			//Si latitude Sud on rend celle-ci n�gative
			if (dataList[3] == 'S') {
				latitudeRes = latitudeRes * (-1);
			}

			//R�cuperation longitude E/O
			QString longitude = dataList[4].toUtf8();
			//Calcul pour transformer les chiffres repr�sentant la longitude(chiffre d�cimal) en longitude utilisable(degr�e)
			int longitudeDot = longitude.indexOf(".");
			longitude.insert(longitudeDot - 2, ",");
			QStringList longitudeSplit = longitude.split(",");
			//La partie enti�re du nombre 
			double longitudeIntegerDivide = longitudeSplit.at(1).toDouble() / 60;
			//La partie d�cimale du nombre
			double longitudeDecimalDivide = longitudeSplit.at(0).toDouble();
			double longitudeRes = longitudeIntegerDivide + longitudeDecimalDivide;
			
			//Si longitude Ouest on rend celle-ci n�gative
			if (dataList[5] == 'O') {
				longitudeRes = longitudeRes * (-1);
			}
			//Ins�re en bdd les informations voulu et supprime les donn�es des tableaux et la trame pour recevoir une nouvelle trame
			//qDebug() << dataList;
			// Du code sans risque.
			try
			{
				db->insertInDB(latitudeRes, longitudeRes);
				data.clear();
				dataList.clear();

				// Du code qui pourrait cr�er une erreur.
			}
			catch (int e) //On rattrape les entiers lanc�s (pour les entiers, une r�f�rencen'a pas de sens)
			{
				//On g�re l'erreur
			}
		}else {
			//Supprime les donn�es des tableaux et la trame si la trame recue est invalide pour recevoir une nouvelle trame
			data.clear();
			dataList.clear();
		}
	
	}

}