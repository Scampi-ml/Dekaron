<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_email extends CI_model {

	private $server_name = 'Salvation Dekaron';

    function __construct(){
        parent::__construct();
		$config = array(
			'protocol' 			=> 'smtp',
			'smtp_host' 		=> 'smtp1.servage.net',
			'smtp_port' 		=> '2525',
			'smtp_user' 		=> 'no-reply@salvationdekaron.com',
			'smtp_pass' 		=> 'xxxxxxxxxxxxxxxxxxxxx',
			'mailtype' 			=> 'html',
			'charset' 			=> 'utf-8',
			'wordwrap' 			=> true,
			'smtp_timeout' 		=> '1',
			'newline' 			=> '\r\n',
			'crlf' 				=> '\r\n',
			'priority' 			=> '3',
			'useragent' 		=> 'CodeIgniter',
			'validate' 			=> false,
			'bcc_batch_mode' 	=> false,
			'bcc_batch_size' 	=> 200
		);
		
        $this->load->library('email', $config);		
		$this->email->from('no-reply@salvationdekaron.com', 'Salvation Dekaron');
    }
	
	public function confirm_account($data = array())
	{
		// get the data we need
		$this->email->to($data['to']);
		
		// make the subject
		$this->email->subject('Forgot Account Request');
		
		// load the template
		$email = $this->load->view('email/inc_email_header', '', TRUE);
		$email .= $this->load->view('email/welcome', '', TRUE);
		$email .= $this->load->view('email/inc_email_footer', '', TRUE);
		
		// replace some stuff
		$patterns = array('/<USER>/','/<SERVER_NAME>/', '/<EMAIL>/', '/<REGDATE>/');
		$replacements = array($data['user'], $this->server_name, $data['to'], $data['regdate']);
		
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
	
	
	
	public function account_forget($data = array())
	{
		// get the data we need
		$this->email->to($data['to']);
		
		// make the subject
		$this->email->subject('Forgot Account Request');
		
		// load the template
		$email = $this->load->view('email/inc_email_header', '', TRUE);
		$email .= $this->load->view('email/account_forget', '', TRUE);
		$email .= $this->load->view('email/inc_email_footer', '', TRUE);
		
		// replace some stuff
		$patterns = array('/<USER_ID>/','/<SERVER_NAME>/');
		$replacements = array($data['user_id'], $this->server_name);
		
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
		$this->email->subject('Forgot password request');
		
		// load the template
		$email = $this->load->view('email/inc_email_header', '', TRUE);
		$email .= $this->load->view('email/password_forget', '', TRUE);
		$email .= $this->load->view('email/inc_email_footer', '', TRUE);
		
		// replace some stuff
		$patterns = array('/<PASSWORD_CHANGE_URL>/', '/<SERVER_NAME>/');
		$replacements = array($data['password_change_url'], $this->server_name);
		
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