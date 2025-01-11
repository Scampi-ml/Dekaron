<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News_model extends MY_Model 
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function getArticles()
	{
		//$lurl = file_get_contents_curl("http://dekaronrising.com/ssi.php?a=out&f=2&show=5&type=rss");
		// http://dekaron9.com/index.php?/index
		//return htmlspecialchars_decode($lurl);
		return 'nonews';
	}
            
	public function _is_curl_installed()
	{
		if(in_array  ('curl', get_loaded_extensions()))
		{
			//die('CURL IS INSTALLED');
		}
		else
		{
			die('CURL IS NOT INSTALLED, FIX IT ASAP!');
		}
	}


	public function file_get_contents_curl($url, $retries=1)
	{
		$ua = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)';
		 
		if (extension_loaded('curl') === true)
		{
			$ch = curl_init();
			 
			curl_setopt($ch, CURLOPT_URL, $url); // The URL to fetch. This can also be set when initializing a session with curl_init().
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); // TRUE to return the transfer as a string of the return value of curl_exec() instead of outputting it out directly.
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5); // The number of seconds to wait while trying to connect.
			curl_setopt($ch, CURLOPT_USERAGENT, $ua); // The contents of the "User-Agent: " header to be used in a HTTP request.
			curl_setopt($ch, CURLOPT_FAILONERROR, TRUE); // To fail silently if the HTTP code returned is greater than or equal to 400.
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE); // To follow any "Location: " header that the server sends as part of the HTTP header.
			curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE); // To automatically set the Referer: field in requests where it follows a Location: redirect.
			curl_setopt($ch, CURLOPT_TIMEOUT, 5); // The maximum number of seconds to allow cURL functions to execute.
			curl_setopt($ch, CURLOPT_MAXREDIRS, 5); // The maximum number of redirects
			 
			$result = trim(curl_exec($ch));
			 
			curl_close($ch);
		}
		else
		{
			$result = trim(file_get_contents($url));
		}
		return $result;
	}	
	
	
}
