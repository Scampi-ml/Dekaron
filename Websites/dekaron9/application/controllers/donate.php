<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Donate extends MY_Controller
{	
	private $data = array();
	
	function __construct()
	{
        parent::__construct();
    }	
	
	public function index()
	{
		$this->data['title'] = 'Donate';
		$this->smarty->view( 'view_donate.tpl', $this->data );
	}
}