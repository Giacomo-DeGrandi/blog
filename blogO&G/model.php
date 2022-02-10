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
		$prepared->execute([':id' => $id]); 
		$row = $prepared->fetch(PDO::FETCH_ASSOC);
		return $row;

	}

	public function getComments($id){
		$pdo=$this->pdo;
		$prepared=$pdo->prepare("SELECT * FROM commentaires WHERE id_utilisateur = :id ORDER BY date DESC");
		$prepared->execute(['id' => $id]); 
		$comments = $prepared->fetchAll(PDO::FETCH_ASSOC);
		return $comments;		
	}
	public function editComment($id,$edit){
		$sql = " UPDATE commentaires SET  commentaire=:commentaire WHERE id=:id ";
        $prepared2 = $pdo->prepare($sql);
        $executed = $prepared2->execute([':id'=>$id,':commentaire'=>$edit]);
	}
	public function addArticle($id_utilisateur,$id_categories,$articletext){
		$pdo=$this->pdo;
		$date= date("Y-m-d H:i:s");
		$sql= "SELECT * FROM articles WHERE date = :date AND article = :article ";
		$prepared=$pdo->prepare($sql);
		$prepared->execute([':date' => $date, ':article' => $articletext]);
		$result = $prepared->fetchAll(PDO::FETCH_ASSOC);
		if(!empty($result)){
			 $tmp='this article has already been added!';
		} else {
			$tmp='your article has been added!';
			$prepared=$pdo->prepare( " INSERT INTO articles(article,id_categorie,id_utilisateur,date) VALUES (:article,:id_categorie,:id_utilisateur,:date) ");
			$prepared->execute([':article' => $articletext,':id_categorie' => $id_categories,':id_utilisateur' => $id_utilisateur, ':date' => $date ]); 
		}
		return $tmp;	
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

	public function getAllArticles(){
		$pdo=$this->pdo;
		$prepared=$pdo->prepare("  SELECT articles.article, articles.date, articles.id, utilisateurs.login, categories.nom
									FROM articles
									JOIN utilisateurs
									  ON articles.id_utilisateur = utilisateurs.id
									JOIN categories
									  ON articles.id_categorie = categories.id 
									  ORDER BY articles.date DESC");	
		$executed=$prepared->execute();
		$row = $prepared->fetchAll();
		return $row; 
	}

	public function totalNum(){
		$pdo=$this->pdo;
		$prepared=$pdo->query( "SELECT COUNT(*) FROM articles");
		$count = $prepared->fetchAll();
		return $count[0]['COUNT(*)']; 
	}

	public function getOneArticle($id){
		$pdo=$this->pdo;
		$prepared=$pdo->prepare( "SELECT articles.article, articles.date, articles.id, utilisateurs.login, categories.nom, utilisateurs.id
									FROM articles
									JOIN utilisateurs
									  ON articles.id_utilisateur = utilisateurs.id
									JOIN categories
									  ON articles.id_categorie = categories.id WHERE articles.id = :id ");
		$prepared->execute([':id' => $id]); 
		$article = $prepared->fetchAll(PDO::FETCH_ASSOC);
		return $article;
	}

	public function getUserArticles($id_user){
		$pdo=$this->pdo;
		$prepared=$pdo->prepare( "SELECT articles.article, articles.date, articles.id, utilisateurs.login, categories.nom
									FROM articles
									JOIN utilisateurs
									  ON articles.id_utilisateur = utilisateurs.id
									JOIN categories
									  ON articles.id_categorie = categories.id WHERE utilisateurs.id = :id ORDER BY articles.date DESC ");
		$prepared->execute([':id' => $id_user]); 
		$article = $prepared->fetchAll(PDO::FETCH_ASSOC);
		return $article;

	}													
}

//class comments___________

class comments {
	public $pdo;
	function __construct($pdo){
		$this->pdo=$pdo;
		$pdo=$this->pdo;
		return $pdo;
	}

	function addCommentsFromArt($comment,$id_user,$id_article,$date){
		$pdo=$this->pdo;
        $prepared = $pdo->prepare("INSERT INTO commentaires(commentaire,id_utilisateur,id_article,date) VALUES (:commentaire,:id_utilisateur,:id_article,:date)");
        $executed = $prepared->execute([':commentaire'=> $comment,':id_utilisateur' => $id_user,':id_article'=> $id_article,':date'=> $date ]);		
	}

	function getCommentsByArticle($id_article){
		$pdo=$this->pdo;
		$id=$id_article;
		$prepared=$pdo->prepare( "SELECT commentaires.id_article, commentaires.date, commentaires.commentaire, commentaires.id_utilisateur, utilisateurs.id, utilisateurs.login
									FROM commentaires
									JOIN utilisateurs
									  ON commentaires.id_utilisateur = utilisateurs.id WHERE commentaires.id_article = :id ORDER BY commentaires.date DESC");
		$prepared->execute([':id' => $id]); 
		$comments = $prepared->fetchAll(PDO::FETCH_ASSOC);
		return $comments;		
	}
	function getCommentsByCommId($id_comm){
		$pdo=$this->pdo;
		$id=$id_comm;
		$prepared=$pdo->prepare( "SELECT * FROM commentaires WHERE id = :id ");
		$prepared->execute([':id' => $id]); 
		$comment = $prepared->fetchAll(PDO::FETCH_ASSOC);
		return $comment;		
	}
	function editCommentFromProfile($id_comm,$commentaire){
		$pdo=$this->pdo;
		$id=$id_comm;
		$prepared=$pdo->prepare(" UPDATE commentaires SET commentaire=:commentaire WHERE id=:id ");
		$prepared->execute([':commentaire'=> $commentaire,':id'=> $id ]);	
	}
	function deleteComment($id_comm){
		$pdo=$this->pdo;
		$id=$id_comm;
		$prepared=$pdo->prepare(" DELETE FROM commentaires WHERE id=:id ");
		$prepared->execute([':id'=> $id ]);		
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
	function nomToNum($categories){
		$pdo=$this->pdo;
		$prepared=$pdo->prepare("SELECT id FROM categories WHERE nom = :nom  ");
		$prepared->execute([':nom'=> $categories]); 
		$id_categories = $prepared->fetchAll();
		$id_categories=$id_categories[0]['id'];
		return $id_categories;		
	}
}


