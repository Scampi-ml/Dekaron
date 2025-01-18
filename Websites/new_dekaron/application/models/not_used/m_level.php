<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_level extends MY_Model {

	public function levelup()
	{
		$this->db->set('wLevel', 'wLevel+1', FALSE);
		$this->db->where('character_no', $this->session->userdata('character_no'));
		$this->db->update('user_character'); 		
	}
	public function leveldown()
	{
		$this->db->set('wLevel', 'wLevel-1', FALSE);
		$this->db->where('character_no', $this->session->userdata('character_no'));
		$this->db->update('user_character'); 		
	}
	public function levelset($level, $character_no)
	{
		$this->db->set('wLevel', $level, FALSE);
		$this->db->where('character_no', $character_no);
		$this->db->update('user_character'); 		
	}
}
	
	