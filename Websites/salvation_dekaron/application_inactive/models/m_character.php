<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_character extends MY_model
{
	
    function __construct()
	{
        parent::__construct();
        // Initialize the variables
		$this->db_character = $this->load->database('character', TRUE); 
    }
	
	public function create_character_no($class)
	{
		// Example: A12080520000000001  (18 charts)
		// Same length, but diff result
		// Year, Month, Day, Hour, Min, Sec
		$getdate = date('ymdHis');
		$GetAutoNo = rand(10000, 99999);
		$class_letter = array('0' => "A",'1' => "B",'2' => "C",'3' => "D",'4' => "E",'5' => "F",'6' => "G",'9' => "J",'10' => "K",'11' => "L",'12' => "M");
		return $class_letter[$class] . $getdate . $GetAutoNo;
	}
	
	
	public function CountCharacters()
	{
		$this->db_character->select('user_no');
		$this->db_character->from('user_character');
		$this->db_character->where('user_no', $this->session->userdata('user_no'));
		return $this->db_character->count_all_results();			
	}
	
	public function ListCharacters()
	{
		$query = $this->db_character->query("SELECT * FROM user_character WHERE user_no = '".$this->session->userdata('user_no')."' ");
		return $query->result_array();		
	}
	
	public function ListCharactersMailbox()
	{
		$query = $this->db_character->query("SELECT user_no,character_name,character_no FROM user_character WHERE user_no = '".$this->session->userdata('user_no')."' ");
		return $query->result_array();		
	}	
	
	public function IsYours($charid)
	{
		$query = $this->db_character->query("SELECT character_no,user_no FROM user_character WHERE user_no = '".$this->session->userdata('user_no')."' AND character_no = '".$charid."'");
		if($query->num_rows() == 0)
		{
			return false;
		}
		else
		{
			return true;
		}	
	}
	
	public function UnstuckCharacter($character_no)
	{
		$Y		= $this->config->item('unstuck_move_to_Y');
		$X		= $this->config->item('unstuck_move_to_X');
		$MAP 	= $this->config->item('unstuck_move_to');
		
		$this->db_character->where('character_no', $character_no);
		$this->db_character->update('user_character', array('wMapIndex' => $MAP,'wPosY' => $Y,'wPosX' => $X,)); 	
	}
	
	public function change_name($character_no, $name)
	{		
		$this->db->where('character_no', $character_no);
		$this->db->update('mytable', array('character_name' => $name)); 	
	}
	
	
	public function DisplayCharacter($character_no)
	{
		$query = $this->db_character->query("SELECT * FROM user_character WHERE character_no = '".$character_no."' ");
		if($query->num_rows() == 0)
		{
			return false;
		}
		else
		{
			return $query->row_array();	
		}			
	}
}