<?
function t($string){

#######################################################################
################### File Laguages Library #############################
#######################################################################
##					$ru['Hello'] = 'Привет';
##					$lib ['ru'] = $ru;
##
## 
#######################################################################

#.\application\lib\menu.php
$en['Ви забаненні!'] = 'Your is Banned!';

#.\application\views\admin.php
$en['Ви дійсно хочете забанити Юзера:'] = 'Yu serios Baned User: ';
$en['Користувачі:'] = 'Users:';
$en['Новини:'] = 'News:';
$en['Настройки сайту:'] = 'Site settings:';
$en['Так - ЗАБАНИТИ!'] = 'Yes, Baned!';
$en['НІ, повернутись НАЗАД'] = 'No, go Back';
$en['Ви не можете забанити самі СЕБЕ!'] = 'You do not can baned itself!';
$en['Назад'] = 'Back';
$en['Ні, повернутись Назад'] = 'Nou, go Back';
$en['Зберегти'] = 'Save';


#.\application\views\adduser.php
$en["Ім'я:"] = 'Name:';
$en['E-mail'] = 'E-mail';
$en['Пароль:'] = 'Password:';

#.\application\views\enter.php
$en["Змінити користувача:"] = 'Сhange User:';
$en["Редагувати дані користувача:"] = 'Edit user date:';
$en["Видалити профіль з сайту:"] = 'Deleted user profile:';
$en['Реєстрація нового користувача:'] = 'Add new User';
$en["Логин:"] = 'Login:';
$en["E-mail:"] = 'E-mail:';
$en["Аватар:"] = 'Avatar:';
$en['Повторіть пароль:'] = 'Repeat password';
$en["Ім'я:"] = 'First Name:';
$en["Прізвище:"] = 'Last Name:';
$en["Ви дійсно бажаєте видалити свій профіль з сайту?"] = 'Your actual intent deleted user profile?';


#.\application\views\index.php
$en['Автор:'] = 'Author:';
$en['Опубліковано:'] = 'Publiced';
$en['Edit:'] = 'Edit:';
$en['Del:'] = 'Del:';
$en['Попередні'] = 'Previons';
$en['Наступні'] = 'Next';
$en['Попередні'] = 'Previons';

#.\application\views\news.php
$en['Ви дійсно бажаєте видалити новину:'] = 'Delete this News?';
$en['Видалити'] = 'Deleted';
$en['Відмінити'] = 'Cancel';
$en['Зберегти'] = 'Save';
$en['Заголовок:'] = 'Title news:';
$en['Текст новини:'] = 'Body news:';

#.\application\models\auth.php
$en['Реєстраційні дані введені вірно!'] = '';
$en['Реєстраційні дані введені не вірно'] = '';

$lib ['en'] = $en;
#######################################################################
#######################################################################


	if (isset($lib[$_SESSION['lang']])) {
		return strtr($string,$lib[$_SESSION['lang']]);
	}else{
return $string;
	}
}

?>