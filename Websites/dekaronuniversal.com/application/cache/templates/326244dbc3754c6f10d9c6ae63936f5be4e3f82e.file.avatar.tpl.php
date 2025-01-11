<?php /* Smarty version Smarty-3.1.16, created on 2014-08-25 06:23:56
         compiled from "application/modules/ucp/views/avatar.tpl" */ ?>
<?php /*%%SmartyHeaderCode:125859186153fad67c0c8bf0-38479123%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '326244dbc3754c6f10d9c6ae63936f5be4e3f82e' => 
    array (
      0 => 'application/modules/ucp/views/avatar.tpl',
      1 => 1360501872,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '125859186153fad67c0c8bf0-38479123',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'email' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_53fad67c278e05_81873008',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53fad67c278e05_81873008')) {function content_53fad67c278e05_81873008($_smarty_tpl) {?><section id="avatar_page">
	<h2><?php echo lang("make_use","ucp");?>
 <a href="http://gravatar.com" target="_blank">Gravatar</a> <?php echo lang("provides_way","ucp");?>
</h2>
	<br />
	<h3><?php echo lang("to_change","ucp");?>
 <a href="http://gravatar.com/site/signup/" target="_blank"><?php echo lang("sign_up_for","ucp");?>
</a> <?php echo lang("or","ucp");?>
 <a href="http://gravatar.com/site/login/" target="_blank"><?php echo lang("log_into","ucp");?>
</a> Gravatar <?php echo lang("using_email","ucp");?>
</h3>

	<center>
		<?php echo $_smarty_tpl->tpl_vars['email']->value;?>

	</center>
</section><?php }} ?>
