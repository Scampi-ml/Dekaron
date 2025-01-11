<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Staff extends MY_Controller
{	
	private $data = array();
	
	function __construct()
	{
        parent::__construct();
		$this->data['push_css'] = array('news.css');	
		$this->load->library('gravatar');
    }	
	
	public function index()
	{
		$this->data['gravatar_img'] 		= $this->gravatar->get_gravatar('scampi_ml@telenet.be', 90);
		$this->data['title'] = 'Staff';
		$this->smarty->view( 'view_staff.tpl', $this->data );
	}
}