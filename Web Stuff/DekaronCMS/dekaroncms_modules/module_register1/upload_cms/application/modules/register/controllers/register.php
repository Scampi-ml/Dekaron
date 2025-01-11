<?php

class Register extends MX_Controller
{
	private $data;

	public function __construct()
	{
		parent::__construct();
		//$this->user->guestArea();
		requirePermission("view");
		$this->load->library('form_validation');
		$this->load->model('register_model');

		$this->load->config('cms', TRUE);

		$this->config = $this->template->array_column($this->register_model->getConfig(), 'value', 'key');
		$this->data['use_captcha'] = $this->config['use_captcha'];

		if($this->config['captcha_width'] === 'auto')
		{
			$this->data['width'] = $this->config['captcha_length'] * 9.5;	
		}
		else
		{
			$this->data['width'] = $this->config['captcha_width'];	
		}

		$this->data['length'] = $this->config['captcha_length'];
		$this->data['height'] = $this->config['captcha_height'];	
		$this->data['distortionLevel'] = $this->config['captcha_distortionLevel'];				
	}
	
	public function index()
	{
		$this->template->setTitle("Register");

		if($this->config['use_captcha'] === 'true')
		{
			require_once('application/modules/register/controllers/captcha.php');
			$captchaObj = new Captcha(true);
		}

		$this->data['url'] = $this->template->page_url;
		$this->data['base_url'] = base_url();
		$this->data['class'] = array("class" => "page_form");
		
		if(count($_POST) == 0)
		{
			$this->defaultPage($this->data);
		}
		else
		{		
			$min_length_username = $this->config['min_length_username'];
			$max_length_username = $this->config['max_length_username'];
			$min_length_password = $this->config['min_length_password'];

			$this->form_validation->set_rules('register_username', 			'username', 				'trim|required|min_length['.$min_length_username.']|max_length['.$max_length_username.']|alpha_numeric|xss_clean');
			$this->form_validation->set_rules('register_email', 			'email', 					'trim|required|valid_email|xss_clean');
			$this->form_validation->set_rules('register_password', 			'password', 				'trim|required|min_length['.$min_length_password.']|xss_clean');
			$this->form_validation->set_rules('register_password_confirm', 	'password confirmation', 	'trim|required|matches[register_password]|xss_clean');

			if($this->form_validation->run() == FALSE)
			{
				$this->data['validation_errors'] = validation_errors();
				$this->defaultPage($this->data);
			}
			else
			{	
				if($this->config['use_captcha'] === 'true')
				{
					if(strtoupper($this->input->post('register_captcha')) != strtoupper($captchaObj->getValue()))
					{	
						$this->data['validation_errors'] = "Wrong captcha";
						$this->defaultPage($this->data);
					}
				}

				$fields = array(	
					"username" => $this->input->post('register_username'),
					"email" => $this->input->post('register_email'),
					"password" => md5($this->input->post('register_password')),	
				);			
				

				if(CI::$APP->config->item('connection_type') === 'api')
				{
					$register = $this->register_model->register_api($fields);
				}
				elseif(CI::$APP->config->item('connection_type') === 'local')
				{
					$register = $this->register_model->register_local($fields);	
				}
				else
				{
					show_error('API Or Server is not setup to recive register data');
				}

				if(isset($register->result) && $register->result == 'ok')
				{
					$title = "Your account has been created!";
					$this->data['account'] = $this->input->post('register_username');
					$this->template->view($this->template->box($title, $this->template->loadPage("register_success.tpl", $this->data)));				
				}
				else
				{
					if(isset($register->error))
					{
						$this->data['validation_errors'] = $register->error;
						$this->defaultPage($this->data);
					}
					else
					{
						$this->data['validation_errors'] = "The API or Server did not respond";
						$this->defaultPage($this->data);	
					}
	
				}
			}
		}
	}
	
	private function defaultPage($data)	
	{
		$this->template->view($this->template->loadPage("page.tpl", array(
			"module" => "default", 
			"headline" => "Account creation", 
			"content" => $this->template->loadPage("register.tpl", $this->data),
		)), false, false, "Account Creation");	
	}

}