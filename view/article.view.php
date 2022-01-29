<?php 

// some html for article view
?>
<table id="main_article_view">
	<tr>
<?php 

require_once './controllers/controllers.php';

for($i=0;$i<3;$i++){

	echo '<td><h2>'.$article[$i]['login'].'</h2>';
	echo '<h4><i>'.numToTextCategories($article[$i]['id_categorie']).'</i></h4>';
	echo '<h5>'.textBeginning($article[$i]['article']).'<h5></td>';
	echo '</tr>';
}

?>
</table>
