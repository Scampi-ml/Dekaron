<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Characters extends MY_Controller
{
    function __construct()
	{
        parent::__construct();
		// check if logged in, this is a restricted page
		$this->is_logged_in();
    }
	
	//*******************************
	//	NO SETTINGS FOR NOW :(
	//*******************************
	
		
	public function index()
	{
		$this->load->model('m_character');
		
		if(!$this->m_character->CountCharacters())
		{
			$this->template_data['template']['chars'] = false;
		}
		else
		{
			$this->template_data['template']['chars'] = true;
			$this->template_data['template']['characters'] = $this->m_character->ListCharacters();
		}
		
		
		$this->template_data['template']['body_id'] = 'account';
		$this->template_data['template']['active_page'] = $this->uri->segment(1);
		$this->load->view('myaccount/view_characters', $this->template_data);
	}
	
	public function view()
	{
		$this->load->model('m_character');		
		if(!$this->m_character->IsYours($this->uri->segment(4)))
		{
			die('This character is not yours!');
		}
		else
		{
			$this->template_data['template']['body_id'] = 'account';
			$this->template_data['template']['active_page'] = $this->uri->segment(1);
			$this->load->view('myaccount/view_character_view', $this->template_data);				
		}
	}		
		
}