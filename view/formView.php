<?php

ob_start();

?>
	<form action="" method="post">
		<input type="text" name="login" placeholder="login" pattern="[A-Za-z]*" required><br><br>
		<input type="password" name="password" placeholder="password" minlength="9" required><br><br>
		<input type="password" name="passwordconf" placeholder="confirm_password" required><br><br>
		<input type="submit" name="subscribe" value="subscribe">
	</form>
<?php

$content=ob_get_clean();