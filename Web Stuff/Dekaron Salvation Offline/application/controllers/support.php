<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Support extends MY_Controller{
    private $data = array();
	
	function __construct(){
        parent::__construct();
    }	
	
	public function index(){
		$this->data['title'] = 'Support';
		$this->smarty->view( 'view_support.tpl', $this->data );				
    }
}