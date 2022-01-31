<?php 

// my config for dbs

require_once 'dblist.php';

// database model________class to work with 2 dbs


class myDb{

	protected static $server,$username,$password,$database;	// set my static protected

	function __construct($server,$username,$password,$database){
			$dsn = "mysql:host=$server;dbname=$database;charset=UTF8";
			$conn = new PDO($dsn, $username, $password);
			return $this->conn=$conn;
	}

	public function getConn(){
		$conn=$this->conn;
		return $conn;	
	}

	function selectQuery($sql,$values){

		$conn=$this->conn;
		$query = $sql;
        $prepared = $conn->prepare($query);
        $executed = $prepared->execute($values);
        return $this->executed->fetchAll();

	}

}


