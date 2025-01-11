<?php
if (isset($_POST) && !empty($_POST))
{
	require_once ('engine/class_validate.php');
    $validate = new FormValidator();
	
	$validate->check("from_char_nm","req","Please fill in the from");
	$validate->check("post_title","req","Please fill in the message title");
	$validate->check("body_text","req","Please fill in the message text");
	
	if(!empty($_POST['include_dil']))
	{
		$validate->check("include_dil","num","You can only use 0-9 characters in the add dil");
	}
	
	if(empty($_POST['include_dil']))
	{
		$dil = '0';
	}
	else
	{
		$dil = $_POST['include_dil'];
	}
	
    if($validate->ValidateForm() == false)
    {
		echo notice_message_admin('You have the following errors:<br>'.$validate->GetErrors().'', '0', '1', 'index.php?get=module_send_message&character='.$_POST['character'].'');
    }
    else
	{
		$db->SQLquery("EXEC character.dbo.SP_POST_SEND_OP '%s','%s',1,'%s','%s',0,'%s', 0", $_POST['character'], $_POST['from_char_nm'], $_POST['post_title'], $_POST['body_text'], $dil);
		echo notice_message_admin('Message successfully send', '1', '0', 'index.php?get=module_send_message&character='.$_POST['character'].'');
	}
}
else
{
	flush_this();
	$SQLquery1 = $db->SQLquery("SELECT character_name,character_no FROM character.dbo.user_character WHERE character_no = '%s' ", $_GET['character']);
	$getCharInfo = $db->SQLfetchArray($SQLquery1);

?>
<form action="" method="post">
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
	<tr>
		<td align="center" class="panel_title" colspan="2">Send Message</td>
	</tr>
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>To</b><br>The character to send the message to</td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><?php echo htmlspecialchars($getCharInfo['character_name']); ?></td>
	</tr>
	<tr class="">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>From</b><br>Enter your name, or a system name<br><small>0-9 A-Z Only</small></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="from_char_nm" size="30" maxlength="30" value="<?php echo $config->get('from_name', 'settings_send_message'); ?>" /></td>
	</tr>
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Message Title</b><br>Keep it short</td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="post_title" size="30" maxlength="30" value="" /></td>
	</tr>
	<tr class="">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Message Text</b><br>Enter your message here</td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><textarea cols="60" rows="3"  name="body_text"></textarea></td>
	</tr>
	<tr class="">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Add Dil</b><br>If you want to add some dil to the message<br><small>Numbers only</small></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="include_dil" size="30" value=""  /></td>
	</tr>
    <tr>
    	<td align="right" class="panel_buttons" colspan="2"><input type="submit" value="Send Message" onclick="ask_url('Are you sure you want to send the message?','index.php?get=module_send_message&character=<?php echo htmlspecialchars($getCharInfo['character_no']); ?>')"></td>
    </tr>
</table>
<input type="hidden" name="character" value="<?php echo htmlspecialchars($getCharInfo['character_no']); ?>">
</form>
<?php
}
?>