<?php
require_once ('start.php');
$error = '';
if (isset($_POST['submitBtn']))
{
	
	if($_POST['sqlusername'] == '')
	{
		$error = "<p class='msg_error'>Please fill in your username</p>";
	}
	elseif($_POST['sqlpassword'] == '')
	{
		$error = "<p class='msg_error'>Please fill in your password</p>";
	}
	else
	{
		$test_connection = @mssql_pconnect($MSSQL_DATABASE_IP, $_POST['sqlusername'], $_POST['sqlpassword']);
		if(!$test_connection)
		{
			$error = "<p class='msg_error'><b>Connection failed!</b>&nbsp;&nbsp;&nbsp;&nbsp; ".mssql_get_last_message()."</p>";
		}
		else
		{
			$_SESSION['admin_name'] = $_POST['sqlusername'];
			echo "<script type='text/javascript'>window.location='index.php'; </script>";
			die();	
		}
	}
}
$smarty->assign("ERROR", $error); 
$smarty->display('login.tpl');
?>