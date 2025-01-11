<?php  //if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ipn2 extends MY_Controller
{
	function __construct()
	{
        parent::__construct();
		$this->load->helper('file');
		$this->load->model('m_cash');
		$this->load->model('m_email');
		$this->load->model('m_account');
		$this->db_website = $this->load->database('website', TRUE);
		$this->WritePaypalLog(date('[Y-m-d H:i e] ')."File was accessed!");
	}
	
	// BEGIN PAYPAY SCRIPT FUNCTION	
	public function PayPal()
	{
		
		$this->WritePaypalLog(date('[Y-m-d H:i e] ')."Function was accessed!");
		// CONFIG: Enable debug mode. This means we'll log requests into 'ipn.log' in the same directory.
		// Especially useful if you encounter network errors or other intermittent problems with IPN (validation).
		// Set this to 0 once you go live or don't require logging.
		define("DEBUG", 1);
		
		// Set to 0 once you're ready to go live
		define("USE_SANDBOX", 1);
		
		// Read POST data
		// reading posted data directly from $_POST causes serialization
		// issues with array data in POST. Reading raw POST data from input stream instead.
		$raw_post_data = file_get_contents('php://input');
		$raw_post_array = explode('&', $raw_post_data);
		$myPost = array();
		foreach ($raw_post_array as $keyval)
		{
			$keyval = explode ('=', $keyval);
			if (count($keyval) == 2)
			{
				$myPost[$keyval[0]] = urldecode($keyval[1]);
			}
		}
		// read the post from PayPal system and add 'cmd'
		$req = 'cmd=_notify-validate';
		
		if(function_exists('get_magic_quotes_gpc'))
		{
			$get_magic_quotes_exists = true;
		}
		
		foreach ($myPost as $key => $value)
		{
			if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1)
			{
				$value = urlencode(stripslashes($value));
			}
			else
			{
				$value = urlencode($value);
			}
			$req .= "&$key=$value";
		}
		
		// Post IPN data back to PayPal to validate the IPN data is genuine
		// Without this step anyone can fake IPN data
		
		if(USE_SANDBOX == true)
		{
			$paypal_url = "https://www.sandbox.paypal.com/cgi-bin/webscr";
		}
		else
		{
			$paypal_url = "https://www.paypal.com/cgi-bin/webscr";
		}
		
		$ch = curl_init($paypal_url);
		if ($ch == FALSE)
		{
			return FALSE;
		}
		
		curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); // => http://stackoverflow.com/questions/6400300/php-curl-https-causing-exception-ssl-certificate-problem-verify-that-the-ca-cer
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
		
		if(DEBUG == true)
		{
			curl_setopt($ch, CURLOPT_HEADER, 1);
			curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
		}
		
		// Set TCP timeout to 30 seconds
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));
		
		$res = curl_exec($ch);
		
		if (curl_errno($ch) != 0) // cURL error
		{
			if(DEBUG == true)
			{	
				$this->WritePaypalLog(date('[Y-m-d H:i e] '). "Can't connect to PayPal to validate IPN message: " . curl_error($ch));
			}
			curl_close($ch);
			exit;
		
		}
		else
		{
				// Log the entire HTTP response if debug is switched on.
				if(DEBUG == true)
				{
					$this->WritePaypalLog(date('[Y-m-d H:i e] '). "HTTP request of validation request:". curl_getinfo($ch, CURLINFO_HEADER_OUT) ." for IPN payload: $req");
					$this->WritePaypalLog(date('[Y-m-d H:i e] '). "HTTP response of validation request: $res");
		
					// Split response headers and payload
					list($headers, $res) = explode("\r\n\r\n", $res, 2);
				}
				curl_close($ch);
		}
		
		// Inspect IPN validation result and act accordingly
		
		if (strcmp ($res, "VERIFIED") == 0)
		{
			// check whether the payment_status is Completed
			// check that txn_id has not been previously processed
			// check that receiver_email is your PayPal email
			// check that payment_amount/payment_currency are correct
			// process payment and mark item as paid.
		
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
			
			if(DEBUG == true)
			{
				$this->WritePaypalLog(date('[Y-m-d H:i e] '). "Verified IPN: $req ");
			}
		}
		elseif (strcmp ($res, "INVALID") == 0)
		{
			// log for manual investigation
			// Add business logic here which deals with invalid IPN messages
			if(DEBUG == true)
			{
				$this->WritePaypalLog(date('[Y-m-d H:i e] '). "Invalid IPN: $req");
			}
		}
		else
		{
			if(DEBUG == true)
			{
				$this->WritePaypalLog(date('[Y-m-d H:i e] '). "Invalid 2 IPN: $req");
			}		
		}
		
		echo "hello";
		
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
	// END PAYPAY SCRIPT FUNCTION
	
	
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
		log_message('error', $msg);
		
		//write_file('application/cache/paypal_error_log.txt', $);
	}
	
	public function WritePaymentWallLog($msg)
	{
		$write = '';
		if(!read_file('application/cache/paymentwall_error_log.php'))
		{
			 $buff = '<?php die; ?>'."\n";
		}
		
		$write .= sprintf("%s\t%s\n\n", date("Y-m-h H:i:s"), $msg);
		write_file('application/cache/logs/'.$logfile, $write);
	}	
		
	
	
	
		
}		

?>
