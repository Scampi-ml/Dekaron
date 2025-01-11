<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Password extends MY_Controller
{
	function __construct()
	{
        parent::__construct();
		// check if logged in, this is a restricted page
		$this->is_logged_in();
		$this->load->model('m_email');
		$this->load->model('m_account');
    }
	
	public function index()
	{
		$this->template_data['template']['body_id'] = 'account';
		$this->template_data['template']['active_page'] = $this->uri->segment(1);
		$this->load->view('myaccount/view_password', $this->template_data);	
	}
	
	public function ChangePasswordCheck()
	{
	    $this->form_validation->set_error_delimiters('<small class="error"> ', '</small>');
		
		$this->form_validation->set_rules('SecretNum', 			'Secret Number', 			'trim|required|alpha_numeric|exact_length[12]|callback_sn_check|xss_clean');
		$this->form_validation->set_rules('newPassword', 		'New Password', 			'trim|required|min_length[4]|max_length[16]|md5|xss_clean');
		$this->form_validation->set_rules('rePassword', 		'Re-enter Password', 		'required|matches[newPassword]');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->template_data['template']['body_id'] = 'account';
			$this->template_data['template']['active_page'] = $this->uri->segment(1);
			$this->load->view('myaccount/view_password', $this->template_data);	
		}
		else
		{
			$this->m_account->ChangePassword($this->input->post('newPassword'));
			
			$this->load->model('m_website');
			$this->m_website->AddLog('Changed password', $this->session->userdata('user_id'));						
			
			$data = array(
				'user' => $this->session->userdata('user_id'),
				'to' => $this->session->userdata('email'),
				'ip' => $this->session->userdata('ip_address'),
			);					
			
			// send email
			$email_send = $this->m_email->password_changed($data);				
			// TODO: check false
			
			$this->template_data['template']['message'] = '<div class="notice-container"><div class="success clearfix" id="notice"><div class="notice-inner"><p>Your password was successfully changed. Please login with your new password.</p></div></div></div>'; 
			
			$this->template_data['template']['body_id'] = 'account';
			$this->template_data['template']['active_page'] = $this->uri->segment(1);
			$this->load->view('myaccount/view_password', $this->template_data);		
		}
	}
	
	
	public function sn_check($str)
	{
		$check = $this->m_account->CheckSn($str);
		if (!$check)
		{
			$this->form_validation->set_message('sn_check', 'In-correct Secret Number');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}	
	
}