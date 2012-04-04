<?
class Lib_connecteddb
{	  
	public function connect(){
		$conn = null;
		try {
			$this->conn = new PDO("mysql:host=".HOST.";dbname=".NAME_BD."", USER, '', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
		}catch (PDOException $e){
			echo $e->getMessage();
		}
	return $this->conn;
	}
}

?>