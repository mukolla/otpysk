<?php

  class Application_Controllers_Admin extends Lib_BaseController
  {
     function index()
	 {
		$post = Lib_Proc::getInstance()->ClearArrayDate($_POST);
		$get  = Lib_Proc::getInstance()->ClearArrayDate($_GET);

		 if(Lib_Proc::getInstance()->_get_user_rights()===false){ //спочатку подивимось чи наш чувак авторизований
			$_SESSION['requrl'] = $_SERVER['REQUEST_URI']; // щоб знати куда повернусь після авторизації
			Lib_Proc::getInstance()->GoPage('/enter');
		 }
		
		// потім дивимся чи він є адміном
			if (!Lib_Proc::getInstance()->_get_user_rights('this_user',$news_id = null,$get['useredit'])){ //... може сам користувач хоче змінити свої дані
				if (!Lib_Proc::getInstance()->_get_user_rights('admin')){
					$this->msg = "Даний користувач не є адміном!";
				}
			}
		
		$adminmodels = new Application_Models_Admin;
		
		$userdb = new Application_Models_userdb;

		
		#click del user
		if ($get['deluser']){	  
				$this->deluser = $get['deluser'];
				$this->backURL = $_SERVER['HTTP_REFERER'];
		 }
			
		#confirme del user
		 if ($get['del_user_id']){

			$userdb->_del_user_db($get['del_user_id']);
			Lib_Proc::getInstance()->GoPage('/admin?checked=users');
		 }


		if ($get['checked']=='users') // коли вибрали ссилку "користувачі" в адмінці
		{
			$date = $userdb->_get_all_user_db();
			$this->userdate=$date;
			$this->backURL = $_SERVER['HTTP_REFERER'];
		}

		if ($get['useredit']) // коли по конкретно юзверу нажали ЕДІТ
		{
			$date = $userdb->_get_user_db($get['useredit']);
			$this->backURL = $_SERVER['HTTP_REFERER'];
			$this->useredit=$date[0];
		}

		if ($post['user_edit_ok']) // в формі редагування нажав SAVE
		{
			
			# якщо не адмін то залишемоо змінну $post['user_status'] такою як вона була раніше
			if (!Lib_Proc::getInstance()->_get_user_rights('admin')){
					$post['user_status'] = $_SESSION['user_status'];
				}
			
			# update avatar for user 
			if($_FILES['img_avatar']['error']==0){
				
						$post['img_avatar'] = Lib_Proc::getInstance()->_uploadfile($post['user_name']);
						
						$source_file = $_SERVER['DOCUMENT_ROOT']."/images/".$post['img_avatar'];
						$new_file = $_SERVER['DOCUMENT_ROOT']."/images/smile_".$post['img_avatar'];
						
						Lib_Proc::getInstance()->imageresize($new_file,$source_file);
			}else{
				$post['img_avatar'] = $post['hidden_img_avatar'];
			}
			
			$userdb->_set_user_update($post);
			
			# якщо користувач не адмін то повернем його на сторінку користувача
			if (!Lib_Proc::getInstance()->_get_user_rights('admin')){
					Lib_Proc::getInstance()->GoPage('/enter');
				}

			$date = $userdb->_get_all_user_db();
			$this->userdate=$date;
		}

		if ($get['ban'] && !($get['ban']==$_SESSION['user_id']) )
		{
			$this->msgban = $get['user_name']; // тут відобразимо мессидж про БАН ЮЗЕРА, і ссилочку з ГЕТ параметром  "ban_user_id"
			$this->user_id = $get['ban'];
			$this->backURL = $_SERVER['HTTP_REFERER'];
		}else{
			if ($get['ban']==$_SESSION['user_id']){
			$this->msgnotban = true;
			$this->backURL = $_SERVER['HTTP_REFERER'];
			}
		}

		if ($get['ban_user_id'])
		{
			$date = $userdb->_set_user_ban($get);
			Lib_Proc::getInstance()->GoPage('/admin?checked=users');
		}
	 }
  }

?>