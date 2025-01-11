<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * CodeIgniter REST Class
 *
 * Make REST requests to RESTful services with simple syntax.
 *
 * @package        	CodeIgniter
 * @subpackage    	Libraries
 * @category    	Libraries
 * @author        	Philip Sturgeon
 * @author 			Chris Kacerguis
 * @created			04/06/2009
 * @license         http://philsturgeon.co.uk/code/dbad-license
 * @link			http://getsparks.org/packages/restclient/show
 */

class REST
{
    protected $_ci;

    protected $supported_formats = array(
		'xml' 				=> 'application/xml',
		'json' 				=> 'application/json',
		'serialize' 		=> 'application/vnd.php.serialized',
		'php' 				=> 'text/plain',
    	'csv'				=> 'text/csv'
	);

    protected $auto_detect_formats = array(
		'application/xml' 	=> 'xml',
		'text/xml' 			=> 'xml',
		'application/json' 	=> 'json',
		'text/json' 		=> 'json',
		'text/csv' 			=> 'csv',
		'application/csv' 	=> 'csv',
    	'application/vnd.php.serialized' => 'serialize'
	);

	protected $rest_server;
	protected $format;
	protected $mime_type;

	protected $http_auth = null;
	protected $http_user = null;
	protected $http_pass = null;
	
	protected $api_name	 = 'X-API-KEY';
	protected $api_key	 = null;

	protected $ssl_verify_peer 	= null;
    protected $ssl_cainfo 		= null;

    protected $response_string;

    function __construct($config = array())
    {
        $this->_ci =& get_instance();
        log_message('debug', 'REST Class Initialized');
		$this->_ci->load->library('curl');

		// Load the cURL spark which this is dependant on
		//$this->_ci->load->spark('curl/1.2.1');

		// If a URL was passed to the library
		empty($config) OR $this->initialize($config);
    }

	function __destruct()
	{
		$this->_ci->curl->set_defaults();
	}


    public function initialize($config)
    {
		$this->rest_server = @$config['server'];

		if (substr($this->rest_server, -1, 1) != '/')
		{
			$this->rest_server .= '/';
		}
		isset($config['send_cookies']) && $this->send_cookies = $config['send_cookies'];
		isset($config['api_name']) && $this->api_name = $config['api_name'];
		isset($config['api_key']) && $this->api_key = $config['api_key'];
		isset($config['http_auth']) && $this->http_auth = $config['http_auth'];
		isset($config['http_user']) && $this->http_user = $config['http_user'];
		isset($config['http_pass']) && $this->http_pass = $config['http_pass'];
		isset($config['ssl_verify_peer']) && $this->ssl_verify_peer = $config['ssl_verify_peer'];
		isset($config['ssl_cainfo']) && $this->ssl_cainfo = $config['ssl_cainfo'];
    }

	/**
	 * get
	 */
    public function get($uri, $params = array(), $format = NULL)
    {
        if ($params)
        {
        	$uri .= '?'.(is_array($params) ? http_build_query($params) : $params);
        }

    	return $this->_call('get', $uri, NULL, $format);
    }

	/**
	 * post
	 */
    public function post($uri, $params = array(), $format = NULL)
    {
        return $this->_call('post', $uri, $params, $format);
    }

	/**
	 * put
	 */
    public function put($uri, $params = array(), $format = NULL)
    {
        return $this->_call('put', $uri, $params, $format);
    }

	/**
	 * patch
	 *
	 * @access	public
	 * @author	Dmitry Serzhenko
	 * @version 1.0
	 */
	public function patch($uri, $params = array(), $format = NULL)
	{
		return $this->_call('patch', $uri, $params, $format);
	}

	/**
	 * delete
	 */
    public function delete($uri, $params = array(), $format = NULL)
    {
        return $this->_call('delete', $uri, $params, $format);
    }

	/**
	 * api_key
	 */
    public function api_key($key, $name = FALSE)
	{
		$this->api_key 	= $key;
		
		if ($name !== FALSE)
		{
			$this->api_name = $name;
		}	
	}

	/**
	 * language
	 */
    public function language($lang)
	{
		if (is_array($lang))
		{
			$lang = implode(', ', $lang);
		}
		$this->_ci->curl->http_header('Accept-Language', $lang);
	}

	/**
	 * header
	 *
	 * @access	public
	 * @author	David Genelid
	 * @version 1.0
	 */	
	public function header($header)
	{
		$this->_ci->curl->http_header($header);
	}	

	/**
	 * _call
	 *
	 * @access	protected
	 * @author	Phil Sturgeon
	 * @version 1.0
	 */
    protected function _call($method, $uri, $params = array(), $format = NULL)
    {
    	if ($format !== NULL)
		{
			$this->format($format);
		}

		$this->http_header('Accept', $this->mime_type);

        // Initialize cURL session
        $this->_ci->curl->create($this->rest_server.$uri);


		// If using ssl set the ssl verification value and cainfo
		// contributed by: https://github.com/paulyasi
		if ($this->ssl_verify_peer === FALSE)
		{
			$this->_ci->curl->ssl(FALSE);
		}
		elseif ($this->ssl_verify_peer === TRUE)
		{
			$this->ssl_cainfo = getcwd() . $this->ssl_cainfo;
			$this->_ci->curl->ssl(TRUE, 2, $this->ssl_cainfo);
		}

        // If authentication is enabled use it
        if ($this->http_auth != '' && $this->http_user != '')
        {
        	$this->_ci->curl->http_login($this->http_user, $this->http_pass, $this->http_auth);
        }
		
		// If we have an API Key, then use it
		if ($this->api_key != '')
		{
			$this->_ci->curl->http_header($this->api_name, $this->api_key);
		}

		// Send cookies with curl
		/*
		if ($this->send_cookies != '')
		{
				
			$this->_ci->curl->set_cookies( $_COOKIE );		
		
		}
		*/
		
		// Set the Content-Type (contributed by https://github.com/eriklharper)
		$this->http_header('Content-type', $this->mime_type);
		

        // We still want the response even if there is an error code over 400
        $this->_ci->curl->option('failonerror', FALSE);

        // Call the correct method with parameters
        $this->_ci->curl->{$method}($params);

        // Execute and return the response from the REST server
        $response = $this->_ci->curl->execute();

        // Format and return
        return $this->_format_response($response);
    }

