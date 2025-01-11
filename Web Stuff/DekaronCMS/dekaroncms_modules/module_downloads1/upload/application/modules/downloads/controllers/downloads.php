<?php

class Downloads extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		requirePermission("view");
		$this->load->model('downloads_model');
	}
	
	public function index()
	{
		$this->template->setTitle("Downloads");
		$data = array(	
			'url' => $this->template->page_url,
			"downloads" => $this->downloads_model->getDownloads()
		);
		
		$this->template->view($this->template->loadPage("page.tpl", array(
			"module" => "default", 
			"headline" => "Downloads", 
			"content" => $this->template->loadPage("downloads.tpl", $data),
		)), false, false, "Downloads");	
	}
	

}