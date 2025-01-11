<?php
include "scripts/bancheck.php";
include('start.php');
$login_error = '';
// did someone post ?
if($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['login'] == 'Log in')
{
	if(empty($_POST['password']) || empty($_POST['username']))
	{
		$login_error = 'Please fill in your <b>username</b> and <b>password</b> and  try again';
	}

	if(empty($_POST['username']))
	{
		$login_error = 'Please fill in your <b>username</b> and try again';
	}
	
	if(empty($_POST['password']))
	{
		$login_error = 'Please fill in your <b>password</b> and try again';
	}
	
	if(preg_match('/[^0-9A-Za-z]/', $_POST['username']))
	{
		$login_error = 'You can only use letters and numbers in your account name!';
	}

	if($login_error == '')
	{
		// timeout session start
		include ('userpanel/class_dekaron.php');
		$dekaron = new dekaron_class();
		
		$dekaron->mssql_host = '37.59.180.41';
		$dekaron->mssql_user = 'SaBaker1893';
		$dekaron->mssql_pasw = 'ImPP8pL0h';	
	
		
		if ($dekaron->isValid($_POST['username']) == true && $dekaron->isValid($_POST['password']) == true)
		{			
			$result = $dekaron->SQLquery("SELECT * FROM account.dbo.user_profile WHERE user_id = '".$_POST['username']."' AND user_pwd = '".md5($_POST['password'])."' ");
			$getAccNum = $dekaron->SQLfetchNum($result);
			$getAcc = $dekaron->SQLfetchArray($result);
			
			$result77 = $dekaron->SQLquery("SELECT * FROM account.dbo.user_data WHERE user_no = '".$getAcc['user_no']."' ");
			$getData = $dekaron->SQLfetchArray($result77);
			
			if($getAccNum == '0')
			{	
				$login_error = 'Username or password match not found! Please try again.';
			}
			else
			{
				
				echo '
				<!DOCTYPE html>
				<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
				<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
				<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
				<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
					<head>
						<meta charset="utf-8">
						<title>Loading</title>
						<link rel="shortcut icon" href="userpanel/img/favicon.ico">
						<link rel="stylesheet" href="userpanel/css/bootstrap.css">
						<link rel="stylesheet" href="userpanel/css/plugins.css">
						<link rel="stylesheet" href="userpanel/css/main.css">
						<link rel="stylesheet" href="userpanel/css/themes.css">
						<script src="userpanel/js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
					</head>
					<body>
						<div class="error-container standalone themed-border-leaf">
							<a href="javascript: history.go(-1)" class="btn btn-success"><i class="icon-chevron-left"></i> Go Back</a>
							<div class="error-text text-error"> Loading your account....</div>
						</div>
					</body>					
				</html>					
				';	
				
				$_SESSION['USER'] = $getAcc['user_id'];
				$_SESSION['USERNO'] = $getAcc['user_no'];
				
				if($getData['isgm'] == '1')
				{
					$_SESSION['ISGM'] = '1';
				}
				else
				{
					$_SESSION['ISGM'] = '0';
				}
				include ('scripts/function_getip.php');
				
				// log login
				$dekaron->SQLquery("INSERT INTO game.dbo.USER_CP_LOGIN_LOG(time,ip,user_no,user_name) VALUES ('".time()."', '".fetch_ip()."', '".$_SESSION['USERNO']."', '".$_SESSION['USER']."')  ");			
				
				$query1 = $dekaron->SQLquery("SELECT character_no,character_name,user_no FROM character.dbo.user_character WHERE user_no = '".$getAcc['user_no']."' ");
				$getCharsNum = $dekaron->SQLfetchNum($query1);
				
				if($getCharsNum == 0)
				{
					$_SESSION['CHARACTERS'] = 0;
					$_SESSION['CHARACTERSNUM'] = 0;
				}
				else
				{
					$_SESSION['CHARACTERSNUM'] = $getCharsNum;
					$characters = array();
					while($getChars = $dekaron->SQLfetchArray($query1))
					{
						$characters[] = $getChars['character_no'].'-'.$getChars['character_name'];
					}
					$_SESSION['CHARACTERS']  = $characters;
				}
				echo "<script type='text/javascript'>window.location='userpanel/index.php'; </script>";
			}
		}
		else
		{
			$login_error = 'Fucking noob hacker!';
		}
	}
}
$smarty->assign("LOGIN_ERROR", $login_error);
$smarty->display('login.tpl');
?>