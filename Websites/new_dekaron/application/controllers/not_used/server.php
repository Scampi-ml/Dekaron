<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Server extends MY_Controller
{
	public function index()
	{
		$server_list = $this->config->item('servers');
		
		$output = '';
		for($i = 0; $i < count($server_list); ++$i)
		{
			//array('127.0.0.2', 		'1433', 	'MsSQL Server',			'1',	'3600',		'mssql_server'),
			$check = $this->CheckServer($server_list[$i][0], $server_list[$i][1], $server_list[$i][3]);
			if(!$check)
			{
				$img = 'assets/images/server/Status_Red.png';
			}
			else
			{
				$img = 'assets/images/server/Status_Green.png';
			}
			
			$output .= '<div class="arsenal-searcharea" style="width:70%">';
				$output .= '<div class="server-status">';
					$output .= '<img class="status-icon" src="'.base_url($img).'">';
					$output .= '<div class="desc">'.$server_list[$i][2].'</div>';
					$output .= '<p class="status"><strong>Checked:</strong> '.date(DATE_RFC822).'</p>';
				$output .= '</div>';       
			$output .= '</div>';
		}	 		
		
		$this->template_data['template']['server_list'] = $output;
		
		$this->template_data['template']['body_id'] = 'howtoconnect';
		$this->template_data['template']['active_page'] = $this->uri->segment(1);
		$this->load->view('view_server', $this->template_data);
	}
	
	public function CheckServer($ip, $port, $timeout)
	{
		if($ip == '127.0.0.2')
		{
			// this is dummy data, return TRUE
			return true;
		}
		else
		{
			$fp = @fsockopen($ip, $port, $errno, $errstr, $timeout);
			if (!$fp)
			{
				@fclose($fp);
				return false;
			}
			else
			{
				@fclose($fp);
				return true;
			}		
		}
	}
}