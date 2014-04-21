<?php
	include 'config.php';
	//put new task in database according to AJAX request
	 
	$ownerID = $_GET['userID'];

	$jsonResponse = array();
	$addCatSql = 'SELECT id, name FROM categories WHERE  ownerID = "'.$ownerID.'" ';

	$resultCategory = $conn->query($addCatSql) or die ($conn->error.__LINE__);
	while ($catRow = $resultCategory->fetch_assoc()) {
		$jsonResponse[]  = $catRow;
	}
	echo json_encode($jsonResponse);	 
?>