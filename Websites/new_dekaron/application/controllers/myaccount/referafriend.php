<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Referafriend extends MY_Controller
{
    function __construct()
	{
        parent::__construct();
		// check if logged in, this is a restricted page
		$this->is_logged_in();
    }
		
	public function index()
	{
		if($this->config->item('reffer_active'))
		{
			$this->db_website = $this->load->database('website', TRUE); 
			$query = $this->db_website->query("SELECT * FROM user_refferal WHERE user_no = '".$this->session->userdata('user_no')."' ");
			if ($query->num_rows() > 0)
			{
				$this->template_data['template']['reffer_list'] = $query->result_array(); ;
			} 
			else
			{
				$this->template_data['template']['reffer_list'] = FALSE;
			}	
		}
		else
		{
			$this->template_data['template']['reffer_list'] = FALSE;
		}	
		$this->template_data['template']['body_id'] = 'account';
		$this->template_data['template']['active_page'] = $this->uri->segment(1);
		$this->load->view('myaccount/view_referafriend', $this->template_data);
	}
}