<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends MY_Controller
{
    private $data = array();
	
	function __construct()
	{
        parent::__construct();
    }	
	
	public function index()
	{
		$this->data['form_open'] = form_open('register/CheckRegister', array('class'=>"page_form"));
		$this->data['title'] = 'Register';	
		$this->smarty->view( 'view_register.tpl', $this->data );
	}
	
	
	public function view()
	{
		$this->smarty->view( 'view_register_done.tpl', $this->data );	
	}
	
	
	public function CheckRegister()
	{
		$this->form_validation->set_error_delimiters('<div class="boxerror">', '</div>');
		$this->form_validation->set_rules('Username', 				'Account Name', 			'trim|required|min_length[4]|max_length[12]|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('Password', 				'Password', 				'trim|required|min_length[4]|max_length[102]|xss_clean');
		$this->form_validation->set_rules('rePassword', 			'Confirm Password', 		'required|matches[Password]');
		$this->form_validation->set_rules('emailAddress', 			'Email', 					'trim|required|valid_email|strtolower|xss_clean');
		$this->form_validation->set_rules('rules', 					'Terms of Use', 			'trim|required|xss_clean');
		
		if ($this->form_validation->run() == FALSE)
		{
			 $this->data['validation_errors'] = validation_errors();
			 $this->index();
		}
		else
		{
			
			//set POST variables
			$url = 'http://50.115.121.228/dekaron9/registera99testDREAMS.php';
			$fields = array(
						'accname' 	=> $this->input->post('Username'),
						'accpass1' 	=> $this->input->post('Password'),
						'accpass2' 	=> $this->input->post('rePassword'),
						'accmail' 	=> $this->input->post('emailAddress'),
			);
			
			//url-ify the data for the POST
			$fields_string = '';
			
			foreach($fields as $key=>$value)
			{ 
				$fields_string .= $key.'='.$value.'&';
			}
			
			substr($fields_string, 0, -2);
			
			
			//open connection
			$ch = curl_init();
			
			//set the url, number of POST vars, POST data
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			
			//execute post
			$result = curl_exec($ch);
			
			//close connection
			curl_close($ch);
			
			// Display any errors
			if($result === 'Error: Special chars. ') // string 'Error: Special chars. ' (length=22)
			{
				$this->data['errors'] = '<div class="boxerror">You are not allowed to use special characters!</div>';				
				$this->index();					
			}
			elseif($result === 'Error: Passwords no match. ') // string 'Error: Passwords no match. ' (length=27)
			{
				$this->data['validation_errors'] = '<div class="boxerror">Your passwords do not match!</div>';				
				$this->index();	
			}
			elseif($result === 'Error: Empty fields. ') // string 'Error: Empty fields. ' (length=21) 
			{
				$this->data['errors'] = '<div class="boxerror">Please fill in all fields!</div>';				
				$this->index();	
			}	
			elseif($result === 'Error: Acc already exists. ') // string 'Error: Acc already exists. ' (length=27)
			{
				$this->data['errors'] = '<div class="boxerror">Account name already exists! Please try another account name.</div>';		
				$this->index();	
			}
			elseif($result === 'Error: E-Mail already in use. ') // string 'Error: E-Mail already in use. ' (length=30)
			{
				$this->data['errors'] = '<div class="boxerror">E-mail already exists! Please try another E-mail.</div>';		
				$this->index();	
			}	
			elseif($result === '404 Error: Page not found') // string '404 Error: Page not found' (length=25)
			{
				$this->data['errors'] = '<div class="boxerror">Register server is offline! Please try again later.</div>';		
				$this->index();	
			}						
			elseif($result === 'Success ') // string 'Success ' (length=8)
			{
				$this->smarty->view( 'view_register_done.tpl', $this->data );	
			}
			else
			{
				$this->data['errors'] = '<div class="boxerror">'.$result.'</div>';			
				$this->index();						
			}
		
			// DEBUG INFO
			$debug = false;
			if($debug)
			{
				echo '<pre>';
					var_dump($result);
				echo '</pre><br>';
				
				echo '<pre>';
					var_dump($fields_string);
				echo '</pre><br>';				
				die();				
			}
			
			/*
			// load email model
			$this->load->model('m_email');
			
			// add data to prep email
			$data = array(
				'user' 			=> $this->input->post('Username'),
				'to' 			=> $this->input->post('emailAddress'),
				'validate_url' 	=> site_url('validate/email/'.$validation_token),
			);
			
			// send email
			$send_mail = $this->m_email->confirm_account($data);
			//$send_mail = true; // TESTING DO NOT UN-COMMENT!
			
				
			// all done, and working, move on!
			*/	
					
			
		}		
	}
}