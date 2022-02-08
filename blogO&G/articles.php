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
				setcookie('user', $row['nom'], time() +36000);
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
				setcookie('form','subscribe', time() +36000);
				header('location: inscription.php');
				exit();
				break;
		case isset($_POST['login']):
				setcookie('form','login', time() +36000);
				header('location: inscription.php');
				exit();
				break;
		case isset($_POST['create']):
			$form=1;
			$user=new user($pdo);
			if(isset($_COOKIE['connected'])){
				$id=$_COOKIE['connected'];
				$row=$user->getRights($id);
				if($row['nom']==='administrateur'||$row['nom']==='moderateur'){ 
					echo '<div class="fakemodaltext2">';
					if($form==1){
						require_once 'creer-article.php';
						$list=catList($categories,$create);
						if( testPost(isset($_POST['sendarticle']))&&
							testPost(isset($_POST['articletext']))&&
							isset($_POST['categorieslist'])	){
								$articletext=$_POST['articletext'];
								$id_utilisateur=$_COOKIE['connected'];
								$id_categories=$categories->nomToNum($_POST['categorieslist']);
								var_dump($user);
								$article=$user->addArticleFromProfile($id_utilisateur,$id_categories,$articletext);
						}
						echo $list;
					}
					if(isset($_POST['close'])){
						$form=0;
						header("Refresh:0");
					}
				}
			}
	endswitch;
}

?>
</header><br><br><br>
<body>
	<main>
<?php



echo '<div id="articleid">';
$article=new article($pdo);
$count=$article->totalNum();
$articles=$article->getAllArticles();
$articlealias=$articles;
if($_GET){
	switch ($_GET):
		case !isset($_GET['start']):
			$k=0;
			$articles=viewAllArticles($articles,$k);
			break;
		case isset($_GET['start']):
			$k=$_GET['start'];
			$articles=viewAllArticles($articles,$k);
			break;
	endswitch;
	if(isset($_GET['categories'])){
		$k=0;
		$cat=$_GET['categories'];	
		$articles=viewCatArticles($articlealias,$k,$cat);
	}
} 
$article=articleLayout($articles);
echo $article;
echo '<small><i>total num of articles on this site: '.$count.'</i></small>';
echo articlesPages($count);
$categories=new categories($pdo);
$categories=$categories->getAllCategories();
echo '</div>';
showCatNav($categories);

?>
	</main>
</body>
	<footer>
		<div id="ourfooter">
			<a href="https://github.com/Giacomo-DeGrandi"><br><img src="gitlogo.png" alt="gitlogodeg"> git G</a>
			<a href="https://github.com/Omar-Diane"><img src="gitlogo.png" alt="gitlogoomar"> git O</a>
		</div>
	</footer>
</html>