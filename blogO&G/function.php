<?php

// funcsec _____


function testPost ($post){
	if(isset($post)&&!empty($post)&&filter_var($post, FILTER_SANITIZE_STRING)){
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
			$header='<form action="profil.php" method="post"><input type="submit" name="compte" value="profil"/></form>
					 <form action="" method="post"><input type="submit" name="disconnect" value="disconnect"></input></form></div>';
			return $header;
			break;
		case 'moderateur':
		case 'administrateur':
			$header='<form action="profil.php" method="post"><input type="submit" name="profil" value="profil"/></form>
					 <form action="" method="post"><input type="submit" name="create" value="create"/></form>
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
				$subscribeform=str_replace('replaceme',' ',$subscribeform);
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
	$tmp= '<div class="commentsprofile"><i>your latest comments:</i><br>';
	for ($i=0; $i <=isset($row[$i]); $i++) {
		$tmp .= '<div>';
		foreach($row[$i] as $k => $v){
			$tmp .= '<div class="scrolldiv">';
			if($k=='id_article'){
				$tmp .= '<span>&#160;&#160;&#160;</span><small>on article n.<b>'.$v.'</b></small><span>&#160;&#160;&#160;&#160;</span>';
			} elseif($k=='commentaire'){
				$tmp .= '<small>your comment: '.$v.'</small>';
			}
			$tmp .= '</div>';
		}
	$tmp .= '<form action="" method="post"><button type="submit" name="editcomm" value="'.$row[$i]['id'].'" class="editbtn">edit</input></form>';
	$tmp .= '<form action="" method="post"><button type="submit" name="deletecomm" value="'.$row[$i]['id'].'" class="deletebtn">delete</input></form>';

	$tmp .= '</div>';
	}
	$tmp .= '</div>';
	return $tmp.'</div>';
}

function catList($categories,$create){
	$tmp='<i><small>chose a category: &#160; </small></i><select id="categories" name="categorieslist">';
	for($i=0;$i<=isset($categories[$i]);$i++){
		$tmp .= '<option value="'.$categories[$i]['nom'].'">'.$categories[$i]['nom'].'</option>';
	}
	$tmp = $tmp.'</select><br><br>';
	$create=str_replace( "<span>insert data list here</span>", $tmp, $create);
	return $create.'<form method="post"><input type="submit" name="close" value="close" id="modifybtn"></input></div></form>	<style> #write{ display:none;}.fakemodal{ opacity:1;} </style>';
}

 // article controller__________

function textBeginning($text){		//get just the beginning of the article as a title
	$text=substr($text,0,25);
	return $text;
}
function textBeginning2($text){		//get just the beginning of the article as a title
	$text=substr($text,0,350);
	return $text;
}


function viewAllArticles($article,$n){
	$tmp='';
	$m=$n+4;
	for($i=$n;$i<=$m;$i++){
		if(isset($article[$i])){
			$tmp .= '<div class="subart"><tr><td><h2>'.$article[$i]['login'].'</h2>
			<h4><form action="articles.php" method="get"><button type="submit" name="categories" value="'.$article[$i]['nom'].'">'.$article[$i]['nom'].'</button></form><br></h4><i>'.$article[$i]['date'].'</i>
			<div class="authorname">'.textBeginning($article[$i]['article']).'...</div>
			<p>'.textBeginning2($article[$i]['article']).'...</p>
			<small><form action="article.php" method="get"><button type="submit" name="id" value="'.$article[$i]['id'].'"><i>continue to read</i></button></form></small></td></tr>';
		}
	}
	return $tmp;
}
function viewCatArticles($article,$n,$cat){
	$tmp='';
	$m=$n+4;
	for($i=$n;$i<=$m;$i++){
		if(isset($article[$i])){
			if($article[$i]['nom']===$cat){
				$tmp .= '<div class="subart"><tr><td><h2>'.$article[$i]['login'].'</h2>
				<h4><form action="articles.php" method="get"><button type="submit" name="categories" value="'.$article[$i]['nom'].'">'.$article[$i]['nom'].'</button></form><br><i>'.($article[$i]['nom']).'</i></h4><i>'.$article[$i]['date'].'</i>
				<div class="authorname">'.textBeginning($article[$i]['article']).'...</div>
				<p>'.textBeginning2($article[$i]['article']).'...</p>
				<small><form action="article.php" method="get"><button type="submit" name="id" value="'.$article[$i]['id'].'"><i>continue to read</i></button></form></small></td></tr>';
			}
		}
	}
	return $tmp;
}

function articlesPages($count){
	$tmp='';
	$pagenum = round(($count+5/2)/5)*5; // SO s
	$maxnum=$pagenum;
	if($count<=$pagenum){
		$pagenum/=5;
		for($i=0;$i<$pagenum;$i++){
			if($i==0){
				$tmp.= '<form action="articles.php" method="get"><button type="submit" name="start" value="'.($i*5).'">newest articles</button></form>';
			} else {
				$tmp.= '<form action="articles.php" method="get"><button type="submit" name="start" value="'.($i*5).'">page '.$i.'</button></form>';
			}
		}
		return $tmp;
	}
}

function viewOneArticle($article){

	$tmp='<div class="subart"><tr><td><h2>'.$article[0]['login'].'</h2>
		<h4><form action="articles.php" method="get"><button type="submit" name="categories" value="'.$article[0]['nom'].'">'.$article[0]['nom'].'</button></form><br></h4><i>'.$article[0]['date'].'</i>
		<div class="authorname">'.textBeginning($article[0]['article']).'...</div>
		<p>'.$article[0]['article'].'</p>
		<small><form action="articles.php" method="get"><button type="submit" name="articles" value="articles"><i>back to articles page</i></button></form></small></td></tr>';
	return $tmp;

}

function viewArticles($article,$x){
	$tmp='';
	for($i=0;$i<$x;$i++){
			$tmp .= '<div class="subart"><tr><td><h2>'.$article[$i]['login'].'</h2>
			<h4><form action="articles.php" method="get"><button type="submit" name="categories" value="'.$article[$i]['nom'].'">'.$article[$i]['nom'].'</button></form><br></h4><i>'.$article[$i]['date'].'</i>
			<div class="authorname">'.textBeginning($article[$i]['article']).'...</div>
			<p>'.textBeginning2($article[$i]['article']).'...</p>
			<small><form action="article.php" method="get"><button type="submit" name="id" value="'.$article[$i]['id'].'"><i>continue to read</i></button></form></small></td></tr>';
	}
	return $tmp;
}

function articleLayout($thisart){
	$thisart=str_replace( "<tr><td>", "<div class='artmain'><div class='blockart'>", $thisart);
	$thisart=str_replace( "</td></tr>", "</div></div>", $thisart);
	$thisart=str_replace( "authorname", "authorart", $thisart);
	return $thisart;
}

// categories controller

function showCatNav($categories){
	echo' <div class="catnav">';
	for ($i=0;$i<=isset($categories[$i]) ;$i++) { 
		echo '<form action="articles.php" method="get"><button type="submit" name="categories" value="'.$categories[$i]['nom'].'">'.$categories[$i]['nom'].'</button></form>&#160;&#160;&#160;';		// get on categories to call NB the changing path of css (./) for this site section
	}
	echo '</div>';
}


// menu controller

function menuSubNav($categories){
	$tmp='';
	for ($i=0;$i<=isset($categories[$i]) ;$i++) { 
		$tmp.='<form action="articles.php" method="get"><button type="submit" name="categories" value="'.$categories[$i]['nom'].'">'.$categories[$i]['nom'].'</button></form><br>';	// get on categories to call NB the changing path of css (./) for this site section
	}
	return $tmp;
}

// comments functions_______

function showCommentsOnArticles($comments){
	$tmp='<div class="maindivcomments"><div class="commentsubdiv">';
	if(isset($comments)){
		for($i=0;$i<=isset($comments[$i]);$i++){
			$tmp .='<br><div class="onecomm">by: '.$comments[$i]['login'].'
					<br><p>"'.$comments[$i]['commentaire'].'"</p></div>';
		}
	}
	return $tmp .'</div>';
}

function commentsForm($cookie){
	$tmp=' <div class="commentsform">';
	if(!isset($cookie)){
	$tmp .= '<style> .commentsform { pointer-events: none; } </style>
		  <small>log in or subscribe to leave a comment</small>';
	} else {
	$tmp .='<span><p>leave a comment here</p></span><form action="" method="post"><textarea name="comment" rows="5" cols="33"></textarea><br>
			<button type="submit" name="submitcomment" value="send">send</button></form><br>';
	}

	return $tmp.'</div>';
}


