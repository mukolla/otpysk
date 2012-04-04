													<!--	форма попередження про стирання новини		 -->
<?if($delnewsid){?>

<?=t('Ви дійсно бажаєте видалити новину:')?> <b><?=$newstitle?></b>
<form method=post action="/news">
	<input type="hidden" name="delnewsid" value = "<?=$delnewsid?>">
	<input type="submit" name ="del_news_ok" value = "<?=t('Видалити')?>">
</form>
<form method=post action="/news">
	<input type="hidden" name="delnewsid" value = "<?$delnewsid?>">
	<input type="submit" name ="del_news_nou" value = "<?=t('Відмінити')?>">
</form>

<?exit;}?>

							<!-- виведення повного тексту новини -->
<?
if (!empty($viewnews))
{
foreach($viewnews as $item)
		{?>
			<div class = "news_title"><a href="/news?newsid=<?=$item['news_id']?>"><?=$item['title']?></a></div>
			<div class = "news_body"><?=$item['body']?></div>
			<div class = "news_user_name"><?=t('Автор:')?><span><?=$item['user_name']?></span> <?=t('Опубліковано:')?> <span><?=$item['date']?></span>				
			
				<?if(Lib_Proc::getInstance()->_get_user_rights('edit',$item['news_id']))
					{?>

						&nbsp;&nbsp;&nbsp;
						<a href="/news?edit_news_id=<?=$item['news_id']?>">Edit:</a>&nbsp;&nbsp;&nbsp;||&nbsp;&nbsp;&nbsp;
						<a href="/news?del_news_id=<?=$item['news_id']?>&amp;title=<?=$item['title']?>">Del:</a> 
					<?}?>
					<br/>
						<br/>
						<a href="<?=$backURL?>"><?=t('... повернутись Назад')?></a>
					<?
		}
}else{

								/* форма редагування, або додавання новини*/
if ($news){extract($news[0]); $button_name = 'edit_news_ok';}else{$button_name = 'add_news_ok';}?>

<div class="addnews">
<fieldset>
	<div class="addnews_lang_ua">
		<form class = "form_add_edit_news" method=post action="/news">
			<?=t('Заголовок на Українській мові:')?><br>
			<input class="title_add_edit_news" type="text" name="news_title" value="<?=$title?>"><br><br>
			<?=t('Текст новини на Українській мові:')?><br>
			<textarea class="body_add_edit_news" name="news_body" rows="16" cols="35"><?=$body?></textarea><br>
			<input type="hidden" name="news_id" value="<?=$news_id?>">
			<input type="submit" name="<?=$button_name?>" value = "<?=t('Зберегти')?>">
		</form>
	</div>

	<div class="addnews_lang_en">
		<form class = "form_add_edit_news" method=post action="/news">
			<?=t('Заголовок на Англійській мові:')?><br>
			<input class="title_add_edit_news" type="text" name="news_title" value="<?=$title?>"><br><br>
			<?=t('Текст новини на Англійській мові:')?><br>
			<textarea class="body_add_edit_news" name="news_body" rows="16" cols="35"><?=$body?></textarea><br>
			<input type="hidden" name="news_id" value="<?=$news_id?>">
			<input type="submit" name="<?=$button_name?>" value = "<?=t('Зберегти')?>">
		</form>
	</div>
</fieldset>
</div>



<?}?>