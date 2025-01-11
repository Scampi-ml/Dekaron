<?php /* Smarty version Smarty-3.1.16, created on 2014-08-25 05:34:01
         compiled from "application/themes/dkuniversal/views/page.tpl" */ ?>
<?php /*%%SmartyHeaderCode:139696536953facac983f983-06961451%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '48e24b0d99ea5db8b15d024ba03bb6559db7f847' => 
    array (
      0 => 'application/themes/dkuniversal/views/page.tpl',
      1 => 1406725376,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '139696536953facac983f983-06961451',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'headline' => 0,
    'content' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_53facac984ba43_96124433',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53facac984ba43_96124433')) {function content_53facac984ba43_96124433($_smarty_tpl) {?><article class="subpage">
	<h1 class="top sub-header"><p><?php echo $_smarty_tpl->tpl_vars['headline']->value;?>
</p></h1>
	<section class="body">
		<?php echo $_smarty_tpl->tpl_vars['content']->value;?>

	</section>
</article><?php }} ?>
