<?php 

session_start();


include 'config/config.php';

require_once 'model.php';

$mydb=new myDb($server,$username,$password,$database);
$mydb->getConn();

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>blox</title>
	<link rel="stylesheet" type="text/css" href="blog.css">
</head>
<header>
<?php	require_once 'header.php';

	if(!$_SESSION['user']){
		
	}
	
?>
</header>
<body>
<?php




?>
</body>
</html>