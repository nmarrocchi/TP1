#pragma once

#include <QObject>
#include <qsqldatabase.h>
#include <QDebug>
#include <QtSql/QtSql>

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
};
