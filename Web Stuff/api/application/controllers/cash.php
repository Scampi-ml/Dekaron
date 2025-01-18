<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Cash extends REST_Controller
{
    function __construct()
	{
        parent::__construct();
		$this->db = $this->load->database('cash', TRUE);
    }	
		
	function Coins()
	{
		$user_no = $this->get('user_no');	
		if(empty($user_no))
		{
			$data = array('error' => 'Empty user_no');		
		}
		else
		{
			$query = $this->db->query("SELECT free_amount,amount FROM user_cash WHERE user_no = '".$user_no."' ");
			if($query->num_rows() > 0)
			{
				$row = $query->row();
				$data =  array('coins' => $row->free_amount + $row->amount);
			}
			else
			{
				$data = array('coins' => '0');		
			}
		}
		$this->response($data, 200);		
	}
}