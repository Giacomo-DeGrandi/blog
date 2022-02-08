<?php 

session_start();
if(!$_SESSION['password']){
	header('Location: connexion.php');
}
include 'config/config.php';

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

if(!isset($_SESSION['user'])){
	$sess=null;
	echo rightHeader($sess);
} else {
	rightHeader($sess);
}

?>
</header>
<body>
	<main>
<?php

$article=new article($conn);
$article=$article->getAllArticles();
viewArticles($article);


?>
	</main>
</body>
</html>