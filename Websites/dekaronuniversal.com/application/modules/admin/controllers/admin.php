<?php

class Admin extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('administrator');
		$this->load->model('dashboard_model');
		requirePermission("view");
	}

	public function index()
	{
		// Change the title
		$this->administrator->setTitle("Dashboard");
		
		// Prepare my data
		$data = array(
			'url' => $this->template->page_url,
			'theme' => $this->template->theme_data,
			'version' => $this->administrator->getVersion(),
			'php_version' => phpversion(),
			'header_url' => $this->config->item('header_url'),
			'theme_value' => $this->config->item('theme'),
		);

		// Load my view
		$output = $this->template->loadPage("dashboard.tpl", $data);

		// Put my view in the main box with a headline
		$content = $this->administrator->box('Dashboard', $output);

		// Output my content. The method accepts the same arguments as template->view
		$this->administrator->view($content, false, false);
	}
}