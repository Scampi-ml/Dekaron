<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Deadfront extends MY_Controller
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
		$my_data = $this->cache->file->get('deadfront');
		if($my_data === FALSE)
		{		
			$query = $this->db_character->query("SELECT * FROM CM_BCD_ITEM ");
			$result = $query->result_array();
			$this->cache->file->save('deadfront', $result, $this->config->item('siege_update_interval'));
		}
		else
		{
			$result =  $my_data;
		}
		$this->template_data['template']['deadfront'] = $result;	
				
		
		
		
	
		
		
		
		$this->template_data['template']['body_id'] = 'arsenal';
		$this->template_data['template']['active_page'] = $this->uri->segment(1);
		$this->load->view('ranks/view_deadfront', $this->template_data);
	}
}