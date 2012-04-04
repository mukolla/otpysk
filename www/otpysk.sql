# HeidiSQL Dump 
#
# --------------------------------------------------------
# Host:                         127.0.0.1
# Database:                     otpysk
# Server version:               5.0.45-community-nt
# Server OS:                    Win32
# Target compatibility:         ANSI SQL
# HeidiSQL version:             4.0
# Date/time:                    2002-01-01 05:54:34
# --------------------------------------------------------

/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ANSI,NO_BACKSLASH_ESCAPES';*/
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;*/


#
# Database structure for database 'otpysk'
#

CREATE DATABASE /*!32312 IF NOT EXISTS*/ "otpysk" /*!40100 DEFAULT CHARACTER SET cp1251 */;

USE "otpysk";


#
# Table structure for table 'news'
#

CREATE TABLE /*!32312 IF NOT EXISTS*/ "news" (
  "news_id" int(10) unsigned NOT NULL auto_increment,
  "user_id" int(10) unsigned NOT NULL,
  "title" longtext NOT NULL,
  "body" longtext NOT NULL,
  "date" varchar(50) default NULL,
  "commnet" int(10) unsigned default NULL,
  "moderate" int(10) unsigned default NULL,
  PRIMARY KEY  ("news_id")
) AUTO_INCREMENT=28;



#
# Dumping data for table 'news'
#

LOCK TABLES "news" WRITE;
/*!40000 ALTER TABLE "news" DISABLE KEYS;*/
REPLACE INTO "news" ("news_id", "user_id", "title", "body", "date", "commnet", "moderate") VALUES
	('18','12','Назва','Любое число больше нуля воспринимается как множитель от размера шрифта текущего текста. Например, значение 1.5 устанавливает полуторный межстрочный интервал. В качестве значений принимаются также любые единицы длины, принятые в CSS — пикселы (px), дюймы (in), пункты (pt) и др. Разрешается использовать процентную запись, в этом случае за 100% берется высота шрифта.','January 1, 2002, 8:44 am','1','1');
REPLACE INTO "news" ("news_id", "user_id", "title", "body", "date", "commnet", "moderate") VALUES
	('3','12','12311','k1','2002-01-09 09:23:13','1','1');
REPLACE INTO "news" ("news_id", "user_id", "title", "body", "date", "commnet", "moderate") VALUES
	('4','12','Нова новина','тут нован новина!','0000-00-00 00:00:00','1','1');
REPLACE INTO "news" ("news_id", "user_id", "title", "body", "date", "commnet", "moderate") VALUES
	('5','12','знову новина','текст нової , дуже нової новини!','January 1, 2002, 10:22 am','1','1');
REPLACE INTO "news" ("news_id", "user_id", "title", "body", "date", "commnet", "moderate") VALUES
	('6','12','wer','werwer','January 1, 2002, 10:58 am','1','1');
REPLACE INTO "news" ("news_id", "user_id", "title", "body", "date", "commnet", "moderate") VALUES
	('7','12','werwerwer','werwerwerwe','January 1, 2002, 11:10 am','1','1');
REPLACE INTO "news" ("news_id", "user_id", "title", "body", "date", "commnet", "moderate") VALUES
	('23','10','Переадресація!','новина про переадресацію','03.22.2012 2:28','1','1');
REPLACE INTO "news" ("news_id", "user_id", "title", "body", "date", "commnet", "moderate") VALUES
	('10','0','','','January 1, 2002, 1:11 pm','1','1');
REPLACE INTO "news" ("news_id", "user_id", "title", "body", "date", "commnet", "moderate") VALUES
	('11','0','wer','werwerwer','January 1, 2002, 1:11 pm','1','1');
REPLACE INTO "news" ("news_id", "user_id", "title", "body", "date", "commnet", "moderate") VALUES
	('12','0','','','January 1, 2002, 1:12 pm','1','1');
REPLACE INTO "news" ("news_id", "user_id", "title", "body", "date", "commnet", "moderate") VALUES
	('13','0','sdf','sdf','January 1, 2002, 1:12 pm','1','1');
REPLACE INTO "news" ("news_id", "user_id", "title", "body", "date", "commnet", "moderate") VALUES
	('14','0','ха-ха','умц!','January 1, 2002, 1:13 pm','1','1');
REPLACE INTO "news" ("news_id", "user_id", "title", "body", "date", "commnet", "moderate") VALUES
	('15','0','супер-пупер новина!','тут буде нова новина <b>fds','January 1, 2002, 1:16 pm','1','1');
