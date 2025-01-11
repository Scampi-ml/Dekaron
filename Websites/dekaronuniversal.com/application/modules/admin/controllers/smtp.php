<?php

class Smtp extends MX_Controller
{
	public function __construct()
	{
		$this->load->library('administrator');
		parent::__construct();
		$this->load->config('smtp');
		require_once('application/libraries/configeditor.php');
		requirePermission("editSmtpSettings");
	}

	public function index()
	{
		$this->administrator->setTitle("Smtp");

		$smtp['smtp_host'] = $this->config->item('smtp_host');
		$smtp['smtp_user'] = $this->config->item('smtp_user');
		$smtp['smtp_pass'] = $this->config->item('smtp_pass');
		$smtp['smtp_port'] = $this->config->item('smtp_port');

		$data = array(
			'url' => $this->template->page_url,
			'smtp' => $smtp
		);

		$output = $this->template->loadPage("smtp.tpl", $data);
		$content = $this->administrator->box('Smtp', $output);
		$this->administrator->view($content, false, "modules/admin/js/smtp.js");
	}

	public function saveSmtp()
	{
		$fusionConfig = new ConfigEditor("application/config/smtp.php");
		$fusionConfig->set('smtp_host', $this->input->post('smtp_host'));
		$fusionConfig->set('smtp_user', $this->input->post('smtp_user'));
		$fusionConfig->set('smtp_pass', $this->input->post('smtp_pass'));
		$fusionConfig->set('smtp_port', $this->input->post('smtp_port'));
		$fusionConfig->save();
		die('yes');
	}
}