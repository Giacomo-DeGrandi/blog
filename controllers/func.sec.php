<?php

$_GET   = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
$_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);


private function secure1 {
	protected $x;
		if(ctype_alpha($x)){
			$x=mysqli_real_escape_string(htmlspecialchars(trim($x)));
			return $x;
		} else {
			return 0;
		}
}
