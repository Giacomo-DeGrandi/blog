<?php

ob_start();

?>
	<br>
		<div id="menuwrapper">
			<div id="menu">
				<form action="" method="post">
				<input type="submit" name="home" value="home"/>
				</form>
				<div id="sub">
					<p>science</p>
					<p>music</p>
					<p>arts</p>
					<form action="articles.php" method="get">
						<button type="submit" name="articles" value="articles">articles</button>
					</form>
				</div>
			</div>
		</div>
		<br>
<?php 

$menu=ob_get_clean();

