<?php /* Smarty version Smarty-3.1.16, created on 2014-08-25 05:51:52
         compiled from "application/modules/admin/views/sidebox/sidebox.tpl" */ ?>
<?php /*%%SmartyHeaderCode:161165507253facef8ed7d84-00308954%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '84a826d288e97f1a34e1d09f865ba33ed806c150' => 
    array (
      0 => 'application/modules/admin/views/sidebox/sidebox.tpl',
      1 => 1407223432,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '161165507253facef8ed7d84-00308954',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'sideboxes' => 0,
    'sidebox' => 0,
    'url' => 0,
    'sideboxModules' => 0,
    'name' => 0,
    'module' => 0,
    'fusionEditor' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_53facef9090144_03628595',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53facef9090144_03628595')) {function content_53facef9090144_03628595($_smarty_tpl) {?><div class="block block-themed">
    <div class="block-title">
        <div class="block-options">
        	<a title="" data-toggle="modal" href="#modal-regular" class="btn btn-option enable-tooltip" href="javascript:void(0)" data-original-title="Create sidebox" onClick="Sidebox.add()"><i class="fa fa-plus"></i></a>
        </div>
        <h4>Sideboxes <?php if (!$_smarty_tpl->tpl_vars['sideboxes']->value) {?>0<?php } else { ?><?php echo count($_smarty_tpl->tpl_vars['sideboxes']->value);?>
<?php }?></h4>
    </div>
    <div class="block-content">
		<?php if ($_smarty_tpl->tpl_vars['sideboxes']->value) {?>
        	<table width="100%" class="table table-condensed">
                <?php  $_smarty_tpl->tpl_vars['sidebox'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['sidebox']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['sideboxes']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['sidebox']->key => $_smarty_tpl->tpl_vars['sidebox']->value) {
$_smarty_tpl->tpl_vars['sidebox']->_loop = true;
?>
                    <tr>
                        <td width="10%">
                            <a class="btn btn-sm btn-default" onClick="Sidebox.move('up', <?php echo $_smarty_tpl->tpl_vars['sidebox']->value['id'];?>
, this)" href="javascript:void(0)" data-original-title="Move Up"><i class="fa fa-caret-up"></i></a>
                            <a class="btn btn-sm btn-default" onClick="Sidebox.move('down', <?php echo $_smarty_tpl->tpl_vars['sidebox']->value['id'];?>
, this)" href="javascript:void(0)" data-original-title="Move Down"><i class="fa fa-caret-down"></i></a>
                        </td>
                        <td width="20%"><b><?php echo langColumn($_smarty_tpl->tpl_vars['sidebox']->value['displayName']);?>
</b></td>
                        <td width="30%"><?php echo $_smarty_tpl->tpl_vars['sidebox']->value['name'];?>
</td>
                        <td width="30%">
                            <?php if ($_smarty_tpl->tpl_vars['sidebox']->value['permission']) {?>
                                Controlled per group
                            <?php } else { ?>
                                Visible to everyone
                            <?php }?>
                        </td>
                        <td>
                            <div class="btn-group">
                                <a class="btn btn-sm btn-success" href="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
admin/sidebox/edit/<?php echo $_smarty_tpl->tpl_vars['sidebox']->value['id'];?>
"><i class="fa fa-pencil"></i> Edit</a>
                                <a class="btn btn-sm btn-danger" onClick="Sidebox.remove(<?php echo $_smarty_tpl->tpl_vars['sidebox']->value['id'];?>
, this)"><i class="fa fa-times"></i> Delete</a>
                            </div>                                
                        </td>
                    </tr>
                <?php } ?>
            </table>
		<?php }?>
	</div>
</div>

<div class="modal fade" id="modal-regular" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Sideboxes</a> &rarr; New sidebox</h4>
            </div>
            <div class="modal-body">
                <p>
                    <form onSubmit="Sidebox.create(this); return false" id="submit_form">
                        <label for="displayName">Headline</label>
                        <input type="text" name="displayName" id="displayName" />
                
                        <label for="type">Sidebox module</label>
                        <select id="type" name="type" onChange="Sidebox.toggleCustom(this)">
                            <?php  $_smarty_tpl->tpl_vars['module'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['module']->_loop = false;
 $_smarty_tpl->tpl_vars['name'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['sideboxModules']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['module']->key => $_smarty_tpl->tpl_vars['module']->value) {
$_smarty_tpl->tpl_vars['module']->_loop = true;
 $_smarty_tpl->tpl_vars['name']->value = $_smarty_tpl->tpl_vars['module']->key;
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['module']->value['name'];?>
</option>
                            <?php } ?>
                        </select>
                
                        <label for="visibility">Visibility mode</label>
                        <select name="visibility" id="visibility" onChange="if(this.value == 'group'){ $('#groups').fadeIn(300); } else { $('#groups').fadeOut(300); }">
                            <option value="everyone" selected>Visible to everyone</option>
                            <option value="group">Controlled per group</option>
                        </select>
                
                        <div style="display:none" id="groups">
                            Please manage the group visibility via <a href="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
admin/aclmanager/groups">the group manager</a> once you have created the sidebox
                        </div>
                    </form>
                
                    <span id="custom_field" style="padding-top:0px;padding-bottom:0px;">
                        <label for="text">Content</label>
                        <?php echo $_smarty_tpl->tpl_vars['fusionEditor']->value;?>

                    </span>
                
                    <form onSubmit="Sidebox.create(document.getElementById('submit_form')); return false">
                        <input type="submit" value="Submit sidebox" />
                    </form>                
                </p>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-danger">Close</button>
            </div>
        </div>
    </div>
</div>



<?php }} ?>
