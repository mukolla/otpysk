<?php
  class Application_Controllers_Enter extends Lib_BaseController
  {
	 function index()
	 {
  		 $post = Lib_Proc::getInstance()->ClearArrayDate($_POST);
		 $get = Lib_Proc::getInstance()->ClearArrayDate($_GET);

		 $userdb = new Application_Models_userdb;
	
		//если пришли данные логин и пароль, создаем модель проверки авторизации и передаем в нее данные.
		if($post['login']||$post['pass']){		
			$model=new Application_Models_Auth;
			
			## return TRUE if Error, if Good return FALSE
			$this->loginusererror =$model->ValidData($post['login'],$post['pass']);
		}

			if($_REQUEST['out']=="1"){
			$_SESSION["auth"]=false;
			$_SESSION['user']="";
			$_SESSION['requrl'] ="";
			$_SESSION['user_name']	= "";
			$_SESSION['mail']		= "";
			$_SESSION['user_status']= "";
			$_SESSION['user_id']	= "";
		}

		if($post['adduser']){
			$model=new Application_Models_Auth;
			
			# checked availability Login and E-mail 
			$auth = $model->NewUserValidData($post['username'],$post['email']);
				
			if ($auth == false){
				
					if($_FILES['img_avatar']['error']==0){
				
						$post['img_avatar'] = Lib_Proc::getInstance()->_uploadfile($post['username']);
						
						$source_file = $_SERVER['DOCUMENT_ROOT']."/images/".$post['img_avatar'];
						$new_file = $_SERVER['DOCUMENT_ROOT']."/images/smile_".$post['img_avatar'];
						
						Lib_Proc::getInstance()->imageresize($new_file,$source_file);
					}

				$this->msg_user_add = $model->AddUser($post);
				$this->mypost = $post; // запишемо масивчик ПОСТ, щоб потім було що показувати
				
				# autorization new User
				$this->loginusererror = $model->ValidData($post['username'],$post['password']);

			}else {
				$this->msg_user_add = "такий користувач вже існує!";
				$this->mypost = $post; 

			}
		}
		
		
		//якщо прийшов запит показти сторінку користувача
		if ($get['user_id']){
				$date = $userdb->_get_user_db($get['user_id']);
				$this->user=$date[0];
				$this->onlyuser = true;
		}else{
		//якщо нічого не прийшло показуєм сторінку поточного юзера
			$date = $userdb->_get_user_db($_SESSION['user_id']);
			$this->user=$date[0];
		}
		

		


	 
//		 http://otpysk/enter?user_id=10
		 
		 if ($get['deluser']){	
				$this->deluser = $get['deluser'];
				$this->backURL = $_SERVER['HTTP_REFERER'];
		 }

		 if ($get['del_user_id']){
		
			 if (Lib_Proc::getInstance()->_get_user_rights($status = 'this_user',null,null, $get['del_user_id'])){
					
					$userdb->_del_user_db($get['del_user_id']);
					 
					Lib_Proc::getInstance()->GoPage('/enter?out=1');

				}else{
					echo $this->msg = "Видаляти можна лише свій профіль!";
					exit;
				}
		 }
	 } 
  }

?>