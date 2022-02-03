<?php

ob_start();

?>
<h2>latest articles</h2>
	<table id="main_article_view">
		<?php   viewArticles($article); ?>
	</table>
<br>
<?php

$content= ob_get_clean();