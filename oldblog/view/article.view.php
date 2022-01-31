<?php 

function viewArticles($i,$article){

		echo 
		for($i=0;$i<3;$i++){

		echo '<td><h2>'.$article[$i]['login'].'</h2>';
		echo '<h4><i>'.numToTextCategories($article[$i]['id_categorie']).'</i></h4>';
		echo '<h5>'.textBeginning($article[$i]['article']).'<h5><small><i>continue to read</i></small></td>';
		echo '</tr></table>';
	}

}



