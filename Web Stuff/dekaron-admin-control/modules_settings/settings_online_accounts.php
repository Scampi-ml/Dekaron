<?php
if (isset($_POST) && !empty($_POST))
{
	reset ($_POST);
	while (list ($key, $val) = each ($_POST))
	{
		$config->set( $key, $val, 'settings_edit_account' );
	}
	echo notice_message_admin('Settings successfully saved', '1', '0', 'index.php?get=module_settings&php=settings_online_accounts.php');
}
else
{
?>
<form method="post" action="">
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
	<tr>
		<td align="center" class="panel_title" colspan="2">Edit Account Settings</td>
	</tr>
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Email Table</b>
        	<br>Where is the email data stored?
            <br>By default this is stored into the 'Account Database > tbl_user'
        </td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top">
        	<select name="mail_table">
			<?php 
                switch ($config->get('mail_table', 'settings_online_accounts'))
				{
                    case 'tbl_user':
                        echo '<option value="tbl_user" selected>Account Database > tbl_user</option><option value="user_profile" >Account Database > user_profile</option>';
                        break;
                    case 'user_profile':
                        echo '<option value="user_profile" selected>Account Database > tbl_user</option><option value="user_profile">Account Database > user_profile</option>';
                        break;
                }
			?>
            </select>
        </td>
	</tr>
    
    <tr>
    	<td align="right" class="panel_buttons" colspan="2"><input type="submit" value="Save Settings"></td>
    </tr>
</table>
</form>
<?php
}
?>