<?php
 class Application_Models_Comment
  {
	function _trim_subject($post){
	
	 if (!strlen($post['comment_subject'])){
	    $i = strripos(substr($post['comment_body'], 0, 15), ' ');
	    $post['comment_subject'] = substr($post['comment_body'], 0, $i);
	 }
	return $post;	  
	}
  } 
?>