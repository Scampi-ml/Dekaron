<?php /* Smarty version Smarty-3.1.16, created on 2014-08-25 05:37:33
         compiled from "application/modules/admin/views/languages/languages.tpl" */ ?>
<?php /*%%SmartyHeaderCode:128759226653facb9d2d5215-45963695%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7769ea119f882b2fd29b284b045cf6b3bc62a745' => 
    array (
      0 => 'application/modules/admin/views/languages/languages.tpl',
      1 => 1407222490,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '128759226653facb9d2d5215-45963695',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'languages' => 0,
    'url' => 0,
    'flag' => 0,
    'language' => 0,
    'default' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_53facb9d39c415_78536643',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53facb9d39c415_78536643')) {function content_53facb9d39c415_78536643($_smarty_tpl) {?><div class="block block-themed">
    <div class="block-title">
        <h4>Supported languages <?php if (!$_smarty_tpl->tpl_vars['languages']->value) {?>0<?php } else { ?><?php echo count($_smarty_tpl->tpl_vars['languages']->value);?>
<?php }?></h4>
    </div>
    <div class="block-content">
        <?php if ($_smarty_tpl->tpl_vars['languages']->value) {?>
        	<table width="100%" class="table table-condensed">
            	<?php  $_smarty_tpl->tpl_vars['language'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['language']->_loop = false;
 $_smarty_tpl->tpl_vars['flag'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['languages']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['language']->key => $_smarty_tpl->tpl_vars['language']->value) {
$_smarty_tpl->tpl_vars['language']->_loop = true;
 $_smarty_tpl->tpl_vars['flag']->value = $_smarty_tpl->tpl_vars['language']->key;
?>
                    <tr>
                        <td width="2%"><img src="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
application/images/flags/<?php echo $_smarty_tpl->tpl_vars['flag']->value;?>
.png" alt="<?php echo $_smarty_tpl->tpl_vars['flag']->value;?>
"></td>
                        <td width="9%"><?php echo ucfirst($_smarty_tpl->tpl_vars['language']->value);?>
</td>
                        <td width="89%">
                            <?php if ($_smarty_tpl->tpl_vars['language']->value==$_smarty_tpl->tpl_vars['default']->value) {?>
                          <div style="color:green">Default language</div>
                            <?php } elseif (hasPermission("changeDefaultLanguage")) {?>
                                <a class="btn btn-default" href="javascript:void(0)" onClick="Languages.set('<?php echo $_smarty_tpl->tpl_vars['language']->value;?>
')">Set as default</a>
                            <?php }?>                                        
                      </td>
              </tr>
            	<?php } ?>
        	</table> 
        <?php }?>
    </div>
</div>
<div class="alert alert-info">
	<b>Want more?</b> Get more languages from the <a href="#" target="_blank">localization GitHub repository</a>
</div>        <?php }} ?>
