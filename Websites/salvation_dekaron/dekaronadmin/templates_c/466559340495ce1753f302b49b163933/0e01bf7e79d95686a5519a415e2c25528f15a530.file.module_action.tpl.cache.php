<?php /* Smarty version Smarty-3.1.13, created on 2014-01-01 00:52:08
         compiled from ".\templates\module_action.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3083552c358a8bfce73-26730114%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0e01bf7e79d95686a5519a415e2c25528f15a530' => 
    array (
      0 => '.\\templates\\module_action.tpl',
      1 => 1385820941,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3083552c358a8bfce73-26730114',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'form' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_52c358a8c07c91_61461101',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52c358a8c07c91_61461101')) {function content_52c358a8c07c91_61461101($_smarty_tpl) {?><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="border">
<tr>
<td class="cat"><div align="left"><b>Select Action</b></div></td>
</tr>
<tr>
<td align="center" style="padding-top: 20px; padding-bottom: 20px;">
<form class="uniform" name="navigation">
<select class="medium" name="select1" onchange="location.href=navigation.select1.options[selectedIndex].value" >
<option value="">------------------------------</option>
<?php echo $_smarty_tpl->tpl_vars['form']->value;?>

</select>
</form>
</td> 
</tr>
</table><?php }} ?>