<?php



// database model________class to work with 2 dbs
class myDb{

	protected static $server,$username,$password,$database;	// set my static protected

	function __construct($server,$username,$password,$database){
			$dsn = "mysql:host=$server;dbname=$database;charset=UTF8";
			$conn = new PDO($dsn, $username, $password);
			$this->conn=$conn;
			return $conn;
	}

	public function getConn(){
		$conn=$this->conn;
		//var_dump($conn);
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
				
	private $password;
	public $login,$email,$id_droits; 

	function __construct($pdo){
		$this->pdo=$pdo;
		return $pdo;
	}

	//subscribe_

	public function subscribeUser($pdo,$login,$password,$email,$id_droits){
		$this->pdo=$pdo;
		$check= " SELECT * FROM utilisateurs WHERE login=:login OR email=:email ";
		$prepared = $pdo->prepare($check);
        $executed = $prepared->execute([':login'=> $login,':email'=> $email]);
        $row = $prepared->fetch(PDO::FETCH_ASSOC);
        if(!empty($row)){
        	return false;
        } else {
		$sql = " INSERT INTO utilisateurs(login,password,email,id_droits) VALUES (:login,:password,:email,:id_droits) ";
        $prepared2 = $pdo->prepare($sql);
        $executed = $prepared2->execute([':login'=> $login ,':password'=> $password,':email'=> $email,':id_droits'=> $id_droits]);
        }
	}

	public function connect($login,$password){
		$this->login=$login;
		$this->password=$password;
		$pdo=$this->pdo;
		$login=$this->login;
		setcookie('connected', $login, time() +3600);
		$prepared = $pdo->prepare("SELECT * FROM utilisateurs WHERE login = :login AND password = :password");
		$prepared->execute(['login' => $login,':password'=> $password]); 
		$row = $prepared->fetch();
		return $row;
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


