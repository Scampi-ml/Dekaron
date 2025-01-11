<?php
class Logout extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$this->session->sess_destroy();
		redirect($this->template->page_url);
	}
}
