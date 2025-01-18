<?php
if (isset($_POST) && !empty($_POST))
{
	$unstuck_map = $config->get('map', 'settings_unstuck_character');
	$unstuck_wposx = $config->get('wposx', 'settings_unstuck_character');
	$unstuck_wposy = $config->get('wposy', 'settings_unstuck_character');
	$db->SQLquery("UPDATE character.dbo.user_character SET wMapIndex = '%s', wPosX = '%s', wPosY = '%s' WHERE character_no = '%s' ", $unstuck_map, $unstuck_wposx, $unstuck_wposy, $_POST['character']);
	echo notice_message_admin('Character is not stuck anymore', '1', '0', 'index.php?get=module_search_character');
}
else
{
?>
<form action="" method="post">
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="border">
    <tr>
        <td class="cat"><div align="left"><b>Please confirm</b></div></td>
    </tr>
    <tr>
        <td align="center" style="padding-top: 20px; padding-bottom: 20px;">
        	<b>Are you sure you want to unstuck this character ?</b>
            <br><br><br><br>
            <input type="hidden" name="character" value="<?php echo $_GET['character']; ?>" >
        	<input type="submit" value="Unstuck Character" onclick="ask_url('Are you sure you want to unstuck this character ?','index.php?get=module_unstuck_character')">
    	</td> 
    </tr>
</table>	
</form>	
<?php
}
?>