<?php
session_start();

include 'config/config.php';

require_once 'function.php';
require_once 'model.php';

$mydb=new myDb($server,$username,$password,$database);
$conn=$mydb->getConn();

if(isset($_POST['envoyer'])){
    if(!empty($_POST['username']) AND !empty($_POST['password'])){
       $username_par_defaut = "admin";
       $password_par_defaut = "admin123";

       $username_saisi = htmlspecialchars($_POST['username']);
       $password_saisi = htmlspecialchars($_POST['password']);

       if($username_saisi == $username_par_defaut AND $password_saisi == $password_par_defaut){
           header ('Location:admin.php');
        
       }else {
           echo'Mot de passe ou login incorrecte';
       }
    }else {
        echo "Remplis tous les champs";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace administration</title>
</head>
<body>
    <main>
        <form action="" method="post">
            <input type="text" name="username">
            <input type="password" name="password">
            <input type="submit" name="envoyer">
        </form>
    </main>
</body>
</html>