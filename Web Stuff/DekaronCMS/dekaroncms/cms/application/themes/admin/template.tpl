<!DOCTYPE html>
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]--><head>
        <meta charset="utf-8">
        <title>{if $title}{$title}{/if}DekaronCMS</title>
        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0">
        <link rel="shortcut icon" href="{$url}application/themes/admin/img/favicon.ico">
        <link rel="stylesheet" href="{$url}application/themes/admin/css/bootstrap.css">
        <link rel="stylesheet" href="{$url}application/themes/admin/css/plugins.css">
        <link rel="stylesheet" href="{$url}application/themes/admin/css/main.css">
        <link rel="stylesheet" href="{$url}application/themes/admin/css/themes.css">
        {if $extra_css}<link rel="stylesheet" href="{$url}application/{$extra_css}" type="text/css">{/if}
        <script src="{$url}application/js/jquery.min.js"></script>
        <script src="{$url}application/themes/admin/js/vendor/bootstrap.min.js"></script>
        <script src="{$url}application/themes/admin/js/plugins.js"></script>
        <script src="{$url}application/themes/admin/js/main.js"></script>             
        <script src="{$url}application/themes/admin/js/vendor/modernizr-2.7.1-respond-1.4.2.min.js"></script>
		<script src="{$url}application/js/router_admin.js"></script>
		<script src="{$url}application/js/require.js"></script>                  
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
				URL: "{$url}",
				CSRF: getCookie('csrf_cookie_name'),
			};
			var scripts = [
				"{$url}application/js/admin.ui.js",
				{if $extra_js},"{$url}application/{$extra_js}"{/if}
			];
			require(scripts, function(){
				$(document).ready(function(){
					UI.initialize();
					{if $extra_css}Router.loadedCSS.push("{$extra_css}");{/if}
					{if $extra_js}Router.loadedJS.push("{$extra_js}");{/if}
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
                    <div class="col-sm-12 col-xs-12 text-center">
                        <a href="index.php" class="navbar-brand"><img src="{$url}application/themes/admin/img/template/logo.png" alt="logo"></a>
                    </div>
                </div>
            </header>
            <aside id="page-sidebar" class="collapse navbar-collapse navbar-main-collapse">
                <div class="side-scrollable">
                    <div class="sidebar">
                        <nav id="primary-nav">
                            <ul>
                                <li><a href="{$url}admin/" {if $current_page == "admin/"}class="active"{/if} data-hasevent="1"><i class="gi gi-display"></i>Dashboard</a></li>
                                <li><a href="{$url}" target="_blank" data-hasevent="1"><i class="fa fa-reply"></i>Homepage</a></li>
                                <li><a href="{$url}logout" data-hasevent="1"><i class="fa fa-power-off"></i>Logout</a></li>
                                {foreach from=$menu item=group key=text}
                                    {if count($group.links)}
                                        <li class="active">
                                            <a href="#" class="menu-link" data-hasevent="1">{$text}</a>
                                        	<ul>    
												{foreach from=$group.links item=link}                   
                                                	<li><a href="{$url}{$link.module}/{$link.controller}" data-hasevent="1">{$link.text}</a></li> 
												{/foreach} 
											</ul>                                             
                                        </li> 
                                    {/if}
                                {/foreach}
                            </ul>
                        </nav>
                    </div>
                </div>
            </aside>
			{$page}
        </div>
    </body>
</html>