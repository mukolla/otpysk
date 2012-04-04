<?php
/*
Lib_Proc::getInstance()->GoPage(); - за замовчуванням переадресовує в корінь, 
									може приймати один параметр: [/patch]
*/

  class Application_Controllers_News extends Lib_BaseController
  {
     function index()
	 {
		 
		 $post = Lib_Proc::getInstance()->ClearArrayDate($_POST);
		 $get  = Lib_Proc::getInstance()->ClearArrayDate($_GET);

		 #всіх забанений ЗУПИНЯЄМ ТУТ
		 if (Lib_Proc::getInstance()->_get_user_rights('baned')){
				Lib_Proc::getInstance()->GoPage('/enter');
		 }
		
		$news = new Application_Models_News;
		
		#дивимся, якщо пользователь не має права на публікацію то ....
		if (!Lib_Proc::getInstance()->_get_user_rights('publicer')&& empty($get['newsid'])){
				$_SESSION['requrl'] = $_SERVER['REQUEST_URI'];
				Lib_Proc::getInstance()->GoPage('/enter');
			}

		# changed menu iitem Add news	
		if ($post['add_news_ok']){

		  foreach($post as $key=>$value){
		     if (empty($value)){
			if($key <> 'news_id')
			$empty_in[] = $key;
		     }
		  }
		  
		  if ($empty_in){
		    // echo "Ви не заповнили поля:".implode(", | ", $empty_in);  exit;
	
		     $date['title'] 		= $post['news_title'];
		     $date['body'] 		= $post['news_body'];
		     $date['translate_title'] 	= $post['translate_title'];
		     $date['translate_body'] 	= $post['translate_body'];   

		    
		     $this->reedit_news=$date;
		     $this->empty_in = implode(", | ", $empty_in);
		     
		  }else{
		     $date = $news->AddNews($post);
		     Lib_Proc::getInstance()->GoPage();		       
		  }
		  
		}
		
		# changed Link edit news
		if ($get['edit_news_id']){
			if (!Lib_Proc::getInstance()->_get_user_rights('edit',$get['edit_news_id'])){
				Lib_Proc::getInstance()->GoPage();
			}
			$date = $news->GetNews(1,1,$get['edit_news_id'],'edit');
			$this->news=$date;
		}
		
		# click batton saved news
		if ($post['edit_news_ok']){
			$date = $news->UpdateNews($post);
			Lib_Proc::getInstance()->GoPage();
		}

		# changed Link del news
		if ($get['del_news_id']){
			if (!Lib_Proc::getInstance()->_get_user_rights('edit',$get['del_news_id'])){
				Lib_Proc::getInstance()->GoPage();
			}
			$this->delnewsid=$get['del_news_id'];
			$this->newstitle=$get['title'];
		}
		
		# click batton del news
		if ($post['del_news_ok']){	
			$news->delnews($post);
			Lib_Proc::getInstance()->GoPage();
		}

		if ($post['del_news_nou']){
			$news->delnews($post);
			Lib_Proc::getInstance()->GoPage();
		}

		# get full text news
		if($get['newsid']){
			$date = $news->GetNews(1,1,$get['newsid'],'full');
			$this->viewnews=$date;
			$this->backURL = $_SERVER['HTTP_REFERER'];
		}
	 }
  }

?>