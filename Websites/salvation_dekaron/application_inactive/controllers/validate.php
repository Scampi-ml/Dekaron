<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Validate extends MY_Controller
{
    function __construct()
	{
        parent::__construct();
		// check if logged in, this is a restricted page
		$this->db_account = $this->load->database('account', TRUE);
		$this->db_website = $this->load->database('website', TRUE);
    }	
	
		
	public function email()
	{
		$confirm_key = strtoupper($this->uri->segment(3));
		
		if($confirm_key == '')
		{
			$this->template_data['template']['error_message'] = 'Missing Validation Key';	
			$this->template_data['template']['error'] = FALSE;			
		}
		elseif(strlen($confirm_key) != '32')
		{
			$this->template_data['template']['error_message'] = 'Invalid Validation Key (Key should be 18 characters long)';	
			$this->template_data['template']['error'] = FALSE;	
		}
		elseif($this->alnum($confirm_key) == false)
		{
			$this->template_data['template']['error_message'] = 'Invalid Validation Key (Can only be A-Z / 0-9)';	
			$this->template_data['template']['error'] = FALSE;	
		}
		else
		{
			$query = $this->db_website->query("SELECT * FROM user_validate WHERE token = '".$confirm_key."' ");
			if($query->num_rows() == 0)
			{
				$this->template_data['template']['error_message'] = 'Validation Key was not found';	
				$this->template_data['template']['error'] = FALSE;	
			}
			else
			{
				// check if already validate
				$row = $query->row();
				
				if($row->validated == '1')
				{
					$this->template_data['template']['error_message'] = 'You have already validated your account.';	
					$this->template_data['template']['error'] = FALSE;					
				}
				else
				{
					// set valid to DB
					$this->db_account->query("UPDATE user_profile SET login_tag = 'Y' WHERE user_no = '".$row->user_no."' ");
					$this->db_website->query("DELETE FROM user_validate WHERE token = '".$confirm_key."' ");				
					$this->template_data['template']['error'] = TRUE;
				}
			}			
		}
		$this->template_data['template']['body_id'] = 'register-panel';
		$this->template_data['template']['active_page'] = $this->uri->segment(1);
		$this->load->view('view_validate_email', $this->template_data);
	}
	
	
	public function alnum($string)
	{
		if(preg_match('/[^a-zA-Z0-9]/', $string) == 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}		
}