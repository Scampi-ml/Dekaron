<?php
if (isset($_POST) && !empty($_POST))
{
	$db->SQLquery("DELETE FROM character.dbo.guild_info WHERE guild_code = '%s'", $_POST['guild_code']);
	$db->SQLquery("DELETE FROM character.dbo.GUILD_CHAR_INFO WHERE guild_code = '%s'", $_POST['guild_code']);
	
	$db->SQLquery("DELETE FROM character.dbo.GUILD_PEERAGE WHERE guild_code = '%s' AND peerage_code = '0'", $_POST['guild_code']);
	$db->SQLquery("DELETE FROM character.dbo.GUILD_PEERAGE WHERE guild_code = '%s' AND peerage_code = '1'", $_POST['guild_code']);
	$db->SQLquery("DELETE FROM character.dbo.GUILD_PEERAGE WHERE guild_code = '%s' AND peerage_code = '2'", $_POST['guild_code']);
	$db->SQLquery("DELETE FROM character.dbo.GUILD_PEERAGE WHERE guild_code = '%s' AND peerage_code = '3'", $_POST['guild_code']);
	$db->SQLquery("DELETE FROM character.dbo.GUILD_PEERAGE WHERE guild_code = '%s' AND peerage_code = '4'", $_POST['guild_code']);
	$db->SQLquery("DELETE FROM character.dbo.GUILD_PEERAGE WHERE guild_code = '%s' AND peerage_code = '5'", $_POST['guild_code']);
	$db->SQLquery("DELETE FROM character.dbo.GUILD_PEERAGE WHERE guild_code = '%s' AND peerage_code = '6'", $_POST['guild_code']);
	$db->SQLquery("DELETE FROM character.dbo.GUILD_PEERAGE WHERE guild_code = '%s' AND peerage_code = '7'", $_POST['guild_code']);
	$db->SQLquery("DELETE FROM character.dbo.GUILD_PEERAGE WHERE guild_code = '%s' AND peerage_code = '8'", $_POST['guild_code']);
	$db->SQLquery("DELETE FROM character.dbo.GUILD_PEERAGE WHERE guild_code = '%s' AND peerage_code = '9'", $_POST['guild_code']);
	
	echo notice_message_admin('Guild successfully deleted', '1', '0', 'index.php?get=module_search_guild');
}
else
{
	flush_this();
	$SQLquery1 = $db->SQLquery("SELECT guild_name,guild_code FROM character.dbo.guild_info WHERE guild_code = '".$_GET['guild']."' ");
	$getGuildInfo = $db->SQLfetchArray($SQLquery1);

?>
<form action="" method="post">
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="border">
    <tr>
        <td class="cat"><div align="left"><b>Please confirm</b></div></td>
    </tr>
    <tr>
        <td align="center" style="padding-top: 20px; padding-bottom: 20px;">
        	<b>Are you sure you want to delete guild "<?php echo $getGuildInfo['guild_name']; ?>" ?</b>
        	<br><br>This action cannot be undone!
            <br>All characters will be kicked from the guild
            <br><br><br><br>
            <input type="hidden" name="guild_code" value="<?php echo $getGuildInfo['guild_code']; ?>" >
        	<input type="submit" value="Delete Guild" onclick="ask_url('Are you sure you want to delete this guild?','index.php?get=module_delete_guild')">
    	</td> 
    </tr>
</table>	
</form>	
<?php
}
?>