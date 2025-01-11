<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Landing extends MY_Controller
{
	public function index()
	{
		$user_data['landing'] = 'visited';
		$this->session->set_userdata($user_data);	
		
		$this->load->view('view_landing', $this->template_data);
	}
}
