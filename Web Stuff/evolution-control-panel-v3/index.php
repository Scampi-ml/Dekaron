<?php
session_start();
ob_start();
error_reporting(0);
include ('settings.php');
if (isset($_POST['username']) && isset($_POST['password']))
{
	include ('class_dekaron.php');
	$dekaron = new dekaron_class();
	include ('settings.php');
	$dekaron->_login($_POST['username'], $_POST['password']);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Dekaron Evolution Userpanel</title>

<link rel="stylesheet" media="screen" href="css/reset.css" />
<link rel="stylesheet" media="screen" href="css/grid.css" />
<link rel="stylesheet" media="screen" href="css/style.css" />
<link rel="stylesheet" media="screen" href="css/messages.css" />
<link rel="stylesheet" media="screen" href="css/forms.css" />

<!--[if lt IE 9]>
<script src="js/html5.js"></script>
<script src="js/pie.js"></script>
<![endif]-->
<!-- jquerytools -->
<script src="js/jquery.tools.min.js"></script>
<script src="js/jquery.ui.min.js"></script>

<!--[if lte IE 9]>
<link rel="stylesheet" media="screen" href="css/ie.css" />
<script type="text/javascript" src="js/ie.js"></script>
<![endif]-->

<script src="js/global.js"></script>


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
if ($CONFIG['UCP_DISABLED'] == 'true')
{
?>
<body class="login">
    <div class="login-box main-content">
      <header><h2>System Message</h2></header>
    	<section>
    		<?php echo ' <div class="message error">We are performing maintenance at this moment.</div>'; ?>
    	</section>
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
            IE 8 is NOT supported by the Evo Cp, please upgrade to IE9 or install FireFox!
            <![endif]-->
    		<?php

			if ( isset ( $_SESSION['RETURNERROR'] ) && $_SESSION['RETURNERROR'] != '')
			{
				echo ' <div class="message error">'.$_SESSION['RETURNERROR'].'</div>';
				unset($_SESSION['RETURNERROR']);
			}
            ?>
    		<form id="form" method="post" class="clearfix">
			<p><input type="text" id="username"  class="full" value="" name="username" required="required" placeholder="Username" /></p>
			<p><input type="password" id="password" class="full" value="" name="password" required="required" placeholder="Password" /></p>
			<p class="clearfix"><button class="button button-gray fr" type="submit">Login</button></p>
		</form>
		<ul>
        	<li><a href="http://evolutiongames.net/forgotpass.php">I forgot my password</a></li>
            <li><a href="http://evolutiongames.net/resend.php">Resend your activation code</a></li>
            <li><a href="http://evolutiongames.net/support/">Support</a></li>
        </ul>
    	</section>
    </div>
</body>
</html>
