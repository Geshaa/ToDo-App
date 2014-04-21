<?php 
	include 'config.php';
	session_start();
	if(isset($_SESSION["userprofile"])) 
	{
?> 
<!DOCTYPE html>
<html>
<head>
	<title>User Area</title>
	<meta charset="UTF-8" />
 	<meta name="viewport" content="width=device-width, user-scalable=no" />
	<link rel="stylesheet" type="text/css" href="css/content.css" />
	<link rel="stylesheet" type="text/css" href="css/jquery-ui-1.10.4.custom.min.css" />
	<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
	<script type="text/javascript" src="js/jquery-ui-1.10.4.custom.min.js"></script>
	<script type="text/javascript" src="js/userAreaFunctions.js"></script>
 </head>
<body>
	<header> 		
		<?php
			//for user name and user ID
                        $uname = $_SESSION["userprofile"];
			print ' Welcome back, '.$uname;
			//query for user ID
			$sql='SELECT id from users where username = "'.$uname.'"  ';
			$result = $conn->query($sql) or die($conn->error.__LINE__);
			//return user ID from database
			while ($row = $result->fetch_assoc()) {
		    $userID =  $row['id']; 
	    		?>
		    		<script>
		    			var userID = <?php echo $userID;?>;
		    		</script>
		    	<?php
			} 
		?>
		<input type="button" value="profile" class="profileInfo" onclick="profileInfo();"/>
		<input type="button" value="LogOut" class="profileInfo" id="logOut"/>
		<a href="taskWindow.php" id="logo"> To Do App</a>

		<div id="profileInfo-dialog" title="Edit Account Information" style="display:none;">
			<table>
				<tr>
					<td><label for="fname">First Name</label></td>
					<td><input type="text" id="fname"  required="required"/></td>
				</tr>
				 <tr>
					<td><label for="lname">Last Name</label></td>
					<td><input type="text" id="lname" required="required" /></td>
				</tr>
				<tr>
					<td><label for="mobile">Mobile</label></td>
					<td><input type="phone" id="mobile" /></td>
				</tr>
				<tr>
					<td><label for="email">Email</label></td>
					<td><input type="text" id="email" required="required"/></td>
				</tr>
				<tr>
					<td><label for="pass">Password</label></td>
					<td><input type="text" id="pass" required="required"/></td>
				</tr>
			</table>
		</div>

	</header>
	<div class="wrapper">
		<div class="menu">
			<div id="dialog-form" title="Enter New Category Name" style="display:none;">
			    <form>
			        <label for="name">Name</label>
			        <input type="text" name="name" maxlength="45" id="catNameInput" class="text ui-widget-content ui-corner-all" />
			    	<label for="name">Description</label>
			        <textarea name="catDescription"  id="catDescription"/></textarea>
			    </form>
			</div>

			<a href="taskWindow.php">
				<input type="button" value="Show All" class="newCategory"/>
			</a>
			<input type="button" value="New Category" class="newCategory" onclick="addCatName(userID);"/>

			<ul class="categoryList">
				<?php
					$sql='SELECT name, id FROM categories where ownerID = "'.$userID.'"  ';
					$result = $conn->query($sql) or die($conn->error.__LINE__);
					//return user ID from database
					while ($row = $result->fetch_assoc()) {
			    		echo '<li data-id="'.$row['id'].'" >' .$row['name'].'</li> ';
					} 
				?>
			</ul>

			<div id="dropToDelete">Drop Category Here to Delete</div>
		</div>

		<div class="center">
			<section class="content">
				<input type="button" value="Add task" class="openTask" onclick="showTask()"/>
				<div class="taskHolder">
					<?php 
						$sql='SELECT title,endDate,description,id from tasks where ownerID = "'.$userID.'"  ';
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
				</div>
			</section>
		</div>
		<div class="taskOperation">
			<div class="addNewTask">
				<div id="taskTitle" > </div>
				<form id="saveForm">
					<?php
						echo '  <span>Select Category<span>    <select name="categName" id="cat">';
						//get category from datebase
						$query = 'SELECT * FROM categories WHERE ownerID = "'.$userID.'" ';
						$result = $conn->query($query) or die($conn->error.__LINE__);
						//put data
						while ($row = $result->fetch_assoc()) {
					    echo '<option value="'. $row['id'] .'">' . $row['name'].'</option>'; 
						} 
						echo '<select><br>';
					?>
					<label for="title"> Add Title </label>
					<input type="text" id="title"  maxlength="45" name="title" placeholder="Cooking"/><br>
					<label for="desc" id="descLabel"> Task Description</label> </br>
					<textarea id="desc" cols="38"  rows = "10" name="description" placeholder="More about your task"></textarea><br>			
					<label for="dateSelector"> Add End Date</label>
					<input type="text" id="dateSelector" name="endDate"/> </br>
					<label for="comment" id="comm"> Add Comment</label> </br>
					<textarea id="comment" cols="34"  rows = "5" name="comment" placeholder="Additional comment"></textarea><br>
					<label>Remind Me :</label>
					<input type="radio" name="rType" value="By Mail" id="rMail" /> <label for="rMail">By Mail</label>
					<input type="radio" name="rType" value="By Other" id="rOther" /><label >By Other</label><br/>
					<label for="daysBefore"> Days Before End Date :</label>
					<input type="text" id="daysBefore"/> <br/>
					<input type="button" autofocus="autofocus" value="Save Task"  class="taskControls" id="saveTask" onclick="ajaxSaveTask();"/>
					<input type="button" value="Cancel"  class="taskControls" id="cancelTask"/>
				</form>
			</div>
			<div class="editTask">
				<div id="e-taskTitle" > </div>
				<form id="updateForm">
					<label for="e-cat">Select Category </label>
				 	<select name="categName" id="e-cat"> </select></br>

					<label for="e-title"> Add Title </label>
					<input type="text" id="e-title"  maxlength="45" name="title" placeholder="Cooking" /><br>
					<label for="e-desc" id="descLabel"> Task Description</label> </br>
					<textarea id="e-desc" cols="38"  rows = "10" name="description" placeholder="More about your task"></textarea><br>
					<label for="dateSelector"> Add End Date</label>
					<input type="text" id="e-dateSelector" name="endDate"/> <br>
					 
					<label for="e-comment" id="comm"> Add Comment</label> </br>
					<textarea id="e-comment" cols="34"  rows = "5" name="e-comment" placeholder="Additional comment"></textarea><br>
					<label>Remind Me :</label>
					<input type="radio" name="rType" value="By Mail" id="e-rMail" /> <label for="e-rMail">By Mail</label>
					<input type="radio" name="rType" value="By Other" id="e-rOther" /><label for="e-rOther">By Other</label><br/>
					<label for="e-daysBefore"> Days Before End Date :</label>
					<input type="text" id="e-daysBefore" /> <br/>
					<label for="doneTask">Task Done</label>
					<input type="checkbox" value="" id="doneTask"/> <br/>
					<input type="button" autofocus="autofocus" value="Update Task"  class="taskControls" id="updateTask"/>
					<input type="button" value="Delete Task"  class="taskControls" id="deleteTask"/>
					<input type="button" value="Cancel"  class="taskControls" id="e-cancelTask"/>
				</form>
			</div>
		</div>	
	</div>
	
	<script>
		$(function() {
	    	$(document).tooltip({
	      		hide: {
		        	effect: "explode",
		        	delay: 250
		      	},
	       		position: {
          			my: "right+100 bottom-10"
	            }
    		});
	    	$('.addNewTask').hide();
			$('.editTask').hide();
			//automatic save,update task on hiting enter
			$('#saveForm').on('keypress', function (e){
			    if(e.which == 13) {
			        $('#saveTask').click();
			    }
			});
			$('#updateForm').on('keypress', function (e){
			    if(e.which == 13) {
			        $('#updateTask').click();
			    }
			});
			 
		    $( "#dateSelector" ).datepicker({ dateFormat: 'yy-mm-dd' });
		    $( "#e-dateSelector" ).datepicker({ dateFormat: 'yy-mm-dd' });

			$('#title').on('blur', function() {
				setTitle();
			});
			$('#cancelTask').on('click', function() {
				$('.addNewTask').fadeOut();
			});
			//get task title for editing
			$('#e-title').on('blur', function() {
				setETitle();
			});
			//open task for edit or delete
			var editTitle,taskID,firstOpen = true;
			$('.tasksPreview').on('click',function() {
				editTitle = $.trim($(this).children('.previewTitle').text());
				taskID = $.trim($(this).children('.hiddenTaskID').text());

				//working but i should find better way
				if(firstOpen == true) {
					ajaxOpenEditTask(editTitle,taskID);
					firstOpen = false;
				}
				else {
					location.reload();
					firstOpen = true;
				}

			});
			$('#e-cancelTask').on('click', function() {
				$('.editTask').fadeOut();
				//working but maybe there is a smarter way
				location.reload();
			});

			$('.categoryList li').on('click',function() {

				$('.categoryList li').removeClass('activeCategory');
			 	$(this).toggleClass('activeCategory');
 
				var catTitle = $(this).text();
				filterByCategory(catTitle,userID);
			});
			$('.categoryList li').draggable({
				containment: '.menu',
				cursor: 'pointer',
				helper: 'clone',
			 		helper: function() {
				 		return $(this).clone().css('width', this.offsetWidth)[0];
					},
				revert: 'invalid',
			});
			$('#dropToDelete').droppable({
				drop: function(event, ui) {
					var catTitleDelete = $(ui.draggable).text();
					var deleteCatId = $(ui.draggable).attr('data-id');
					ajaxDeleteCategory(catTitleDelete, userID, deleteCatId);
					$(ui.draggable).remove();
				}
			});
			$('#logOut').on('click', function() {
				window.location="login.php";
			});
	  	});
	</script>
	<script type="text/javascript" src="js/placeholders.min.js"></script>
</body>
</html>
<?php
	}
	else {
		echo 'You must be loggen in  - <a href="login.php">Login</a>';
	}
?>