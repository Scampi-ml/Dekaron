<?php
require 'application/modules/donate_paypal/vendor/autoload.php';
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Payer;
//use PayPal\Api\Details;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\PaymentExecution;

class Donate_paypal extends MX_Controller
{
	private $pp_config = array();
	private $api;

	public function __construct()
	{
		parent::__construct();
		//requirePermission("view");
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');		
		$this->load->model("donate_paypal_model");

		$this->SetPPconfig();

		$this->api = new ApiContext(new OAuthTokenCredential($this->pp_config['paypal_clientSecret'],$this->pp_config['paypal_clientId']));	
		$this->api->setConfig(array(
			'mode' 						=> $this->pp_config['paypal_mode'],
			'http.ConnectionTimeOut' 	=> $this->pp_config['paypal_ConnectionTimeOut'],
			'log.LogEnabled' 			=> $this->pp_config['paypal_LogEnabled'],
			'log.FileName' 				=> 'application/logs/PayPal-'.date('Y-m-d').'.php',
			'log.LogLevel' 				=> $this->pp_config['paypal_LogLevel'],
			'validation.level' 			=> $this->pp_config['paypal_validationLevel']
		));
	}

	private function SetPPconfig()
	{
		$pp_con = array();
		foreach ($this->donate_paypal_model->getConfig() as $config)
		{		
			$pp_con[$config['key']] = $config['value'];
		}
		$this->pp_config = $pp_con;
	}
	
	public function index($error = false)
	{
		$this->template->setTitle("Donate Paypal");
		$data = array(	
			'url' => $this->template->page_url,
			'items' => $this->donate_paypal_model->getItems(),
			"class" => array("class" => "page_form"),
			"currency" => $this->config->item('paypal_currency'),
			'validation_errors' => $error
		);

		$this->template->view($this->template->loadPage("page.tpl", array(
			"module" => "default", 
			"headline" => "Donate Paypal", 
			"content" => $this->template->loadPage("donate.tpl", $data),
		)), false, false, "Donate Paypal");	
	}

