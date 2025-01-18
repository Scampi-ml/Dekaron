<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account_info extends MY_Controller
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
		
		
		$this->template_data['template']['login_time'] 				= ($GetAccountProfile['login_time'] == '' ? 'N/A' : $GetAccountProfile['login_time']);
		$this->template_data['template']['logout_time'] 			= ($GetAccountProfile['logout_time'] == '' ? 'N/A' : $GetAccountProfile['logout_time']);
		
		
		
		$this->template_data['template']['user_ip_addr'] 			= $this->m_account->decodeIp($GetAccountProfile['user_ip_addr']);
		$this->template_data['template']['email'] 					= $GetAccountData['email'];
		$this->template_data['template']['lifetime'] 				= $this->time_passed($GetAccountData['reg_date']);
		$this->template_data['template']['reg_on'] 					= date('d M Y - h:i a', $GetAccountData['reg_date']);	
		
		
		// Gravatar
		$this->load->library('gravatar');
		
		
		
		
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
			$this->template_data['template']['validated'] = '&nbsp;&nbsp;(<font style="color:red"> Not Validated </font>)';
			$this->template_data['template']['validated_notice'] = '<div class="notice-container"><div class="error clearfix" id="notice"><div class="notice-inner"><p>You haven\'t validated your account yet. please validate your account by clicking <a href="'.site_url('myaccount/overview/SendValidate').'">here</a>.</p></div></div></div>'; 
		}
		else
		{
			$this->template_data['template']['validated'] = '&nbsp;&nbsp;(<font style="color:green"> Validated </font>)';	
		}
		
		// this page only
		$this->template_data['template']['body_id'] = 'account';
		$this->template_data['template']['active_page'] = $this->uri->segment(1);
		$this->load->view('myaccount/view_account_info', $this->template_data);
	}
}