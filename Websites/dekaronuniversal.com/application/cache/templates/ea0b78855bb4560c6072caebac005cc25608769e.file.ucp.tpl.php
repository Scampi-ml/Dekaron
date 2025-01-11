<?php /* Smarty version Smarty-3.1.16, created on 2014-08-25 06:19:58
         compiled from "application/modules/ucp/views/ucp.tpl" */ ?>
<?php /*%%SmartyHeaderCode:90075451553fad58e1a3b37-07318210%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ea0b78855bb4560c6072caebac005cc25608769e' => 
    array (
      0 => 'application/modules/ucp/views/ucp.tpl',
      1 => 1408947579,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '90075451553fad58e1a3b37-07318210',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'url' => 0,
    'avatar' => 0,
    'id' => 0,
    'username' => 0,
    'playtime' => 0,
    'coins' => 0,
    'groups' => 0,
    'group' => 0,
    'voting_points' => 0,
    'donation_points' => 0,
    'account_status' => 0,
    'member_since' => 0,
    'config' => 0,
    'ucp_modules' => 0,
    'module_name' => 0,
    'mod' => 0,
    'characters' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_53fad58e32a4d0_78452797',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53fad58e32a4d0_78452797')) {function content_53fad58e32a4d0_78452797($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_number_format')) include '/mounted-storage/home79c/sub003/sc34159-SURY/dekaronuniversal.com/system/smarty/plugins/modifier.number_format.php';
?><section id="ucp_top">
	<a href="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
ucp/avatar" id="ucp_avatar"><div><?php echo lang("change_avatar","ucp");?>
</div><img src="<?php echo $_smarty_tpl->tpl_vars['avatar']->value;?>
"/></a>
	<section id="ucp_info">
		<aside>
			<table width="280">
				<tr>
					<td width="5%"><img src="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
application/images/icons/user.png" /></td>
					<td width="35%"><?php echo lang("nickname","ucp");?>
</td>
					<td width="60%"><a href="profile/<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" data-tip="View profile"><?php echo $_smarty_tpl->tpl_vars['username']->value;?>
</a></td>
				</tr>
				<tr>
					<td width="5%"><img src="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
application/images/icons/world.png" /></td>
					<td width="35%">Playtime</td>
					<td width="60%"><?php echo $_smarty_tpl->tpl_vars['playtime']->value;?>
hrs</td>
				</tr>
				<tr>
					<td width="5%"><img src="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
application/images/icons/coins.png" /></td>
					<td width="35%">Coins</td>
					<td width="60%"><?php echo smarty_modifier_number_format($_smarty_tpl->tpl_vars['coins']->value,0,",",".");?>
</td>
				</tr>
				<tr>
					<td width="5%"><img src="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
application/images/icons/award_star_bronze_1.png" /></td>
					<td width="35%">Rank</td>
					<td width="60%"><?php  $_smarty_tpl->tpl_vars['group'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['group']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['groups']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['group']->key => $_smarty_tpl->tpl_vars['group']->value) {
$_smarty_tpl->tpl_vars['group']->_loop = true;
?> <span <?php if ($_smarty_tpl->tpl_vars['group']->value['color']) {?>style="color:<?php echo $_smarty_tpl->tpl_vars['group']->value['color'];?>
"<?php }?>><?php echo $_smarty_tpl->tpl_vars['group']->value['name'];?>
</span><?php } ?></td>
				</tr>
			</table>
		</aside>
		<aside>
			<table width="450">
				<tr>
					<td width="5%"><img src="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
application/images/icons/lightning.png" /></td>
					<td width="35%"><?php echo lang("voting_points","ucp");?>
</td>
					<td width="60%"><?php echo $_smarty_tpl->tpl_vars['voting_points']->value;?>
</td>
				</tr>
				<tr>
					<td width="5%"><img src="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
application/images/icons/coins.png" /></td>
					<td width="35%"><?php echo lang("donation_points","ucp");?>
</td>
					<td width="60%"><?php echo $_smarty_tpl->tpl_vars['donation_points']->value;?>
</td>
				</tr>
				<tr>
					<td width="5%"><img src="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
application/images/icons/shield.png" /></td>
					<td width="35%"><?php echo lang("account_status","ucp");?>
</td>
					<td width="50%"><?php echo $_smarty_tpl->tpl_vars['account_status']->value;?>
</td>
				</tr>
				<tr>
					<td width="10%"><img src="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
application/images/icons/date.png" /></td>
					<td width="35%"><?php echo lang("member_since","ucp");?>
</td>
					<td width="60%"><?php echo $_smarty_tpl->tpl_vars['member_since']->value;?>
</td>
				</tr>
			</table>
		</aside>
	</section>
	<div style="clear:both;"></div>
</section>
<div class="ucp_divider"></div>
<section id="ucp_buttons">
<br />
	<?php if (hasPermission('view',"admin")&&$_smarty_tpl->tpl_vars['config']->value['admin']) {?>
		<a href="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
<?php echo $_smarty_tpl->tpl_vars['config']->value['admin'];?>
" style="background-image:url(<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
application/modules/ucp/images/admin_panel.jpg)"></a>
	<?php }?>
    
    <?php if ($_smarty_tpl->tpl_vars['ucp_modules']->value) {?>
        <?php  $_smarty_tpl->tpl_vars['module_name'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['module_name']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['ucp_modules']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['module_name']->key => $_smarty_tpl->tpl_vars['module_name']->value) {
$_smarty_tpl->tpl_vars['module_name']->_loop = true;
?>
            <?php  $_smarty_tpl->tpl_vars['mod'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['mod']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['module_name']->value['ucp_module']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['mod']->key => $_smarty_tpl->tpl_vars['mod']->value) {
$_smarty_tpl->tpl_vars['mod']->_loop = true;
?>
                <a href="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
<?php echo $_smarty_tpl->tpl_vars['mod']->value;?>
" style="background-image:url(<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
application/modules/<?php echo $_smarty_tpl->tpl_vars['mod']->value;?>
/images/<?php echo $_smarty_tpl->tpl_vars['mod']->value;?>
.png)"></a>
            <?php } ?>
        <?php } ?>
	<?php }?>       
	<div class="clear"></div>
</section>
<?php echo $_smarty_tpl->tpl_vars['characters']->value;?>
<?php }} ?>
