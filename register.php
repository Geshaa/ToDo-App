
<?php
	//connect to database
    include 'config.php';
    
	if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email'])) {

		//get data
		$firstName = mysqli_real_escape_string($conn,$_POST['firstname']);
		$lastName = mysqli_real_escape_string($conn,$_POST['lastname']);
		$mobile = mysqli_real_escape_string($conn,$_POST['mobile']);

		$username = mysqli_real_escape_string($conn,$_POST['username']);

		$email = mysqli_real_escape_string($conn,$_POST['email']);

		$password = mysqli_real_escape_string($conn,$_POST['password']);
		$passAgain = mysqli_real_escape_string($conn,$_POST['passwordSecond']);

		if($password == $passAgain) {

			//$key = 'ASKSDFNSDFKEISDJAHDLDSDF1235UUUiidfsdf';
                        //AES_ECRYPT("'.$password'", "'.$key.'");
			//make query and insert data fetch from form bellow
			$insert = 'INSERT INTO users(username,email,password,firstName,lastName,mobile,status) 
				VALUES("'.$username.'","'.$email.'", "'.$password.'", "'.$firstName.'", "'.$lastName.'", "'.$mobile.'", "'.$status.'" )';

			//$conn->query($insert);
			$res = mysqli_query($conn, $insert);
			
			echo '<div class="alerts">You are now registered !</div>';
			$conn->close();
		}
		else {
			echo '<div class="alerts">Passwords are not equal !</div>';
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Registration Form</title>
	<link rel="stylesheet" type="text/css" href="css/loginForm.css" />
	<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
	<script type="text/javascript" src="js/userCheckings.js"></script>
 </head>
<body>
	<div class="wrapper">
		 <section class="content">
			<form  action="register.php" method="POST" required="required" name="register-form">
				<h1>Registration Form</h1>
				<p>	
					<input class = "inputFieldsStyle" maxlength="45" name="firstname" required="required" type="text" placeholder="First Name"/>
				</p>
				<p>	
					<input class = "inputFieldsStyle" maxlength="45" name="lastname" required="required" type="text" placeholder="Last Name"/>
				</p>
				<p>	
					<input class = "inputFieldsStyle" maxlength="45" name="mobile"  type="phone" placeholder="Mobile Phone"/>
				</p>
				<p>	
					<input class = "inputFieldsStyle" maxlength="25" id="user" onblur="ajaxCheckUser();" name="username" required="required" type="text" placeholder="Username"/>
				</p>
				<p>	
					<input class = "inputFieldsStyle" maxlength="45" id="email" onblur="ajaxCheckEmail();" name="email" required="required" type="email" placeholder="Email"/>
				</p>
				<p>		
					<input class = "inputFieldsStyle" maxlength="45" name="password" required="required" type="password" placeholder="Password"/>
				</p>
				<p>		
					<input class = "inputFieldsStyle" maxlength="45" name="passwordSecond" required="required" type="password" placeholder="Retype Password"/></br>
				</p>
				<p>
					<input type="submit" class = "inputSubmit" id="registerButton" name="register" value="Register"/></br>
					<a href="login.php" class = "inputRegister"> Log In </a></br>
				</p> 
			</form>
		</section>
	</div>
	<script type="text/javascript" src="js/placeholders.min.js"></script>
</body>
</html>

