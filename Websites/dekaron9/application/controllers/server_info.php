<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Server_info extends MY_Controller
{	
	private $data = array();
	
	function __construct()
	{
        parent::__construct();
    }	
	
	public function index()
	{
	
	
			
		$this->data['title'] = 'Server Info';
		$this->smarty->view( 'view_server_info.tpl', $this->data );
	}
}