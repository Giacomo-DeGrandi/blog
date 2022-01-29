
<header>
<?php 

require_once './models/model.db.php';
require_once './controllers/header.controller.php';

?>
	<br>
	<div id="menuwrapper">
		<div id="menu">
			<p>menu</p>
			<div id="sub">
				<p>science</p>
				<p>music</p>
				<p>arts</p>
			</div>
		</div>
	</div>
	<br>
	<div id="top_btns">
		<span>
			<form formmethod="post" class="headerbtn">
				<input type="submit" name="subscribe" value="subscribe">
				</input>
			</form>
		</span>
		<span>
			<form formmethod="post" class="headerbtn">
				<input type="submit" name="login" value="login">
				</input>
			</form>
		</span>
	</div>
<?php



?>
</header>
<br><br><br>
