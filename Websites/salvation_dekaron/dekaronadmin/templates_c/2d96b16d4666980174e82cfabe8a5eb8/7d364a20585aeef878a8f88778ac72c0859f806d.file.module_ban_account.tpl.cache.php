<?php /* Smarty version Smarty-3.1.13, created on 2013-07-25 20:29:07
         compiled from ".\templates\module_ban_account.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1934251f1ed03299b71-38131065%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
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
  'nocache_hash' => '1934251f1ed03299b71-38131065',
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
  'unifunc' => 'content_51f1ed032a3d30_88899705',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51f1ed032a3d30_88899705')) {function content_51f1ed032a3d30_88899705($_smarty_tpl) {?><form action="" method="post">
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