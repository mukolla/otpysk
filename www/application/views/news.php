<? if ($date_rating) {extract($date_rating);} ?>

<? if($del_comment_id){?>

<?=t('Ви дійсно бажаєте видалити коментар:')?>
<form method=post action="/news">
	<input type="hidden" name="del_comment_id" value = "<?=$del_comment_id?>">
	<input type="submit" name ="del_comment_ok" value = "<?=t('Видалити')?>">
</form>
<form method=post action="/news">
	<input type="hidden" name="del_comment_id" value = "<?$del_comment_id?>">
	<input type="submit" name ="del_comment_nou" value = "<?=t('Відмінити')?>">
</form>

<?exit;}?>




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
	<br/>
		<a href="<?=$backURL?>"><?=t('... повернутись Назад')?></a>
	<br/>
	<div class = "news_title"><a href="/news?newsid=<?=$item['news_id']?>"><?=$item['title']?></a></div>
	<div class = "news_body"><?=$item['body']?></div>
	<div class = "news_user_name"><?=t('Автор:')?><span><?=$item['user_name']?></span> <?=t('Опубліковано:')?>
	<span><?=$item['date']?></span> <label> Оцінка новини: </label><span><?=$ratio?></span> 

		<? if(Lib_Proc::getInstance()->_get_user_rights('edit',null,$item['news_id']))
			{?>
				&nbsp;&nbsp;&nbsp;
				<a href="/news?edit_news_id=<?=$item['news_id']?>">Edit:</a>&nbsp;&nbsp;&nbsp;||&nbsp;&nbsp;&nbsp;
				<a href="/news?del_news_id=<?=$item['news_id']?>&amp;title=<?=$item['title']?>">Del:</a> 
		<?}?>

			
			<? if (!$unvisible_form){?>
				<br/><br/>
				<form action="/news" method="post">
				<input type="hidden" name="news_id" value="<?=$item['news_id']?>">
				<input type="radio" name="rating_value" value="1" checked>1 бал
				<input type="radio" name="rating_value" value="2">2 бали
				<input type="radio" name="rating_value" value="3">3 бали
				<input type="submit" value="Голосувати" name = "rating_add_ok">
				</form>
			<?}?>

			<br /> <br />
			<div class="comment">
			
			<?
			if ($news_comment){?>
				<fieldset class = "block_comment">
				<? 
					foreach ($news_comment as $comment){
					
						echo "<A HREF=\"/enter?user_id=".$comment['user_id']."\">".$comment['user_name']."</A>";
						if (Lib_Proc::getInstance()->_get_user_rights($rights='edit',true,$comment['comment_id'])){
						
							echo "<label class =\"probel\"></label>
							<A HREF=\"/news?del_comment_id=".$comment['comment_id']."\">Del</A>   ||   "."
									  <A HREF=\"/news?edit_comment_id=".$comment['comment_id']."\">Edit</A> <br/>";
						}else{
							echo"<br/>";
						}
					
						echo "<span class=\"comment_subject\">".$comment['comment_subject']."</span>"."<br/>";
						
						echo "<span class=\"comment_body\">".$comment['comment_body']."</span>"."<br/>";
						
						echo "<hr>";
					}
				?>
			<?}?>

			</fieldset>
			<?
				if ($edit_comment){
					extract($edit_comment[0]);
					$button_name = 'update_comment';
					$button_value = 'Update comment';
				}else{
					$button_name = 'add_comment';
					$button_value = 'Add comment';
				}
			?>
			
			<fieldset>
				add comment:
				<form class = "form_comment" method=post action="/news">
				<input TYPE="text" NAME="comment_subject" value = "<?=$comment_subject?>" /> <br /> 
				<textarea NAME="comment_body" ROWS="5" COLS=""><?=$comment_body?></textarea> <br />
				<input TYPE="hidden" NAME="news_id" value="<?=$item['news_id']?>">
				<input TYPE="hidden" NAME="comment_id" value="<?=$comment_id?>">
				<input TYPE="submit" value = "<?=$button_value?>" name = "<?=$button_name?>">
				</form>
			</fieldset>
			
			</div>
				
			<?
	}
}else{

								/* форма редагування, або додавання новини*/
if ($news){extract($news[0]); $button_name = 'edit_news_ok';}else{$button_name = 'add_news_ok';}?>

<?
if ($reedit_news){
	extract($reedit_news);
	$button_name = 'add_news_ok';
	
	echo $empty_in;
	}
?>

<div class="addnews">
<fieldset>
	<div class="addnews_lang_ua">
		<form class = "form_add_edit_news" method=post action="/news">
			<?=t('Заголовок на Українській мові:')?><br>
			<input class="title_add_edit_news" type="text" name="news_title" value="<?=$title?>"><br><br>
			<?=t('Текст новини на Українській мові:')?><br>
			<textarea class="body_add_edit_news" name="news_body" rows="16" cols="35"><?=$body?></textarea><br>
			<input type="hidden" name="news_id" value="<?=$news_id?>">
			
			
			<div class="addnews_lang_en">
				<?=t('Заголовок на Англійській мові:')?><br>
				<input class="title_add_edit_news" type="text" name="translate_title" value="<?=$translate_title?>"><br><br>
				<?=t('Текст новини на Англійській мові:')?><br>
				<textarea class="body_add_edit_news" name="translate_body" rows="16" cols="35"><?=$translate_body?></textarea><br>
			</div>
			
		<center><input type="submit" name="<?=$button_name?>" value = "<?=t('Зберегти')?>"></center>
			
		</form>
	</div>

	
</fieldset>
</div>


<?}?>