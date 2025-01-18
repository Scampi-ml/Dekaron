<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends REST_Controller
{
    function __construct()
	{
        parent::__construct();
		$this->db = $this->load->database('account', TRUE);
    }
	
	function Login()	
	{
		$user_id = $this->get('user_id');	
		$user_pwd = $this->get('user_pwd');	
		if($user_id || $user_pwd)
		{
			$query = $this->db->query("SELECT user_mail,user_id,user_no,login_tag,login_flag FROM user_profile WHERE user_id = '".$user_id."' AND user_pwd = '".$user_pwd."' ");		
			if( $query->num_rows() > 0 )
			{
				$data = $query->row_array();
			}
			else
			{
				$data = array('error' => 'Username and password match not found.');
			}
		}
		else
		{
			$data = array('error' => 'Empty user_id and user_pwd');	
		}
		$this->response($data, 200); 
	} 	
	
	function Online()
	{
		$user_no = $this->get('user_no');	
		if( empty( $user_no ) )
		{
			$data = array('error' => 'Empty user_no');		
		}
		else
		{
			$query = $this->db_account->query("SELECT login_flag FROM dbo.USER_PROFILE WHERE user_no = '".$user_no."' ");		
			if($query->num_rows() > 0)
			{	
				$row = $query->row();
				$data = array('login_flag' => $row->login_flag);
			}
			else
			{ 
				$data = array('error' => 'Unable to find login_flag');
			}
		}
		$this->response($data, 200); 
	}			
}