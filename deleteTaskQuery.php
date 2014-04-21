<?php
	include 'config.php';
	//put new task in database according to AJAX request
	$title = $_REQUEST['title'];
	$userID = $_GET['userID'];
	$taskID = $_GET['taskID'];

	$sql='DELETE FROM  tasks WHERE title ="'.$title.'"  AND ownerID="'.$userID.'" AND id="'.$taskID.'" ';
	//run the query
	$result = $conn->query($sql) or die ($conn->error.__LINE__);
 
 	echo "Task Deleted";
		  
?>