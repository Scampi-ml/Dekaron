<?php

class Conn extends CI_Model
{	
	public function __construct()
	{
		parent::__construct();
		$this->load->library('rest', $this->config->item('api_server'));	
	}
		
	public function api($controller, $data, $type = 'json')
	{		
		$api = $this->rest->get($controller, $data, $type);	
		return  ($api == 'null' ? false : $api);
	}
}
