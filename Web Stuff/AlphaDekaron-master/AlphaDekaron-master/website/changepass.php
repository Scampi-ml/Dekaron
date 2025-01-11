<?php
if(ALLOW_OPEN != 1) {
Header('HTTP/1.1 403');
exit(0);
}

if(empty($_POST['select'])) 
{
	$_SESSION['token'] = sha1(microtime(true).uniqid($_SERVER['REMOTE_ADDR'], true).rand());
	$result = mssql_query("SELECT user_id,user_mail FROM account.dbo.Tbl_user WHERE user_no = '".mssql_escape($_SESSION['user_no'])."'");
	$row = mssql_fetch_row($result);
	echo "<table><form action=?do=changepass method=POST>
				<tr><td class=header>Change Password</td></tr>
				<tr><td>Account: ",$row[0],"</td></tr>
				<tr><td>Old Password:<br><input type=password name=old maxlength=20></td></tr>
				<tr><td>New Password:<br><input type=password name=new1 maxlength=20></td></tr>
				<tr><td>New Password (again):<br><input type=password name=new2 maxlength=20></td></tr>
				<tr><td>E-Mail: ",$row[1],"</td></tr>
				<tr><td colspan=1> <input type=submit name=select value='Update Password'><input type=hidden name=token value='",$_SESSION['token'],"'></td></tr>
				</form></table>";
} 
elseif($_POST['select'] == 'Update Password' && $_POST['token'] == $_SESSION['token']) 
{
	unset($_SESSION['token']);
	$result1 = mssql_query("SELECT user_pwd FROM account.dbo.user_profile WHERE user_no = '".mssql_escape($_SESSION['user_no'])."'");
	$count1 = mssql_fetch_array($result1);
	if(empty($_POST['old']) || empty($_POST['new1']) || empty($_POST['new2'])) 
	{
		echo "You have not filled in all fields.<br><a href='javascript:history.back()'>Go Back</a>";
	} 
	elseif(!preg_match("/[0-9a-zA-Z]?/", $_POST['new1'])) 
	{
		echo "The password contains characters which are not allowed in the password.<br><a href='javascript:history.back()'>Go Back</a>";
	} 
	elseif(strlen($_POST['new1']) < 3 || strlen($_POST['new1']) > 15) 
	{
		echo "The password must be at least 3 characters long and may exceed 15 characters in length.<br><a href='javascript:history.back()'>Go Back</a>";
	}
	elseif($_POST['new1'] <> $_POST['new2']) 
	{
		echo "The new passwords do not match!<br><a href='javascript:history.back()'>Go Back</a>";
	}
	elseif($count1[0] <> md5($_POST['old']))
	{
		echo "Invalid password!<br><a href='javascript:history.back()'>Go Back</a>";
	}  
	else 
	{
		$_SESSION['accpass'] = md5($_POST['new1']);
		mssql_query("UPDATE account.dbo.USER_PROFILE SET user_pwd = '".mssql_escape($_SESSION['accpass'])."' WHERE user_no = '".mssql_escape($_SESSION['user_no'])."'");
		mssql_query("INSERT INTO osds.dbo.sessionlog values (getdate(),'".mssql_escape($_SESSION['accname'])."', '".mssql_escape($_SERVER['REMOTE_ADDR'])."', 'Password Change')");
		echo "Your password has been successfully updated.";
	}
}
else
{
unset($_SESSION['token']);
echo 'Invalid action!';
}
?>
