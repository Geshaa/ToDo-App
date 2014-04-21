//ajax request for saving new task without refresh
function ajaxSaveTask(){
	var ajaxRequest;  // The variable that makes Ajax possible!		
	try{
		// Opera 8.0+, Firefox, Safari
		ajaxRequest = new XMLHttpRequest();
	} catch (e){
		// Internet Explorer Browsers
		try{
			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try{
				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e){
				// Something went wrong
				alert("Your browser broke!");
				return false;
			}
		}
	}
	// Create a function that will receive data sent from the server
	ajaxRequest.onreadystatechange = function(){
		if(ajaxRequest.readyState == 4){
			
			$('.addNewTask').fadeOut();
		    window.location="taskWindow.php";
		}
	}
	//get neeeded information for putting it into the database
	var catID = $.trim($('#cat option:selected').val());
	var title = $.trim($('#title').val());
	var desc = $.trim($('#desc').val());
	var comment = $.trim($('#comment').val());
	var endDate = $('#dateSelector').val();
	var daysBefore = $.trim($('#daysBefore').val());
	// very important
	var queryString = "?title=" + title + "&desc=" + desc + "&comment=" + comment + "&catID=" + catID + "&endDate=" + endDate + "&userID=" + userID + "&daysBefore=" + daysBefore;
	ajaxRequest.open("GET", "saveTaskQuery.php" + queryString, true);
	ajaxRequest.send(null); 
}

//ajax request editing selected task
function ajaxOpenEditTask(editTitle,taskID) {
	var ajaxRequest;  // The variable that makes Ajax possible!		
	try {
		// Opera 8.0+, Firefox, Safari
		ajaxRequest = new XMLHttpRequest();
	} catch (e) {
		// Internet Explorer Browsers
		try {
			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try {
				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e) {
				// Something went wrong
				alert("Your browser broke!");
				return false;
			}
		}
	}
	// Create a function that will receive data sent from the server
	ajaxRequest.onreadystatechange = function(){

		if(ajaxRequest.readyState == 4){
			$("#e-desc").text("");
			//here is returned answer from ajax
			var ajaxDisplay = ajaxRequest.responseText;
			var res = ajaxDisplay.split("#") ;

			$('#e-taskTitle').text(res[0]);
			$('#e-title').val(res[0]);
			$('#e-desc').val(res[1]);
			$('#e-comment').val(res[2]);
			$('#e-dateSelector').val(res[3]);
			$('#e-cat').html($("<option>", { value: res[4], html: res[5] }));
			$('#e-daysBefore').val(res[6]);
			//for another categories left
			ajaxAppendCategory();
 			$('.addNewTask').fadeOut();
	 		$('.editTask').fadeIn();
			
			var oldCatID,changedTitle,changedCatID;
			oldCatID = $('#e-cat option:selected').val();

	 		$('#updateTask').on('click', function() {
	 			changedTitle = $('#e-title').val();
	 			changedCatID = $('#e-cat option:selected').val();

				ajaxUpdateTask(editTitle, changedTitle, oldCatID, changedCatID, taskID); 
			});

	 		//call another procedures for updating and deleting current task
	 		$('#deleteTask').on('click', function() {
				ajaxDeleteTask(editTitle, userID, taskID );
			});
		}
	}
	// very important
	var queryString = "?title=" + editTitle + "&userID=" + userID + "&taskID=" + taskID;
	ajaxRequest.open("GET", "editTaskQuery.php" + queryString, true);
	ajaxRequest.send(null); 
}

