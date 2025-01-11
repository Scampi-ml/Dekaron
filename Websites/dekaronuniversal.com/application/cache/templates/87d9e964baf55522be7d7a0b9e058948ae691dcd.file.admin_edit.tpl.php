<?php /* Smarty version Smarty-3.1.16, created on 2014-08-25 08:25:04
         compiled from "application/modules/page/views/admin_edit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:208881894153faf2e0661e81-94482209%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '87d9e964baf55522be7d7a0b9e058948ae691dcd' => 
    array (
      0 => 'application/modules/page/views/admin_edit.tpl',
      1 => 1364235054,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '208881894153faf2e0661e81-94482209',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'page' => 0,
    'url' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_53faf2e0789918_66052483',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53faf2e0789918_66052483')) {function content_53faf2e0789918_66052483($_smarty_tpl) {?><?php echo TinyMCE();?>

<section class="box big">
	<h2>Edit page</h2>

	<form onSubmit="Pages.send(<?php echo $_smarty_tpl->tpl_vars['page']->value['id'];?>
); return false">
		<label for="headline">Headline</label>
		<input type="text" id="headline" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['page']->value['name']);?>
"/>
		
		<label for="identifier">Unique link identifier (as in mywebsite.com/page/<b>mypage</b>)</label>
		<input type="text" id="identifier" placeholder="mypage" value="<?php echo $_smarty_tpl->tpl_vars['page']->value['identifier'];?>
" />

		<label for="visibility">Visibility mode</label>
		<select name="visibility" id="visibility" onChange="if(this.value == 'group'){ $('#groups').fadeIn(300); } else { $('#groups').fadeOut(300); }">
			<option value="everyone" <?php if (!$_smarty_tpl->tpl_vars['page']->value['permission']) {?>selected<?php }?>>Visible to everyone</option>
			<option value="group" <?php if ($_smarty_tpl->tpl_vars['page']->value['permission']) {?>selected<?php }?>>Controlled per group</option>
		</select>

		<div <?php if (!$_smarty_tpl->tpl_vars['page']->value['permission']) {?>style="display:none"<?php }?> id="groups">
			Please manage the group visibility via <a href="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
admin/aclmanager/groups">the group manager</a>
		</div>

		<label for="Pages_content">
			Content
		</label>
	</form>
		<div style="padding:10px;">
			<textarea name="pages_content" class="tinymce" id="pages_content" cols="30" rows="10"><?php echo $_smarty_tpl->tpl_vars['page']->value['content'];?>
</textarea>
		</div>
	<form onSubmit="Pages.send(<?php echo $_smarty_tpl->tpl_vars['page']->value['id'];?>
); return false">
		<input type="submit" value="Save page" />
	</form>
</section>

<script>
	require([Config.URL + "application/themes/admin/js/mli.js"], function()
	{
		new MultiLanguageInput($("#headline"));
	});
</script><?php }} ?>
