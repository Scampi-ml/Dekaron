<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Donate extends MY_Controller
{
    function __construct()
	{
        parent::__construct();
		// check if logged in, this is a restricted page
		$this->is_logged_in();
    }
		
	public function index()
	{
		$this->template_data['template']['body_id'] = 'account';
		$this->template_data['template']['active_page'] = $this->uri->segment(1);
		$this->load->view('myaccount/view_donate', $this->template_data);
	}
	
	public function paymentwall()
	{
		if($this->config->item('paymentwall_active'))
		{
			// build paymentwall URL
			$params['key'] 					= $this->config->item('paymentwall_secret');
			$params['uid'] 					= $this->session->userdata('user_no');
			$params['widget'] 				= $this->config->item('paymentwall_widget');
			$params['sign_version'] 		= $this->config->item('paymentwall_sign_version');
			$params['custom_parameter'] 	= 'custom_value';
			$params['sign'] 				= $this->calculateWidgetSignature($params, $this->config->item('paymentwall_secret'));	
			
			
			$this->template_data['template']['paymentwall_url'] = http_build_query($params);
			$this->template_data['template']['body_id'] = 'account';
			$this->template_data['template']['active_page'] = $this->uri->segment(1);
			$this->load->view('myaccount/view_donate_paymentwall', $this->template_data);
		}
		else
		{
			die('<br><br><br><center>Sorry, this payment module is not active.</center>');
		}		
	}
	
	
	public function paypal()
	{
		$this->template_data['template']['paypal_packages'] = $this->config->item('paypal_packages');
		$this->template_data['template']['body_id'] = 'account';
		$this->template_data['template']['active_page'] = $this->uri->segment(1);
		$this->load->view('myaccount/view_donate_paypal', $this->template_data);		
	}
	
	public function GeneratePayPalForm()
	{
		// sandbox mode ?
		if($this->config->item('paypal_sandbox'))
		{
			$paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
		}
		else
		{
			$paypal_url = 'https://www.paypal.com/cgi-bin/webscr';
		}
		
		// Get the input from the post
		$input = $this->input->post('paypal');
		
		// Get packages from config 
		$paypal_packages = $this->config->item('paypal_packages');
		
		// check for selected one and valid one
		$validpackage = FALSE;
		for($i = 0; $i < count($paypal_packages); ++$i)
		{
			if($paypal_packages[$i][1] == $input)
			{
				$validpackage = TRUE;
				break;
			}
		}

		// process payment if valid package
		if($validpackage)
		{
			$price = $paypal_packages[$i][0];
            $coins = $paypal_packages[$i][1];
			
			if($this->config->item('paypal_custom_list'))
			{
				$package_name = $paypal_packages[$i][2];
			}
			else
			{
				$name = $this->config->item('paypal_item_name');
				$currency = $this->config->item('paypal_currency_code');
				$symbol = $this->config->item('paypal_symbole');
				
				$package_name = $coins.' '.$name.' for '.$symbol.''.$price.' '.$currency;
			}			
			
				
			// PLEASE DONT CHANGE THESE SETTINGS !!!!!!
			$paypal_form = '';
			$paypal_form .= '<form action="'.$paypal_url.'" id="paypal-form" method="post" class="normal">';
			$paypal_form .= '<input id="business" 					name="business" 		type="hidden" 		value="'.$this->config->item('paypal_email').'"/>';
			$paypal_form .= '<input id="custom" 					name="custom" 			type="hidden" 		value="'.$this->session->userdata('user_no').'"/>';
			$paypal_form .= '<input id="invoice" 					name="invoice" 			type="hidden" 		value="#'.$this->GenerateInvoiceSession().'"/>';
			$paypal_form .= '<input id="no_note" 					name="no_note" 			type="hidden" 		value="1"/>';
			$paypal_form .= '<input id="cmd" 						name="cmd" 				type="hidden" 		value="_cart"/>';
			$paypal_form .= '<input id="upload" 					name="upload" 			type="hidden" 		value="1"/>';
			$paypal_form .= '<input id="currency_code" 				name="currency_code" 	type="hidden" 		value="'.$this->config->item('paypal_currency_code').'"/>';
			$paypal_form .= '<input id="item_name_1" 				name="item_name_1" 		type="hidden" 		value="'.$package_name.'"/>';
			$paypal_form .= '<input id="amount_1" 					name="amount_1" 		type="hidden" 		value="'.$price.'"/>';
			$paypal_form .= '<input id="quantity_1" 				name="quantity_1" 		type="hidden" 		value="1"/>';
			$paypal_form .= '<input id="no_shipping" 				name="no_shipping" 		type="hidden" 		value="1"/>';
			$paypal_form .= '<input id="charset" 					name="charset" 			type="hidden" 		value="UTF-8"/>';
			$paypal_form .= '<input id="return" 					name="return" 			type="hidden" 		value="'.site_url('myaccount/donate/paypal_canceled').'"/>';
			$paypal_form .= '<input id="rm" 						name="rm" 				type="hidden" 		value="2"/>';
			$paypal_form .= '<input id="cbt" 						name="cbt" 				type="hidden" 		value="'.$this->config->item('paypal_cbt').'"/>';
			$paypal_form .= '<input id="notify_url" 				name="notify_url" 		type="hidden" 		value="'.site_url('paypal_ipn').'"/>	';
			
			$this->template_data['template']['paypal_form'] = $paypal_form;				
		}	
		else
		{
			$this->template_data['template']['paypal_form'] = 'ERROR';	
		}	
		
		$this->template_data['template']['body_id'] = 'account';
		$this->template_data['template']['active_page'] = $this->uri->segment(1);
		$this->load->view('myaccount/view_redirect_paypal', $this->template_data);		
	}
	
	public function calculateWidgetSignature($params, $secret)
	{
		ksort($params);
		$baseString = '';
		foreach($params as $key => $value)
		{
			$baseString .= $key . '=' . $value;
		}
		$baseString .= $secret;
		return md5($baseString);
	}
	
	public function GenerateInvoiceSession()
	{
		$invoice = $this->session->userdata('user_no') . time();
		$data['paypal_invoice'] = $invoice;
		$this->session->set_userdata($data);
		return $invoice;	
	}

	
}