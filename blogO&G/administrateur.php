<?php 

session_start();

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>administrateur</title>
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
$user= new user($pdo);

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
		case(isset($_POST['edit_user'])):
				$form=1;
				echo '<div class="fakemodal">';
				if($form==1){
					$user= new user($pdo);
					$user=$user->getAllInfo($_POST['edit_user']);
					echo '<small>modify user informations here</small><br><br>';
					$form=showUserForm();
					$form=str_replace('replaceme', 'administrateur.php', $form);
					$form=str_replace('placeholder="username"','placeholder="'.$user['login'].'"', $form);
					$form=str_replace('<input type="password" name="password" placeholder="password" required><br><br>',' ', $form);
					$form=str_replace('<input type="password" name="passwordconf" placeholder="confirm_password" required><br><br>','<input type="text" name="droits" placeholder="'.$user['id_droits'].'" required><br><br>',$form);
					$form=str_replace('placeholder="username"','placeholder="'.$user['login'].'"', $form);
					$form=str_replace('<input type="submit" name="send" placeholder="send" value="send" required><br><br>', '<button type="submit" name="send" placeholder="send" value="'.$user['id'].'" required>edit user</button><br><br>', $form);
					echo $form;
					echo '</div>';
				}
				if(isset($_POST['close'])){
					$form=0;
					header('location:administrateur.php');
				}
				exit();
				break;
		case isset($_POST['send']):
				if( testPost(isset($_POST['username']))&&
					isset($_POST['email'])&&
					filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)&&
					testPost(isset($_POST['droits'])) ){
							$login=$_POST['username'];
							$droits=$_POST['droits'];
							$email=$_POST['email'];
							$userpw=$user->getAllInfo($id);
							$password=$userpw['password'];
							$id=$_POST['send'];
							$user=$user->updateUser($login,$password,$email,$droits,$id);
						if($user===false){
							echo '<span class="fakemodal">This user already exists.<br>Please, choose another username</span>';
							header('location:administrateur.php');
						} else {
							echo '<span class="fakemodal">you\'ve succesfully updated this user informations</span>';
							header('location:administrateur.php');
						}
				}
				exit();
				break;
		case isset($_POST['delete_user']):
				echo '<span class="fakemodaltext2">are you sure you want to delete this user?<br><form action="administrateur.php" method="post"><button type="submit" name="yes" id="modifybtn" value="'.$_POST['delete_user'].'">yes, delete</button><button type="submit" name="close" value="close" id="modifybtn">no, go back</button></form>';
				exit();
				break;
		case isset($_POST['yes']):
				$id=$_POST['yes'];
				$user->deleteUser($id);
				header('location:administrateur.php');
				exit();
				break;
	endswitch;
}


?> 
    <!--#Nous allons reproduire le même système, vérifier si on reçois les variables post de titre et de contenu. 
    #Si c’est le cas, nous allons lancer les fonctions qui ajoutent l’article à la base de donnée et 
    #afficher un message comme quoi l’article as bien été enregistré
    #Ici onécrit le code que l'administrateur verras
 {  # Dans cette partie, on écrit le code que l'utilisateur administrateur verras !-->

</header>
<body>
	<main>
    <p>Bienvenue, vous êtes connecté</p><br>
    <p>Vous pouvez modifier les information utilisateurs ici:</p><br>
 
<?php


//AFFICHAGE DES MEMBRES, SUPPRESION DES MEMBRES

$conn=$mydb->getConn();
$recupUsers = $conn -> query('SELECT * FROM utilisateurs') ;
while ($user = $recupUsers -> fetch()){
	   // var_dump($user);
	echo '<div>';
    echo '<span><h3> username: '.$user['login'].'</h3>&#160;</span>';
    echo '<span> id: '.$user['id'].'&#160;</span>';
    echo '<span> droits: '.$user['id_droits'].'&#160;</span>';
    echo '<span> droits: '.$user['email'].'&#160;</span>';	
    echo '<form method="post"><button type="submit" name="edit_user" id="modifybtn" value="'.$user['id'].'">edit</button><button type="submit" name="delete_user" id="modifybtn" value="'.$user['id'].'">delete</input></form>';
    echo '</div>';
}


?>
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