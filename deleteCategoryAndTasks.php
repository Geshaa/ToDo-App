<?php
	include 'config.php';
	//put new task in database according to AJAX request
	$catTitleDelete = $_REQUEST['catTitleDelete'];
	$catTitleDelete = mysqli_real_escape_string($conn,$catTitleDelete);
	
	$userID = $_GET['userID'];
	$deleteCatId = $_GET['deleteCatId'];
	 
	$sql='DELETE FROM categories WHERE name ="'.$catTitleDelete.'" ';
	$result = $conn->query($sql) or die ($conn->error.__LINE__);

	//another query for deleting tasks
	$sqlDelete='DELETE FROM tasks WHERE categoryID = "'.$deleteCatId.'" AND ownerID= "'.$userID.'" ';
	mysqli_multi_query($conn, $sqlDelete);

?>