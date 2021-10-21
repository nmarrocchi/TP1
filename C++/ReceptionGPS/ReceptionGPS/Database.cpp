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
	workerThread = new SQLWorker(this);
	workerThread->start();
}
//Insertion des infos nécessaires de la trame dans la BDD ( longitude, latitude )
void Database::insertInDB(double latitude, double longitude)
{
	mutex.lock();
	queue.push_back(SQLRequest(latitude, longitude));
	mutex.unlock();
}


