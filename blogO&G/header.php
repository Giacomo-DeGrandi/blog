<? ob_start(); ?>
<a href="index.php/?action=login">login</a>
<a href="index.php/?action=subscribe">subscribe</a>
<?  $vis_header=ob_get_contents(); 
	ob_start(); ?>
<a href="index.php/?action=login">account</a>
<a href="index.php/?action=login">disconnect</a>
<?  $user_header=ob_get_contents();
	ob_start(); ?>
<a href="index.php/?action=subscribe">create</a>
<?  $mod_header=ob_get_contents().$user_header;
	ob_start(); ?>
<a href="index.php/?action=subscribe">admin</a>
<?  $admin_header=ob_get_contents().$user_header.$mod_header;
