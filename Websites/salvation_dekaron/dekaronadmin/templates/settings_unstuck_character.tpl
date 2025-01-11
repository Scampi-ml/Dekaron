{if $POST == 1}{$MESSAGE}{else}
<form method="post" action="">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
<tr>
<td align="center" class="panel_title" colspan="2">Unstuck Character Settings</td>
</tr>
<tr class="even">
<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Unstuck Map Number</b><br>The map where you cant to move the character to when using unstuck<br>the character will be moved to this map<br>Map Number (id) only ! </td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="map" size="30" value="{$map}" /></td>
</tr>
<tr class="">
<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Unstuck Pos X</b><br>The pos X where you cant to move the character to when using unstuck<br>the character will be moved to this location</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="wposx" size="30" value="{$wposx}" /></td>
</tr>
<tr class="even">
<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Unstuck Pos Y</b><br>The pos Y where you cant to move the character to when using unstuck<br>the character will be moved to this location</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="wposy" size="30" value="{$wposy}" /></td>
</tr>
<tr>
<td align="right" class="panel_buttons" colspan="2"><input type="submit" value="Save Settings"></td>
</tr>
</table>
</form>
{/if}