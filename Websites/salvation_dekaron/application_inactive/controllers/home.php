<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller
{
	function __construct()
	{
        parent::__construct();
		// check if logged in, this is a restricted page
		$this->load->driver('cache');
		$this->db_character = $this->load->database('character', TRUE);
    }	
	
	public function index()
	{
		// rankings
		$this->template_data['template']['ranking1'] = $this->RankingTop10Level();
		$this->template_data['template']['ranking2'] = $this->RankingTop10PVPWin();
		
		
		$this->template_data['template']['body_id'] = 'portal';
		$this->template_data['template']['active_page'] = $this->uri->segment(1);
		$this->load->view('view_home', $this->template_data);
	}
	
	public function RankingTop10Level()
	{
		$my_data = $this->cache->file->get('ranking_level_10');
		if($my_data === FALSE)
		{		
			$query = $this->db_character->query("
				SELECT TOP 10
				  user_character.character_name,
				  user_character.wLevel,
				  user_character.byPCClass,
				  user_character.character_no,
				  GUILD_CHAR_INFO.guild_code,
				  GUILD_INFO.guild_name
				FROM
				  user_character
				  LEFT JOIN GUILD_CHAR_INFO ON (user_character.character_name = GUILD_CHAR_INFO.character_name)
				  LEFT JOIN GUILD_INFO ON (GUILD_CHAR_INFO.guild_code = GUILD_INFO.guild_code)
				WHERE
				  (user_character.character_name NOT LIKE '[[]%]%')
				ORDER BY
				  wLevel DESC
			");
			$result = $query->result_array();
			$this->cache->file->save('ranking_level_10', $result, $this->config->item('ranking_update_interval'));
		}
		else
		{
			$result =  $my_data;
		}
		return $result;	
	}
	
	public function RankingTop10PVPWin()
	{
		$my_data = $this->cache->file->get('ranking_pvp_win_10');
		if($my_data === FALSE)
		{		
			$query = $this->db_character->query("
				SELECT TOP 10 
				  user_character.character_name,
				  user_character.wWinRecord,
				  user_character.byPCClass,
				  user_character.character_no,
				  GUILD_CHAR_INFO.guild_code,
				  GUILD_INFO.guild_name
				FROM
				  user_character
				  LEFT JOIN GUILD_CHAR_INFO ON (user_character.character_name = GUILD_CHAR_INFO.character_name)
				  LEFT JOIN GUILD_INFO ON (GUILD_CHAR_INFO.guild_code = GUILD_INFO.guild_code)
				WHERE
				  (user_character.character_name NOT LIKE '[[]%]%')
				ORDER BY
				  wWinRecord DESC
			");
			$result = $query->result_array();
			$this->cache->file->save('ranking_pvp_win_10', $result, $this->config->item('ranking_update_interval'));
		}
		else
		{
			$result =  $my_data;
		}
		return $result;
	
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */