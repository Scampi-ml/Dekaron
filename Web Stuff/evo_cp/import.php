<?php
ob_start();
session_start();
$userno = 0;
if (!defined('imported'))
{
	define('imported',1);
	echo "<font color=white>";
	echo "<body bgcolor='#101010'>";
	$mssql = array('host' => "127.0.0.1",'user' => "sa",'pass' => "password");
	$con = mssql_connect($mssql['host'],$mssql['user'],$mssql['pass']);
	function createsessions($username,$password)
	{
		//Add additional member to Session array as per requirement
		session_register();
		$_SESSION["gdusername"] = $username;
		$_SESSION["gdpassword"] = $password;		
		if(isset($_POST['remme']))
		{
			//Add additional member to cookie array as per requirement
			setcookie("gdusername", $_SESSION['gdusername'], time()+60*60*24*100, "/");
			setcookie("gdpassword", $_SESSION['gdpassword'], time()+60*60*24*100, "/");
			return;
		}
	}
	function clearsessionscookies()
	{
		unset($_SESSION['gdusername']);
		unset($_SESSION['gdpassword']);
		session_unset();
		session_destroy(); 
		setcookie ("gdusername", "",time()-60*60*24*100, "/");
		setcookie ("gdpassword", "",time()-60*60*24*100, "/");
	}
	if($_GET['logout'] == "yes")
	{
		clearsessionscookies();
		echo "<meta http-equiv='REFRESH' content='0;url=index.php'>";
	}
	function confirmUser($username,$password,$con)
	{
		$result1 = mssql_query("select * from account.dbo.user_profile WHERE user_id = '".$username."' AND user_pwd = '".$password."'",$con);
		while($list = mssql_fetch_array($result1))
		{
			$GLOBALS['userno'] = $list['user_no'];
			return true;
		}
		$userno = "0";
		return false;
	}
	function checkLoggedin($con)
	{
		if(isset($_SESSION['gdusername']) && isset($_SESSION['gdpassword']))
		{
			if(confirmUser($_SESSION['gdusername'],$_SESSION['gdpassword'],$con))
			{
				echo "<a style=\"position: absolute;left: 0;color: #00FF00;\" href='index.php?logout=yes'>Log out</a>";
				return true;
			}
			else
			{
				clearsessionscookies();
				return false;
			}
		}
		elseif(isset($_COOKIE['gdusername']) && isset($_COOKIE['gdpassword']))
		{
			if(confirmUser($_COOKIE['gdusername'],$_COOKIE['gdpassword'],$con))
			{
				createsessions($_COOKIE['gdusername'],$_COOKIE['gdpassword']);
				echo "<a style=\"position: absolute;left: 0;color: #00FF00;\" href='index.php'>Return to main page</a>";
				return true;
			}
			else
			{
				clearsessionscookies();
				return false;
			}
		}
		else
			return false;
	}
	function anti_injection($sql)
	{
		$sql = preg_replace(sql_regcase("/(from|select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/"),"",$sql);
		$sql = trim($sql);
		$sql = strip_tags($sql);
		$sql = addslashes($sql);
		return $sql;
	}
	function isYours($userid, $charid, $con)
	{
		$result1 = mssql_query("SELECT * FROM character.dbo.user_character WHERE user_no = '".$userid."' and character_no = '".$charid."'",$con);
		$row1 = mssql_num_rows($result1);
		if($row1 != 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function checkBag($charid, $indexId, $con)
	{
		$result1 = mssql_query("SELECT * FROM character.dbo.user_bag where wIndex = ".$indexId." and character_no = '".$charid."'",$con);
		$row1 = mssql_num_rows($result1);
		if($row1 != 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}
?>