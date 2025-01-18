<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MyAccount extends MY_Controller
{

	public function index()
	{
		// load character
		$this->load->model('m_character');
		$this->template_data['template']['CountCharacters'] = number_format($this->m_character->CountCharacters());
		
		// load coins
		$this->load->model('m_cash');
		$this->template_data['template']['GetCoins'] = $this->m_cash->GetCoinsSession();	
		
		
		// load account	
		$this->load->model('m_account');
		
		// user_profile info
		$GetAccountProfile = $this->m_account->GetAccountProfile();
		$this->template_data['template']['login_time'] = $GetAccountProfile[0]['login_time'];
		$this->template_data['template']['logout_time'] = $GetAccountProfile[0]['logout_time'];
		$this->template_data['template']['user_ip_addr'] = $this->m_account->decodeIp($GetAccountProfile[0]['user_ip_addr']);
		$this->template_data['template']['reg_on'] = $this->m_account->userno2date($GetAccountProfile[0]['user_no']);
		
		if($this->m_account->online('string', $GetAccountProfile[0]['login_flag']))
		{
			$this->template_data['template']['login_flag'] = '<font style="color:green">Online</font>';
		}
		else
		{
			$this->template_data['template']['login_flag'] = '<font style="color:red">Offline</font>';
		}
		
		// user_data info
		$GetAccountData = $this->m_account->GetAccountData();
		$this->template_data['template']['email'] = $GetAccountData[0]['email'];
		$this->template_data['template']['lifetime'] = $this->lifetime($GetAccountData[0]['reg_date']);
		
		// check if the account is validated or not
		if($GetAccountData[0]['validated'] == '0')
		{
			$this->template_data['template']['validated'] = '&nbsp;&nbsp;<small>(<font style="color:red"> Validating </font>)</small>';
			$this->template_data['template']['validated_notice'] = '<div class="notice-container"><div class="error clearfix" id="notice"><div class="notice-inner"><p>You haven\'t validated your account yet. please validate your account by clicking <a href="">here</a>.</p></div></div></div>'; 
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
	
	public function settXXXXings()
	{
		$this->template_data['template']['body_id'] = 'account';
		$this->template_data['template']['active_page'] = $this->uri->segment(1);
		$this->load->view('myaccount/view_settings', $this->template_data);
	}	
	
	public function mailbox()
	{
		// load models
		$this->load->model('m_character');
		$this->template_data['template']['ListCharacters'] = $this->m_character->ListCharactersMailbox();		
		$this->template_data['template']['viewall'] = '0';
		
		if($this->uri->segment(3) != '')
		{
			$this->load->model('m_mailbox');
			$this->template_data['template']['viewall'] = $this->m_mailbox->ViewAll($this->uri->segment(3));
		}
		
		$this->template_data['template']['body_id'] = 'account';
		$this->template_data['template']['active_page'] = $this->uri->segment(1);
		$this->load->view('myaccount/view_mailbox', $this->template_data);
	}	
	
	public function password()
	{
		$this->template_data['template']['body_id'] = 'account';
		$this->template_data['template']['active_page'] = $this->uri->segment(1);
		$this->load->view('myaccount/view_password', $this->template_data);	
	}	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */