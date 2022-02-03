<?php

function rightHeader($sess){
	switch($sess){
		case null:
			$header='<a href="forms.php/?action=login">login</a><a href="forms.php/?action=subscribe">subscribe</a>';
			return $header;
		case 'user':
			$header='<a href="forms.php/?action=login">account</a><a href="forms.php/?action=subscribe">disconnect</a>';
			return $header;
		case 'mod':
			$header='<a href="forms.php/?action=login">create</a><a href="forms.php/?action=login">account</a><a href="forms.php/?action=subscribe">disconnect</a>';
			return $header;
		case 'admin':
			$header='<a href="forms.php/?action=login">create</a><a href="forms.php/?action=login">account</a><a href="forms.php/?action=login">admin</a>
			<a href="forms.php/?action=subscribe">disconnect</a>';
			return $header;
	} 

}
 

 // article controller

function textBeginning($text){		//get just the beginning of the article as a title
	$text=substr($text,0,15);
	return $text;
}
function textBeginning2($text){		//get just the beginning of the article as a title
	$text=substr($text,0,350);
	return $text;
}

function numToTextCategories($id_categories){		//get just the beginning of the article as a title
	switch($id_categories){
		case 1:
			$category='science';
			return $category;
		case 2:
			$category='music';
			return $category;			
		case 3:
			$category='arts';
			return $category;
	}
}


function viewArticles($article){
		for($i=0;$i<3;$i++){
		echo '<tr><td><h2>'.$article[$i]['login'].'</h2>';
		echo '<h4><i>'.numToTextCategories($article[$i]['id_categorie']).'</i></h4>';
		echo '<h5>'.textBeginning($article[$i]['article']).'<h5></td>';
		echo '<h5>'.textBeginning2($article[$i]['article']).'<h5></td>';
		echo '<h5><small><i>continue to read</i></small></td>';
	}
}


