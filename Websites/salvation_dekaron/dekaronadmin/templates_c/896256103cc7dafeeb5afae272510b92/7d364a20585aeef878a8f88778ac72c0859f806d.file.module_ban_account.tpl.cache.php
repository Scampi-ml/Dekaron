<?php /* Smarty version Smarty-3.1.13, created on 2013-08-05 02:58:07
         compiled from ".\templates\module_ban_account.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1490651ff772f7525f8-44633252%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7d364a20585aeef878a8f88778ac72c0859f806d' => 
    array (
      0 => '.\\templates\\module_ban_account.tpl',
      1 => 1368789666,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1490651ff772f7525f8-44633252',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'USERID' => 0,
    'USERNO' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_51ff772f75c854_62121320',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51ff772f75c854_62121320')) {function content_51ff772f75c854_62121320($_smarty_tpl) {?><form action="" method="post">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="border">
<tr>
<td class="cat"><div align="left"><b>Please confirm</b></div></td>
</tr>
<tr>
<td align="center" style="padding-top: 20px; padding-bottom: 20px;">
<b>Are you sure you want to ban "<?php echo $_smarty_tpl->tpl_vars['USERID']->value;?>
" ?</b>
<br><br>
<input type="hidden" name="account" value="<?php echo $_smarty_tpl->tpl_vars['USERNO']->value;?>
" >
<input type="submit" value="Ban Account" onclick="ask_url('Are you sure you want to ban this account?','index.php?get=module_ban_account')">
</td> 
</tr>
</table>	
</form>	
<?php }} ?>