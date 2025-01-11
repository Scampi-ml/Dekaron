<?php /* Smarty version Smarty-3.1.13, created on 2013-09-11 09:28:26
         compiled from ".\templates\module_edit_account.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2360252309a2addde32-95889813%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b8cc0a148f456977470d1897ba36d87aa6a06e1d' => 
    array (
      0 => '.\\templates\\module_edit_account.tpl',
      1 => 1368789666,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2360252309a2addde32-95889813',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'user_no' => 0,
    'user_id' => 0,
    'user_pwd' => 0,
    'login_tag' => 0,
    'login_flag' => 0,
    'login_time' => 0,
    'logout_time' => 0,
    'user_ip_addr' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_52309a2ae6e3f3_59741326',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52309a2ae6e3f3_59741326')) {function content_52309a2ae6e3f3_59741326($_smarty_tpl) {?><form method="post" action="">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
<tr>
<td align="center" class="panel_title" colspan="2">Edit Account</td>
</tr>
<tr class="even">
<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>User Number</b><br>Must not be changed, only for info only</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><?php echo $_smarty_tpl->tpl_vars['user_no']->value;?>
</td>
</tr>
<tr class="">
<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>User Id</b><br>This is the login for the account<br><small>0-9 A-Z Only</small></td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="user_id" size="40" maxlength="20" value="<?php echo $_smarty_tpl->tpl_vars['user_id']->value;?>
" /></td>
</tr>
<tr class="even">
<td align="left" class="panel_text_alt1" width="45%" valign="top"><b>Password</b><br>Use a MD5 encoded password only<br><small>MD5 String Only</small></td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="user_pwd" size="40" maxlength="32" value="<?php echo $_smarty_tpl->tpl_vars['user_pwd']->value;?>
"  /><br><a href="javascript: md5passw();">Create MD5 Password</a></td>
</tr>
<tr class="">
<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Game Access</b><br>If this is set to 'No' user will not be able to login to the game<br><small>Use "Ban Account" & "Un-Ban Account" to change game access.</small></td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><?php echo $_smarty_tpl->tpl_vars['login_tag']->value;?>
</td>
</tr>
<tr class="even">
<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Online State</b><br>If this is set to 'Yes' the user is currently logged into the game<br></td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><select name="login_flag"><?php echo $_smarty_tpl->tpl_vars['login_flag']->value;?>
</select></td>
</tr>
<tr>
<td align="right" class="panel_buttons" colspan="2"><input type="submit" value="Update" onclick="ask_url('Are you sure you want to update?','index.php?get=module_edit_account&account=<?php echo $_smarty_tpl->tpl_vars['user_no']->value;?>
')"></td>
</tr>
</table>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel" style="margin-top: 20px;">
<tr>
<td align="center" class="panel_title" colspan="2">Info</td>
</tr>
<tr class="even">
<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Last Login</b><br>Last known login from the game</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><?php echo $_smarty_tpl->tpl_vars['login_time']->value;?>
</td>
</tr>
<tr class="">
<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Last Logout</b><br>Last known logout from the game</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><?php echo $_smarty_tpl->tpl_vars['logout_time']->value;?>
</td>
</tr>
<tr class="even">
<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Ip Address</b><br>The users last known Ip Address</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><?php echo $_smarty_tpl->tpl_vars['user_ip_addr']->value;?>
</td>
</tr>    
</table>
</form><?php }} ?>