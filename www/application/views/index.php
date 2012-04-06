<?
if (!empty($News))
{
foreach($News as $item)
		{
			?>
			<div class = "news_title"><a href="/news?newsid=<?=$item['news_id']?>"><?=$item['title']?></a></div>
			<div class = "news_body"><?=$item['body']?></div>
			<div class = "news_user_name"><?=t('Автор:')?><span><?=$item['user_name']?></span> <?=t('Опубліковано:')?> <span><?=$item['date']?></span>


<?if(Lib_Proc::getInstance()->_get_user_rights('edit',null,$item['news_id'])){?>


&nbsp;&nbsp;&nbsp;
<a href="/news?edit_news_id=<?=$item['news_id']?>">Edit:</a>&nbsp;&nbsp;&nbsp;||&nbsp;&nbsp;&nbsp;
<a href="/news?del_news_id=<?=$item['news_id']?>&amp;title=<?=$item['title']?>">Del:</a> <?}?>
</div>
			
<hr/>
<?}?>


<div class="link_navigation">
	<a href="/Index?n=<?= Lib_Proc::PrevionsPages()?>"><?=t('Попередні')?></a>&nbsp;&nbsp;&nbsp;&nbsp;||&nbsp;&nbsp;&nbsp;&nbsp;
<a href="/Index?n=<?= Lib_Proc::NextPages()?>"><?=t('Наступні')?></a>	
<?}else{?>
<a href="/Index?n=<?= Lib_Proc::PrevionsPages()?>"><?=t('Попередні')?></a></center>
</div>

<?}?>

</div>