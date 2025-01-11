<?php /* Smarty version Smarty-3.1.16, created on 2014-04-05 06:38:57
         compiled from "application\views\inc\view_left_menu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:17118533fa501b39ed6-48213737%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f2f4edf02c9fbbfa7104f50897a21f433b3650f6' => 
    array (
      0 => 'application\\views\\inc\\view_left_menu.tpl',
      1 => 1396509629,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17118533fa501b39ed6-48213737',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'SITE_URL' => 0,
    'BASE_URL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_533fa501c43098_48802218',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_533fa501c43098_48802218')) {function content_533fa501c43098_48802218($_smarty_tpl) {?><article>
    <h1 class="top">Main menu</h1>
    <ul id="left_menu">
        <li><a href="<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
home" direct="0"><img src="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
assets/images/bullet.png">Home</a></li>
        <li><a href="<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
register" direct="0"><img src="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
assets/images/bullet.png">Register</a></li>
		<li><a href="<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
download" direct="1"><img src="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
assets/images/bullet.png">Download</a></li>
		<li><a href="<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
server_info" direct="1"><img src="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
assets/images/bullet.png">Server Info</a></li>
		<li><a href="<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
vote" direct="1"><img src="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
assets/images/bullet.png">Vote</a></li>
        <li><a href="<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
donate" direct="0"><img src="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
assets/images/bullet.png">Donate</a></li>
        <li><a href="<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
staff" direct="0"><img src="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
assets/images/bullet.png">Staff</a></li>
        <li><a href="<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
support" direct="0"><img src="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
assets/images/bullet.png">Support</a></li>
        <li><a href="<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
community" direct="0"><img src="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
assets/images/bullet.png">Forums</a></li>
        <li><a href="<?php echo $_smarty_tpl->tpl_vars['SITE_URL']->value;?>
deadfront" direct="0"><img src="<?php echo $_smarty_tpl->tpl_vars['BASE_URL']->value;?>
assets/images/bullet.png">Deadfront</a></li>
    </ul>
</article><?php }} ?>