//ajax for adding others category to select tag
function ajaxAppendCategory() {
	var ajaxAppendCat;  // The variable that makes Ajax possible!		
	try {
		// Opera 8.0+, Firefox, Safari
		ajaxAppendCat = new XMLHttpRequest();
	} catch (e) {
		// Internet Explorer Browsers
		try {
			ajaxAppendCat = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try {
				ajaxAppendCat = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e) {
				// Something went wrong
				alert("Your browser broke!");
				return false;
			}
		}		
	}
	// Create a function that will receive data sent from the server
	ajaxAppendCat.onreadystatechange = function(){
		if(ajaxAppendCat.readyState == 4){
			$("#e-desc").text("");
			//here is returned answer from ajax
	 
			var data = JSON.parse(ajaxAppendCat.responseText);
			$.each(data, function(key, value){
				$("#e-cat").append($("<option>", { value: value.id, html: value.name }));
			});	 
		}
	}
	// very important
	var queryString = "?userID=" + userID;
	ajaxAppendCat.open("GET", "appendCategory.php" + queryString, true);
	ajaxAppendCat.send(null); 
}

//ajax request for deleting current task
function ajaxDeleteTask(editTitle, userID, taskID) {
	var ajaxRequest;  // The variable that makes Ajax possible!		
	try {
		// Opera 8.0+, Firefox, Safari
		ajaxRequest = new XMLHttpRequest();
	} catch (e) {
		// Internet Explorer Browsers
		try {
			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try {
				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e) {
				// Something went wrong
				alert("Your browser broke!");
				return false;
			}
		}
	}
	// Create a function that will receive data sent from the server
	ajaxRequest.onreadystatechange = function(){
		if(ajaxRequest.readyState == 4){

			$('#e-taskTitle').html(ajaxRequest.responseText);
			setInterval(function(){
			    location.reload();
				$('.editTask').fadeOut();
			},300);
		}
	}
	// very important
	var queryString = "?title=" + editTitle + "&userID=" + userID + "&taskID=" + taskID;
	ajaxRequest.open("GET", "deleteTaskQuery.php" + queryString, true);
	ajaxRequest.send(null); 
}

//ajax request for updating current task
function ajaxUpdateTask(editTitle, changedTitle, oldCatID, changedCatID, taskID) {
	var ajaxRequest;  // The variable that makes Ajax possible!		
	try {
		// Opera 8.0+, Firefox, Safari
		ajaxRequest = new XMLHttpRequest();
	} catch (e) {
		// Internet Explorer Browsers
		try {
			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try {
				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e) {
				// Something went wrong
				alert("Your browser broke!");
				return false;
			}
		}
	}
	// Create a function that will receive data sent from the server
	ajaxRequest.onreadystatechange = function(){
		if(ajaxRequest.readyState == 4){
		 	location.reload();
		}
	}
	// proverki
	alert("zaglavie koeto shte editvame " + editTitle);
	alert("promeneno zagl na " + changedTitle);
	alert("cat koqto shte editvame " + oldCatID);
	alert("smenena kategoria na " + changedCatID);

	var desc = $.trim($('#e-desc').val());
	var comment = $.trim($('#e-comment').val());
	var endDate = $('#e-dateSelector').val();
	var daysBefore = $.trim($('#e-daysBefore').val());

	var queryString = "?changedTitle=" + changedTitle + "&desc=" + desc + "&comment=" + comment + "&userID=" + userID + "&changedCatID=" + changedCatID + "&oldCatID=" + oldCatID + "&endDate=" + endDate + "&previousTitle=" + editTitle + "&daysBefore=" + daysBefore + "&taskID=" + taskID;
	ajaxRequest.open("GET", "updateTaskQuery.php" + queryString, true);
	ajaxRequest.send(null); 
}

//open dialog box for user to input new category name
function addCatName(userID) {			 
    $('#catNameInput').val('');
	$('#catDescription').val('');
	$("#dialog-form").dialog({
		autoOpen: false,
       // modal: true,
        buttons: {
            "Add": function() {
                var nameOfCat = $("#catNameInput").val();
                var catDescription = $('#catDescription').val();
				//alert(nameOfCat);
				//alert(catDescription);
                //Do your code here
    			ajaxAddCategory(userID, nameOfCat, catDescription);
    			$(this).dialog("close"); 
            },
            "Cancel": function() {
                $(this).dialog("close");
            }
        }
    });				    
    $("#dialog-form").dialog("open");

}

