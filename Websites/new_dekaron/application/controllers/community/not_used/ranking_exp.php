<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ranking_exp extends MY_Controller
{	
	
	function __construct()
	{
        parent::__construct();
		// check if logged in, this is a restricted page
		$this->load->library('l_pcclass');
		$this->load->driver('cache');
    }	
	
	public function index()
	{
		$my_data = $this->cache->file->get('ranking_exp');
		if($my_data === FALSE)
		{		
			$ranking_limit = $this->config->item('ranking_limit');
			
			$this->db_character = $this->load->database('character', TRUE);
			$query = $this->db_character->query("
				SELECT TOP ".$ranking_limit." 
				  user_character.character_name,
				  user_character.dwExp,
				  user_character.byPCClass,
				  user_character.character_no,
				  user_character.wLevel,
				  GUILD_CHAR_INFO.guild_code,
				  GUILD_INFO.guild_name
				FROM
				  user_character
				  LEFT JOIN GUILD_CHAR_INFO ON (user_character.character_name = GUILD_CHAR_INFO.character_name)
				  LEFT JOIN GUILD_INFO ON (GUILD_CHAR_INFO.guild_code = GUILD_INFO.guild_code)
				WHERE
				  (user_character.character_name NOT LIKE '[[]%]%')
				ORDER BY
				  dwExp DESC
			");
			$result = $query->result_array();
			$this->cache->file->save('ranking_exp', $result, $this->config->item('ranking_update_interval'));
		}
		else
		{
			$result =  $my_data;
		}
		$this->template_data['template']['players'] = $result;
		
		$this->template_data['template']['body_id'] = 'player-ranking';
		$this->template_data['template']['active_page'] = $this->uri->segment(1);
		$this->load->view('ranks/view_ranking_exp', $this->template_data);

	}
	
	public function Force()
	{
		if(!$this->config->item('ranking_force_update'))
		{
			die('This function is currently disabled!');
		}
		else
		{
			$get_password = $this->uri->segment(4);
			if($get_password == $this->config->item('ranking_force_update_password'))
			{
				$this->cache->file->delete('ranking_level');
				echo "<script type='text/javascript'>alert('Cache has been cleaned!');</script>";
				redirect('ranks/ranking_exp', 'refresh'); 					
			}
			else
			{
				die('Wrong or missing password, please try again.');
			}		
		}
	}
	
}