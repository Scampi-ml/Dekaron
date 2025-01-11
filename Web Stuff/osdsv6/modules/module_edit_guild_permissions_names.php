<?php
if (isset($_POST) && !empty($_POST))
{
	require_once ('engine/class_validate.php');
    $validate = new FormValidator();
	
	
	$validate->check("0","req","Please fill in the Guild permission name 0");
	$validate->check("1","req","Please fill in the Guild permission name 1");
	$validate->check("2","req","Please fill in the Guild permission name 2");
	$validate->check("3","req","Please fill in the Guild permission name 3");
	$validate->check("4","req","Please fill in the Guild permission name 4");
	$validate->check("5","req","Please fill in the Guild permission name 5");
	$validate->check("6","req","Please fill in the Guild permission name 6");
	$validate->check("7","req","Please fill in the Guild permission name 7");
	$validate->check("8","req","Please fill in the Guild permission name 8");
	$validate->check("9","req","Please fill in the Guild permission name 9");

	$validate->check("0","alnum_s","You can only use A-Z / 0-9 characters and spaces in the Guild permission name 0");
	$validate->check("1","alnum_s","You can only use A-Z / 0-9 characters and spaces in the Guild permission name 1");
	$validate->check("2","alnum_s","You can only use A-Z / 0-9 characters and spaces in the Guild permission name 2");
	$validate->check("3","alnum_s","You can only use A-Z / 0-9 characters and spaces in the Guild permission name 3");
	$validate->check("4","alnum_s","You can only use A-Z / 0-9 characters and spaces in the Guild permission name 4");
	$validate->check("5","alnum_s","You can only use A-Z / 0-9 characters and spaces in the Guild permission name 5");
	$validate->check("6","alnum_s","You can only use A-Z / 0-9 characters and spaces in the Guild permission name 6");
	$validate->check("7","alnum_s","You can only use A-Z / 0-9 characters and spaces in the Guild permission name 7");
	$validate->check("8","alnum_s","You can only use A-Z / 0-9 characters and spaces in the Guild permission name 8");
	$validate->check("9","alnum_s","You can only use A-Z / 0-9 characters and spaces in the Guild permission name 9");
	
    if($validate->ValidateForm() == false)
    {
		echo notice_message_admin('You have the following errors:<br>'.$validate->GetErrors().'', '0', '1', 'index.php?get=module_edit_guild_permissions_names&guild='.$_GET['guild'].'');
    }
    else
	{
		$SQLquery1 = $db->SQLquery("UPDATE character.dbo.GUILD_PEERAGE SET peerage_name = '%s' WHERE peerage_code = '0' AND guild_code = '%s'",  $_POST['0'], $_GET['guild']);
		$SQLquery1 = $db->SQLquery("UPDATE character.dbo.GUILD_PEERAGE SET peerage_name = '%s' WHERE peerage_code = '1' AND guild_code = '%s'",  $_POST['1'], $_GET['guild']);
		$SQLquery1 = $db->SQLquery("UPDATE character.dbo.GUILD_PEERAGE SET peerage_name = '%s' WHERE peerage_code = '2' AND guild_code = '%s'",  $_POST['2'], $_GET['guild']);
		$SQLquery1 = $db->SQLquery("UPDATE character.dbo.GUILD_PEERAGE SET peerage_name = '%s' WHERE peerage_code = '3' AND guild_code = '%s'",  $_POST['3'], $_GET['guild']);
		$SQLquery1 = $db->SQLquery("UPDATE character.dbo.GUILD_PEERAGE SET peerage_name = '%s' WHERE peerage_code = '4' AND guild_code = '%s'",  $_POST['4'], $_GET['guild']);
		$SQLquery1 = $db->SQLquery("UPDATE character.dbo.GUILD_PEERAGE SET peerage_name = '%s' WHERE peerage_code = '5' AND guild_code = '%s'",  $_POST['5'], $_GET['guild']);
		$SQLquery1 = $db->SQLquery("UPDATE character.dbo.GUILD_PEERAGE SET peerage_name = '%s' WHERE peerage_code = '6' AND guild_code = '%s'",  $_POST['6'], $_GET['guild']);
		$SQLquery1 = $db->SQLquery("UPDATE character.dbo.GUILD_PEERAGE SET peerage_name = '%s' WHERE peerage_code = '7' AND guild_code = '%s'",  $_POST['7'], $_GET['guild']);
		$SQLquery1 = $db->SQLquery("UPDATE character.dbo.GUILD_PEERAGE SET peerage_name = '%s' WHERE peerage_code = '8' AND guild_code = '%s'",  $_POST['8'], $_GET['guild']);
		$SQLquery1 = $db->SQLquery("UPDATE character.dbo.GUILD_PEERAGE SET peerage_name = '%s' WHERE peerage_code = '9' AND guild_code = '%s'",  $_POST['9'], $_GET['guild']);

		echo notice_message_admin('Guild Permissions Names successfully updated', '1', '0', 'index.php?get=module_edit_guild_permissions_names&guild='.$_GET['guild'].'');
	}
}
else
{
$default_name = array (
'0' => "Guild leader",
'1' => "Sub guild leader",
'2' => "Strategist",
'3' => "The royal guard",
'4' => "Imperator",
'5' => "General",
'6' => "Patrol team",
'7' => "Senior",
'8' => "Trainee",
'9' => "Guild member"
);
if($config->get('show_default', 'settings_edit_guild_permissions_names') == '1')
{
	$colspan = '3';
	$td = '<td align="left" class="panel_title_sub2">Default Names</td>';
}
else
{
	$colspan = '2';
	$td = '';
}
?>
<form action="" method="post">
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"  class="table_panel" >
    <tr>
    	<td align="center" class="panel_title" colspan="<?php echo $colspan; ?>">Edit Guild Permissions Names</td>
    </tr>
	<tr> 
        <td align="left" class="panel_title_sub2">Guild permission level</td> 
        <td align="left" class="panel_title_sub2">Guild permission name</td>
        <?php echo $td; ?>
	</tr> 
    <?php
	$SQLquery1 = $db->SQLquery("SELECT * FROM character.dbo.GUILD_PEERAGE WHERE guild_code = '".$_GET['guild']."' ");

	flush_this();
	$count = 0;
	while ($getGuildInfo = $db->SQLfetchArray($SQLquery1))
	{
					
		$count++;
		$tr_color = ($count % 2) ? '' : 'even';
		echo '
		<tr class="' . $tr_color . '">
			<td align="left" class="panel_text_alt_list">'.htmlspecialchars($getGuildInfo['peerage_code']).'</td>
			<td align="left" class="panel_text_alt_list"><input name="'.htmlspecialchars($getGuildInfo['peerage_code']).'" value="'.htmlspecialchars($getGuildInfo['peerage_name']).'" size="30" maxlength="20"></td>
			';
			if($config->get('show_default', 'settings_edit_guild_permissions_names') == '1')
			{
				echo '<td align="left" class="panel_text_alt_list">'.htmlspecialchars($default_name[$getGuildInfo['peerage_code']]).'</td>';
			}
			else
			{
			
			}
		echo '	
		</tr>
		';
	}
?>
    <tr>
    	<td align="right" class="panel_buttons" colspan="<?php echo $colspan; ?>"><input type="submit" value="Update" onclick="ask_url('Are you sure you want to update?','index.php?get=module_edit_guild_permissions_names&guild=<?php echo $_GET['guild']; ?>')"></td>
    </tr>
</table>
</form> 
<?php
}
?>