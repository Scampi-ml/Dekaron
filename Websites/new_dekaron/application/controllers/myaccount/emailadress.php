<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Emailadress extends MY_Controller
{
	function __construct()
	{
        parent::__construct();
		// check if logged in, this is a restricted page
		$this->is_logged_in();
		$this->load->model('m_account');
		
    }
	
	public function index()
	{
		if($this->session->userdata('email') == '')
		{
			$GetAccountData = $this->m_account->GetAccountData();
			$this->template_data['template']['sn'] = $GetAccountData['sn'];
			$this->template_data['template']['missing_email'] = true;
		}
		else
		{
			$this->template_data['template']['missing_email'] = false;
		}
		
		
		$this->template_data['template']['body_id'] = 'account';
		$this->template_data['template']['active_page'] = $this->uri->segment(1);
		$this->load->view('myaccount/view_emailadress', $this->template_data);	
	}
	
	public function ChangeEmailCheck()
	{
	    $this->form_validation->set_error_delimiters('<small class="error"> ', '</small>');
		
		$this->form_validation->set_rules('SecretNum', 			'Secret Number', 			'trim|required|alpha_numeric|exact_length[12]|callback_sn_check|xss_clean');
		$this->form_validation->set_rules('emailAddress', 		'Enter E-Mail Address', 	'trim|required|valid_email|callback_email_check|xss_clean');
		$this->form_validation->set_rules('reEmailAddress', 	'Re-enter E-Mail Address', 	'required|matches[emailAddress]');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->template_data['template']['missing_email'] = false;
			$this->template_data['template']['body_id'] = 'account';
			$this->template_data['template']['active_page'] = $this->uri->segment(1);
			$this->load->view('myaccount/view_emailadress', $this->template_data);	
		}
		else
		{
			
			// TODO: return false
			$this->m_account->ChangeEmail($this->input->post('emailAddress'));
			
			$this->load->model('m_website');
			$this->m_website->AddLog('Changed Email to '.$this->input->post('emailAddress'), $this->session->userdata('user_id'));					
			
			// set it to session
			$user_data['email'] = $this->input->post('emailAddress');	
			$this->session->set_userdata($user_data);
			
			$this->template_data['template']['message'] = '<div class="notice-container"><div class="success clearfix" id="notice"><div class="notice-inner"><p>Your E-Mail Address was successfully changed.</p></div></div></div>'; 
			
			$this->template_data['template']['missing_email'] = false;
			$this->template_data['template']['body_id'] = 'account';
			$this->template_data['template']['active_page'] = $this->uri->segment(1);
			$this->load->view('myaccount/view_emailadress', $this->template_data);		
		}
	}
	
	public function email_check($str)
	{
		$check = $this->m_account->CheckEmail($str);
		if (!$check)
		{
			$this->form_validation->set_message('email_check', 'This E-Mail Address cannot exist more then once, please pick another E-Mail Address.');
			return FALSE;
		}
		else
		{
			return TRUE;
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