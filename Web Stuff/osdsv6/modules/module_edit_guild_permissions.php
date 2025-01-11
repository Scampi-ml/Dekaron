<?php
if (isset($_POST) && !empty($_POST))
{
	require_once ('engine/class_validate.php');
    $validate = new FormValidator();
	
	
    if($validate->ValidateForm() == false)
    {
		echo notice_message_admin('You have the following errors:<br>'.$validate->GetErrors().'', '0', '1', 'index.php?get=module_edit_guild_permissions&guild='.$_GET['guild'].'');
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

		echo notice_message_admin('Guild Permissions Names successfully updated', '1', '0', 'index.php?get=module_edit_guild_permissions&guild='.$_GET['guild'].'');
	}
}
else
{
	if(!isset($_GET['peerage_code']) && empty($_GET['peerage_code']))
	{
		?>
        <form name="navigation" >
        <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="border">
            <tr>
            	<td class="cat"><div align="left"><b>Please select a guild permission level (Step)</b></div></td>
            </tr>
            <tr>
            	<td align="center" style="padding-top: 20px; padding-bottom: 20px;">
                	<select class="medium" name="select1" onchange="location.href=navigation.select1.options[selectedIndex].value">
						<?php
                        $SQLquery1 = $db->SQLquery("SELECT * FROM character.dbo.GUILD_PEERAGE WHERE guild_code = '".$_GET['guild']."' ");
                    
                        flush_this();
                        while ($getGuildInfo = $db->SQLfetchArray($SQLquery1))
                        {
							if($getGuildInfo['peerage_code'] == "0")
							{
								continue;
							}
                            echo '<option value="index.php?get=module_edit_guild_permissions&guild='.$_GET['guild'].'&peerage_code='.htmlspecialchars($getGuildInfo['peerage_code']).'&peerage_name='.htmlspecialchars($getGuildInfo['peerage_name']).'">'.htmlspecialchars($getGuildInfo['peerage_name']).'</option>';	
                        }
                        ?>
        			</select>
            	</td> 
            </tr>
        </table>
        </form>		
		<?php
		
	}
	else
	{
		?>
            <form action="" method="post">
            <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"  class="table_panel" >
                <tr>
                    <td align="center" class="panel_title" colspan="3">Edit Guild Permissions</td>
                </tr>
                <?php
                $SQLquery1 = $db->SQLquery("SELECT * FROM character.dbo.GUILD_PEERAGE WHERE guild_code = '".$_GET['guild']."' AND  peerage_code = '".$_GET['peerage_code']."' ");
                $getGuildPerm = $db->SQLfetchArray($SQLquery1);
				
				$item = strtoupper(bin2hex($getGuildPerm['auth_info']));
				$str = str_split($item, 8);

				?>
                <tr class="even">
                    <td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Guild permissions</b>
                        <br>Set the permissions for <b><?php echo htmlspecialchars($_GET['peerage_name']); ?> (Level <?php echo htmlspecialchars($_GET['peerage_code']); ?>)</b>
                        <br>Some fields are disabled, sins they are checked in the game, they cant be unchecked somehow
                    </td>
                    <td align="left" class="panel_text_alt2" width="45%" valign="top">
                        <input type="checkbox" name="peerage_code[]" > Invite to Guild<br> 
                        <input type="checkbox" name="peerage_code[]" > Expel Member<br>
                        <input type="checkbox" name="peerage_code[]" > Change Rank<br>
                        <input type="checkbox" name="peerage_code[]" > Set Authorities<br>
                        <input type="checkbox" checked disabled > Look at Battle<br>
                        <input type="checkbox" checked disabled > View Position<br>
                        <input type="checkbox" name="peerage_code[]" > Participate in Siege Battle<br>
                        <input type="checkbox" name="peerage_code[]" > Announcement<br>
                        <input type="checkbox" name="peerage_code[]" > Register / Mod<br>
                        <input type="checkbox" checked disabled > Use Stash<br>
                        <input type="checkbox" checked disabled > See Stash<br>
                        <input type="checkbox" checked disabled > See info<br>
                        <input type="checkbox" name="peerage_code[]" > Staff Chat<br>
                    </td>
                </tr>
                <tr>
                    <td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Guild permissions</b></td>
                    <td align="left" class="panel_text_alt2" width="45%" valign="top"><?php echo $item; ?><br>
							<?php
                            foreach($str as $perm)
                            {
                                echo $perm . '<br>';
                            }
                            
                            ?>
                    </td>
                </tr>
                <tr>
                    <td align="right" class="panel_buttons" colspan="3"><input type="button" value="Refresh" onclick="ask_url('Are you sure you want to update?','index.php?get=module_edit_guild_permissions&guild=<?php echo $_GET['guild']; ?>&peerage_code=<?php echo $_GET['peerage_code']; ?>&peerage_name=<?php echo $_GET['peerage_name']; ?>')"></td>
                </tr>
            </table>
            </form> 
        
		<?php
	}
}
?>