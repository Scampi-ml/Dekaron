<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class M_website extends MY_model
{
    function __construct()
	{
        parent::__construct();
        // Initialize the variables
		$this->db_website = $this->load->database('website', TRUE); 
    }
	
	public function ListLog()
	{
		//$query = $this->db_character->query("SELECT * FROM user_character WHERE user_no = '".$this->session->userdata('user_no')."' ");
		//return $query->result_array();		
	}
	
	public function AddLogin()
	{
		$data = array(
		   'time' 			=> time(),
		   'ip' 			=> $this->session->userdata('ip_address'),
		   'user_no' 		=> $this->session->userdata('user_no'),
		   'user_name' 		=> $this->session->userdata('user_id')
		);
		$this->db_website->insert('user_login_log', $data); 				
	}
	
	
	public function AddLog($action, $username)
	{
		$data = array(
		   'user_no' 		=> $this->session->userdata('user_no'),
		   'datetime' 		=> date('m/d/Y g:i:s A'),
		   'action' 		=> $action,
		   'user_name' 		=> $username
		);
		$this->db_website->insert('user_action_log', $data); 				
	}
}