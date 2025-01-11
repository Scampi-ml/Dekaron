<?php
if (isset($_POST) && !empty($_POST))
{
	require_once ('engine/class_validate.php');
    $validate = new FormValidator();
	
	$validate->check("guild_name","req","Please fill in the character name");
	$validate->check("guild_adv","req","Please fill in the adventure points");
	$validate->check("guild_adv","num","You can only use 0-9 characters in the guild adventure points");
	$validate->check("guild_effect","num","You can only use 0-9 characters in the guild effect");
	
    if($validate->ValidateForm() == false)
    {
		echo notice_message_admin('You have the following errors:<br>'.$validate->GetErrors().'', '0', '1', 'index.php?get=module_edit_guild&guild='.$_GET['guild'].'');
    }
    else
	{
		$SQLquery1 = $db->SQLquery("UPDATE character.dbo.guild_info SET guild_name = '%s',guild_Level = '%s',guild_adv = '%s',guild_mark1 = '%s',guild_mark2 = '%s',guild_effect = '%s', guild_notice = '%s' WHERE guild_code = '%s'", $_POST['guild_name'],$_POST['guild_Level'],$_POST['guild_adv'],$_POST['guild_mark1'],$_POST['guild_mark1'],$_POST['guild_effect'], $_POST['guild_notice'], $_GET['guild']);
		
		echo notice_message_admin('Guild successfully updated', '1', '0', 'index.php?get=module_edit_guild&guild='.$_GET['guild'].'');
	}
}
else
{
	flush_this();
	$SQLquery1 = $db->SQLquery("SELECT * FROM character.dbo.guild_info WHERE guild_code = '".$_GET['guild']."' ");
	$getGuildInfo = $db->SQLfetchArray($SQLquery1);

?>
<form action="" method="post">
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
	<tr>
		<td align="center" class="panel_title" colspan="2">Edit Guild</td>
	</tr>
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Guild Code</b><br>Must not be changed, for info only</td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><?php echo htmlspecialchars($getGuildInfo['guild_code']); ?></td>
	</tr>
	<tr class="">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Guild Name</b><br>This is the login for the account</td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="guild_name" size="30" maxlength="30" value="<?php echo htmlspecialchars($getGuildInfo['guild_name']); ?>" /></td>
	</tr>
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Guild Server Id</b><br>Must not be changed, only for info only</td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><?php echo htmlspecialchars($getGuildInfo['guild_serv_id']); ?></td>
	</tr>
	<tr class="">
	  <td align="left" class="panel_text_alt1" width="45%" valign="top"><b>Guild Level</b><br>The current guild level<br></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top">
        	<select name="guild_Level">
			<?php 
                switch (htmlspecialchars($getGuildInfo['guild_Level']))
				{
                    case '1':
                        echo '<option value="1" selected>Level 1</option><option value="2" >Level 2</option><option value="3" >Level 3</option>';
                        break;
                    case '2':
                        echo '<option value="1" >Level 1</option><option value="2" selected>Level 2</option><option value="3" >Level 3</option>';
                        break;
                    case '3':
                        echo '<option value="1" >Level 1</option><option value="2" >Level 2</option><option value="3" selected>Level 3</option>';
                        break;
                }
			?>
            </select>
        </td>
	</tr>
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Guild Dil</b><br>Not used</td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><?php echo htmlspecialchars($getGuildInfo['guild_Dil']); ?></td>
	</tr>
	<tr class="">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Guild Adventure Points</b><br>Also known as guild adv, used for raising the guild level<br><small>Numbers only</small></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="guild_adv" size="30" value="<?php echo htmlspecialchars($getGuildInfo['guild_adv']); ?>"  /></td>
	</tr>
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Guild Emblem</b><br>Emblem Code 1<br><small>Numbers only</small></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top">
        	<div style="float: right;"><img src="script/emblem/emblem.php?cbg=<?php echo $getGuildInfo['guild_mark2']; ?>&cemblem=<?php echo $getGuildInfo['guild_mark1']; ?>" border="0" width="50" height="50" ></div>
        	<b>Guild Mark 1</b>&nbsp;&nbsp;<input type="text" name="guild_mark1" size="30" value="<?php echo htmlspecialchars($getGuildInfo['guild_mark1']); ?>"  />
            <br>
			<b>Guild Mark 2</b>&nbsp;&nbsp;<input type="text" name="guild_mark2" size="30" value="<?php echo htmlspecialchars($getGuildInfo['guild_mark2']); ?>"  />
            <br><a href="javascript: guildemblem();">Create Emblem</a>
         </td>
	</tr>
	<tr class="">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Guild Notice</b><br>The guild notice for all members to see<br>use \ for a breakline<br><small>MAX 500 characters, Special characters and spaces also count!</small></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><textarea cols="60" rows="3"  name="guild_notice"><?php echo htmlspecialchars($getGuildInfo['guild_notice']); ?></textarea></td>
	</tr>
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Ipt Date</b><br>For info only</td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><?php echo htmlspecialchars($getGuildInfo['ipt_date']); ?></td>
	</tr>    
	<tr class="">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Upt Date</b><br>For info only</td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><?php echo htmlspecialchars($getGuildInfo['upt_date']); ?></td>
	</tr>    
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Guild Effect</b><br>The effect around the guild emblem <br>Only edit this if you know what you are doing<br><small>Numbers only</small></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="guild_effect" size="30" value="<?php echo htmlspecialchars($getGuildInfo['guild_effect']); ?>"  /></td>
	</tr>    
	<tr class="">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Guild State</b><br>Unknown</td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><?php echo htmlspecialchars($getGuildInfo['bystate']); ?></td>
	</tr>    
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Guild Channel</b><br>Unknown</td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><?php echo htmlspecialchars($getGuildInfo['bychannel']); ?></</td>
	</tr>    
        
    <tr>
    	<td align="right" class="panel_buttons" colspan="2"><input type="submit" value="Update" onclick="ask_url('Are you sure you want to update?','index.php?get=module_edit_guild&guild=<?php echo $_GET['guild']; ?>')"></td>
    </tr>
</table>
</form>
<?php
}
?>