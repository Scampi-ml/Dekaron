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
        <script src="{$url}application/themes/admin/js/vendor/modernizr-2.7.1-respond-1.4.2.min.js"></script>
        <script src="{$url}application/themes/admin/js/vendor/bootstrap.min.js"></script>
        <script src="{$url}application/themes/admin/js/plugins.js"></script>
        <script src="{$url}application/themes/admin/js/main.js"></script>     
		<script src="{$url}application/themes/admin/js/router.js" type="text/javascript"></script>
		<script src="{$url}application/js/require.js" type="text/javascript" ></script>                  
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
				isACP: true,
				defaultLanguage: "{$defaultLanguage}"
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
                    <div class="col-sm-4 hidden-xs">
                        <ul class="navbar-nav-custom pull-left">
                            <li class="visible-md visible-lg"><a href="javascript:void(0)" id="toggle-side-content"><i class="fa fa-bars"></i></a></li>
                            <li class="divider-vertical"></li>
                        </ul>
                    </div>
                    <div class="col-sm-4 col-xs-12 text-center">
                        <a href="index.php" class="navbar-brand"><img src="{$url}application/themes/admin/img/template/logo.png" alt="logo"></a>
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
                                <li {if $current_page == "admin/"}class="active"{/if}><a href="{$url}admin/"><i class="gi gi-display"></i>Dashboard</a></li>
                                {foreach from=$menu item=group key=text}
                                    {if count($group.links)}
										
									
									
                                        <li class="active">
                                            <a href="#" class="menu-link" >{$text}</a>
                                        	<ul>                           
                                                <li>
                                                    {foreach from=$group.links item=link}
                                                        <a href="{$url}{$link.module}/{$link.controller}" {if isset($link.active)}class="active"{/if}>{$link.text}</a>
                                                    {/foreach}
                                                </li>  
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
        <a href="#" id="to-top"><i class="fa fa-chevron-up"></i></a>
    </body>
</html>