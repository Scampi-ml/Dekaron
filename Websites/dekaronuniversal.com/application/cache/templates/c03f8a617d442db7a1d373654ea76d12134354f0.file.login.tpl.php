<?php /* Smarty version Smarty-3.1.16, created on 2014-08-25 05:34:27
         compiled from "application/themes/admin/login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:69696516353facae3c69c21-47637892%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c03f8a617d442db7a1d373654ea76d12134354f0' => 
    array (
      0 => 'application/themes/admin/login.tpl',
      1 => 1407561233,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '69696516353facae3c69c21-47637892',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'url' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_53facae3d266d3_68833472',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53facae3d266d3_68833472')) {function content_53facae3d266d3_68833472($_smarty_tpl) {?><!DOCTYPE html>
    <!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
    <!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <title>Log in - DekaronCMS</title>
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
        <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
application/js/jquery.min.js"></script>
        <script src="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
application/themes/admin/js/vendor/modernizr-2.7.1-respond-1.4.2.min.js"></script>
        <script src="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
application/themes/admin/js/vendor/bootstrap.min.js"></script>
        <script src="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
application/themes/admin/js/plugins.js"></script>
        <script src="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
application/themes/admin/js/main.js"></script>
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
			var Config = {
				URL: "<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
",
				CSRF: getCookie('csrf_cookie_name')
			};
		</script>
		<script src="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
application/js/require.js" type="text/javascript" ></script>
		<script type="text/javascript">			
			var scripts = [
				"<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
application/js/jquery.transit.min.js",
				"<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
application/themes/admin/js/login.js"
			];
			require(scripts, function()
			{
				
			});			
		</script>
       
    </head>
    <body class="login no-animation">
        <a href="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
admin/" class="login-btn themed-background-default">
            <span class="login-logo">
                <span class="square1 themed-border-default"></span>
                <span class="square2"></span>
            </span>
        </a>
        <div id="login-container">
            <div class="block block-themed">
                <div class="block-title">
                    <h4>Login</h4>
                </div>            
                <div class="block-content">
                    <form onSubmit="Login.send(this); return false" class="form-horizontal">
                        <div class="form-group">
                            <div class="col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                                    <input type="text" id="username" class="form-control" placeholder="Username..">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-asterisk fa-fw"></i></span>
                                    <input type="password" id="password" class="form-control" placeholder="Password..">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12 clearfix">
                                <div class="pull-right">
                                    <button type="submit" class="btn btn-success remove-margin">Login</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html><?php }} ?>
