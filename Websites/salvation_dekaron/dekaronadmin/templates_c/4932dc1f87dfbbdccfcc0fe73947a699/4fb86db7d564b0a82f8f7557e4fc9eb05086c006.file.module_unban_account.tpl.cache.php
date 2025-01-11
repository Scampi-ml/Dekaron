<?php /* Smarty version Smarty-3.1.13, created on 2014-02-19 19:28:14
         compiled from ".\templates\module_unban_account.tpl" */ ?>
<?php /*%%SmartyHeaderCode:69805304f7be942675-55789400%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4fb86db7d564b0a82f8f7557e4fc9eb05086c006' => 
    array (
      0 => '.\\templates\\module_unban_account.tpl',
      1 => 1385820994,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '69805304f7be942675-55789400',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'user_id' => 0,
    'user_no' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5304f7be9b2329_14446306',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5304f7be9b2329_14446306')) {function content_5304f7be9b2329_14446306($_smarty_tpl) {?><form action="" method="post">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="border">
<tr>
<td class="cat"><div align="left"><b>Please confirm</b></div></td>
</tr>
<tr>
<td align="center" style="padding-top: 20px; padding-bottom: 20px;">
<b>Are you sure you want to unban "<?php echo $_smarty_tpl->tpl_vars['user_id']->value;?>
" ?</b>
<br><br><br><br>
<input type="hidden" name="account" value="<?php echo $_smarty_tpl->tpl_vars['user_no']->value;?>
" >
<input type="submit" value="Unban Account" onclick="ask_url('Are you sure you want to unban this account?','index.php?get=module_unban_account')">
</td> 
</tr>
</table>	
</form>	<?php }} ?>