//make ajax request and put data in the database
function ajaxAddCategory(userID, catName, catDescription) {
	var ajaxAddCategory;  // The variable that makes Ajax possible!		
	try{
		// Opera 8.0+, Firefox, Safari
		ajaxAddCategory = new XMLHttpRequest();
	} catch (e){
		// Internet Explorer Browsers
		try{
			ajaxAddCategory = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try{
				ajaxAddCategory = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e){
				// Something went wrong
				alert("Your browser broke!");
				return false;
			}
		}
	}
	// Create a function that will receive data sent from the server
	ajaxAddCategory.onreadystatechange = function(){
		if(ajaxAddCategory.readyState == 4){
			//here is returned answer from ajax
			$('<li/>', {
			    'text': ajaxAddCategory.responseText,
			}).on('click', function(){
				//do something on click
			}).appendTo('.categoryList');
			//maybe need ajax
			location.reload();
		}
	}
	// very important
	var queryString = "?categoryName=" + catName +"&catDescription=" + catDescription + "&userID=" + userID;
	ajaxAddCategory.open("GET", "addCategory.php" + queryString, true);
	ajaxAddCategory.send(null); 
}

//get user info from database
function profileInfo() {
	ajaxGetUserInfo(userID);
	$("#profileInfo-dialog").dialog({
        autoOpen: false,
        width: 320,
        buttons: {
            "Update": function() {
                //get data
      			ajaxUpdateUserInformation(userID);
                $(this).dialog("close");
            },
            "Cancel": function() {
                $(this).dialog("close");
            }
        }
    });				    
    $("#profileInfo-dialog").dialog("open");
}

function ajaxUpdateUserInformation(userID) {
	var ajaxUpdateUserInformation;  // The variable that makes Ajax possible!		
	try {
		// Opera 8.0+, Firefox, Safari
		ajaxUpdateUserInformation = new XMLHttpRequest();
	} catch (e) {
		// Internet Explorer Browsers
		try {
			ajaxUpdateUserInformation = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try {
				ajaxUpdateUserInformation = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e) {
				// Something went wrong
				alert("Your browser broke!");
				return false;
			}
		}
	}
	// Create a function that will receive data sent from the server
	ajaxUpdateUserInformation.onreadystatechange = function(){
		if(ajaxUpdateUserInformation.readyState == 4){
			//$('#e-taskTitle').html("Task Updated");
			 
		}
	}
	// very important   - need additional checking because if you don`t close the popup - it will update all 
	 
	var fname = $.trim($('#fname').val());
	var lname = $.trim($('#lname').val());
	var mobile = $.trim($('#mobile').val());
	var email = $.trim($('#email').val());
	var pass = $('#pass').val();
	
	var queryString = "?fname=" + fname + "&lname=" + lname + "&mobile=" + mobile + "&email=" + email + "&pass=" + pass + "&userID=" + userID;
	ajaxUpdateUserInformation.open("GET", "updateUserInformation.php" + queryString, true);
	ajaxUpdateUserInformation.send(null); 
	 
}

//get all user info and put it into div
function ajaxGetUserInfo(userID) {
	var ajaxUserInformation;  // The variable that makes Ajax possible!		
	try{
		// Opera 8.0+, Firefox, Safari
		ajaxUserInformation = new XMLHttpRequest();
	} catch (e){
		// Internet Explorer Browsers
		try{
			ajaxUserInformation = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try{
				ajaxUserInformation = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e){
				// Something went wrong
				alert("Your browser broke!");
				return false;
			}
		}
	}
	// Create a function that will receive data sent from the server
	ajaxUserInformation.onreadystatechange = function(){
		if(ajaxUserInformation.readyState == 4){

			var ajaxDisplay = ajaxUserInformation.responseText;
		 	var res = ajaxDisplay.split("#");

		 	$('#fname').val(res[0]);
		 	$('#lname').val(res[1]);
		 	$('#mobile').val(res[2]);
		 	$('#email').val(res[3]);

		 	$('#pass').val(res[4]);
		 	$('#passAgain').val(res[5]);
		}
	}
	// very important
	var queryString = "?userID=" + userID;
	ajaxUserInformation.open("GET", "editUserInfo.php" + queryString, true);
	ajaxUserInformation.send(null);
}

