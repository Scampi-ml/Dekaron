<?php
class Settings extends MX_Controller
{
	public function __construct()
	{
		$this->load->library('administrator');
		parent::__construct();
		require_once('application/libraries/configeditor.php');
		requirePermission("editSystemSettings");
	}

	public function index()
	{
		// Change the title
		$this->administrator->setTitle("Settings");

		$config['title'] = $this->config->item('title');
		$config['server_name'] = $this->config->item('server_name');
		$config['keywords'] = $this->config->item('keywords');
		$config['description'] = $this->config->item('description');

		// Prepare my data
		$data = array(
			'url' => $this->template->page_url,
			'config' => $config,
		);

		$output = $this->template->loadPage("settings.tpl", $data);
		$content = $this->administrator->box('Settings', $output);
		$this->administrator->view($content, false, "modules/admin/js/settings.js");
	}

	public function saveWebsite()
	{
		$fusionConfig = new ConfigEditor("application/config/fusion.php");

		$fusionConfig->set('title', $this->input->post('title'));
		$fusionConfig->set('server_name', $this->input->post('server_name'));
		$fusionConfig->set('keywords', $this->input->post('keywords'));
		$fusionConfig->set('description', $this->input->post('description'));
		$fusionConfig->save();
		die('yes');
	}
}