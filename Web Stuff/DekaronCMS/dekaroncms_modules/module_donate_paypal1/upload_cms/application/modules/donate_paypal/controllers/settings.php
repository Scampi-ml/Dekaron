<?php
class Settings extends MX_Controller 
{
	private $data;

	public function __construct()
	{
		parent::__construct();
		$this->load->library("administrator");
		$this->load->model("donate_paypal_model");
		adminPerm();
	}

	public function index()
	{
		$this->administrator->setTitle("Donate Paypal Settings");
		
		$this->data['url'] = $this->template->page_url;

		$this->getSettings();

		$output = $this->template->loadPage("donate_paypal_settings.tpl", $this->data);
		$content = $this->administrator->box('Donate Paypal Settings', $output);
		$this->administrator->view($content, false, "modules/donate_paypal/js/donate_paypal_settings.js");
	}

	private function getSettings()
	{
		$settings = $this->donate_paypal_model->getConfig();
		
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
		$this->donate_paypal_model->updateSetting('donate_paypal', 'paypal_clientSecret', $this->input->post('paypal_clientSecret'));
		$this->donate_paypal_model->updateSetting('donate_paypal', 'paypal_clientId', $this->input->post('paypal_clientId'));
		$this->donate_paypal_model->updateSetting('donate_paypal', 'paypal_mode', $this->input->post('paypal_mode'));
		$this->donate_paypal_model->updateSetting('donate_paypal', 'paypal_ConnectionTimeOut', $this->input->post('paypal_ConnectionTimeOut'));
		$this->donate_paypal_model->updateSetting('donate_paypal', 'paypal_LogEnabled', $this->input->post('paypal_LogEnabled'));
		$this->donate_paypal_model->updateSetting('donate_paypal', 'paypal_LogLevel', $this->input->post('paypal_LogLevel'));
		$this->donate_paypal_model->updateSetting('donate_paypal', 'paypal_validationLevel', $this->input->post('paypal_validationLevel'));
		$this->donate_paypal_model->updateSetting('donate_paypal', 'paypal_currency', $this->input->post('paypal_currency'));
		die("yes");
	}
	
}