<div>

<?if ($deluser){?>
	<?=t('Ви дійсно бажаєте видалити Юзера?')?><br><a href="/admin?del_user_id=<?=$deluser?>"> <?=t('Так - Видалити!')?></a>&nbsp;&nbsp;||&nbsp;&nbsp;
	<a href="<?=$backURL?>"><?=t('Ні, повернутись Назад')?></a>
<?exit;
}?>

<?if ($msg){echo $msg; exit;}?>

<?if ($msgban){?>
	<?=t('Ви дійсно хочете забанити Юзера:')?> <?=$msgban?><br><a href="/admin?ban_user_id=<?=$user_id?>"> <?=t('Так - ЗАБАНИТИ!')?></a>&nbsp;&nbsp;||&nbsp;&nbsp;
	<a href="<?=$backURL?>"><?=t('Ні, повернутись Назад')?></a>
<?exit;
}?>

<?if ($msgnotban){?>
	<?=t('Ви не можете забанити самі СЕБЕ!')?><br><a href="<?=$backURL?>"><<--<?=t('Назад')?></a>
<?	exit;
}?>

<?
if (!$userdate && !$useredit &&!$userbaned)
{?>
<a href="/admin?checked=users"><?=t('Користувачі:')?></a>
<hr/>
<a href="/admin?checked=news"><?=t('Новини:')?></a>
<hr/>
<a href=""><?=t('Настройки сайту:')?></a>
<hr/>
<?};?>

<? // якщо в адмінці вибрано користувачі:
if ($userdate){
echo HELP_MSG_FOR_ADMIN."<hr/>";

foreach ($userdate as $user){?>

<table  class = "admin_table">
<tr>
	<td><a href="/admin?useredit=<?=$user['user_id']?>">Edit:</a></td>
	<td><a href="">Active:</a></td>
	<td><a href="/admin?ban=<?=$user['user_id']?>&amp;user_name=<?=$user['user_name']?>">Ban!</a></td>
	<td><a href="/admin?deluser=<?=$user['user_id']?>">Del</a></td>
</tr>
</table> 

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
<a href="/admin"><?=t('Назад')?></a>
<?}?>

<?if($useredit){echo HELP_MSG_FOR_ADMIN."<hr/>";?>

<a href="<?=$backURL?>"><?=t('Назад')?></a><br/><br/>

<div class="user_register">
<form method=post action="/admin" enctype="multipart/form-data">
<fieldset>
<label for="input_first_name"><?=t("Ім'я:")?></label><input type="text" name="first_name" value = "<?=$useredit['first_name']?>"><br/>
<label for="input_last_name"><?=t("Прізвище:")?></label><input type="text" name="last_name" value = "<?=$useredit['last_name']?>"><br/>
<label for="input_login"><?=t("Логин:")?></label><input type="text" name="user_name" value = "<?=$useredit['user_name']?>"><br/>
<label for="input_passw"><?=t("Пароль:")?></label><input type="text" name="pass" value = "<?=$useredit['pass']?>"><br/>
<label for="input_email"><?=t("E-mail:")?></label><input type="text" name="mail" value = "<?=$useredit['mail']?>"><br/>
<input type="hidden" name="user_id" value = "<?=$useredit['user_id']?>">
<label for="input_email"><?=t("Статус:")?></label><input type="text" name="user_status" value = "<?=$useredit['user_status']?>"><br/>
<label for="input_avatar"><?=t("Аватар:")?></label><input type="file" name="img_avatar"/><br/>
<input type="hidden" name="hidden_img_avatar" value="<?=$useredit['img_avatar']?>"><br/>

<input type="submit" name = "user_edit_ok" value = "<?=t('Зберегти')?>">
</fieldset>
</form>
</div>
<?}?>



