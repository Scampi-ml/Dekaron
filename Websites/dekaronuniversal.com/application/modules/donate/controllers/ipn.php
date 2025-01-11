<?php

class Ipn extends MX_Controller 
{
	private $custom;
	private $payment_status;
	private $payment_amount;
	private $payment_currency;
	private $txn_id;
	private $receiver_email;
	private $payer_email;
	private $pending_reason;
	private $config_paypal;
	private $debug = false;
	
	public function __construct(){
		parent::__construct();
		$this->load->config('donate');
		$this->config_paypal = $this->config->item('donate_paypal');
		if(count($_POST) == 0){
			die("No access");
		}
	}
	
	public function index(){
		$this->custom 				= $this->input->post('custom');
		$this->payment_status 		= $this->input->post('payment_status');
		$this->payment_amount 		= $this->input->post('mc_gross');
		$this->payment_currency 	= $this->input->post('mc_currency');
		$this->txn_id 				= $this->input->post('txn_id');
		$this->receiver_email 		= $this->input->post('receiver_email');
		$this->payer_email 			= $this->input->post('payer_email');
		$this->pending_reason 		= $this->input->post('pending_reason');	
		 
		$validated = 0;
		$error_count = 0;
		$error = "";

		if($this->receiver_email != $this->config_paypal['email']){
			$error .= "Invalid receiver email (set to ".$this->receiver_email.")<br />";
			$error_count++;
		}

		if($this->transactionExists($this->txn_id)){
			$error .= "Payment has already been processed";
			$error_count++;
		}

		if($this->payment_status != "Completed"){
			$error .= "Payment status is not completed (".$this->payment_status.")<br />";
			$error_count++;
		}
		
		if($this->pending_reason == "unilateral"){
			$error .= "Pending_reason: unilateral<br />";
			$error .= "The payment is pending because it was made to an email address that is not yet registered or confirmed.<br />";
			$error_count += 2;
		}
		
		if($error_count == 0){
			$fields = array(
				'character_name' 	=> $this->custom,
				'amount' 			=> $this->getAmount()
			);			
			$res = $this->conn->api("UpdateCashPaypal", $fields);			
			if(isset($res->error)){
				$error .= $res2->error . "<br />";
				$error_count++;
			}else{
				$validated = 1;
				$this->updateMonthlyIncome(); 
			}			
		}
		
		$data = array(
			"payment_status" => $this->payment_status,
			"payment_amount" => $this->payment_amount,
			"payment_currency" => $this->payment_currency,
			"txn_id" => $this->txn_id,
			"receiver_email" => $this->receiver_email,
			"payer_email" => $this->payer_email,
			"character_name" => $this->custom,
			"validated" => $validated,
			"timestamp" => time(),
			"error" => (isset($error)) ? $error : "",
			"pending_reason" => $this->pending_reason
		);
		$this->db->insert("paypal_logs", $data);
		die();
	}

	private function transactionExists($txn_id){
		$query = $this->db->query("SELECT COUNT(*) as `total` FROM paypal_logs WHERE txn_id=?", array($txn_id));
		if($query->num_rows() > 0){
			$row = $query->result_array();
			if($row[0]['total'] > 0){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

	private function updateMonthlyIncome(){
		$query = $this->db->query("SELECT COUNT(*) AS `total` FROM monthly_income WHERE month=?", array(date("Y-m")));
		$row = $query->result_array();
		if($row[0]['total']){
			$this->db->query("UPDATE monthly_income SET amount = amount + ".floor($this->payment_amount)." WHERE month=?", array(date("Y-m")));
		}else{
			$this->db->query("INSERT INTO monthly_income(month, amount) VALUES(?, ?)", array(date("Y-m"), floor($this->payment_amount)));
		}
	}
	
	private function getAmount(){
		$config = $this->config->item('donate_paypal');
		$points = 0;
		foreach($config['values'] as $price => $reward){
			if($price == round($this->payment_amount)){
				$points = $reward;
			} else {
				$points = 0;
			}
		}
		return $points;
	}	
}