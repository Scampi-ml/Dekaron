<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends MY_Controller{
    private $data = array();
	
	function __construct(){
        parent::__construct();
    }	
	
	public function index(){
		$this->data['form_open'] = form_open('register/CheckRegister', array('class'=>"page_form"));		
		$this->data['title'] = 'Register';	
		$this->smarty->view( 'view_register.tpl', $this->data );
	}
	
	public function CheckRegister(){
		$this->form_validation->set_rules('Username', 				'Account Name', 			'trim|required|min_length[4]|max_length[16]|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('Password', 				'Password', 				'trim|required|min_length[4]|max_length[16]|xss_clean');
		$this->form_validation->set_rules('rePassword', 			'Confirm Password', 		'required|matches[Password]|xss_clean');
		$this->form_validation->set_rules('emailAddress', 			'Email', 					'trim|required|valid_email|strtolower|xss_clean');
		$this->form_validation->set_rules('reEmailAddress', 		'Confirm Email',			'required|matches[emailAddress]|xss_clean');
		$this->form_validation->set_rules('rules', 					'Terms of Use', 			'trim|required|xss_clean');
		
		if ($this->form_validation->run() == FALSE) {
			 $this->data['validation_errors'] = validation_errors();
			 $this->index();
		} else {

			//set POST variables
			$url = 'http://50.115.121.228/salvation/registera99testSalvation.php';
			$fields = array(
					'accname' 	=> $this->input->post('Username'),
					'accpass1' 	=> $this->input->post('Password'),
					'accpass2' 	=> $this->input->post('rePassword'),
					'accmail' 	=> $this->input->post('emailAddress')
			);
			
			$fields_string = '';
			
			foreach($fields as $key=>$value)
			{ 
				$fields_string .= $key.'='.$value.'&';
			}	
			
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$result = curl_exec($ch);
			curl_close($ch);
			
					
			if($result === 'Success ') // string 'Success ' (length=8)
			{
				$this->data['title'] = 'Register successfull';	
				$this->smarty->view( 'view_register_done.tpl', $this->data );
			}
			else
			{
				$this->data['validation_errors'] = $result;			
				$this->index();						
			}

		}		
	}
}