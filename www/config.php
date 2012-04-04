<?php
Error_Reporting(E_ALL & ~E_NOTICE);

 function __autoload ($class_name)
 {
    $path=str_replace("_", "/", $class_name);

   if (file_exists($path.".php")) {
     include_once($path .".php");//подключает php файл по полученному пути	
	}
	else{
	header("HTTP/1.0 404 Not Found");
	echo "К сожалению такой страницы не существует.";
	exit;
	}
 }
 //константи
 define('AVATAR_W', '150');
 define('AVATAR_H', '150');
 define('COUNT_CHR_NEWS_PREVIEW', '250');
 define('HELP_MSG_FOR_ADMIN', ' user status: 0 - admin; 1 - user; 2 - publicer; 4 - BANED user;');
 define('CAUNT_NEWS_PAGES', '3'); 	//кількість новин, що будуть відображатись на головній сторінці
 define('SORTNEWS', 'desc'); 	    //сортування новин, два типи: (asc|desc)
 define('HOST', 'localhost'); 		//сервер
 define('USER', 'root'); 			//пользователь
 define('PASSWORD', ''); 			//пароль
 define('NAME_BD', 'otpysk');		//база
 
 
 $connect = mysql_connect(HOST, USER, PASSWORD)or die("Невозможно установить соединение c базой данных".mysql_error( ));
 mysql_select_db(NAME_BD, $connect) or die ("Ошбка обращения к базе ".mysql_error());	
 mysql_query('SET names "utf8"');   //база устанавливаем кодировку данных в базе 
?>