<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends REST_Controller
{
    public $data;
	
    function __construct()
	{
        parent::__construct();
		$this->data = array();
		$this->db = $this->load->database('account', TRUE);
    }
	
	function index(){
	
		$username 	= $this->get('username');
		$password 	= $this->get('password');
		$email 		= strtolower($this->get('email'));

		
		if(!$this->email_check($email))
		{
			$this->data = array('error' => 'The selected email is not available');
		}
		elseif(!$this->account_check($username))
		{		
			$this->data = array('error' => 'The selected username is not available');
		}
		else
		{
			$user_no = $this->CreateUserNo();	
			$sql1 = $this->db->query("
			INSERT INTO [dbo].[USER_PROFILE]
				   (user_no,user_id,user_pwd,resident_no,user_type,login_flag,login_tag,server_id,user_country,user_gender,user_gm,user_admin,user_reg_date,user_age,user_sn,user_mail)
			 VALUES
				   ('".$user_no."','".$username."','".$password."','801011000000','1','0','Y','000','0','0','0','0','".time()."','0','".$this->createNewid(12, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ01234567890')."','".$email."')
			");
			
			if(!$sql1){
				$this->data = array('error' => 'SQL_FAIL');			
			} else {
				$this->data = array('result' => 'ok');
			}
			
		}
		$this->response($this->data, 200);	
	}
			
	function createNewid($length = 0, $characters = 12)
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
	
	function CreateUserNo()
	{
		$dk_time = strftime("%y%m%d%H%M%S");
		$regdate = strftime("%y%m%d");
		list($usec1, $sec1) = explode(" ",microtime());
		$dk_user_no = $dk_time.substr($usec1, 2, 2);	
		return $dk_user_no;
	}
	
	
	//********************************************************
	//			VALIDATION CALL BACKS (DO NOT CHANGE)
	//********************************************************		

	
	function email_check($str = '')
	{
		$query = $this->db->query("SELECT user_mail FROM user_profile WHERE user_mail = '".$str."'");
		if($query->num_rows() > 0){
			return false;
		} else {
			return true;		
		}
	}
	
	function account_check($str = '')
	{
		$query = $this->db->query("SELECT user_id FROM user_profile WHERE user_id = '".$str."' ");
		if($query->num_rows() > 0){
			return false;
		} else {
			return true;		
		}
	}	
}