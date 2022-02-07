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


// user subscribed model ___________

class user {
				
	private $password;
	public $login,$email,$id_droits; 

	function __construct($pdo){
		$this->pdo=$pdo;
		return $pdo;
	}

	//subscribe_

	public function subscribeUser($login,$password,$email,$id_droits){
		$pdo=$this->pdo;	//
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

	public function updateUser($login,$password,$email,$id_droits,$id){
		$pdo=$this->pdo;	//
		$check= " SELECT * FROM utilisateurs WHERE login=:login OR email=:email ";
		$prepared = $pdo->prepare($check);
        $executed = $prepared->execute([':login'=> $login,':email'=> $email]);
        $row = $prepared->fetch(PDO::FETCH_ASSOC);
        if(!empty($row)){
        	return false;
        } else {
		$sql = " UPDATE utilisateurs SET  login=:login,password=:password,email=:email,id_droits=:id_droits WHERE id=:id ";
        $prepared2 = $pdo->prepare($sql);
        $executed = $prepared2->execute([':id'=>$id,':login'=> $login ,':password'=> $password,':email'=> $email,':id_droits'=> $id_droits]);
        }
	}

	public function connect($login,$password){
		$pdo=$this->pdo;
		$prepared = $pdo->prepare("SELECT * FROM utilisateurs WHERE login = :login AND password = :password");
		$prepared->execute(['login' => $login,':password'=> $password]); 
		$row = $prepared->fetch(PDO::FETCH_ASSOC);
		return $row;
	}

	public function isConnected	($id){
		if(isset($_COOKIE['connected'])){
			return TRUE;
		}
	}

	public function getRights($id){
		$pdo=$this->pdo;
		$prepared = $pdo->prepare("SELECT utilisateurs.id_droits, droits.id, droits.nom, utilisateurs.login , utilisateurs.id
									FROM droits,utilisateurs 
									WHERE droits.id = utilisateurs.id_droits AND utilisateurs.id = :id ");
		$prepared->execute(['id' => $id]); 
		$row = $prepared->fetch(PDO::FETCH_ASSOC);
		return $row;

	}

	public function getComments($id){
		$pdo=$this->pdo;
		$prepared=$pdo->prepare("SELECT * FROM commentaires WHERE id_utilisateur = :id ");
		$prepared->execute(['id' => $id]); 
		$comments = $prepared->fetchAll(PDO::FETCH_ASSOC);
		return $comments;		
	}
	public function editComment($id,$edit){
		$sql = " UPDATE commentaires SET  commentaire=:commentaire WHERE id=:id ";
        $prepared2 = $pdo->prepare($sql);
        $executed = $prepared2->execute([':id'=>$id,':commentaire'=>$edit]);
	}
}



// class article ____________

class article {

	protected $pdo;

	function __construct($pdo){
		$this->pdo=$pdo;
		$pdo=$this->pdo;
		return $pdo;
	}

	public function getAllarticles(){
		$pdo=$this->pdo;
		$prepared=$pdo->prepare("  SELECT articles.article, utilisateurs.login, categories.nom, pictures
									FROM articles
									JOIN utilisateurs
									  ON articles.id_utilisateur = utilisateurs.id
									JOIN categories
									  ON articles.id_categorie = categories.id");	
		$executed=$prepared->execute();
		$row = $prepared->fetchAll();
		return $row; 
	}																			
}


//class categories __________
class categories {
	public $pdo,$id,$nom;

	function __construct($pdo){
		$this->pdo=$pdo;
		$pdo=$this->pdo;
		return $pdo;
	}

	function getAllCategories(){
		$pdo=$this->pdo;
		$prepared=$pdo->prepare("SELECT * FROM categories ");
		$prepared->execute(); 
		$categories = $prepared->fetchAll(PDO::FETCH_ASSOC);
		return $categories;		
	}
}


