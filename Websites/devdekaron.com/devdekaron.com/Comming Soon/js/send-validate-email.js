function isValidEmailAddress(emailAddress) {
var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
return pattern.test(emailAddress);
}



/*FORM validation and div changing*/
$(document).ready(function() { 
	$().click(function (ev) {
		var $target = $(ev.target);
		  if( !$target.is("input") ) {
				$("input#email").val('Please  enter your e-mail address here to get updates');
		  }
	}); 

	$("#email").click(function() {
			$("input#email").val('');
	});
	
	$("#submit").click(function() {
		var email = $("input#email").val();
		if(!isValidEmailAddress(email)){ 
			$("input#email").focus();
			$("input#email").val('Enter a valid e-mail');
		 return false;
		}
	});
	
	/*form submit*/
	$("form#form-email").submit(function() {
		var email = $("input#email").val();
		$.ajax({
			url:'mail.php',
			type:'post',
			data: "email="+email,
			success: function(msg){
				if (msg==1)
					$("input#email").val('Thank you, your e-mail has been received! Submit another ?');
				else
					$("input#email").val('Some trouble on sending');
			}
		});
		return false;
	});
/*end formsubmit*/
});
