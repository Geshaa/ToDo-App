<?php
	//database info
	$host = 'localhost';
	$db = 'test';
	$user = 'root';
	$pass = 'mysql';
	//this need a change
	$status = 0;
	
	$conn = new mysqli($host,$user,$pass,$db);

	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
?>