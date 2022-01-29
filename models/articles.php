<?php


// class article ____________

class article {

	public $id,$article,$id_utilisateur,$date;

	function __construct(){
		$id=$this->id;
		$article=$this->article;
		$id_utilisateur=$this->id_utilisateur;
		$date=$this->date;
	}

	function getarticle(){
		$login=$this->login;
		$conn=$this->conn;
		$prepared=$conn->prepare("SELECT email FROM utilisateurs WHERE login = :login ");
		$executed=$prepared->execute(['login' => $login]);
	}

}

