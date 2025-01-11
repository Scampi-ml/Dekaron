<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Overview extends MY_Controller
{
    function __construct()
	{
        parent::__construct();
		// check if logged in, this is a restricted page
		$this->is_logged_in();
		$this->load->model('m_email');
		$this->load->model('m_account');
		$this->load->model('m_cash');
		$this->load->model('m_character');
		$this->db_account = $this->load->database('account', TRUE);
    }	
	
	public function index()
	{
		$GetAccountProfile = $this->m_account->GetAccountProfile();
		$GetAccountData = $this->m_account->GetAccountData();
		
		
		$this->template_data['template']['CountCharacters'] 		= number_format($this->m_character->CountCharacters());
		$this->template_data['template']['GetCoins'] 				= $this->m_cash->GetCoinsSession();	
		$this->template_data['template']['login_time'] 				= $GetAccountProfile['login_time'];
		$this->template_data['template']['logout_time'] 			= $GetAccountProfile['logout_time'];
		$this->template_data['template']['user_ip_addr'] 			= $this->m_account->decodeIp($GetAccountProfile['user_ip_addr']);
		$this->template_data['template']['email'] 					= $GetAccountData['email'];
		$this->template_data['template']['lifetime'] 				= $this->time_passed($GetAccountData['reg_date']);
		$this->template_data['template']['reg_on'] 					= date('d M Y - h:i a', $GetAccountData['reg_date']);		
		
		if($this->m_account->online('string', $GetAccountProfile['login_flag']))
		{
			$this->template_data['template']['login_flag'] = '<font style="color:green">Online</font>';
		}
		else
		{
			$this->template_data['template']['login_flag'] = '<font style="color:red">Offline</font>';
		}
		
		// check if the account is validated or not
		if($check = $this->m_account->CheckValidated())
		{
			$this->template_data['template']['validated'] = '&nbsp;&nbsp;<small>(<font style="color:red"> Validating </font>)</small>';
			$this->template_data['template']['validated_notice'] = '<div class="notice-container"><div class="error clearfix" id="notice"><div class="notice-inner"><p>You haven\'t validated your account yet. please validate your account by clicking <a href="'.site_url('myaccount/overview/SendValidate').'">here</a>.</p></div></div></div>'; 
		}
		else
		{
			$this->template_data['template']['validated'] = '&nbsp;&nbsp;<small>(<font style="color:green"> Validated </font>)</small>';	
		}
		
		// this page only
		$this->template_data['template']['body_id'] = 'account';
		$this->template_data['template']['active_page'] = $this->uri->segment(1);
		$this->load->view('myaccount/view_overview', $this->template_data);
	}
	
	public function SendValidate()
	{
		$check = $this->m_account->CheckValidated();
		if(!$check)
		{
			$this->template_data['template']['msg'] = 'You have already validated your account.';
			$this->template_data['template']['body_id'] = 'howtoconnect';
			$this->template_data['template']['active_page'] = $this->uri->segment(1);
			$this->load->view('myaccount/view_sn_done', $this->template_data);					
		}
		else
		{
			// add data to prep email
			$data = array(
				'user' 			=> $this->session->userdata('user_id'),
				'to' 			=> $this->session->userdata('email'),
				'validate_url' 	=> site_url('validate/email/'.$check),
			);
			
			// send email
			$send_mail = $this->m_email->confirm_account($data);
			if(!$send_mail)
			{
				$this->template_data['template']['msg'] = 'Something went wrong sending the email, try again later or contact support.!';
				$this->template_data['template']['body_id'] = 'howtoconnect';
				$this->template_data['template']['active_page'] = $this->uri->segment(1);
				$this->load->view('myaccount/view_sn_done', $this->template_data);					
			}
			else
			{
				$this->template_data['template']['msg'] = 'An validation email has been send to your account!';
				$this->template_data['template']['body_id'] = 'howtoconnect';
				$this->template_data['template']['active_page'] = $this->uri->segment(1);
				$this->load->view('myaccount/view_sn_done', $this->template_data);					
			}	
		}	
	}
	
	public function SendSNOnce()	
	{
		$check = $this->m_account->CheckWelcome();
		
		if($check == 'used')
		{
			$this->template_data['template']['msg'] = 'Sorry, you cannot use this anymore!';
			$this->template_data['template']['body_id'] = 'howtoconnect';
			$this->template_data['template']['active_page'] = $this->uri->segment(1);
			$this->load->view('myaccount/view_sn_done', $this->template_data);			
		}
		else
		{
			$GetAccountData = $this->m_account->GetAccountData();
		
			// add data to prep email
			$data = array(
				'user' 			=> $GetAccountData['user_id'],
				'sn' 			=> $GetAccountData['sn'],
				'regdate' 		=> $GetAccountData['reg_date'],
				'to'			=> $this->session->userdata('email'),
			);
			
			// send email
			$send_mail = $this->m_email->register_done($data);
			if(!$send_mail)
			{
				$this->template_data['template']['msg'] = 'Something went wrong sending the email, try again later or contact support.';
				$this->template_data['template']['body_id'] = 'howtoconnect';
				$this->template_data['template']['active_page'] = $this->uri->segment(1);
				$this->load->view('myaccount/view_sn_done', $this->template_data);						
			}
			else
			{
				$this->m_account->CheckWelcomeDone();
				$this->load->model('m_website');
				$this->m_website->AddLog('Send SN Email to '.$this->input->post('emailAddress'), $this->session->userdata('user_id'));					
					
				
				$this->template_data['template']['msg'] = 'Email send!';
				$this->template_data['template']['body_id'] = 'howtoconnect';
				$this->template_data['template']['active_page'] = $this->uri->segment(1);
				$this->load->view('myaccount/view_sn_done', $this->template_data);						
			}			
		}		
	}
	
}