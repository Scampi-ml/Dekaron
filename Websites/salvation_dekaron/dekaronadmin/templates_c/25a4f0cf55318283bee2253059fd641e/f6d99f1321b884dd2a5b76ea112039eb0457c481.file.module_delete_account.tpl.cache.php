<?php /* Smarty version Smarty-3.1.13, created on 2014-01-20 23:10:22
         compiled from ".\templates\module_delete_account.tpl" */ ?>
<?php /*%%SmartyHeaderCode:520252dd9eceb0ea01-73283575%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f6d99f1321b884dd2a5b76ea112039eb0457c481' => 
    array (
      0 => '.\\templates\\module_delete_account.tpl',
      1 => 1385820947,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '520252dd9eceb0ea01-73283575',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'USERID' => 0,
    'TABLE' => 0,
    'USERNO' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_52dd9eceb611b4_17354302',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52dd9eceb611b4_17354302')) {function content_52dd9eceb611b4_17354302($_smarty_tpl) {?><form action="" method="post">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="border">
<tr>
<td class="cat"><div align="left"><b>Please confirm</b></div></td>
</tr>
<tr>
<td align="center" style="padding-top: 20px; padding-bottom: 20px;">
<b>Are you sure you want to delete account "<?php echo $_smarty_tpl->tpl_vars['USERID']->value;?>
" ?</b>
<br>
<br>
<?php echo $_smarty_tpl->tpl_vars['TABLE']->value;?>

<br><br>This action cannot be undone!
<br>
Deleting character(s) will also delete all of there info, quests, inventory, skills, ... ect
<br><br><br>
<input type="hidden" name="account" value="<?php echo $_smarty_tpl->tpl_vars['USERNO']->value;?>
" >
<input type="submit" value="Delete account" onclick="ask_url('Are you sure you want to delete this account?','index.php?get=module_delete_account')">
</td> 
</tr>
</table>	
</form>	<?php }} ?>