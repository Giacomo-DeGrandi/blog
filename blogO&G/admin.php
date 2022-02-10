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

    <?php
    #Nous allons reproduire le même système, vérifier si on reçois les variables post de titre et de contenu. 
    #Si c’est le cas, nous allons lancer les fonctions qui ajoutent l’article à la base de donnée et 
    #afficher un message comme quoi l’article as bien été enregistré
    #Ici on écrit le code que l'administrateur verras
 {  # Dans cette partie, on écrit le code que l'utilisateur administrateur verras
    ?>
 
    <p>Bienvenue, vous êtes connecté</p>
    <p>Vous pouvez créer un nouvel article en remplissant le formulaire ci-dessous</p>
 
    <?php
    //CREATION, MODIFICATION, SUPPRESION D'ARTICLES
    require 'article.php';
    if(isset($_POST['envoyer'])){
        if(!empty($_POST['titre']) AND !empty($_POST['contenu'])){
            $insertArt = $conn -> prepare('INSERT INTO articles(titre,contenu) VALUES (?, ?');
            $insertArt = $conn -> execute(array($titre, $contenu));

            echo "Article bien ajouté";
        } else {
            echo 'Veuillez compléter tous les champs';
        }
    }

    ?>
    <form method="post" action="">
        <input type="text" placeholder="titre" name="titre" />
        <textarea placeholder="contenu" name="contenu"></textarea>
        <input type="submit" name="envoyer" />
    </form>
    <?php
    //AFFICHAGE DES MEMBRES, SUPPRESION DES MEMBRES
    $conn=$mydb->getConn();
    $recupUsers = $conn -> query('SELECT * FROM utilisateurs') ;
    while ($user = $recupUsers -> fetch()){
        echo $user['login'];
        echo $user['password']; 
    }


    ?>
    <a href="bannir.php?id=<?= $user['id']; ?>" style="color:red;
    text-decoration: none;">Bannir le membre</a> 


  <?php
//MAINTENANT ON PASSE A LA MODIFICATION DE L'UTILISATEUR
if(!empty($_POST['login'])and
!empty($_POST['password'])and
!empty($_POST['email'])and
!empty($_POST['id'])){

    if(isset($_POST['submit'])){
     $login = $_POST['login'];
     $password = $_POST['password'];
     $email = $_POST['email'];
     $id = $_POST['id'];
     $updateutil = $conn -> prepare("UPDATE utilisateurs SET login='$login', password='$password', email='$email' WHERE id='$id'");
     $updateutil = $conn -> execute(array($login, $password, $email));
     header('location: admin.php');

    }
}
?>
<form class="box" action="" method="post">
    <h1 class="box-title">Update user</h1>
    <input type="text" name="login" placeholder="Login" required />
    <input type="password" name="password" placeholder="Mot de passe" required />
    <input type="text" name="email" placeholder="Email" required />  
      <h2>Choisir un id pour changer les informations de l'utilisateur</h2>
      <input type="text" name="id" placeholder="Choisis un id">
      <input type="submit" name="submit" value="Modifier" />
  </form>


<?php
}
?>