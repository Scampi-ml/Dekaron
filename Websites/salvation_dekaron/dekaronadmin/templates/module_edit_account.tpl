<form method="post" action="">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
<tr>
<td align="center" class="panel_title" colspan="2">Edit Account</td>
</tr>
<tr class="even">
<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>User Number</b><br>Must not be changed, only for info only</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">{$user_no}</td>
</tr>
<tr class="">
<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>User Id</b><br>This is the login for the account<br><small>0-9 A-Z Only</small></td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="user_id" size="40" maxlength="20" value="{$user_id}" /></td>
</tr>
<tr class="even">
<td align="left" class="panel_text_alt1" width="45%" valign="top"><b>Password</b><br>Use a MD5 encoded password only<br><small>MD5 String Only</small></td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="user_pwd" size="40" maxlength="32" value="{$user_pwd}"  /><br><a href="javascript: md5passw();">Create MD5 Password</a></td>
</tr>
<tr class="">
<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Game Access</b><br>If this is set to 'No' user will not be able to login to the game<br><small>Use "Ban Account" & "Un-Ban Account" to change game access.</small></td>
{if $login_tag == 'No'}
<td align="left" class="panel_text_alt2" width="45%" valign="top">
<blink>{$user_id} is BANNED</blink><br>
<b>Banned Reason:</b> {$banned_reason}<br>
<b>Banned By:</b> {$banned_by}<br>
<b>Banned Date:</b> {$banned_date}
</td>
{else}
<td align="left" class="panel_text_alt2" width="45%" valign="top">{$login_tag}</td>
{/if}
</tr>
<tr class="even">
<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Online State</b><br>If this is set to 'Yes' the user is currently logged into the game<br></td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><select name="login_flag">{$login_flag}</select></td>
</tr>
<tr class="">
<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Can Vote?</b><br>If this is set to 'Yes' the user can use the vote system<br></td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><select name="can_vote">{$can_vote}</select>
</td>
</tr>
<tr class="even">
<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Newspaper Access</b><br>If this is set to 'No' user will not be able to use the newspaper system<br></td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><select name="can_newspaper">{$can_newspaper}</select>
</td>
<tr class="">
<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Credits </b><br></td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="credits" size="40" maxlength="32" value="{$credits}"  />
</td>
<tr class="even">
<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Email </b><br></td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="email" size="40" maxlength="32" value="{$email}"  />
</td>
<tr class="">
<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Is GM ? </b><br>Only shows online list in the userpanel, does not set GM rights<br></td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><select name="isgm">{$isgm}</select>
</td>
</tr>


<tr>
<td align="right" class="panel_buttons" colspan="2"><input type="submit" value="Update" onclick="ask_url('Are you sure you want to update?','index.php?get=module_edit_account&account={$user_no}')"></td>
</tr>
</table>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel" style="margin-top: 20px;">
<tr>
<td align="center" class="panel_title" colspan="2">Info</td>
</tr>
<tr class="even">
<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Last Login</b><br>Last known login from the game</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">{$login_time}</td>
</tr>
<tr class="">
<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Last Logout</b><br>Last known logout from the game</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">{$logout_time}</td>
</tr>
<tr class="even">
<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Ip Address</b><br>The users last known Ip Address</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top">{$user_ip_addr}</td>
</tr>    
</table>
</form>
