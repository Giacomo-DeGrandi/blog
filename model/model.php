<?php


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


// user subscibed model ___________

class user {

	private $id,$password,$conn;
	public $login,$email,$id_droits; 

	function __construct(){
		$id=$this->id;
		$login=$this->login;
		$password=$this->password;
		$email=$this->email;
		$firstname=$this->firstname;
		$id_droits=$this->id_droits;
	}

	//subscribe_

	protected function subscribeUser($login,$password,$email,$firstname,$id_droits){
		
		$conn=$this->conn;
		$sql = " INSERT INTO utilisateurs(login,password,email,firstname,id_droits) VALUES (:login,:password,:email,:firstname,:id_droits) ";
        $prepared = $conn->prepare($sql);
        $executed = $prepared->execute([':login'=> $login ,':password'=> $password,':email'=> $email,':firstname'=> $firstname,':id_droits'=> $id_droits]);
        echo 'succesfully subscribed';
	}

}


// class article ____________

class article {

	protected $conn;

	function __construct($conn){
		$this->conn=$conn;
		$conn=$this->conn;
		return $conn;
	}

	public function getAllarticles(){
		$conn=$this->conn;
		$prepared=$conn->prepare("  SELECT articles.article, articles.id_utilisateur, articles.id_categorie, utilisateurs.id, utilisateurs.login
									FROM articles,utilisateurs 
									WHERE articles.id_utilisateur = utilisateurs.id");
		$executed=$prepared->execute();
		$row = $prepared->fetchAll();
		return $row;
	}

}

//class categories __________
class categories {
	public $id,$nom;

	function __construct(){
		$id=$this->id;
		$nom=$this->nom;
	}
}


