<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Account extends REST_Controller{

    function __construct()
	{
        parent::__construct();
		$this->db = $this->load->database('account', TRUE);
    }
	
	function Login()	
	{
		$user_id = $this->get('user_id');	
		$user_pwd = $this->get('user_pwd');	
		
		$query = $this->db->query("SELECT user_mail,user_id,user_no,user_pwd,login_tag FROM user_profile WHERE user_id = '".$user_id."' AND user_pwd = '".$user_pwd."' ");		
		if($query->num_rows() > 0)
		{
			$data = array(
				'status' 	=> 'true',
				'data' 		=> $query->row_array()
			);
			$this->response($data, 200);
			
		} else {
			$data = array(
				'status' => 'false',
				'error' => 'NOT_FOUND',
			);
			$this->response($data, 200); 
		}
	} 		
	
	function ChangeEmail()
	{
		$user_id 		= $this->get('user_id');
		$user_pwd 		= $this->get('user_pwd');
		$user_mail_new	= $this->get('user_mail_new');
			
		if(!$this->CheckUser($user_id) ) {
			$data = array(
				'status' => 'false',
				'error' => 'Account is not found',
			);
			$this->response($data, 200);
		} elseif (!$this->CheckPasw($user_id, $user_pwd) ) {	
			$data = array(
				'status' => 'false',
				'error' => 'Your password is wrong',
			);
			$this->response($data, 200); 	
		} elseif (!$this->CheckEmail($user_mail_new) ) {	
			$data = array(
				'status' => 'false',
				'error' => 'The current email is already in use',
			);
			$this->response($data, 200); 								
		} else {
			$query = $this->db->query("UPDATE dbo.user_profile SET user_mail = '".$user_mail_new."' WHERE user_id = '".$user_id."'   ");
			if($query)
			{
				
				$this->load->model('m_email');
				
				// New email
				$email_data = array('to' => $row->user_mail);					
				@$this->m_email->email_changed($email_data);
				
				// Old email
				$email_data = array('to' => $this->GetEmail($user_id));
				@$this->m_email->email_changed($email_data);
				
				
				$data = array(
					'status' 	=> 'true',
					'result' 	=> 'true',
				);
				$this->response($data, 200, true);
				
			} else {
				$data = array(
					'status' => 'false',
					'error' => 'SQL_FAILED',
				);
				$this->response($data, 200); 
			}		
		}		
	}
	
	function ChangePassword()
	{
		$user_id 		= $this->get('user_id');
		$user_pwd 		= $this->get('user_pwd');
		$user_pwd_new 	= $this->get('user_pwd_new');

			
		if(!$this->CheckUser($user_id) ) {
			$data = array(
				'status' => 'false',
				'error' => 'Account is not found',
			);
			$this->response($data, 200);
		} elseif (!$this->CheckPasw($user_id, $user_pwd) ) {	
			$data = array(
				'status' => 'false',
				'error' => 'Your current password is wrong',
			);
			$this->response($data, 200); 					
		} else {
			$query = $this->db->query("UPDATE dbo.user_profile SET user_pwd = '".$user_pwd_new."' WHERE user_id = '".$user_id."'   ");
			if($query)
			{
				$data = array(
					'status' 	=> 'true',
					'result' 	=> 'true',
				);
				$this->response($data, 200, true);
				
			} else {
				$data = array(
					'status' => 'false',
					'error' => 'SQL_FAILED',
				);
				$this->response($data, 200); 
			}		
		}		
	}
	
	function ChangePasswordServ()
	{
		$user_id 		= $this->get('user_id');
		$user_pwd 		= $this->get('user_pwd');
		$user_pwd_new 	= $this->get('user_pwd_new');

			
		if(!$this->CheckUser($user_id) ) {
			$data = array(
				'status' => 'false',
				'error' => 'Account is not found',
			);
		} else {
			$query = $this->db->query("UPDATE dbo.user_profile SET user_pwd = '".$user_pwd_new."' WHERE user_id = '".$user_id."'   ");
			if($query)
			{
				$data = array(
					'status' 	=> 'true',
					'result' 	=> 'true',
				);
				$this->response($data, 200, true);
				
			} else {
				$data = array(
					'status' => 'false',
					'error' => 'SQL_FAILED',
				);
				$this->response($data, 200); 
			}		
		}			
	} 
	
	function ForgotByEmail()
	{
		$email = $this->get('email');	
		
		$query = $this->db->query("SELECT user_mail,user_id FROM dbo.user_profile WHERE user_mail = '".$email."' ");
		if($query->num_rows() > 0){	
		
			$row = $query->row();
			
			$this->load->model('m_email');
			$email_data = array('to' => $row->user_mail, 'user_id' => $row->user_id);					
			$email_send = $this->m_email->account_forget($email_data);	
			
			if($email_send == false) {
				$data = array(
					'status' 	=> 'false',
					'error' 	=> 'Failed to send the email'
				);
				$this->response($data, 200);			
			} else {
				$data = array(
					'status' 	=> 'true',
					'result' 	=> 'true'
				);
				$this->response($data, 200);			
			}		
		} else {
			$data = array(
				'status' => 'false',
				'error' => 'Email is not found',
			);
			$this->response($data, 200); 
		}
	}
	
	function ForgotByAccount()
	{
		$user_id = $this->get('user_id');	
		$key = $this->get('key');
		
		$query = $this->db->query("SELECT user_mail,user_id FROM dbo.USER_profile WHERE user_id = '".$user_id."' ");
		if($query->num_rows() > 0){	
			$row = $query->row();
			
			$this->load->model('m_email');
			$email_data = array('to' => $row->user_mail, 'user' => $row->user_id, 'password_change_url' => 'http://www.salvationdekaron.com/forgot/?key='.$key);	
			$email_send = $this->m_email->password_forget($email_data);	
			
			if($email_send == false) {
				$data = array(
					'status' 	=> 'false',
					'error' 	=> 'Failed to send the email'
				);
				$this->response($data, 200);			
			} else {
				$data = array(
					'status' 	=> 'true',
					'result' 	=> 'true',
					'md5key' 	=> $key
				);
				$this->response($data, 200);			
			}		
		} else {
			$data = array(
				'status' => 'false',
				'error' => 'Account is not found',
			);
			$this->response($data, 200); 
		}
	}
	
	function CheckEmail($user_mail)
	{
		$query = $this->db->query("SELECT user_mail FROM dbo.USER_profile WHERE user_mail = '".$user_mail."'");
		if($query->num_rows() > 1){	
			return false;
		} else {
			return true;
		}
	}
	
	function GetEmail($user_id)
	{
		$query = $this->db->query("SELECT user_mail,user_id FROM dbo.USER_profile WHERE user_id = '".$user_id."'");
		if($query->num_rows() > 0){	
			$row = $query->row();
			return $row->user_mail;
		} else {
			return false;
		}	
	}
			
	function CheckPasw($user_id, $user_pwd)
	{
		$query = $this->db->query("SELECT user_id,user_pwd FROM dbo.USER_profile WHERE user_id = '".$user_id."' AND user_pwd = '".$user_pwd."' ");
		if($query->num_rows() > 0){	
			return true;
		} else {
			return false;
		}
	}
	
	function CheckUser($user_id)
	{
		$query = $this->db->query("SELECT user_id FROM dbo.USER_profile WHERE user_id = '".$user_id."' ");
		if($query->num_rows() > 0){	
			return true;
		} else {
			return false;
		}
	}
	
	function createNewid($length = 0, $characters = 12)
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