<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_notifications extends MY_Model {

    public function get()
	{
		$query = $this->db->query('SELECT * FROM notifications WHERE user_no = "'.$this->session->userdata('user_no').'" ');
		if($query->num_rows() == 0)
		{
			// nothing, dont send anything
		}
		else
		{
			$arr = array();
			$array = $query->result_array();
			foreach($array as $arrrr)
			{
				$arr[] = array(
					'type' 		=> $arrrr['type'],
					'from' 		=> $arrrr['from'],
					'message' 	=> $arrrr['message']						
				);				
			}
			$this->session->set_userdata('notifications', $arr);
		}
    }
}
