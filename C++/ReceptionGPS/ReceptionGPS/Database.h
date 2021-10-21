#pragma once

#include <QObject>
#include <qsqldatabase.h>
#include <QDebug>
#include <QtSql/QtSql>
#include <qmutex.h>
#include <qqueue.h>

class SQLWorker;

class SQLRequest
{
public:
	SQLRequest(double latitude, double longitude) {
		this->latitude = latitude;
		this->longitude = longitude;
	}

	double latitude;
	double longitude;
};

class Database : public QObject
{
	Q_OBJECT

public:
	Database(QObject *parent = Q_NULLPTR);
	~Database();
	void connectToDB();
	void insertInDB(double latitude, double longitude);
private:
	QSqlDatabase * db;
	QMutex mutex;
	QQueue<SQLRequest> queue;
	SQLWorker * workerThread;

	friend class SQLWorker;
};


class SQLWorker : public QThread
{
	Q_OBJECT

private:
	Database * db;

public:
	SQLWorker(Database * db)
		: QThread()
	{
		this->db = db;
	}

public slots:
	void run() override {
		QSqlDatabase database = QSqlDatabase::addDatabase("QMYSQL");
		database.setHostName("192.168.64.204");
		database.setDatabaseName("Lawrence");
		database.setUserName("admin");
		database.setPassword("admin");

		if (database.open())
		{
			qDebug() << "Connexion a la BDD reussie";
		}
		else {
			qDebug() << "Erreur de connexion a la BDD";
			exit(1);
		}
			
		while (1)
		{
			db->mutex.lock();
			if(db->queue.size() > 0)
			{
				SQLRequest request = db->queue.front();
				db->queue.pop_front();
				db->mutex.unlock();

				QSqlQuery req;
				bool success = false;
				qDebug() << request.latitude << request.longitude;
				if (req.prepare("INSERT INTO `pins` (`id`, `idBoat`, `longitude`, `latitude`) VALUES (NULL, 1, ?, ?);"))
				{
					req.addBindValue(request.longitude);
					req.addBindValue(request.latitude);

					if (req.exec())
					{
						qDebug() << "INSERTION REUSSIE";
						success = true;
					}
				}

				if(!success)
					qDebug() << "INSERTION PAS REUSSIE";
			}
			else
			{
				db->mutex.unlock();
			}
		}
	}

};