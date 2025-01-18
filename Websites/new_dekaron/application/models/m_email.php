<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_email extends MY_model 
{
    // Constructor
    function __construct()
	{
        parent::__construct();
        // Initialize the variables
		
		$config = Array(
			'protocol' 			=> $this->config->item('protocol'),
			'smtp_host' 		=> $this->config->item('smtp_host'),
			'smtp_port' 		=> $this->config->item('smtp_port'),
			'smtp_user' 		=> $this->config->item('smtp_user'),
			'smtp_pass' 		=> $this->config->item('smtp_pass'),
			'mailtype' 			=> $this->config->item('mailtype'),
			'charset' 			=> $this->config->item('charset'),
			'wordwrap' 			=> $this->config->item('wordwrap'),
			'smtp_timeout' 		=> $this->config->item('smtp_timeout'),
			'newline' 			=> $this->config->item('newline'),
			'crlf' 				=> $this->config->item('crlf'),
			'priority' 			=> $this->config->item('priority'),
			'useragent' 		=> $this->config->item('useragent'),
			'validate' 			=> $this->config->item('validate'),
			'bcc_batch_mode' 	=> $this->config->item('bcc_batch_mode'),
			'bcc_batch_size' 	=> $this->config->item('bcc_batch_size'),
		);
		
        $this->load->library('email', $config);		
		$this->email->from($this->config->item('smtp_user'), $this->config->item('email_name'));
    }
	
	public function account_warning($data = array())
	{
		// get the data we need
		$this->email->to($data['to']);
		
		// make the subject
		$this->email->subject('You have received an warning by a staff member or service.');
		
		// load the template
		$email = $this->load->view('email/inc_email_header', '', TRUE);
		$email .= $this->load->view('email/account_warning', '', TRUE);
		$email .= $this->load->view('email/inc_email_footer', '', TRUE);
		
		// replace some stuff
		$patterns = array('/<USER>/','/<REASON>/', '/<SERVER_NAME>/');
		$replacements = array($data['user'], $data['reason'], $this->config->item('email_name'));
		
		// put it all back together
		$email = preg_replace($patterns, $replacements, $email);		
		
		// put it all in the message		
		$this->email->message($email);
		
		// now we send it
		if(!$this->email->send())
		{
			return false;
		} else {
			return true;
		}
	}
	
	public function confirm_account($data = array())
	{
		// get the data we need
		$this->email->to($data['to']);
		
		// make the subject
		$this->email->subject('Confirming your account.');
		
		// load the template
		$email = $this->load->view('email/inc_email_header', '', TRUE);
		$email .= $this->load->view('email/confirm_account', '', TRUE);
		$email .= $this->load->view('email/inc_email_footer', '', TRUE);
		
		// replace some stuff
		$patterns = array('/<USER>/','/<VALIDATE_URL>/', '/<SERVER_NAME>/');
		$replacements = array($data['user'], $data['validate_url'], $this->config->item('email_name'));
		
		// put it all back together
		$email = preg_replace($patterns, $replacements, $email);		
		
		// put it all in the message		
		$this->email->message($email);
		
		// now we send it
		if(!$this->email->send())
		{
			return false;
		} else {
			return true;
		}
	}
	
	public function email_change($data = array())
	{
		// get the data we need
		$this->email->to($data['to']);
		
		// make the subject
		$this->email->subject('Your email has been changed.');
		
		// load the template
		$email = $this->load->view('email/inc_email_header', '', TRUE);
		$email .= $this->load->view('email/email_change', '', TRUE);
		$email .= $this->load->view('email/inc_email_footer', '', TRUE);
		
		// replace some stuff
		$patterns = array('/<USER>/', '/<SERVER_NAME>/');
		$replacements = array($data['user'], $this->config->item('email_name'));
		
		// put it all back together
		$email = preg_replace($patterns, $replacements, $email);		
		
		// put it all in the message		
		$this->email->message($email);
		
		// now we send it
		if(!$this->email->send())
		{
			return false;
		} else {
			return true;
		}
	}
	
	public function new_password($data = array())
	{
		// get the data we need
		$this->email->to($data['to']);
		
		// make the subject
		$this->email->subject('Your new password.');
		
		// load the template
		$email = $this->load->view('email/inc_email_header', '', TRUE);
		$email .= $this->load->view('email/new_password', '', TRUE);
		$email .= $this->load->view('email/inc_email_footer', '', TRUE);
		
		// replace some stuff
		$patterns = array('/<USER>/','/<PASSWORD>/', '/<SERVER_NAME>/');
		$replacements = array($data['user'], $data['password'], $this->config->item('email_name'));
		
		// put it all back together
		$email = preg_replace($patterns, $replacements, $email);		
		
		// put it all in the message		
		$this->email->message($email);
		
		// now we send it
		if(!$this->email->send())
		{
			return false;
		} else {
			return true;
		}
	}
	
	
	public function password_changed($data = array())
	{
		// get the data we need
		$this->email->to($data['to']);
		
		// make the subject
		$this->email->subject('Your password has been changed.');
		
		// load the template
		$email = $this->load->view('email/inc_email_header', '', TRUE);
		$email .= $this->load->view('email/password_changed', '', TRUE);
		$email .= $this->load->view('email/inc_email_footer', '', TRUE);
		
		// replace some stuff
		$patterns = array('/<USER>/','/<IP>/', '/<SERVER_NAME>/');
		$replacements = array($data['user'], $data['ip'], $this->config->item('email_name'));
		
		// put it all back together
		$email = preg_replace($patterns, $replacements, $email);		
		
		// put it all in the message		
		$this->email->message($email);
		
		// now we send it
		if(!$this->email->send())
		{
			return false;
		} else {
			return true;
		}
	}
	
	public function password_forget($data = array())
	{
		// get the data we need
		$this->email->to($data['to']);
		
		// make the subject
		$this->email->subject('New password request.');
		
		// load the template
		$email = $this->load->view('email/inc_email_header', '', TRUE);
		$email .= $this->load->view('email/password_forget', '', TRUE);
		$email .= $this->load->view('email/inc_email_footer', '', TRUE);
		
		// replace some stuff
		$patterns = array('/<USER>/','/<PASSWORD_CHANGE_URL>/', '/<SERVER_NAME>/');
		$replacements = array($data['user'], $data['password_change_url'], $this->config->item('email_name'));
		
		// put it all back together
		$email = preg_replace($patterns, $replacements, $email);		
		
		// put it all in the message		
		$this->email->message($email);
		
		// now we send it
		if(!$this->email->send())
		{
			return false;
		} else {
			return true;
		}
	}
	
	public function private_message($data = array())
	{
		// get the data we need
		$this->email->to($data['to']);
		
		// make the subject
		$this->email->subject('New private message at Salvation Online.');
		
		// load the template
		$email = $this->load->view('email/inc_email_header', '', TRUE);
		$email .= $this->load->view('email/private_message', '', TRUE);
		$email .= $this->load->view('email/inc_email_footer', '', TRUE);
		
		// replace some stuff
		$patterns = array('/<USER>/','/<MESSAGE>/', '/<SERVER_NAME>/');
		$replacements = array($data['user'], $data['message'], $this->config->item('email_name'));
		
		// put it all back together
		$email = preg_replace($patterns, $replacements, $email);		
		
		// put it all in the message		
		$this->email->message($email);
		
		// now we send it
		if(!$this->email->send())
		{
			return false;
		} else {
			return true;
		}
	}
	
	public function register_done($data = array())
	{
		// get the data we need
		$this->email->to($data['to']);
		
		// make the subject
		$this->email->subject('Welcome to Salvation Dekaron!');
		
		// load the template
		$email = $this->load->view('email/inc_email_header', '', TRUE);
		$email .= $this->load->view('email/register_done', '', TRUE);
		$email .= $this->load->view('email/inc_email_footer', '', TRUE);
		
		// replace some stuff
		$patterns = array('/<USER>/', '/<PASW>/', '/<SN>/', '/<REGDATE>/', '/<EMAIL>/', '/<SERVER_NAME>/');
		$replacements = array($data['user'], '*******', $data['sn'], $data['regdate'], $data['to'], $this->config->item('email_name'));
		
		// put it all back together
		$email = preg_replace($patterns, $replacements, $email);		
		
		// put it all in the message		
		$this->email->message($email);
		
		// now we send it
		if(!$this->email->send())
		{
			return false;
		} else {
			return true;
		}
	}
	
	public function suspended_account($data = array())
	{
		// get the data we need
		$this->email->to($data['to']);
		
		// make the subject
		$this->email->subject('Your account has been suspended!');
		
		// load the template
		$email = $this->load->view('email/inc_email_header', '', TRUE);
		$email .= $this->load->view('email/suspended_account', '', TRUE);
		$email .= $this->load->view('email/inc_email_footer', '', TRUE);
		
		// replace some stuff
		$patterns = array('/<USER>/','/<REASON>/');
		$replacements = array($data['user'], $data['reason'], $this->config->item('email_name'));
		
		// put it all back together
		$email = preg_replace($patterns, $replacements, $email);		
		
		// put it all in the message		
		$this->email->message($email);
		
		// now we send it
		if(!$this->email->send())
		{
			return false;
		} else {
			return true;
		}
	}
}