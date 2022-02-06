<?php

//Connexion à la base de donnée
require ('config/config.php');
require_once('model.php');
$bd = new myDb ($server, $username, $password, $database);
$conn = getConn();

if(isset($_SESSION['id'])){
    $conn = "SELECT * FROM utilisateurs WHERE id = ?";
    $req = mysqli_fetch_array($_SESSION['id']);

    if(isset($_POST['newlogin']) AND !empty($_POST['newlogin']) AND $_POST['newlogin'] != $user['login']){
        //Maintenant je fais une requête SQL.
        //Important de préciser l'id sinon tout les logins de chaque utilisateur dans la base de donnée seront mis à jour.
        $insertlogin = $conn->prepare("UPDATE utilisateurs SET login = ? WHERE id = ?");
        $insertlogin = execute(array($newlogin, $_SESSION['id']));
    }

    if(isset($_POST['newpassword']) AND !empty($_POST['newpassword']) AND $_POST['newpassword']){
        $insertpassword = $conn->prepare("UPDATE utilisateurs SET password = ? WHERE id = ?");
        $insertpassword = execute(array($newpassword, $_SESSION['id']));
    }

    if(isset($_POST['newemail']) AND !empty($_POST{'newemail'} AND $_POST{'newemail'} != $user['email'])){
        $insertemail = $conn->prepare("UPDATE utilisateurs SET email = ? WHERE id = ?");
        $insertemail = execute(array($newemail, $_SESSION['email']));
    }
}
?>
<main>
    <h1>Mon Profil</h1>
<form action="" method="post">
    <label> Login :</label>
<input type="text" name="login" value="<?php echo $user['login']; ?>" placeholder="Login">
<label> Password :</label>
<input type="password" name="password" value="" placeholder="Password">
<label> Email :</label>
<input type="email" name="email" value="<?php echo $user['email']; ?>" placeholder="Email">
<input type="submit" name="submit" value="Modifier">
</form>
</main>
    
</body>
</html>