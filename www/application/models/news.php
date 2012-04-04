<?php
//модель авторизации
 class Application_Models_News
  {	  
	  function AddNews($post)
	  {
		//print_r($post);
		//exit;
			$sql = "INSERT INTO `news` (`user_id`, `title`, `body`, `date`, `commnet`, `moderate`) VALUES ('".$_SESSION['user_id']."', '".$post['news_title']."', '".$post['news_body']."', '".date("m.d.Y g:i")."', '1', '1')";
			mysql_query($sql);	

			$news_id =  Lib_Proc::getInstance()->sql_last_insert_id ("SELECT LAST_INSERT_ID()");
			
			$sql = "INSERT INTO `news_user` (`news_id`, `user_id`, `user_name`) VALUES ('".$news_id."', '".$_SESSION['user_id']."', '".$_SESSION['user_name']."')";
			mysql_query($sql);
			
			//print_r($id_user); exit;
			$sql = "INSERT INTO `translation_news` (`news_id`,`translate_title`, `translate_body`) VALUES ('".$news_id."', '".$post['translate_title']."', '".$post['translate_body']."')" ;
			mysql_query($sql);

		return $msg;
	  }

	function GetNews($a=0, $b=CAUNT_NEWS_PAGES, $id = NULL, $ch = 'prev'){
			
			$sort = SORTNEWS;
			
			
			if (isset($_SESSION['lang'])){
				$lang = $_SESSION['lang'];			
			}
			
			
			if(!$id){
				if (isset($lang)){
				$sql = "select news_user.*, news.*, translation_news.translate_title, translation_news.translate_body
						from news, news_user, translation_news
							where 	news.news_id = news_user.news_id and
								news.news_id = translation_news.news_id and
								translation_news.lang = '$lang'
							order by news.news_id $sort LIMIT $a,$b";	
				}else{
				$sql = "select news_user.*, news.*, translation_news.translate_title, translation_news.translate_body
						from news, news_user, translation_news
							where 	news.news_id = news_user.news_id and
								news.news_id = translation_news.news_id
							order by news.news_id $sort LIMIT $a,$b";	
				}
				
			
			}else{
				$sql = "select news_user.*, news.*, translation_news.* from news,news_user, translation_news where news.news_id = news_user.news_id and news.news_id  = $id and translation_news.news_id = news.news_id";
			}

			
			$result = mysql_query($sql)  or die(mysql_error());

	
			while ($row = mysql_fetch_assoc($result))
				{	
					# transform text if cheched lang and not checked edit
					if (isset($lang) && $ch <> 'edit'){
						$row['title'] 	= $row['translate_title'];
						$row['body'] 	= $row['translate_body'];
					}

					# trim news body from priview
					if ($ch == 'prev'){ 
						$i = strripos(substr($row['body'], 0, COUNT_CHR_NEWS_PREVIEW), ' ');
						$row['body'] = substr($row['body'], 0, $i);
						$news[] = $row;
					}else{
						$news[] = $row;
					}
				}
			return $news; 
		}
	  
	function UpdateNews($post){
		//extract ($post);
		$sql = "UPDATE `news` SET `title`='".$post['news_title']."', `body`='".$post['news_body']."' WHERE `news_id`='".$post['news_id']."'";
		mysql_query($sql);
		
		if (isset($_SESSION['lang'])){
			$lang = $_SESSION['lang'];
			$sql = "UPDATE `translation_news` SET `translate_title`='".$post['translate_title']."', `translate_body`='".$post['translate_body']."' WHERE `news_id`='".$post['news_id']."' and `lang`='".$lang."'";

		}else{
			$sql = "UPDATE `translation_news` SET `translate_title`='".$post['translate_title']."', `translate_body`='".$post['translate_body']."' WHERE `news_id`='".$post['news_id']."'";
		}
		
		mysql_query($sql);
		return $msg;
	  }
	 
	function DelNews($value){
		$post = Lib_Proc::getInstance()->ClearArrayDate($value);
		$sql = "DELETE FROM `news` WHERE (`news_id`='".$value['delnewsid']."')";
		mysql_query($sql);	
	  }
  
  } 
?>  