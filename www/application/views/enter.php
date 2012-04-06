<?if ($deluser){?>
	<?=t('Ви дійсно бажаєте видалити свій профіль з сайту?')?><br><a href="/enter?del_user_id=<?=$deluser?>"> <?=t('Так - Видалити!')?></a>&nbsp;&nbsp;||&nbsp;&nbsp;
	<a href="<?=$backURL?>"><?=t('Ні, повернутись Назад')?></a>
<?exit;
}?>


<?
if (!$_SESSION['user_name']){
	if ($loginusererror){?>
		<div class="msg_content_red">
		<span><?=t('Реєстраційні данні введені не вірно!')?></span>
		</div>
	<?}
}else{
	if(!isset($onlyuser)) 
{?>				<!-- $onlyuser у випадку якщо, прийшли з сторінки коментів і дивляться профіль  -->

<a href="/enter?out=1"><?=t("Змінити користувача:")?></a>&nbsp;&nbsp;&nbsp;||&nbsp;&nbsp;&nbsp;
<a href="/admin?useredit=<?=$_SESSION['user_id']?>"><?=t("Редагувати дані користувача:")?></a>&nbsp;&nbsp;&nbsp;||&nbsp;&nbsp;&nbsp;
<a href="/enter?deluser=<?=$_SESSION['user_id']?>"><?=t("Видалити профіль з сайту:")?></a>

<?}?>
<br/>
<br/>
<!-- показуєм дані користувача -->
<div class = "admin_user_edit">
<fieldset>
<?foreach ($user as $key=>$value){?>
<?if ($key == 'img_avatar'){?>
<img src="/images/smile_<?=$value?>" alt="<?=$value?>"/>
<?}?>
<label><?=$key?></label><span><?=$value?></span><br/>
<?}?>
</fieldset>
</div>

<br/>

<?}?>
<div class="msg_content_red">
<span><?=$msg_user_add?></span>
</div>

<br/><hr/>
<div class="msg_content">
<span><?=t("Реєстрація нового користувача:")?></span>
</div>

<div class="user_register">
<form method="post" action="/enter" enctype="multipart/form-data">
<fieldset>
	<label for="input_first_name"><?=t("Ім'я:")?></label><input id="input_first_name" type="text" name="first_name"/>	<br/>
	<label for="input_last_name"><?=t("Прізвище:")?></label><input id="input_last_name" type="text" name="last_name"/><br/>
	<label for="input_login"><?=t("Логин:")?></label><input id="input_login" type="text" name="username"/>
	<span> max lenght - 12</span>
	<br/>
	<label for="input_email"><?=t("E-mail:")?></label><input id="input_email" type="text" name="email"/>
	<span> max lenght - 30, example: ivan_taburetkin@mail.com</span>
	<br/>
	<label for="input_passw"><?=t("Пароль:")?></label><input id="input_passw" type="password" name="password"/>
	<span> max lenght - 20</span>
	<br/>
	<label for="input_avatar"><?=t("Аватар:")?></label><input id="input_avatar" type="file" name="img_avatar"/>
	<span> only JPG file</span>
	<br/>
	<label for="repeat_password"><?=t("Повторіть пароль:")?></label><input id="repeat_password"  type="password" name="repassword"/><br/>
	<input type="hidden" name="adduser" value = "ok" />
	<label for="input_avatar">&nbsp;</label>
	<input type="submit" value = "Зареєструватися!"/>
</fieldset>
</form>
</div>