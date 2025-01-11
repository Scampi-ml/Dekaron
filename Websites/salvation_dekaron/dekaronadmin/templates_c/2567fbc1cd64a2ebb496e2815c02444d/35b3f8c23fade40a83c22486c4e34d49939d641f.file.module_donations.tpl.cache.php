<?php /* Smarty version Smarty-3.1.13, created on 2013-12-04 12:40:19
         compiled from ".\templates\module_donations.tpl" */ ?>
<?php /*%%SmartyHeaderCode:15523529f14a34b5178-19353776%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '35b3f8c23fade40a83c22486c4e34d49939d641f' => 
    array (
      0 => '.\\templates\\module_donations.tpl',
      1 => 1385820949,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15523529f14a34b5178-19353776',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'TABLE' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_529f14a34c2c74_70658067',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_529f14a34c2c74_70658067')) {function content_529f14a34c2c74_70658067($_smarty_tpl) {?><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  class="table_panel" >
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