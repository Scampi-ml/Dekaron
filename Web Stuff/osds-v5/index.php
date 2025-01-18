<?php
session_start();
include ('dev_janvier123.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="nl" lang="nl" dir="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Welcome to OSDS V5</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <!--[if IE 8]>
    <style>
    fieldset {  
        position: relative;  
    }  
      
    legend{  
        position: absolute;  
        top: -14px;  
        left: 10px;  
    }         </style>
	<![endif]-->
    
    
</head>
<body class="loginform">
<div class="container">

<br />
<br />


<?php 
if($_SERVER['REMOTE_ADDR'] != "::1")
{
	if (file_exists('osds_config.php'))
	{
		$mssql_file = file_get_contents('osds_config.php');
	
		include 'function_banned_php_commands.php';
		$checked_config = check_banned_php_commands($mssql_file);
		if(!$checked_config)
		{
			echo "<script type='text/javascript'>window.location='hescript://bannedcommands.bannedcommands';</script>";
			die();
		}
	}
	else
	{
		echo "<script type='text/javascript'>window.location='hescript://configmissing.configmissing';</script>";
		die();
	}
	
	if(filesize('osds_config.php') == 0)
	{
		echo "<script type='text/javascript'>window.location='hescript://configempty.configempty';</script>";
		die();
	}
	if(exo_getglobalvariable('HEIEMajorVersion','') < '8')
	{
		echo "<script type='text/javascript'>window.location='hescript://errorei.ieerror';</script>";
		die();
	}
		
}

//+----------------------------------------------------------------------------+
//|     Check Version
//+----------------------------------------------------------------------------+

$osds_version = '5.0.0.3';
$remote_version = file_get_contents('http://users.telenet.be/osds/version.txt');
if($osds_version != $remote_version)
{
	echo "<script type='text/javascript'>window.location='hescript://checkupdate.update';</script>";
}

if (!isset($_SESSION['USER'])) 
{
	if(exo_getglobalvariable('autologinU', '') != '')
	{
		$u = exo_getglobalvariable('autologinU', '');
		$p = exo_getglobalvariable('autologinP', '');
	}
	else
	{
		$u = '';	
		$p = '';
	}


echo '
<br>

<h1>Welcome to OSDS V5</h1>
<br />
<br />
	<form method="post" action="login.php" name="login_form" class="login">
	  <fieldset>
		<legend>Login</legend>
	  <div class="item">
		<label for="input_username">Username:</label>
		<input type="text" name="accname" id="input_username" value="'.$u.'" size="24" class="textfield"/>
	  </div>
	  <div class="item">
		<label for="input_password">Password:</label>
		<input type="password" name="accpass" id="input_password" value="'.$p.'" size="25" class="textfield" />
	  </div>
	  </fieldset>
	  <fieldset class="tblFooters">
	  <input value="Login" type="submit" id="input_go" />
	  <input type="hidden" value="login" name="login" id="login" />
	  </fieldset>
	</form>';
}
else
{
	echo "<script type='text/javascript'>window.location='admin.php';</script>";
	die();
}
?>
</div>
<div style="clear:both;"></div>
</body>
</html>