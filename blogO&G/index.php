<?php 

session_start();

require_once 'config/config.php';
require_once 'function.php';
require_once 'model.php';

$mydb=new myDb($server,$username,$password,$database);
$conn=$mydb->getConn();

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>bloX</title>
	<link rel="stylesheet" type="text/css" href="public/css/blog.css">
</head>
<header>
<?php 

require_once 'menu.php';

echo $menu;

if(!isset($_COOKIE['user'])){
	$sess=null;
	echo rightHeader($sess);
} else {
	echo rightHeader($_COOKIE['user']);
}

if(isset($_POST['disconnect'])){
				setcookie('connected',0, -1);	
				setcookie('user', null, -1);	
				setcookie('form', null, -1);
				session_destroy();
				session_write_close();
				header('location: index.php');
}

if($_POST){
	switch($_POST):
		case isset($_POST['subscribe']):
			setcookie('form','subscribe', time() +3600);
				header('location: inscription.php');
				exit();
				break;
		case isset($_POST['login']):
			setcookie('form','login', time() +3600);
			header('location: inscription.php');
				exit();
				break;

	endswitch;
}

?>
</header><br><br><br>
<body>
	<main>
<?php

$article=new article($conn);
$article=$article->getAllArticles();
viewArticles($article);
require_once 'categories_bar.php';
echo $catnav;

?>
	</main>
</body>
	<footer>
	</footer>
</html>