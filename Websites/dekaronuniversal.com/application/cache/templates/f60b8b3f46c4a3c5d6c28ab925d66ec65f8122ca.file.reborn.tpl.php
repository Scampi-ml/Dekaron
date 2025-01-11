<?php /* Smarty version Smarty-3.1.16, created on 2014-09-17 05:41:39
         compiled from "application/modules/reborn/views/reborn.tpl" */ ?>
<?php /*%%SmartyHeaderCode:71927563753fad3998c23c6-90223233%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f60b8b3f46c4a3c5d6c28ab925d66ec65f8122ca' => 
    array (
      0 => 'application/modules/reborn/views/reborn.tpl',
      1 => 1410932429,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '71927563753fad3998c23c6-90223233',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_53fad399aa1f34_22105893',
  'variables' => 
  array (
    'total' => 0,
    'characters' => 0,
    'url' => 0,
    'character' => 0,
    'RbLevel' => 0,
    'cost' => 0,
    'MaxRb' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53fad399aa1f34_22105893')) {function content_53fad399aa1f34_22105893($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_number_format')) include '/mounted-storage/home79c/sub003/sc34159-SURY/dekaronuniversal.com/system/smarty/plugins/modifier.number_format.php';
?><section id="teleport">
	<section id="select_character">
		<?php if ($_smarty_tpl->tpl_vars['total']->value) {?>
				<table class="nice_table" width="100%">
                <?php  $_smarty_tpl->tpl_vars['character'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['character']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['characters']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['character']->key => $_smarty_tpl->tpl_vars['character']->value) {
$_smarty_tpl->tpl_vars['character']->_loop = true;
?>
                <tr>
                	<td><img class="item_icon" width="72" height="60" src="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
application/images/avatars/<?php echo $_smarty_tpl->tpl_vars['character']->value['byPCClass'];?>
.png" align="absmiddle" ></td>
				    <?php if ($_smarty_tpl->tpl_vars['character']->value['wLevel']>=$_smarty_tpl->tpl_vars['RbLevel']->value&&$_smarty_tpl->tpl_vars['character']->value['dwMoney']>=$_smarty_tpl->tpl_vars['cost']->value&&$_smarty_tpl->tpl_vars['character']->value['Reborn']!=$_smarty_tpl->tpl_vars['MaxRb']->value) {?>
				   		<td><a href="javascript:void(0)" class="nice_button" onClick="Reborn.doreborn('<?php echo $_smarty_tpl->tpl_vars['character']->value['character_no'];?>
', '<?php echo $_smarty_tpl->tpl_vars['character']->value['character_name'];?>
', this);">Reborn</a></td>
					<?php } else { ?>
						<td><a href="javascript:void(0)" class="nice_button">Cant Reborn</a></td>
					<?php }?>
                    <td><a class="character_name" ><?php echo $_smarty_tpl->tpl_vars['character']->value['character_name'];?>
</a></td>
                    <td><img src="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
application/images/icons/coins.png" align="absmiddle"> <?php echo smarty_modifier_number_format($_smarty_tpl->tpl_vars['character']->value['dwMoney'],0,",",".");?>
 Dil</td>
                    <td>Lv <?php echo $_smarty_tpl->tpl_vars['character']->value['wLevel'];?>
</td>
                    <td>Rb <?php echo $_smarty_tpl->tpl_vars['character']->value['Reborn'];?>
</td>
                 </tr>    
				<?php } ?>
                </table>
		<?php } else { ?>
			<center style="padding-top:10px;"><b><?php echo lang("no_chars","teleport");?>
</b></center>
		<?php }?>
	</section>
	<br>
	<div class="clear"></div>
    <section id="ucp_characters">
		<h1>Reborn Requirements</h1>
        <div class="clear"></div>
    </section> 	
		<table class="nice_table" width="100%">
			<tr>
				<td>Level</td>
				<td><?php echo $_smarty_tpl->tpl_vars['RbLevel']->value;?>
</td>
			</tr>
			<tr>
				<td>Max Reborn</td>
				<td><?php echo $_smarty_tpl->tpl_vars['MaxRb']->value;?>
</td>
			</tr>
			<tr>
				<td>Cost</td>
				<td><?php echo smarty_modifier_number_format($_smarty_tpl->tpl_vars['cost']->value,0,",",".");?>
 Dil</td>
			</tr>
		</table>
	<div class="clear"></div>
</section><?php }} ?>
