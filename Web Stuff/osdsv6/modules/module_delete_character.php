<?php
if (isset($_POST) && !empty($_POST))
{
	$db->SQLquery("DELETE FROM character.dbo.user_character WHERE character_no = '%s'", $_POST['character']);

	$delete_this_also = $_POST['also_delete'];
	
	if (in_array('delfq', $delete_this_also) == true)
	{
		$db->SQLquery("DELETE FROM character.dbo.User_Quest_Done WHERE character_no = '%s'", $_POST['character']);
	}
	if (in_array('delqip', $delete_this_also) == true)
	{
		$db->SQLquery("DELETE FROM character.dbo.User_Quest_Doing WHERE character_no = '%s'", $_POST['character']);
	}
	if (in_array('delinv', $delete_this_also) == true)
	{
		$db->SQLquery("DELETE FROM character.dbo.user_bag WHERE character_no = '%s'", $_POST['character']);
	}
	if (in_array('delmail', $delete_this_also) == true)
	{
		$db->SQLquery("DELETE FROM character.dbo.USER_POSTBOX WHERE character_no = '%s'", $_POST['character']);
	}
	if (in_array('delshop', $delete_this_also) == true)
	{
		$db->SQLquery("DELETE FROM character.dbo.user_storage WHERE character_no = '%s'", $_POST['character']);
	}
	if (in_array('delskill', $delete_this_also) == true)
	{		
		$db->SQLquery("DELETE FROM character.dbo.user_skill WHERE character_no = '%s'", $_POST['character']);
	}
	if (in_array('delskillbar', $delete_this_also) == true)
	{
		$db->SQLquery("DELETE FROM character.dbo.user_slot WHERE character_no = '%s'", $_POST['character']);
	}
	if (in_array('delstorage', $delete_this_also) == true)
	{
		$db->SQLquery("DELETE FROM character.dbo.user_storage WHERE character_no = '%s'", $_POST['character']);
	}
	if (in_array('delei', $delete_this_also) == true)
	{
		$db->SQLquery("DELETE FROM character.dbo.user_suit WHERE character_no = '%s'", $_POST['character']);
	}

	echo notice_message_admin('Guild successfully deleted', '1', '0', 'index.php?get=module_search_character');
}
else
{
	flush_this();
	$SQLquery1 = $db->SQLquery("SELECT character_no,character_name FROM character.dbo.user_character WHERE character_no = '%s'", $_GET['character']);
	$getCharacterInfo = $db->SQLfetchArray($SQLquery1);

?>
<form action="" method="post">
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="border">
    <tr>
        <td class="cat"><div align="left"><b>Please confirm</b></div></td>
    </tr>
    <tr>
        <td align="center" style="padding-top: 20px; padding-bottom: 20px;">
        	<b>Are you sure you want to delete character "<?php echo $getCharacterInfo['character_name']; ?>" ?</b>
            <br>
            <br>
            <p class="msg_error"><input type="checkbox" name="also_delete[]" checked value="delfq"> Delete Finished Quests</p>
            <p class="msg_error"><input type="checkbox" name="also_delete[]" checked value="delqip"> Delete Quest In-Progress</p>
            <p class="msg_error"><input type="checkbox" name="also_delete[]" checked value="delinv"> Delete Inventory</p>
            <p class="msg_error"><input type="checkbox" name="also_delete[]" checked value="delmail"> Delete Mail</p>
            <p class="msg_error"><input type="checkbox" name="also_delete[]" checked value="delshop"> Delete Shop</p>
            <p class="msg_error"><input type="checkbox" name="also_delete[]" checked value="delskill"> Delete Skills</p>
            <p class="msg_error"><input type="checkbox" name="also_delete[]" checked value="delskillbar"> Delete Skillbar</p>
            <p class="msg_error"><input type="checkbox" name="also_delete[]" checked value="delstorage"> Delete Storage</p>
            <p class="msg_error"><input type="checkbox" name="also_delete[]" checked value="delei"> Delete Equipped Items</p>
            
        	<br><br>This action cannot be undone!
            <br><br><br><br>
            <input type="hidden" name="character" value="<?php echo $getCharacterInfo['character_no']; ?>" >
        	<input type="submit" value="Delete character" onclick="ask_url('Are you sure you want to delete this character?','index.php?get=module_delete_character')">
    	</td> 
    </tr>
</table>	
</form>	
<?php
}
?>