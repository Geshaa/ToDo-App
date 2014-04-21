<?php
	include 'config.php';
	
 	$sql='SELECT tasks.daysBeforeEnd,tasks.endDate,users.email FROM tasks,users 
 			WHERE tasks.userID = users.id ';

	$result = $conn->query($sql) or die ($conn->error.__LINE__);

	$today = date('Y/m/d');
	//need an array maybe
 	while($row = $result->fetch_assoc())
	{
		$endDate = $row['endDate'];
		$daysBefore = $row['daysBeforeEnd'];
		$userMail = $row['email'];
  	
		if( abs($today - $endDate) == $daysBefore) {

			mail($userMail,"Reminder From TODO APP","Your Task","Your task end date is comming soon.Check it now.");  
		}
	}
	 
?>

 