<?php
//контролер главной страницы
  class Application_Controllers_Index  extends Lib_BaseController 
  {
      function index()
      {
          
        
		$get = Lib_Proc::getInstance()->ClearArrayDate($_GET);

		if (isset($get['lang'])){
			switch ($get['lang']) {
				case 'ua':
					$_SESSION['lang']='ua';
				    break;
				case 'en':
					$_SESSION['lang']='en';;
				    break;
			}
		
		}
  
		$models = new Application_Models_News;

		
##################  PEGE NAVIGATOR ####################
		if (!isset($get['n'])){
			$_SESSION['n'] = '';
		}else{
			$_SESSION['n'] = $get['n'];
		}

        if ($_SESSION['n']&&$_SESSION['n']>=0)
        {
          $News = $models->GetNews($_SESSION['n']);    
        }else{
		  $News = $models->GetNews();  
        }
#######################################################      
# GetNews($a,$b,$c) - може приймати 3 параметри:
# де	$a,$b - параметри MySQL LIMIT
#		$c - id новини яку необхідно вивести
#######################################################

		$this->News=$News;

	  }
  } 

?> 
 
 