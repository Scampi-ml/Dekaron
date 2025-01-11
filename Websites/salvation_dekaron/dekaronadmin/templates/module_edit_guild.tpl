<form action="" method="post">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
	<tr>
		<td align="center" class="panel_title" colspan="2">Edit Guild</td>
	</tr>
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Guild Code</b><br>Must not be changed, for info only</td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top">{$guild_code}</td>
	</tr>
	<tr class="">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Guild Name</b><br>This is the login for the account</td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="guild_name" size="30" maxlength="30" value="{$guild_name}" /></td>
	</tr>
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Guild Server Id</b><br>Must not be changed, only for info only</td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top">{$guild_serv_id}</td>
	</tr>
	<tr class="">
	  <td align="left" class="panel_text_alt1" width="45%" valign="top"><b>Guild Level</b><br>The current guild level<br></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><select name="guild_Level">{$guild_Level}</select></td>
	</tr>
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Guild Dil</b><br>Not used</td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top">{$guild_Dil}</td>
	</tr>
	<tr class="">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Guild Adventure Points</b><br>Also known as guild adv, used for raising the guild level<br><small>Numbers only</small></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="guild_adv" size="30" value="{$guild_adv}"  /></td>
	</tr>
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Guild Emblem</b><br><small>Numbers only</small></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top">
        	<b>Guild Mark 1</b>&nbsp;&nbsp;<input type="text" name="guild_mark1" size="30" value="{$guild_mark1}"  />
            <br>
			<b>Guild Mark 2</b>&nbsp;&nbsp;<input type="text" name="guild_mark2" size="30" value="{$guild_mark2}"  />
         </td>
	</tr>
	<tr class="">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Guild Notice</b><br>The guild notice for all members to see<br>use \\ for a breakline<br><small>MAX 500 characters, Special characters and spaces also count!</small></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><textarea cols="60" rows="3"  name="guild_notice">{$guild_notice}</textarea></td>
	</tr>
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Ipt Date</b><br>For info only</td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top">{$ipt_date}</td>
	</tr>    
	<tr class="">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Upt Date</b><br>For info only</td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top">{$upt_date}</td>
	</tr>    
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Guild Effect</b><br>The effect around the guild emblem <br>Only edit this if you know what you are doing<br><small>Numbers only</small></td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="guild_effect" size="30" value="{$guild_effect}"  /></td>
	</tr>    
	<tr class="">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Guild State</b><br>Unknown</td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top">{$bystate}</td>
	</tr>    
	<tr class="even">
		<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Guild Channel</b><br>Unknown</td>
		<td align="left" class="panel_text_alt2" width="45%" valign="top">{$bychannel}</</td>
	</tr>    
        
    <tr>
    	<td align="right" class="panel_buttons" colspan="2"><input type="submit" value="Update" onclick="ask_url('Are you sure you want to update?','index.php?get=module_edit_guild&guild={$guild_code}')"></td>
    </tr>
</table>
</form>