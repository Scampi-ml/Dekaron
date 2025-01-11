<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Connect extends MY_Controller{
	private $data = array();

	function __construct(){
        parent::__construct();
	}
	
	public function index(){
		$this->data['title'] = 'How to connect';
		$this->smarty->view( 'view_connect.tpl', $this->data );		
	}	
}
