<?php

require_once "./config.php";
require_once "./languages.php";

function debag($v=null){
	if ($v){
		echo "<PRE>".print_r($v,true)."</PRE>";
		exit;
	}
	
}


$router=new Lib_Application; // цей об'єкт буде шукати всі інші "контроллери"
$member=$router->Run();
$member['init']=0;
  foreach ($member as $key => $value){
	 	$$key= $value;
	}

// header
require_once "./template/header.php";
// contetnt
 $view=$router->getView();
 include ($view); 
// footer
require_once "./template/footer.php";