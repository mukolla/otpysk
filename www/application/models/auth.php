<?php
/*

		$conn = new Lib_connecteddb;
		$db = $conn->connect();
		$result = $db->prepare("SELECT * FROM user");
		$result->execute();
		*/

 class Application_Models_Auth
  {
	
	
	function ValidData($login,$pass){			
		$userdb = new Application_Models_userdb;
	 	$user_data = $userdb->_get_all_user_db();

		foreach ($user_data as $row){
			if ($login == $row['user_name'] && md5($pass) == $row['pass'])
			{
				$_SESSION['auth']=true;  
				$_SESSION['user_name']	= $row['user_name'];
				$_SESSION['mail']		= $row['mail'];
				$_SESSION['user_status']= $row['user_status'];
				$_SESSION['user_id']	= $row['user_id'];
				$_SESSION['img_avatar']	= $row['img_avatar'];
				setcookie('user_count', count($user_data),NULL,'/');
				
				$userdb->_set_user_update(); // update date last activity from user
				
			return false;
			}
		}
		return true;
	}

	function NewUserValidData($username,$email){
		$userdb = new Application_Models_userdb;
	 	$user_data = $userdb->_get_all_user_db();
		foreach ($user_data as $row){
			if ($username == $row['user_name'] &&  $email == $row['mail']){			
					return true;
				}
		}
		return false;
	}

  	function AddUser($value){
		$value = Lib_Proc::getInstance()->ClearArrayDate($value);
		
		if (Lib_Proc::getInstance()->ValidateLoginDate($value)){
			$userdb = new Application_Models_userdb;			
			$user_data = $userdb->_new_user_insert($value);
			$msg = 'Реєстраційні дані введені вірно!';
		}else{
			$msg = 'Реєстраційні дані введені не вірно';
		}
		return $msg;
	}
  } 