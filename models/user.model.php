<?php

// user model ___________

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