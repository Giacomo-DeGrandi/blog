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

echo $menu;		// print my menu

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

if(isset($_POST['modify'])){
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
} 

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

?>
	</div>
	<br>
	<div class="profile">
		<div class="blocksm">
		<span><br>num3</span>
		</div>
		<div class="blocksm">
		<span><br>num4</span>
		</div>
	</div>
	</main>
</body>
</html>