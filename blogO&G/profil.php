<?php

session_abort();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Porfil</title>
    <link rel="stylesheet" href="public/blog.css">
</head>
<body>

<?php

require ('config/config.php');
$bd = new myDb ($conn);
$conn = getConn (){
    $conn=$this->conn;
		return $conn;
}
if(isset($_SESSION['id'])){
    $conn = "SELECT * FROM utilisateurs WHERE id = ?";
    $req = mysqli_fetch_array($_SESSION['id']);
}
?>
<main>
    <h1>Mon Profil</h1>
<form action="" method="post">
<input type="text" name="login" value="<?php echo ?>" placeholder="Login">
<input type="password" name="password" value="" placeholder="Password">
<input type="email" name="email" value="" placeholder="Email">
<input type="submit" name="submit" value="Modifier">
</form>
</main>
    
</body>
</html>