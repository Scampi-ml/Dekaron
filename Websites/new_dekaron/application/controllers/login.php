<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Login extends MY_Controller
{
    function __construct()
	{
        parent::__construct();
        // Initialize the variables
		$this->db_account = $this->load->database('account', TRUE); 
    }	
	
	public function index()
	{
		$this->template_data['template']['body_id'] = 'login';
        $this->load->view('view_login', $this->template_data);
    }
	
	public function CheckLogin()
	{
        $this->form_validation->set_error_delimiters('<small class="error"> ', '</small>');
		$this->form_validation->set_rules('Username', 		'Username', 		'trim|required|min_length[4]|max_length[16]|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('Password', 		'Password', 		'trim|required|min_length[4]|max_length[16]|md5');

		if ($this->form_validation->run() == FALSE)
		{
			 $this->template_data['template']['body_id'] = 'login';
			 $this->load->view('view_login', $this->template_data);
		}
		else
		{
			/********************************/
			
			$query = $this->db_account->query("SELECT * FROM user_profile WHERE user_id = '".$this->input->post('Username')."' AND user_pwd = '".$this->input->post('Password')."' ");
			if($query->num_rows() == 0)
			{
				$this->template_data['template']['result'] = '<small class="error">Incorrect username or password</small>';
				$this->template_data['template']['body_id'] = 'login';
				$this->load->view('view_login', $this->template_data);	
			}
			else
			{
				$row = $query->row();
				
				// load user_data table
				$query2 = $this->db_account->query("SELECT * FROM user_data WHERE user_no = '".$row->user_no."' ");
				$row2 = $query2->row(); 
				
				// set session data from user_profile
				$user_data['user_id'] = $row->user_id;
				$user_data['user_no'] = $row->user_no; 	
				
				// set session data from user_data
				$user_data['isgm'] = $row2->isgm;	
				$user_data['last_vote'] = $row2->last_vote;	
				$user_data['can_vote'] = $row2->can_vote;
				$user_data['email'] = $row2->email;	
				
				// set custom stuff
				$user_data['login_time'] = time();	
				
				// set coins to session
				$this->load->model('m_cash');
				$user_data['coins'] = $this->m_cash->GetCoinsNoSession($row->user_no);					
				
				// put it all in session
				$this->session->set_userdata($user_data);
				
				// Set login to user_log
				$this->load->model('m_website');
				$this->m_website->AddLogin();				
				

				redirect( $this->config->item('redirect_after_login') );
				
			}
		}		
	}
}