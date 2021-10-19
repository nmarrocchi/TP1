#include "Trame.h"

Trame::Trame(Database * db, QObject *parent)
	: QObject(parent)
{
	//ajoute la connexion BDD a la classe 
	this->db = db;
	//Créer l'écoute au port 
	port = new QSerialPort(this);
	QObject::connect(port, SIGNAL(readyRead()), this, SLOT(onSerialPortReadyRead()));
	port->setPortName("COM1");
	port->open(QIODevice::ReadWrite);
	port->setBaudRate(QSerialPort::Baud4800);
	port->setDataBits(QSerialPort::DataBits::Data8);
	port->setParity(QSerialPort::Parity::NoParity);
	port->setStopBits(QSerialPort::StopBits::OneStop);
	port->setFlowControl(QSerialPort::NoFlowControl);
	qDebug() << "Port connecté";
}

Trame::~Trame()
{
}

void Trame::onSerialPortReadyRead() {
	//Récupère les chaines de caractères et les ajoutent entre elles jusqu'a ce qu'elles soient complètes
	QByteArray dataR = port->readAll();
	data = data + dataR.toStdString().c_str();
	//qDebug() << data;

	QRegExp regExp("\\$GPGGA(.+)(\\*)"); //\\$
	//qDebug() << regExp.indexIn(data);
	qDebug() << data.size();
	//Si la trame est complète ( correspond à l'expressiçon régulière )
	if (regExp.indexIn(data) > -1)
	{
		QStringList resData = regExp.capturedTexts();
		QString resDataTemp = resData[0];
		//Sépare la chaine de caractères en utilisant les virgules de la trame
		dataList = resDataTemp.split(QLatin1Char(','), Qt::SkipEmptyParts);
			
		//Si la trame est correcte on traite la trame
		if ( dataList[0] == "$GPGGA" ) {
			//La récupération du temps n'est plus utile car récupérer directement par une fonction SQL
			/*// Récuperation du temps
			QString time = dataList[1].toStdString().c_str();
			//Changement du format de chaine de caractères à un format d'affichage de l'heure
			QStringList ListTime = time.split(QLatin1Char('.'), Qt::SkipEmptyParts);
			QString timeWithoutColon = ListTime[0].toStdString().c_str();
			QTime timeWithColon = QTime::fromString(timeWithoutColon, "hhmmss");
			QString usableTime = timeWithColon.toString("hh:mm:ss");
			*/

			//Récuperation latitude N/S
			QString latitude = dataList[2].toUtf8();
			//Calcul pour transformer les chiffres représentant la latitude(chiffre décimal) en latitude utilisable(degrée)
			int latitudeDot = latitude.indexOf(".");
			latitude.insert(latitudeDot - 2, ",");
			QStringList latitudeSplit = latitude.split(",");
			//La partie entière du nombre 
			double latitudeIntegerDivide = latitudeSplit.at(1).toDouble() / 60;
			//La partie décimale du nombre
			double latitudeDecimalDivide = latitudeSplit.at(0).toDouble();
			double latitudeRes = latitudeIntegerDivide + latitudeDecimalDivide;

			//Si latitude Sud on rend celle-ci négative
			if (dataList[3] == 'S') {
				latitudeRes = latitudeRes * (-1);
			}

			//Récuperation longitude E/O
			QString longitude = dataList[4].toUtf8();
			//Calcul pour transformer les chiffres représentant la longitude(chiffre décimal) en longitude utilisable(degrée)
			int longitudeDot = longitude.indexOf(".");
			longitude.insert(longitudeDot - 2, ",");
			QStringList longitudeSplit = longitude.split(",");
			//La partie entière du nombre 
			double longitudeIntegerDivide = longitudeSplit.at(1).toDouble() / 60;
			//La partie décimale du nombre
			double longitudeDecimalDivide = longitudeSplit.at(0).toDouble();
			double longitudeRes = longitudeIntegerDivide + longitudeDecimalDivide;
			
			//Si longitude Ouest on rend celle-ci négative
			if (dataList[5] == 'O') {
				longitudeRes = longitudeRes * (-1);
			}
			//Insère en bdd les informations voulu et supprime les données des tableaux et la trame pour recevoir une nouvelle trame
			//qDebug() << dataList;
			// Du code sans risque.
			try
			{
				db->insertInDB(latitudeRes, longitudeRes);
				data.clear();
				dataList.clear();

				// Du code qui pourrait créer une erreur.
			}
			catch (int e) //On rattrape les entiers lancés (pour les entiers, une référencen'a pas de sens)
			{
				//On gère l'erreur
			}
		}else {
			//Supprime les données des tableaux et la trame si la trame recue est invalide pour recevoir une nouvelle trame
			data.clear();
			dataList.clear();
		}
	
	}

}