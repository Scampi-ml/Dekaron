<?php
session_start();
// did someone post ?
if($_SERVER['REQUEST_METHOD'] == "POST")
{
	
	// start DISPLAY errors
	$login_errors = array();
	
	// clean members_display_name
	$members_display_name = trim($_POST['members_display_name']);
	
	// clean password
	$password = trim($_POST['PassWord']);
	
		

	// check empty values
	if($members_display_name == '')
	{
		$login_error = 'Please fill in your Account Name.';
	}
	
	if($password == '')
	{
		$login_error = 'Please fill in your Password.';
	}
	
	if(preg_match('/[^0-9A-Za-z]/', $members_display_name))
	{
		$login_error = 'You can only use letters and numbers in your account name!';
	}	

	// redirect ?
	$redirect = $_POST['redirect'];

	if(count($login_errors) == '0')
	{
		// timeout session start
		include ('./userpanel/class_dekaron.php');
		$dekaron = new dekaron_class();
		
		$dekaron->mssql_host = 'localhost';
		$dekaron->mssql_user = 'sa';
		$dekaron->mssql_pasw = 'xxxxx';		
		
		if ($dekaron->isValid($members_display_name) == true && $dekaron->isValid($password) == true)
		{			
			$result = $dekaron->SQLquery("SELECT * FROM account.dbo.user_profile WHERE user_id = '".$members_display_name."' AND user_pwd = '".md5($password)."' ");
			$getAccNum = $dekaron->SQLfetchNum($result);
			$getAcc = $dekaron->SQLfetchArray($result);
			
			//$result77 = $dekaron->SQLquery("SELECT * FROM account.dbo.user_data WHERE user_no = '".$getAcc['user_no']."' ");
			//$getData = $dekaron->SQLfetchArray($result77);
			
			if($getAccNum == '0')
			{	
				$login_error = 'Username or password match not found!';
			}
			else
			{
				
				echo '
				<!doctype html>
				<html lang="en">
				<head>
					<meta charset="utf-8">
					<title>Login</title>
				</head>
				<body>				
				<br><br><br><br><br><br><br><br><br><br><br><br>
				<div class="container" id="wrap">
					<div class="login_wrap">Loading your account settings... Please wait.</div>
				</div>				
				</body>
				</html>';	
				
				$_SESSION['USER'] = $getAcc['user_id'];
				$_SESSION['USERNO'] = $getAcc['user_no'];
				
				// added for GMs
				/*
				if($getData['isgm'] == '1')
				{
					$_SESSION['ISGM'] = '1';
				}
				else
				{
					$_SESSION['ISGM'] = '0';
				}
				*/
				
				// log login
				//$dekaron->SQLquery("INSERT INTO game.dbo.USER_CP_LOGIN_LOG(time,ip,user_no,user_name) VALUES ('".time()."', '".$_SESSION['CURR_IP']."', '".$_SESSION['USERNO']."', '".$_SESSION['USER']."')  ");			
				
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
?>
