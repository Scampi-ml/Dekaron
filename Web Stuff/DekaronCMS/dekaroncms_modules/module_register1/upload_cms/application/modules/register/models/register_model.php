<?php

class Register_model extends CI_Model 
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function getConfig()
	{
		$query = $this->db->query("SELECT * FROM module_config WHERE module_name = 'register' ");
		if($query->num_rows() > 0)
		{
			$result = $query->result_array();
			return $result;
		}
		else
		{
			return false;
		}
	}

	public function updateSetting($module_name, $key, $value)
	{
		$this->db->where('key', $key);
		$this->db->update('module_config',  array('key' => $key,'value' => $value));				
	}	

	// API Connection
	public function register_api($data)
	{
		$connect = array(
			'server' => $this->config->item('api_server'),
			'http_user' => $this->config->item('api_http_user'),
			'http_pass' => $this->config->item('api_http_pass'),
			'http_auth' => $this->config->item('api_http_auth'),
		);	
		$this->load->library('rest', $connect);	

		$api = $this->rest->get('register', $data, $type = 'json');	
		return  ($api == 'null' ? false : $api);
	}


	// Local Connection
	public function register_local($data)
	{	
		$username 	= $data['username'];
		$password 	= $data['password'];
		$email 		= strtolower($data['email']);

		if(!$this->email_check($email))
		{
			return json_encode(array('error' => 'The selected email is not available'));	
		}
		elseif(!$this->account_check($username))
		{		
			return json_encode(array('error' => 'The selected username is not available'));	
		}
		else
		{
			$user_no = $this->CreateUserNo();

			$this->db = $this->load->database('account', TRUE);	
			$sql1 = $this->db->query("	
			INSERT INTO [dbo].[USER_PROFILE]
				   (user_no,user_id,user_pwd,resident_no,user_type,login_flag,login_tag,server_id,user_country,user_gender,user_gm,user_admin,user_reg_date,user_age,user_sn,user_mail)
			 VALUES
				   ('".$user_no."','".$username."','".$password."','801011000000','1','0','Y','000','0','0','0','0','".time()."','0','".$this->createNewid(12, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ01234567890')."','".$email."')
			");
			
			if(!$sql1)
			{
				return json_encode(array('error' => 'SQL_FAIL'));		
			}
			else
			{
				return json_encode(array('result' => 'ok'));
			}
			
		}
		$this->response($this->data, 200);	
	}


	private function createNewid($length = 0, $characters = 12)
	{
		if ($characters == ''){ return ''; }
		$chars_length = strlen($characters)-1;
		mt_srand((double)microtime()*1000000);
		$newid = '';
		while(strlen($newid) < $length){
			$rand_char = mt_rand(0, $chars_length);
			$newid .= $characters[$rand_char];
		}
		return $newid;
	}	
	
	private function CreateUserNo()
	{
		$dk_time = strftime("%y%m%d%H%M%S");
		$regdate = strftime("%y%m%d");
		list($usec1, $sec1) = explode(" ",microtime());
		$dk_user_no = $dk_time.substr($usec1, 2, 2);	
		return $dk_user_no;
	}

	private function email_check($str = '')
	{
		$this->db = $this->load->database('account', TRUE);
		$query = $this->db->query("SELECT user_mail FROM user_profile WHERE user_mail = '".$str."'");
		if($query->num_rows() > 0){
			return false;
		} else {
			return true;		
		}
	}
	
	private function account_check($str = '')
	{
		$this->db = $this->load->database('account', TRUE);
		$query = $this->db->query("SELECT user_id FROM user_profile WHERE user_id = '".$str."' ");
		if($query->num_rows() > 0){
			return false;
		} else {
			return true;		
		}
	}	

}
