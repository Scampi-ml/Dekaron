<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Download extends MY_Controller
{
	function __construct()
	{
        parent::__construct();
	}

	public function index()
	{
		if($this->config->item('download_page_active'))
		{
			$this->template_data['template']['download_list'] = $this->config->item('downloads');
			$this->template_data['template']['body_id'] = 'arsenal';
			$this->template_data['template']['active_page'] = $this->uri->segment(1);
			$this->load->view('view_download', $this->template_data);		
		}
		else
		{
			redirect($this->config->item('download_page_url'));	
		}
	}
	
	public function DownloadFile()
	{
	  	$download_list = $this->config->item('downloads');
		$input = $this->uri->segment(3);
		
		$valid = FALSE;
		for($i = 0; $i < count($download_list); ++$i)
		{
			if($download_list[$i][3] == $input)
			{
				$valid = TRUE;
				break;
			}
		}		
		
		if($valid)	
		{
			$this->template_data['template']['message'] = '';
			$this->template_data['template']['redirect_url'] = $download_list[$i][0];
			$this->template_data['template']['redirect_name'] = $download_list[$i][1];
		}
		else
		{
			$this->template_data['template']['message'] = '<div class="notice-container"><div class="error clearfix" id="notice"><div class="notice-inner"><p>Invalid Mirror Link</p></div></div></div>';
		}
		$this->template_data['template']['download_list'] = $this->config->item('downloads');
		$this->template_data['template']['body_id'] = 'arsenal';
		$this->template_data['template']['active_page'] = $this->uri->segment(1);
		$this->load->view('view_download', $this->template_data);
	}
}