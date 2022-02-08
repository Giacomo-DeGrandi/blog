<?php 

session_start();

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>profile</title>
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
				header('location:index.php');
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
		case(isset($_POST['modify'])):
			$form=1;
			echo '<div class="fakemodal">';
			if($form==1){
				echo '<small>update your personal <br>informations here</small>';
				$form=showUserForm();
				echo $form;
				echo '</div>';
				echo '<style> #infoblock{ background-color:var(--black); opacity:0.3; .fakemodal{ opacity:1;}}</style>';
			}
			if(isset($_POST['close'])){
				$form=0;
				header('location:profil.php');
			}
	endswitch;
}

?>
</header><br><br><br>
<body>
	<main>
	<div class="profile">
<?php 

if(isset($_COOKIE['connected'])){
	$id=$_COOKIE['connected'];
	$row=$user->getRights($id);
	echo '<div id="infoblock">';
	showDetails($row);
	echo '</div>';
	$commentsrow=$user->getComments($id);
	if($commentsrow!=null){
	echo '<div id="mainprofile">';
	showComments($commentsrow);
	echo '</div>';
	} else {	
	echo '<div id="mainprofile">';
	echo '</div>';
	}

} // remember header location if !isset 


if( testPost(isset($_POST['username']))&&
	testPost(isset($_POST['password']))&&
	isset($_POST['email'])&&
	filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)&&
	testPost(isset($_POST['passwordconf']))&&
	testPost($_POST['password'])===testPost($_POST['passwordconf'])&&
	(isset($_POST['send'])) ){
			$id=$_COOKIE['connected'];
			$login=$_POST['username'];
			$password=$_POST['password'];
			$email=$_POST['email'];
			$row=$user->getRights($id);
			$id_droits=$row['id_droits']; //int cause in bd int id
			$user=$user->updateUser($login,$password,$email,$id_droits,$id);
		if($user===false){
			echo 'This user already exists.<br>Please, choose another username ';
		} else {
			echo '<span class="fakemodal">you\'ve succesfully updated your informations</span>';
			header("Refresh:2; url=profil.php");
		}
}

echo '</div><br>';

?>
	<div class="mod">
		<div class="blocksm">
			<h2>write a new article here:</h2>
			<form action="" method="post">
			<button type="submit" name="write_article" value="send" id="write">write</button></form><br>
<?php

if(isset($_COOKIE['connected'])){
	$id=$_COOKIE['connected'];
	$row=$user->getRights($id);
	if($row['nom']==='administrateur'||$row['nom']==='moderateur'){ 
		if(isset($_POST['write_article'])||isset($_POST['create'])){
			$form=1;
			echo '<div class="fakemodaltext">';
			if($form==1){
				require_once 'creer-article.php';
				$list=catList($categories,$create);
				if( testPost(isset($_POST['sendarticle']))&&
					testPost(isset($_POST['articletext']))&&
					isset($_POST['categorieslist'])	){
						$categories=new categories($pdo);
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
				header('location:profil.php');
			}
		}
	} else {
		echo '<small>you need to be a moderator or administrator to write articles</small>';
		echo '<style> #write{ background-color:var(--black); opacity:0.3; .fakemodal{ opacity:1;}}</style>';
	}
}

?>
		</div>
		<div class="blocksm">
		<span><br></span>
		</div>
	</div>
	<div class="admin">
<?php require_once 'administrateur.php'; ?>
	</div>
	</div>
	</main>
</body>
	<footer>
		<div id="ourfooter">
			<img src="./gitlogo.png" alt="gitlogoomar" width="40px" height="40px">
			<div id="sub">
					<div class="menuwrapper">
						<a href="https://github.com/Giacomo-DeGrandi"> git G</a>
						<a href="https://github.com/Omar-Diane"> git O</a>
					</div>
				</div>
			</div>
		</div>
	</footer>
</html>