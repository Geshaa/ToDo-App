<?php
	include 'config.php';
	//put new task in database according to AJAX request

	//need to check if isset variable !
	$catName = $_GET['categoryName'];
	$catName = mysqli_real_escape_string($conn,$catName);
	
	$catDescription = $_GET['catDescription'];
	$catDescription = mysqli_real_escape_string($conn,$catDescription);

	$ownerID = $_GET['userID'];
	 
	$sql='INSERT INTO categories (name, description, ownerID,status) VALUES ("'.$catName.'", "'.$catDescription.'", "'.$ownerID.'", "'.$status.'")';
	//run the query
	$conn->query($sql);
	
	echo $catName;
?>