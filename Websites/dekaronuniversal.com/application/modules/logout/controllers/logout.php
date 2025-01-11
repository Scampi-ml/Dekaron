<?php
class Logout extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('cookie');
	}
	
	public function index()
	{
		$this->input->set_cookie("dkcms_username", false);
		$this->input->set_cookie("dkcms_password", false);
		delete_cookie("dkcms_username");
		delete_cookie("dkcms_password");
		$this->session->sess_destroy();
		$this->plugins->onLogout();
		redirect($this->template->page_url);
	}
}
