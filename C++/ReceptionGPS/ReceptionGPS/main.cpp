#include "database.h"
#include "Trame.h"
#include <QtCore/QCoreApplication>

int main(int argc, char *argv[])
{
    QCoreApplication a(argc, argv);
	Database db = new Database;
	db.connectToDB();
	Trame trame(&db);

    return a.exec();
}
