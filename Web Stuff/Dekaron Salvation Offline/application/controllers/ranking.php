<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ranking extends MY_Controller{

	private $data = array();
	private $ranking = array();
	private $ttl = 3600; // TTL = Time To Live
	
	function __construct(){
        parent::__construct();
		$this->data['title'] = 'Ranking';
		$this->load->library('cache');
		$this->load->library('pcclass');
		$this->load->library('wgrade');
		$this->load->library('api', array('server' => $this->config->item('api_url')));		
	}
	
	public function index(){
		$this->smarty->view( 'view_ranking.tpl', $this->data );
	}
	
	public function ByExp()
	{
		$cache = $this->cache->get('ByExp');
		if(!$cache){
			$api_rank = $this->api->get('Ranking/ByExp', array(), 'json');	
			if(isset($api_rank->status) && $api_rank->status == 'true')
			{
				$data = json_decode(json_encode($api_rank->data), true);
				$this->cache->save('ByExp', $data, $this->ttl);		
			} else {
				show_error('API is offline');
			}	
			redirect('ranking/ByExp', 'refresh');
		} else {
			$i = '1';
			foreach($cache as $key => $value) {
				$this->ranking[$key]['nr'] = $i;
				$this->ranking[$key]['guild_name'] = $value['guild_name'];
				$this->ranking[$key]['character_name'] = $value['character_name'];
				$this->ranking[$key]['dwExp'] = number_format($value['dwExp']);
				$this->ranking[$key]['byPCClass'] = $this->pcclass->class2name($value['byPCClass']);
				$i++;
			}
			$this->data['ranking'] = $this->ranking;			
		}
		$this->smarty->view( 'view_ranking_exp.tpl', $this->data );		
	}
	
	public function ByGrade()
	{
		$cache = $this->cache->get('ByGrade');
		if(!$cache){
			$api_rank = $this->api->get('Ranking/ByGrade', array(), 'json');	
			if(isset($api_rank->status) && $api_rank->status == 'true')
			{
				$data = json_decode(json_encode($api_rank->data), true);
				$this->cache->save('ByGrade', $data, $this->ttl);		
			} else {
				show_error('API is offline');
			}	
			redirect('ranking/ByGrade', 'refresh');			
		} else {
			$i = '1';
			foreach($cache as $key => $value) {
				$this->ranking[$key]['nr'] = $i;
				$this->ranking[$key]['guild_name'] = $value['guild_name'];
				$this->ranking[$key]['character_name'] = $value['character_name'];
				$this->ranking[$key]['wGrade'] = $this->wgrade->number2grade($value['wGrade']);
				$this->ranking[$key]['byPCClass'] = $this->pcclass->class2name($value['byPCClass']);
				$i++;
			}
			$this->data['ranking'] = $this->ranking;			
		}
		$this->smarty->view( 'view_ranking_grade.tpl', $this->data );		
	}
	
	public function ByPk()
	{
		$cache = $this->cache->get('ByPk');
		if(!$cache){
			$api_rank = $this->api->get('Ranking/ByPk', array(), 'json');	
			if(isset($api_rank->status) && $api_rank->status == 'true')
			{
				$data = json_decode(json_encode($api_rank->data), true);
				$this->cache->save('ByPk', $data, $this->ttl);		
			} else {
				show_error('API is offline');
			}	
			redirect('ranking/ByPk', 'refresh');			
		} else {
			$i = '1';
			foreach($cache as $key => $value) {
				$this->ranking[$key]['nr'] = $i;
				$this->ranking[$key]['guild_name'] = $value['guild_name'];
				$this->ranking[$key]['character_name'] = $value['character_name'];
				$this->ranking[$key]['wPKCount'] = number_format($value['wPKCount']);
				$this->ranking[$key]['byPCClass'] = $this->pcclass->class2name($value['byPCClass']);
				$i++;
			}
			$this->data['ranking'] = $this->ranking;			
		}
		$this->smarty->view( 'view_ranking_pk.tpl', $this->data );		
	}
	
	public function ByPvPWin()
	{
		$cache = $this->cache->get('ByPvPWin');
		if(!$cache){
			$api_rank = $this->api->get('Ranking/ByPvPWin', array(), 'json');	
			if(isset($api_rank->status) && $api_rank->status == 'true')
			{
				$data = json_decode(json_encode($api_rank->data), true);
				$this->cache->save('ByPvPWin', $data, $this->ttl);		
			} else {
				show_error('API is offline');
			}	
			redirect('ranking/ByPvPWin', 'refresh');			
		} else {
			$i = '1';
			foreach($cache as $key => $value) {
				$this->ranking[$key]['nr'] = $i;
				$this->ranking[$key]['guild_name'] = $value['guild_name'];
				$this->ranking[$key]['character_name'] = $value['character_name'];
				$this->ranking[$key]['wWinRecord'] = number_format($value['wWinRecord']);
				$this->ranking[$key]['byPCClass'] = $this->pcclass->class2name($value['byPCClass']);
				$i++;
			}
			$this->data['ranking'] = $this->ranking;			
		}
		$this->smarty->view( 'view_ranking_pvpw.tpl', $this->data );		
	}

	public function ByPvPLose()
	{
		$cache = $this->cache->get('ByPvPLose');
		if(!$cache){
			$api_rank = $this->api->get('Ranking/ByPvPLose', array(), 'json');	
			if(isset($api_rank->status) && $api_rank->status == 'true')
			{
				$data = json_decode(json_encode($api_rank->data), true);
				$this->cache->save('ByPvPLose', $data, $this->ttl);		
			} else {
				show_error('API is offline');
			}	
			redirect('ranking/ByPvPLose', 'refresh');			
		} else {
			$i = '1';
			foreach($cache as $key => $value) {
				$this->ranking[$key]['nr'] = $i;
				$this->ranking[$key]['guild_name'] = $value['guild_name'];
				$this->ranking[$key]['character_name'] = $value['character_name'];
				$this->ranking[$key]['wLoseRecord'] = number_format($value['wLoseRecord']);
				$this->ranking[$key]['byPCClass'] = $this->pcclass->class2name($value['byPCClass']);
				$i++;
			}
			$this->data['ranking'] = $this->ranking;			
		}
		$this->smarty->view( 'view_ranking_pvpl.tpl', $this->data );		
	}
	
	public function ByPvPTotal()
	{
		$cache = $this->cache->get('ByPvPTotal');
		if(!$cache){
			$api_rank = $this->api->get('Ranking/ByPvPTotal', array(), 'json');	
			if(isset($api_rank->status) && $api_rank->status == 'true')
			{
				$data = json_decode(json_encode($api_rank->data), true);
				$this->cache->save('ByPvPTotal', $data, $this->ttl);		
			} else {
				show_error('API is offline');
			}	
			redirect('ranking/ByPvPTotal', 'refresh');			
		} else {
			$i = '1';
			foreach($cache as $key => $value) {
				$this->ranking[$key]['nr'] = $i;
				$this->ranking[$key]['guild_name'] = $value['guild_name'];
				$this->ranking[$key]['character_name'] = $value['character_name'];
				$this->ranking[$key]['total'] = number_format($value['total']);
				$this->ranking[$key]['byPCClass'] = $this->pcclass->class2name($value['byPCClass']);
				$i++;
			}
			$this->data['ranking'] = $this->ranking;			
		}
		$this->smarty->view( 'view_ranking_pvpt.tpl', $this->data );		
	}
	
	public function ByPpoint()
	{
		$cache = $this->cache->get('ByPpoint');
		if(!$cache){
			$api_rank = $this->api->get('Ranking/ByPpoint', array(), 'json');	
			if(isset($api_rank->status) && $api_rank->status == 'true')
			{
				$data = json_decode(json_encode($api_rank->data), true);
				$this->cache->save('ByPpoint', $data, $this->ttl);		
			} else {
				show_error('API is offline');
			}	
			redirect('ranking/ByPpoint', 'refresh');			
		} else {
			$i = '1';
			foreach($cache as $key => $value) {
				$this->ranking[$key]['nr'] = $i;
				$this->ranking[$key]['guild_name'] = $value['guild_name'];
				$this->ranking[$key]['character_name'] = $value['character_name'];
				$this->ranking[$key]['dwLowAllRPoint'] = number_format($value['dwLowAllRPoint']);
				$this->ranking[$key]['byPCClass'] = $this->pcclass->class2name($value['byPCClass']);
				$i++;
			}
			$this->data['ranking'] = $this->ranking;			
		}
		$this->smarty->view( 'view_ranking_ppoint.tpl', $this->data );		
	}
	
	public function ByGuild()
	{
		$cache = $this->cache->get('ByGuild');
		if(!$cache){
			$api_rank = $this->api->get('Ranking/ByGuild', array(), 'json');	
			if(isset($api_rank->status) && $api_rank->status == 'true')
			{
				$data = json_decode(json_encode($api_rank->data), true);
				$this->cache->save('ByGuild', $data, $this->ttl);		
			} else {
				show_error('API is offline');
			}	
			redirect('ranking/ByGuild', 'refresh');			
		} else {
			$i = '1';
			foreach($cache as $key => $value) {
				$this->ranking[$key]['nr'] = $i;
				$this->ranking[$key]['guild_name'] = $value['guild_name'];
				$this->ranking[$key]['guild_Level'] = $value['guild_Level'];
				$this->ranking[$key]['members'] = $value['members'];
				$i++;
			}
			$this->data['ranking'] = $this->ranking;			
		}
		$this->smarty->view( 'view_ranking_guild.tpl', $this->data );		
	}
	
	
	
	
}