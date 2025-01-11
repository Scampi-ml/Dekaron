<?php /* Smarty version Smarty-3.1.16, created on 2014-08-25 05:37:33
         compiled from "application/modules/error/views/error.tpl" */ ?>
<?php /*%%SmartyHeaderCode:128423670853facb9d674fd6-28466047%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '267835121ab71c1dc9982040f4a7f18a14d9eb37' => 
    array (
      0 => 'application/modules/error/views/error.tpl',
      1 => 1361023810,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '128423670853facb9d674fd6-28466047',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'is404' => 0,
    'errorMessage' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_53facb9d6fac59_60191323',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53facb9d6fac59_60191323')) {function content_53facb9d6fac59_60191323($_smarty_tpl) {?><?php if (isset($_smarty_tpl->tpl_vars['is404']->value)&&$_smarty_tpl->tpl_vars['is404']->value) {?>
	<center style='margin:10px;font-weight:bold;'><?php echo lang("404_long","error");?>
</center>
<?php } else { ?>
	<center style='margin:10px;font-weight:bold;'><?php echo $_smarty_tpl->tpl_vars['errorMessage']->value;?>
</center>
<?php }?><?php }} ?>
