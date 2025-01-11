<?php

class Reborn extends MX_Controller 
{
	private $characters;
	private $total;

	public function __construct()
	{
		parent::__construct();
		$this->user->userArea();
		$this->load->model('reborn_model');
		$this->load->config('reborn');
		$this->characters = $this->user->getCharacters($this->user->getId());
		$this->total = count($this->characters);
	}	
	public function index()
	{
		requirePermission("view");
		
		$this->template->setTitle("Reborn");
		$content_data = array(
			"cost" 			=> $this->config->item('cost'),
			"MaxRb" 		=> $this->config->item('MaxRb'),
			"JailMapIndex"	=> $this->config->item('JailMapIndex'),
			"RbLevel"		=> $this->config->item('RbLevel'),
			"characters" 	=> $this->characters,
			"url" 			=> $this->template->page_url,
			"total" 		=> $this->total,
		);
		
		$page_content = $this->template->loadPage("reborn.tpl", $content_data);	
		$page_data = array(
			"module" => "default", 
			"headline" => "<span style='cursor:pointer;' onClick='window.location=\"".$this->template->page_url."ucp\"'>".lang("ucp")."</span> &rarr; Reborn", 
			"content" => $page_content
		);
		
		$page = $this->template->loadPage("page.tpl", $page_data);
		$this->template->view($page, false, "modules/reborn/js/reborn.js");
		
	}
	
	public function submit()
	{
		$fields = array(
			'character_no' 	=> $this->input->post('character_no'),
			'user_no'	 	=> $this->user->getId(),
			'private' 		=> "true"
		);	
		$res = $this->conn->api("getCharacter", $fields);
		
		if(isset($res->error) && $res->error == 'not_found')
		{
			die('This character is not yours!');
		}
		elseif(isset($res->error)) 
		{
			die($res->error);	
		}
		else
		{
			$fields2 = array(
				//'character_no' 	=> 'C14050590000000092',
				'character_no' 	=> $this->input->post('character_no'),
				'wPosX' 		=> $this->config->item('wPosX'),
				'wPosY' 		=> $this->config->item('wPosY'),
				'wMapIndex' 	=> $this->config->item('wMapIndex'),
				'cost' 			=> $this->config->item('cost'),
				'MaxRb' 		=> $this->config->item('MaxRb'),
				'JailMapIndex'	=> $this->config->item('JailMapIndex'),
				'RbLevel'		=> $this->config->item('RbLevel')
			);
			$res2 = $this->conn->api("doReborn", $fields2);			
			if(isset($res2->error))
			{
				die($res2->error);	
			}
			else
			{
				die('1');	
			}
		}
	}
}