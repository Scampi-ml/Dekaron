<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller{
	private $data = array();
	
	function __construct(){
        parent::__construct();
		$this->data['push_css'] = array('news.css', 'nivo-slider.css', 'bbc.css');
		$this->data['push_js'] = array('jquery.nivo.slider.js');	
		$this->force_compile = true;	
		$this->load->model('ipbnews_model');
	}
	
	public function index(){
		$sliders = $this->config->item('slider');
		$slider = '';
		for($i = 0; $i < count($sliders); ++$i){
			$slider .= '<a href="'.$sliders[$i][0].'"><img src="'.base_url('assets/images/slider/'.$sliders[$i][1]).'" target="'.$sliders[$i][3].'" /></a>';
		}
		$this->data['nivoSlider'] = $slider; 
		
		
		// Begin news
		if(!$this->cache->get('news/news'))
		{
			$this->data['articles'] = $this->ipbnews_model->getIpbWebsiteNews('2'); // (x + 1)
		} else {
			$this->data['articles'] = $this->cache->get('news/news');
		}
		$this->data['more_news'] = $this->config->item('rss_news_url_more');
		// End news
		
		
		$this->data['title'] = 'Welcome!';
		$this->smarty->view( 'view_home.tpl', $this->data );		
	}	
}