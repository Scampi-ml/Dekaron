<?php /* Smarty version Smarty-3.1.13, created on 2013-08-02 06:24:49
         compiled from ".\templates\module_server_info.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1338451fbb321dda6e7-41370037%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b39db38af9b882f5198befd9855838e900186a13' => 
    array (
      0 => '.\\templates\\module_server_info.tpl',
      1 => 1368789666,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1338451fbb321dda6e7-41370037',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'PHP_VERSION' => 0,
    'SERVER_SOFTWARE' => 0,
    'memory_limit' => 0,
    'display_errors' => 0,
    'date' => 0,
    'timezone' => 0,
    'mssql_info0' => 0,
    'mssql_info1' => 0,
    'mssql_info2' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_51fbb321e00358_48523012',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51fbb321e00358_48523012')) {function content_51fbb321e00358_48523012($_smarty_tpl) {?><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
<tr>
<td align="center" class="panel_title" colspan="2">Webserver Info</td>
</tr>
<tr>
<td align="left" class="panel_title_sub" colspan="2">PHP</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">Current php version</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><?php echo $_smarty_tpl->tpl_vars['PHP_VERSION']->value;?>
</td>
</tr>
<td align="left" class="panel_title_sub" colspan="2">Server</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">Server software & modules</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><?php echo $_smarty_tpl->tpl_vars['SERVER_SOFTWARE']->value;?>
</td>
</tr>
<tr>
<td align="left" class="panel_title_sub" colspan="2">Memory</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">Current memory usage / Server memory limit</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><?php echo $_smarty_tpl->tpl_vars['memory_limit']->value;?>
</td>
</tr>
<tr>
<td align="left" class="panel_title_sub" colspan="2">Error Reporting</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">Current level of error reporting</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><?php echo $_smarty_tpl->tpl_vars['display_errors']->value;?>
</td>
</tr>
<tr>
<td align="left" class="panel_title_sub" colspan="2">Time / Date</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">Current date + time</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><?php echo $_smarty_tpl->tpl_vars['date']->value;?>
</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">Timezone</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><?php echo $_smarty_tpl->tpl_vars['timezone']->value;?>
</td>
</tr>
</table>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel" style="margin-top: 20px;">
<tr>
<td align="center" class="panel_title" colspan="2">MsSQL Info</td>
</tr>
<tr>
<td align="left" class="panel_title_sub" colspan="2">Product version</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">Current mssql version</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><?php echo $_smarty_tpl->tpl_vars['mssql_info0']->value;?>
</b></td>
</tr>
<td align="left" class="panel_title_sub" colspan="2">Service Pack</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">Current service pack</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><?php echo $_smarty_tpl->tpl_vars['mssql_info1']->value;?>
</td>
</tr>
<tr>
<td align="left" class="panel_title_sub" colspan="2">MsSQL edition</td>
</tr>
<tr>
<td align="left" class="panel_text_alt1" width="45%" valign="top">Type of mssql server edition</td>
<td align="left" class="panel_text_alt2" width="45%" valign="top"><?php echo $_smarty_tpl->tpl_vars['mssql_info2']->value;?>
</td>
</tr>
</table><?php }} ?>