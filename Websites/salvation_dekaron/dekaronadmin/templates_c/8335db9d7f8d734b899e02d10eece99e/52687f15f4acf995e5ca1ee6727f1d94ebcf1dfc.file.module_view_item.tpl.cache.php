<?php /* Smarty version Smarty-3.1.13, created on 2013-08-25 09:34:16
         compiled from ".\templates\module_view_item.tpl" */ ?>
<?php /*%%SmartyHeaderCode:8618521a3208940b28-25532911%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '52687f15f4acf995e5ca1ee6727f1d94ebcf1dfc' => 
    array (
      0 => '.\\templates\\module_view_item.tpl',
      1 => 1368789666,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8618521a3208940b28-25532911',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'special_color' => 0,
    'special_name' => 0,
    'new_item_name' => 0,
    'socket_info_html' => 0,
    'socket_html' => 0,
    'option_html' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_521a3208959011_53425825',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_521a3208959011_53425825')) {function content_521a3208959011_53425825($_smarty_tpl) {?><link rel="stylesheet" type="text/css" href="style/stickytooltip.css" />
<div class="tooltip2" >
<div style="padding:5px">
<div style="width:300px" class="ati2" align="center"><span style="color: <?php echo $_smarty_tpl->tpl_vars['special_color']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['special_name']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['new_item_name']->value;?>
</span><br>
<div style="text-align:left; color:#fff; margin-left:10px;">
<br><br>
<?php echo $_smarty_tpl->tpl_vars['socket_info_html']->value;?>

<?php echo $_smarty_tpl->tpl_vars['socket_html']->value;?>

<?php echo $_smarty_tpl->tpl_vars['option_html']->value;?>

<br>
</div>
</div>
</div>
<div class="status2"></div>
</div>
<?php }} ?>