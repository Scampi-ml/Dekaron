<?php /* Smarty version Smarty-3.1.16, created on 2014-08-25 05:34:01
         compiled from "application/views/header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:136572465853facac98a30e1-76427691%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8cb8a07c663590b43542addec35e3d474779bd72' => 
    array (
      0 => 'application/views/header.tpl',
      1 => 1408347538,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '136572465853facac98a30e1-76427691',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'title' => 0,
    'path' => 0,
    'style_path' => 0,
    'extra_css' => 0,
    'favicon' => 0,
    'description' => 0,
    'keywords' => 0,
    'url' => 0,
    'image_path' => 0,
    'activeLanguage' => 0,
    'show_slider' => 0,
    'slider_interval' => 0,
    'slider_style' => 0,
    'slider_id' => 0,
    'slider' => 0,
    'extra_js' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_53facac9956979_85595635',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53facac9956979_85595635')) {function content_53facac9956979_85595635($_smarty_tpl) {?><!DOCTYPE html>
<html>
	<head>
		<title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>
		<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['path']->value;?>
css/default.css" type="text/css" />
		<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['style_path']->value;?>
cms.css" type="text/css" />
		<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['style_path']->value;?>
main.css" type="text/css" />
		<?php if ($_smarty_tpl->tpl_vars['extra_css']->value) {?><link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['path']->value;?>
<?php echo $_smarty_tpl->tpl_vars['extra_css']->value;?>
" type="text/css" /><?php }?>
		<link rel="shortcut icon" href="<?php echo $_smarty_tpl->tpl_vars['favicon']->value;?>
" />
		<meta name="description" content="<?php echo $_smarty_tpl->tpl_vars['description']->value;?>
" />
		<meta name="keywords" content="<?php echo $_smarty_tpl->tpl_vars['keywords']->value;?>
" />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> 
    	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['path']->value;?>
js/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['path']->value;?>
js/router.js"></script>
		<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['path']->value;?>
js/require.js"></script>   
		<script type="text/javascript">
			function getCookie(c_name){
				var i, x, y, ARRcookies = document.cookie.split(";");
				for(i = 0; i < ARRcookies.length;i++){
					x = ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
					y = ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
					x = x.replace(/^\s+|\s+$/g,"");
					if(x == c_name){
						return unescape(y);
					}
				}
			}
			function setCookie(c_name,value,exdays){
				var exdate = new Date();
				exdate.setDate(exdate.getDate() + exdays);
				var c_value = escape(value) + ((exdays == null) ? "" : "; expires="+exdate.toUTCString());
				document.cookie = c_name + "=" + c_value;
			}
			var Config = {
				URL: "<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
",			
				image_path: "<?php echo $_smarty_tpl->tpl_vars['image_path']->value;?>
",
				CSRF: getCookie('csrf_cookie_name'),
				language: "<?php echo $_smarty_tpl->tpl_vars['activeLanguage']->value;?>
",
				<?php if ($_smarty_tpl->tpl_vars['show_slider']->value) {?>
					Slider: {
						interval: "<?php echo $_smarty_tpl->tpl_vars['slider_interval']->value;?>
",
						effect: "<?php echo $_smarty_tpl->tpl_vars['slider_style']->value;?>
",
						id: "<?php echo $_smarty_tpl->tpl_vars['slider_id']->value;?>
"
					},
					Theme: {
						next: "<?php echo $_smarty_tpl->tpl_vars['slider']->value['next'];?>
",
						previous: "<?php echo $_smarty_tpl->tpl_vars['slider']->value['previous'];?>
"
					}					
				<?php }?>

			};
			var scripts = [
				"<?php echo $_smarty_tpl->tpl_vars['path']->value;?>
js/ui.js",
				<?php if ($_smarty_tpl->tpl_vars['show_slider']->value) {?>"<?php echo $_smarty_tpl->tpl_vars['path']->value;?>
js/flux.min.js",<?php }?>
				"<?php echo $_smarty_tpl->tpl_vars['path']->value;?>
js/jquery.transit.min.js",
				"<?php echo $_smarty_tpl->tpl_vars['path']->value;?>
js/language.js",
				<?php if ($_smarty_tpl->tpl_vars['extra_js']->value) {?>,"<?php echo $_smarty_tpl->tpl_vars['path']->value;?>
<?php echo $_smarty_tpl->tpl_vars['extra_js']->value;?>
"<?php }?>
			];
			if(typeof JSON == "undefined"){
				scripts.push("<?php echo $_smarty_tpl->tpl_vars['path']->value;?>
js/json2.js");
			}
			require(scripts, function(){
				$(document).ready(function(){
					UI.initialize();
					<?php if ($_smarty_tpl->tpl_vars['extra_css']->value) {?>Router.loadedCSS.push("<?php echo $_smarty_tpl->tpl_vars['extra_css']->value;?>
");<?php }?>
					<?php if ($_smarty_tpl->tpl_vars['extra_js']->value) {?>Router.loadedJS.push("<?php echo $_smarty_tpl->tpl_vars['extra_js']->value;?>
");<?php }?>
				});
			});
		</script>           
	</head><?php }} ?>
