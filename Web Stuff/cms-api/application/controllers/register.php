<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends REST_Controller{

    function __construct(){
        parent::__construct();
		$this->db = $this->load->database('account', TRUE);
    }
	
	function NewAcc(){
	
		$username 			= $this->get('accname');
		$password 			= $this->get('accpass1');
		$emailaddress 		= $this->get('accmail');
		$ip_address 		= $this->get('ip_address');
		
		
		if(!$username && !$password && !$emailaddress && !$ip_address)
		{
			$data = array(
				'status' => 'false',
				'error' => 'nodata',
			);
			$this->response($data, 200);			
		} else {
			if($this->email_check($emailaddress) == false) {
				$data = array(
					'status' => 'false',
					'error' => 'The selected email is not available',
				);
				$this->response($data, 200);
			} elseif ($this->account_check($username) == false)	{		
				$data = array(
					'status' => 'false',
					'error' => 'The selected username is not available',
				);
				$this->response($data, 200);				
			} else {
			
				$user_no 	= $this->CreateUserNo();
				$date 		= date('Y-m-d H:i:s');
				
				$sql1 = $this->db->query("
				INSERT INTO 
					USER_PROFILE 
					(
						user_no,
						user_id,
						user_pwd,
						resident_no,
						user_type,
						login_flag,
						login_tag,
						ipt_time,
						login_time,
						logout_time,
						user_ip_addr,
						server_id,
						ip,
						gmtag,
						user_country,
						user_gender,
						user_gm,
						user_admin,
						user_reg_date,
						user_age,
						user_sn,
						user_mail,
						banreason,
						char_connected			
					) 
					VALUES 
					(
						'".$user_no."',
						'".$username."',
						'".$password."',
						'801011000000',
						'1',
						'0',
						'V',
						'000'
						'".$date."'
						'".$date."'
						'".$date."'
						'".$ip_address."'
						'000',
						'0',
						'0x99',
						'0',
						'0',
						'0',
						'0',
						'0',
						'0',
						'0',
						'".$emailaddress."',
						'NULL',
						'N'
					)
				");
				
				if(!$sql1) {
					$data = array(
						'status' => 'false',
						'error' => 'SQL_FAIL'
					);
					$this->response($data, 200);				
				}
				else
				{
					$data = array(
						'status' => 'true',
						'result' => 'true'
					);
					$this->response($data, 200);					
				}
			}
		}
	}
	//********************************************************
	//			CREATE ACCOUNT (DO NOT CHANGE)
	//********************************************************		
	function createNewid($length = 0, $characters = 12){
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
	
	function CreateUserNo(){
		$dk_time = strftime("%y%m%d%H%M%S");
		$regdate = strftime("%y%m%d");
		list($usec1, $sec1) = explode(" ",microtime());
		$dk_user_no = $dk_time.substr($usec1, 2, 2);	
		return $dk_user_no;
	}
	
	
	//********************************************************
	//			VALIDATION CALL BACKS (DO NOT CHANGE)
	//********************************************************		
	function account_check($str = ''){
		$query = $this->db->query("SELECT user_id FROM USER_PROFILE WHERE user_id = '".$str."' ");
		if($query->num_rows() == 0){
			return true;
		} else {
			return false;		
		}
	}
	
	function email_check($str = ''){
		$query = $this->db->query("SELECT user_mail FROM USER_PROFILE WHERE user_mail = '".$str."'");
		if($query->num_rows() == 0){
			return true;
		} else {
			return false;		
		}
	}
}