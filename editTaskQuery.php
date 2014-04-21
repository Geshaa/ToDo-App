<?php
	include 'config.php';
	//put new task in database according to AJAX request
	$title = $_GET['title'];
	$title = mysqli_real_escape_string($conn,$title);

	$taskID = $_GET['taskID'];
	$userID = $_GET['userID'];

 	$sql='SELECT tasks.title,tasks.description,tasks.comment,tasks.endDate,tasks.categoryID, categories.name, tasks.daysBeforeEnd FROM  tasks,categories WHERE tasks.title ="'.$title.'"  AND tasks.categoryID = categories.id AND tasks.id="'.$taskID.'" ';
	//run the query
	$result = $conn->query($sql) or die ($conn->error.__LINE__);
 
 	while($row = $result->fetch_assoc())
	{
  		echo  $row['title'] .'#'.$row['description'].'#'. $row['comment'].'#'.$row['endDate'] .'#'.$row['categoryID'] .'#'. $row['name'] .'#'. $row['daysBeforeEnd'];
	}
?>