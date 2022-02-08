<?php 

session_start();

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>subscribe</title>
	<link rel="stylesheet" type="text/css" href="public/css/blog.css">
</head>
<header>
<?php 

require_once 'menu.php';
require_once 'function.php';
require_once 'model.php';
require_once 'config/config.php';
$mydb=new myDb($server,$username,$password,$database);
$pdo=$mydb->getConn();

//menu___

$categories=new categories($pdo);
$categories=$categories->getAllCategories();
require_once 'menu.php';
$forms=menuSubNav($categories);
$menu=str_replace( "<span>categories</span>", $forms, $menu);
echo $menu;	// print my menu

if(!isset($_COOKIE['user'])){
	$sess=null;
	echo rightHeader($sess);
} else {
	echo rightHeader($_COOKIE['user']);
}


?>
</header><br><br><br>
<body>
	<main>
<?php 


if($_POST){
	switch($_POST):
		case isset($_POST['home']):
				setcookie('form', null, -1);
				session_destroy();
				header('location:index.php');
				exit();
				break;
		case isset($_POST['login']):
				setcookie('form','login', time() +36000);
				header('location: inscription.php');
				exit();
				break;
		case isset($_POST['subscribe']):
				setcookie('form','subscribe', time() +36000);
				header('location: inscription.php');
				exit();
				break;
		case isset($_POST['disconnect']):
				setcookie('user', 0, -1);
				setcookie('connected', 0, -1);
				session_destroy();
				session_write_close();
				header('location: index.php');
				exit();
				break;
	endswitch;
}

if(isset($_COOKIE['form'])){
	echo rightForm($_COOKIE['form']);
} 

$user=new user($pdo); 	// get my user class

if( testPost(isset($_POST['username']))&&
	testPost(isset($_POST['password']))&&
	isset($_POST['email'])&&
	filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)&&
	testPost(isset($_POST['passwordconf']))&&
	testPost($_POST['password'])===testPost($_POST['passwordconf'])&&
	(isset($_POST['send'])) ){
			$login=$_POST['username'];
			$password=$_POST['password'];
			$email=$_POST['email'];
			$id_droits=1; //int cause in bd int id
			$user=$user->subscribeUser($login,$password,$email,$id_droits);
		if($user===false){
			echo 'This user already exists.<br>Please, choose another username or log in <br> to get access to your account';
		} else {
			echo '<span class="fakemodal">Thanks! You\'re subscription is complete, you\'ll be redirected to the login page.</span>';
			setcookie('form','login', time() +36000);
			header( "refresh:2;url=inscription.php" );
		}
} else {
	echo '<span>Please fill in all the fields</span>';
}
if(isset($_POST['connect'])||isset($_POST['password_conn'])){ 
	if( testPost(isset($_POST['connect']))&&
		testPost(isset($_POST['password_conn']))){
				$login=$_POST['connect'];
				$password=$_POST['password_conn'];
				$row=$user->connect($login,$password,$user);
				if(!empty($row)){
					echo '<span class="fakemodal">succesfully connected. Hi <b>'.$login.'<b></span>';
					setcookie('user','user', time() +36000);	
					setcookie('connected',$row['id'], time() +36000);				
					header( "refresh:1.5;url=profil.php" );
				} else {
					echo '<span>Incorrect username or password</span>';
				}
	}
}

?>
	</main>
</body>
	<footer>
		<div id="ourfooter">
			<a href="https://github.com/Giacomo-DeGrandi"><img src="/pictures/githublogo.png"> git G</a>
			<a href="https://github.com/Giacomo-DeGrandi">git O</a>
		</div>
	</footer>
</html>