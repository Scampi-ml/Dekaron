<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Online extends MY_Controller
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
		$my_data = $this->cache->file->get('online');
		if($my_data === FALSE)
		{		
			$ranking_limit = $this->config->item('ranking_limit');
			
			$this->db_character = $this->load->database('character', TRUE);
			$query = $this->db_character->query("
			SELECT 
			  c.character_name,
			  c.byPCClass,
			  c.character_no,
			  c.wLevel,
			  dbo.GUILD_INFO.guild_name
			FROM
			  character.dbo.user_character c
			  INNER JOIN account.dbo.user_profile p ON (c.user_no = p.user_no)
			  LEFT OUTER JOIN dbo.GUILD_CHAR_INFO ON (c.character_name = dbo.GUILD_CHAR_INFO.character_name)
			  LEFT OUTER JOIN dbo.GUILD_INFO ON (dbo.GUILD_CHAR_INFO.guild_code = dbo.GUILD_INFO.guild_code)
			WHERE
			  (c.login_time IN (SELECT max(character.dbo.user_character.login_time) AS FIELD_1 FROM character.dbo.user_character GROUP BY user_no)) AND 
			  (p.login_flag = '1100') AND 
			  (c.character_name > ']')
			ORDER BY
			  c.wLevel DESC
			");
			$result = $query->result_array();
			$this->cache->file->save('online', $result, $this->config->item('ranking_update_interval'));
		}
		else
		{
			$result =  $my_data;
		}
		$this->template_data['template']['players'] = $result;
		
		$this->template_data['template']['body_id'] = 'player-ranking';
		$this->template_data['template']['active_page'] = $this->uri->segment(1);
		$this->load->view('ranks/view_online', $this->template_data);

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