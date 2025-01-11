<?php /* Smarty version Smarty-3.1.16, created on 2014-08-25 05:34:01
         compiled from "application/modules/login/views/login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:105416640653facac9770711-78147546%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3de619eb7f8fae721b96a85beec28cabd3955152' => 
    array (
      0 => 'application/modules/login/views/login.tpl',
      1 => 1407565076,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '105416640653facac9770711-78147546',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'class' => 0,
    'validation_errors' => 0,
    'username' => 0,
    'url' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_53facac9824cf4_04588349',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53facac9824cf4_04588349')) {function content_53facac9824cf4_04588349($_smarty_tpl) {?><?php echo form_open('login',$_smarty_tpl->tpl_vars['class']->value);?>

<?php if (isset($_smarty_tpl->tpl_vars['validation_errors']->value)) {?><div class="boxerror"><?php echo $_smarty_tpl->tpl_vars['validation_errors']->value;?>
</div><?php }?>
	<table>
		<tr>
			<td><label for="login_username"><?php echo lang("username","login");?>
</label></td>
			<td><input type="text" name="login_username" id="login_username" value="<?php echo $_smarty_tpl->tpl_vars['username']->value;?>
" placeholder="Username..." /></td>
		</tr>
		<tr>
			<td><label for="login_password"><?php echo lang("password","login");?>
</label></td>
			<td><input type="password" name="login_password" id="login_password" value="" placeholder="Password..."/></td>
		</tr>
	</table>

	<center>
		<div id="remember_me">
			<label for="login_remember" data-tip="<?php echo lang("remember_me","login");?>
"><?php echo lang("remember_me_short","login");?>
</label>
			<input type="checkbox" name="login_remember" id="login_remember"/>
		</div>

		<input type="submit" name="login_submit" value="<?php echo lang("log_in","login");?>
!" />
		<section id="forgot"><a href="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
password_recovery"><?php echo lang("lost_your_password","login");?>
</a></section>

	</center>
</form>
<?php }} ?>
