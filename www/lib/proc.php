<?php
  class Lib_Proc
  {
    protected static $instance; //(экземпляр объекта) Защищаем от создания через new Singleton
	private function __construct() {}	
	public static function getInstance() //Возвращает единственный экземпляр класса
	{
		if (!is_object(self::$instance)) self::$instance = new self;
		return self::$instance;
    }
	
	
	public function _get_user_rights($rights='user',$type=null,$id = null, $userdata=null){
		if ($_SESSION['auth']){
			
			if (!$userdata){
				$user_id		= $_SESSION['user_id'];
				$user_name		= $_SESSION['user_name'];
				$user_status	= $_SESSION['user_status'];	
			}else{
				if(is_array($userdata)){
					extract($userdata);
				}else{ 
					$user_id = $userdata;
				}
			}	
				$sql = "SELECT * FROM USER WHERE user_id =".$user_id;
				$result = mysql_query($sql);
				if ($row = mysql_fetch_array($result)){
					$user_status = $row['user_status'];
				}
				
				switch ($rights) {
						case 'admin':
							if ($user_status == 0){
								return true;					
							}else return false;
						case 'user':
							if ($user_status == 1){
								return true;					
							}
						
						case 'publicer':
							if ($user_status <> 4 && $user_status <> 1){
								return true;					
							}	
						case 'baned':
							if ($user_status == 4){
								return true;					
							}else return false;

						case 'edit':
							if ($user_status == 0){return true;} // якщо адмін то ТРУ
							if(!$id){echo 'В функцію необхідно передати (2-й) парметр news_id';exit;}
								
								if (!$type){
									$sql = "select news_id, user_id from news where news.news_id = ".$id." and user_id = ".$user_id."";
								}else{
									$sql = "select * from comments where comment_id = ".$id." and user_id = ".$user_id."";
								}
							
							$result = mysql_query($sql);
							if (mysql_fetch_array($result)){
								return true;
							}
						case 'this_user':
						if ($userdata){
							if ($user_id == $_SESSION['user_id']){
								return true;
							}else{
								return false;
							}
						}
				}	
		}else{ // якщо не авторизований то вертаєм
			return false;
		}
	}
	
	public function sql_last_insert_id ($sql){
			$result = mysql_query($sql);
			$result =  mysql_fetch_assoc($result); 
			return $result['LAST_INSERT_ID()'];
	}
	
	public function _uploadfile($username){
		if($_FILES["img_avatar"]["size"] > 1024*1*1024){
				echo (" файл завеликий !");
		}

		if(is_uploaded_file($_FILES["img_avatar"]["tmp_name"])) {
			$ex = explode(".",$_FILES["img_avatar"]["name"]);
			move_uploaded_file($_FILES["img_avatar"]["tmp_name"], $_SERVER['DOCUMENT_ROOT']."/images/".$username.'.'.$ex['1']);
		} else {
			echo("помилка при загрузці");
		}
	return  $username.'.'.$ex['1']; exit;

	}
	
	public function imageresize($outfile,$infile,$neww=AVATAR_W,$newh=AVATAR_H,$quality=100) {
					$im=imagecreatefromjpeg($infile);
					$k1=$neww/imagesx($im);
					$k2=$newh/imagesy($im);
					$k=$k1>$k2?$k2:$k1;

					$w=intval(imagesx($im)*$k);
					$h=intval(imagesy($im)*$k);

					$im1=imagecreatetruecolor($w,$h);
					imagecopyresampled($im1,$im,0,0,0,0,$w,$h,imagesx($im),imagesy($im));

					imagejpeg($im1,$outfile,$quality);
					imagedestroy($im);
					imagedestroy($im1);
					/*				   ще потрібно зробити конвертор форматів
					$f = imagecreatefromjpeg($source_file);
					imagejpeg ($f,$sf);
					*/
	}

	
	public function  ClearArrayDate($array_date)
	{			 
		foreach($array_date as $key => $value)
		{
			$value = trim($value);
			if ($key <> 'news_body')	{
					$value = strip_tags($value);	
			}
		$result[$key] = $value;
		}
		return $result;
	}
	
	public function  ValidateLoginDate($value)
	{	
			$lud['username']	= 12; // lud - Lenght User Date
			$lud['email']		= 30;
			$lud['password']	= 20; 


		if (!empty($value))	{extract($value);}

		if (
		(preg_match("/[^a-z,A-Z,0-9,а-яіїєґ,А-ЯІЇЄҐ,\-,\_]/", $first_name)) or
			(preg_match("/[^a-z,A-Z,0-9,а-яіїєґ,А-ЯІЇЄҐ,\-,\_]/", $last_name)) or
		($username == '' || $username>$lud['username']) or 
		(!ereg("^[a-z0-9\._-]+@[a-z0-9\._-]+\.[a-z]{2,4}\$",$email,$regs) || $email=='' || $email > $lud['email']) or
		($password == '' || $password > $lud['password']||$password <> $repassword)
		){
			$result = false;
		}else{
			$result = true;
		}
		return $result;
	}

	public function GoPage($location='/'){ 
		header('Location: '.$location.'');
		exit;
	}


/****************PEGE NAVIGATOR**********************/
	public function  PrevionsPages()
	{	
		if (($_SESSION['n']-CAUNT_NEWS_PAGES)>0){
			return $_SESSION['n']-CAUNT_NEWS_PAGES;			 
		 }
	}
 
	public function  NextPages()
	{	
		return $_SESSION['n']=$_SESSION['n']+CAUNT_NEWS_PAGES;
	}
 /***************************************************/
 }

?>