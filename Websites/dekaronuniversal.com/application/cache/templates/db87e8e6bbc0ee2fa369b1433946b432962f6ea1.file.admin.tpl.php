<?php /* Smarty version Smarty-3.1.16, created on 2014-09-19 08:33:06
         compiled from "application/modules/donate/views/admin.tpl" */ ?>
<?php /*%%SmartyHeaderCode:69220930453facb29395c54-28772561%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'db87e8e6bbc0ee2fa369b1433946b432962f6ea1' => 
    array (
      0 => 'application/modules/donate/views/admin.tpl',
      1 => 1411115515,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '69220930453facb29395c54-28772561',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_53facb294ce1f7_44702481',
  'variables' => 
  array (
    'currency' => 0,
    'first_date' => 0,
    'last_date' => 0,
    'top' => 0,
    'monthly_income_stack' => 0,
    'paypal_enabled' => 0,
    'url' => 0,
    'paypal_logs' => 0,
    'paypal_log' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53facb294ce1f7_44702481')) {function content_53facb294ce1f7_44702481($_smarty_tpl) {?><div class="statistics">
	<span>Monthly income (<?php echo $_smarty_tpl->tpl_vars['currency']->value;?>
)</span>
	<div class="image">
		<img src="https://chart.googleapis.com/chart?chf=bg,s,FFFFFF&chxl=0:|<?php echo $_smarty_tpl->tpl_vars['first_date']->value;?>
|<?php echo $_smarty_tpl->tpl_vars['last_date']->value;?>
&chxp=0,12,87&chxr=1,0,<?php echo $_smarty_tpl->tpl_vars['top']->value+20;?>
&chxs=1,676767,11.5,0,lt,676767&chxt=x,y&chs=667x190&cht=lc&chco=095a9d&chds=0,<?php echo $_smarty_tpl->tpl_vars['top']->value+20;?>
&chd=t:<?php echo $_smarty_tpl->tpl_vars['monthly_income_stack']->value;?>
&chdlp=l&chls=2&chma=5,5,5,5" />
	</div>
</div>

<?php if ($_smarty_tpl->tpl_vars['paypal_enabled']->value) {?>
	<section class="box big" id="donate_articles">
		<h2>
			<img src="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
application/themes/admin/images/icons/black16x16/ic_text_document.png"/>
			Last 10 PayPal donations
		</h2>

		<form style="margin-top:0px;" onSubmit="Donate.search('paypal'); return false">
			<input type="text" name="search_paypal" id="search_paypal" placeholder="Search by username, PayPal email or TXN ID" style="width:90%;margin-right:5px;"/>
			<input type="submit" value="Search" style="display:inline;padding:8px;" />
		</form>
	
		<ul id="donate_list_paypal">
			<?php if ($_smarty_tpl->tpl_vars['paypal_logs']->value) {?>
				<?php  $_smarty_tpl->tpl_vars['paypal_log'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['paypal_log']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['paypal_logs']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['paypal_log']->key => $_smarty_tpl->tpl_vars['paypal_log']->value) {
$_smarty_tpl->tpl_vars['paypal_log']->_loop = true;
?>
					<li>
						<table width="100%" style="font-size:11px;">
							
							<tr>
								<td width="13%"><?php echo date("Y/m/d",$_smarty_tpl->tpl_vars['paypal_log']->value['timestamp']);?>
</td>
								<td width="13%">
									<a href="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
profile/<?php echo $_smarty_tpl->tpl_vars['paypal_log']->value['character_name'];?>
" target="_blank">
										<?php echo $_smarty_tpl->tpl_vars['paypal_log']->value['nickname'];?>

									</a>
								</td>
								
								<td width="13%" <?php if (!$_smarty_tpl->tpl_vars['paypal_log']->value['validated']) {?>style="text-decoration:line-through"<?php }?>>
									<b>
										<?php echo $_smarty_tpl->tpl_vars['paypal_log']->value['payment_amount'];?>
 <?php echo $_smarty_tpl->tpl_vars['paypal_log']->value['payment_currency'];?>

									</b>
								</td>

								<?php if ($_smarty_tpl->tpl_vars['paypal_log']->value['validated']) {?>
									<td width="15%" ><?php echo $_smarty_tpl->tpl_vars['paypal_log']->value['payment_status'];?>
</td>
								<?php } else { ?>
									<td width="15%" data-tip="<?php echo $_smarty_tpl->tpl_vars['paypal_log']->value['error'];?>
" style="color:red;cursor:pointer;">
										Error (?)
									</td>
								<?php }?>

								<td data-tip="Transaction ID: <?php echo $_smarty_tpl->tpl_vars['paypal_log']->value['txn_id'];?>
" style="font-size:11px;"><?php echo $_smarty_tpl->tpl_vars['paypal_log']->value['payer_email'];?>
</td>
							
								<?php if (!$_smarty_tpl->tpl_vars['paypal_log']->value['validated']) {?><td><a class="nice_button" style="float:right;" href="javascript:void(0)" onClick="Donate.give(<?php echo $_smarty_tpl->tpl_vars['paypal_log']->value['id'];?>
, this)">Give DP</a></td><?php }?>
							</tr>
						
						</table>
					</li>
				<?php } ?>
			<?php }?>
		</ul>
	</section>
<?php }?>
<?php }} ?>
