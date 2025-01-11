<form action="" method="post">
<table width="100q%" border="0" align="center" cellpadding="0" cellspacing="0" class="border">
<tr>
<td class="cat"><div align="left"><b>Choose a location</b></div></td>
</tr>
<tr>
<td align="center" style="padding-top: 20px; padding-bottom: 20px;">
<b>Pleas select the location you want to teleport the character to</b>
<br><br>
<select name="tele_map" style="width: 150px;">{$mapcount_data}</select>
<br><br>
<input type="hidden" name="character" value="{$character}" >
<input type="submit" value="teleport Character" onclick="ask_url('Are you sure you want to teleport this character ?','index.php?get=module_teleport_character')">
</td>
</tr>
</table>	
</form>
