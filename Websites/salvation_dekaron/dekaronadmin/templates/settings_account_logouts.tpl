{if $POST == 1}{$MESSAGE}{else}
<form method="post" action="">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
<tr>
<td align="center" class="panel_title" colspan="2">Account Logout Settings</td>
</tr>
<tr class="even">
<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Results</b><br>The amount of results to be displayed, 50 is recommended</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="top" size="30" value="{$TOP}" /></td>
</tr>
<tr class="">
<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Show null</b><br>If set to 'Yes' if will show logouts that dont have a value</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><select name="shownull">{$switch}</select></td>
</tr>
<tr>
<td align="right" class="panel_buttons" colspan="2"><input type="submit" value="Save Settings"></td>
</tr>
</table>
</form>
{/if}