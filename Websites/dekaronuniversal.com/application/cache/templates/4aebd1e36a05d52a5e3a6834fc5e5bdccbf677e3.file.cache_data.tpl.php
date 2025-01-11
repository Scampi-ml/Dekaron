<?php /* Smarty version Smarty-3.1.16, created on 2014-08-25 05:36:27
         compiled from "application/modules/admin/views/cachemanager/cache_data.tpl" */ ?>
<?php /*%%SmartyHeaderCode:170661689453facb5b555ca8-47207670%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4aebd1e36a05d52a5e3a6834fc5e5bdccbf677e3' => 
    array (
      0 => 'application/modules/admin/views/cachemanager/cache_data.tpl',
      1 => 1407315988,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '170661689453facb5b555ca8-47207670',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'website' => 0,
    'template' => 0,
    'total' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_53facb5b5cd9b8_87872904',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53facb5b5cd9b8_87872904')) {function content_53facb5b5cd9b8_87872904($_smarty_tpl) {?><table class="table table-condensed table-bordered">
    <thead>
        <tr>
            <th>Cache Name</th>
            <th>Files</th>
            <th>Size</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td width="20%">Website</td>
            <td width="20%" id="row_item"><?php echo $_smarty_tpl->tpl_vars['website']->value['files'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['website']->value['sizeString'];?>
</td>
        </tr>
        <tr>
            <td width="20%">Template</td>
            <td width="20%" id="row_item"><?php echo $_smarty_tpl->tpl_vars['template']->value['files'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['template']->value['sizeString'];?>
</td>
        </tr>
        <tr>
            <td width="20%">&nbsp;</td>
            <td width="20%">&nbsp;</td>
            <td>&nbsp;</td>
        </tr>        
        <tr>
            <td width="20%"><strong>Total</strong></td>
            <td width="20%" id="row_item"><strong><?php echo $_smarty_tpl->tpl_vars['total']->value['files'];?>
</strong></td>
            <td><strong><?php echo $_smarty_tpl->tpl_vars['total']->value['size'];?>
</strong></td>
        </tr>                                                                
    </tbody>
</table>




<?php }} ?>
