<?php
	//for logout button
	if(session_start()) {
		session_destroy();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login Form</title>
	<link rel="stylesheet" type="text/css" href="css/loginForm.css" />
 </head>
<body>
	<div class="wrapper">
		<section class="content">
			<form  action="login.php" method="POST" required="required" name="login-form" id="my-form">
				<h1>Login Form</h1>
				<p>	
					<input class = "inputFieldsStyle" name="username" required="required" type="text" placeholder="Username"/>
				</p>
				<p>		
					<input class = "inputFieldsStyle" name="password" required="required" type="password" placeholder="Password"/></br>
				</p>
				<p>
					<input type="submit" class = "inputSubmit" name="login" value="Log In"/></br>

					<a href="register.php"  class = "signInLink" name="signin" value="Sign In"/> Sign In </a></br>
					<a href="mailHelp.php" class="mailHelp">Need Help</a>
				</p> 
			</form>
		</section>
	</div>
	<script type="text/javascript" src="js/placeholders.min.js"></script>
</body>
</html>

<?php
	include 'config.php';
	session_start();
	
	if(isset($_POST['username'])) {

		$username = mysqli_real_escape_string($conn,$_POST['username']);

		$password = mysqli_real_escape_string($conn,$_POST['password']);
		//$key = 'ASKSDFNSDFKEISDJAHDLDSDF1235UUUiidfsdf';
                //select with AES_ENCRYPT EXAMPLE
                //SELECT AES_DECRYPT(password, "'.$key.'") FROM users where username = "'.$username.'" AND password = AES_ENCRYPT("'.$password'","'.$key.'") LIMIT 1
 
		$_SESSION["userprofile"] = $username;
		$_SESSION["logged"] = 1;

		$sql = 'SELECT password FROM users where username = "'.$username.'" AND password = password LIMIT 1 ';
		$res = $conn->query($sql) or die($conn->error.__LINE__);

		//$conn->query($res);
		//$res = mysqli_query($conn, $sql);

		if($res -> num_rows == 1) {	
			/*
			?>	
				<div class="alerts">
					Now you have logged in.
				</div>
			<?php
			*/
			header('Location:taskWindow.php');
			exit();
		}
		else {
			//page for errors
			?>
			<div class="alerts">
				Invalid Information.Try Again !
			</div>
			<?php
			mysqli_close($conn);
			exit();

		}
	}

?>