<?php defined('BASEPATH') OR exit('No direct script access allowed');

class UpdateCashPaypal extends REST_Controller
{
    public $data;
	
	function __construct()
	{
        parent::__construct();
		$this->data = array();
		$this->db = $this->load->database('cash', TRUE);
    }
	
	function index()
	{	
		$amount 	= (int)$this->get('amount');
		$user_no 	= $this->get('user_no');
		
	
		if(!$this->GetCashRow($user_no))
		{
			//01-140823-140D9D9CF2
			$o_id_code = '01'.date("ymd").''.$this->createNewid(10, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ01234567890');
			$query = $this->db->query("INSERT INTO user_cash (id,user_no,group_id,amount,free_amount) VALUES ('".$o_id_code."','".$user_no."','01','0','".round($amount)."')  ");				
		}
		else
		{
			$query = $this->db->query("UPDATE user_cash SET free_amount = free_amount + ".round($amount)." WHERE user_no = '".$user_no."' ");	
		}
		
		if($query === false)
		{
			$this->data = array('error' => 'sql_failed');
		}
		else
		{
			$this->data = array('success' => 'ok');
		}			
		
		$this->response($this->data, 200);
	}
	
	function GetCashRow($user_no)
	{
		$query = $this->db->query("SELECT user_no FROM user_cash WHERE user_no = '".$user_no."'  ");
		if($query->num_rows() > 0){	
			return true;
		} else {
			return false;
		}
	}	
	
	function createNewid($length, $characters)
	{
		$chars_length = strlen($characters)-1;
		mt_srand((double)microtime()*1000000);
		$newid = '';
		while(strlen($newid) < $length) {
			$rand_char = mt_rand(0, $chars_length);
			$newid .= $characters[$rand_char];
		}
		return $newid;
	}	
		
	
}
