<?php
	include 'config.php';
	//put new task in database according to AJAX request

	//need to check if isset variable !
	$title = $_GET['title'];
	$title = mysqli_real_escape_string($conn,$title);

	$desc = $_GET['desc'];
	$desc = mysqli_real_escape_string($conn,$desc);
	 
	$comment = $_GET['comment'];
	$comment = mysqli_real_escape_string($conn,$comment);
	 
	$endDate = $_GET['endDate'];
	if( $endDate == 0 ) {
		$endDate = date("Y-m-d");
	}

	$catID = $_GET['catID'];
	$userID = $_GET['userID'];

	$daysBefore = $_GET['daysBefore'];
	$daysBefore = mysqli_real_escape_string($conn, $daysBefore);
	$daysBefore = (int)$daysBefore;

	$sql='INSERT INTO tasks (title,description,comment,dateCreation,endDate,ownerID,categoryID,daysBeforeEnd,status) 
	VALUES ("'.$title.'", "'.$desc.'", "'.$comment.'",CURDATE(), "'.$endDate.'", "'.$userID.'", "'.$catID.'", "'.$daysBefore.'", "'.$status.'")';
	$conn->query($sql);

?>