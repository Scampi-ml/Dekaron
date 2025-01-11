<?php
class News extends MX_Controller
{
	private $news_articles = array();
	private $startIndex = 0;
	
	public function __construct()
	{
		parent::__construct();	
		$this->load->library('pagination');
		$this->load->model('news_model');
	}

	public function sortByDate($a, $b)
	{
		return $b['timestamp'] - $a['timestamp'];
	}

	public function index()
	{
		$this->getNews();
		usort($this->news_articles, array($this, "sortByDate"));
		$this->displayPage();
	}

	public function view($id)
	{
		if(!$this->news_model->articleExists($id))
		{
			$this->index();
			return;
		}
			
		$cache = $this->cache->get("news_".$id);
		if($cache !== false)
		{
			$this->template->view($cache, "modules/news/css/news.css", false);
		}
		else
		{
			$this->news_articles = $this->template->format(array($this->news_model->getArticle($id)));
			foreach($this->news_articles as $key=>$article)
			{
				$this->news_articles[$key]['headline'] = $article['headline'];
				$this->news_articles[$key]['content'] = $article['content'];
				$this->news_articles[$key]['date'] = date("Y/m/d", $article['timestamp']);
				$this->news_articles[$key]['author'] = $this->user->adminName();
				$this->news_articles[$key]['link'] = '';
			}

			$content = $this->template->loadPage("articles.tpl", array("articles" => $this->news_articles, 'url' => $this->template->page_url, "pagination" => ''));
			$this->cache->save("news_id".$id, $content);
			$this->template->view($content, "modules/news/css/news.css", false);
		}
	}
	
	private function displayPage()
	{
		$cache = $this->cache->get("news_".$this->startIndex);
		if($cache !== false)
		{
			$this->template->view($cache, "modules/news/css/news.css", false);
		}
		else
		{
			$content = $this->template->loadPage("articles.tpl", array(
				"articles" => $this->news_articles,
				'url' => $this->template->page_url,
				"pagination" => $this->pagination->create_links(),
				'single' => false)
			);
			$this->cache->save("news_".$this->startIndex, $content);
			$this->template->view($content, "modules/news/css/news.css", false);
		}
	}
	
	private function getNews()
	{
		$config = $this->initPagination();
		$this->startIndex = $this->uri->segment($config['uri_segment']);
		
		if(empty($this->startIndex))
		{
			$this->startIndex = 0;
		}

		$this->news_articles = $this->news_model->getArticles($this->startIndex, ($this->startIndex + $config['per_page']));
		foreach($this->news_articles as $key => $article)
		{
			$this->news_articles[$key]['headline'] = $article['headline'];
			$this->news_articles[$key]['content'] = $article['content'];
			$this->news_articles[$key]['date'] = date("Y/m/d", $article['timestamp']);
			$this->news_articles[$key]['author'] = $this->user->adminName();
			$this->news_articles[$key]['link'] = '';
		}
	}
	
	private function initPagination()
	{
		$config['uri_segment'] 		= '2';
		$config['base_url'] 		= base_url().'/news';
		$config['total_rows'] 		= $this->news_model->countArticles();
		$config['per_page'] 		= $this->config->item('news_limit');
		$config['full_tag_open'] 	= '<div id="news_pagination">';
		$config['full_tag_close'] 	= '</div>';
		$config['last_link'] 		= '';
		$config['first_link'] 		= '';
		$config['next_link'] 		= 'Older posts &rarr;';
		$config['prev_link'] 		= '&larr; Newer posts';
		$config['display_pages'] 	= FALSE;
		$this->pagination->initialize($config);
		return $config;
	}
}
