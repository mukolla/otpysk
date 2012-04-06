<?php
	class Application_Models_commentdb extends Lib_connecteddb{
		function _add_comment_db($post){
		
		//print_r ($_SESSION); exit;
			
			$db = $this->connect();
			
			if (isset($_SESSION['lang'])){
				$lang = $_SESSION['lang'];
			}else{
				$lang = '';
			}
			
			$result = $db->prepare("INSERT INTO comments (news_id, user_id, pub_date, comment_subject, comment_body, comment_lang) 
									VALUES (:news_id, :user_id, :pub_date, :comment_subject, :comment_body, :comment_lang)");

			$result->bindValue(':news_id', intval($post['news_id']), PDO::PARAM_INT);
			$result->bindValue(':user_id', intval($_SESSION['user_id']), PDO::PARAM_INT);
			$result->bindValue(':pub_date', date("m.d.Y g:i"), PDO::PARAM_STR);
			$result->bindValue(':comment_subject', $post['comment_subject'], PDO::PARAM_STR);
			$result->bindValue(':comment_body', $post['comment_body'], PDO::PARAM_STR);
			$result->bindValue(':comment_lang', $lang, PDO::PARAM_STR);

			$result->execute();				
		}
		
		function _get_comment_db($news_id=null,$comment_id=null){
				
			if (isset($_SESSION['lang'])){
				$lang = $_SESSION['lang'];
			}else{
				$lang = '';
			}
			
			$db = $this->connect();
			
			if (!$comment_id){
					$result = $db->prepare("SELECT comments.*,user.user_name
									FROM comments, user
								WHERE news_id = :news_id
									AND comment_lang = :comment_lang
									AND comments.user_id = user.user_id");
					$result->bindValue(':news_id', intval($news_id), PDO::PARAM_INT);
					$result->bindValue(':comment_lang', $lang, PDO::PARAM_STR);
			}else{
					$result = $db->prepare("SELECT comments.*,user.user_name
									FROM comments, user
									WHERE comment_id = :comment_id AND comments.user_id = user.user_id");
					$result->bindValue(':comment_id', intval($comment_id), PDO::PARAM_INT);
			}
			$result->execute();
			
			while ($row = $result->fetch(PDO::FETCH_ASSOC)){
				$data[] = $row;
			}
			return $data;
		}
		
		function _update_comment_db($post){
			$db = $this->connect();
			
			$result = $db->prepare("UPDATE comments
						SET 	comment_subject =:comment_subject,
							comment_body=:comment_body
						WHERE 	comment_id=:comment_id");
			
			$result->bindValue(':comment_id', intval($post['comment_id']), PDO::PARAM_INT);
			$result->bindValue(':comment_subject', $post['comment_subject'], PDO::PARAM_STR);
			$result->bindValue(':comment_body', $post['comment_body'], PDO::PARAM_STR);
			return $result->execute();
		}
		
		function _deleted_comment_db($post){
			$db = $this->connect();
			$result = $db->prepare("DELETE FROM comments WHERE (comment_id=:comment_id)");
			$result->bindValue(':comment_id', intval($post['del_comment_id']), PDO::PARAM_INT);
			return $result->execute();
			
		}
		
	}