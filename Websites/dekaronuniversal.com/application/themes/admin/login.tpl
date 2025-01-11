<!DOCTYPE html>
    <!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
    <!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <title>Log in - DekaronCMS</title>
        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0">
        <link rel="shortcut icon" href="{$url}application/themes/admin/img/favicon.ico">
        <link rel="stylesheet" href="{$url}application/themes/admin/css/bootstrap.css">
        <link rel="stylesheet" href="{$url}application/themes/admin/css/plugins.css">
        <link rel="stylesheet" href="{$url}application/themes/admin/css/main.css">
        <link rel="stylesheet" href="{$url}application/themes/admin/css/themes.css">
        <script type="text/javascript" src="{$url}application/js/jquery.min.js"></script>
        <script src="{$url}application/themes/admin/js/vendor/modernizr-2.7.1-respond-1.4.2.min.js"></script>
        <script src="{$url}application/themes/admin/js/vendor/bootstrap.min.js"></script>
        <script src="{$url}application/themes/admin/js/plugins.js"></script>
        <script src="{$url}application/themes/admin/js/main.js"></script>
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
				URL: "{$url}",
				CSRF: getCookie('csrf_cookie_name')
			};
		</script>
		<script src="{$url}application/js/require.js" type="text/javascript" ></script>
		<script type="text/javascript">			
			var scripts = [
				"{$url}application/js/jquery.transit.min.js",
				"{$url}application/themes/admin/js/login.js"
			];
			require(scripts, function()
			{
				
			});			
		</script>
       
    </head>
    <body class="login no-animation">
        <a href="{$url}admin/" class="login-btn themed-background-default">
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
</html>