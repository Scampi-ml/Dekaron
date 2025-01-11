<?php
if (isset($_POST) && !empty($_POST))
{
	require_once ('engine/class_validate.php');
    $validate = new FormValidator();
	
	$validate->check("user_id","req","Please fill in the user id");
	$validate->check("user_mail","req","Please fill in the email");
	$validate->check("user_pwd","req","Please fill in the password");
	
	$validate->check("user_id","alnum","You can only use A-Z / 0-9 characters in your user id");
    $validate->check("user_mail","email","The input for Email should be a valid email value");
	$validate->check("user_pwd","alnum","You can only use A-Z / 0-9 characters in your password");
	
    if($validate->ValidateForm() == false)
    {
		echo notice_message_admin('You have the following errors:<br>'.$validate->GetErrors().'', '0', '1', 'index.php?get=module_edit_account&account='.$_GET['account'].'');
    }
    else
	{
		if($config->get('mail_table', 'settings_edit_account') == 'user_profile')
		{
			$SQLquery1 = $db->SQLquery("UPDATE account.dbo.USER_PROFILE SET user_mail = '%s', user_id = '%s', user_pwd = '%s', login_flag = '%s', login_tag = '%s' WHERE user_no = '%s'", $_POST['user_mail'], $_POST['user_id'],  $_POST['user_pwd'], $_POST['login_flag'], $_POST['login_tag'],$_GET['account']);
		}
		else
		{
			$SQLquery1 = $db->SQLquery("UPDATE account.dbo.USER_PROFILE SET user_id = '%s', user_pwd = '%s', login_flag = '%s', login_tag = '%s' WHERE user_no = '%s'", $_POST['user_id'], $_POST['user_pwd'], $_POST['login_flag'], $_POST['login_tag'], $_GET['account'] );
			$SQLquery1 = $db->SQLquery("UPDATE account.dbo.tbl_user SET user_mail = '%s' WHERE user_no = '%s'", $_POST['user_mail'], $_GET['account'] );
		}
		echo notice_message_admin('Account successfully updated', '1', '0', 'index.php?get=module_edit_account&account='.$_GET['account'].'');
	}
}
else
{

if($config->get('mail_table', 'settings_edit_account') == 'user_tbl')
{
	$SQLquery1 = $db->SQLquery("
	SELECT 
	  account.dbo.Tbl_user.user_mail,
	  account.dbo.USER_PROFILE.user_no,
	  account.dbo.USER_PROFILE.[user_id],
	  account.dbo.USER_PROFILE.user_pwd,
	  account.dbo.USER_PROFILE.login_flag,
	  account.dbo.USER_PROFILE.login_tag,
	  account.dbo.USER_PROFILE.ipt_time,
	  account.dbo.USER_PROFILE.login_time,
	  account.dbo.USER_PROFILE.logout_time,
	  account.dbo.USER_PROFILE.user_ip_addr
	FROM
	  account.dbo.USER_PROFILE
	  INNER JOIN account.dbo.Tbl_user ON (account.dbo.USER_PROFILE.user_no = account.dbo.Tbl_user.user_no)
	WHERE
	  account.dbo.Tbl_user.user_no = '%s'", $_GET['account']
	  );
}
else
{
	$SQLquery1 = $db->SQLquery("
	SELECT 
	  account.dbo.USER_PROFILE.user_mail,
	  account.dbo.USER_PROFILE.user_no,
	  account.dbo.USER_PROFILE.[user_id],
	  account.dbo.USER_PROFILE.user_pwd,
	  account.dbo.USER_PROFILE.login_flag,
	  account.dbo.USER_PROFILE.login_tag,
	  account.dbo.USER_PROFILE.ipt_time,
	  account.dbo.USER_PROFILE.login_time,
	  account.dbo.USER_PROFILE.logout_time,
	  account.dbo.USER_PROFILE.user_ip_addr
	FROM
	  account.dbo.USER_PROFILE
	WHERE
	  account.dbo.Tbl_user.user_no = '%s'", $_GET['account']
	  );
}

$getAccountInfo = $db->SQLfetchArray($SQLquery1);
?>
<form method="post" action="">
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
	<tr>
		<td align="center" class="panel_title" colspan="2">Edit Account</td>
	</tr>
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>User Number</b><br>Must not be changed, only for info only</td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><?php echo htmlspecialchars($getAccountInfo['user_no']); ?></td>
	</tr>
	<tr class="">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>User Id</b><br>This is the login for the account<br><small>0-9 A-Z Only</small></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="user_id" size="30" maxlength="20" value="<?php echo htmlspecialchars($getAccountInfo['user_id']); ?>" /></td>
	</tr>
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Email</b><br>Must be a valid email to recive user info and other info<br><small>example@host.com</small></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="user_mail" size="30" value="<?php echo htmlspecialchars($getAccountInfo['user_mail']); ?>"  /></td>
	</tr>
	<tr class="">
	  <td align="left" class="panel_text_alt1" width="45%" valign="top"><b>Password</b><br>Use a MD5 encoded password only<br><small>MD5 String Only</small></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="user_pwd" size="30" maxlength="32" value="<?php echo htmlspecialchars($getAccountInfo['user_pwd']); ?>"  /><br><a href="javascript: md5passw();">Create MD5 Password</a></td>
	</tr>
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Game Access</b><br>If this is set to 'No' user will not be able to login to the game<br></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top">
        	<select name="login_tag">
			<?php 
                switch (htmlspecialchars($getAccountInfo['login_tag']))
				{
                    case 'Y':
                        echo '<option value="N">No</option><option value="Y" selected>Yes</option>';
                        break;
                    case 'N':
                        echo '<option value="N" selected>No</option><option value="Y">Yes</option>';
                        break;
                }
			?>
            </select>
        </td>
	</tr>
	<tr class="">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Online State</b><br>If this is set to 'Yes' the user is currently logged into the game<br></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top">
        	<select name="login_flag">
			<?php 
                switch (htmlspecialchars($getAccountInfo['login_flag']))
				{
                    case '1100':
                        echo '<option value="0">No</option><option value="1100" selected>Yes</option>';
                        break;
                    case '0':
                        echo '<option value="0" selected>No</option><option value="1100">Yes</option>';
                        break;
                }
			?>
            </select>
        </td>
	</tr>
	<tr>
		<td align="center" class="panel_title" colspan="2">Info</td>
	</tr>
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Last Login</b><br>Last known login from the game</td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><?php echo htmlspecialchars($getAccountInfo['login_time']); ?></td>
	</tr>
	<tr class="">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Last Logout</b><br>Last known logout from the game</td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><?php echo htmlspecialchars($getAccountInfo['logout_time']); ?></td>
	</tr>
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Ip Address</b><br>The users last known Ip Address</td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><?php echo htmlspecialchars(decodeIp($getAccountInfo['user_ip_addr'])); ?></td>
	</tr>    
    <tr>
    	<td align="right" class="panel_buttons" colspan="2"><input type="submit" value="Update" onclick="ask_url('Are you sure you want to update?','index.php?get=module_edit_account&account=<?php echo $_GET['account']; ?>')"></td>
    </tr>
</table>
</form>
<?php
}
?>
