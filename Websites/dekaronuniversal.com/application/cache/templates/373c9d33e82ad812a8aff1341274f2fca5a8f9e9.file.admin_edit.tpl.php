<?php /* Smarty version Smarty-3.1.16, created on 2014-08-25 05:35:43
         compiled from "application/modules/news/views/admin_edit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:116976467653facb2f9bbda8-18824874%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '373c9d33e82ad812a8aff1341274f2fca5a8f9e9' => 
    array (
      0 => 'application/modules/news/views/admin_edit.tpl',
      1 => 1407042773,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '116976467653facb2f9bbda8-18824874',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'article' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_53facb2fa9f570_14208808',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53facb2fa9f570_14208808')) {function content_53facb2fa9f570_14208808($_smarty_tpl) {?><?php echo TinyMCE();?>

<section class="box big">
	<h2>Edit article</h2>

	<form onSubmit="News.send(<?php echo $_smarty_tpl->tpl_vars['article']->value['id'];?>
); return false">
		<label for="headline">Headline</label>
		<input type="hidden" id="headline" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['article']->value['headline']);?>
"/>
		
		<label for="news_content">
			Content
		</label>
	</form>
		<div style="padding:10px;">
			<textarea name="news_content" class="tinymce" id="news_content" cols="30" rows="10"><?php echo $_smarty_tpl->tpl_vars['article']->value['content'];?>
</textarea>
		</div>
	<form onSubmit="News.send(<?php echo $_smarty_tpl->tpl_vars['article']->value['id'];?>
); return false">
		<input type="submit" value="Save article" />
	</form>
</section>
<?php }} ?>
