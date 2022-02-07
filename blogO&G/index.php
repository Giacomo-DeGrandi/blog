<?php 

session_start();

require_once 'config/config.php';
require_once 'function.php';
require_once 'model.php';

$mydb=new myDb($server,$username,$password,$database);
$pdo=$mydb->getConn();

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
		case isset($_POST['disconnect']):
				setcookie('connected',0, -1);	
				setcookie('user', null, -1);	
				setcookie('form', null, -1);
				session_destroy();
				session_write_close();
				header('location: index.php');
				exit();
				break;

	endswitch;
}

?>
</header><br><br><br>
<body>
	<main>
<?php

$article=new article($pdo);
$article=$article->getAllArticles();
echo '<table>';
$table=viewArticles($article,3);
echo $table;
echo '</table>';
$categories=new categories($pdo);
$categories=$categories->getAllCategories();
showCatNav($categories);

?>
	</main>
</body>
	<footer>
	</footer>
</html>