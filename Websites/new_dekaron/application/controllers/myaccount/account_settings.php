<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account_Settings extends MY_Controller
{
    function __construct()
	{
        parent::__construct();
		// check if logged in, this is a restricted page
		$this->is_logged_in();
    }	
	
	public function index()
	{
		// this page only
		$this->load->view('myaccount/view_account_settings', $this->template_data);
	}
}