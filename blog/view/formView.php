<?php

ob_start();

?>	
<div id="formdiv">
	<form action="" method="post">
		<?php echo $form ?>
	</form>
</div>
<?php

$content=ob_get_clean();