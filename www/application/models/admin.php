<?php
 class Application_Models_Admin
  {	  
	  function getUsers($get=null){
		if (!$get){
			$sql = "select * from user";
		}else{
			$sql = "select * from user where user_id =".$get;;
		}
		$result = mysql_query($sql)  or die(mysql_error());
		while ($row = mysql_fetch_assoc($result))
			{
				$users[] = $row;
			}
		return $users;
	  }
	  
	  function UpdateUsers($post=null){
	  
		if (!$post){
			$sql = "UPDATE `user` SET `last_activ_date`='".date("m.d.Y g:i")."' WHERE `user_id`='".$_SESSION['user_id']."'";
		}else{
			$sql = "UPDATE `user` SET `user_name`='".$post['user_name']."', `pass`='".$post['pass']."', `mail`='".$post['mail']."', `user_status`='".$post['user_status']."' , `first_name`='".$post['first_name']."' , `last_name`='".$post['last_name']."', `img_avatar`='".$post['img_avatar']."' WHERE `user_id`='".$post['user_id']."'";
		}
		
		$result = mysql_query($sql)  or die(mysql_error());
		return $result;
	  }

	  function BanedUser($get,$status = 'ban'){
		
		$sql = "UPDATE `user` SET `user_status`='4' WHERE `user_id`='".$get['ban_user_id']."'";
		
		$result = mysql_query($sql)  or die(mysql_error());
		return $result;
	  }





  } 
?>  	
