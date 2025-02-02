<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->db = $this->load->database('default', TRUE); 
	}

	function index()
	{
		
		$this->db->select('*');
		$this->db->from('logs');		
		$this->db->limit(22);
		$this->db->order_by("id", "desc"); 
		
		
		$query = $this->db->get();
		
		$count = '0';
		$table = '';
		foreach($query->result() as $row)
		{
			
			$count++;
			$tr_color = ($count % 2) ? '' : 'even';
					
			$table .= "<tr class='" . $tr_color . "' >";
			
				$pieces = explode("/", $row->uri);
				$table .= "<td class='panel_text_alt_list'>&nbsp; " . $row->id . "</td>";
				$table .= "
				
				<td class='panel_text_alt_list'>&nbsp; <a href='".$pieces[0]."'>" . $pieces[0] . "</a> / <a href='".$pieces[0]."/".$pieces[1]."'>" . $pieces[1] . "</a></td>";
				$table .= "<td class='panel_text_alt_list'>&nbsp; " . $row->method . "</td>";
				$table .= "<td class='panel_text_alt_list'>&nbsp; " . $row->params . "</td>";
				$table .= "<td class='panel_text_alt_list'>&nbsp; " . $row->ip_address . "</td>";
				$table .= "<td class='panel_text_alt_list'>&nbsp; " . date('Y-m-d H:i:s', $row->time) . "</td>";
				$table .= "<td class='panel_text_alt_list'>&nbsp; " . $this->time_passed($row->time). "</td>";
			$table .= "</tr>";	
		}
		
		$data['table'] = $table;
		$data['controllerlist'] = $this->showList();
		
		
		
		$this->load->library('table');
		$this->load->helper('html');	
		$this->load->helper('url');
		$this->load->view('admin', $data);
	}
		
	function showList()
	{
		$this->load->library('controllerlist'); // Load the library
		return $this->controllerlist->getControllers();
	}	
	
	function time_passed($timestamp)
	{
		//type cast, current time, difference in timestamps
		$timestamp      = (int) $timestamp;
		$current_time   = time();
		$diff           = $current_time - $timestamp;
	   
		//intervals in seconds
		$intervals      = array (
			'year' => 31556926, 'month' => 2629744, 'week' => 604800, 'day' => 86400, 'hour' => 3600, 'minute'=> 60
		);
	   
		//now we just find the difference
		if ($diff == 0)
		{
			return 'just now';
		}   
	
		if ($diff < 60)
		{
			return $diff == 1 ? $diff . ' second ago' : $diff . ' seconds ago';
		}       
	
		if ($diff >= 60 && $diff < $intervals['hour'])
		{
			$diff = floor($diff/$intervals['minute']);
			return $diff == 1 ? $diff . ' minute ago' : $diff . ' minutes ago';
		}       
	
		if ($diff >= $intervals['hour'] && $diff < $intervals['day'])
		{
			$diff = floor($diff/$intervals['hour']);
			return $diff == 1 ? $diff . ' hour ago' : $diff . ' hours ago';
		}   
	
		if ($diff >= $intervals['day'] && $diff < $intervals['week'])
		{
			$diff = floor($diff/$intervals['day']);
			return $diff == 1 ? $diff . ' day ago' : $diff . ' days ago';
		}   
	
		if ($diff >= $intervals['week'] && $diff < $intervals['month'])
		{
			$diff = floor($diff/$intervals['week']);
			return $diff == 1 ? $diff . ' week ago' : $diff . ' weeks ago';
		}   
	
		if ($diff >= $intervals['month'] && $diff < $intervals['year'])
		{
			$diff = floor($diff/$intervals['month']);
			return $diff == 1 ? $diff . ' month ago' : $diff . ' months ago';
		}   
	
		if ($diff >= $intervals['year'])
		{
			$diff = floor($diff/$intervals['year']);
			return $diff == 1 ? $diff . ' year ago' : $diff . ' years ago';
		}
	}	
}
