<?php /* Smarty version Smarty-3.1.13, created on 2013-08-07 04:53:43
         compiled from ".\templates\module_action.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3691520235479bc576-50066874%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0e01bf7e79d95686a5519a415e2c25528f15a530' => 
    array (
      0 => '.\\templates\\module_action.tpl',
      1 => 1368789666,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3691520235479bc576-50066874',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'form' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_520235479c3817_47380331',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_520235479c3817_47380331')) {function content_520235479c3817_47380331($_smarty_tpl) {?><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="border">
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