<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Forgot extends MY_Controller
{
	function __construct()
	{
        parent::__construct();
		// check if logged in, this is a restricted page
		$this->load->model('m_account');
		$this->load->model('m_email');
		$this->db_account = $this->load->database('account', TRUE); 
    }
	
	
	public function index()
	{
		$this->template_data['template']['body_id'] = 'lostpassword';
        $this->load->view('view_forgot', $this->template_data);
    }
	
	public function CheckForgot()
	{
        $this->form_validation->set_error_delimiters('<small class="error"> ', '</small>');
		$this->form_validation->set_rules('emailAddress', 			'Email', 					'trim|required|valid_email|strtolower|callback_email_check|xss_clean');


		if ($this->form_validation->run() == FALSE)
		{
			 $this->template_data['template']['body_id'] = 'lostpassword';
			 $this->load->view('view_forgot', $this->template_data);
		}
		else
		{
			$query = $this->db_account->query("SELECT email,user_no,user_id FROM user_data WHERE email = '".$this->input->post('emailAddress')."' ");
			if($query->num_rows() == 0)
			{
				$this->template_data['template']['result'] = '<p class="error">The selected email was not found!</p>';
				$this->template_data['template']['body_id'] = 'lostpassword';
				$this->load->view('view_forgot', $this->template_data);	
			}
			else
			{
				// get data
				$row = $query->row();
				
				// create token
				$token = strtoupper($this->createNewid(12, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ01234567890'));
				
				// update database with token
				$update = $this->db_account->query("UPDATE USER_DATA SET pass_key = '".$token."' WHERE user_no = '".$row->user_no."' ");
				if (!$update)
				{
					$this->template_data['template']['result'] = '<small class="error">Could not update your account. Please contact the system administrator.</small>';
					$this->template_data['template']['body_id'] = 'lostpassword';
					$this->load->view('view_forgot', $this->template_data);						
				}	
				else
				{
					$data = array(
						'user' => $row->user_id,
						'to' => $row->email,
						'password_change_url' => site_url('forgot/NewPassword/'.$token)
					);					
					
					// send email
					$email_send = $this->m_email->password_forget($data);
					if(!$email_send)
					{
						// BEGIN DEBUG
						// echo $this->email->print_debugger();
						// END DEBUG
						
						$this->template_data['template']['result'] = '<small class="error">Could not the send mail to your account. <br>Please contact the system administrator.</small>';
						$this->template_data['template']['body_id'] = 'register-panel';
						$this->load->view('view_forgot', $this->template_data);						
					}
					else
					{
						// BEGIN DEBUG
						// echo $this->email->print_debugger();
						// END DEBUG						
						
						$this->template_data['template']['result'] = '<small class="success">An email has been send to your account with further instructions.</small>';
						$this->template_data['template']['body_id'] = 'register-panel';
						$this->load->view('view_forgot', $this->template_data);						
					}
				}
			}	
		}			
	}	
		
	public function NewPassword()
	{
		$pass_key = $this->uri->segment(3);
		
		if(!$pass_key)
		{
			$this->template_data['template']['result'] = '<div class="notice-container"><div class="error clearfix" id="notice"><div class="notice-inner"><p>Missing Token Key</p></div></div></div>';
		}
		elseif(strlen($pass_key) != '12')
		{
			$this->template_data['template']['result'] = '<div class="notice-container"><div class="error clearfix" id="notice"><div class="notice-inner"><p>Invalid Token Key</p></div></div></div>';
		}
		
		// TODO: al_num check
		else
		{
			$check = $this->m_account->CheckToken($pass_key);
			if(!$check)
			{
				$this->template_data['template']['result'] = '<div class="notice-container"><div class="error clearfix" id="notice"><div class="notice-inner"><p>Token Key not found</p></div></div></div>';
			}
			else
			{
				$query = $this->db_account->query("SELECT user_no,user_id,email FROM user_data WHERE user_no = '".$check."' ");
				$row = $query->row();
				
				$new_password = strtolower($this->createNewid(12, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ01234567890'));
				$new_password_md5 = md5($new_password);
				$new_pw_update = $this->m_account->ChangePasswordForgot($new_password_md5, $row->user_no);
				if(!$new_pw_update)
				{
					$this->template_data['template']['result'] = '<div class="notice-container"><div class="error clearfix" id="notice"><div class="notice-inner"><p>Cannot update your password. Please try again.</p></div></div></div>';	
				}
				else
				{
					$data = array(
						'user' => $row->user_id,
						'to' => $row->email,
						'password' => $new_password
					);					
					
					// send email
					$email_send = $this->m_email->new_password($data);				
					$this->template_data['template']['result'] = '<div class="notice-container"><div class="success clearfix" id="notice"><div class="notice-inner"><p>A new password has been send to your email.</p></div></div></div>';
				}
			}
		}
		
		$this->template_data['template']['body_id'] = 'register-panel';
		$this->load->view('view_forgot_done', $this->template_data);			
	}			

	
	public function email_check($str)
	{
		$query = $this->db_account->query("SELECT email FROM USER_DATA WHERE email = '".$str."'");
		
		if($query->num_rows() == 0)
		{
			$this->form_validation->set_message('email_check', 'The selected email was not found!');
			return false;				
		}
		else
		{
			return true;
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
}