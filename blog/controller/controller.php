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

function getRightContent($getaction,$conn){
	switch($getaction){
		case null:
			$article=new article($conn);	//instantiate new article
			$article=$article->getAllarticles();	// get all from class
			require_once 'view/homeView.php';	// generate articles view
			return $content;
		case 'subscribe':
			$form=postToForm($getaction);
			require_once 'view/formView.php';	// generate form view
			return $content;
		case 'login':
			$form=postToForm($getaction);
			require_once 'view/formView.php';	// generate form view
			return $content;			
		case 'account':
		case 'articles':
		case 'create':
		case 'admin':

	}
}


//safety controllers_____

include 'func.sec.php';

function testForm($test){
	if(!empty($test)){
		if(ctype_alpha($test)){
			return $test;
		} else { 
			echo 'invalid input';
		}
	}
}

//my very easy post controller____

function redirectPostForms($post){
	if($post){

		foreach ($post as $k => $v) {
			switch ($k){
				case 'login':
					$login=$v;
					$login=testForm($login);
					break;
				case 'password':
					$password=htmlspecialchars($v);
					break;
				case 'passwordconf':
					$passwordconf=htmlspecialchars($v);
					break;
				case 'email':
					$email=filter_var($v, FILTER_VALIDATE_EMAIL);
				case 'subscribe':
					echo $login.$passwordconf.$password;
					
			}
		}
	}
}


// header controller 	_____main_header.index.php page___


function newVisitor() {	// create cookie test 
	if(!isset($user)){
		$user='visitor';
		$page='home';
		setcookie('user',$user, time() +36000);
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
	$alink= '<a href="?action='.$x.'" >'.$x.'</a>&#160;';
	return $alink;
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


// if post on button, route the request to the right assembly page

function postToForm ($getaction){
		switch($getaction){
			case 'subscribe':
				$form=assembleForm($getaction);
				return $form;
			case 'login':
				$form=assembleForm($getaction);
				return $form;
			}
}

function genForm($t,$n) {
	$input= '<input type="'.$t.'" name="'.$n.'" placeholder="'.$n.'"></input><br><br>';
	return $input;
}


function assembleForm($getaction){
	switch ($getaction){
		case 'subscribe':
			$t='text'; $n='login';
			$t2='password';$n2='password';
			$n3='passwordconf';
			$n4='firstname';
			$n5='email';
			$in1=genForm($t,$n);
			$in2=genForm($t,$n4);
			$in3=genForm($t,$n5);
			$in4=genForm($t2,$n2);	
			$in5=genForm($t2,$n3);
			$form=$in1.$in2.$in3.$in4.$in5.'<input type="submit" name="subscribe" value="subscribe" width="35px">';
			return $form;
		case 'login':
			$t='text'; $n='email';
			$t2='password';$n2='password';
			$in1=genForm($t,$n);
			$in2=genForm($t2,$n2);
			$form=$in1.$in2.'<input type="submit" name="send1" value="login" width="35px">';
			return $form;
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

