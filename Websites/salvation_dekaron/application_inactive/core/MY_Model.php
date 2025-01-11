<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Model extends CI_Model {

	public function create_serial()
	{
		// create a MD5 from time with microtime
    	$time = explode(".", microtime(true));		
		return md5($time[0]);
	}
	
	
}