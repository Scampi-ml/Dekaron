<?php
include_once("conf.php");
if (($_POST['log'] == 'Login' or isset($_SESSION['accname'])) && $dbFail <> 1)
{
	if (!$_SESSION['accname']) 
	{
	$_SESSION['accname'] = $_POST['accname'];
	$_SESSION['accpass'] = md5($_POST['accpass']);
	}
	$accountInfo = mssql_query("SELECT user_no FROM account.dbo.user_profile WHERE user_id = '".mssql_escape($_SESSION['accname'])."' AND user_pwd = '".mssql_escape($_SESSION['accpass'])."' AND login_tag = 'Y'"); 
	if (!$accountInfo)
	{
		echo 'Unable to connect to the database.';
	}	
	else 
	{
		$logMatch = mssql_num_rows($accountInfo);
		if ($logMatch == "1")
		{
			$error = 0;
			$getAccount = mssql_fetch_array($accountInfo);
			$_SESSION['user_no'] = $getAccount[0];
			$gmInfo = mssql_query("SELECT auth, news FROM osds.dbo.auth where account = '".mssql_escape($_SESSION['accname'])."'");
			$gmMatch = mssql_num_rows($gmInfo);
			if ($gmMatch == "1")
			{
				$getGM = mssql_fetch_array($gmInfo);
				$_SESSION['isGM'] = $getGM[0];
				$_SESSION['news'] = $getGM[1];
			}
			else
			{
				$_SESSION['isGM'] = 0;
			}
		}
		elseif ($logMatch == '0')
		{	
			$error = 1;
			mssql_query("INSERT INTO osds.dbo.sessionlog values (getdate(),'".mssql_escape($_SESSION['accname'])."', '".mssql_escape($_SERVER['REMOTE_ADDR'])."', 'Login Fail')");
			session_unset();
			$errormsg = 'Invalid username or password.';
		}
		else
		{
		$error = 1;
		$errormsg = 'Account confliction occured! Please contact your administrator and tell them, "the shit has hit the fan"';
		}
	}
}
?>