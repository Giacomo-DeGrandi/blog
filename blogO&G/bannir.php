<?php
session_start();
include 'config/config.php';

$mydb=new myDb($server,$username,$password,$database);
$conn=$mydb->getConn();

if(isset($_GET['id']) AND !empty($_GET['id'])){
    $getid = $_GET['id']
    $recupUsers = $conn -> prepare('SELECT * FROM utilisateurs WHERE id = ?');
    $recuUsers -> execute(array($_GET['id']));
    if($recupUsers -> rowCount()>0){
        
        $bannirUsers = $conn -> prepare('DELETE FROM utilisateurs WHERE id = ?');
        $bannirUsers  -> execute(array($_GET['id']));

        header('Location: admin.php');
    }else{
        echo "Aucun membre trouvé";
    }
}else{
    echo "Identifiant non récupérer";
}
?>