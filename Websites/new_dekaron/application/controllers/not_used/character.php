<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Character extends MY_Controller
{
	public function index()
	{
		$this->load->model('m_character');
		$this->load->library('l_pcclass');
		
		$DisplayCharacter = $this->m_character->DisplayCharacter('C12090550000000012');
		$this->template_data['template']['DisplayCharacter'] = $DisplayCharacter;
		
		
		$this->template_data['template']['body_id'] = 'character';
		$this->template_data['template']['active_page'] = $this->uri->segment(1);
		$this->load->view('view_character', $this->template_data);
	}
}
