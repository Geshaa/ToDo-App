<?php
	include 'config.php';

	$userID = $_GET['userID'];

	$catName = $_GET['catTitle'];
	$catName = mysqli_real_escape_string($conn,$catName);

	$sql='SELECT tasks.title, tasks.description, tasks.endDate, tasks.id FROM tasks, categories 
	WHERE tasks.ownerID =  "'.$userID.'" AND categories.name =  "'.$catName.'" AND tasks.categoryID = categories.id ';
	
	$result = $conn->query($sql) or die($conn->error.__LINE__);

	//return user ID from database
	while ($row = $result->fetch_assoc()) {
		//only first 100 characters from description
		$smallDesc = substr($row['description'],0,100);

		echo '<div class="tasksPreview" title="'.$smallDesc.'">';
		 
		if(strtotime($row['endDate']) > strtotime('now')) {
			echo '<h3 class="previewTitle" >'.$row['title'].'</h3>'; 
			echo '<span class="rightText" >'.$row['endDate'].'  </span> ';
			echo '<h4 class="hiddenTaskID" >'.$row['id'].'  </h4> ';
		}
		else {
			echo '<h3 class="previewTitle">'.$row['title'].'</h3>';
			echo '<span class="rightText missedTask">'.$row['endDate'].'  </span> '; 
			echo '<h4 class="hiddenTaskID" >'.$row['id'].'  </h4> ';
		}
		echo '</div>';		 
	} 
?>