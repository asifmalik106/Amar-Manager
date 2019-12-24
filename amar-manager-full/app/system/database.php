<?php
	define('DB_HOST', 'localhost');
	define('DB_NAME', 'RM_DB');
	define('DB_USER', 'root');
	define('DB_PASS', 'asifsadiq106');
/**
* 
*/
class Database
{
	public $conn;

	function __construct()
	{
		$this->conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		$this->conn->set_charset("utf8");
		/* Check connection
		if ($this->conn->connect_error) {
   			die("Connection failed: " . $this->conn->connect_error);
		} 
		echo "Connected successfully";*/
	}

	public function execute($sql)
	{
		if ($this->conn->query($sql) === TRUE) {
    		return TRUE;
		} else {
		   	return FALSE;
		}
	}

	public function fetch($sql)
	{
		return $this->conn->query($sql);
	}

	public function selectDB($db){
		return mysqli_select_db($this->conn,$db);
	}
	
}
