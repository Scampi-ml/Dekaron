<?php /* Smarty version Smarty-3.1.13, created on 2013-08-20 09:07:27
         compiled from ".\templates\module_game_stats.tpl" */ ?>
<?php /*%%SmartyHeaderCode:142425213943fe5b131-73988754%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5f5194cd36dc98018aaaea5f45b814cb0f6cd782' => 
    array (
      0 => '.\\templates\\module_game_stats.tpl',
      1 => 1368789666,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '142425213943fe5b131-73988754',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'SQLquery1' => 0,
    'SQLquery2' => 0,
    'SQLquery3' => 0,
    'SQLquery4' => 0,
    'SQLquery5' => 0,
    'SQLquery6' => 0,
    'SQLquery7' => 0,
    'SQLquery8' => 0,
    'SQLquery9' => 0,
    'SQLquery10' => 0,
    'SQLquery11' => 0,
    'SQLquery12' => 0,
    'SQLquery13' => 0,
    'SQLquery14' => 0,
    'SQLquery15' => 0,
    'SQLquery16' => 0,
    'SQLquery17' => 0,
    'SQLquery18' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5213943febfdc2_21995660',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5213943febfdc2_21995660')) {function content_5213943febfdc2_21995660($_smarty_tpl) {?><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="table_panel">
<tr>
<td align="center" class="panel_title" colspan="2">Game Statistics</td>
</tr>
<tr class="even">
<td width="50%" align="left" class="panel_text_alt_list">Characters</td>
<td align="left" class="panel_text_alt_list" width="50%"><?php echo $_smarty_tpl->tpl_vars['SQLquery1']->value;?>
</td>
</tr>
<tr>
<td width="50%" align="left" class="panel_text_alt_list">Accounts</td>
<td align="left" class="panel_text_alt_list" width="50%"><?php echo $_smarty_tpl->tpl_vars['SQLquery2']->value;?>
</td>
</tr>
<tr class="even">
<td  width="50%" align="left" class="panel_text_alt_list">Online Accounts</td>
<td align="left" class="panel_text_alt_list" width="50%"><?php echo $_smarty_tpl->tpl_vars['SQLquery3']->value;?>
</td>
</tr>
<tr>
<td width="50%" align="left" class="panel_text_alt_list">Banned Accounts</td>
<td align="left" class="panel_text_alt_list" width="50%"><?php echo $_smarty_tpl->tpl_vars['SQLquery4']->value;?>
</td>
</tr>
<tr class="even">
<td  width="50%" align="left" class="panel_text_alt_list">Guilds</td>
<td align="left" class="panel_text_alt_list" width="50%"><?php echo $_smarty_tpl->tpl_vars['SQLquery5']->value;?>
</td>
</tr>
<tr>
<td width="50%" align="left" class="panel_text_alt_list">Deadfront</td>
<td align="left" class="panel_text_alt_list" width="50%"><?php echo $_smarty_tpl->tpl_vars['SQLquery6']->value;?>
</td>
</tr>
<tr class="even">
<td  width="50%" align="left" class="panel_text_alt_list">Deleted Characters</td>
<td align="left" class="panel_text_alt_list" width="50%"><?php echo $_smarty_tpl->tpl_vars['SQLquery7']->value;?>
</td>
</tr>
<tr>
<td width="50%" align="left" class="panel_text_alt_list">Characters in guild</td>
<td align="left" class="panel_text_alt_list" width="50%"><?php echo $_smarty_tpl->tpl_vars['SQLquery8']->value;?>
</td>
</tr>
<tr class="even">
<td width="50%" align="left" class="panel_text_alt_list">Costumes</td>
<td align="left" class="panel_text_alt_list" width="50%"><?php echo $_smarty_tpl->tpl_vars['SQLquery9']->value;?>
</td>
</tr>
<tr>
<td width="50%" align="left" class="panel_text_alt_list">Mails</td>
<td align="left" class="panel_text_alt_list" width="50%"><?php echo $_smarty_tpl->tpl_vars['SQLquery10']->value;?>
 <a href="index.php?get=module_view_mails">View</a></td>
</tr>
<tr class="even">
<td width="50%" align="left" class="panel_text_alt_list">Deleted Mails</td>
<td align="left" class="panel_text_alt_list" width="50%"><?php echo $_smarty_tpl->tpl_vars['SQLquery11']->value;?>
 <a href="index.php?get=module_view_deleted_mails">View</a></td>
</tr>
<tr>
<td width="50%" align="left" class="panel_text_alt_list">Character doing quests</td>
<td align="left" class="panel_text_alt_list" width="50%"><?php echo $_smarty_tpl->tpl_vars['SQLquery12']->value;?>
</td>
</tr>
<tr class="even">
<td width="50%" align="left" class="panel_text_alt_list">Characters done quests</td>
<td align="left" class="panel_text_alt_list" width="50%"><?php echo $_smarty_tpl->tpl_vars['SQLquery13']->value;?>
</td>
</tr>
<tr>
<td width="50%" align="left" class="panel_text_alt_list">Skills</td>
<td align="left" class="panel_text_alt_list" width="50%"><?php echo $_smarty_tpl->tpl_vars['SQLquery14']->value;?>
</td>
</tr>
<tr class="even">
<td width="50%" align="left" class="panel_text_alt_list">Storage Items</td>
<td align="left" class="panel_text_alt_list" width="50%"><?php echo $_smarty_tpl->tpl_vars['SQLquery15']->value;?>
</td>
</tr>
<tr>
<td width="50%" align="left" class="panel_text_alt_list">Store Items</td>
<td align="left" class="panel_text_alt_list" width="50%"><?php echo $_smarty_tpl->tpl_vars['SQLquery16']->value;?>
</td>
</tr>
<tr class="even">
<td width="50%" align="left" class="panel_text_alt_list">Items</td>
<td align="left" class="panel_text_alt_list" width="50%"><?php echo $_smarty_tpl->tpl_vars['SQLquery17']->value;?>
</td>
</tr>
<tr>
<td width="50%" align="left" class="panel_text_alt_list">Deleted Items</td>
<td align="left" class="panel_text_alt_list" width="50%"><?php echo $_smarty_tpl->tpl_vars['SQLquery18']->value;?>
</td>
</tr>
<tr>
<td align="right" class="panel_buttons" colspan="2"><input type="button" value="Refresh" onclick="ask_url('Are you sure?','index.php?get=module_gamestats')"></td>
</tr>
</table>
<?php }} ?>