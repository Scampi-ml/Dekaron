<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Siege extends MY_Controller
{	
	
	function __construct()
	{
        parent::__construct();
		$this->load->driver('cache');
		$this->db_character = $this->load->database('character', TRUE);
    }	
	
	public function index()
	{
		
		// siege time (next)
		$my_data = $this->cache->file->get('siege_time');
		if($my_data === FALSE)
		{		
			$ranking_limit = $this->config->item('ranking_limit');
			
			
			$query = $this->db_character->query("SELECT TOP 1 character.dbo.FN_BinDateToDateTime(dwStartTime) as time FROM SIEGE_INFO WHERE CHANNEL_NO = '1' AND SIEGE_TAG = 'Y' ORDER BY time ASC");
			$result = $query->row_array();
			$this->cache->file->save('siege_time', $result, $this->config->item('siege_update_interval'));
		}
		else
		{
			$result =  $my_data;
		}
		$this->template_data['template']['next_siege'] = $result;	
		
		
		// siege winner (next)
		$my_data = $this->cache->file->get('siege_winner');
		if($my_data === FALSE)
		{		
			$ranking_limit = $this->config->item('ranking_limit');
			
			$this->db_character = $this->load->database('character', TRUE);
			$query = $this->db_character->query("SELECT GUILD_NAME from SIEGE_INFO WHERE SIEGE_TAG = 'Y'	");
			$result = $query->row_array();
			$this->cache->file->save('siege_winner', $result, $this->config->item('siege_update_interval'));
		}
		else
		{
			$result =  $my_data;
		}
		$this->template_data['template']['siege_winner'] = $result;				
		
		
		
	
		
		
		
		$this->template_data['template']['body_id'] = 'arsenal';
		$this->template_data['template']['active_page'] = $this->uri->segment(1);
		$this->load->view('ranks/view_siege', $this->template_data);
	}
}