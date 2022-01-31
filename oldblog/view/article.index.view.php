<?php 

require_once './models/article.class.php';

// connect to db

$db= new myDb($server,$username,$password,$database);
$conn=$db->getConn();

$article=new article($conn);	//instantiate new article

$article=$article->getAllarticles();	// get all 

// print calling article controller


$content=viewArticles($article);

