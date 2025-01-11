<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends MY_Controller{
    private $data = array();
	
	function __construct(){
        parent::__construct();
		$this->load->library('api', array('server' => $this->config->item('api_url')));
    }	
	
	public function index(){
		$this->data['form_open1'] = form_open('account/ForgotPassword', array('class'=>"page_form"));
		$this->data['form_open2'] = form_open('account/ForgotUsername', array('class'=>"page_form"));
		$this->data['form_open3'] = form_open('account/ChangePassword', array('class'=>"page_form"));
		$this->data['form_open4'] = form_open('account/ChangeEmail', array('class'=>"page_form"));
				
		$this->data['title'] = 'Account';	
		$this->smarty->view( 'view_account.tpl', $this->data );
	}
	
	public function ForgotPassword(){
		$this->form_validation->set_rules('accname', 'Account Name', 'trim|required|min_length[4]|max_length[16]|alpha_numeric|xss_clean');
		
		if ($this->form_validation->run() == FALSE) {
			 $this->data['validation_errors'] = validation_errors();
			 $this->index();
		} else {
			$random = md5(uniqid(rand()));
			
			$fields = array(
				'user_id' 	=> $this->input->post('accname'),
				'key' 		=> $random
			);
			
			$fp = $this->api->get('account/ForgotByAccount', $fields, 'json');
			
			if(isset($fp->status) && $fp->status == 'true' && $fp->result == 'true'){
			
				$this->cache->save('fp/'. $random, $this->input->post('accname'), '3600');
				$this->data['message'] = 'An email has been sent!';	
				$this->index();	
			} else {
				$this->data['validation_errors'] = $fp->error;
				$this->index();	
			}
		}		
	}
	
	public function ForgotUsername(){
		$this->form_validation->set_rules('emailAddress', 'Email', 'trim|required|valid_email|strtolower|xss_clean');
		
		if ($this->form_validation->run() == FALSE) {
			 $this->data['validation_errors'] = validation_errors();
			 $this->index();
		} else {
			
			$fields = array('email' => $this->input->post('emailAddress'));
			$fu = $this->api->get('account/ForgotByEmail', $fields, 'json');
			
			if(isset($fu->status) && $fu->status == 'true' && $fu->result == 'true'){
				
				$this->data['message'] = 'An email has been sent!';		
				$this->index();	
			} else {
				$this->data['validation_errors'] = $fu;
				$this->index();	
			}
		}		
	}
	
	public function ChangePassword(){
		$this->form_validation->set_rules('accname', 			'Account Name', 			'trim|required|min_length[4]|max_length[16]|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('OldPassword', 		'Current Password', 		'trim|required|min_length[4]|max_length[16]|xss_clean');
		$this->form_validation->set_rules('NewPassword', 		'New Password', 			'trim|required|min_length[4]|max_length[16]|xss_clean');
		$this->form_validation->set_rules('reNewPassword', 		'Confirm New Password', 	'trim|required|min_length[4]|max_length[16]|matches[NewPassword]|xss_clean');
		
		
		if ($this->form_validation->run() == FALSE) {
			 $this->data['validation_errors'] = validation_errors();
			 $this->index();
		} else {
		
			$fields = array(
				'user_id' => $this->input->post('accname'),
				'user_pwd' => md5($this->input->post('OldPassword')),
				'user_pwd_new' => md5($this->input->post('NewPassword')),
			);
			$fu = $this->api->get('account/ChangePassword', $fields, 'json');
			
			if(isset($fu->status) && $fu->status == 'true' && $fu->result == 'true'){
				$this->data['message'] = 'Your password has been changed!';		
				$this->index();	
			} else {
				$this->data['validation_errors'] = $fu->error;
				$this->index();	
			}		
		}
	}
	
	
	public function ChangeEmail(){
		$this->form_validation->set_rules('accname', 	'Account Name', 		'trim|required|min_length[4]|max_length[16]|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('Password', 	'Password', 			'trim|required|min_length[4]|max_length[16]|xss_clean');
		$this->form_validation->set_rules('NewEmail', 	'New Email', 			'trim|required|valid_email|strtolower|xss_clean');
		$this->form_validation->set_rules('reNewEmail', 'Confirm New Email', 	'trim|required|valid_email|strtolower|matches[NewEmail]|xss_clean');
		
		if ($this->form_validation->run() == FALSE) {
			 $this->data['validation_errors'] = validation_errors();
			 $this->index();
		} else {
		
			$fields = array(
				'user_id' => $this->input->post('accname'),
				'user_pwd' => md5($this->input->post('Password')),
				'user_mail_new' => $this->input->post('NewEmail'),
			);
			$ce = $this->api->get('account/ChangeEmail', $fields, 'json');
			
			if(isset($ce->status) && $ce->status == 'true' && $ce->result == 'true'){
				$this->data['message'] = 'Your email has been changed!';		
				$this->index();	
			} else {
				$this->data['validation_errors'] = $ce->error;
				$this->index();	
			}		
		}
	}
	
	
}