<?php
class User
{
	private $CI;
	private $id;
	private $username;
	private $password;
	private $email;
	private $online;
	private $register_date;
	private $last_ip;
	private $nickname;
	
	public function __construct()
	{
		$this->CI = &get_instance();
		$this->getUserData();
	}
	
	public function setUserDetails($username, $password){	
	
		$res = $this->CI->conn->api("setUserDetails", array('username' => $username, 'password' => $password));
		if(!$res)
		{
			show_error("Api failed");
		}
		elseif(isset($res->error))
		{
			return $res->error;
		}
		else
		{
			if(isset($res->user_no) && isset($res->user_id) && isset($res->user_pwd) && isset($res->user_mail))
			{
				$userdata = array(
					'id' 		=> $res->user_no,
					'username' 	=> $res->user_id,
					'password' 	=> $res->user_pwd,
					'online' 	=> true,
					'email' 	=> $res->user_mail,
					'last_ip' 	=> '127.0.0.1',
				);		
				$this->CI->session->set_userdata($userdata);
				$this->getUserData();			
				return 'ok';			
			
			}
			else
			{
				return $res->error;
			}
		}
	}
	
	public function getNickname($id = false)
	{
		$cache = $this->CI->cache->get("nicknames/". $id);
		if($cache !== false)
		{
			return $cache['user_id'];
		}
		else
		{
			$res = $this->CI->conn->api("getNickname", array("user_no" => $id));
			if(!$res)
			{
				show_error("Api failed");
			}
			else
			{
				$this->CI->cache->save("nicknames/".$id , array('user_id' => $res->user_id));
				return $res->user_id;
			}			
		}	
	}
	
	public function getUsername()
	{
		return $this->CI->session->userdata('username');
	}
	
	public function getId()
	{
		return $this->CI->session->userdata('id');
	}
	
	public function userArea()
	{
		if(!$this->online){
			$this->CI->template->view($this->CI->template->loadPage("page.tpl", array(
				"module" => "default", 
				"headline" => lang("denied"), 
				"content" => "<center style='margin:10px;font-weight:bold;'>".lang("must_be_signed_in")."</center>"
			)));
		}
		return;
	}
	
	public function guestArea()
	{
		if($this->online){
			$this->CI->template->view($this->CI->template->loadPage("page.tpl", array(
				"module" => "default", 
				"headline" => lang("denied"), 
				"content" => "<center style='margin:10px;font-weight:bold;'>".lang("already_signed_in")."</center>"
			)));
		}
		return;
	}
	public function isOnline()
	{
		return $this->online;
	}
	
	public function isGameOnline()
	{
		$res = $this->CI->conn->api("isGameOnline", array("user_no" => $id));
		
		
		if($res->login_flag == '1100')
		{
			return true;
		}
		else
		{
			return false;
		}
	}	
	
	public function getAvatar($id = false, $size = "normal"){
		return $this->CI->template->image_path.$this->CI->template->theme_data[$size.'_avatar'];
	}
		
	private function rankBiggerThan($a, $b)
	{
		$a = ($a == "") ? 0 : $a;
		$b = ($b == "") ? 0 : $b;
		if($a === $b){
			return false;
		}
		if(is_numeric($a) && is_numeric($b)){
			if($a < $b){
				return true;
			}else{
				return false;
			}
		}elseif(!is_numeric($a) && !is_numeric($b) && in_array($a, array("az", "a")) && in_array($b, array("az", "a"))){
			switch($a){
				case "az": $a = 1; break;
				case "a": $a = 0; break;
			}
			switch($b){
				case "az": $b = 1; break;
				case "a": $b = 0; break;
			}
			if($a < $b){
				return true;
			}else{
				return false;
			}
		}elseif(in_array($a, array("az", "a")) && is_numeric($b)){
			return false;
		}else{
			// Unknown
			return true;
		}
	}
	
	public function getUserData()
	{
		if($this->CI->session->userdata('online') == true)
		{
			$this->id = $this->CI->session->userdata('id');
			$this->username = $this->CI->session->userdata('username');
			$this->password = $this->CI->session->userdata('password');
			$this->email = $this->CI->session->userdata('email');
			$this->online = true;
			$this->last_ip = $this->CI->session->userdata('last_ip');
		}
		else
		{
			$this->id = 0;
			$this->username =  0;
			$this->password = 0;
			$this->email = null;
			$this->online = false;
			$this->last_ip = null;
		}
	}
	
	public function getCharacters($userId)
	{
		$res = $this->CI->conn->api("getCharacters", array("user_no" => $userId));
		return json_decode(json_encode($res), true);
	}	
	
	public function getVp()
	{
		return 0;	
	}
	
	public function getDp()
	{
		return 0;	
	}
	
}
