<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Features extends MY_Controller
{
    function __construct()
	{
        parent::__construct();
    }	
	
	public function index()
	{
		$this->template_data['template']['body_id'] = 'features';
		$this->template_data['template']['active_page'] = $this->uri->segment(1);
		$this->load->view('view_features', $this->template_data);

	}
}