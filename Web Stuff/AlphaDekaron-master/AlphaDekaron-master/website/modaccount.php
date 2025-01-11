<?php
if(ALLOW_OPEN != '1') 
{
	Header('HTTP/1.1 403');
	exit(0);
}
else
{
	
	if ($_SESSION['isGM'] != '2')
	{
		Header('HTTP/1.1 403');
		exit(0);
	}
}
if(empty($_POST['select']))
{
	echo "<table><form action=?do=modaccount method=POST>
			<tr><td class=header colspan=2 >Modify account</td></tr>
			<tr><td><select name=type><option value=account selected>Account Name</option><option value=charname>Character Name</option></select><input type=text name=name maxlength=20></td></tr>
			<tr><td colspan=2><input type=submit name=select value=Go></td></tr>
			</form></table>";
}
elseif($_POST['select'] == 'Go')
{
	if (empty($_POST['name']))
	{
		echo 'Name cannot be empty!';
	}
	else
	{
		if($_POST['type'] == 'account')
		{
			$result1 = mssql_query("SELECT user_id, user_mail FROM account.dbo.tbl_user WHERE user_id = '".mssql_escape($_POST['name'])."'");
		}
		elseif($_POST['type'] == 'charname')
		{
			$result1 = mssql_query("SELECT account.dbo.tbl_user.user_id, user_mail FROM account.dbo.tbl_user left join character.dbo.user_character on character.dbo.user_character.user_no = account.dbo.tbl_user.user_no WHERE character.dbo.user_character.character_name = '".mssql_escape($_POST['name'])."'");
		}
		else
		{
		 echo 'Invalid type.';
		 exit(0);
		}
		$doesExist = mssql_num_rows($result1);
		if ($doesExist == '1')
		{
			$info = mssql_fetch_array($result1);
			echo "<form action=?do=modaccount method=POST>
			<table>
			<tr><td class=header colspan=2 >Modify account</td></tr>
			<tr><td>Account: ",htmlspecialchars($info[0]),"<input type=hidden name=aid value='".htmlspecialchars($info[0])."'></td></tr>
			<tr><td>Password: <input type=password name=new maxlength=20></td></tr>
			<tr><td>E-Mail: ",htmlspecialchars($info[1]),"</td></tr>
			<tr><td colspan=2><input type=submit name=select value=Update></td></tr>
			</table></form>";
		}
		elseif ($doesExist == '0')
		{
			echo 'Account not found!';
		}
		else
		{
			echo 'Contact your administrator and tell them, "the shit has hit the fan!"';
		}
	}
}
elseif($_POST['select'] == 'Update')
{
	if(empty($_POST['new'])) 
	{
		echo "You have not filled in all fields.<br><a href='javascript:history.back()'>Go Back</a>";
	} 
	elseif(!preg_match("/[0-9a-zA-Z]?/", $_POST['new'])) 
	{
		echo "The password contains characters which are not allowed in the password.<br><a href='javascript:history.back()'>Go Back</a>";
	} 
	elseif(strlen($_POST['new']) < 3 || strlen($_POST['new']) > 15) 
	{
		echo "The password must be at least 3 characters long and may exceed 15 characters in length.<br><a href='javascript:history.back()'>Go Back</a>";
	}
	else 
	{
		$pass = md5($_POST['new']);
		mssql_query("UPDATE account.dbo.USER_PROFILE SET user_pwd = '".mssql_escape($pass)."' WHERE user_id = '".mssql_escape($_POST['aid'])."'");
		echo '',htmlspecialchars($_POST['aid']),'\'s password has been successfully updated.';
	}
}
?>