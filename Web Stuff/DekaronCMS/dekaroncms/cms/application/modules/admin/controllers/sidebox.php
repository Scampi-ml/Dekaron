<?php

class Sidebox extends MX_Controller
{
	private $sideboxModules;

	public function __construct()
	{
		parent::__construct();
		$this->load->library('administrator');
		//$this->load->model('sidebox_model');	
		adminPerm();
	}

	public function index()
	{

		$this->administrator->setTitle("Sideboxes");
		$data = array('url' => $this->template->page_url,);

		$output = $this->template->loadPage("sidebox/sidebox.tpl", $data);
		$content = $this->administrator->box('Sideboxes', $output);
		$this->administrator->view($content, false, "modules/admin/js/sidebox.js");
	}

}