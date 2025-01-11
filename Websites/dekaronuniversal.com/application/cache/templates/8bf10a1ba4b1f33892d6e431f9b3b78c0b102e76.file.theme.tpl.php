<?php /* Smarty version Smarty-3.1.16, created on 2014-08-25 05:37:39
         compiled from "application/modules/admin/views/theme.tpl" */ ?>
<?php /*%%SmartyHeaderCode:54690895053facba377f300-42080503%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8bf10a1ba4b1f33892d6e431f9b3b78c0b102e76' => 
    array (
      0 => 'application/modules/admin/views/theme.tpl',
      1 => 1407053158,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '54690895053facba377f300-42080503',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'themes' => 0,
    'url' => 0,
    'manifest' => 0,
    'current_theme' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_53facba3853ea3_30587148',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53facba3853ea3_30587148')) {function content_53facba3853ea3_30587148($_smarty_tpl) {?><table class="table table-condensed">
    <?php  $_smarty_tpl->tpl_vars['manifest'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['manifest']->_loop = false;
 $_smarty_tpl->tpl_vars['id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['themes']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['manifest']->key => $_smarty_tpl->tpl_vars['manifest']->value) {
$_smarty_tpl->tpl_vars['manifest']->_loop = true;
 $_smarty_tpl->tpl_vars['id']->value = $_smarty_tpl->tpl_vars['manifest']->key;
?>
        <tr>
            <td><img src="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
application/themes/<?php echo strtolower($_smarty_tpl->tpl_vars['manifest']->value['folderName']);?>
/images/<?php echo $_smarty_tpl->tpl_vars['manifest']->value['favicon'];?>
" /></td>
            <td>
                <div class="col-sm-2 gallery-image">
                    <img alt="image" src="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
application/themes/<?php echo $_smarty_tpl->tpl_vars['manifest']->value['folderName'];?>
/<?php echo $_smarty_tpl->tpl_vars['manifest']->value['screenshot'];?>
">
                </div>            
            </td>
            <td><?php echo $_smarty_tpl->tpl_vars['manifest']->value['name'];?>
<br /> by <a target="_blank" href="<?php echo $_smarty_tpl->tpl_vars['manifest']->value['website'];?>
"><?php echo $_smarty_tpl->tpl_vars['manifest']->value['author'];?>
</a></td>
            <td>
                <?php if ($_smarty_tpl->tpl_vars['manifest']->value['folderName']==$_smarty_tpl->tpl_vars['current_theme']->value) {?>
                    Active theme
                <?php } else { ?>
                    <a class="btn btn-default" href="javascript:void(0)" onClick="Theme.select('<?php echo strtolower($_smarty_tpl->tpl_vars['manifest']->value['folderName']);?>
')">Activate theme</a>
                <?php }?>            
            </td>
        </tr>            
    <?php } ?>   
</table> 





<?php }} ?>
