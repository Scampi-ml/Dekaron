<?php defined('BASEPATH') OR exit('No direct script access allowed');

class CharacterExistsPaypal extends REST_Controller
{
    public $data;
	
	function __construct()
	{
        parent::__construct();
		$this->data = array();
		$this->db = $this->load->database('character', TRUE);
    }
	
	function index()
	{	
		$character_name = $this->get('character_name');
		
		$query = $this->db->query("SELECT user_no FROM user_character WHERE character_name = '".$character_name."' ");
		if($query->num_rows() > 0)
		{
			$this->data = $query->row_array();
		}
		else
		{
			$this->data = array('result' => 'false');
		}
		
		$this->response($this->data, 200);
	}
}
