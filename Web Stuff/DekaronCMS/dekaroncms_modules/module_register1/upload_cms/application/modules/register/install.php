<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if(CI::$APP->config->item('connection_type') === 'local')
{
	if(CI::$APP->config->item('mssql_host') == '' || CI::$APP->config->item('mssql_username') == '' || CI::$APP->config->item('mssql_password') == '')
	{
		die('Install Error: MSSQL details are empty.') ;
	}	
}
elseif(CI::$APP->config->item('connection_type') === 'api')
{
	if(CI::$APP->config->item('api_server') == '')
	{
		die('Install Error: API details are empty.') ;
	}	
}
else
{
	die('Install Error: This modules requires API or LOCAL connection Type') ;
}
