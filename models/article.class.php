<?php

// class article ____________
require_once './models/model.db.php';

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

