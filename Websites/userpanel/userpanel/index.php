<?php
session_start();
ob_start();
error_reporting(0);
include ('settings.php');

if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['captcha']) && $_POST['captcha'] == $_SESSION['captcha'] && isset($_POST['username']) && isset($_POST['password']))
{
	include ('class_brute.php');
	Brute::bruteCheck(true);
	
	$deny_login = Brute::bruteCheck();
	if($deny_login)
	{
		$_SESSION['RETURNERROR'] = "Login locked. Try again in 15 minutes.";
	}
	else
	{
		include ('class_dekaron.php');
		$dekaron = new dekaron_class();
		include ('settings.php');
		$dekaron->_login($_POST['username'], $_POST['password']);
		
		unset($_SESSION['captcha']);
		unset($_SESSION['RETURNERROR']);
	}
} 
elseif($_SERVER['REQUEST_METHOD'] == "POST" && !isset($_POST['captcha']))
{
	$_SESSION['RETURNERROR'] = 'You failed the captcha!';
}
else
{
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Dekaron Userpanel</title>

<link rel="stylesheet" media="screen" href="css/reset.css" />
<link rel="stylesheet" media="screen" href="css/grid.css" />
<link rel="stylesheet" media="screen" href="css/style.css" />
<link rel="stylesheet" media="screen" href="css/messages.css" />
<link rel="stylesheet" media="screen" href="css/forms.css" />

<script src="js/jquery.tools.min.js"></script>
<script src="js/jquery.ui.min.js"></script>

<!--[if lte IE 9]>
<link rel="stylesheet" media="screen" href="css/ie.css" />
<![endif]-->

<script type="text/javascript" src="js/ui/jquery.ui.droppable.js"></script>
<script type="text/javascript" src="captcha/jquery.captcha.js"></script>
<link href="captcha/captcha.css" rel="stylesheet" type="text/css" />

<script src="js/global.js"></script>

<script type="text/javascript" charset="utf-8">
	$(function() {
		$(".ajax-fc-container").captcha({
			borderColor: "silver",
			text: "Drag the <span>scissors</span> onto the evolutions logo."
		});
	});
</script>
<script> 
$(document).ready(function(){
    $.tools.validator.fn("#username", function(input, value) {
        return value!='Username' ? true : {     
            en: "Please fill in your username"
        };
    });
    
    $.tools.validator.fn("#password", function(input, value) {
        return value!='Password' ? true : {     
            en: "Please fill in your password"
        };
    });

    $("#form").validator({ 
    	position: 'top', 
    	offset: [25, 10],
    	messageClass:'form-error',
    	message: '<div><em/></div>' // em element is the arrow
    }).attr('novalidate', 'novalidate');
});
</script> 

</head>
<?php
if (file_exists('maintenace.cache'))
{
?>
<body class="login">
    <div class="login-box main-content">
      <header><h2>System Message</h2></header>
    	<section>
    		<?php echo ' <div class="message error">We are performing maintenance at this moment.</div>'; ?>    	</section>
    </div>
</body>
</html>
<?php
die();
}
?>
<body class="login">
    <div class="login-box main-content">
      <header><h2>Login</h2></header>
    	<section>
            <!--[if lte IE 9]>
            IE is NOT supported by the Evo Cp, please install FireFox!
            <![endif]-->
    		<?php

			if ( isset ( $_SESSION['RETURNERROR'] ) && $_SESSION['RETURNERROR'] != '')
			{
				echo ' <div class="message error">'.$_SESSION['RETURNERROR'].'</div>';
				unset($_SESSION['RETURNERROR']);
			}
			if( isset ( $_SESSION['RETURLOGINFAIL'] ) && $_SESSION['RETURLOGINFAIL'] == '1')
			{
				echo ' <div class="message error">Too many wrong login attempts. Try again in 15 minutes.</div>';
				unset($_SESSION['RETURLOGINFAIL']);
			}
			else
			{
            ?>
                <form id="form" method="post" class="clearfix">
                    <p><input type="text" id="username"  class="full" value="iraelan" name="username" required="required" placeholder="Username" /></p>
                    <p><input type="password" id="password" class="full" value="goosebumps" name="password" required="required" placeholder="Password" /></p>
                    <div class="ajax-fc-container">You must enable javascript to see captcha here!</div>
                    <p class="clearfix"><button class="button button-gray fr" type="submit">Login</button></p>
                </form>
            <?php
			}
			?>
            <ul>
                <li><a href="#">I forgot my password</a></li>
                <li><a href="#">Resend your activation code</a></li>
                <li><a href="#">Support</a></li>
            </ul>
    	</section>
    </div>
</body>
</html>
