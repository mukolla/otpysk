<?php
//модель авторизации
 class Application_Models_News
  {	  
	  function AddNews($value)
	  {
		$post = Lib_Proc::getInstance()->ClearArrayDate($value);
		
			$sql = "INSERT INTO `news` (`user_id`, `title`, `body`, `date`, `commnet`, `moderate`) VALUES ('".$_SESSION['user_id']."', '".$post['news_title']."', '".$post['news_body']."', '".date("m.d.Y g:i")."', '1', '1')";
			mysql_query($sql);	
			

			$news_id =  Lib_Proc::getInstance()->sql_last_insert_id ("SELECT LAST_INSERT_ID()");
			
			$sql = "INSERT INTO `news_user` (`news_id`, `user_id`, `user_name`) VALUES ('".$news_id."', '".$_SESSION['user_id']."', '".$_SESSION['user_name']."')";
			mysql_query($sql);	
			
			
			//print_r($id_user); exit;
			// INSERT INTO `otpysk`.`news_user` (`news_id`, `user_id`) VALUES ('1', '1') ;

		return $msg;
	  }

	  function GetNews($a=0, $b=CAUNT_NEWS_PAGES, $id = NULL, $ch = 'prev')
		{
			
			$sort = SORTNEWS;
			
			if(!$id){
				//$sql = "select news_user.user_name, news.* from news_user, news where news.user_id = news_user.user_id order by news_id $sort LIMIT $a,$b";
				$sql = "select news_user.*, news.* from news,news_user where news.news_id = news_user.news_id and news.news_id order by news.news_id $sort LIMIT $a,$b";
			
			}else{
				//$sql = "select news_user.user_name, news.* from news_user, news where news.user_id = news_user.user_id and news.news_id = $id";
				$sql = "select news_user.*, news.* from news,news_user where news.news_id = news_user.news_id and news.news_id  = $id";
			}

			
			$result = mysql_query($sql)  or die(mysql_error());

	
			while ($row = mysql_fetch_assoc($result))
				{
					
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
	  
	  function UpdateNews($value)
	  {
		$post = Lib_Proc::getInstance()->ClearArrayDate($value);
		//extract ($post);
		$sql = "UPDATE `news` SET `title`='".$post['news_title']."', `body`='".$post['news_body']."' WHERE `news_id`='".$post['news_id']."'";

		mysql_query($sql);	

		return $msg;
	  }
	 
	 function DelNews($value)
	  {
		$post = Lib_Proc::getInstance()->ClearArrayDate($value);
		$sql = "DELETE FROM `news` WHERE (`news_id`='".$value['delnewsid']."')";
		mysql_query($sql);	
	  }
  
  } 
?>  