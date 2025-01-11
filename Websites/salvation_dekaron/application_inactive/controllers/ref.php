<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Ref extends MY_Controller
{
    function __construct()
	{
        parent::__construct();
    }	
	
	public function id()
	{
		$ref_id = $this->uri->segment(3);
		
		if(!is_numeric($ref_id))
		{
			// this is not a valid ref_id
			die('NOT_VALID');
			redirect('home');
		}
		elseif(strlen($ref_id) != '14')
		{
			// this is not a valid ref_id
			die('NOT_VALID2');
			redirect('home');
		}
		else
		{
			// this is a valid ref_id
			$user_data['ref_id'] = $ref_id;					
			$this->session->set_userdata($user_data);
			
			
			$this->template_data['template']['body_id'] = 'howtoconnect';
			$this->template_data['template']['active_page'] = $this->uri->segment(1);
			$this->load->view('view_reff_done', $this->template_data);			
			//redirect('home', 'refresh');			
		}
	}
}