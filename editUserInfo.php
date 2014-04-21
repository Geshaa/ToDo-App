<?php
	include 'config.php';
	//put new task in database according to AJAX request
	$userID = $_GET['userID'];

	//$key = 'ASKSDFNSDFKEISDJAHDLDSDF1235UUUiidfsdf';
	 
 	$sql='SELECT firstName,lastName,mobile,email,password FROM users where id = "'.$userID.'" ';
	//run the query
	$resultProfile = $conn->query($sql) or die ($conn->error.__LINE__);

	while($row = $resultProfile->fetch_assoc())
	{
  		echo  $row['firstName'] .'#'.$row['lastName'].'#'. $row['mobile'].'#'.$row['email'] .'#'.$row['password'];
	}
?>