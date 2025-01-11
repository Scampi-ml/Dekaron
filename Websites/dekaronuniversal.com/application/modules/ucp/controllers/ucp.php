<?php
class Ucp extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->user->userArea();
		$this->load->config('links');
		$this->load->library('gravatar');
		$this->load->model('ucp_model');
	}

	public function index()
	{
		requirePermission("view");
		$this->template->setTitle(lang("user_panel", "ucp"));
		$cache = $this->cache->get("profile_characters_".$this->session->userdata('id'));

		if($cache !== false){
			$characters = $cache;
		}else{
			$chars = $this->user->getCharacters($this->session->userdata('id'));
			if(isset($chars['error']) || $chars == NULL){$chars = '';}
			$characters_data = array(
				"characters" => $chars,
				"url" => $this->template->page_url
			);
			$characters = $this->template->loadPage("ucp_characters.tpl", $characters_data);
			$this->cache->save("profile_characters_".$this->session->userdata('id'), $characters, 60*60);
		}		
		
		
		$data = array(
			"username" => $this->session->userdata('username'),
			"url" => $this->template->page_url,
			"playtime" => $this->ucp_model->countPlayTime(),
			"coins" => $this->ucp_model->getCashByUserNo(),
			"groups" => $this->acl_model->getGroupsByUser($this->session->userdata('id')),
			"avatar" => $this->gravatar->get_gravatar($this->session->userdata('email'), 120),
			"id" => $this->user->getId(),
			"characters" => $characters,
			"ucp_modules" => $this->ucp_model->getUcpModules(),
			"voting_points" => '0',
			"donation_points" => '0',
			"account_status" => 'Active',
			"member_since" => $this->userno2date($this->session->userdata('id')),
			"config" => array(
				"admin" => $this->config->item('ucp_admin'),
			)
		);
		
		$this->template->view($this->template->loadPage("page.tpl", array(
			"module" => "default", 
			"headline" => lang("user_panel", "ucp"), 
			"content" => $this->template->loadPage("ucp.tpl", $data)
		)), "modules/ucp/css/ucp.css");
	}
	
	private function userno2date($userno)
	{
		$count = strlen($userno);
		if($count == '14'){
			$array = str_split($userno,2);
			$return = '20' . $array[0] .'-' . $array[1] . '-' . $array[2]; 
		}else{
			$return = "NA";
		}
		return $return;
	}	
}
