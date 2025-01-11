<?php /* Smarty version Smarty-3.1.13, created on 2013-11-30 09:50:02
         compiled from ".\templates\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2030529a173a26d433-42974991%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '749422d4cfc3eb5677cf499730392b6accd4d1c7' => 
    array (
      0 => '.\\templates\\index.tpl',
      1 => 1385820939,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2030529a173a26d433-42974991',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'POST' => 0,
    'm_am' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_529a173a350e08_21212163',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_529a173a350e08_21212163')) {function content_529a173a350e08_21212163($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ("html_head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array(), 0);?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="230" valign="top"><?php echo $_smarty_tpl->getSubTemplate ("navigation.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array(), 0);?>
</td>
<td valign="top"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td valign="top"><div align="center" style=""><?php if ($_smarty_tpl->tpl_vars['POST']->value!=''){?><?php echo $_smarty_tpl->tpl_vars['POST']->value;?>
<?php }else{ ?><?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['m_am']->value).".tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array(), 0);?>
<?php }?></div></td>
</tr>
</table></td>
<td valign="top" bgcolor="#465786" width="5">&nbsp;</td>
</tr>
</table>
<?php echo $_smarty_tpl->getSubTemplate ("html_footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null, array(), 0);?>
<?php }} ?>