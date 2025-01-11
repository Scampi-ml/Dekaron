<?php

class Register extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->user->guestArea();
		requirePermission("view");
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		//$this->load->helper('email_helper');
		$this->load->config('captcha');
	}
	
	public function index()
	{
		$this->template->setTitle(lang("register", "register"));
		
		clientLang("username_limit_length", "register");
		clientLang("username_limit", "register");
		clientLang("username_not_available", "register");
		clientLang("email_not_available", "register");
		clientLang("email_invalid", "register");
		clientLang("password_short", "register");
		clientLang("password_match", "register");

		require_once('application/modules/register/controllers/captcha.php');
		$captchaObj = new Captcha($this->config->item('use_captcha'));
		
		$data = array(
					"url" => $this->template->page_url,
					"class" => array("class" => "page_form")
				);		
				
		if(count($_POST) == 0)
		{
			$this->defaultPage($data);
		}
		else
		{		
			$this->form_validation->set_rules('register_username', 			'username', 				'trim|required|min_length[4]|max_length[14]|alpha_numeric|xss_clean');
			$this->form_validation->set_rules('register_email', 			'email', 					'trim|required|valid_email|xss_clean');
			$this->form_validation->set_rules('register_password', 			'password', 				'trim|required|min_length[6]|xss_clean');
			$this->form_validation->set_rules('register_password_confirm', 	'password confirmation', 	'trim|required|matches[register_password]|xss_clean');

			if($this->form_validation->run() == FALSE)
			{
				$data['validation_errors'] = validation_errors();
				$this->defaultPage($data);
			}
			elseif(strtoupper($this->input->post('register_captcha')) != strtoupper($captchaObj->getValue()))
			{	
				$data['validation_errors'] = "Wrong captcha";
				$this->defaultPage($data);
			}
			else
			{
				$fields = array(	
					"username" => $this->input->post('register_username'),
					"email" => $this->input->post('register_email'),
					"password" => md5($this->input->post('register_password')),	
				);			
				
				$res = $this->conn->api("register", $fields);
				if(isset($res->result) && $res->result == 'ok')
				{
					$login = $this->user->setUserDetails($this->input->post('register_username'), md5($this->input->post('register_password')));
					$title = lang("created", "register");
					$data['account'] = $this->input->post('register_username');
					$this->template->view($this->template->box($title, $this->template->loadPage("register_success.tpl", $data)));		
				}
				else
				{
					$data['validation_errors'] = "".$res->error."";
					$this->defaultPage($data);	
				}
			}
		}
	}
	
	private function defaultPage($data)	
	{
		$data["use_captcha"] = $this->config->item('use_captcha');
		$this->template->view($this->template->loadPage("page.tpl", array(
			"module" => "default", 
			"headline" => "Account creation", 
			"content" => $this->template->loadPage("register.tpl", $data),
		)), false, false, "Account Creation");	
	}
}