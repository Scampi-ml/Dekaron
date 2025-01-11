<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ranking_guild extends MY_Controller
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
		$my_data = $this->cache->file->get('ranking_guild');
		if($my_data === FALSE)
		{		
			$ranking_limit = $this->config->item('ranking_limit');
			
			$this->db_character = $this->load->database('character', TRUE);
			$query = $this->db_character->query("
			SELECT TOP ".$ranking_limit." g.guild_code,g.guild_name,g.guild_Level,g.ipt_date,g.upt_date,
			(SELECT COUNT(*) FROM character.dbo.GUILD_CHAR_INFO WHERE guild_code = g.guild_code) AS guildcount,
			(SELECT character_name FROM character.dbo.GUILD_CHAR_INFO WHERE guild_code = g.guild_code AND peerage_code = '0') AS guildleader
			FROM character.dbo.GUILD_INFO AS g
			ORDER BY guildcount DESC
			");
			$result = $query->result_array();
			$this->cache->file->save('ranking_guild', $result, $this->config->item('ranking_update_interval'));
		}
		else
		{
			$result =  $my_data;
		}
		$this->template_data['template']['players'] = $result;
		
		$this->template_data['template']['body_id'] = 'player-ranking';
		$this->template_data['template']['active_page'] = $this->uri->segment(1);
		$this->load->view('ranks/view_ranking_guild', $this->template_data);

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
				redirect('ranks/ranking_guild', 'refresh'); 					
			}
			else
			{
				die('Wrong or missing password, please try again.');
			}		
		}
	}
	
}