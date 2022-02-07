<?php

session_start();

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>articles</title>
	<link rel="stylesheet" type="text/css" href="./public/css/blog.css">
</head>
<header>
<?php 
require_once 'menu.php';
require_once 'function.php';
require_once 'model.php';
require_once 'config/config.php';
$mydb=new myDb($server,$username,$password,$database);
$pdo=$mydb->getConn();

//__menu

$categories=new categories($pdo);
$categories=$categories->getAllCategories();
require_once 'menu.php';
$forms=menuSubNav($categories);
$menu=str_replace( "<span>categories</span>", $forms, $menu);
echo $menu;


$user=new user($pdo);		// get my user

if(!isset($_COOKIE['user'])){
	$sess=null;
	echo rightHeader($sess);
} else {
	$id=$_COOKIE['connected'];
	$row=$user->getRights($id);
	echo rightHeader($row['nom']);
}

if($_POST){
	switch($_POST):
		case isset($_POST['home']):
				$row=$user->getRights($id);
				setcookie('connected',$row['id'], -1);	
				setcookie('user', $row['nom'], time() +3600);
				session_destroy();
				header('location: index.php');
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

echo '<div id="articlemain">';
$article=new article($pdo);
$article=$article->getAllArticles();
$article=viewArticles($article,5);
$article=articleLayout($article);
echo $article;
$categories=new categories($pdo);
$categories=$categories->getAllCategories();
echo '</div>';
showCatNav($categories);



?>
	</main>
</body>
	<footer>
	</footer>
</html>