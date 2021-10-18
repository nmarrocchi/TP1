#include "Database.h"

Database::Database(QObject *parent)
	: QObject(parent)
{
}

Database::~Database()
{
}
//Connexion a la BDD
void Database::connectToDB()
{
	QSqlDatabase db = QSqlDatabase::addDatabase("QMYSQL");
	db.setHostName("192.168.64.204");
	db.setDatabaseName("tp1");
	db.setUserName("admin");
	db.setPassword("admin");

	if (db.open())
	{
		qDebug() << "Connexion a la BDD reussie";
	}
	else {
		qDebug() << "Erreur de connexion a la BDD";
		exit(1);
	}
}
//Insertion des infos nécessaires de la trame dans la BDD ( date, longitude, latitude )
void Database::insertInDB(QString time, double latitude, double longitude)
{
	QSqlQuery request;
	request.prepare("INSERT INTO `GPS` (`ID`, `heureTrame`, `Latitude`, `Longitude`) VALUES (NULL, ?, ?, ?);");
	request.addBindValue(time);
	request.addBindValue(latitude);
	request.addBindValue(longitude);

	request.exec();
	qDebug() << "INSERTION REUSSIE";
}


