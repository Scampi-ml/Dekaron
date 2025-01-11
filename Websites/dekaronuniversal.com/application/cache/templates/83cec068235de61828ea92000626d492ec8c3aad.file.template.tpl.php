<?php /* Smarty version Smarty-3.1.16, created on 2014-08-25 05:44:18
         compiled from "application/themes/admin/template.tpl" */ ?>
<?php /*%%SmartyHeaderCode:163681712053facb1b677833-41474511%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '83cec068235de61828ea92000626d492ec8c3aad' => 
    array (
      0 => 'application/themes/admin/template.tpl',
      1 => 1408945438,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '163681712053facb1b677833-41474511',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_53facb1b75b722_69541520',
  'variables' => 
  array (
    'title' => 0,
    'url' => 0,
    'extra_css' => 0,
    'defaultLanguage' => 0,
    'extra_js' => 0,
    'current_page' => 0,
    'menu' => 0,
    'group' => 0,
    'text' => 0,
    'link' => 0,
    'page' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53facb1b75b722_69541520')) {function content_53facb1b75b722_69541520($_smarty_tpl) {?><!DOCTYPE html>
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]--><head>
        <meta charset="utf-8">
        <title><?php if ($_smarty_tpl->tpl_vars['title']->value) {?><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
<?php }?>DekaronCMS</title>
        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0">
        <link rel="shortcut icon" href="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
application/themes/admin/img/favicon.ico">
        <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
application/themes/admin/css/bootstrap.css">
        <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
application/themes/admin/css/plugins.css">
        <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
application/themes/admin/css/main.css">
        <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
application/themes/admin/css/themes.css">
        <?php if ($_smarty_tpl->tpl_vars['extra_css']->value) {?><link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
application/<?php echo $_smarty_tpl->tpl_vars['extra_css']->value;?>
" type="text/css"><?php }?>
        <script src="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
application/js/jquery.min.js"></script>
        <script src="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
application/themes/admin/js/vendor/modernizr-2.7.1-respond-1.4.2.min.js"></script>
        <script src="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
application/themes/admin/js/vendor/bootstrap.min.js"></script>
        <script src="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
application/themes/admin/js/plugins.js"></script>
        <script src="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
application/themes/admin/js/main.js"></script>     
		<script src="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
application/themes/admin/js/router.js" type="text/javascript"></script>
		<script src="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
application/js/require.js" type="text/javascript" ></script>                  
		<script type="text/javascript">
			function getCookie(c_name){
				var i, x, y, ARRcookies = document.cookie.split(";");

				for(i = 0; i < ARRcookies.length;i++){
					x = ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
					y = ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
					x = x.replace(/^\s+|\s+$/g,"");
					
					if(x == c_name) {
						return unescape(y);
					}
				}
			}
			var Config = {
				URL: "<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
",
				CSRF: getCookie('csrf_cookie_name'),
				isACP: true,
				defaultLanguage: "<?php echo $_smarty_tpl->tpl_vars['defaultLanguage']->value;?>
"
			};
			var scripts = [
				"<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
application/js/admin.ui.js",
				<?php if ($_smarty_tpl->tpl_vars['extra_js']->value) {?>,"<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
application/<?php echo $_smarty_tpl->tpl_vars['extra_js']->value;?>
"<?php }?>
			];

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
    </head>
    <body>
        <div id="confirm" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header"><h4>&nbsp;</h4></div>
                    <div class="modal-body"><p id="confirm_question"></p></div>                            
                    <div class="modal-footer"><center><button class="btn btn-success" id="confirm_button"></button><button class="btn btn-danger" data-dismiss="modal">Cancel</button></center></div>
                </div>
            </div>
        </div>  
        <div id="alert" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header"><h4>&nbsp;</h4></div>                    
                    <div class="modal-body"><p id="alert_message"></p></div>                        
                    <div class="modal-footer"><center><button class="btn btn-danger" data-dismiss="modal">Close</button></center></div>
                </div>
            </div>
        </div>
        <div id="page-container" class="full-width">
            <header class="navbar navbar-inverse">
                <div class="row">
                    <div class="col-sm-4 hidden-xs">
                        <ul class="navbar-nav-custom pull-left">
                            <li class="visible-md visible-lg"><a href="javascript:void(0)" id="toggle-side-content"><i class="fa fa-bars"></i></a></li>
                            <li class="divider-vertical"></li>
                        </ul>
                    </div>
                    <div class="col-sm-4 col-xs-12 text-center">
                        <a href="index.php" class="navbar-brand"><img src="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
application/themes/admin/img/template/logo.png" alt="logo"></a>
                    </div>
                    <div id="header-nav-section" class="col-sm-4 col-xs-12 clearfix">
                        <ul class="navbar-nav-custom pull-left visible-xs visible-sm" id="mobile-nav">
                            <li><a href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-main-collapse"><i class="fa fa-bars"></i></a></li>
                            <li class="divider-vertical"></li>
                        </ul>
                    </div>
                </div>
            </header>
            <aside id="page-sidebar" class="collapse navbar-collapse navbar-main-collapse">
                <div class="side-scrollable">
                    <div class="sidebar">
                        <nav id="primary-nav">
                            <ul>
                                <li <?php if ($_smarty_tpl->tpl_vars['current_page']->value=="admin/") {?>class="active"<?php }?>><a href="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
admin/"><i class="gi gi-display"></i>Dashboard</a></li>
                                <?php  $_smarty_tpl->tpl_vars['group'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['group']->_loop = false;
 $_smarty_tpl->tpl_vars['text'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['menu']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['group']->key => $_smarty_tpl->tpl_vars['group']->value) {
$_smarty_tpl->tpl_vars['group']->_loop = true;
 $_smarty_tpl->tpl_vars['text']->value = $_smarty_tpl->tpl_vars['group']->key;
?>
                                    <?php if (count($_smarty_tpl->tpl_vars['group']->value['links'])) {?>
										
									
									
                                        <li class="active">
                                            <a href="#" class="menu-link" ><?php echo $_smarty_tpl->tpl_vars['text']->value;?>
</a>
                                        	<ul>                           
                                                <li>
                                                    <?php  $_smarty_tpl->tpl_vars['link'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['link']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['group']->value['links']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['link']->key => $_smarty_tpl->tpl_vars['link']->value) {
$_smarty_tpl->tpl_vars['link']->_loop = true;
?>
                                                        <a href="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
<?php echo $_smarty_tpl->tpl_vars['link']->value['module'];?>
/<?php echo $_smarty_tpl->tpl_vars['link']->value['controller'];?>
" <?php if (isset($_smarty_tpl->tpl_vars['link']->value['active'])) {?>class="active"<?php }?>><?php echo $_smarty_tpl->tpl_vars['link']->value['text'];?>
</a>
                                                    <?php } ?>
                                                </li>  
											</ul>                                             
                                        </li> 
                                   
                                    <?php }?>
                                <?php } ?>
                            </ul>
                        </nav>
                    </div>
                </div>
            </aside>
			<?php echo $_smarty_tpl->tpl_vars['page']->value;?>

        </div>
        <a href="#" id="to-top"><i class="fa fa-chevron-up"></i></a>
    </body>
</html><?php }} ?>