//show tasks filtered by category
function filterByCategory(catTitle,userID) {
	var ajaxFilterByCatName;  // The variable that makes Ajax possible!	
	//alert(catTitle);
	//alert(userID);	
	try {
		// Opera 8.0+, Firefox, Safari
		ajaxFilterByCatName = new XMLHttpRequest();
	} catch (e) {
		// Internet Explorer Browsers
		try {
			ajaxFilterByCatName = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try {
				ajaxFilterByCatName = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e) {
				// Something went wrong
				alert("Your browser broke!");
				return false;
			}
		}
	}
	// Create a function that will receive data sent from the server
	ajaxFilterByCatName.onreadystatechange = function(){
		if(ajaxFilterByCatName.readyState == 4){
		    //location.reload();
			$('.taskHolder').html(ajaxFilterByCatName.responseText);

			 
			var taskID = 0,firstOpen = true, editTitle ="";

			$('.tasksPreview').on('click',function() {
				
				editTitle = $(this).children(':first').text();
				taskID =  $(this).children(':last').text();
				//not working if you click on 2 task and then on update.
				ajaxOpenEditTask(editTitle,taskID);				 
			});
		}
	}
	// very important
	var queryString = "?catTitle=" + catTitle + "&userID=" + userID;
	ajaxFilterByCatName.open("GET", "filterByCategory.php" + queryString, true);
	ajaxFilterByCatName.send(null); 
}

//delete category and task belongins to it
function ajaxDeleteCategory(catTitleDelete, userID, deleteCatId) {
	var ajaxDeleteCategory;  // The variable that makes Ajax possible!		
	try {
		// Opera 8.0+, Firefox, Safari
		ajaxDeleteCategory = new XMLHttpRequest();
	} catch (e) {
		// Internet Explorer Browsers
		try {
			ajaxDeleteCategory = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try {
				ajaxDeleteCategory = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e) {
				// Something went wrong
				alert("Your browser broke!");
				return false;
			}
		}
	}
	// Create a function that will receive data sent from the server
	ajaxDeleteCategory.onreadystatechange = function(){
		if(ajaxDeleteCategory.readyState == 4){
			//need ajax not to reload maybe for faster work
			location.reload();
		}
	}
	// very important
	var queryString = "?catTitleDelete=" + catTitleDelete + "&userID=" + userID + "&deleteCatId=" + deleteCatId;
	ajaxDeleteCategory.open("GET", "deleteCategoryAndTasks.php" + queryString, true);
	ajaxDeleteCategory.send(null);
} 

function showTask() {
	//clear all fields
	$('#title').val('');
	$('#taskTitle').text('');
	$('#desc').val('');
	$('#comment').val('');
	$('#cat option[value="1"]').attr("selected",true);
	$('.editTask').fadeOut();
	$('.addNewTask').fadeIn();
}

function setTitle() {
	var title = $('#title').val();
	$('#taskTitle').html(title);
}

function setETitle() {
	var eTitle = $('#e-title').val();
	$('#e-taskTitle').html(eTitle);
}

//extend functionality and makes Enter the default button for Add new task( when user press Enter it`ll add task)
$.extend($.ui.dialog.prototype.options, { 
    create: function() {
        var $this = $(this);

        // focus first button and bind enter to it
        $this.parent().find('.ui-dialog-buttonpane button:first').focus();
        $this.keypress(function(e) {
            if( e.keyCode == $.ui.keyCode.ENTER ) {
                $this.parent().find('.ui-dialog-buttonpane button:first').click();
                return false;
            }
        });
    } 
});
/*
function reloadPage() {
	$.get('reloadData.php',{uname:userID}, function(data) {
		$('.content').html(data);
	});
}
*/