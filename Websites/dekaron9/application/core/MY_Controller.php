<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    private $data;
	
	function __construct()
	{
        parent::__construct();
		
		$this->data = array();
		
		$site_config = $this->config->item('site');
		$this->smarty->assign("name",				$site_config['name']);
		$this->smarty->assign("keywords",			$site_config['keywords']);
		$this->smarty->assign("author",				$site_config['author']);
		$this->smarty->assign("description",		$site_config['description']);
		$this->smarty->assign("version",			$site_config['version']);
		$this->smarty->assign("support_url",		$site_config['support_url']);
		$this->smarty->assign("forums_url",			$site_config['forums_url']);
		$this->smarty->assign("tos_url",			$site_config['tos_url']);
		$this->smarty->assign("faq_url",			$site_config['faq_url']);
		
		// News default value to prevent errors
		$this->smarty->assign("newsCat",			0);
		$this->smarty->assign("newsTotal",			0);
		
		// Changelog default value to prevent errors
		$this->smarty->assign("changelogCat",		0);
		$this->smarty->assign("changelogTotal",		0);		
		
		$this->smarty->assign("show_social",		$this->ShowSocial());	
    }
	

	
	public function ShowSocial()
	{
		$echo = '';
		if($this->config->item('social_active'))
		{
			$social = $this->config->item('social');
			for($i = 0; $i < count($social); ++$i)
			{
				$echo .= '<a href="'.$social[$i][0].'" target="'.$social[$i][1].'" title="'.$social[$i][2].'"><img src="'.base_url('assets/images/social/'.$social[$i][3].'.png').'" ></a><br>';
			}
		}	
		return $echo;
	}
	
	
	public function showError($error = false)
	{
		$this->data['title'] = 'ERROR!';
		$this->data['error'] = $error;
		$this->smarty->view( 'view_error.tpl', $this->data );
	}		
		
	public function welcome_day()
	{
		$welcome = '';
		$time = date("H");
		$timezone = date("e");
		if ($time < "12"){
			$welcome = "Good morning";
		}elseif ($time >= "12" && $time < "17"){
			$welcome = "Good afternoon";
		}elseif ($time >= "17" && $time < "19"){
			$welcome = "Good evening";
		}elseif ($time >= "19"){
			$welcome = "Good night";
		}
		return $welcome;	
	}
	
	public function landing()
	{
		if(!$this->session->userdata('landing'))
		{
			$user_data['landing'] = 'visited';
			$this->session->set_userdata($user_data);				
			redirect('landing');
		}			
	}
	
}