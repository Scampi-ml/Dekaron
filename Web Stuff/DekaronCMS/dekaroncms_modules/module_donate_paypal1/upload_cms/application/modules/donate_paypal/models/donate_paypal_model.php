<?php

class Donate_paypal_model extends CI_Model 
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function getConfig()
	{
		$query = $this->db->query("SELECT * FROM module_config WHERE module_name = 'donate_paypal' ");
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

	public function getItems()
	{
		$query = $this->db->query("SELECT * FROM donate_paypal_items");
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

	public function getItem($id)
	{
		
		$query = $this->db->query("SELECT * FROM donate_paypal_items WHERE id = ?", array($id));
		if($query->num_rows() > 0)
		{
			$result = $query->row_array();
			return $result;
		}
		else
		{
			return false;
		}
	}	

	public function add($price, $coins)
	{
		$data = array(
			'price' 		=> $price,
			'coins' 		=> $coins,
		);
		$this->db->insert('donate_paypal_items', $data);
	}	

	public function remove($id)
	{	
		if($this->db->query("DELETE FROM donate_paypal_items WHERE id = ?", array($id)))
		{
			return true;
		}
		else
		{
			return false;
		}
	}	

	public function edit($id, $price, $coins)
	{
		$this->db->where('id', $id);
		$this->db->update('donate_paypal_items',  
			array(
				'price' 		=> $price,
				'coins' 		=> $coins,
			)
		);		
	}

	public function insertTransaction($user_no, $hash, $amount, $currency, $coins)
	{
		$data = array(
			'payment_status'  	=> 'Pending',
			'payment_amount'  	=> $amount,
			'payment_currency'  => $currency,
			'txn_id'  			=> NULL,
			'payer_email'  		=> NULL,
			'user_no'  			=> $user_no,
			'coins'  			=> $coins,
			'error'  			=> '',
			'timestamp' 		=> time(),
			'hash'				=> $hash,
		);
		$this->db->insert('donate_paypal_transactions', $data);		
	}

	public function updateTransaction($hash, $data)
	{
		$this->db->where('hash', $hash);
		$this->db->update('donate_paypal_transactions', $data);	
	}

	public function getTransaction($paymentId)
	{
		$query = $this->db->query("SELECT * FROM donate_paypal_transactions WHERE hash = ?", array($paymentId));
		if($query->num_rows() > 0)
		{
			$result = $query->row_array();
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

	public function characterExists_api($data)
	{
		$connect = array(
			'server' => $this->config->item('api_server'),
			'http_user' => $this->config->item('api_http_user'),
			'http_pass' => $this->config->item('api_http_pass'),
			'http_auth' => $this->config->item('api_http_auth'),
		);	
		$this->load->library('rest', $connect);	

		$api = $this->rest->get('characterExistsPaypal', $data, $type = 'json');	
		return  ($api == 'null' ? false : $api);
	}

	public function characterExists_local($data)
	{	
		$username 	= $data['character_name'];
		$this->db 	= $this->load->database('character', TRUE);

		$query = $this->db->query("SELECT user_no FROM user_character WHERE character_name = '".$character_name."' ");
		if($query->num_rows() > 0)
		{
			return json_encode($query->row_array());	
		}
		else
		{
			return json_encode(array('result' => 'false'));
		}
	}

	public function UpdateCash_api($data)
	{
		$connect = array(
			'server' => $this->config->item('api_server'),
			'http_user' => $this->config->item('api_http_user'),
			'http_pass' => $this->config->item('api_http_pass'),
			'http_auth' => $this->config->item('api_http_auth'),
		);	
		$this->load->library('rest', $connect);	

		$api = $this->rest->get('UpdateCashPaypal', $data, $type = 'json');	
		return  ($api == 'null' ? false : $api);
	}

	public function UpdateCash_local($data)
	{
		$this->db = $this->load->database('cash', TRUE);

		$amount 	= $data['amount'];
		$user_no 	= $data['user_no'];

		if(!$this->GetCashRow($user_no))
		{
			//01-140823-140D9D9CF2
			$o_id_code = '01'.date("ymd").''.$this->createNewid(10, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ01234567890');
			$query = $this->db->query("INSERT INTO user_cash (id,user_no,group_id,amount,free_amount) VALUES ('".$o_id_code."','".$user_no."','01','0','".round($amount)."')  ");				
		}
		else
		{
			$query = $this->db->query("UPDATE user_cash SET free_amount = free_amount + ".round($amount)." WHERE user_no = '".$user_no."' ");	
		}
		
		if($query === false)
		{
			return json_encode(array('error' => 'sql_failed'));
		}
		else
		{
			return json_encode(array('success' => 'ok'));
		}			
		
		$this->response($this->data, 200);
	}

	private function GetCashRow($user_no)
	{
		$this->db = $this->load->database('cash', TRUE);

		$query = $this->db->query("SELECT user_no FROM user_cash WHERE user_no = '".$user_no."'  ");
		if($query->num_rows() > 0)
		{	
			return true;
		}
		else
		{
			return false;
		}
	}	
	
	private function createNewid($length, $characters)
	{
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
