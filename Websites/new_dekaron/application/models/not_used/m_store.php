<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_store extends MY_model {
	
	public function viewall()
	{
		$query = $this->db->query("SELECT * FROM user_store WHERE character_no = '".$this->session->userdata('character_no')."' ");
		return $query->result_array();
	}
	
	public function save($line_no = '0', $dwPrice = '0', $byHeader = '0', $wIndex = '0', $info = '0', $exp_bindate = '0')
	{
		$data = array(
		   'character_no' 		=> $this->session->userdata('character_no'),
		   'line_no' 			=> $line_no,
		   'dwPrice'			=> $dwPrice,
		   'byHeader' 			=> $byHeader,
		   'wIndex' 			=> $wIndex,
		   'dwSerialNumber' 	=> $this->create_serial(),
		   'info' 				=> $info,
		   'reg_bindate' 		=> time(),
		   'exp_bindate' 		=> $exp_bindate
		);
		$this->db->insert('user_store', $data); 	
	}	
	
	public function count_items()
	{
		$this->db->select('character_no');
		$this->db->from('user_store');
		$this->db->where('character_no', $this->session->userdata('character_no'));
		return $this->db->count_all_results();			
	}

	
	public function delete($wIndex, $byHeader)
	{		
		$this->db->where('character_no', $character_no);
		$this->db->delete('user_character'); 			
	}
	
	/*
	// this can be implemented later
	public function change_name($character_no, $name)
	{		
		$this->db->where('character_no', $character_no);
		$this->db->update('mytable', array('character_name' => $name)); 	
	}
	*/
	
	
	
	
	
}