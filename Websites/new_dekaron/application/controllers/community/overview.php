<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Overview extends MY_Controller
{	
	
	function __construct()
	{
        parent::__construct();
		// check if logged in, this is a restricted page
		//$this->load->library('l_pcclass');
		//$this->load->driver('cache');
    }	
	
	public function index()
	{
		$this->template_data['template']['body_id'] = 'arsenal';
		$this->template_data['template']['active_page'] = $this->uri->segment(1);
		$this->load->view('community/view_overview', $this->template_data);
	}

}