<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_settings extends MY_model 
{
	public function get()
	{		
		// get the data
		$query = $this->db->query('SELECT * FROM user_settings WHERE user_no = "'.$this->session->userdata('user_no').'" ');		
		if($query->num_rows() > 0)
		{
			// found, send data
			return $query->row_array();	
		}
		else
		{
			// not found, send default ones and insert default ones
			
			$data = array(
				'user_no'				=> $this->session->userdata('user_no'),
				'sound' 				=> "1",
				'sound_level' 			=> "50",
				'sound_background'		=> "1",
				'sound_npc'				=> "1",
			);			
			
			$insert = $this->db->insert('user_settings', $data); 
			
			return $data;
		}		
		
		/*
		// create new array
		$newdata = array();
		$newdata['sound'] 				= $row->sound;		
		$newdata['sound_level'] 		= $row->sound_level;
		// put data to session
		$this->session->set_userdata('settings', $newdata);
			
		*/

	}
	
	public function save_sound()
	{
		// get the data
		$data = array(
		   'sound' 				=> $this->input->post('sound', TRUE),
		   'sound_level' 		=> $this->input->post('sound_level', TRUE),
		   'sound_background' 	=> $this->input->post('sound_background', TRUE),
		   'sound_npc' 			=> $this->input->post('sound_npc', TRUE),
		);		
	
		// who ?
		$this->db->where('user_no', $this->session->userdata('user_no'));
		
		// was it done correctly?
		$save = $this->db->update('user_settings', $data); 	
		if(!$save)
			return false;
		else
			return true;
	}
	
	public function save_general()
	{
		// get the data
		$data = array(
		   'sound' 				=> $this->input->post('sound', TRUE),
		   'sound_level' 		=> $this->input->post('sound_level', TRUE),
		   'sound_background' 	=> $this->input->post('sound_background', TRUE),
		   'sound_npc' 			=> $this->input->post('sound_npc', TRUE),
		);		
	
		// who ?
		$this->db->where('user_no', $this->session->userdata('user_no'));
		
		// was it done correctly?
		$save = $this->db->update('user_settings', $data); 	
		if(!$save)
			return false;
		else
			return true;
	}			
}