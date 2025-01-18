<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Functions {
	public $data = array();
	
	function __construct()
	{
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
	

	function DshopFix($user_no)
	{
		$this->db = $this->load->database('cash', TRUE);
		$o_id_code = '01'.date("ymd").''.$this->createNewid(12, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ01234567890');
		$this->db->query("INSERT INTO dbo.user_cash (id,user_no,group_id,amount,free_amount) VALUES ('".$o_id_code."','".$user_no."','01','0','0')  ");
	}		
}
