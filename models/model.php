<?php 

// database model________

class database{

	private $server,$username,$password,$database,$sql;

	function __construct(){
			$server = "localhost";
			$username = "root";
			$password = "";
			$database = "blog";

			$dsn = "mysql:host=$server;dbname=$database;charset=UTF8";

			$conn = new PDO($dsn, $username, $password);
			$this->conn=$conn;
			return $conn;
	}

 	function __destruct () {
    	if ($this->conn!==null) { $this->conn = null; }
	 }

	function selectQuery($sql,$values){

		$conn=$this->conn;
		$query = $sql;
        $prepared = $conn->prepare($query);
        $executed = $prepared->execute($values);
        $executed=$this->executed;
        return $this->executed->fetchAll();

	}

}

