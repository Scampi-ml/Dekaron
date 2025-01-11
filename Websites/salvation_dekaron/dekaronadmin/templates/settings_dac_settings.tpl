{if $POST == 1}{$MESSAGE}{else}
<form method="post" action="">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
<tr>
<td align="center" class="panel_title" colspan="2">DAC Settings</td>
</tr>
<tr class="">
<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Redirect message speed</b><br>The speed (in seconds) to display messages<br>This does not apply on errors or error messages<br>Default & recommended: 1</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="msg_redirect" size="30" value="{$msg_redirect}" /></td>
</tr>
<tr>
<td align="right" class="panel_buttons" colspan="2"><input type="submit" value="Save Settings"></td>
</tr>
</table>
</form>
{/if}
