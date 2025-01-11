<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mailbox extends MY_Controller
{
    function __construct()
	{
        parent::__construct();
		// check if logged in, this is a restricted page
		$this->is_logged_in();
    }
		
	public function index()
	{
		// load models
		$this->load->model('m_character');
		$this->template_data['template']['ListCharacters'] = $this->m_character->ListCharactersMailbox();		
		$this->template_data['template']['viewall'] = '0';
		
		$this->template_data['template']['body_id'] = 'account';
		$this->template_data['template']['active_page'] = $this->uri->segment(1);
		$this->load->view('myaccount/view_mailbox', $this->template_data);
	}	
	
	public function view()
	{
		// load models
		$this->load->model('m_character');
		$this->template_data['template']['ListCharacters'] = $this->m_character->ListCharactersMailbox();		
		$this->template_data['template']['viewall'] = '0';
		
		if($this->uri->segment(4) != '')
		{
			$this->load->model('m_mailbox');
			$this->template_data['template']['viewall'] = $this->m_mailbox->ViewAll($this->uri->segment(4));
		}
		
		$this->template_data['template']['body_id'] = 'account';
		$this->template_data['template']['active_page'] = $this->uri->segment(1);
		$this->load->view('myaccount/view_mailbox', $this->template_data);
	}		
}