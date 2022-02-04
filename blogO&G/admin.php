<?php

session_start();

if (isset($_POST['password'])) { #Si la variable mot de passe existe
    if ($_POST['password'] == 'marseille') {
        $_SESSION['connect'] = true;
    }
    else {
        $_SESSION['connect'] = false;
        echo " AIE ! Mauvais mot de passe";
    }
}
 
if(isset($_SESSION['connect']) or $_SESSION['connect'] == false) { #On vérifie que l'utilisateur n'est pas connecté
    ?>
    <p> Vous n'êtes pas connecté, veuillez taper le mot de passe </p>
    <input type="password" name="password">
    <input type="submit" />

    <?php
    #Nous allons reproduire le même système, vérifier si on reçois les variables post de titre et de contenu. 
    #Si c’est le cas, nous allons lancer les fonctions qui ajoutent l’article à la base de donnée et 
    #afficher un message comme quoi l’article as bien été enregistré
    #Ici onécrit le code que l'administrateur verras
} else { # Dans cette partie, on écrit le code que l'utilisateur administrateur verras
    ?>
 
    <p>Bienvenue, vous êtes connecté</p>
    <p>Vous pouvez créer un nouvel article en remplissant le formulaire ci-dessous</p>
 
    <?php
    require 'article.php';
    if (isset($_POST['titre']) and isset($_POST['contenu'])) {
        $art = new article();
        $art->new_article($_POST['titre'], $_POST['contenu']);
        echo "l'article as bien été ajouté";
    }
    ?>
    <form method="post" action="admin.php">
        <input type="text" placeholder="titre" name="titre" />
        <textarea placeholder="contenu" name="contenu"></textarea>
        <input type="submit" />
    </form>
 
 
 
 
    <?php
}
?>