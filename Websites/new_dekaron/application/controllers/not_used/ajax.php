<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Ajax extends MY_Controller
{
	function __construct()
	{
        parent::__construct();
		if (!$this->_is_curl_installed())
		{
			die("cURL is NOT <span style=\"color:red\">installed</span> on this server");
		}	
		$this->load->driver('cache');
	}	
	
	public function PlayersOnline()
	{
		$my_data = $this->cache->file->get('players_online');
		if($my_data === FALSE)
		{		
			$this->db_account = $this->load->database('account', TRUE); 
			$this->db_account->select('user_no,login_flag');
			$this->db_account->from('user_profile');
			$this->db_account->where('login_flag', '1100');
			$return = number_format($this->db_account->count_all_results());
			$this->cache->file->save('players_online', $return, $this->config->item('players_update_interval'));
			$this->output->append_output($return);
		}
		else
		{
			$this->output->append_output($my_data);
		}	
    }
	
	public function forums_all()
	{
		$my_data = $this->cache->file->get('forums_all');
		if($my_data === FALSE)
		{		
			$lurl = $this->file_get_contents_curl($this->config->item('forums_all'));
			$return = htmlspecialchars_decode($lurl);
			if($return == '')
			{
				$this->output->append_output('Please refresh the page.');
			}
			else
			{
				$this->cache->file->save('forums_all', $return, $this->config->item('forums_update_interval'));
				$this->output->append_output($return);
			}
		}
		else
		{
			$this->output->append_output($my_data);
		}			
	}

	public function forums_news()
	{
		$my_data = $this->cache->file->get('forums_news');
		if($my_data === FALSE)
		{		
			$lurl = $this->file_get_contents_curl($this->config->item('forums_news'));
			$return = htmlspecialchars_decode($lurl);
			if($return == '')
			{
				$this->output->append_output('Please refresh the page.');
			}
			else
			{
				$this->cache->file->save('forums_news', $return, $this->config->item('forums_update_interval'));
				$this->output->append_output($return);
			}
		}
		else
		{
			$this->output->append_output($my_data);
		}		
	}

	public function forums_event()
	{
		$my_data = $this->cache->file->get('forums_event');
		if($my_data === FALSE)
		{		
			$lurl = $this->file_get_contents_curl($this->config->item('forums_event'));
			$return = htmlspecialchars_decode($lurl);
			if($return == '')
			{
				$this->output->append_output('Please refresh the page.');
			}
			else
			{
				$this->cache->file->save('forums_event', $return, $this->config->item('forums_update_interval'));
				$this->output->append_output($return);
			}
		}
		else
		{
			$this->output->append_output($my_data);
		}		
	}
	
	
	public function forums_notice()
	{
		$my_data = $this->cache->file->get('forums_notice');
		if($my_data === FALSE)
		{		
			$lurl = $this->file_get_contents_curl($this->config->item('forums_notice'));
			$return = htmlspecialchars_decode($lurl);
			if($return == '')
			{
				$this->output->append_output('Please refresh the page.');
			}
			else
			{
				$this->cache->file->save('forums_notice', $return, $this->config->item('forums_update_interval'));
				$this->output->append_output($return);
			}
		}
		else
		{
			$this->output->append_output($my_data);
		}			
	}
	
	public function forums_update()
	{
		$my_data = $this->cache->file->get('forums_update');
		if($my_data === FALSE)
		{		
			$lurl = $this->file_get_contents_curl($this->config->item('forums_update'));
			$return = htmlspecialchars_decode($lurl);
			if($return == '')
			{
				$this->output->append_output('Please refresh the page.');
			}
			else
			{
				$this->cache->file->save('forums_update', $return, $this->config->item('forums_update_interval'));
				$this->output->append_output($return);
			}
		}
		else
		{
			$this->output->append_output($my_data);
		}		
	}
	
	public function CheckRefferal()
	{
		if($this->config->item('reffer_active'))
		{
		
			$this->db_website = $this->load->database('website', TRUE); 
		
			$query = $this->db_website->query("SELECT * FROM user_refferal WHERE ref_done = '0' "); 
			$del = '0';
			
			$i2 = '0';
			
			if ($query->num_rows() < 0)
			{
				//echo 'No queue<br>';
			}
			else
			{
				foreach ($query->result() as $row)
				{
					if(strlen($row->user_no) != '14')
					{
						//$this->db_website->query("DELETE FROM user_refferal WHERE id = '".$row->id."' ");
						$del++;
					}
					else
					{
						$this->db_character = $this->load->database('character', TRUE); 
						$query2 = $this->db_character->query("SELECT wLevel,user_no FROM user_character WHERE user_no = '".$row->ref_user_no."' "); 
						if ($query2->num_rows() < 0)
						{
							//echo 'No Chars<br>';
						}
						else
						{
							$i = '0';
							foreach ($query2->result() as $row2)
							{
								if($row2->wLevel > $this->config->item('reffer_min_level') || $row2->wLevel == $this->config->item('reffer_min_level'))
								{
									$this->db_website->query("UPDATE user_refferal SET ref_done = '1' WHERE id = '".$row->id."' ");
									$i++;
								}
								else
								{
									continue;
								}
							}
							
							if($i != '0')
							{
								$this->load->model('m_cash');
								$this->m_cash->AddCoinsIpn($this->config->item('reffer_coins'), $row->user_no);
								$this->m_cash->AddCoinsIpn($this->config->item('reffer_coins'), $row->ref_user_no);
								$this->db_website->query("UPDATE user_refferal SET ref_done = '1' WHERE id = '".$row->id."' ");
								$this->db_website->query("INSERT INTO user_action_log(user_no,datetime,action,user_name) VALUES ('".$row->user_no."', '".date('m/d/Y g:i:s A')."','Credits Added (Refferal System)', 'Refferal System') ");
								$this->db_website->query("INSERT INTO user_action_log(user_no,datetime,action,user_name) VALUES ('".$row->ref_user_no."', '".date('m/d/Y g:i:s A')."','Coins Added (Refferal System)', 'Refferal System') ");
								$i2++;
							}
						}
					}		
				}
			}
			//echo "OK " . $i2 . "<br>";
			//echo "NOK " . $del . "<br>";
		}
	}
	
	
	// DO NOT EDIT BELOW !!!!!!!!!!!!!!!!	

			
	
	public function _is_curl_installed()
	{
		if(in_array  ('curl', get_loaded_extensions()))
		{
			return true;
		}
		else
		{
			return false;
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