<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    protected $template_data = array();

    function __construct()
	{
        parent::__construct();
        $this->config();
		$this->BanIP();
		$this->landing();
    }

    // Initialize Configuration Variables
    private function config()
	{
		// Auto loaded config, now set a variable to it
		$site_config = $this->config->item('site');
		
		// Template variables
        $this->template_data['template'] = array(
            'name'          => $site_config['name'],
			'keywords'		=> $site_config['keywords'],
            'author'        => $site_config['author'],
            'title'         => $site_config['title'],
            'description'   => $site_config['description'],
            'version'       => $site_config['version'],
			'support_url'	=> $site_config['support_url'],
			'forums_url'	=> $site_config['forums_url'],
			'tos_url'		=> $site_config['tos_url'],
			'faq_url'		=> $site_config['faq_url'],
            'active_page'   => '',
			'welcome_time'	=> $this->welcome_day(),
        );
    }
	
	public function is_logged_in()
	{
		// check if the user is logged in on the "myaccount" pages
		// Dont leave anything behind
		if(!$this->session->userdata('user_id') || !$this->session->userdata('user_no'))
		{
			redirect('login');
		}	
	}
	
	public function welcome_day()
	{
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
	
	/*********************************************************************************/
	
	public function BanIP()
	{
		if(!$this->session->userdata('banned_ip'))
		{
			$userIP = $this->getUserIP();
			if($this->blocklist($userIP))
			{
				$user_data['banned_ip'] = true;
				$this->session->set_userdata($user_data);
			}
			else
			{
				$user_data['banned_ip'] = 'not_banned';
				$this->session->set_userdata($user_data);		
			}
		}
		
		if($this->session->userdata('banned_ip') == 'banned')
		{
			header("HTTP/1.1 403 Forbidden");
			die("Your IP has been banned here!"); // We're done here		
		}
	}	
	
	
	public function landing()
	{
		if(!$this->session->userdata('landing'))
		{
			$user_data['landing'] = 'visited';
			$this->session->set_userdata($user_data);				
			redirect('landing');
		}			
	}
	
	
	
	public function blocklist($ip)
	{
		$blocked = false;
		$ipList = file('application/blocklist.txt', FILE_SKIP_EMPTY_LINES);
	 
		foreach ($ipList as $entry)
		{
			if(strstr($ip, $entry))
			{
				$blocked = true;
				break;  // No need to loop further
			}
		}
		return $blocked;
	}	
	
	
	public function getUserIP()
	{
		$_p = getenv("HTTP_CLIENT_IP");
	 
		if(empty($_p))
		{
			$_p = getenv("HTTP_X_FORWARDED_FOR");
		 
			if(!empty($_p))
			{
				$_p = explode(',', $_p);
				$_p = sizeof($_p) - 1;
			}
			else
			{
				$_p = getenv("REMOTE_ADDR");
			}
		}
		return trim($_p);
	}	
	
	/**************************************************************************************/
	
	public function time_passed($timestamp)
	{
		$diff = time() - (int)$timestamp;
		if ($diff == 0){return 'just now';} 
		
		$intervals = array
		(
			1                   => array('year',    31556926),
			$diff < 31556926    => array('month',   2628000),
			$diff < 2629744     => array('week',    604800),
			$diff < 604800      => array('day',     86400),
			$diff < 86400       => array('hour',    3600),
			$diff < 3600        => array('minute',  60),
			$diff < 60          => array('second',  1)
		);
		
		$value = floor($diff/$intervals[1][1]);
		return $value.' '.$intervals[1][0].($value > 1 ? 's' : '');
	}		
	
	
	/*
	TIME ONLINE
	*************
	$nowtime = time();
	$oldtime = 1335939007;
	
	echo "time_elapsed_B: ".time_elapsed_B($nowtime-$oldtime)."\n";	
	*/	
	public function time_elapsed_B($secs)
	{
		$bit = array(
			' year'        => $secs / 31556926 % 12,
			' week'        => $secs / 604800 % 52,
			' day'        => $secs / 86400 % 7,
			' hour'        => $secs / 3600 % 24,
			' minute'    => $secs / 60 % 60,
			' second'    => $secs % 60
			);
		   
		foreach($bit as $k => $v){
			if($v > 1)$ret[] = $v . $k . 's';
			if($v == 1)$ret[] = $v . $k;
			}
		array_splice($ret, count($ret)-1, 0, 'and');
		$ret[] = '';
	   
		return join(' ', $ret);
	}	
	
	public function countPercent($num_amount, $num_total) 
	{
		if($num_amount == '0' && $num_total == '0')
		{
			return '0';
		}
		else
		{
			$count1 = $num_amount / $num_total;
			$count2 = $count1 * 100;
			$count = number_format($count2, 0);
			return $count;
		}
	}
	
	function createNewid($length, $characters)
	{
		if ($characters == '')
		{
			return '';
		}
		$chars_length = strlen($characters)-1;
		
		mt_srand((double)microtime()*1000000);
		
		$newid = '';
		while(strlen($newid) < $length)
		{
			$rand_char = mt_rand(0, $chars_length);
			$newid .= $characters[$rand_char];
		}
		return $newid;
	}	
	
}