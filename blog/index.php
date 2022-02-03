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

//redirect post request from forms__ 

redirectPostForms($_POST);

// assembly body and main___________

$content=getRightContent($_GET['action'],$conn);

include 'view/footerView.php';

require_once 'template.php';

