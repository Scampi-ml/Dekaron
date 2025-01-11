<?php /* Smarty version Smarty-3.1.16, created on 2014-08-25 05:34:12
         compiled from "application/modules/ucp/views/ucp_characters.tpl" */ ?>
<?php /*%%SmartyHeaderCode:16131004253facad420dab4-53484185%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd3008e8c15ae89154adf867f6d0300ff03670b10' => 
    array (
      0 => 'application/modules/ucp/views/ucp_characters.tpl',
      1 => 1408091341,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '16131004253facad420dab4-53484185',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'characters' => 0,
    'url' => 0,
    'character' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_53facad42a7140_86051043',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53facad42a7140_86051043')) {function content_53facad42a7140_86051043($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['characters']->value>0) {?>
    <div class="ucp_divider"></div>
    <section id="ucp_characters">
		<h1>Characters</h1>
        <div class="clear"></div>
    </section>    
    <table class="nice_table" width="100%">
        <?php  $_smarty_tpl->tpl_vars['character'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['character']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['characters']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['character']->key => $_smarty_tpl->tpl_vars['character']->value) {
$_smarty_tpl->tpl_vars['character']->_loop = true;
?>
            <tr>
                <td><img width="50" height="45" src='<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
application/images/avatars/<?php echo $_smarty_tpl->tpl_vars['character']->value['byPCClass'];?>
.png' align='absbottom'/></td>
                <td><a href="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
character/<?php echo $_smarty_tpl->tpl_vars['character']->value['character_name'];?>
" ><?php echo $_smarty_tpl->tpl_vars['character']->value['character_name'];?>
</a></td>
                <td>Lv<?php echo $_smarty_tpl->tpl_vars['character']->value['wLevel'];?>
</td>
            </tr>        
        <?php } ?>     
    </table>    
<?php }?><?php }} ?>
