<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rules extends MY_Controller{
	private $data = array();
	
	function __construct(){
        parent::__construct();
	}
	
	public function index(){
		$this->data['rules_game'] 	= $this->config->item('rules_game');
		$this->data['rules_donate'] = $this->config->item('rules_donate');
		$this->data['rules_forums'] = $this->config->item('rules_forums');
		$this->data['title'] = 'Rules';
		$this->smarty->view( 'view_rules.tpl', $this->data );		
	}	
}