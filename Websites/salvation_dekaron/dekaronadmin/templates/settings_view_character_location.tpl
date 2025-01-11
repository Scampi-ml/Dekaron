{if $POST == 1}{$MESSAGE}{else}
<form method="post" action="">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
<tr>
<td align="center" class="panel_title" colspan="2">View Character Location Settings</td>
</tr>
<tr class="even">
<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Pointer</b><br>The color of the pointer, X is recommended</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><select name="pointer">{$switch}</select></td>
</tr>
<tr class="">
<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Color</b><br>The color of the pointer</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><select name="color">{switch1}</select></td>
</tr>
<tr>
<td align="right" class="panel_buttons" colspan="2"><input type="submit" value="Save Settings"></td>
</tr>
</table>
</form>
{/if}