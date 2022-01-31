<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>my blog</title>
	<link rel="stylesheet" type="text/css" href="view/blog.css">
</head>
<?php 

include '/controllers/controllers.php';


require_once './main_header.index.php';

?>
<body>
	<main>
		<h1>bloX</h1>
<?php

require_once './models/article.class.php';

// connect to db

$db= new myDb($server,$username,$password,$database);
$conn=$db->getConn();

?>
<h2>latest articles</h2>

<?php 

$article=new article($conn);	//instantiate new article

$article=$article->getAllarticles();	// get all 


// print calling article view

require_once './view/article.view.php';

?>
<br><br><br>
	<span> want to <form formmethod="post"><input type="submit" name="subscribe" value="collab">?</input></form></span>
	</main>
</body>
<?php 

require './view/footers/footer.view.php';

?>