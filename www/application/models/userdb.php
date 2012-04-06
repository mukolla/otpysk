<?php

 class Application_Models_userdb extends Lib_connecteddb
  {
	  function _get_all_user_db(){
		$db = $this->connect();
		$result = $db->prepare("SELECT * FROM user");
		$result->execute();
		while ($row = $result->fetch(PDO::FETCH_ASSOC)){
			$data[] = $row;
		}
		return $data;
	  }
	  
	  function _get_user_db($value){
		$user_id['user_id'] = $value;
		$db = $this->connect();
		$result = $db->prepare("SELECT * FROM user where user_id =:user_id");
		$result->execute($user_id);
		while ($row = $result->fetch(PDO::FETCH_ASSOC)){
			$data[] = $row;
		}
		return $data;
	  }

	  function _set_user_update($post=null){
		$db = $this->connect();
		if (!$post){
			$result = $db->prepare("UPDATE `user` SET `last_activ_date`=:date WHERE `user_id`=:user_id");
			$date[':user_id']= $_SESSION['user_id'];
			$date[':date']= date("m.d.Y g:i");
		return $result->execute($date);	
		}else{
			unset($post['hidden_img_avatar']); // deleted unclaimed variable
			unset($post['user_edit_ok']);
			$result = $db->prepare("UPDATE `user` SET `user_name`=:user_name, `pass`=:pass, `mail`=:mail, `user_status`=:user_status, `first_name`=:first_name, `last_name`=:last_name, `img_avatar`=:img_avatar WHERE `user_id`=:user_id");
		return $result->execute($post);
		}
	  }
	  
	function _new_user_insert($s){
			unset($s['repassword']); // deleted unclaimed variable
			unset($s['adduser']);
			
			if (!isset($s['img_avatar'])){
			    $s['img_avatar'] = '';
			}
			
			$s['reg_date']=date("m.d.Y g:i");
			$s['password']=md5($s['password']);
			$db = $this->connect();
			$result = $db->prepare("INSERT INTO user (user_name, pass, mail, reg_date, first_name, last_name, img_avatar) VALUES (:username, :password, :email, :reg_date, :first_name, :last_name, :img_avatar)");
		return $result->execute($s);
	}
	
	function _set_user_ban($value){
			$user_id['user_id']= $value['ban_user_id'];
			$db = $this->connect();
			$result = $db->prepare("UPDATE user SET user_status=4 WHERE user_id=:user_id");
		return $result->execute($user_id);	
	}
	
	
	function _del_user_db($value){
	
	// print_r($value); exit;
	     $db = $this->connect();
	     $result = $db->prepare("DELETE FROM user WHERE user_id=:id");
	    // $id['id'] = $value;
	    $id['id']=$value;
	return $result->execute($id);	
	}

  }
  ?>