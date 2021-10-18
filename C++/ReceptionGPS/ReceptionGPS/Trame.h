#pragma once

#include <QObject>
#include <QSerialPort>
#include <qdebug.h>
#include <QRegExp>
#include "Database.h"

class Trame : public QObject
{
	Q_OBJECT

public:
	Trame(Database * db, QObject *parent = Q_NULLPTR);
	~Trame();

public slots:
	void onSerialPortReadyRead();
private:

	QSerialPort * port;
	QString data;
	QStringList dataList;
	Database * db;
};
