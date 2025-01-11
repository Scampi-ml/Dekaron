<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$autoload['packages'] = array();
$autoload['libraries'] = array('cache', 'database', 'session', 'smarty', 'template', 'acl', 'user');
$autoload['helper'] = array('url', 'form', 'text', 'breadcumb', 'permission');
$autoload['config'] = array('cms');
$autoload['language'] = array();
$autoload['model'] = array('cms_model', 'acl_model');