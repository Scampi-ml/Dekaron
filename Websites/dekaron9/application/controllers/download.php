<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Download extends MY_Controller
{
	private $data = array();
	
	function __construct()
	{
        parent::__construct();
	}
	
	public function index()
	{
		$this->data['title'] = 'Download';
		$this->smarty->view( 'view_download.tpl', $this->data );		
	}	
}
