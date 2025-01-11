<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Donate extends MY_Controller{
	private $data;
	
	function __construct(){
        parent::__construct();
		$this->data = array();
		$this->data['form_open'] = form_open('donate/donate_option', array('class'=>"page_form"));
		$this->data['form_open2'] = form_open('donate/donate_pay', array('class'=>"page_form"));
		$this->data['title'] = 'Donate';
	}
	
	public function index()
	{
		$this->smarty->view( 'view_donate_index.tpl', $this->data );		
	}
	
	public function donate_option()
	{
		$this->form_validation->set_rules('charname', 				'Character Name', 				'trim|required|alpha_numeric|xss_clean');
		
		if ($this->form_validation->run() == FALSE) {
			 $this->data['validation_errors'] = validation_errors();
			 $this->index();
		} else {
			$user_data['donate_for'] = $this->input->post('charname');
			$this->session->set_userdata($user_data);
			$this->data['donate_for'] = $this->input->post('charname'); // session save
		}
		$this->smarty->view( 'view_donate_options.tpl', $this->data );		
	}
	
	public function donate_pay()
	{
		$this->data['donate_for'] = $this->session->userdata('donate_for'); // get session
		
		$this->form_validation->set_rules('option', 				'option', 				'trim|required|alpha_numeric|xss_clean');
		
		if ($this->form_validation->run() == FALSE) {
			 $this->data['validation_errors'] = validation_errors();
			 $this->index();
		} else {
		
			$user_data['donate_option'] = $this->input->post('option');
			$this->session->set_userdata($user_data);
			$this->data['donate_option'] = $this->input->post('option'); // get session
		}
		
		if($this->input->post('option') == 'paymentwall')
		{
			$params['key'] 					= $this->config->item('paymentwall_key');
			$params['uid'] 					= $this->session->userdata('donate_for');
			$params['widget'] 				= $this->config->item('paymentwall_widget');
			$this->data['paymentwall_url'] = http_build_query($params);		
			$this->smarty->view( 'view_donate_paymentwall.tpl', $this->data );	
		}
		elseif($this->input->post('option') == 'paypal')
		{
			$this->data['custom'] = $this->session->userdata('donate_for');
			$this->data['paypal_packages'] = $this->config->item('paypal_packages');
			$this->smarty->view( 'view_donate_paypal.tpl', $this->data );
		}
		else
		{
			$this->index();
		}
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

	
	
}