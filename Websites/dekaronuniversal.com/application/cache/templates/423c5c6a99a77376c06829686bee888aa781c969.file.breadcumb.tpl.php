<?php /* Smarty version Smarty-3.1.16, created on 2014-08-25 06:23:56
         compiled from "application/views/breadcumb.tpl" */ ?>
<?php /*%%SmartyHeaderCode:100672311853fad67c296415-63766412%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '423c5c6a99a77376c06829686bee888aa781c969' => 
    array (
      0 => 'application/views/breadcumb.tpl',
      1 => 1360521178,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '100672311853fad67c296415-63766412',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'links' => 0,
    'url' => 0,
    'link' => 0,
    'item' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_53fad67c2ee4d8_10450724',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53fad67c2ee4d8_10450724')) {function content_53fad67c2ee4d8_10450724($_smarty_tpl) {?><?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['link'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['links']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['link']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
	<span style='cursor:pointer;' onClick='window.location="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
<?php echo $_smarty_tpl->tpl_vars['link']->value;?>
"'><?php echo $_smarty_tpl->tpl_vars['item']->value;?>
</span>
	<?php if ($_smarty_tpl->tpl_vars['item']->value!=end($_smarty_tpl->tpl_vars['links']->value)) {?> &rarr; <?php }?>
<?php } ?><?php }} ?>
