<?php /* Smarty version Smarty-3.1.16, created on 2014-08-25 06:54:38
         compiled from "application/modules/register/views/register.tpl" */ ?>
<?php /*%%SmartyHeaderCode:141696913253faddae491fa2-01106574%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '89c433077bf7c51563ebeb65b8967417fc661214' => 
    array (
      0 => 'application/modules/register/views/register.tpl',
      1 => 1407579057,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '141696913253faddae491fa2-01106574',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'validation_errors' => 0,
    'use_captcha' => 0,
    'url' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_53faddae5dbda4_32717190',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53faddae5dbda4_32717190')) {function content_53faddae5dbda4_32717190($_smarty_tpl) {?><?php echo form_open('register','class="page_form"');?>

<?php if (isset($_smarty_tpl->tpl_vars['validation_errors']->value)) {?><div class="boxerror"><?php echo $_smarty_tpl->tpl_vars['validation_errors']->value;?>
</div><?php }?>
	<table style="width:80%">
		<tr>
			<td><label for="register_username"><?php echo lang("username","register");?>
</label></td>
			<td><input type="text" name="register_username" id="register_username" value="<?php echo set_value('register_username');?>
" /></td>
		</tr>
		<tr>
			<td><label for="register_email"><?php echo lang("email","register");?>
</label></td>
			<td><input type="email" name="register_email" id="register_email" value="<?php echo set_value('register_email');?>
" /></td>
		</tr>
		<tr>
			<td><label for="register_password"><?php echo lang("password","register");?>
</label></td>
			<td><input type="password" name="register_password" id="register_password" value="<?php echo set_value('register_password');?>
" /></td>
		</tr>
		<tr>
			<td><label for="register_password_confirm"><?php echo lang("confirm","register");?>
</label></td>
			<td><input type="password" name="register_password_confirm" id="register_password_confirm" value="<?php echo set_value('register_password_confirm');?>
" /></td>
		</tr>
		<?php if ($_smarty_tpl->tpl_vars['use_captcha']->value) {?>
			<tr>
				<td><label for="captcha"><img src="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
application/modules/register/controllers/getCaptcha.php?<?php echo uniqid();?>
" /></label></td>
				<td><input type="text" name="register_captcha" id="register_captcha" autocomplete="off" /></td>
			</tr>
		<?php }?>
	</table>
	<center style="margin-bottom:10px;">
		<input type="submit" name="login_submit" value="<?php echo lang("submit","register");?>
" />
	</center>
<?php echo form_close();?>
<?php }} ?>
