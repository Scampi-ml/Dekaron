<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$autoload['packages'] = array();
$autoload['libraries'] = array('session', 'form_validation', 'database');
//$autoload['libraries'] = array('session', 'smarty', 'cache', 'form_validation', 'database');
$autoload['helper'] = array('url', 'form', 'cookie', 'css_js');
$autoload['config'] = array('config_site');
$autoload['language'] = array();
$autoload['model'] = array();