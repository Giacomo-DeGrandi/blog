<?php 

session_start();

include 'controllers/controllers.php';

// assembly header_______

// create cookie for new visitor_

$user=newVisitor();	// create cookie visitor

$sess=testSessionForm($user);	//test session to view header based on user cookie

getRightHeader($sess);	// get the right header for its role and show the header

echo '</div></header><br><br><br>';	// close header

// if post on button, route the request to the right assembly page

if(isset($_POST['headerbtn'])){
	$cookie=choseFormCookie($_POST['headerbtn']);
	redirectToForm ($cookie);
}

// assembly body and main___________

$content=getRightPageContent($_COOKIE['page']);	// get the right page from cookie

include 'view/footers/footer.view.php';

require_once('main_view.php');

