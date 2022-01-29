<?php 

require_once 'func.sec.php';

private function subsInsc($login,$password,$email) {
	protected $password,$login,$email;
		if(secure1($password) and secure1($password)){
			$x=mysqli_real_escape_string(htmlspecialchars(trim($x)));
			return $x;
		} else {
			return 0;
		}
}

// article controller

function textBeginning($text){		//get just the beginning of the article as a title
	$text=substr($text,0,9).'...';
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

