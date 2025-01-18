<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Character extends REST_Controller
{
    
	private $unstuck_to_y = '160';
	private $unstuck_to_x = '100';
	private $unstuck_to_map = '100';
	private $jail_map = '100';
	
	function __construct()
	{
        parent::__construct();
		$this->db = $this->load->database('character', TRUE);
    }	
	
	function CharacterListNum()
	{
		$user_no = $this->get('user_no');	
		if(empty($user_no))
		{
			$data = array('error' => 'Empty user_no');		
		}
		else
		{
			$query = $this->db->query("SELECT character_no FROM user_character WHERE user_no = '".$user_no."' ");	
			$data = array('characters_num' => $query->num_rows());
		}
		$this->response($data, 200); 
	} 	
	
	function CharacterListName()
	{
		$user_no = $this->get('user_no');	
		if(empty($user_no))
		{
			$data = array('error' => 'Empty user_no');		
		}
		else
		{
			$query = $this->db->query("SELECT character_name FROM user_character WHERE user_no = '".$user_no."' ");		
			if($query->num_rows() > 0)
			{
				$data = $query->row_array();
			 }else {
				$data = array('error' => 'No characters found');
			}
		}
		$this->response($data, 200); 
	} 	
	
	
	function GetUnstuck()
	{
		$user_no = $this->get('user_no');	
		if(empty($user_no))
		{
			$data = array('error' => 'Empty user_no');		
		}
		else
		{
			$query = $this->db->query("SELECT character_no,character_name FROM user_character WHERE user_no = '".$user_no."' AND  wMapIndex != '".$this->jail_map."' ");		
			if($query->num_rows() > 0)
			{
				$data = array('ListCharacters' => $query->result_array());
			 }
			 else
			 {
				$data = array('error' => 'No characters found');
			}
		}
		$this->response($data, 200); 
	} 
		
	function DoUnstuck()
	{
		$user_no = $this->get('user_no');	
		$character_no = $this->get('character_no');	
		if(empty($user_no))
		{
			$data = array('error' => 'Empty user_no');		
		}
		else
		{
			$query = $this->db->query("SELECT character_no,character_name,wMapIndex FROM user_character WHERE user_no = '".$user_no."' AND character_no = '".$character_no."' ");
			if($query->num_rows() < 0)
			{
				$data = array('error' => 'This character does not belong to your account.');
			}
			else
			{
				$row = $query->row();
				
				if($row->wMapIndex == $this->jail_map)
				{
					$data = array('error' => 'This character is in jail, you cannot unstuck this character.');
				}
				else
				{
					$this->db->query("UPDATE user_character SET wMapIndex = '".$this->unstuck_to_map."', wPosX = '".$this->unstuck_to_x."', wPosY = '".$this->unstuck_to_y."' WHERE character_no = '".$character_no."' ");
					$data = array('success' => $row->character_name.' was succesfully moved.');				
				}
			}
		}
		$this->response($data, 200);	
	}		
}