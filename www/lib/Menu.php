<?php
  class Lib_Menu
  {
	public $MenuLangItem = array("UKR"=>"ua", "EN"=>"en"); 
   
	protected static $instance; //(экземпляр объекта) Защищаем от создания через new Singleton
	private function __construct() {}	
	public static function getInstance() {//Возвращает единственный экземпляр класса
		if (!is_object(self::$instance)) self::$instance = new self;
		return self::$instance;
    }
	 
	public function  getMenu()
	 {	
	  
	  if ($_SESSION['lang']=='en'){
		$MenuItem = array("Home"=>"/", "Add News"=>"/news", "Admin"=>"/admin", "Login"=>"/enter");
		}else{
		$MenuItem = array("Головна"=>"/", "Додати новину"=>"/news", "Адмін"=>"/admin", "Вхід"=>"/enter");
		}
	   
	   $print="<div><ul>";	 
       foreach($MenuItem as $name=>$item ){
	    if ($item == '/enter' && $_SESSION['user_name']!=""){
				$print.='<li><a href="/enter" title = "Enter">'.$_SESSION['user_name'].'</a> [ <a href="/enter?out=1">Exit</a> ]</li>';
			}			
		else $print.='<li><a href="'.$item.'" title="'.$item.'">'.$name.'</a></li>';
	   }
	   $print.="</ul></div>";	
	   return  $print;		 
	 }
	
	public function  getLangMenu()
	 {	
	   $print="<ul>";	 
       foreach($this->MenuLangItem as $name=>$item ){
	     $print.='<li><a href="/index?lang='.$item.'" name="lang_'.$item.'" title="'.$item.'"><img src="/images/lang_'.$item.'.png" alt="'.$item.'"></a></li>';
	   }
	   $print.="</ul>";
	   return  $print;		 
	 }

 	public function  menuLogin()
	 {	
	    if (!$_SESSION['auth']===true){
			echo"<form action=\"/enter\" method=\"post\"> <div id=\"form_user_login\"><label for =\"input_username\"><span>Login:</span><input type=\"text\" name=\"login\" id = \"input_username\" value=\"".$login."\"/> </label> 
			<label for =\"input_pass\"><span>Password:</span><input type=\"password\" name=\"pass\" id =\"input_pass\" value=\"".$pass."\"/></label><input type=\"submit\" value=\"Login\"/></div></form>";
		}
	 }

  	public function  messages()
	 {	
		if($_SESSION['auth']===true){
			if (Lib_Proc::getInstance()->_get_user_rights('baned')){?>		
						<div class ="messages">
							<span><?=t("Ви забаненні!")?></span>
						</div>
			<?}
		}
	 }
  
  }
?>
