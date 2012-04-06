<?php
    class Application_Models_newsdb extends Lib_connecteddb{
        function _add_news_db($post){
            
            $db = $this->connect();
        
            # insert news
            $value['user_id'] = $_SESSION['user_id'];
            $value['news_title'] = $post['news_title'];
            $value['news_body'] =$post['news_body'];
            $value['date'] = date("m.d.Y g:i");
            
            $result = $db->prepare("INSERT INTO news (user_id, title, body, date, commnet, moderate) VALUES (:user_id, :news_title, :news_body, :date, 1, 1)");
            $res[] = $result->execute($value);
            
            unset($value);
            $news_id = $db->lastInsertId();
            
            # insert news_user
            $value['news_id'] = $news_id;
            $value['user_id'] = $_SESSION['user_id'];
            $value['user_name'] = $_SESSION['user_name'];
      
            $result = $db->prepare("INSERT INTO news_user (news_id, user_id, user_name) VALUES (:news_id, :user_id, :user_name)");
            $res[] = $result->execute($value);
            
            unset($value);
            
            # insert translation_news
            $value['news_id']           = $news_id;
            $value['translate_title']   = $post['translate_title'];
            $value['translate_body']    = $post['translate_body'];
            
	    $result = $db->prepare("INSERT INTO translation_news (news_id, translate_title, translate_body) VALUES (:news_id, :translate_title, :translate_body)");
            $res[] = $result->execute($value);
            
            return $res;
        }
        
        function _get_news_db($a=0, $b=CAUNT_NEWS_PAGES, $id=null, $lang=null){
            
            $db = $this->connect();
                    
            if ($id){
                $value['id'] = $id;
                $result = $db->prepare("SELECT 	news_user.*, news.*, translation_news.*
				       FROM 	news,news_user, translation_news
				       WHERE 	news.news_id = news_user.news_id and
						news.news_id  = :id and
						translation_news.news_id = news.news_id");
                
                /*
                SELECT
  `news`.*, `news_user`.*, `translation_news`.`translate_title`,
  `translation_news`.`translate_body`, `translation_news`.`news_id`
FROM
  `news` INNER JOIN
  `news_user` ON `news_user`.`news_id` = `news`.`news_id` INNER JOIN
  `translation_news` ON `translation_news`.`news_id` = `news`.`news_id`
WHERE `news`.`news_id` = 82
                */
                
                
                $result->execute($value); 
           }else{
                if ($lang){

                    $result = $db->prepare("SELECT 	news_user.*, news.*, translation_news.translate_title,
							translation_news.translate_body
					    FROM 	news, news_user, translation_news
					    WHERE 	news.news_id = news_user.news_id and
							news.news_id = translation_news.news_id and
							translation_news.lang = :lang
					    ORDER BY news.news_id DESC LIMIT :limit, :offset");


		    $result->bindValue(':lang', $lang, PDO::PARAM_STR);
		    $result->bindValue(':limit', intval($a), PDO::PARAM_INT);
		    $result->bindValue(':offset', intval($b), PDO::PARAM_INT);

		    $result->execute();

                }else{
                    
                    $result = $db->prepare("SELECT 	news_user.*, news.*, translation_news.translate_title,
							translation_news.translate_body
					    FROM 	news, news_user, translation_news
					    WHERE 	news.news_id = news_user.news_id and
							news.news_id = translation_news.news_id
					    ORDER BY news.news_id DESC LIMIT :limit, :offset");

					$result->bindParam(':limit', intval($a), PDO::PARAM_INT);
					$result->bindParam(':offset', intval($b), PDO::PARAM_INT);
					$result->execute();               
                }
            }
                    
            while ($row = $result->fetch(PDO::FETCH_ASSOC)){
                $data[] = $row;
            }
	    return $data;
        }      
   
	function _update_news_db($post){
	    
	    $db = $this->connect();
	    
	    $result = $db->prepare("UPDATE news SET title=:news_title, body =:news_body
				    WHERE news_id=:news_id");
	    $result->bindValue(':news_id', intval($post['news_id']), PDO::PARAM_INT);
	    $result->bindValue(':news_title', $post['news_title'], PDO::PARAM_STR);
	    $result->bindValue(':news_body', $post['news_body'], PDO::PARAM_STR);
	    
	    $result->execute();
	    
	    if (isset($_SESSION['lang'])){
		$lang = $_SESSION['lang'];
		
		$result = $db->prepare("UPDATE translation_news
					SET 	translate_title = :translate_title, translate_body = :translate_body
					WHERE 	news_id =:news_id and
						lang =:lang");
		
		
		$result->bindValue(':news_id', intval($post['news_id']), PDO::PARAM_INT);
		$result->bindValue(':translate_title', $post['translate_title'], PDO::PARAM_STR);
		$result->bindValue(':translate_body', $post['translate_body'], PDO::PARAM_STR);
		$result->bindValue(':lang', $lang, PDO::PARAM_STR);
		
		$result->execute();


	    }else{
		$result = $db->prepare("UPDATE translation_news
				       SET 	translate_title = :translate_title, translate_body = :translate_body
				       WHERE 	news_id = :news_id");
		
		$result->bindValue(':news_id', intval($post['news_id']), PDO::PARAM_INT);
		$result->bindValue(':translate_title', $post['translate_title'], PDO::PARAM_STR);
		$result->bindValue(':translate_body', $post['translate_body'], PDO::PARAM_STR);
		$result->execute();
	    }
	
	}
	
	function _del_news_db($post){
	    
	    $db = $this->connect();
	    $result = $db->prepare("DELETE FROM news WHERE (news_id = :delnewsid)");
	    $result->bindValue(':delnewsid', intval($post['delnewsid']), PDO::PARAM_INT);
	    $result->execute();
	}

   
    }