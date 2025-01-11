<?php /* Smarty version Smarty-3.1.16, created on 2014-09-13 16:45:53
         compiled from "application/modules/donate/views/donate.tpl" */ ?>
<?php /*%%SmartyHeaderCode:114725155953fad49d435e16-77138804%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a51e5ab3eb9276c50b00828c691c79c276c856c3' => 
    array (
      0 => 'application/modules/donate/views/donate.tpl',
      1 => 1410626618,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '114725155953fad49d435e16-77138804',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_53fad49d61d4d1_40819848',
  'variables' => 
  array (
    'donate_paypal' => 0,
    'server_name' => 0,
    'currency' => 0,
    'url' => 0,
    'key' => 0,
    'value' => 0,
    'currency_sign' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53fad49d61d4d1_40819848')) {function content_53fad49d61d4d1_40819848($_smarty_tpl) {?><div id="donate">
	<div class="boxinfo">Please enter your character name and press "Check". <br>If your character name is found the "PAY WITH PAYPAL" button will be displayed.</div>
	<form action="https://www<?php if ($_smarty_tpl->tpl_vars['donate_paypal']->value['sandbox']) {?>.sandbox<?php }?>.paypal.com/cgi-bin/webscr" method="post">
		<input type="hidden" name="cmd" value="_xclick" />
		<input type="hidden" name="business" value="<?php echo $_smarty_tpl->tpl_vars['donate_paypal']->value['email'];?>
" />
		<input type="hidden" name="item_name" value="<?php echo lang("donation_for","donate");?>
 <?php echo $_smarty_tpl->tpl_vars['server_name']->value;?>
" />
		<input type="hidden" name="quantity" value="1" />
		<input type="hidden" name="shipping" value="0" />
		<input type="hidden" name="currency_code" value="<?php echo $_smarty_tpl->tpl_vars['currency']->value;?>
" />
		<input type="hidden" name="return" value="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
donate/success" />
		<table class="nice_table" width="100%">
			<tr>
				<td>Character Name</td>
				<td><input type="text" name="custom" id="custom" value="" maxlength="200" /><a href="javascript:void(0)" onClick="Donate.checkUsername()" >Check</a></td>
			</tr>
			<tr>
				<td>Amount</td>
				<td>

				<?php  $_smarty_tpl->tpl_vars['value'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['value']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['donate_paypal']->value['values']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['value']->key => $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['value']->key;
?>
					<label for="option_<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
">
						<input type="radio" name="amount" value="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
" id="option_<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
"/> <b><?php echo $_smarty_tpl->tpl_vars['value']->value;?>
 <?php echo lang("dp","donate");?>
</b> <?php echo lang("for","donate");?>
 <b><?php echo $_smarty_tpl->tpl_vars['currency_sign']->value;?>
<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
</b>
					</label>
				<?php } ?>					
					
					
				</td>
			</tr>
		</table>				
		<br>
		<div class="clear"></div>
		<input type='submit'  class="paypal_submit" value='<?php echo lang("pay_paypal","donate");?>
' />
	</form>
</div><?php }} ?>
