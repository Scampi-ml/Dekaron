<?php /* Smarty version Smarty-3.1.13, created on 2013-12-04 03:05:55
         compiled from ".\templates\module_coins_log.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14034529efe832f4cf5-66677173%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '835d13a6ed4366b4105e8fee700655603b6dabda' => 
    array (
      0 => '.\\templates\\module_coins_log.tpl',
      1 => 1385820942,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14034529efe832f4cf5-66677173',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'TABLE' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_529efe832ff2b3_61508235',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_529efe832ff2b3_61508235')) {function content_529efe832ff2b3_61508235($_smarty_tpl) {?><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  class="table_panel" >
<tr>
<td align="center" class="panel_title" colspan="4">Coins Use Log</td>
</tr>
<tr> 
<td align="left" class="panel_title_sub2">Character</td> 
<td align="left" class="panel_title_sub2">Ip Address</td>
<td align="left" class="panel_title_sub2">Item / Item Id</td> 
<td align="left" class="panel_title_sub2">Date</td> 
</tr>
<?php echo $_smarty_tpl->tpl_vars['TABLE']->value;?>

</table>    <?php }} ?>