	public function pay()
	{
		$this->form_validation->set_rules('character_name', 	'character_name', 		'trim|required|min_length[4]|max_length[50]|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('item', 				'item', 				'trim|integer|xss_clean');

		if($this->form_validation->run() == FALSE)
		{
			$this->index(validation_errors());
		}
		elseif(!(int)$this->input->post('item'))
		{
			$this->index('<p>Please select an option</p>');
		}
		elseif($this->item_check((int)$this->input->post('item')) == false)
		{
			$this->index('<p>ID not found</p>');
		}
		else
		{
			$this->template->setTitle("Donate Paypal");

			$id 		= (int)$this->input->post('item');
			$user_no 	= $this->character_to_user($this->input->post('character_name'));


			if(!$user_no)
			{
				$this->index('<p>Character not found</p>');
			}

			$create_payment = $this->create_payment($id, $user_no);
			$redirectUrl = $create_payment;

			$data = array(	
				'url' => $this->template->page_url,
				'pp_url' => $redirectUrl,
				'paypal_mode' => $this->pp_config['paypal_mode']
			);

			$this->template->view($this->template->loadPage("page.tpl", array(
				"module" => "default", 
				"headline" => "Donate Paypal", 
				"content" => $this->template->loadPage("pay.tpl", $data),
			)), false, false, "Donate Paypal");							
		}
	}

	public function returnpp()
	{
		$approved 	= $this->input->get('approved'); 	// string 'true' (length=4)
		$paymentId 	= $this->input->get('paymentId'); 	// string 'PAY-3NT662092B631910TKSHIDTA' (length=28)
		$PayerID 	= $this->input->get('PayerID'); 	// string 'KAABW6KZKZR4N' (length=13)
		$token 		= $this->input->get('token'); 		// string 'EC-2MW18570H1181622B' (length=20)

		$this->template->setTitle("Donate Paypal");
		$data = array('url' => $this->template->page_url);

		if(!$approved)
		{		
			show_error('Paypal did not appove this transaction', 500, 'PayPal Error');	
		}

		if(!$approved || !$paymentId || !$PayerID || !$token)
		{
			show_error('Missing PayPal parameters', 500, 'PayPal Error');
		}

		$getPaymentId = $this->donate_paypal_model->getTransaction($paymentId);	

		if(!$getPaymentId)
		{
			$data['error'] = 'Payment ID not found.';
			$this->donate_paypal_model->updateTransaction($paymentId, array(
					'error' => 'Payment ID not found',
					'payment_status' => 'Failed',
					'timestamp' => time()
				)
			);
		}
		elseif($getPaymentId['payment_status'] == 'Completed')
		{
			$data['error'] = 'Payment was already completed';		
		}
		elseif($getPaymentId['payment_status'] == 'Refunded')
		{
			$data['error'] = 'You got a refund and now you want more coins?';
			$this->donate_paypal_model->updateTransaction($paymentId, array(
					'error' => 'You got a refund and now you want more coins?',
					'payment_status' => 'Refunded',
					'timestamp' => time()
				)
			);			
		}	
		elseif($getPaymentId['payment_status'] == 'Cancelled')
		{
			$data['error'] = 'You cancelled the payment, you cannot continue';
			$this->donate_paypal_model->updateTransaction($paymentId, array(
					'error' => 'You cancelled the payment, you cannot continue',
					'payment_status' => 'Cancelled',
					'timestamp' => time()
				)
			);				
		}	
		else
		{
			$Payment = Payment::get($paymentId, $this->api);
			$paymentExecution = new PaymentExecution();
			$paymentExecution->setPayer_id($PayerID);

			$response = array();
			try
			{
				$response = $Payment->execute($paymentExecution, $this->api);
			}
			catch (PayPal\Exception\PPConnectionException $ex)
			{  
				$err = json_decode($ex->getData(), true);

				if($err['name'] == 'PAYMENT_STATE_INVALID')
				{
					$data['error'] = 'Payment was already completed';
					$this->template->view($this->template->loadPage("page.tpl", array(
						"module" => "default", 
						"headline" => "Donate Paypal", 
						"content" => $this->template->loadPage("return.tpl", $data),
					)), false, false, "Donate Paypal");	
					die();
				}
				else
				{	
					$this->donate_paypal_model->updateTransaction($paymentId, array(
							'error' => serialize($ex->getData()),
							'payment_status' => 'Failed',
							'timestamp' => time()
						)
					);	
					var_dump(json_decode($ex->getData(), true));
				    show_error($ex->getMessage(), 500, 'Paypal Error');
				    die();
				}
			}

			//echo $response;die();

			if($response->state == 'approved')
			{
				$this->donate_paypal_model->updateTransaction($paymentId, array(
						'payment_status' => 'Completed',
						'timestamp' => time(),
						'payer_email' => $response->payer->payer_info->email,
						'txn_id' => $response->transactions[0]->related_resources[0]->sale->id
					)
				);	

				$this->load->config('cms', TRUE);

				if(CI::$APP->config->item('connection_type') === 'api')
				{
					$UpdateCash = $this->donate_paypal_model->UpdateCash_api(array("user_no" => $getPaymentId['user_no'], "amount" => $getPaymentId['coins']));
				}
				elseif(CI::$APP->config->item('connection_type') === 'local')
				{
					$UpdateCash = $this->donate_paypal_model->UpdateCash_local(array("user_no" => $getPaymentId['user_no'], "amount" => $getPaymentId['coins']));
				}
				else
				{
					show_error('API Or Server is not setup to recive donate data');
				}

				if(isset($UpdateCash->success) && $UpdateCash->success == 'ok')
				{
					$data['success'] = '<h2>Thank you for your donation!</h2><br>' . number_format($getPaymentId['coins']).' Coins have been added.';	
					$this->template->view($this->template->loadPage("page.tpl", array(
						"module" => "default", 
						"headline" => "Donate Paypal", 
						"content" => $this->template->loadPage("return.tpl", $data),
					)), false, false, "Donate Paypal");						
				}
				else
				{
					$data['error'] = $UpdateCash->error;
					$this->template->view($this->template->loadPage("page.tpl", array(
						"module" => "default", 
						"headline" => "Donate Paypal", 
						"content" => $this->template->loadPage("return.tpl", $data),
					)), false, false, "Donate Paypal");						
				}	
			}
			else
			{
				$this->donate_paypal_model->updateTransaction($paymentId, array(
						'error' => 'Not Approved',
						'payment_status' => 'Failed',
						'timestamp' => time(),
					)
				);
				show_error('Paypal did not appove this transaction', 500, 'PayPal Error');	
			}
		}

		$this->template->view($this->template->loadPage("page.tpl", array(
			"module" => "default", 
			"headline" => "Donate Paypal", 
			"content" => $this->template->loadPage("return.tpl", $data),
		)), false, false, "Donate Paypal");	
	}

	private function item_check($str)
	{
		if ($this->donate_paypal_model->getItem($str) === false)
		{
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

	private function character_to_user($character_name)
	{
		if(preg_match("/^[a-zA-Z0-9]+$/", $character_name) != 1)
		{
			return false;
		}	

		$this->load->config('cms', TRUE);

		if(CI::$APP->config->item('connection_type') === 'api')
		{
			$characterExists = $this->donate_paypal_model->characterExists_api(array("character_name" => $character_name));
		}
		elseif(CI::$APP->config->item('connection_type') === 'local')
		{
			$characterExists = $this->donate_paypal_model->characterExists_local(array("character_name" => $character_name));	
		}
		else
		{
			show_error('API Or Server is not setup to recive donate data');
		}

		if(isset($characterExists->result) && $characterExists->result == 'false')
		{
			return false;		
		}
		else
		{
			if(is_numeric($characterExists->user_no))
			{
				return $characterExists->user_no;
			}
			else
			{
				return false;
			}
		}		
	}

	private function create_payment($id, $user_no)
	{
		$item = $this->donate_paypal_model->getItem($id);

		if(strlen($this->pp_config['paypal_clientSecret']) != 60 || strlen($this->pp_config['paypal_clientId']) != 60 )
		{
			$this->template->showError("Paypal Client Secret and / or Paypal Client Id not valid");
		}
		else
		{
			$payer 			= new Payer();
			$amount 		= new Amount;
			$transaction 	= new Transaction();
			$payment 		= new Payment;
			$redirectUrls 	= new RedirectUrls();
			$itemList 		= new ItemList(); 
			$item1 			= new Item();

			$item1->setName('Donation for ' . $this->config->item('server_name')) 
				->setCurrency($this->pp_config['paypal_currency']) 
				->setQuantity('1') 
				->setPrice($item['price'].'.00')
				->setSKU($user_no)
				->setDescription(number_format($item['coins']) .' coins'); 

			$itemList->setItems(array($item1));

			$payer->setPayment_method('paypal');

			$amount->setCurrency($this->pp_config['paypal_currency'])
				->setTotal($item['price'].'.00');

			$transaction->setAmount($amount) 
				->setItemList($itemList) 
				->setDescription("Payment description") 
				->setInvoiceNumber(uniqid());

			$payment->setIntent('sale')
				->setPayer($payer)
				->setTransactions(array($transaction));

			$redirectUrls->setReturnUrl( site_url() . 'donate_paypal/returnpp?approved=true')
				->setCancelUrl( site_url() . 'donate_paypal/returnpp?approved=false');

			$payment->setRedirectUrls($redirectUrls);

			try
			{
				$payment->create($this->api);
				$hash = $payment->getId();
				$this->donate_paypal_model->insertTransaction(
					$user_no, 
					$hash, 
					$item['price'], 
					$this->pp_config['paypal_currency'],
					$item['coins']
				);
			}
			catch (PayPal\Exception\PPConnectionException $ex)
			{  
				
				var_dump(json_decode($ex->getData(), true));
			    show_error($ex->getMessage(), 500, 'Paypal Error');
			    die();
			}

			foreach ($payment->getLinks() as $link)
			{
				if($link->getRel() == 'approval_url')
				{
					$redirectUrl = $link->getHref();
				}
			}
		}

		return $redirectUrl;
	}
}