REPLACE INTO "news" ("news_id", "user_id", "title", "body", "date", "commnet", "moderate") VALUES
	('24','10','Вступление','PHP является мощным языком программирования и интерпретатором, взаимодействующим с веб-сервером как модуль либо как независимое бинарное CGI приложение. PHP способен обращаться к файлам, выполнять различные команды на сервере и открывать сетевые соединения. Именно поэтому все скрипты, исполняемые на сервере являются потенциально опасными. PHP изначально разрабатывался как более защищенный (относительно Perl, C) язык для написания CGI-приложений. При помощи ряда настроек во время компиляции, а также настроек во время работы приложения, вы всегда сможете найти подходящее сочетание свободы действий и безопасности.','03.22.2012 9:46','1','1');
REPLACE INTO "news" ("news_id", "user_id", "title", "body", "date", "commnet", "moderate") VALUES
	('20','12','qwe','Размеры области содержимого бокса - ширина содержимого и высота содержимого - зависят от нескольких факторов: имеет ли элемент, генерирующий бокс, установленные свойства ''width'' или ''height'', содержит ли бокс текст или другие боксы, является ли бокс таблицей и т.д. Ширина и высота бокса обсуждаются в главе','January 1, 2002, 11:00 am','1','1');
REPLACE INTO "news" ("news_id", "user_id", "title", "body", "date", "commnet", "moderate") VALUES
	('21','25','Дата в нормальному форматі вноситься в БД','Тепер в БД дата повинна вноситись в нормальному форматі!

string date ( string format [, int timestamp])


Возвращает время, отформатированное в соответствии с аргументом format, используя метку времени, заданную аргументом timestamp или текущее системное время, если timestamp не задан. Другими словами, timestamp является необязательным и по умолчанию равен значению, возвращаемому функцией time().','03.22.2012 12:52','1','1');
REPLACE INTO "news" ("news_id", "user_id", "title", "body", "date", "commnet", "moderate") VALUES
	('25','10','Функция apache_child_terminate()','Функция apache_child_terminate() регистрирует процесс Apache, обслуживающий текущий запрос PHP с тем, чтобы завершить его по окончании выполнения PHP скрипта. Эта функция может быть использована для завершения процесса, для работы которого понадобилось значительное количество оперативной памяти, не возвращенной операционной системе по завершении работы PHP скрипта.','03.22.2012 9:47','1','1');
/*!40000 ALTER TABLE "news" ENABLE KEYS;*/
UNLOCK TABLES;


#
# Table structure for table 'user'
#

CREATE TABLE /*!32312 IF NOT EXISTS*/ "user" (
  "user_id" int(10) unsigned NOT NULL auto_increment,
  "user_name" varchar(60) NOT NULL,
  "pass" varchar(60) NOT NULL default '',
  "mail" varchar(64) default NULL,
  "user_status" tinyint(3) unsigned default '1',
  PRIMARY KEY  ("user_id")
) AUTO_INCREMENT=47;



#
# Dumping data for table 'user'
#

LOCK TABLES "user" WRITE;
/*!40000 ALTER TABLE "user" DISABLE KEYS;*/
REPLACE INTO "user" ("user_id", "user_name", "pass", "mail", "user_status") VALUES
	('12','spam','qwerty','spam@mail.ru',1);
REPLACE INTO "user" ("user_id", "user_name", "pass", "mail", "user_status") VALUES
	('11','spamdiger','sddsf','spamdiger@mail.ru',1);
REPLACE INTO "user" ("user_id", "user_name", "pass", "mail", "user_status") VALUES
	('10','mukolla','emigrant','mukolla@gmail.com',1);
REPLACE INTO "user" ("user_id", "user_name", "pass", "mail", "user_status") VALUES
	('13','spamdiger','emigrant','spamdiger@yandex.ru',1);
REPLACE INTO "user" ("user_id", "user_name", "pass", "mail", "user_status") VALUES
	('14','asdad','jkhk','asdfafsdf@af.ru',1);
REPLACE INTO "user" ("user_id", "user_name", "pass", "mail", "user_status") VALUES
	('15','kjkljlkj','jhyuut','hghf@jhhhjh.ru',1);
REPLACE INTO "user" ("user_id", "user_name", "pass", "mail", "user_status") VALUES
	('16','adad',';lkkkjh','asdasd@sdf.ru',1);
REPLACE INTO "user" ("user_id", "user_name", "pass", "mail", "user_status") VALUES
	('17','sdfsf','pj','sdf@sf.ru',1);
REPLACE INTO "user" ("user_id", "user_name", "pass", "mail", "user_status") VALUES
	('18','asdad','ki','ad@asd.ru',1);
REPLACE INTO "user" ("user_id", "user_name", "pass", "mail", "user_status") VALUES
	('19','nikolay','kjl','sefs@gmail.ro',1);
REPLACE INTO "user" ("user_id", "user_name", "pass", "mail", "user_status") VALUES
	('20','nikolay','kjl','sefs@gmail.ro',1);
REPLACE INTO "user" ("user_id", "user_name", "pass", "mail", "user_status") VALUES
	('21','nikolay','kjl','sefs@gmail.ro',1);
REPLACE INTO "user" ("user_id", "user_name", "pass", "mail", "user_status") VALUES
	('22','igor','j','igor@mail.ri',1);
REPLACE INTO "user" ("user_id", "user_name", "pass", "mail", "user_status") VALUES
	('23','digger','1','digger@yandex.ru',1);
REPLACE INTO "user" ("user_id", "user_name", "pass", "mail", "user_status") VALUES
	('24','asda','wer','asdasdad@gmail.com',1);
REPLACE INTO "user" ("user_id", "user_name", "pass", "mail", "user_status") VALUES
	('25','news24','1','news24@mail.ru',1);
REPLACE INTO "user" ("user_id", "user_name", "pass", "mail", "user_status") VALUES
	('26','as','k','asas@asd.ri',1);
REPLACE INTO "user" ("user_id", "user_name", "pass", "mail", "user_status") VALUES
	('27','new','1','new@mail.eru',1);
REPLACE INTO "user" ("user_id", "user_name", "pass", "mail", "user_status") VALUES
	('28','as','jkj','asa@sd.ru',1);
REPLACE INTO "user" ("user_id", "user_name", "pass", "mail", "user_status") VALUES
	('29','asd','kj','asda@sdf.ru',1);
REPLACE INTO "user" ("user_id", "user_name", "pass", "mail", "user_status") VALUES
	('30','asd','kj','asda@sdf.ru',1);
REPLACE INTO "user" ("user_id", "user_name", "pass", "mail", "user_status") VALUES
	('31','asd','k','asd@afds.ri',1);
REPLACE INTO "user" ("user_id", "user_name", "pass", "mail", "user_status") VALUES
	('32','qw','lj','qwqw@adsf.ru',1);
REPLACE INTO "user" ("user_id", "user_name", "pass", "mail", "user_status") VALUES
	('33','asd','n','asd@sdaf.ru',1);
REPLACE INTO "user" ("user_id", "user_name", "pass", "mail", "user_status") VALUES
	('34','asdasd','kkk','asdsad@dsaf.ru',1);
REPLACE INTO "user" ("user_id", "user_name", "pass", "mail", "user_status") VALUES
	('35','asdasd','jk','asdasd@sdf.ru',1);
REPLACE INTO "user" ("user_id", "user_name", "pass", "mail", "user_status") VALUES
	('36','qwerty','qwerty','qwerty@df.ru',1);
REPLACE INTO "user" ("user_id", "user_name", "pass", "mail", "user_status") VALUES
	('37','qwerty','qwerty','qwerty@df.ru',1);
REPLACE INTO "user" ("user_id", "user_name", "pass", "mail", "user_status") VALUES
	('38','qwerty','qwerty','qwerty@df.ru',1);
REPLACE INTO "user" ("user_id", "user_name", "pass", "mail", "user_status") VALUES
	('39','my','1','my@my.ru',1);
REPLACE INTO "user" ("user_id", "user_name", "pass", "mail", "user_status") VALUES
	('40','ld','1','ld@sdf.eu',1);
REPLACE INTO "user" ("user_id", "user_name", "pass", "mail", "user_status") VALUES
	('41','asdfsdfsdfsdfsdfsdfsdfsdsfsf','jkk','asdasd@asdf.ru',1);
REPLACE INTO "user" ("user_id", "user_name", "pass", "mail", "user_status") VALUES
	('42','qw','k','qwe@df.ru',1);
REPLACE INTO "user" ("user_id", "user_name", "pass", "mail", "user_status") VALUES
	('43','y','1','y@jk.ru',1);
REPLACE INTO "user" ("user_id", "user_name", "pass", "mail", "user_status") VALUES
	('44','yy','1','yy@mail.ru',1);
REPLACE INTO "user" ("user_id", "user_name", "pass", "mail", "user_status") VALUES
	('45','one','one','one@gmail.ri',1);
REPLACE INTO "user" ("user_id", "user_name", "pass", "mail", "user_status") VALUES
	('46','tru','tru','tru@jkjhf.ru',1);
/*!40000 ALTER TABLE "user" ENABLE KEYS;*/
UNLOCK TABLES;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE;*/
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;*/
