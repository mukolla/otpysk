<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> News</title>
<link rel="stylesheet" href="/template/style.css" type="text/css" />
</head>
<body>
	<div id="wrapper">
		<div id="header">
			<div class="logo">
				<a href="/" title = "Home"><img src="/images/logo.png" alt = "News, home Pages" /></a>
			</div>	
			<div class="menu">
				<?
				echo Lib_Menu::getInstance()->getMenu();
				?>
			</div>	

			<div class="menulang">
				<?
				echo Lib_Menu::getInstance()->getLangMenu();
				?>
			</div>	

			<div class="mlogin">
				<?
				echo Lib_Menu::getInstance()->menuLogin();
				?>
			</div>

			<div class="messages">
				<?
				echo Lib_Menu::getInstance()->messages();
				?>
			</div>
			
			
		</div>
		<div id="content">
		<hr/>
			
	