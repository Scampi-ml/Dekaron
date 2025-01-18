<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tokenshop extends MY_Controller
{
    function __construct()
	{
        parent::__construct();
		// check if logged in, this is a restricted page
		$this->is_logged_in();
    }
	
	//*******************************
	//	NO SETTINGS FOR NOW :(
	//*******************************
	
		
	public function index()
	{
		$this->template_data['template']['body_id'] = 'account';
		$this->template_data['template']['active_page'] = $this->uri->segment(1);
		$this->load->view('myaccount/view_tokenshop', $this->template_data);
	}	
}