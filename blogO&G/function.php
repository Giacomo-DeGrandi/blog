<?php

// funcsec _____

function testPost ($post){
	if(isset($post)&&!empty($post)&&ctype_alnum($post)&&filter_var($post, FILTER_SANITIZE_STRING)){
		return true;
	} else {
		return '<span>please insert a valid input and fill in all the fields</span>';
	}
}

// header function______

function rightHeader($sess){
	echo '<div id="top_btns">';
	switch($sess){
		case null:
			$header='<form action="" method="post"><input type="submit" name="subscribe" value="subscribe"/>
					 <input type="submit" name="login" value="login"/></form></div>';
			return $header;
		case 'user':
			$header='<form action="profil.php" method="post"><input type="submit" name="compte" value="account"/></form>
					 <form action="index.php" method="post"><input type="submit" name="disconnect" value="disconnect"/></form></div>';
			return $header;
		case 'mod':
			$header='<form action="profil.php" method="post"><input type="submit" name="profil" value="profil"/>
					 <form action="create.php" method="post"><input type="submit" name="create" value="create"/>
					 <form action="index.php" method="post"><input type="submit" name="disconnect" value="disconnect"/></form></div>';
			return $header;
		case 'admin':
			$header='<form action="profil.php" method="post"><input type="submit" name="subscribe" value="subscribe"/>
					 <form action="create.php" method="post"><input type="submit" name="create" value="create"/>
					 <form action="admin.php" method="post"><input type="submit" name="admin" value="admin"/>
					 <form action="index.php" method="post"><input type="submit" name="disconnect" value="disconnect"/></form></div>';
			return $header;
	}
}

// forms function________



function rightForm($sess){
		switch ($sess){
			case 'subscribe':
				require_once 'inscription_form.php';
				return $subscribeform;
			case 'login':
				require_once 'login_form.php';
				return $loginform;
	}

}


 // article controller__________

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
		echo '<h5>'.textBeginning($article[$i]['article']).'</h5>';
		echo '<p>'.textBeginning2($article[$i]['article']).'</p>';
		echo '<h5><small><i>continue to read</i></small></td>';
	}
}


