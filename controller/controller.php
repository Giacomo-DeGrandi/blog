<?php 

// take my classes form models

require_once 'model/model.php';

// my config for dbs

require_once './config/config.php';

//connect to db

$db= new myDb($server,$username,$password,$database);
$conn=$db->getConn();

function connectDb ($conn){
	return $conn;
}


//main controllers		___index.php page________

function getRightContent($cookie,$conn){
	switch($cookie){
		case 'home':
			$article=new article($conn);	//instantiate new article
			$article=$article->getAllarticles();	// get all from class
			require_once 'view/homeView.php';	// generate articles view
			return $content;
		case 'subscribe':
		case 'login':
		case 'account':
		case 'articles':
		case 'create':
		case 'admin':

	}
}

//safety controllers_____

include 'func.sec.php';


// header controller 	_____main_header.index.php page___


function newVisitor() {	// create cookie test 
	if(!isset($user)){
		$user='visitor';
		$page='home';
		setcookie('user',$user, time() +36000);
		setcookie('page',$page, time() +36000);
		return $user;
	}
}

function testSessionForm ($user){	// test if user is connected through cookies
		switch($user){
			case 'visitor';
					return 0;
			case 'user':
					return 1;
			case 'mod':
					return 42;
			case 'admin':
					return 1337;
		}
}

// generate header buttons

function genHeadBtn($x) {
	$input= '<form method="post" class="headerbtn"><input type="submit" name="headerbtn" value="'.$x.'"></input></form>';
	return $input;
}


function getRightHeader($sess){		// test to send header--
	switch($sess){
		case 0:
			$sub='subscribe';
			$log='login';
			$buttons=genHeadBtn($log).genHeadBtn($sub);
			return $buttons;
		case 1:
			$account='account';
			$disconnect='disconnect';
			$buttons=genHeadBtn($account).genHeadBtn($disconnect);
			return $buttons;
		case 42:
			$account='account';
			$disconnect='disconnect';
			$create='create';
			$buttons=genHeadBtn($account).genHeadBtn($create).genHeadBtn($disconnect);
			return $buttons;
		case 1337:
			$account='account';
			$disconnect='disconnect';
			$create='create';
			$admin='admin';
			$buttons=genHeadBtn($account).genHeadBtn($create).genHeadBtn($admin).genHeadBtn($disconnect);
			return $buttons;
	}
}

// get post on buttons to choices

function choseFormCookie($formcookiechoice) {
	switch($formcookiechoice){
		case 'subscribe':
				return 1;
		case 'login':
				return 2;
		case 'create':
				return 3;
		case 'admin':
				return 4;
	}
}

function redirectToForm ($cookie){
		switch($cookie){
			case 1:
				setcookie('forms','sub' ,time() +3600);
				header('location: ./view/forms/main_forms.index.php');
				break;
			case 2:
				setcookie('forms','log' ,time() +3600);
				header('location: ./view/forms/main_forms.index.php');
				break;
			}
}

// article controller

function textBeginning($text){		//get just the beginning of the article as a title
	$text=substr($text,0,15);
	return $text;
}

function numToTextCategories($id_categories){		//get just the beginning of the article as a title
	switch($id_categories){
		case 1:
			$category='science';
			return $category;
		case 2:
			$category='music';
			return $category;			
		case 3:
			$category='arts';
			return $category;
	}
}


function viewArticles($article){
		for($i=0;$i<3;$i++){
		echo '<tr><td><h2>'.$article[$i]['login'].'</h2>';
		echo '<h4><i>'.numToTextCategories($article[$i]['id_categorie']).'</i></h4>';
		echo '<h5>'.textBeginning($article[$i]['article']).'<h5><small><i>continue to read</i></small></td>';
	}
}

