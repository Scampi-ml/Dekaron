<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel" style="margin-top: 20px;">
    <tr>
		<td align="center" class="panel_title" colspan="2">Today Statistics</td>
	</tr>
    <tr class="even">
        <td width="50%" align="left" class="panel_text_alt_list">Characters</td>
      <td align="left" class="panel_text_alt_list" width="50%">
	  <?php 
	  $SQLquery1 = $db->SQLquery("SELECT character_no FROM character.dbo.user_character WHERE character_no LIKE  '" . date('Ymd') . "%'"); 
	  echo number_format($db->SQLfetchNum($SQLquery1));  flush_this(); 
	  ?>
      </td>
    </tr>
    <tr>
        <td width="50%" align="left" class="panel_text_alt_list">Accounts</td>
      <td align="left" class="panel_text_alt_list" width="50%">
	  <?php 
	  $SQLquery2 = $db->SQLquery("SELECT user_no FROM account.dbo.user_profile WHERE user_no LIKE  '" . date('Ymd') . "%' "); 
	  echo number_format($db->SQLfetchNum($SQLquery2));  flush_this(); 
	  ?>
      </td>
    </tr>
    <tr class="even">
        <td width="50%" align="left" class="panel_text_alt_list">Logins</td>
      <td align="left" class="panel_text_alt_list" width="50%">
	  <?php 
	  $SQLquery3 = $db->SQLquery("SELECT user_no FROM account.dbo.USER_CONNLOG_KEY WHERE login_time LIKE  '" . date('d/m/Y') . "%' "); 
	  echo number_format($db->SQLfetchNum($SQLquery3));  flush_this(); 
	  ?>
      </td>
    </tr>
    <tr>
    	<td align="right" class="panel_buttons" colspan="2"><input type="button" value="Refresh" onclick="ask_url('Are you sure?','index.php?get=module_today')"></td>
    </tr>
</table>
