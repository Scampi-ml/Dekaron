<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_mailbox extends MY_model
{
	function __construct()
	{
        parent::__construct();
		$this->db_character = $this->load->database('character', TRUE); 
    }
	
		
	public function ViewAll($character_no)
	{
		if(!$this->isYours($character_no))
		{
			return false;
		}
		else
		{
			
			$query = $this->db_character->query("SELECT * FROM user_postbox WHERE character_no = '".$character_no."' ");
			if($query->num_rows() == 0)
			{
				return false;
			}
			else
			{
				return $query->result_array(); 
			}
		}		
	}
	
	public function ViewSingle()
	{
		$this->db_character->select('character_no');
		$this->db_character->from('user_postbox');
		$this->db_character->where('character_no', $this->session->userdata('character_no'));
		return $this->db_character->count_all_results();			
	}
	
	public function isYours($character_no)
	{
		$query = $this->db_character->query("SELECT character_no,user_no FROM user_character WHERE user_no = '".$this->session->userdata('user_no')."' AND character_no = '".$character_no."'");
		if($query->num_rows() == 0)
		{
			return false;
		}
		else
		{
			return true;
		}
	}
}