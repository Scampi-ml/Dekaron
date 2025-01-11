<?php
class User
{
	private $CI;
	
	public function __construct()
	{
		$this->CI = &get_instance();
	}
	
	public function setUserDetails()
	{

	}


	public function adminName()
	{
		return $this->CI->config->item('admin_nickname');
	}

	public function isOnline()
	{
		return false;
	}

	public function userArea()
	{
		if(!$this->online)
		{
			$this->CI->template->view($this->CI->template->loadPage("page.tpl", array(
				"module" => "default", 
				"headline" => lang("denied"), 
				"content" => "<center style='margin:10px;font-weight:bold;'>You must be signed in to view this page!</center>"
			)));
		}
		return;
	}

	public function guestArea()
	{
		if($this->online)
		{
			$this->CI->template->view($this->CI->template->loadPage("page.tpl", array(
				"module" => "default", 
				"headline" => lang("denied"), 
				"content" => "<center style='margin:10px;font-weight:bold;'>You are already signed in!</center>"
			)));
		}
		return;
	}

}
