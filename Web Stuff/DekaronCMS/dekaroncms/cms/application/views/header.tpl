<!DOCTYPE html>
<html>
	<head>
		<title>{$title}</title>
		<link rel="stylesheet" href="{$style_path}main.css" type="text/css" />
		<link rel="stylesheet" href="{$path}css/nivo-slider.css" type="text/css" />		
		{if $extra_css}<link rel="stylesheet" href="{$path}{$extra_css}" type="text/css" />{/if}
		<link rel="shortcut icon" href="{$favicon}" />
		<!--
		DO NOT REMOVE THIS PART, REMOVING WILL VIOLATE EULA!
		* @Author: 			Janvier123
		* @Website:   		http://www.dekaroncms.com
		* @Copyright:		Janvier123 @ DekaronCMS
		-->
		<meta name="description" content="{$description}" />
		<meta name="keywords" content="{$keywords}" />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> 
    	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<script type="text/javascript" src="{$path}js/jquery.min.js"></script>
        <script type="text/javascript" src="{$path}js/router.js"></script>
		<script type="text/javascript" src="{$path}js/require.js"></script>   
		<script type="text/javascript">
			function getCookie(c_name){
				var i, x, y, cookies = document.cookie.split(";");
				for(i = 0; i < cookies.length;i++){
					x = cookies[i].substr(0,cookies[i].indexOf("="));
					y = cookies[i].substr(cookies[i].indexOf("=")+1);
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
				URL: "{$url}", image_path: "{$image_path}",CSRF: getCookie('csrf_cookie_name'),SliderEffect: "{$slider_style}",SliderPauseTime: {$slider_interval}
			};
			var scripts = [
				"{$path}js/ui.js","{$path}js/jquery.nivo.slider.js",{if $extra_js},"{$path}{$extra_js}"{/if}
			];
			if(typeof JSON == "undefined"){
				scripts.push("{$path}js/json.js");
			}
			require(scripts, function(){
				$(document).ready(function(){
					UI.initialize();
					{if $extra_css}Router.loadedCSS.push("{$extra_css}");{/if}
					{if $extra_js}Router.loadedJS.push("{$extra_js}");{/if}
				});
			});
		</script>           
	</head>