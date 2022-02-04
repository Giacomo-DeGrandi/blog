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

echo $menu;

if(!isset($_SESSION['user'])){
	$sess=null;
	echo rightHeader($sess);
} else {
	echo rightHeader($sess);
}

?>
</header><br><br><br>
<body>
	<main>
		<h1><? if(isset($_COOKIE['form']){echo $_COOKIE['form'];} ?></h1>
<?php 


if($_POST){
	switch($_POST):
		case isset($_POST['home']):
				setcookie('form', null, -1, '/');
				header('location:index.php');
				exit();
				break;
		case isset($_POST['login']):
				setcookie('form', null, -1, '/');
				setcookie('form','login', time() +3600);
				header('location: inscription.php');
				exit();
				break;
		case isset($_POST['subscribe']):
				setcookie('form', null, -1, '/');
				setcookie('form','subscribe', time() +3600);
				header('location: inscription.php');
				exit();
				break;
	endswitch;
}

if(isset($_COOKIE['form'])){
	echo rightForm($_COOKIE['form']);
}

if( testPost(isset($_POST['username']))&&
	testPost(isset($_POST['password']))&&
	isset($_POST['email'])&&
	filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)&&
	testPost(isset($_POST['passwordconf']))&&
	testPost($_POST['password'])===testPost($_POST['passwordconf'])&&
	(isset($_POST['send'])) ){
			include 'config/config.php';
			$mydb=new myDb($server,$username,$password,$database);
			$pdo=$mydb->getConn();
			$login=$_POST['username'];
			$password=$_POST['password'];
			$email=$_POST['email'];
			$id_droits=1; //int cause in bd int id
			$user= new user($login,$password,$email,$id_droits);
			$user=$user->subscribeUser($pdo);
		if($user===false){
			echo 'This user already exists. Please, log in to get access to your account';
		} else {
			echo 'Thanks! You\'re subscription is complete, you\'ll be redirected to the login page.';
			setcookie('form', null, -1, '/');
			setcookie('form','login', time() +3600);
			header( "refresh:3;url=inscription.php" );
		}
} else {
	echo '<span>Please fill in all the fields</span>';
}


?>
	</main>
</body>
</html>