<?php
	include 'config.php';
	//put new task in database according to AJAX request
	$email = $_GET['email'];
	$email = mysqli_real_escape_string($conn,$email);

 	$sql='SELECT email FROM users  WHERE email ="'.$email.'" ';
	//run the query
	$result = $conn->query($sql) or die ($conn->error.__LINE__);
 
	if(mysqli_num_rows($result) == 0) {
		$existMail = 0;
		echo $existMail;
	}
	else {
		$existMail = 1;
		echo $existMail;
	}
?>