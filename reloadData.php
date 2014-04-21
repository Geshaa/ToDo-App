<?php 
	include 'config.php';
	$userID = $_GET['uname'];

	$sql='SELECT title,endDate from tasks where ownerID = "'.$userID.'"  ';
	$result = $conn->query($sql) or die($conn->error.__LINE__);
	//return user ID from database
	while ($row = $result->fetch_assoc()) {
		?>
    		<div class="tasksPreview">
    			<?php 
    				echo '<h3 class="previewTitle">'.$row['title'].'</h3>'; 
    				echo '<span class="rightText">'.$row['endDate'].'  </span> ';
    			?>
    		</div>
    	<?php
	} 
?>