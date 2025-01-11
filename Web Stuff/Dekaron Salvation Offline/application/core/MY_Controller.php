<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    private $data;
	
	function __construct()
	{
        parent::__construct();
		$this->data = array();
		
		$site_config = $this->config->item('site');
		$this->smarty->assign("name",				$site_config['name']);
		$this->smarty->assign("keywords",			$site_config['keywords']);
		$this->smarty->assign("author",				$site_config['author']);
		$this->smarty->assign("description",		$site_config['description']);
		$this->smarty->assign("support_url",		$site_config['support_url']);
		$this->smarty->assign("forums_url",			$site_config['forums_url']);
		$this->smarty->assign("download_url",		$site_config['download_url']);
		$this->smarty->assign("show_social",		$this->ShowSocial());
		$this->smarty->assign("deadfront",			$this->file_get_contents_curl('http://salvationdekaron.com/dfcounter_forum.php'));
		$this->smarty->assign("party",				$this->file_get_contents_curl('http://salvationdekaron.com/ptcounter_forum.php'));
		$this->smarty->assign("battle",				$this->file_get_contents_curl('http://salvationdekaron.com/bacounter_forum.php'));	
    }

	
	public function file_get_contents_curl($url, $retries=1)
	{
		$ua = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)';

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url); // The URL to fetch. This can also be set when initializing a session with curl_init().
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); // TRUE to return the transfer as a string of the return value of curl_exec() instead of outputting it out directly.
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5); // The number of seconds to wait while trying to connect.
		curl_setopt($ch, CURLOPT_TIMEOUT, 5); // The maximum number of seconds to allow cURL functions to execute.
		$result = trim(curl_exec($ch));
		curl_close($ch);
		return $result;
	}		
		
	public function ShowSocial()
	{
		$echo = '';
		$social = $this->config->item('social');
		for($i = 0; $i < count($social); ++$i)
		{
			$echo .= '<a href="'.$social[$i][0].'" target="'.$social[$i][1].'" title="'.$social[$i][2].'"><img src="'.base_url('assets/images/social/'.$social[$i][3].'.png').'" ></a><br>';
		}
		return $echo;
	}	
		
	public function welcome_day() {
		$welcome = '';
		$time = date("H");
		$timezone = date("e");
		if ($time < "12"){
			$welcome = "Good morning";
		}elseif ($time >= "12" && $time < "17"){
			$welcome = "Good afternoon";
		}elseif ($time >= "17" && $time < "19"){
			$welcome = "Good evening";
		}elseif ($time >= "19"){
			$welcome = "Good night";
		}
		return $welcome;	
	}			
}