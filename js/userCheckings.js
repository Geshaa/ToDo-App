function ajaxCheckUser(){
			var ajaxCheckUser;  // The variable that makes Ajax possible!		
			try{
				// Opera 8.0+, Firefox, Safari
				ajaxCheckUser = new XMLHttpRequest();
			} catch (e){
				// Internet Explorer Browsers
				try{
					ajaxCheckUser = new ActiveXObject("Msxml2.XMLHTTP");
				} catch (e) {
					try{
						ajaxCheckUser = new ActiveXObject("Microsoft.XMLHTTP");
					} catch (e){
						// Something went wrong
						alert("Your browser broke!");
						return false;
					}
				}
			}
			// Create a function that will receive data sent from the server
			ajaxCheckUser.onreadystatechange = function(){
				if(ajaxCheckUser.readyState == 4){
					var userExist = ajaxCheckUser.responseText;
					
					if(userExist == 1) {
						$('#registerButton').css('backgroundColor', 'red');
						$("#registerButton").attr("disabled", "disabled");
						$('#user').val('User user Exist! Change it !');
					}
					else if(userExist ==0) {
						$('#registerButton').css('backgroundColor', '#169fe6');
						$("#registerButton").removeAttr("disabled")
					}
				}
			}
			//get neeeded information for putting it into the database
			var user = $.trim($('#user').val());
			// very important
			var queryString = "?user=" +  user;
			ajaxCheckUser.open("GET", "checkUserName.php" + queryString, true);
			ajaxCheckUser.send(null); 
		}
		function ajaxCheckEmail(){
			var ajaxCheckEmail;  // The variable that makes Ajax possible!		
			try{
				// Opera 8.0+, Firefox, Safari
				ajaxCheckEmail = new XMLHttpRequest();
			} catch (e){
				// Internet Explorer Browsers
				try{
					ajaxCheckEmail = new ActiveXObject("Msxml2.XMLHTTP");
				} catch (e) {
					try{
						ajaxCheckEmail = new ActiveXObject("Microsoft.XMLHTTP");
					} catch (e){
						// Something went wrong
						alert("Your browser broke!");
						return false;
					}
				}
			}
			// Create a function that will receive data sent from the server
			ajaxCheckEmail.onreadystatechange = function(){
				if(ajaxCheckEmail.readyState == 4){
					var emailExist = ajaxCheckEmail.responseText;
					
					if(emailExist == 1) {
						$('#registerButton').css('backgroundColor', 'red');
						$("#registerButton").attr("disabled", "disabled");
						$('#email').val('User email Exist! Change it !');
					}
					else if(emailExist ==0) {
						$('#registerButton').css('backgroundColor', '#169fe6');
						$("#registerButton").removeAttr("disabled")
					}
				}
			}
			//get neeeded information for putting it into the database
			var email = $.trim($('#email').val());
			// very important
			var queryString = "?email=" +  email;
			ajaxCheckEmail.open("GET", "checkEmailAddress.php" + queryString, true);
			ajaxCheckEmail.send(null); 
		}