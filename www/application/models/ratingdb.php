<?php
    class Application_Models_ratingdb extends Lib_connecteddb{
            function _set_rating_db($post){
                
                $db = $this->connect();
                $result = $db->prepare("INSERT INTO news_rating (news_id, user_id, rating_value) VALUES (:news_id, :user_id, :rating_value)");
                $result->bindValue(':news_id', intval($post['news_id']), PDO::PARAM_INT);
                $result->bindValue(':user_id', intval($_SESSION['user_id']), PDO::PARAM_INT);
                $result->bindValue(':rating_value', intval($post['rating_value']), PDO::PARAM_INT);
                return $result->execute();				
            }
            
            function _get_rating_db($value){
                
           
                $db = $this->connect();
                $result = $db->prepare("SELECT news_rating.*, user.user_id, user.user_name 
                                        FROM user, news_rating 
                                        WHERE	news_rating.news_id = :news_id AND 
                                                news_rating.user_id = user.user_id");
                $result->bindValue(':news_id', intval($value), PDO::PARAM_INT);
                $result->execute();
             
                    
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)){
                            $data[] = $row;
                    }
                    return $data;
            }
            
            /*
            function _update_rating_db($post){
                    $db = $this->connect();
                    
                    $result = $db->prepare("UPDATE comments
                                            SET 	comment_subject =:comment_subject,
                                                    comment_body=:comment_body
                                            WHERE 	comment_id=:comment_id");
                    
                    $result->bindValue(':comment_id', intval($post['comment_id']), PDO::PARAM_INT);
                    $result->bindValue(':comment_subject', $post['comment_subject'], PDO::PARAM_STR);

                    return $result->execute();
            }
            
            function _deleted_rating_db($post){
                    $db = $this->connect();
                    $result = $db->prepare("DELETE FROM comments WHERE (comment_id=:comment_id)");
                    $result->bindValue(':comment_id', intval($post['del_comment_id']), PDO::PARAM_INT);
                    return $result->execute();
                    
            }
            */
         
 /*
 
 [news_id] => 82
    [vote] => 3
    [rating_add_ok] => Голосувати

SELECT news_rating.*, user.user_id, user.user_name 
	FROM user, news_rating 
WHERE	news_rating.news_id = :news_id AND 
		news_rating.user_id = user.user_id
 */    
    }

