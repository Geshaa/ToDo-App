<?php
	include 'config.php';
	//put new task in database according to AJAX request
	$userID = $_GET['userID'];

	$fname = $_GET['fname'];
	$fname = mysqli_real_escape_string($conn,$fname);

	$lname = $_GET['lname'];
	$lname = mysqli_real_escape_string($conn,$lname);

	$mobile = $_GET['mobile'];
	$mobile = mysqli_real_escape_string($conn,$mobile);

	$email = $_GET['email'];
	$email = mysqli_real_escape_string($conn, $email);
 
	$pass = $_GET['pass'];
	$pass = mysqli_real_escape_string($conn,$pass);

	$key = 'ASKSDFNSDFKEISDJAHDLDSDF1235UUUiidfsdf';

	$sql='UPDATE users SET firstName= "'.$fname.'", lastName = "'.$lname.'", mobile="'.$mobile.'", email = "'.$email.'", password = "'.$pass.'", status = "'.$status.'" WHERE id = "'.$userID.'" ';
	$conn->query($sql);
 
?>