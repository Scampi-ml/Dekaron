<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Shop extends MY_Controller
{
	public function index()
	{
		$this->template_data['template']['body_id'] = 'howtoconnect';
		$this->template_data['template']['active_page'] = $this->uri->segment(1);
		$this->load->view('view_shop', $this->template_data);
	}
}