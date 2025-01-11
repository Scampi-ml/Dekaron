$(document).ready(function(){
	$("#submit").click(function(){					   				   
		$(".error").hide();
		var hasError = false;
		var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
		
		var nameVal = $("#name").val();
		if(nameVal == '') {
			$("#namel").after('<span class="error">*Please enter your name</span>');
			hasError = true;
		} 
		
		var emailFromVal = $("#emailFrom").val();
		if(emailFromVal == '') {
			$("#emailFroml").after('<span class="error">*Please enter your email</span>');
			hasError = true;
		} else if(!emailReg.test(emailFromVal)) {	
			$("#emailFroml").after('<span class="error">(Invalid email)</span>');
			hasError = true;
		}
		
		var subjectVal = $("#subject").val();
		if(subjectVal == '') {
			$("#subjectl").after('<span class="error">*Please specify a subject</span>');
			hasError = true;
		}
		
		var messageVal = $("#message").val();
		if(messageVal == '') {
			$("#messagel").after('<span class="error">*Please write a message</span>');
			hasError = true;
		}
		
		
		if(hasError == false) {
			$(this).hide();
			$("#sendEmail li.buttons").append('<img src="images/loading.gif" alt="Loading" id="loading" />');
			
			$.post("sendemail.php",
   				{ name: nameVal, emailFrom: emailFromVal, subject: subjectVal, message: messageVal },
   					function(data){
						$("#sendEmail").slideUp("normal", function() {				   
							
							$("#sendEmail").before('<p>Your email was sent. We will get back to you soon.</p>');											
						});
   					}
				 );
		}
		
		return false;
	});						   
});