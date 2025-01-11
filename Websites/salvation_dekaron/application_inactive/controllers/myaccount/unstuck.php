<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Unstuck extends MY_Controller
{
	function __construct()
	{
        parent::__construct();
		// check if logged in, this is a restricted page
		$this->is_logged_in();
		$this->load->model('m_character');
		$this->load->model('m_account');		
		//$config['unstuck_move_to'] = '182'; // After unstuck was valid, teleport him to this map, can be the home map (ardeca, loa, ....)
		
    }	
	
	public function index()
	{
		
		if($this->m_account->online('SQL'))
		{
			$this->template_data['template']['online'] = false;
		}
		elseif($this->m_character->CountCharacters() == 0)
		{
			$this->template_data['template']['no_chars'] = false;
		}
		else
		{
			$this->template_data['template']['ListCharacters'] = $this->m_character->ListCharacters();
		}
		
		
		$this->template_data['template']['body_id'] = 'account';
        $this->template_data['template']['active_page'] = 'unstuck';
        $this->load->view('myaccount/view_unstuck', $this->template_data);
    }
	
	
	public function DoUnstuck()
	{
        $this->form_validation->set_error_delimiters('<span class="error"> ', '</span><br>');
		$this->form_validation->set_rules('character', 				'Character', 				'trim|required|exact_length[18]|alpha_numeric|callback_IsYours_check|xss_clean');

		if ($this->form_validation->run() == FALSE)
		{
			$this->template_data['template']['ListCharacters'] = $this->m_character->ListCharacters();
			$this->template_data['template']['body_id'] = 'account';
			$this->template_data['template']['active_page'] = 'unstuck';
			$this->load->view('myaccount/view_unstuck', $this->template_data);			 
		}
		else
		{
			$this->template_data['template']['message'] = '<span class="success">Your character was successfully moved.</span>'; 
			$this->template_data['template']['ListCharacters'] = $this->m_character->ListCharacters();
			$this->m_character->UnstuckCharacter($this->input->post('character'));
			
			$this->load->model('m_website');
			$this->m_website->AddLog('Unstuck character '.$this->input->post('character'), $this->session->userdata('user_id'));				
			
			$this->template_data['template']['body_id'] = 'account';
			$this->template_data['template']['active_page'] = 'unstuck';
			$this->load->view('myaccount/view_unstuck', $this->template_data);			
		}
	}
	
	
	
	public function IsYours_check($str)
	{
		$IsYours = $this->m_character->IsYours($str);
		if(!$IsYours)
		{
			$this->form_validation->set_message('IsYours_check', 'This character is not yours!');
			return false;
		}
		else
		{
			return true;
		}
	}
}
?>
