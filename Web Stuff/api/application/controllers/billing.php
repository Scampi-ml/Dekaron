<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Billing extends REST_Controller{

    function __construct()
	{
        parent::__construct();
		$this->db = $this->load->database('billing', TRUE);
    }		
}