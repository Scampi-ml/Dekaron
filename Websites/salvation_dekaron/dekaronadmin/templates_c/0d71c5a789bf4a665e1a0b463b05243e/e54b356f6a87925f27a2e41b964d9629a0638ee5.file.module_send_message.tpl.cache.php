<?php /* Smarty version Smarty-3.1.13, created on 2013-07-23 22:48:41
         compiled from ".\templates\module_send_message.tpl" */ ?>
<?php /*%%SmartyHeaderCode:575251ef6ab93c9663-05957671%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e54b356f6a87925f27a2e41b964d9629a0638ee5' => 
    array (
      0 => '.\\templates\\module_send_message.tpl',
      1 => 1368789666,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '575251ef6ab93c9663-05957671',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'character_name' => 0,
    'from_name' => 0,
    'character_no' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_51ef6ab93dc5a7_91890901',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51ef6ab93dc5a7_91890901')) {function content_51ef6ab93dc5a7_91890901($_smarty_tpl) {?><form action="" method="post">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
<tr>
<td align="center" class="panel_title" colspan="2">Send Message</td>
</tr>
<tr class="even">
<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>To</b><br>The character to send the message to</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><?php echo $_smarty_tpl->tpl_vars['character_name']->value;?>
</td>
</tr>
<tr class="">
<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>From</b><br>Enter your name, or a system name<br><small>0-9 A-Z Only</small></td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="from_char_nm" size="30" maxlength="30" value="<?php echo $_smarty_tpl->tpl_vars['from_name']->value;?>
" /></td>
</tr>
<tr class="even">
<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Message Title</b><br>Keep it short</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="post_title" size="30" maxlength="30" value="" /></td>
</tr>
<tr class="">
<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Message Text</b><br>Enter your message here</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><textarea cols="60" rows="3"  name="body_text"></textarea></td>
</tr>
<tr class="">
<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Add Dil</b><br>If you want to add some dil to the message<br><small>Numbers only</small></td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="include_dil" size="30" value=""  /></td>
</tr>
<tr class="">
<td width="45%" align="left" valign="top" class="panel_text_alt1"><b>Add Item</b><br>If you want to add an item to the message<br><small>Numbers only</small></td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><input type="text" name="item" size="30" value=""  /></td>
</tr>
<tr>
<td align="right" class="panel_buttons" colspan="2"><input type="submit" value="Send Message" onclick="ask_url('Are you sure you want to send the message?','index.php?get=module_send_message&character=<?php echo $_smarty_tpl->tpl_vars['character_no']->value;?>
')"></td>
</tr>
</table>
<input type="hidden" name="character" value="<?php echo $_smarty_tpl->tpl_vars['character_no']->value;?>
">
</form>
<?php }} ?>