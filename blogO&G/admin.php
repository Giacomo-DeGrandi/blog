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
    #Ici onécrit le code que l'administrateur verras
 {  # Dans cette partie, on écrit le code que l'utilisateur administrateur verras
    ?>
 
    <p>Bienvenue, vous êtes connecté</p>
    <p>Vous pouvez créer un nouvel article en remplissant le formulaire ci-dessous</p>
 
    <?php
    require 'article.php';
    if (isset($_POST['titre']) and isset($_POST['contenu'])) {
        $art = new article();
        $art->new_article($_POST['titre'], $_POST['contenu']);
        echo "L'article as bien été ajouté";
    }
    ?>
    <form method="post" action="admin.php">
        <input type="text" placeholder="titre" name="titre" />
        <textarea placeholder="contenu" name="contenu"></textarea>
        <input type="submit" />
    </form>
    <?php
    //AFFICHAGE DES MEMBRES
    $conn=$mydb->getConn();
    $recupUsers = $conn -> query('SELECT * FROM utilisateurs') ;
    while ($user = $recupUsers -> fetch()){
        echo $user['login'];
        echo $user['password'];
    }
    ?>

<?php
}
?>