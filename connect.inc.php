<?php

	$host = "localhost";
	$user = "root";
	$pass = "";
	$db = "fb-login-php";
	$con = mysqli_connect($host,$user,$pass,$db);
	if(!$con){
		die(mysqli_connect_error());
	}
	
?>