<?php
// menu controller

function menuSubNav($categories){
	echo' <div class="menuwrapper">';
	for ($i=0;$i<=isset($categories[$i]) ;$i++) { 
		echo '<form action="articles.php" method="get"><button type="submit" name="categories" value="'.$categories[$i]['nom'].'">'.$categories[$i]['nom'].'</button></form><br>';		// get on categories to call NB the changing path of css (./) for this site section
	}
	echo '</div>';
}

