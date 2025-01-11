<?php
class Ucp_model extends CI_Model
{
	public function countPlayTime()
	{
		$res = $this->conn->api("countPlayTime", array('user_no' => $this->session->userdata('id')));	
		if($res->played == null){
			return 0;
		}else{
			return $res->played;
		}
	}
	
	public function getCashByUserNo()
	{
		$res = $this->conn->api("getCashByUserNo", array('user_no' => $this->session->userdata('id')));	
		if(isset($res->error)){
			return 0;
		}else{
			return $res->amount + $res->free_amount;
		}
	}
	
	public function getUcpModules()
	{
		$query = $this->db->query("SELECT * FROM ucp_modules WHERE active=?", array('1'));
		if($query->num_rows() > 0){
			return $query->result_array();
		}else{
			return false;
		}		
	}		
}