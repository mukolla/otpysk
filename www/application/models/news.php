<?php
 class Application_Models_News
  {	  
	function GetNews($a=0, $b=CAUNT_NEWS_PAGES, $id = NULL, $ch = 'prev'){
		$newsdb = new Application_Models_newsdb;
			if (isset($_SESSION['lang'])){
				$lang = $_SESSION['lang'];			
			}
			
					//a,b - LIMIT parametrs
			if(!$id){
				if (isset($lang)){
					//echo 'e'; exit;
					$rows = $newsdb->_get_news_db($a, $b, $id = null, $lang);
				}else{

					$rows = $newsdb->_get_news_db($a,$b);
				}
			}else{
					$rows = $newsdb->_get_news_db($a, $b, $id);
			}
			
			foreach ($rows as $row){
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
	
	function _news_rating($value){
		
		foreach($value as $rating){			
			if ($rating['user_name'] == $_SESSION['user_name']){
				$date['unvisible_form'] =true;
			}
			$date['ratio'] = $date['ratio'] + $rating['rating_value'];
			
		}
		
	return $date;
		//	debag($value);
		/*
		[rating_id] => 4
            [news_id] => 82
            [user_id] => 10
            [rating_value] => 3
            [count_vote] => 
            [user_name] => mukolla
		*/
		
	}
  } 
?>  