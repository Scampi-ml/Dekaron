<?php /* Smarty version Smarty-3.1.13, created on 2013-09-17 15:13:47
         compiled from ".\templates\module_ban_account.tpl" */ ?>
<?php /*%%SmartyHeaderCode:178945238d41bddb478-78449838%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7d364a20585aeef878a8f88778ac72c0859f806d' => 
    array (
      0 => '.\\templates\\module_ban_account.tpl',
      1 => 1379450542,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '178945238d41bddb478-78449838',
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
  'unifunc' => 'content_5238d41bdf2e73_03243847',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5238d41bdf2e73_03243847')) {function content_5238d41bdf2e73_03243847($_smarty_tpl) {?><form action="" method="post">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="border">
<tr>
<td class="cat"><div align="left"><b>Please confirm</b></div></td>
</tr>
<tr>
<td align="center" style="padding-top: 20px; padding-bottom: 20px;">
<b>Are you sure you want to ban "<?php echo $_smarty_tpl->tpl_vars['USERID']->value;?>
" ?</b>
<br><br>
Reason: 
<input type="text" name="banned_reason" size="30" maxlength="5000"/>
<br><br><br>

<input type="hidden" name="account" value="<?php echo $_smarty_tpl->tpl_vars['USERNO']->value;?>
" >
<input type="submit" value="Ban Account" onclick="ask_url('Are you sure you want to ban this account?','index.php?get=module_ban_account')">
</td> 
</tr>
</table>	
</form>	
<?php }} ?>