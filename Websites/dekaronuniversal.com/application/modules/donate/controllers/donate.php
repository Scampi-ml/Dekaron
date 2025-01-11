<?php
class Donate extends MX_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->config('donate');
	}
	
	public function index()
	{
		requirePermission("view");
		$this->template->setTitle(lang("donate_title", "donate"));
		$donate_paypal = $this->config->item('donate_paypal');
		$data = array(
			"donate_paypal" => $donate_paypal, 
			"server_name" => $this->config->item('server_name'),
			"currency" => $this->config->item('donation_currency'),
			"currency_sign" => $this->config->item('donation_currency_sign'),
			"multiplier" => $this->config->item('donation_multiplier'),
			"url" => pageURL
		);

		$output = $this->template->loadPage("donate.tpl", $data);
		$this->template->box("<span style='cursor:pointer;' onClick='window.location=\"".$this->template->page_url."ucp\"'>".lang("ucp")."</span> &rarr; ".lang("donate_panel", "donate"), $output, true, "modules/donate/css/donate.css", "modules/donate/js/donate.js");
	}

	public function success()
	{
		$page = $this->template->loadPage("success.tpl", array('url' => $this->template->page_url));
		$this->template->box(lang("donate_thanks", "donate"), $page, true);
	}
	
	public function character_name_check($character_name)
	{
		if(preg_match("/^[a-zA-Z0-9]+$/", $character_name) != 1)
		{
			die("0");
		}		
		
		$res = $this->conn->api("CharacterExists", array("character_name" => $character_name));	
		if($res->result === 'true')
		{
			die("1");
		}
		else
		{
			die("0");		
		}
	}	
	
}
