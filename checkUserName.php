<?php
	include 'config.php';
	//put new task in database according to AJAX request
	$user = $_GET['user'];
	$user = mysqli_real_escape_string($conn,$user);

 	$sql='SELECT username FROM users  WHERE username ="'.$user.'" ';
	//run the query
	$result = $conn->query($sql) or die ($conn->error.__LINE__);
 
	if(mysqli_num_rows($result) == 0) {
		$existUser = 0;
		echo $existUser;
	}
	else {
		$existUser = 1;
		echo $existUser;
	}
?>