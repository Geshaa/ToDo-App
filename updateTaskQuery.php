<?php
	include 'config.php';
	//put new task in database according to AJAX request
	$userID = $_GET['userID'];
	$taskID = $_GET['taskID'];
	$changedTitle = $_GET['changedTitle'];
	$changedTitle = mysqli_real_escape_string($conn,$changedTitle);

	$editTitle = $_GET['previousTitle'];
	$editTitle = mysqli_real_escape_string($conn,$editTitle);

	$desc = $_GET['desc'];
	$desc = mysqli_real_escape_string($conn,$desc);

	$comment = $_GET['comment'];
	$comment = mysqli_real_escape_string($conn, $comment);

	$endDate = $_GET['endDate'];
	if( $endDate == 0 ) {
		$endDate = date("Y-m-d");
	}

	//we dont need escape string here cuz this is integer value
	$changedCatID = $_GET['changedCatID'];
	$oldCatID = $_GET['oldCatID'];
	 
	$daysBefore = $_GET['daysBefore'];
	$daysBefore = mysqli_real_escape_string($conn, $daysBefore);
	$daysBefore = (int)$daysBefore;

	//if we update task without changing category.We can add one more WHERE name and desc
	if($changedCatID == $oldCatID) {
		$sql='UPDATE tasks SET title= "'.$changedTitle.'", description = "'.$desc.'", comment="'.$comment.'", endDate = "'.$endDate.'", daysBeforeEnd = "'.$daysBefore.'" WHERE ownerID = "'.$userID.'" AND categoryID = "'.$oldCatID.'" AND id="'.$taskID.'" ';
		 
	}
	//or if we changing category
	else {
		$sql='INSERT INTO tasks (title,description,comment,dateCreation,endDate,ownerID,categoryID, daysBeforeEnd,status) VALUES ("'.$changedTitle.'", "'.$desc.'", "'.$comment.'", CURDATE(), "'.$endDate.'", "'.$userID.'", "'.$changedCatID.'", "'.$daysBefore.'", "'.$status.'")';

		$deleteOldTask = 'DELETE FROM tasks where ownerID="'.$userID.'" AND categoryID= "'.$oldCatID.'" AND id="'.$taskID.'"  ';
		$conn->query($deleteOldTask);
	}
		$conn->query($sql);
?>