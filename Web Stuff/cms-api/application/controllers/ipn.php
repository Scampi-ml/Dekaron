<?php

class Ipn extends REST_Controller
{
    function __construct()
	{
        parent::__construct();
		$this->db = $this->load->database('cash', TRUE);
		$this->db_character = $this->load->database('character', TRUE);
    }
	
	function Paypal()
	{
		$option_selection2 	= $this->get('option_selection2'); 
		$mc_gross			= $this->get('mc_gross');
		$user_no 			= $this->GetUserNo($option_selection2);
		
		$query = $this->db->query("UPDATE dbo.user_cash SET free_amount = free_amount + ".round($mc_gross)." WHERE user_no = '".$user_no."' ");
		if($query)
		{
			$data = array(
				'status' 	=> 'true',
				'result' 	=> $user_no
			);
			$this->response($data, 200);				
		} else {
			$data = array(
				'status' 	=> 'false',
				'result' 	=> 'SQL_FAILED'
			);
			$this->response($data, 200);	
		}
	}
	
	function PaymentWall()
	{
		$custom 	= $this->get('custom');
		$mc_gross 	= $this->get('mc_gross');
		$user_no 	= $this->GetUserNo($custom);
		
		$query = $this->db->query("UPDATE dbo.user_cash SET free_amount = free_amount + ".round($mc_gross)." WHERE user_no = '".$user_no."' ");
		if($query)
		{
			$data = array(
				'status' 	=> 'true',
				'result' 	=> $user_no
			);
			$this->response($data, 200);				
		} else {
			$data = array(
				'status' 	=> 'false',
				'result' 	=> 'SQL_FAILED'
			);
			$this->response($data, 200);	
		}		
	}
	
	function GetUserNo($character)
	{
		$query = $this->db_account->query("SELECT user_no, character_name FROM dbo.user_character WHERE character_name = '".$character."'  ");
		if($query->num_rows() > 0){	
			$row = $query->row();
			return $row->user_no;
		} else {
			return false;
		}
	}
}
