<?php
class Admin extends MX_Controller 
{
	private $data;

	public function __construct()
	{
		parent::__construct();
		$this->load->library("administrator");
		$this->load->model("register_model");
		adminPerm();
	}

	public function index()
	{
		$this->administrator->setTitle("Register Settings");
		
		$this->data['url'] = $this->template->page_url;

		$this->getSettings();

		$output = $this->template->loadPage("admin.tpl", $this->data);
		$content = $this->administrator->box('Register Settings', $output);
		$this->administrator->view($content, false, "modules/register/js/register.js");
	}


	private function getSettings()
	{
		$settings = $this->register_model->getConfig();
		
		foreach ($settings as $setting)
		{		
			if($setting['value'] === NULL)
			{
				$this->data[$setting['key']] = $setting['default'];
			}
			else
			{
				$this->data[$setting['key']] = $setting['value'];
			}
		}
	}

	public function saveEdit()
	{
		adminPerm();
		$this->register_model->updateSetting('register', 'use_captcha', $this->input->post('use_captcha'));
		$this->register_model->updateSetting('register', 'captcha_length', $this->input->post('captcha_length'));
		$this->register_model->updateSetting('register', 'captcha_distortionLevel', $this->input->post('captcha_distortionLevel'));
		$this->register_model->updateSetting('register', 'captcha_height', $this->input->post('captcha_height'));
		$this->register_model->updateSetting('register', 'captcha_width', $this->input->post('captcha_width'));
		$this->register_model->updateSetting('register', 'min_length_username', $this->input->post('min_length_username'));
		$this->register_model->updateSetting('register', 'max_length_username', $this->input->post('max_length_username'));
		$this->register_model->updateSetting('register', 'min_length_password', $this->input->post('min_length_password'));
		die("yes");
	}
}