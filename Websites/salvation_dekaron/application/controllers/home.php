<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller
{
	function __construct()
	{
        parent::__construct();
    }	
	
	public function index()
	{
		
		$this->template_data['template']['forums_all'] = $this->forums_all();
		$this->template_data['template']['forums_news'] = $this->forums_news();
		$this->template_data['template']['forums_event'] = $this->forums_event();
		$this->template_data['template']['forums_notice'] = $this->forums_notice();
		$this->template_data['template']['forums_update'] = $this->forums_update();
		
		
		
		$this->template_data['template']['deadfront'] 	= $this->file_get_contents_curl(base_url().'forums/dfcounter_forum.php');
		$this->template_data['template']['party'] 		= $this->file_get_contents_curl(base_url().'forums/ptcounter_forum.php');
		$this->template_data['template']['battle'] 		= $this->file_get_contents_curl(base_url().'forums/bacounter_forum.php');		
		
		
		$this->template_data['template']['body_id'] = 'portal';
		$this->template_data['template']['active_page'] = $this->uri->segment(1);
		$this->load->view('view_home', $this->template_data);
	}
	
	public function forums_all()
	{
		$lurl = $this->file_get_contents_curl($this->config->item('forums_all'));
		$return = htmlspecialchars_decode($lurl);
		return $return;
	}

	public function forums_news()
	{
		$lurl = $this->file_get_contents_curl($this->config->item('forums_news'));
		$return = htmlspecialchars_decode($lurl);
		return $return;
	}

	public function forums_event()
	{
		$lurl = $this->file_get_contents_curl($this->config->item('forums_event'));
		$return = htmlspecialchars_decode($lurl);
		return $return;
	}
	
	public function forums_notice()
	{
		$lurl = $this->file_get_contents_curl($this->config->item('forums_notice'));
		$return = htmlspecialchars_decode($lurl);
		return $return;
	}
	
	public function forums_update()
	{
		$lurl = $this->file_get_contents_curl($this->config->item('forums_update'));
		$return = htmlspecialchars_decode($lurl);
		return $return;
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