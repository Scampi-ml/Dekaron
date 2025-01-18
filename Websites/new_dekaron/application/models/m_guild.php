<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_guild extends MY_model {
	
	public function create()
	{
	}
	
	public function add_to_guild()
	{
		
	}		
	
	public function count_members()
	{
		$this->db->select('user_no');
		$this->db->from('user_character');
		$this->db->where('user_no', $this->session->userdata('user_no'));
		return $this->db->count_all_results();			
	}
	
	public function in_guild()
	{
		// get name from the array
		$character_array =  $this->session->userdata('character');
		
		
		$query = $this->db->query('SELECT * FROM guild_char_info WHERE character_name = "'.trim($character_array['character_name']).'" ');		
		if($query->num_rows() > 0)
		{
			// get the data
			$row = $query->row(); 
			
			// get even more data
			$query2 = $this->db->query('SELECT * FROM guild_info WHERE guild_code = "'.$row->guild_code.'" ');
			$row2 = $query2->row(); 
			
			// create new array
			$newdata = array();

			// -------------------------------- insert 1ste part of guild
			$newdata['guild_code'] = 			$row->guild_code;		
			//$newdata['character_name'] = 		$row->nHP;						// DUPE! Do not want!
			$newdata['peerage_code'] = 			$row->peerage_code;
			
			// -------------------------------- insert 2nd part of guild
			//$newdata['guild_code'] = 			$row2->guild_code;				// DUPE! Do not want!
			$newdata['guild_name'] = 			$row2->guild_name;
			//$newdata['guild_serv_id'] = 		$row2->XXXXXXXX;				// Not needed to be loaded into the session
			//$newdata['guild_Level'] = 		$row2->guild_Level;				// Not needed for now
			//$newdata['guild_Dil'] = 			$row2->guild_Dil;				// Not needed for now
			//$newdata['guild_adv'] = 			$row2->guild_adv;				// Not needed for now
			//$newdata['guild_mark1'] = 		$row2->guild_mark1;				// Not needed for now
			//$newdata['guild_mark2'] = 		$row2->guild_mark2;				// Not needed for now
			//$newdata['guild_notice'] = 		$row2->XXXXXXXX; 				// dont load this into the session
			//$newdata['ipt_date'] = 			$row2->XXXXXXXX;				// Not needed to be loaded into the session
			//$newdata['upt_date'] = 			$row2->XXXXXXXX;				// Not needed to be loaded into the session
			//$newdata['guild_effect'] = 		$row2->guild_effect;			// Not needed for now
			//$newdata['bystate'] = 			$row2->XXXXXXXX;				// wtf is this shit ?
			//$newdata['bychannel'] = 			$row2->XXXXXXXX;				// wtf is this shit ?
			
			// maybe add peerage names?
		
			// load into session
			$this->session->set_userdata('guild', $newdata);
		}
		else
		{
			// no guild
			$this->session->set_userdata('guild', 'none');
		}
	}
	
	
	public function change_permissions()
	{				
	}
	
	public function delete()
	{		
	}

}