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

function rightHeader($cookie){
	echo '<div id="top_btns">';
	switch($cookie){
		case null:
			$header='<form action="" method="post"><input type="submit" name="subscribe" value="subscribe"/>
					 <input type="submit" name="login" value="login"/></form></div>';
			return $header;
			break;
		case 'utilisateur':
			$header='<form action="profil.php" method="post"><input type="submit" name="compte" value="account"/></form>
					 <form action="" method="post"><input type="submit" name="disconnect" value="disconnect"></input></form></div>';
			return $header;
			break;
		case 'moderateur':
		case 'administrateur':
			$header='<form action="profil.php" method="post"><input type="submit" name="profil" value="profil"/>
					 <form action="create.php" method="post"><input type="submit" name="create" value="create"/>
					 <form action="index.php" method="post"><input type="submit" name="disconnect" value="disconnect"/></form></div>';
			return $header;
			break;
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


// profile functions___________

function rightToPage($rights){			// ru
		switch ($rights):
			case 'utilisateur':
				require_once 'user.php';
			case 'moderateur':
				require_once 'moderateur.php';
			case 'administrateur':
				require_once 'administrateur.php';
		endswitch;
}

function showDetails($row){	
	echo '<div class="infolines"><h4><i>your personal informations:</i></h4><br>';
	echo '<span> welcome back <b>'.$row['login'].'</b></span><br>';
	echo '<span><i>your id: <b>'.$row['id'].'</b> </i></span><br>';
	echo '<span><i>you\'re now: <b>'.$row['nom'].'</b> </i></span><br><br>';
	echo '<div><form action="" method="post"><input type="submit" name="modify" value="modify" id="modifybtn"></input></form></div>';
	echo '</div>';
}

function showUserForm(){
	require_once 'inscription_form.php';
	return $subscribeform.'<form action="" method="post"><input type="submit" name="close" value="close" id="modifybtn"></input></form>';	
}


function showComments($row){
	echo '<div class="commentsprofile"><i>your latest comments:</i><br>';
	for ($i=0; $i <=isset($row[$i]); $i++) {
		echo '<div>';
		foreach($row[$i] as $k => $v){
			echo '<div class="scrolldiv">';
			if($k=='id_article'){
				echo '<span>&#160;&#160;&#160;</span><small>on article n.<b>'.$v.'</b></small><span>&#160;&#160;&#160;&#160;</span>';
			} elseif($k=='commentaire'){
				echo '<small>your comment: '.$v.'</small>';
			}
			echo '</div>';
		}
	echo '<button type="button" formmethod="post" name="edit" value="'.$row[$i]['id_article'].'" class="editbtn">edit</input>';
	echo '<button type="button" formmethod="post" name="delete" value="'.$row[$i]['id_article'].'" class="deletebtn">delete</input>';

	echo '</div>';
	}
	echo '</div>';
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
		echo '<h4><i>'.numToTextCategories($article[$i]['nom']).'</i></h4>';
		echo '<div class="authorname">'.textBeginning($article[$i]['article']).'</div>';
		echo '<p>'.textBeginning2($article[$i]['article']).'...</p>';
		echo '<h5><small><i>continue to read</i></small></td>';
	}
}


