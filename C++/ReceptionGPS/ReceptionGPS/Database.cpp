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
	db.setDatabaseName("Lawrence");
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
//Insertion des infos nécessaires de la trame dans la BDD ( longitude, latitude )
void Database::insertInDB(double latitude, double longitude)
{
	QSqlQuery request;
	request.prepare("INSERT INTO `pins` (`id`, `idBoat`, `longitude`, `latitude`) VALUES (NULL, 1, ?, ?);");
	request.addBindValue(longitude);
	request.addBindValue(latitude);

	request.exec();
	qDebug() << "INSERTION REUSSIE";
}


