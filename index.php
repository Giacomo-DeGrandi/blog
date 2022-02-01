<?php 

session_start();


include 'controller/controller.php';

// connnect to db

$conn=connectDb($conn);

// assembly header_______

// create cookie for new visitor_

$user=newVisitor();	// create cookie visitor

$sess=testSessionForm($user);	//test session to view header based on user cookie

$buttons=getRightHeader($sess);	// get the right header buttons for its role and generate buttons for header

require_once 'view/headerView.php';

// if post on button, route the request to the right assembly page

if(isset($_POST['headerbtn'])){
	$cookie=choseFormCookie($_POST['headerbtn']);
	redirectToForm ($cookie);
}

// assembly body and main___________

$content=getRightContent($_COOKIE['page'],$conn);

include 'view/footerView.php';

require_once 'template.php';
