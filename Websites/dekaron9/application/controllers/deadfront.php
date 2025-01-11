<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Deadfront extends MY_Controller
{	
	private $data = array();
	
	function __construct()
	{
        parent::__construct();
		$this->data['push_css'] = array('progress.css');	
		$this->data['push_js'] = array('deadfront.js');	
    }	
	
	public function index()
	{
		
		$this->data['deadfront_time'] = $this->config->item('deadfront_time');
		
		$dflist = '';
		$deadfront_list = $this->config->item('deadfront_list');
		for($i = 0; $i < count($deadfront_list); ++$i)
		{
			$dflist .= '
				<tr>
					<td align="center"><span style="color:#c59e4b">'.$deadfront_list[$i][0].'</span> </td>
					<td align="center"><span style="color:red">'.$deadfront_list[$i][2].' ~ '.$deadfront_list[$i][3].'</span></td>
					<td align="center"><span style="color:#816537">'.$deadfront_list[$i][1].'</span></td>	
				</tr>									
			';
		}
		$this->data['deadfront_list'] = $dflist;
		
		
		$this->data['title'] = 'Deadfront';
		$this->smarty->view( 'view_deadfront.tpl', $this->data );
	}
}