<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ipn extends MY_Controller
{
	
	function __construct()
	{
        parent::__construct();
		$this->load->helper('file');
		$this->load->model('m_cash');
		$this->load->model('m_email');
		$this->load->model('m_account');
		$this->db_website = $this->load->database('website', TRUE);
	}
		
	public function PayPal()
	{
		$req = 'cmd=' . urlencode('_notify-validate');
		foreach ($_POST as $key => $value)
		{
			$value = urlencode(stripslashes($value));
			$req .= "&$key=$value";
		}
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'https://www.paypal.com/cgi-bin/webscr');
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Host: www.paypal.com'));
		$res = curl_exec($ch);
		curl_close($ch);		
		
		if($res === false)
		{
			$this->WritePaypalLog('no valid curl data');
			die('No valid data');
		}		
		
		
		// assign posted variables to local variables
		$item_name 					= $_POST['item_name'];
		$item_number 				= $_POST['item_number'];
		$payment_status 			= $_POST['payment_status'];
		$payment_amount 			= $_POST['mc_gross'];
		$payment_currency 			= $_POST['mc_currency'];
		$txn_id 					= $_POST['txn_id'];
		$receiver_email 			= $_POST['receiver_email'];
		$payer_email 				= $_POST['payer_email'];
		$account 					= $_POST['custom'];
		
		
		if($account == 0)
		{
			return false;
		}
		else
		{
		
			$buff = sprintf("%s\t%s\t\$%0.2f\t%s\t%s\t%s", $txn_id, $payment_status, $payment_amount, $receiver_email, $payer_email, $account);
			 
			 // check the payment_status is Completed
			 // check that receiver_email is your Primary PayPal email
			if (strcmp ($res, "VERIFIED") == 0 && $payment_status == 'Completed' && $receiver_email == $this->config->item('paypal_email')) 
			{
				
				// check that payment_amount/payment_currency are correct
				$validpackage = false;
				for($i = 0; $i < count($paypal_packages); ++$i)
				{
					if($paypal_packages[$i][0] == $payment_amount && $payment_currency == CURRENCY)
					{
						$validpackage = true;
						break;
					}
				}

				// process payment if valid package
				if($validpackage)
				{
					$this->WritePaypalLog('account = '.$account);

					$account_check = $this->m_account->AccountExists($account);

					if($account_check)
					{
						$r = $this->m_cash->AddCoinsIpn($paypal_packages[$i][1], $user_no);

						if($r)
						{
							// Add record to donations
							$this->WritePaypalLog('ADDED !: '.$buff);
							$query = $this->db_website->query("INSERT INTO donations (serial, type, user_no, amount, intime) VALUES ('".$txn_id."', 'Paypal', '".$account."', '".round($paypal_packages[$i][1])."', '".date("m/d/Y H:i:s")."')");
							return true;
						}
						else
						{
							$this->WritePaypalLog('ERROR SENDING COINS: '.$buff);
						}
					}
					else
					{
						$this->WritePaypalLog('ACCOUNT NOT FOUND: '.$buff);
					}
				}
				else
				{
					$this->WritePaypalLog('INVALID PACKAGE: '.$buff);
				}
			}
			elseif (strcmp ($res, "INVALID") == 0) 
			{
				// log for manual investigation
				$this->WritePaypalLog('INVALID IPN: '.$buff);
			}
			else
			{
				die('no data');
			}
		}
	}
	
	public function PaymentWall()
	{
		
		$SECRET 						= $this->config->item('paymentwall_secret');
		$credit_type_chargeback 		= 2;

		//$this->load->model('checkout/order');
		$ipsWhitelist = array(
			'174.36.92.186',
			'174.36.96.66',
			'174.36.92.187',
			'174.36.92.192',
			'174.37.14.28'
		);
		
		$userId 			= isset($_GET['uid']) ? $_GET['uid'] : null;
		$goodsId 			= isset($_GET['goodsid']) ? $_GET['goodsid'] : null;
		$length 			= isset($_GET['slength']) ? $_GET['slength'] : null;
		$period 			= isset($_GET['speriod']) ? $_GET['speriod'] : null;
		$type 				= isset($_GET['type']) ? $_GET['type'] : null;
		$refId 				= isset($_GET['ref']) ? $_GET['ref'] : null;
		$signature 			= isset($_GET['sig']) ? $_GET['sig'] : null;
		
		$result = false;
		if (!empty($userId) && !empty($goodsId) && isset($type) && !empty($refId) && !empty($signature)) {
		
			$signatureParams = array(
				'uid' 		=> $userId,
				'goodsid' 	=> $goodsId,
				'slength' 	=> $length,
				'speriod' 	=> $period,
				'type' 		=> $type,
				'ref' 		=> $refId
			);
			
			$signatureCalculated = $this->generateSignature($signatureParams, $SECRET);
		
			// check if IP is in whitelist and if signature matches
			if (in_array($_SERVER['REMOTE_ADDR'], $ipsWhitelist) && ($signature == $signatureCalculated)) {
				$result = true;
				if ($type == $credit_type_chargeback)
				{
					// Take membership from user
					// This is optional, but we recommend this type of crediting to be implemented as well
					$this->model_checkout_order->update($goodsId, $this->config->get('cancel_status'));
				}
				else
				{
					// Give membership to user
					$this->model_checkout_order->confirm($goodsId, $this->config->get('complete_status'));
				}
			}
		}
		
		if ($result) {
			echo 'OK';
		}
		

	}
	
	
	public function generateSignature($params, $secret) {
		$str = '';
	
		foreach ($params as $k=>$v) {
			$str .= "$k=$v";
		}
		$str .= $secret;
	
		return md5($str);
	}
	
	
	public function WritePaypalLog($msg)
	{
		$write = '';
		if(!read_file('application/logs/paypal_error_log.php'))
		{
			 $write = '<?php die; ?>'."\n";
		}
		
		$write .= sprintf("%s\t%s\n\n", date("Y-m-h H:i:s"), $msg);
		write_file('application/logs/paypal_error_log.php', $write);
	}
	
	public function WritePaymentWallLog($msg)
	{
		$write = '';
		if(!read_file('application/logs/paymentwall_error_log.php'))
		{
			 $buff = '<?php die; ?>'."\n";
		}
		
		$write .= sprintf("%s\t%s\n\n", date("Y-m-h H:i:s"), $msg);
		write_file('application/cache/logs/'.$logfile, $write);
	}	
		
	
	
	
		
}