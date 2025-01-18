<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Vote extends MY_Controller
{
	function __construct()
	{
        parent::__construct();
		// check if logged in, this is a restricted page
		$this->is_logged_in();
		
		// check if he can vote
		if($this->session->userdata('can_vote') == '0')
		{
			$this->template_data['template']['suspended'] = true;
		}
		else
		{
			$this->template_data['template']['suspended'] = false;
		}
		
		$this->db_website = $this->load->database('website', TRUE);	
		$this->load->model('m_vote');	
		
		$config['vote_ip_lock'] = true;
		$config['delete_old_votes'] = true;		
				
			
    }	
	
	public function index()
	{
		$vote1 = $this->config->item('vote_site_1');
		$vote2 = $this->config->item('vote_site_2');
		$vote3 = $this->config->item('vote_site_3');
		$vote4 = $this->config->item('vote_site_4');
		$vote5 = $this->config->item('vote_site_5');
		
		// check if the user is in the DB
		$user = $this->db_website->query("SELECT * FROM user_votes WHERE user_no = '".$this->session->userdata('user_no')."' ");		
		if($user->num_rows() == 0)
		{
			// user not found, but let him vote
			$this->m_vote->InsetIntoDbVote();
			$button_free = true;
		}
		else
		{
			// user was found, check his time
			$button_free = false;
			$user_vote = $user->row();
		}		
		
		
		// load the template
		//$template = $this->load->view('myaccount/view_vote_template', '', TRUE);
		$template = '';
		
		if($vote1[6] === true)
		{
			if($button_free)
			{
				$button = '<input type="radio" value="vote_site_1" name="vote">';
			}
			else
			{
				$check_time = $this->m_vote->TimeLeft($user_vote->site_1, $vote1[3]);
				if($check_time == 'vote_now')
				{
					$button = '<input name="vote" value="vote_site_1"  type="radio"><br>';
				}
				else
				{
					$button = $check_time;
				}				
			}
			
			$patterns = array('/<IMG>/','/<REWARD>/','/<VALUE>/','/<BUTTON>/');
			$replacements = array($vote1[6], $vote1[2], 'vote_site_1', $button);
			$output = preg_replace($patterns, $replacements, $template);			
			$this->template_data['template']['vote_site_1'] = $output;
		}

		if($vote2[5] === true)
		{
			if($button_free)
			{
				$button = '<input type="radio" value="vote_site_2" name="vote">';
			}
			else
			{
				$check_time = $this->m_vote->TimeLeft($user_vote->site_2, $vote2[3]);
				if($check_time == 'vote_now')
				{
					$button = '<input name="vote" value="vote_site_2"  type="radio"><br>';
				}
				else
				{
					$button = $check_time;	
				}				
			}			
			$patterns = array('/<IMG>/','/<REWARD>/','/<VALUE>/','/<BUTTON>/');
			$replacements = array($vote2[6], $vote2[2], 'vote_site_2', $button);
			$output = preg_replace($patterns, $replacements, $template);			
			$this->template_data['template']['vote_site_2'] = $output;
		}

		if($vote3[5] === true)
		{
			if($button_free)
			{
				$button = '<input type="radio" value="vote_site_3" name="vote">';
			}
			else
			{
				$check_time = $this->m_vote->TimeLeft($user_vote->site_3, $vote3[3]);
				if($check_time == 'vote_now')
				{
					$button = '<input name="vote" value="vote_site_3"  type="radio"><br>';
				}
				else
				{
					$button = $check_time;	
				}				
			}			
			$patterns = array('/<IMG>/','/<REWARD>/','/<VALUE>/','/<BUTTON>/');
			$replacements = array($vote3[6], $vote3[2], 'vote_site_3', $button);
			$output = preg_replace($patterns, $replacements, $template);			
			$this->template_data['template']['vote_site_3'] = $output;
		}

		if($vote4[5] === true)
		{
			if($button_free)
			{
				$button = '<input type="radio" value="vote_site_4" name="vote">';
			}
			else
			{
				$check_time = $this->m_vote->TimeLeft($user_vote->site_4, $vote4[3]);
				if($check_time == 'vote_now')
				{
					$button = '<input name="vote" value="vote_site_4"  type="radio"><br>';
				}
				else
				{
					$button = $check_time;	
				}				
			}			
			$patterns = array('/<IMG>/','/<REWARD>/','/<VALUE>/','/<BUTTON>/');
			$replacements = array($vote4[6], $vote4[2], 'vote_site_4', $button);
			$output = preg_replace($patterns, $replacements, $template);			
			$this->template_data['template']['vote_site_4'] = $output;
		}

		if($vote5[5] === true)
		{
			if($button_free)
			{
				$button = '<input type="radio" value="vote_site_5" name="vote">';
			}
			else
			{
				$check_time = $this->m_vote->TimeLeft($user_vote->site_5, $vote5[3]);
				if($check_time == 'vote_now')
				{
					$button = '<input name="vote" value="vote_site_5"  type="radio"><br>';
				}
				else
				{
					$button = $check_time;	
				}				
			}
			$patterns = array('/<IMG>/','/<REWARD>/','/<VALUE>/','/<BUTTON>/');
			$replacements = array($vote5[6], $vote5[2], 'vote_site_5', $button);
			$output = preg_replace($patterns, $replacements, $template);			
			$this->template_data['template']['vote_site_5'] = $output;
		}		
			
		$this->template_data['template']['body_id'] = 'account';
        $this->template_data['template']['active_page'] = 'vote';
        $this->load->view('myaccount/view_vote', $this->template_data);
    }
	
	
	public function PostVote()
	{
		$valid_arrays = array('vote_site_1','vote_site_2','vote_site_3','vote_site_4','vote_site_5');
		
		$this->form_validation->set_rules('vote', 		'vote', 		'trim|required|exact_length[11]|alpha_dash|xss_clean');
		

		if ($this->form_validation->run() == FALSE)
		{
			echo "<script type='text/javascript'>alert('Where is the post data???');</script>";
			redirect('myaccount/vote', 'refresh'); 	
		}
		elseif(!in_array($this->input->post('vote'), $valid_arrays))
		{
			echo "<script type='text/javascript'>alert('This is not a valid site!');</script>";
			redirect('myaccount/vote', 'refresh');  
		}
		else
		{
			$vote_config = $this->config->item($this->input->post('vote'));
			
			// Trim the first 5 chars
			$trimmed = substr($this->input->post('vote'), 5);
			
			$process = $this->m_vote->processVote($vote_config[2], $trimmed, $vote_config[5], $vote_config[1]);
			if($process)
			{
				$this->load->model('m_website');
				$this->m_website->AddLog('Voted for '. $vote_config[0], $this->session->userdata('user_id'));						
				
				$this->template_data['template']['message'] = '<div class="notice-container"><div class="success clearfix" id="notice"><div class="notice-inner"><p>'.$process.'</p></div></div></div>';
				echo "<script type='text/javascript'>alert('".$this->config->item('vote_message')."');</script>";
				redirect($vote_config[1], 'refresh');
			}
		}
	}
}
?>
