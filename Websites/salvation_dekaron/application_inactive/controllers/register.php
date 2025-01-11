<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Register extends MY_Controller
{
    function __construct()
	{
        parent::__construct();
		$this->db_account = $this->load->database('account', TRUE);
		$this->db_website = $this->load->database('website', TRUE);
    }	
	
	public function index()
	{
		if($this->config->item('reffer_active'))
		{
			if($this->session->userdata('ref_id'))
			{
				$this->template_data['template']['reffer'] = $this->session->userdata('ref_id');
			}
			else
			{
				$this->template_data['template']['reffer'] = '';
			}		
		}
		
		$this->template_data['template']['body_id'] = 'register-panel';
		$this->template_data['template']['active_page'] = $this->uri->segment(1);
		$this->load->view('view_register', $this->template_data);
	}
	
	
	public function CheckRegister()
	{
        $this->form_validation->set_error_delimiters('<span class="error"> ', '</span><br>');
		$this->form_validation->set_rules('Username', 				'Username', 				'trim|required|min_length[4]|max_length[16]|alpha_numeric|callback_account_check|xss_clean');
		$this->form_validation->set_rules('Password', 				'Password', 				'trim|required|min_length[4]|max_length[16]|md5|xss_clean');
		$this->form_validation->set_rules('rePassword', 			'Re-enter Password', 		'required|matches[Password]');
		$this->form_validation->set_rules('emailAddress', 			'Email', 					'trim|required|valid_email|strtolower|callback_email_check|xss_clean');
		$this->form_validation->set_rules('reEmailAddress', 		'Email', 					'required|matches[emailAddress]');
		$this->form_validation->set_rules('rules', 					'Terms of Use', 			'trim|required|xss_clean|callback_ip_check');

		if($this->config->item('reffer_active'))
		{
			$this->form_validation->set_rules('reffer', 			'Refferal ID', 				'trim|exact_length[14]|xss_clean');
		}
		
		if ($this->form_validation->run() == FALSE)
		{
			 $this->template_data['template']['body_id'] = 'register-panel';
			 $this->load->view('view_register', $this->template_data);
		}
		else
		{
			// set this once! or it will multiple values
			$user_no = $this->CreateUserNo();
			
			// INSERT INTO (account) USER_PROFILE
			$this->db_account->query("
			INSERT INTO USER_PROFILE (user_no,user_id,user_pwd,resident_no,user_type,login_flag,login_tag,server_id) 
			VALUES ('".$user_no."','".$this->input->post('Username')."','".$this->input->post('Password')."','801011000000','1','0','V','000')");
			
			// INSERT INTO (account) USER_DATA
			$this->db_account->query("
			INSERT INTO USER_DATA(user_no,user_id,sn,email,ip,reg_date,validated) 
			VALUES ('".$user_no."','".$this->input->post('Username')."','".$this->createNewid(12, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ01234567890')."','".$this->input->post('emailAddress')."','".$this->input->ip_address()."','".time()."','0')");
			
			if($this->config->item('reffer_active'))
			{
				if($this->input->post('reffer') != '')
				{
					$this->InsertRefferal($this->input->post('reffer'), $this->input->post('Username'), $user_no);
				}
			}
			
			
			// send an email to validate this account
			// create validation_token
			$validation_token = strtoupper(md5($this->createNewid(12, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ01234567890').time()));
			
			// load email model
			$this->load->model('m_email');
			
			// add data to prep email
			$data = array(
				'user' 			=> $this->input->post('Username'),
				'to' 			=> $this->input->post('emailAddress'),
				'validate_url' 	=> site_url('validate/email/'.$validation_token),
			);
			
			// send email
			$send_mail = $this->m_email->confirm_account($data);
			//$send_mail = true; // TESTING DO NOT UN-COMMENT!
			
			if(!$send_mail)
			{
				// delete this account, it seems not to be valid or could not be send
				$this->db_account->query("DELETE FROM USER_DATA WHERE user_no = '".$user_no."' ");
				$this->db_account->query("DELETE FROM USER_PROFILE WHERE user_no = '".$user_no."' ");
				
				$this->form_validation->set_message('emailAddress', 'Your email could not be send. Please contact the system administrator.');				
				
				$this->template_data['template']['body_id'] = 'register-panel';
				$this->load->view('view_register', $this->template_data);	
			}
			else
			{
				// store the validation key into the db
				$this->db_website->query("INSERT INTO user_validate (user_no,time,token,validated) VALUES ('".$user_no."','".time()."','".$validation_token."','0') ");
				
				// all done, and working, move on!
				$this->template_data['template']['body_id'] = 'register-panel';
				$this->load->view('view_register_done', $this->template_data);		
			}
		}		
	}
	
	public function createNewid($length, $characters)
	{
		if ($characters == ''){ return ''; }
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
	
	
	public function CreateUserNo()
	{
		$dk_time = strftime("%y%m%d%H%M%S");
		$regdate = strftime("%y%m%d");
		list($usec1, $sec1) = explode(" ",microtime());
		$dk_user_no = $dk_time.substr($usec1, 2, 2);	
		return $dk_user_no;
	}
	
	public function InsertRefferal($refid, $user_id, $user_no)
	{
		$query = $this->db_website->query("INSERT INTO user_refferal (user_no,ref_done,ref_name,datetime,ref_user_no) VALUES ('".$refid."','0','".$user_id."','".time()."','".$user_no."')");	
	}
	
	//********************************************************
	//			VALIDATION CALL BACKS (DO NOT CHANGE)
	//********************************************************	
	public function ip_check($str)
	{
		$max_ip = $this->config->item('register_max_ip');
		
		$query = $this->db_account->query("SELECT ip FROM user_data WHERE ip = '".$this->input->ip_address()."' ");
		if($query->num_rows() >= $max_ip)
		{
			$this->form_validation->set_message('ip_check', 'Your IP cannot be used more the '.$max_ip.' times!');
			return false;		
		}
		else
		{
			return true;
		}		
	}	
	
	
	public function account_check($str)
	{
		$query = $this->db_account->query("SELECT user_id FROM USER_PROFILE WHERE user_id = '".$str."' ");
		if($query->num_rows() == 0)
		{
			return true;
		}
		else
		{
			$this->form_validation->set_message('account_check', 'The selected username is not available!');
			return false;		
		}
	}
	
	public function email_check($str)
	{
		$query = $this->db_account->query("SELECT email FROM user_data WHERE email = '".$str."'");
		if($query->num_rows() == 0)
		{
			return true;
		}
		else
		{
			$this->form_validation->set_message('email_check', 'The selected email is not available!');
			return false;		
		}
	}
}
