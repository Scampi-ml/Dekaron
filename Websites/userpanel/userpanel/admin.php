<?php
session_start();
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Logs Panel</title>

<link rel="stylesheet" media="screen" href="css/reset.css" />
<link rel="stylesheet" media="screen" href="css/grid.css" />
<link rel="stylesheet" media="screen" href="css/style.css" />
<link rel="stylesheet" media="screen" href="css/messages.css" />
<link rel="stylesheet" media="screen" href="css/forms.css" />

<script src="js/jquery.tools.min.js"></script>
<script src="js/jquery.ui.min.js"></script>

<script src="js/global.js"></script>
<body class="login">

<?php
if(isset($_POST['login']))
{
	$admin_passw = 'janvier123';  
	
	if($_POST['password'] == $admin_passw)
	{
		$_SESSION['admin'] = 'true';
	}
}
if(isset($_SESSION['admin']) )
{
//---------------------------------------------------------------------------------------- LOGGED IN
if(isset($_POST['maintenace']) )
{
	if($_POST['maintenace'] == '1')
	{
		$nothing = '';
		$file_name = "maintenace.cache";
		$handle = fopen($file_name, 'w+');
		fwrite($handle, $nothing);
		fclose($handle);
		$msq =  '<div class="message success">Maintenace enabled.</div><br>';
	}
	elseif($_POST['maintenace'] == '0')
	{
		unlink("maintenace.cache");
		$msq =  '<div class="message success">Maintenace disabled.</div><br>';
	}
	else
	{
	}
}

if(isset($_POST['clearbrute']) && $_POST['clearbrute'] == 'Yes')
{
		$nothing = '';
		$file_name = "logins/brute.txt";
		$handle = fopen($file_name, 'w+');
		fwrite($handle, $nothing);
		fclose($handle);
		$msq =  '<div class="message success">Brute cleared.</div><br>';
}
if(isset($_POST['clearlogins']) && $_POST['clearlogins'] == 'Yes')
{
		$nothing = '';
		$file_name = "logins/login.txt";
		$handle = fopen($file_name, 'w+');
		fwrite($handle, $nothing);
		fclose($handle);
		$msq = '<div class="message success">Logins cleared.</div><br>';
}

?>



<div class="login-box main-content" style="width: 600px; ">
<?php echo $msq; ?>
<header><h2>Admin</h2></header>
<section>

<form id="form" class="form grid_6" method="post" action="admin.php">
    <fieldset style="width: 500px;">
        <label>Maintenace<small><?php if (!file_exists('maintenace.cache')) {echo 'Disabled';}else{echo 'Enabled';} ?></small></label>
        <select name="maintenace"  size="1"  style="width: 150px;">
        	<option value="" selected >Please select</option>
            <option value="0" >Disabled</option>
            <option value="1" >Enabled</option>
        </select>
        <label>Clear Brute</label> <input type="checkbox" name="clearbrute" value="Yes" />
        <label>Clear Logins</label> <input type="checkbox" name="clearlogins" value="Yes" />

        
        <div class="action">
            <button class="button button-gray" type="submit"><span class="accept"></span>OK</button>
        </div>
    </fieldset>
</form> 

</section>
</div>




<?php
//---------------------------------------------------------------------------------------- LOGGED IN
}
else
{
?>
<div class="login-box main-content">
<header><h2>Admin</h2></header>
<section>
<form id="form" method="post" class="clearfix" action="admin.php">
<input type="hidden" name="login"  />
<p><input type="password"  class="full" value="" name="password"/></p>
<p class="clearfix"><button class="button button-gray fr" type="submit">Login</button></p>
</form>
</section>
</div>

<?php
}
?>
    </body>
</html>
