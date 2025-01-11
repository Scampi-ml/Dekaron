<?php /* Smarty version Smarty-3.1.13, created on 2013-09-20 17:20:56
         compiled from ".\templates\module_donations.tpl" */ ?>
<?php /*%%SmartyHeaderCode:24716523ce6683fed98-71006706%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '35b3f8c23fade40a83c22486c4e34d49939d641f' => 
    array (
      0 => '.\\templates\\module_donations.tpl',
      1 => 1379443760,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '24716523ce6683fed98-71006706',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'TABLE' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_523ce66840ec48_20377728',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_523ce66840ec48_20377728')) {function content_523ce66840ec48_20377728($_smarty_tpl) {?><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  class="table_panel" >
<tr>
<td align="center" class="panel_title" colspan="4">Donations</td>
</tr>
<tr> 
<td align="left" class="panel_title_sub2">Transaction ID</td> 
<td align="left" class="panel_title_sub2">Type</td>
<td align="left" class="panel_title_sub2">Amount</td>
<td align="left" class="panel_title_sub2">Date</td>
</tr>
<?php echo $_smarty_tpl->tpl_vars['TABLE']->value;?>

</table>    <?php }} ?>