<?php /* Smarty version Smarty-3.1.16, created on 2014-08-25 05:51:57
         compiled from "application/modules/admin/views/menu/menu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:30069985653facefdcdb646-14853466%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c56dd9296c37b73694176ec31149b53e8f59aecb' => 
    array (
      0 => 'application/modules/admin/views/menu/menu.tpl',
      1 => 1407567552,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '30069985653facefdcdb646-14853466',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'pages' => 0,
    'links' => 0,
    'link' => 0,
    'url' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_53facefddc0cc2_33847062',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53facefddc0cc2_33847062')) {function content_53facefddc0cc2_33847062($_smarty_tpl) {?><script type="text/javascript">
	var customPages = JSON.parse('<?php echo json_encode($_smarty_tpl->tpl_vars['pages']->value);?>
');
</script>
<div class="block block-themed" id="main_link">
    <div class="block-title">
        <div class="block-options">
            <?php if (hasPermission("addMenuLinks")) {?>
                <a title="" class="btn btn-option enable-tooltip" href="javascript:void(0)" data-original-title="Create link" onClick="Menu.add()"><i class="fa fa-plus"></i></a>
            <?php }?>                
        </div>
        <h4>Menu links (<?php if (!$_smarty_tpl->tpl_vars['links']->value) {?>0<?php } else { ?><?php echo count($_smarty_tpl->tpl_vars['links']->value);?>
<?php }?>)</h4>
    </div>
    <div class="block-content">
		<?php if ($_smarty_tpl->tpl_vars['links']->value) {?>
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th>Position</th>
                    <th>Location</th>
                    <th>Name</th>
                    <th>Link</th>
                    <th></th>
                </tr>
            </thead>        
            <tbody>          
            <?php  $_smarty_tpl->tpl_vars['link'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['link']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['links']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['link']->key => $_smarty_tpl->tpl_vars['link']->value) {
$_smarty_tpl->tpl_vars['link']->_loop = true;
?>
            	<tr>
                    <?php if (hasPermission("editMenuLinks")) {?>
                        <td>
                            <div class="btn-group">
                                 <a class="btn btn-sm btn-default" onClick="Menu.move('up', <?php echo $_smarty_tpl->tpl_vars['link']->value['id'];?>
, this)" href="javascript:void(0)" data-original-title="Move Up"><i class="fa fa-caret-up"></i></a>
                                &nbsp;
                                <?php if (hasPermission("deleteMenuLinks")) {?>
                                    <a class="btn btn-sm btn-default" onClick="Menu.move('down', <?php echo $_smarty_tpl->tpl_vars['link']->value['id'];?>
, this)" href="javascript:void(0)" data-original-title="Move Down"><i class="fa fa-caret-down"></i></a>
                                <?php }?>
                            </div>                    
                        </td>
                    <?php }?>
                    <td><?php echo $_smarty_tpl->tpl_vars['link']->value['side'];?>
</td>
                    <td><?php echo langColumn($_smarty_tpl->tpl_vars['link']->value['name']);?>
</td>
                    <td><a href="<?php echo $_smarty_tpl->tpl_vars['link']->value['link'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['link']->value['link_short'];?>
</a></td>
                    <td class="text-right">
                        <div class="btn-group">
                            <?php if (hasPermission("editMenuLinks")) {?>
                            	<a class="btn btn-sm btn-success" href="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
admin/menu/edit/<?php echo $_smarty_tpl->tpl_vars['link']->value['id'];?>
"><i class="fa fa-pencil"></i> Edit</a>
                            <?php }?>
                            &nbsp;
                            <?php if (hasPermission("deleteMenuLinks")) {?>
                            	<a class="btn btn-sm btn-danger" onClick="Menu.remove(<?php echo $_smarty_tpl->tpl_vars['link']->value['id'];?>
, this)"><i class="fa fa-times"></i> Delete</a>
                            <?php }?>
                        </div>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>        
		<?php }?>
    </div>
</div>


<section class="box big" id="add_link" style="display:none;">
	<h2><a href='javascript:void(0)' onClick="Menu.add()" data-tip="Return to menu links">Menu links</a> &rarr; New link</h2>

	<form onSubmit="Menu.create(this); return false" id="submit_form">
		<label for="name">Title</label>
		<input type="text" name="name" id="name" placeholder="My link" />

		<label for="type" data-tip="External links must begin with http://">URL (or <a href="javascript:void(0)" onClick="Menu.selectCustom()">select from custom pages</a>) <a>(?)</a></label>
		<input type="text" name="link" id="link" placeholder="http://"/>

		<label for="side">Menu location</label>
		<select name="side" id="side">
				<option value="top">Top</option>
				<option value="side">Side</option>
		</select>

		<label for="visibility">Visibility mode</label>
		<select name="visibility" id="visibility" onChange="if(this.value == 'group'){ $('#groups').fadeIn(300); } else { $('#groups').fadeOut(300); }">
			<option value="everyone" selected>Visible to everyone</option>
			<option value="group">Controlled per group</option>
		</select>

		<div id="groups" style="display:none;">
			Please manage the group visibility via <a href="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
admin/aclmanager/groups">the group manager</a> once you have created the link
		</div>

<label for="direct_link" data-tip="If you want to link to a non-DekaronCMS page on the same domain, you must select 'Yes' otherwise DekaronCMS will try to load it 'inside' the theme.">Internal direct link <a>(?)</a></label>
		<select name="direct_link" id="direct_link">
				<option value="0">No</option>
				<option value="1">Yes</option>
		</select>
	
		<input type="submit" value="Submit link" />
	</form>
</section><?php }} ?>
