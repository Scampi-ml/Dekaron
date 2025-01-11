<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends REST_Controller
{
    public $data;
	
	function __construct()
	{
        parent::__construct();
		$this->data = array();
		$this->db = $this->load->database('account', TRUE);
    }
	
	function index()
	{		
		$query = $this->db->query("SELECT user_no FROM user_profile");
		$this->data = array('success' => $query->num_rows());
		$this->response($this->data, 200);
	}
	
}
