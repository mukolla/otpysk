<?
class Lib_connecteddb
{	  
	$conn = null;
	$err = null;
	
	public function connect(){
		
		try {
			$this->conn = new PDO("mysql:host=".HOST.";dbname=".NAME_BD."", USER, '');
		}catch (PDOException $e){
			$this->err = $e->getMessage();
			return false;
		}
	}
}

?>