<?php /* Smarty version Smarty-3.1.16, created on 2014-08-25 08:24:52
         compiled from "application/modules/page/views/admin.tpl" */ ?>
<?php /*%%SmartyHeaderCode:172143609553faf2d42d21f0-10566272%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1b3f1043ce83dee1f117859df7e9768b80dcf438' => 
    array (
      0 => 'application/modules/page/views/admin.tpl',
      1 => 1407103257,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '172143609553faf2d42d21f0-10566272',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'pages' => 0,
    'url' => 0,
    'page' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_53faf2d43a7516_30922944',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53faf2d43a7516_30922944')) {function content_53faf2d43a7516_30922944($_smarty_tpl) {?><?php echo TinyMCE();?>

<div class="block block-themed">
    <div class="block-title">
        <div class="block-options">
            <?php if (hasPermission("canAdd")) {?>
                <a data-toggle="block-collapse" class="btn btn-option enable-tooltip" href="javascript:void(0)" data-original-title="Create page"  onClick="Pages.show()"><i class="fa fa-plus"></i></a>
            <?php }?>                
        </div>
        <h4>Pages (<?php if (!$_smarty_tpl->tpl_vars['pages']->value) {?>0<?php } else { ?><?php echo count($_smarty_tpl->tpl_vars['pages']->value);?>
<?php }?>)</h4>
    </div>
    <div class="block-content">
		<?php if ($_smarty_tpl->tpl_vars['pages']->value) {?>
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th>Page Link</th>
                    <th>Page Name</th>
                    <th></th>
                </tr>
            </thead>        
            <tbody>          
            <?php  $_smarty_tpl->tpl_vars['page'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['page']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['pages']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['page']->key => $_smarty_tpl->tpl_vars['page']->value) {
$_smarty_tpl->tpl_vars['page']->_loop = true;
?>
            	<tr>
                    <td><a href="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
page/<?php echo $_smarty_tpl->tpl_vars['page']->value['identifier'];?>
/" target="_blank">/page/<?php echo $_smarty_tpl->tpl_vars['page']->value['identifier'];?>
/</a></td>
                    <td><?php echo $_smarty_tpl->tpl_vars['page']->value['name'];?>
</td>
                    <td class="text-right">
                        <div class="btn-group">
                            <?php if (hasPermission("canEdit")) {?>
                            	<a class="btn btn-sm btn-success"href="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
page/admin/edit/<?php echo $_smarty_tpl->tpl_vars['page']->value['id'];?>
">Edit</a>
                            <?php }?>
                            &nbsp;
                            <?php if (hasPermission("canRemove")) {?>
                            	<a class="btn btn-sm btn-danger" href="javascript:void(0)" onClick="Pages.remove(<?php echo $_smarty_tpl->tpl_vars['page']->value['id'];?>
, this)">Delete</a>
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

<div id="add_pages" style="display:none;">
	<section class="box big">
		<h2><a href='javascript:void(0)' onClick="Pages.show()" data-tip="Return to pages">Pages</a> &rarr; New page</h2>

		<form onSubmit="Pages.send(); return false">
			<label for="headline">Headline</label>
			<input type="text" id="headline" />
			
			<label for="identifier">Unique link identifier (as in mywebsite.com/page/<b>mypage</b>)</label>
			<input type="text" id="identifier" placeholder="mypage" />

			<label for="visibility">Visibility mode</label>
			<select name="visibility" id="visibility" onChange="if(this.value == 'group'){ $('#groups').fadeIn(300); } else { $('#groups').fadeOut(300); }">
				<option value="everyone" selected>Visible to everyone</option>
				<option value="group">Controlled per group</option>
			</select>

			<div id="groups" style="display:none;">
				Please manage the group visibility via <a href="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
admin/aclmanager/groups">the group manager</a> once you have created the page
			</div>

			<label for="pages_content">
				Content
			</label>
		</form>
			<div style="padding:10px;">
				<textarea name="pages_content" class="tinymce" id="pages_content" cols="30" rows="10"></textarea>
			</div>
		<form onSubmit="Pages.send(); return false">
			<input type="submit" value="Submit page" />
		</form>
	</section>
</div>

<script>
	require([Config.URL + "application/themes/admin/js/mli.js"], function()
	{
		new MultiLanguageInput($("#headline"));
	});
</script><?php }} ?>
