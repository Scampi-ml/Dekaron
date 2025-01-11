<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_Cash extends MY_model
{
    function __construct()
	{
        parent::__construct();
		$this->db_cash = $this->load->database('cash', TRUE); 
    }		
	
	public function GetCoinsNoSession($user_no)
	{
		$query = $this->db_cash->query("SELECT * FROM user_cash WHERE user_no = '".$user_no."' ");
		if($query->num_rows() == 0)
		{
			$this->dshopfix($user_no);
			return '0';
		}
		else
		{
			$row = $query->row();
			
			$table = $this->config->item('cash_table');
			if($table == 'amount')
			{
				return $row->amount;
			}
			else
			{
				return $row->free_amount;
			}
		}	
	}
	
	public function GetCoinsSession()
	{
		$query = $this->db_cash->query("SELECT * FROM user_cash WHERE user_no = '".$this->session->userdata('user_no')."' ");
		if($query->num_rows() == 0)
		{
			$this->dshopfix($this->session->userdata('user_no'));
			return '0';
		}
		else
		{
			$row = $query->row();
			
			$table = $this->config->item('cash_table');
			if($table == 'amount')
			{
				return $row->amount;
			}
			else
			{
				return $row->free_amount;
			}
		}	
	}			
	
	public function dshopfix($user_no)
	{
		$o_id_code = '01'.date("ymd").''.$this->createNewid(12, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ01234567890');
		$this->db_cash->query("INSERT INTO user_cash (id,user_no,group_id,amount,free_amount) VALUES ('".$o_id_code."','".$user_no."','01','0','0')  ");
	}
	
	public function AddCoins($amount)
	{
		if(!is_numeric($amount))
		{
			return false;
		}
		else
		{
			$table = $this->config->item('cash_update_table');
			if($table == 'amount')
			{
				$query = $this->db_cash->query("UPDATE user_cash SET amount = amount + ".$amount." WHERE user_no = '".$this->session->userdata('user_no')."' ");
				if(!$query)	
				{
					$this->dshopfix($user_no);
					$query2 = $this->db_cash->query("UPDATE user_cash SET amount = amount + ".$amount." WHERE user_no = '".$this->session->userdata('user_no')."' ");
					if(!$query2)
					{
						return false;
					}
					else
					{
						return true;
					}
				}
				else
				{
					return true;
				}
			}
			else
			{
				$query = $this->db_cash->query("UPDATE user_cash SET free_amount = free_amount + ".$amount." WHERE user_no = '".$this->session->userdata('user_no')."' ");
				if(!$query)	
				{
					$this->dshopfix($user_no);
					$query2 = $this->db_cash->query("UPDATE user_cash SET free_amount = free_amount + ".$amount." WHERE user_no = '".$this->session->userdata('user_no')."' ");
					if(!$query2)
					{
						return false;
					}
					else
					{
						return true;
					}
				}
				else
				{
					return true;
				}						
			}			
		}
	}
	
	public function AddCoinsIpn($amount, $user_no)
	{
		if(!is_numeric($amount))
		{
			return false;
		}
		else
		{
			$table = $this->config->item('cash_update_table');
			if($table == 'amount')
			{
				$query = $this->db_cash->query("UPDATE user_cash SET amount = amount + ".$amount." WHERE user_no = '".$user_no."' ");
				if(!$query)	
				{
					$this->dshopfix($user_no);
					$query2 = $this->db_cash->query("UPDATE user_cash SET amount = amount + ".$amount." WHERE user_no = '".$user_no."' ");
					if(!$query2)
					{
						return false;
					}
					else
					{
						return true;
					}					
				}
				else
				{
					return true;
				}
			}
			else
			{
				$query = $this->db_cash->query("UPDATE user_cash SET free_amount = free_amount + ".$amount." WHERE user_no = '".$user_no."' ");
				if(!$query)	
				{
					$this->dshopfix($user_no);
					$query2 = $this->db_cash->query("UPDATE user_cash SET free_amount = free_amount + ".$amount." WHERE user_no = '".$user_no."' ");
					if(!$query2)
					{
						return false;
					}
					else
					{
						return true;
					}						
				}
				else
				{
					return true;
				}						
			}			
		}
	}		
	
	public function AddCoinsSession($amount)
	{
		if(!is_numeric($amount))
		{
			return false;
		}
		else
		{
			$session_data['coins'] = $this->session->userdata('coins') + $amount;
			$this->session->set_userdata($session_data);
			return true;
		}
	}	
					
	public function createNewid($length, $characters)
	{
		if ($characters == ''){ return ''; }
		$chars_length = strlen($characters)-1;
		
		mt_srand((double)microtime()*1000000);
		
		$newid = '';
		while(strlen($newid) < $length)
		{
			$rand_char = mt_rand(0, $chars_length);
			$newid .= $characters[$rand_char];
		}
		return $newid;
	}	
}