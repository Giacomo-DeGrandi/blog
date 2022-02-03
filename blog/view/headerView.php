<?php

if(isset($_COOKIE['page'])){
	$title=$_COOKIE['page'];
} else {
	$title='home';
}

ob_start();

?>
<header>
	<br>
	<div id="menuwrapper">
		<div id="menu">
			<a href="index.php">menu</a>
			<div id="sub">
				<p>science</p>
				<p>music</p>
				<p>arts</p>
			</div>
		</div>
	</div>
	<br>
	<div id="top_btns">
		<?php echo $buttons ?>
	</div>
</header><br><br><br>
<?php

$header= ob_get_clean();