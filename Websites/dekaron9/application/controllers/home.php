<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller
{
	private $data = array();
	private $news_articles = array();
	
	function __construct()
	{
        parent::__construct();
		$this->data['push_css'] = array('news.css', 'nivo-slider.css');
		$this->data['push_js'] = array('jquery.nivo.slider.js');		
		$this->load->model('news_model');
	}
	
	public function index()
	{
		// Begin slider
		$sliders = $this->config->item('slider');
		$slider = '';
		for($i = 0; $i < count($sliders); ++$i)
		{
			$slider .= '<a href="'.$sliders[$i][0].'"><img src="'.base_url('assets/images/slider/'.$sliders[$i][1]).'" target="'.$sliders[$i][3].'" /></a>';
		}
		$this->data['nivoSlider'] = $slider; 
		// End slider
		
		// Begin news
		$this->data['articles'] = $this->news_model->getArticles();
		// End news
		
		$this->data['title'] = 'Welcome!';
		$this->smarty->view( 'view_home.tpl', $this->data );		
	}	
	
}