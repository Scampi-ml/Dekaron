<?php
if(ALLOW_OPEN != 1 && ALLOW_OPEN != 2) {
Header('HTTP/1.1 403');
exit(0);
}
echo '<table><tr><td class="header">Registration</td></tr>';
if ($_GET['step'] == "")
{
	echo "<form action=?do=register&step=2 method=POST>
				<tr><td>Account:<br><input type=text name=accname maxlength=12></td></tr>
				<tr><td>Password:<br><input type=password name=accpass1 maxlength=12></td></tr>
				<tr><td>Password (Again):<br><input type=password name=accpass2 maxlength=12></td></tr>
				<tr><td>E-Mail:<br><input type=text name=accmail maxlength=50></td></tr>
				<tr><td><input type=submit value='Create Account'></td></tr></form>
				<tr><td>It is highly advised that you do <b>NOT</b> use the same password as used on previous servers.
				<br>Please use a real e-mail so when password recovery is implemented, you can recover your password if needed.</td></tr>";
}
elseif ($_GET['step'] == "2")
{
	$result1 = mssql_query("SELECT * FROM account.dbo.USER_PROFILE WHERE user_id = '".mssql_escape($_POST['accname'])."'");
	$result2 = mssql_query("SELECT * FROM account.dbo.Tbl_user WHERE user_id = '".mssql_escape($_POST['accname'])."'");
	$result3 = mssql_query("SELECT * FROM account.dbo.Tbl_user WHERE user_mail = '".mssql_escape($_POST['accmail'])."'");
	$row1 = mssql_num_rows($result1);
	$row2 = mssql_num_rows($result2);
	$row3 = mssql_num_rows($result3);
	echo '<tr><td>';
	if(empty($_POST['accname']) || empty($_POST['accpass1']) || empty($_POST['accpass2'])|| empty($_POST['accname']) || empty($_POST['accmail'])) 
	{
		echo 'You didn\'t fill in all the fields. <a href=javascript:history.back()>Go Back</a>';
	}
	elseif($row1 > '0' || $row2 > '0') 
	{
		echo 'This Account name already exists. <a href=javascript:history.back()>Go Back</a>';
	}
	elseif($row3 > '0')
	{
		echo "This E-Mail is already in use. <a href=javascript:history.back()>Go Back</a>";
	}
	elseif($_POST['accpass1'] != $_POST['accpass2']) 
	{
		echo "The passwords do not match. <a href=javascript:history.back()>Go Back</a>";
	}
	elseif($_POST['accpass1'] == $_POST['accname'])
	{
		echo "Account name and password can't be the same. <a href=javascript:history.back()>Go Back</a>";
	}
	elseif(!preg_match("/^[0-9a-zA-Z]{3,15}$/i", $_POST['accname'])) 
	{
		echo "Enter a account name only with 0-9, a-z and A-Z. <a href=javascript:history.back()>Go Back</a>";
	}
	elseif(!preg_match("/^[0-9a-zA-Z]{3,15}$/i", $_POST['accpass1']))
	{
		echo "Enter a password only with 0-9 , a-z and A-Z. <a href=javascript:history.back()>Go Back</a>";
	}
	elseif(!preg_match("/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/i",$_POST['accmail'])) 
	{
		echo "You have entered and invalid e-mail format. <a href=javascript:history.back()>Go Back</a>";
	}
	elseif(strlen($_POST['accname']) < 3 || strlen($_POST['accname']) > 15)
	{
		echo "The Account name must be 3 to 15 letters long. <a href=javascript:history.back()>Go Back</a>";
	}
	elseif(strlen($_POST['accpass1']) < 3 || strlen($_POST['accpass1']) > 15) 
	{
		echo "The Password must be 3 to 15 letters long. <a href=javascript:history.back()>Go Back</a>";
	} 
	else 
	{
		$dk_time=strftime("%y%m%d%H%M%S");
		list($usec1, $sec1) = explode(" ",microtime());
		$dk_user_no=$dk_time.substr($usec1,2,2);
		$accpass = md5($_POST['accpass1']);
		mssql_query("INSERT INTO account.dbo.USER_PROFILE (user_no,user_id,user_pwd,resident_no,user_type,login_flag,login_tag,ipt_time,login_time,logout_time,user_ip_addr,server_id) VALUES ('".mssql_escape($dk_user_no)."','".mssql_escape($_POST['accname'])."','".mssql_escape($accpass)."','801011000000','1','0','Y','".mssql_escape($date)."',null,null,null,'000')");
		mssql_query("INSERT INTO account.dbo.Tbl_user (user_no,user_id,user_mail) VALUES ('".mssql_escape($dk_user_no)."','".mssql_escape($_POST['accname'])."','".mssql_escape($_POST['accmail'])."')");
		echo 'The account was successfully created.';
	}
	echo '</td></tr>';
}
echo '</table>';
?>
