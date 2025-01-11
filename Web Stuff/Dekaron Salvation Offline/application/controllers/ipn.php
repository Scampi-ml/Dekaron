<?php

class Ipn extends MY_Controller
{
	private $data = array();
	
	function __construct()
	{
        parent::__construct();
		$this->load->library('api', array('server' => $this->config->item('api_url')));
	}
	
	public function PayPal()
	{
		$money = $this->input->post('option_selection1');
		$mc_gross = (int)filter_var($money, FILTER_SANITIZE_NUMBER_INT);

		$character_name = $this->input->post('option_selection2');


		$fields = array(
			'option_selection2' => $character_name,
			'mc_gross' => round($mc_gross),
		);
		$ce = $this->api->get('ipn/PayPal', $fields, 'json');	
		if(isset($ce->status) && $ce->status == 'true'){
			file_put_contents('paypal-'.date('Ymd', time()).'.txt', $ce->result);
		} else {
			file_put_contents('paypal-'.date('Ymd', time()).'.txt', $ce->status);
		}

		

		die('OK');		
	}
	
	public function Paymentwall()
	{
	
	
	
		$userId 		= $this->input->get('uid', TRUE);
		$goodsId 		= $this->input->get('goodsid', TRUE);
		$type 			= $this->input->get('type', TRUE);
		$refId 			= $this->input->get('ref', TRUE);
		$signature 		= $this->input->get('sig', TRUE);
		
		$result 		= false; 
		$errors 		= array();	
		$SECRET 		= $this->config->item('paymentwall_secret');
		$sign_version 	= $this->config->item('paymentwall_sign_version');
		$CHARGEBACK 	= 2;
		$ipsWhitelist 	= array('174.36.92.186','174.36.96.66','174.36.92.187','174.36.92.192','174.37.14.28');		
		
		if (!$userId && !$goodsId && !$type && !$refId && !$signature)
		{
			$errors['params'] = 'Missing parameters!';
		} else {
			if (in_array($_SERVER['REMOTE_ADDR'], $ipsWhitelist)){
				$result = true;
				if ($type == $CHARGEBACK)
				{
					 $errors['chargeback'] = 'Chargeback';
				} else {
				
					$fields = array(
						'custom' => $userId,
						'mc_gross' => round($goodsId),
					);
					$this->api->get('ipn/PaymentWall', $fields, 'json');
				}
			} else {
				$errors['whitelist'] = 'IP not in whitelist!';
			}
		}		
		
		if ($result){
			echo 'OK';
		} else {
			echo implode(' ', $errors);
		}		
	}
	
	public function calculatePingbackSignature($params, $secret, $version)
	{
		$str = '';
		if ($version == 2){ksort($params);}
		foreach ($params as $k=>$v) {$str .= "$k=$v";}
		$str .= $secret;
		return md5($str);
	}	
}