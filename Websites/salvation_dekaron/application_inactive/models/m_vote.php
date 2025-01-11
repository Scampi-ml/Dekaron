<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_vote extends MY_Model
{
	function __construct()
	{
        parent::__construct();
		// load database
		$this->db_website = $this->load->database('website', TRUE);	
		$this->db_cash = $this->load->database('cash', TRUE);
		$this->load->model('m_cash');
    }
	
	public function TimeLeft($futureTime, $delay)
	{
		$now = $futureTime + $delay;
		$difference = $now - time();
		if($now > time())
		{
		  $days = intval($difference / 86400);
		  $difference = $difference % 86400;
		  $hours = intval($difference / 3600);
		  $difference = $difference % 3600;
		  $minutes = intval($difference / 60);
		  $difference = $difference % 60;
		  $seconds = intval($difference);
		  return $hours."h ".$minutes."m ".$seconds."s"; 
		}
		else
		{
			return 'vote_now';
		}	
	}
	

	public function processVote($reward, $table, $log, $name = '')
	{
		$this->db_website->query("UPDATE user_votes SET ".$table." = '".time()."' WHERE user_no = '".$this->session->userdata('user_no')."' ");
		
		// update coins
		$this->m_cash->AddCoins($reward);
			
		// Save to session
		$this->m_cash->AddCoinsSession($reward);		
	
		// if log is set to TRUE, make a log
		if($log)
		{
			$this->writeLog('has voted on '.$name.' for our server.');
		}

		return 'Vote was successfull';
	}
	
	public function InsetIntoDbVote()
	{
		$time = time();
		$data = array(
		   'user_id'	=> $this->session->userdata('user_id'),
		   'user_no'	=> $this->session->userdata('user_no'),
		   'site_1'		=> 0,
		   'site_2'		=> 0,
		   'site_3'		=> 0,
		   'site_4'		=> 0,	
		   'site_5'		=> 0,
		);
		$this->db_website->insert('user_votes', $data); 		
	}
		
	public function writeLog($logenrty)
	{
		// write to database IF true
		$data = array(
		   'tijd' 		=> date("m/d/Y H:i:s"),
		   'charname' 	=> 'A member', 
		   'logentry' 	=> $logenrty 
		);
		$this->db_website->insert('user_public_log', $data); 			
	}
	
	
}	