<?php
if (isset($_POST) && !empty($_POST))
{
	require_once ('engine/class_validate.php');
    $validate = new FormValidator();
	
	$validate->check("admin_name","req","Please fill in the admin name");
	$validate->check("admin_pwd","req","Please fill in the admin password");
	
	$validate->check("admin_name","alnum","You can only use A-Z / 0-9 characters in your admin name");
	
	
    if($validate->ValidateForm() == false)
    {
		echo notice_message_admin('You have the following errors:<br>'.$validate->GetErrors().'', '0', '1', 'index.php?get=module_admin_add');
    }
	else
	{
		if(!is_dir("engine/servers/".$_COOKIE["server"]."/".$_POST['admin_name']."/"))
		{
			mkdir("engine/servers/".$_COOKIE["server"]."/".$_POST['admin_name']."/", 0777);
		}
		
		if(!file_exists("engine/servers/".$_COOKIE["server"]."/".$_POST['admin_name']."/config.ini"))
		{
			$default_config_ini = file_get_contents('engine/config.ini');
			
			$file = fopen("engine/servers/".$_COOKIE["server"]."/".$_SESSION['_POST']."/config.ini", 'w');
			fwrite($file, $default_config_ini);
			fclose($file);
		}
		
		if(!file_exists("engine/servers/".$_COOKIE["server"]."/".$_POST['admin_name']."/permissions.ini"))
		{
			$default_permissions_ini = file_get_contents('engine/permissions.ini');
			
			$file = fopen("engine/servers/".$_COOKIE["server"]."/".$_SESSION['_POST']."/permissions.ini", 'w');
			fwrite($file, $default_permissions_ini);
			fclose($file);
		}

		echo notice_message_admin('Admin successfully added', '1', '0', 'index.php?get=module_admin_add');
		
	}
}
else
{
	$type = $config->get('form_type', 'settings_add_admin');
?>
<form method="post" action="">
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
	<tr>
		<td align="center" class="panel_title" colspan="2">Add Admin</td>
	</tr>
	<tr class="">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Admin Name</b><br>This is the login for the account<br><small>0-9 A-Z Only</small></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="admin_name" size="30" maxlength="20" value="" /></td>
	</tr>
	<tr class="even">
	  <td align="left" class="panel_text_alt1" width="45%" valign="top"><b>Password</b><br>The password to login<br></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="<?php echo htmlspecialchars($type); ?>" name="admin_pwd" size="30" maxlength="32" value=""  /></td>
	</tr>
    <tr>
    	<td align="right" class="panel_buttons" colspan="2"><input type="submit" value="Add Admin" onclick="ask_url('Are you sure you want to add this admin?','index.php?get=module_admin_add')"></td>
    </tr>
</table>
</form>
<?php
}
?>
