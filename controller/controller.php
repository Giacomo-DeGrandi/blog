<?php 

//main controllers		___index.php page________

function getRightPageContent($page){
			switch($page){
				case 'home';
						require'./view/article.index.view.php';
						return $content;
				case 'inscription':
						break;
				case 'connexion':
						break;
				case 'create':
						break;
				case 'account':	
						break;
				case 'admin':	
						break;
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

function testSessionForm ($user){	// test if user is connected through sessions--
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

// require different views


function getRightHeader($sess){		// test to send header--
	switch($sess){
		case 0:
			require_once './view/headers/header.menu.btn.php';
			require_once './view/headers/buttons/header.sublog.btn.php';
			break;
		case 1:
			require_once './view/headers/header.menu.btn.php';
			require_once './view/headers/buttons/header.accountdisc.btn.php';
			break;
		case 42:
			require_once './view/headers/header.menu.btn.php';
			require_once './view/headers/buttons/header.accountdisc.btn.php';
			require_once './view/headers/buttons/header.create.btn.php';
			break;
		case 1337:
			require_once './view/headers/header.menu.btn.php';
			require_once './view/headers/buttons/header.sublog.btn.php';
			require_once './view/headers/buttons/header.createadmin.btn.php';
			break;
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

		echo '<h2>latest articles</h2><table id="main_article_view"><tr>';
		for($i=0;$i<3;$i++){

		echo '<td><h2>'.$article[$i]['login'].'</h2>';
		echo '<h4><i>'.numToTextCategories($article[$i]['id_categorie']).'</i></h4>';
		echo '<h5>'.textBeginning($article[$i]['article']).'<h5><small><i>continue to read</i></small></td>';
		echo '</tr></table>';
	}

}

