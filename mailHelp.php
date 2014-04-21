<?php
	if(isset($_POST['email']) ) {

		include 'config.php';
		require("class.phpmailer.php");
	    //SMTP config
	    $host = 'smtpout.secureserver.net';
	    $username = 'todos@sig-software.de';
	    $pass = 'sofia';

		//get user password from database
		$email_to = $_POST['email'];

		//key for AES encryption
		//$key = 'ASKSDFNSDFKEISDJAHDLDSDF1235UUUiidfsdf';

		$sql2='SELECT password from users where email = "'.$email_to.'" LIMIT 1 ';
	        $result2 = mysqli_query($conn, $sql2);
                if($result2->errorno) {
                	echo 'Errro Happen'.$result2->error;
                }
                 
		if(mysqli_num_rows($result2) > 0) {
			//if email adres exist - send mail
		 	while($row2 = mysqli_fetch_array($result2)) {
		       $userPassword =  $row2['password'];
		       //send mail via Mail Helper		
	               $mail = new PHPMailer();
 
 	               $mail->IsSMTP();  // telling the class to use SMTP
	               $mail->SMTPAuth = true;
	               $mail->Host = $host; // SMTP server
	               $mail->Port = 25;
	               $mail->SetFrom = "ToDoApp";
	               $mail->From = "todoapp@sig-software.de";
	               $mail->FromName="ToDoApp";
	               $mail->Username = $username;
	               $mail->Password = $pass;
	               $mail->AddAddress($email_to);
  
	               $mail->Subject  = "Your password is here";
	               $mail->Body     = "You have asked us to recend your ToDoApp password.This is it   - ".$userPassword;
	               $mail->WordWrap = 50; 

	               if(!$mail->Send()) {
		         echo '<div class="alerts">Message was not sent.</div>';
		         echo '<div class="alerts">Mailer error: ' . $mail->ErrorInfo. '</div>';
	               } else {
		           echo '<div class="alerts">Message has been sent.</div>';
	               }
                            
		    }		
        }
        else {
			echo '<div class="alerts">Mail not registered.</div>'; 
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Help via Mail</title>
	<link rel="stylesheet" type="text/css" href="css/loginForm.css" />
 </head>
<body>
	<div class="wrapper">
		 <section class="content">
			<form  action="mailHelp.php" method="POST" name="register-form">
				<h1>Forgotten Password</h1>
				<p>	
					<input class = "inputFieldsStyle" name="email" required="required" type="email" placeholder="Write your mail"/>
				</p>
				<p>
					<input type="submit" class = "inputSubmit" name="sendMail" value="Send Us Mail"/></br>
				</p> 
				<p><a href="login.php" class = "inputRegister"> Log In </a></p>
			</form>
		</section>
	</div>
	<script type="text/javascript" src="js/placeholders.min.js"></script>
</body>
</html>