<?php 

ob_start();

?>
<div class="catnav">
	<a href="articles.php" id="music"><h2>music</h2></a>&#160;&#160;&#160;
	<a href="articles.php" id="science"><h2>science</h2></a>&#160;&#160;&#160;&#160;
	<a href="articles.php" id="arts"><h2>arts</h2></a>&#160;&#160;&#160;
</div>
<?php 

$catnav=ob_get_clean();