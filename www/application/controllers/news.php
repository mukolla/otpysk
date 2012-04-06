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
		$model_comment = new Application_Models_Comment;
		
		$newsdb = new Application_Models_newsdb;
		$commentdb = new Application_Models_commentdb;
		$ratingdb = new Application_Models_ratingdb;
		
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
		     $date['title'] 		= $post['news_title'];
		     $date['body'] 		= $post['news_body'];
		     $date['translate_title'] 	= $post['translate_title'];
		     $date['translate_body'] 	= $post['translate_body'];   
		    
		     $this->reedit_news=$date;
		     $this->empty_in = implode(", | ", $empty_in);
		     
		  }else{
		     $newsdb->_add_news_db($post);
		     Lib_Proc::getInstance()->GoPage();		       
		  }
		}
		
		# changed Link edit news
		if ($get['edit_news_id']){
			if (!Lib_Proc::getInstance()->_get_user_rights('edit',null,$get['edit_news_id'])){
				Lib_Proc::getInstance()->GoPage();
			}
			$date = $news->GetNews(1,1,$get['edit_news_id'],'edit');
			$this->news=$date;
		}
		
		# click batton saved news
		if ($post['edit_news_ok']){
			$newsdb->_update_news_db($post);
			Lib_Proc::getInstance()->GoPage();
		}

		# changed Link del news
		if ($get['del_news_id']){
			if (!Lib_Proc::getInstance()->_get_user_rights('edit',null,$get['del_news_id'])){
				Lib_Proc::getInstance()->GoPage();
			}
			$this->delnewsid=$get['del_news_id'];
			$this->newstitle=$get['title'];
		}
		
		# click batton del news
		if ($post['del_news_ok']){	
			$newsdb->_del_news_db($post);
			Lib_Proc::getInstance()->GoPage();
		}

		if ($post['del_news_nou']){
			Lib_Proc::getInstance()->GoPage();
		}

		# get full text news
		if($get['newsid']){
			$date = $news->GetNews(1,1,$get['newsid'],'full');		
			$this->viewnews=$date;
			$comment = $commentdb->_get_comment_db($get['newsid']);
			if(is_array($comment)){
			   $this->news_comment = $comment ; 
			}
			$this->backURL = $_SERVER['HTTP_REFERER'];
			
			# Gets ratio news from BD
			$news_rating = $ratingdb->_get_rating_db($get['newsid']);
			
			if ($news_rating){
			   # Calculated Ratio
			   $this->date_rating = $news->_news_rating($news_rating);
			}
			
			   
		}
		
		if ($get['edit_comment_id']){
			$comment = $commentdb->_get_comment_db(null,$get['edit_comment_id']);
			$this->edit_comment = $comment;
			$this->news_comment = $commentdb->_get_comment_db($comment[0]['news_id']);
			$date = $news->GetNews(1,1,$comment[0]['news_id'],'full');		
			$this->viewnews=$date;
		}
		
		if ($get['del_comment_id']){
		  if (Lib_Proc::getInstance()->_get_user_rights($rights='edit',true,$get['del_comment_id'])){
		     $this->del_comment_id = $get['del_comment_id'];
		  }else{
		     echo 'Хацкери!!!';
		     exit;
		  }
		}
		
		if ($post['del_comment_ok']){
		  
		  if (Lib_Proc::getInstance()->_get_user_rights($rights='edit',true,$post['del_comment_id'])){

		     $comment = $commentdb->_get_comment_db(null,$post['del_comment_id']); // from SAVE news_id AND comment_id
		     $commentdb->_deleted_comment_db($post);
		     $this->news_comment = $commentdb->_get_comment_db($comment[0]['news_id']);
		     $date = $news->GetNews(1,1,$comment[0]['news_id'],'full');		
		     $this->viewnews=$date;   
		  }else{
		     echo 'Хацкери!!!';
		     exit;
		  }
		}

		// update comment
		if ($post['update_comment']){
		  $commentdb->_update_comment_db($post);
		  $date = $news->GetNews(1,1,$post['news_id'],'full');		
		  $this->viewnews=$date;
		  $this->news_comment = $commentdb->_get_comment_db($post['news_id']);
		}

		if($post['add_comment']){
		  $post = $model_comment->_trim_subject($post);
		  $commentdb->_add_comment_db($post);
		  Lib_Proc::getInstance()->GoPage('/news?newsid='.$post['news_id']);
			
		}
		
		if($post['rating_add_ok']){
		  $ratingdb->_set_rating_db($post);
		  Lib_Proc::getInstance()->GoPage('/news?newsid='.$post['news_id']);
		}
	 }
  }

?>