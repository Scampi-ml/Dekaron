<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel" style="margin-top: 20px;">
    <tr>
		<td align="center" class="panel_title" colspan="2">Game Statistics</td>
	</tr>
    <tr class="even">
        <td width="50%" align="left" class="panel_text_alt_list">Characters</td>
      <td align="left" class="panel_text_alt_list" width="50%"><?php $SQLquery1 = $db->SQLquery("SELECT character_no FROM character.dbo.user_character"); echo number_format($db->SQLfetchNum($SQLquery1));  flush_this(); ?></td>
    </tr>
    <tr>
        <td width="50%" align="left" class="panel_text_alt_list">Accounts</td>
      <td align="left" class="panel_text_alt_list" width="50%"><?php $SQLquery2 = $db->SQLquery("SELECT user_id FROM account.dbo.user_profile"); echo number_format($db->SQLfetchNum($SQLquery2));  flush_this(); ?></td>
    </tr>
    <tr class="even">
        <td  width="50%" align="left" class="panel_text_alt_list">Online Accounts</td>
      <td align="left" class="panel_text_alt_list" width="50%"><?php $SQLquery3 = $db->SQLquery("SELECT user_id FROM account.dbo.user_profile WHERE login_flag = '1100' "); echo number_format($db->SQLfetchNum($SQLquery3));  flush_this(); ?></td>
    </tr>
    <tr>
        <td width="50%" align="left" class="panel_text_alt_list">Banned Accounts</td>
      <td align="left" class="panel_text_alt_list" width="50%"><?php $SQLquery4 = $db->SQLquery("SELECT user_id FROM account.dbo.user_profile WHERE login_tag = 'N' "); echo number_format($db->SQLfetchNum($SQLquery4));  flush_this(); ?></td>
    </tr>
    <tr class="even">
        <td  width="50%" align="left" class="panel_text_alt_list">Guilds</td>
      <td align="left" class="panel_text_alt_list" width="50%"><?php $SQLquery5 = $db->SQLquery("SELECT * FROM character.dbo.guild_info "); echo number_format($db->SQLfetchNum($SQLquery5));  flush_this(); ?></td>
    </tr>
    <tr>
        <td width="50%" align="left" class="panel_text_alt_list">Deadfront</td>
      <td align="left" class="panel_text_alt_list" width="50%"><?php $SQLquery6 = $db->SQLquery("SELECT * FROM character.dbo.cm_bcd_item "); echo number_format($db->SQLfetchNum($SQLquery6));  flush_this(); ?></td>
    </tr>
    <tr class="even">
        <td  width="50%" align="left" class="panel_text_alt_list">Deleted Characters</td>
      <td align="left" class="panel_text_alt_list" width="50%"><?php $SQLquery7 = $db->SQLquery("SELECT character_no FROM character.dbo.del_user_char_list "); echo number_format($db->SQLfetchNum($SQLquery7));  flush_this(); ?></td>
    </tr>
    <tr>
        <td width="50%" align="left" class="panel_text_alt_list">Characters in guild</td>
      	<td align="left" class="panel_text_alt_list" width="50%"><?php $SQLquery8 = $db->SQLquery("SELECT * FROM character.dbo.GUILD_CHAR_INFO "); echo number_format($db->SQLfetchNum($SQLquery8));  flush_this(); ?></td>
    </tr>
    <tr class="even">
        <td width="50%" align="left" class="panel_text_alt_list">Costumes</td>
      	<td align="left" class="panel_text_alt_list" width="50%"><?php $SQLquery9 = $db->SQLquery("SELECT * FROM character.dbo.user_suit "); echo number_format($db->SQLfetchNum($SQLquery9));  flush_this(); ?></td>
    </tr>
    <tr>
        <td width="50%" align="left" class="panel_text_alt_list">Mails</td>
      	<td align="left" class="panel_text_alt_list" width="50%"><?php $SQLquery10 = $db->SQLquery("SELECT * FROM character.dbo.USER_POSTBOX "); echo number_format($db->SQLfetchNum($SQLquery10));  flush_this(); ?> <a href="index.php?get=module_view_mails">View</a></td>
    </tr>
    <tr class="even">
        <td width="50%" align="left" class="panel_text_alt_list">Deleted Mails</td>
      <td align="left" class="panel_text_alt_list" width="50%"><?php $SQLquery11 = $db->SQLquery("SELECT * FROM character.dbo.USER_POSTBOX_SECEDE "); echo number_format($db->SQLfetchNum($SQLquery11));  flush_this(); ?> <a href="index.php?get=module_view_deleted_mails">View</a></td>
    </tr>
    <tr>
        <td width="50%" align="left" class="panel_text_alt_list">Character doing quests</td>
      <td align="left" class="panel_text_alt_list" width="50%"><?php $SQLquery12 = $db->SQLquery("SELECT * FROM character.dbo.User_Quest_Doing "); echo number_format($db->SQLfetchNum($SQLquery12));  flush_this(); ?></td>
    </tr>
    <tr class="even">
        <td width="50%" align="left" class="panel_text_alt_list">Characters done quests</td>
      	<td align="left" class="panel_text_alt_list" width="50%"><?php $SQLquery13 = $db->SQLquery("SELECT * FROM character.dbo.User_Quest_Done "); echo number_format($db->SQLfetchNum($SQLquery13));  flush_this(); ?></td>
    </tr>
    <tr>
        <td width="50%" align="left" class="panel_text_alt_list">Skills</td>
      	<td align="left" class="panel_text_alt_list" width="50%"><?php $SQLquery14 = $db->SQLquery("SELECT * FROM character.dbo.user_skill "); echo number_format($db->SQLfetchNum($SQLquery14));  flush_this(); ?></td>
    </tr>
    <tr class="even">
        <td width="50%" align="left" class="panel_text_alt_list">Storage Items</td>
      	<td align="left" class="panel_text_alt_list" width="50%"><?php $SQLquery15 = $db->SQLquery("SELECT * FROM character.dbo.user_storage "); echo number_format($db->SQLfetchNum($SQLquery15));  flush_this(); ?></td>
    </tr>
    <tr>
        <td width="50%" align="left" class="panel_text_alt_list">Store Items</td>
      <td align="left" class="panel_text_alt_list" width="50%"><?php $SQLquery16 = $db->SQLquery("SELECT * FROM character.dbo.USER_STORE "); echo number_format($db->SQLfetchNum($SQLquery16));  flush_this(); ?></td>
    </tr>
    <tr class="even">
        <td width="50%" align="left" class="panel_text_alt_list">Items</td>
      <td align="left" class="panel_text_alt_list" width="50%"><?php $SQLquery17 = $db->SQLquery("SELECT * FROM character.dbo.user_bag "); echo number_format($db->SQLfetchNum($SQLquery17));  flush_this(); ?></td>
    </tr>
    <tr>
        <td width="50%" align="left" class="panel_text_alt_list">Deleted Items</td>
      	<td align="left" class="panel_text_alt_list" width="50%"><?php $SQLquery18 = $db->SQLquery("SELECT * FROM character.dbo.user_bag_secede "); echo number_format($db->SQLfetchNum($SQLquery18)); flush_this(); ?></td>
    </tr>
    <tr>
    	<td align="right" class="panel_buttons" colspan="2"><input type="button" value="Refresh" onclick="ask_url('Are you sure?','index.php?get=module_gamestats')"></td>
    </tr>
</table>
