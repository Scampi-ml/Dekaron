<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['base_url'] = '';
$config['index_page'] = '';
$config['uri_protocol'] = 'AUTO';
$config['url_suffix'] = '';
$config['charset'] = 'UTF-8';
$config['enable_hooks'] = FALSE;
$config['subclass_prefix'] = 'MY_';
$config['permitted_uri_chars'] = 'a-z 0-9~%.:_\-';
$config['allow_get_array'] = TRUE;
$config['enable_query_strings'] = FALSE;
$config['controller_trigger'] = 'c';
$config['function_trigger'] = 'm';
$config['directory_trigger'] = 'd'; // experimental not currently in use
$config['log_threshold'] = 1;
$config['log_path'] = '';
$config['log_date_format'] = 'Y-m-d H:i:s';
$config['cache_path'] = '';
$config['sess_cookie_name'] = 'cisession';
$config['sess_expiration'] = 18000;
$config['sess_expire_on_close'] = FALSE;
$config['sess_encrypt_cookie'] = TRUE;
$config['sess_use_database'] = FALSE;
$config['sess_table_name'] = 'ci_sessions';
$config['sess_match_ip'] = TRUE;
$config['sess_match_useragent'] = FALSE;
$config['sess_time_to_update'] = 18000;
$config['cookie_prefix'] = "";
$config['cookie_domain'] = "";
$config['cookie_path'] = "/";
$config['cookie_secure'] = FALSE;
$config['global_xss_filtering'] = FALSE;
$config['csrf_protection'] = TRUE;
$config['csrf_token_name'] = 'csrf_token_name';
$config['csrf_cookie_name'] = 'csrf_cookie_name';
$config['csrf_expire'] = 7200;
$config['csrf_ignore'] = array('donate');
$config['compress_output'] = TRUE;
$config['time_reference'] = 'local';
$config['rewrite_short_tags'] = FALSE;
$config['proxy_ips'] = '';
if(file_exists("application/config/encryption_key.php"))
{
	require_once("application/config/encryption_key.php");
}
else
{
	if(!is_writable("application/config/"))
	{
		die('The application/config/ folder is not writable.');
	}

	$file = fopen("application/config/encryption_key.php", "w");

	$encryptionKey = uniqid().uniqid().uniqid().uniqid();

	fwrite($file, '<?php $encryptionKey = "'.$encryptionKey.'";');
	fclose($file);
}

$config['encryption_key'] = $encryptionKey;
