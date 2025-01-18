<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_miniprofile extends MY_model {
	
	public function view_hp()
	{
		$q = $this->db->query("SELECT * FROM user_bag WHERE character_no = '".$this->session->userdata('character_no')."' ");
		return $q->result();
	}
		
	public function view_mp()
	{
		$q = $this->db->query("SELECT * FROM user_bag WHERE character_no = '".$this->session->userdata('character_no')."' ");
		return $q->result();
	}
	
	public function view_shield()
	{
		$q = $this->db->query("SELECT * FROM user_bag WHERE character_no = '".$this->session->userdata('character_no')."' ");
		return $q->result();
	}
	
	
	public function load_character()
	{
		$q = $this->db->query("SELECT * FROM user_bag WHERE character_no = '".$this->session->userdata('character_no')."' ");
		return $q->result();
	}
	
	
	
	
}