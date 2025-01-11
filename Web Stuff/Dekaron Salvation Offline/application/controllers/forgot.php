<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Forgot extends MY_Controller{
    private $data = array();
	
	function __construct(){
        parent::__construct();
    }	
	
	public function index()
	{
		$this->data['form_open'] = form_open('forgot/account', array('class'=>"page_form"));
		$key = $this->input->get('key');
		
		if($key == '')
		{
			$this->data['start_errors'] = 'Missing Key';
		}
		else
		{
			$cache = $this->cache->get('fp/'.$key);
			if(!$cache)
			{
				unlink("application/cache/data/fp/".$key.".cache");
				$this->data['start_errors'] = 'Key not found or expired';	
			}
			else
			{
				$this->session->set_userdata(array('key' => $key));				
			}
		}	
		$this->data['title'] = 'Forgot';	
		$this->smarty->view( 'view_forgot.tpl', $this->data );
	}
	
	
	public function account()
	{
		$this->form_validation->set_rules('accname', 			'Account Name', 			'trim|required|min_length[4]|max_length[16]|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('NewPassword', 		'New Password', 			'trim|required|min_length[4]|max_length[16]|xss_clean');
		$this->form_validation->set_rules('reNewPassword', 		'Confirm New Password', 	'trim|required|min_length[4]|max_length[16]|matches[NewPassword]|xss_clean');
		
		if ($this->form_validation->run() == FALSE) {
			 $this->data['validation_errors'] = validation_errors();
			 $this->index();
		} else {
		
			
			$key = $this->session->userdata('key');
			$cache = $this->cache->get('fp/'.$key);
			if(!$cache) {
				$this->data['validation_errors'] = 'Key not found or expired';	
				$this->index();
			} elseif($cache != $this->input->post('accname')) {
				$this->data['validation_errors'] = 'Data does not match';	
				$this->index();			
			} else {
				$this->load->library('api', array('server' => $this->config->item('api_url')));
				$fields = array(
					'user_id' => $this->input->post('accname'),
					'user_pwd' => md5($this->input->post('OldPassword')),
					'user_pwd_new' => md5($this->input->post('NewPassword')),
				);
				$fu = $this->api->get('account/ChangePasswordServ', $fields, 'json');
				
				if(isset($fu->status) && $fu->status == 'true' && $fu->result == 'true'){
					
					$this->session->unset_userdata(array('key' => ''));
					unlink("application/cache/data/fp/".$key.".cache");
					$this->data['message'] = 'Your password has been changed!';	
						
					$this->index();	
				} else {
					$this->data['validation_errors'] = $fu->error;
					$this->index();	
				}				
			}
		}
	}
}