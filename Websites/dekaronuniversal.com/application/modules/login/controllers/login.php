<?php
class Login extends MX_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
	}
	
	public function index()
	{
		$this->template->setTitle("Sign in");
		if($this->user->isOnline())
		{
			redirect($this->template->page_url . "ucp");
		}
		
		$data = array(
					"url" => $this->template->page_url,
					"username" => "",
					"username_error" => "",
					"password_error" => "",
					"class" => array("class" => "page_form"),
				);
				
		if(count($_POST) == 0)
		{
			$this->defaultPage($data);
		}
		else
		{
			$this->form_validation->set_rules('login_username','Username','trim|required|min_length[4]|max_length[16]|alpha_numeric|xss_clean');
			$this->form_validation->set_rules('login_password','Password','trim|required|min_length[4]|max_length[16]|md5');
			if ($this->form_validation->run() == FALSE)
			{
				$data['validation_errors'] = validation_errors();
				$this->defaultPage($data);	
			}
			else
			{
				$check = $this->user->setUserDetails($this->input->post('login_username'), $this->input->post('login_password'));
				
				
				if($check == 'username')
				{
					$data['validation_errors'] = "Incorrect username";
					$this->defaultPage($data);
				}
				elseif($check == 'password')
				{
					$data['validation_errors'] = "Incorrect password";
					$this->defaultPage($data);
				}
				elseif($check = 'ok')
				{
					if($this->input->post('login_remember'))
					{
						$this->input->set_cookie("dkcms_username", $this->input->post('login_username'), 60*60*24*365, $_SERVER['HTTP_HOST'], "/", "", true);
						$this->input->set_cookie("dkcms_password", $this->input->post('login_password'), 60*60*24*365, $_SERVER['HTTP_HOST'], "/", "", true);
					}
					redirect($this->template->page_url."ucp");				
				}
				else
				{
					$data['validation_errors'] = "Unknown Error";
					$this->defaultPage($data);
				}									
			}
		}
	}
	
	private function defaultPage($data)
	{
		$this->template->view($this->template->loadPage("page.tpl", array(
			"username" => $this->input->post('login_username'),
			"module" => "default", 
			"headline" => lang("log_in", "login"), 
			"content" => $this->template->loadPage("login.tpl", $data)
		)));	
	}
}