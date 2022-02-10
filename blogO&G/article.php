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
						echo $list;
					}
					if(isset($_POST['close'])){
						$form=0;
						header("Refresh:0");
					}
				}
			}
			exit();
			break;			
		case isset($_POST['articletext'])&&
			 isset($_POST['categorieslist'])&&
			 isset($_POST['sendarticle']):
				$categories=new categories($pdo);
				$user=new user($pdo);
				$articletext=$_POST['articletext'];
				$id_utilisateur=$_COOKIE['connected'];
				$id_categories=$_POST['categorieslist'];
				$idcat=$categories->nomToNum($id_categories);
				$user=$user->addArticle($id_utilisateur,$idcat,$articletext);
			break;
		case isset($_POST['submitcomment']):
				if(testPost($_POST['comment'])===true){
					$commentaire=new comments($pdo);
					$id_article=$_GET['id'];
					$id_user=$_COOKIE['connected'];
					$comment=$_POST['comment'];
					$date = date("Y-m-d H:i:s");
					$commentaire->addCommentsFromArt($comment,$id_user,$id_article,$date);
				}
	endswitch;
}


?>
</header><br><br><br>
<body>
	<main id="onearticmain">
<?php


echo '<div id="articlemain">';
$article=new article($pdo);
$id_article=$_GET['id'];
$article=$article->getOneArticle($id_article);
echo viewOneArticle($article);
if(isset($_COOKIE['connected'])){
	$id_user=$_COOKIE['connected'];
}
if(!empty($id_user)){
	$row=$user->getRights($id_user);
	if($row[0]['id']==$id_user){
		echo '<form method="post"><input type="submit" name="editarticle" value="'.$id_article.'"/></form>';
	}
}
$comments=new comments($pdo);
$comments=$comments->getCommentsByArticle($id);
echo '<span><br><br><br></span>'; // some space
echo '<div class="commentswrapper">';
if(isset($_COOKIE['connected'])){
	$cookie=$_COOKIE['connected'];
} else { $cookie=null;}
echo commentsForm($cookie);
if(!empty($comments)){
echo showCommentsOnArticles($comments);
echo '</div>';
}
echo '</div>';
$categories=new categories($pdo);
$categories=$categories->getAllCategories();
showCatNav($categories);
echo '</div>';


?>
	</main>
</body>
	<footer>
		<div id="ourfooter">
			<div id="logogit">
				<img src="gitlogo.png" alt="gitlogoomar" width="40px" height="40px" >
				<div id="subfoot">
					<a href="https://github.com/Omar-Diane">Omar</a>
					<a href="https://github.com/Giacomo-DeGrandi">Giak</a>
				</div>
			</div>
		</div>
	</footer>
</html>