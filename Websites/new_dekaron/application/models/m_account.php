<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class M_account extends MY_Model
{
    function __construct()
	{
        parent::__construct();
        // Initialize the variables
		$this->db_account = $this->load->database('account', TRUE); 
		$this->db_website = $this->load->database('website', TRUE); 
    }
	
	public function GetAccountProfile()
	{
		$query = $this->db_account->query("SELECT * FROM user_profile WHERE user_no = '".$this->session->userdata('user_no')."' ");
		return $query->row_array();
	}
	
	public function GetAccountData()
	{
		$query = $this->db_account->query("SELECT * FROM user_data WHERE user_no = '".$this->session->userdata('user_no')."' ");
		return $query->row_array();	
	}
	
	public function AccountExists($user_no)
	{
		$query = $this->db_account->query("SELECT user_no FROM user_profile WHERE user_no = '".$user_no."' ");
		if($query->num_rows() == 0)
		{
			return false;
		}
		else
		{
			return true;
		}
	}
	
	public function userno2date($userno)
	{
		$count = strlen($userno);
		if($count == '14')
		{
			$array = str_split($userno,2);
			$return = '20' . $array[0] .'-' . $array[1] . '-' . $array[2]; 
		}
		else
		{
			$return = "NA";
		}
		return $return;
	}	
	
	public function CheckSn($sn_safe)
	{
		$query = $this->db_account->query("SELECT user_no,sn FROM user_data WHERE user_no = '".$this->session->userdata('user_no')."' AND sn = '".$sn_safe."' ");
		if($query->num_rows() == 0)
		{
			return false;
		}
		else
		{
			return true;
		}	
	}
	
	public function CheckValidated()
	{
		$query = $this->db_website->query("SELECT * FROM user_validate WHERE user_no = '".$this->session->userdata('user_no')."' ");
		if($query->num_rows() == 0)
		{
			return false;
		}
		else
		{
			$row = $query->row();
			return $row->token;
		}	
	}
	
	public function ChangePassword($new_password_md5)
	{
		$this->db_account->query("UPDATE user_profile SET user_pwd = '".$new_password_md5."' WHERE user_no = '".$this->session->userdata('user_no')."' ");
	}
	
	public function ChangePasswordForgot($new_password_md5, $user_no)
	{
		$result = $this->db_account->query("UPDATE user_profile SET user_pwd = '".$new_password_md5."' WHERE user_no = '".$user_no."' ");
		if(!$result)
		{
			return false;
		}
		else
		{
			return true;			
		}	
	}	
	
	public function CheckEmail($new_email)
	{
		$query = $this->db_account->query("SELECT email FROM user_data WHERE email = '".$new_email."' ");
		if($query->num_rows() >= 1)
		{
			return false;
		}
		else
		{
			return true;			
		}		
	}
	
	public function CheckWelcome()
	{
		$query = $this->db_account->query("SELECT * FROM user_data WHERE user_no = '".$this->session->userdata('user_no')."' ");
		$row = $query->row();
		if($row->welcome_mail == '1')
		{
			return 'used';
		}
		else
		{
			return 'notused';			
		}		
	}
	
	
	public function CheckWelcomeDone()
	{
		$this->db_account->query("UPDATE user_data SET welcome_mail = '1' WHERE user_no = '".$this->session->userdata('user_no')."' ");
	}
	
				
	
	public function ChangeEmail($new_email)
	{
		$this->db_account->query("UPDATE user_data SET email = '".$new_email."' WHERE user_no = '".$this->session->userdata('user_no')."' ");
	}	
		
	public function decodeIp($enc_ip)
	{
		if ( $enc_ip == NULL )
		{
			$return = "No data";
		}
		else
		{
			$enc = bin2hex($enc_ip);
			$ip_pop = explode('.', chunk_split($enc, 2, '.'));
			$return =  hexdec($ip_pop[0]). '.' . hexdec($ip_pop[1]) . '.' . hexdec($ip_pop[2]) . '.' . hexdec($ip_pop[3]);
		}
		return $return;
	}	
	
	public function online($type, $string = '')
	{
		if($type == 'string')
		{
			if($string == '1100')
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			$query = $this->db_account->query("SELECT user_no,login_flag FROM user_profile WHERE user_no = '".$this->session->userdata('user_no')."' ");
			$row = $query->row();
			if($row->login_flag == '1100')
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	}
	
	public function CheckToken($pass_key)
	{
		$query = $this->db_account->query("SELECT user_no,pass_key FROM user_data WHERE pass_key = '".$pass_key."' ");
		if($query->num_rows() == 0)
		{
			return false;
		}
		else
		{
			$row = $query->row();
			return $row->user_no;
		}	
	}					
}