	/**
	 * initialize
	 *
	 * If a type is passed in that is not supported, use it as a mime type
	 */
    public function format($format)
	{
		if (array_key_exists($format, $this->supported_formats))
		{
			$this->format = $format;
			$this->mime_type = $this->supported_formats[$format];
		}

		else
		{
			$this->mime_type = $format;
		}

		return $this;
	}

	/**
	 * debug
	 */
	public function debug()
	{
		$request = $this->_ci->curl->debug_request();
		$write = "";
		$write .= "=============================================\n";
		$write .= "API Test\n";
		$write .= "=============================================\n";
		$write .= "Request\n";
		$write .= $request['url']."\n";
		$write .= "=============================================\n";
		$write .= "Response\n";

		if ($this->response_string)
		{
			$write .= nl2br($this->response_string)."\n\n";
		}
		else
		{
			$write .= "No response\n\n";
		}

		$write .= "=============================================\n";

		if ($this->_ci->curl->error_string)
		{
			$write .= "Errors";
			$write .= "Code: ".$this->_ci->curl->error_code."\n";
			$write .= "Message: ".$this->_ci->curl->error_string."\n";
			$write .= "=============================================\n";
		}

		$write .= "Call details";
		$write .= print_r($this->_ci->curl->info, true);
		file_put_contents('application/logs/api_debug_' . time() . '.php', $write);
	}


	/**
	 * status
	 */
	// Return HTTP status code
	public function status()
	{
		return $this->info('http_code');
	}

	/**
	 * info
	 *
	 * Return curl info by specified key, or whole array
	 */
	public function info($key = null)
	{
		return $key === null ? $this->_ci->curl->info : @$this->_ci->curl->info[$key];
	}

	/**
	 * option
	 *
	 * Set custom CURL options
	 */
	// 
	public function option($code, $value)
	{
		$this->_ci->curl->option($code, $value);
	}

	/**
	 * http_header
	 */
	public function http_header($header, $content = NULL)
	{
		// Did they use a single argument or two?
		$params = $content ? array($header, $content) : array($header);

		// Pass these attributes on to the curl library
		call_user_func_array(array($this->_ci->curl, 'http_header'), $params);
	}

	/**
	 * _format_response
	 */
	protected function _format_response($response)
	{
		$this->response_string =& $response;

		// It is a supported format, so just run its formatting method
		if (array_key_exists($this->format, $this->supported_formats))
		{
			return $this->{"_".$this->format}($response);
		}

		// Find out what format the data was returned in
		$returned_mime = @$this->_ci->curl->info['content_type'];

		// If they sent through more than just mime, strip it off
		if (strpos($returned_mime, ';'))
		{
			list($returned_mime) = explode(';', $returned_mime);
		}

		$returned_mime = trim($returned_mime);

		if (array_key_exists($returned_mime, $this->auto_detect_formats))
		{
			return $this->{'_'.$this->auto_detect_formats[$returned_mime]}($response);
		}

		return $response;
	}

	/**
	 * _xml
	 *
	 * Format XML for output
	 */
    protected function _xml($string)
    {
    	return $string ? (array) simplexml_load_string($string, 'SimpleXMLElement', LIBXML_NOCDATA) : array();
    }

	/**
	 * _csv
	 *
	 * Format HTML for output.  This function is DODGY! Not perfect CSV support but works 
	 * with my REST_Controller (https://github.com/philsturgeon/codeigniter-restserver)
	 */
    protected function _csv($string)
    {
		$data = array();

		// Splits
		$rows = explode("\n", trim($string));
		$headings = explode(',', array_shift($rows));
		foreach( $rows as $row )
		{
			// The substr removes " from start and end
			$data_fields = explode('","', trim(substr($row, 1, -1)));

			if (count($data_fields) === count($headings))
			{
				$data[] = array_combine($headings, $data_fields);
			}

		}

		return $data;
    }

	/**
	 * _json
	 *
	 * Encode as JSON
	 */
    protected function _json($string)
    {
    	return json_decode(trim($string));
    }

	/**
	 * _serialize
	 *
	 * Encode as Serialized array
	 * 
	 * @access	public
	 * @author	Phil Sturgeon
	 * @version 1.0
	 */
    protected function _serialize($string)
    {
    	return unserialize(trim($string));
    }

	/**
	 * _php
	 *
	 * Encode raw PHP
	 */
    protected function _php($string)
    {
    	$string = trim($string);
    	$populated = array();
    	eval("\$populated = \"$string\";");
    	return $populated;
    }

}

/* End of file REST.php */
/* Location: ./application/libraries/REST.php */