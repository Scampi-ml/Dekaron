<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|--------------------------------------------------------------------------
| Theme name
|--------------------------------------------------------------------------
| Must be located in application/views/NAME and must contain a valid theme manifest
*/
$config['theme'] = "dkuniversal";

/*
|--------------------------------------------------------------------------
| Website title
|--------------------------------------------------------------------------
*/
$config['title'] = "Dekaron Universal";

/*
|--------------------------------------------------------------------------
| Server name
|--------------------------------------------------------------------------
*/
$config['server_name'] = "Dekaron Universal";

/*
|--------------------------------------------------------------------------
| Use rewrite engine
|--------------------------------------------------------------------------
| Whether to hide index.php from the URL or not
| Requires Apache module "rewrite_module", to enable it remove the # in
| front of "LoadModule rewrite_module modules/mod_rewrite.so" in the Apache
| config file "httpd.conf"
*/
$config['rewrite'] = true;

/*
|--------------------------------------------------------------------------
| Custom header image
|--------------------------------------------------------------------------
*/
$config['header_url'] = false;

/*
|--------------------------------------------------------------------------
| Api Server
|--------------------------------------------------------------------------
| "api" or "local"
*/
$config['api_server'] = array(
	'server' 	=> "http://66.55.136.219:8282/api",
	'http_user' => "",
	'http_pass' => "",
	'http_auth' => "",
);
/*
|--------------------------------------------------------------------------
| Image slider module
|
| ['slider'] Enable or disable slider
| ['slider_home'] Hide slider from any page except of 'Home'
| ['slider_intveral'] How long the delay should be between the images (in milliseconds, default is 3000 (3 seconds))
| ['slider_style'] Animation style (leave blank for "random"):
|
|	2D:
|		bars
|		blinds
|		blocks
|		blocks2
|		concentric
|		dissolve requires mask support
|		slide
|		warp
|		zip
|	3D:
|		bars3d
|		blinds3d
|		cube
|		tiles3d
|		turn
|
|--------------------------------------------------------------------------
*/
$config['slider'] = true;
$config['slider_home'] = true;
$config['slider_interval'] = 5000;
$config['slider_style'] = 'slide';



/*
|--------------------------------------------------------------------------
| Search engine related
|--------------------------------------------------------------------------
| ['keywords'] Content keywords, separated by comma
| ['description'] Brief description of your site
*/
$config['keywords'] = false;
$config['description'] = false;

/*
|--------------------------------------------------------------------------
| Cache system
|--------------------------------------------------------------------------
| Wether or not the cache should be enabled. Disable only for development.
| Turning it on will improve performance drastically.
*/
$config['cache'] = true;