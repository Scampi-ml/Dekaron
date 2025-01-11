<?php /* Smarty version Smarty-3.1.16, created on 2014-08-25 05:35:41
         compiled from "application/views/tinymce.tpl" */ ?>
<?php /*%%SmartyHeaderCode:114832689153facb2da95d18-04626201%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2bd8bd1cdc9c225882cfbc258379960d34ad06f3' => 
    array (
      0 => 'application/views/tinymce.tpl',
      1 => 1406795680,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '114832689153facb2da95d18-04626201',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'url' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_53facb2daae958_57476039',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53facb2daae958_57476039')) {function content_53facb2daae958_57476039($_smarty_tpl) {?><script type="text/javascript">
	require(["<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
application/js/tiny_mce/jquery.tinymce.js"], function()
	{
		$('textarea.tinymce').tinymce({
			// Location of TinyMCE script
			script_url : '<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
application/js/tiny_mce/tiny_mce.js',

			height: "300",

			// General options
			theme : "advanced",
			plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist",

			// Theme options
			theme_advanced_buttons1 : "bold,italic,underline,|,justifyleft,justifycenter,justifyright,formatselect,fontselect,fontsizeselect,charmap,iespell,media,|,fullscreen,bullist,numlist,removeformat",
			theme_advanced_buttons2 : "outdent,indent,|,undo,redo,|,link,unlink,image,cleanup,code,|,forecolor,tablecontrols,|,visualaid",
			theme_advanced_buttons3 : "",
			theme_advanced_buttons4 : "",
			theme_advanced_toolbar_location : "top",
			theme_advanced_toolbar_align : "left",
			theme_advanced_statusbar_location : "bottom",
			theme_advanced_resizing : true,

			// Example content CSS (should be your site CSS)
			content_css : "",

			// Drop lists for link/image/media/template dialogs
			template_external_list_url : "lists/template_list.js",
			external_link_list_url : "lists/link_list.js",
			external_image_list_url : "lists/image_list.js",
			media_external_list_url : "lists/media_list.js",

			// Replace values for the template plugin
			template_replace_values : {
				username : "Some User",
				staffid : "991234"
			}
		});
	});
</script><?php }} ?>
