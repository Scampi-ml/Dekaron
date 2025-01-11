<?php

class News extends MX_Controller
{
	private $news_articles = array();
	
	public function __construct()
	{
		parent::__construct();	
		$this->load->config('news');
		$this->load->model('news_model');

	}

	public function index()
	{
		requirePermission("view");

		if($this->config->item('news_internal'))
			$this->getNews();

		// Show the page
		$this->displayPage();
	}


	
	private function displayPage()
	{
		// Get the cache
		$cache = $this->cache->get("news");
		
		// Check if cache is valid
		if($cache !== false)
		{
			$this->template->view($cache, "modules/news/css/news.css");
		}
		else
		{
			$content = $this->template->loadPage("articles.tpl", array(
				"articles" => $this->news_articles,
				'url' => $this->template->page_url,
				'single' => false)
			);

			$this->cache->save("news", $content);

			// Load the template and pass the page content
			$this->template->view($content, "modules/news/css/news.css");
		}
	}
	
	private function getNews()
	{

		// Get the articles
		$this->news_articles = $this->news_model->getArticles(false, false);

		/*
		[title] => Encryption Process (Dragon Knight)
		[link] => http://www.dekaronuniversal.com/forums/topic/112-encryption-process-dragon-knight/
		[description] => Array
			(
			)

		[pubDate] => Sun, 07 Sep 2014 07:55:15 +0000
		[guid] => http://www.dekaronuniversal.com/forums/topic/112-encryption-process-dragon-knight/
		*/

		// For each key we need to add the special values that we want to print
		foreach($this->news_articles as $key => $article)
		{
			
			
			$this->news_articles[$key]['headline'] = $article['TITLE'];
			$this->news_articles[$key]['content'] = stripslashes ($article['DESCRIPTION'] );
			$this->news_articles[$key]['date'] = date("Y/m/d", strtotime($article['PUBDATE']));
			$this->news_articles[$key]['author'] = 'Forum News';
			$this->news_articles[$key]['link'] = $article['LINK'];
		}
	}

}
