<?php
class News extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('administrator');
		$this->load->model('news_model');
		adminPerm();
	}

	public function index()
	{
		$this->administrator->setTitle("News");

		$articles = $this->news_model->getArticles(true);

		if($articles)
		{
			foreach($articles as $key => $value)
			{
				$articles[$key]['headline'] = $articles[$key]['headline'];
				$articles[$key]['content'] = $articles[$key]['content'];
				$articles[$key]['nickname'] = $this->user->adminName();
			}
		}

		$data = array('url' => $this->template->page_url,'news' => $articles);
		$output = $this->template->loadPage("news/news.tpl", $data);
		$content = $this->administrator->box('News articles', $output);
		$this->administrator->view($content, false, "modules/admin/js/news.js");
	}

	public function edit($id = false)
	{
		adminPerm();

		if(!$id || !is_numeric($id))
		{
			die();
		}

		$article = $this->news_model->getArticle($id);

		if(!$article)
		{
			show_error("There is no article with ID ".$id);
			die();
		}

		$this->administrator->setTitle($article['headline']);
		$data = array('url' => $this->template->page_url,'article' => $article);
		$output = $this->template->loadPage("news/news_edit.tpl", $data);
		$content = $this->administrator->box('<a href="'.$this->template->page_url.'admin/news">News articles</a> &rarr; '.$article['headline'], $output);
		$this->administrator->view($content, false, "modules/admin/js/news.js");
	}

	public function delete($id = false)
	{
		adminPerm();
		if(!$id){
			die("ID can't be empty");
		}

		$this->news_model->delete($id);
		$this->cache->delete('news_*.cache');
		die("yes");	
	}


	public function create($id = false)
	{
		adminPerm();
		$this->administrator->setTitle("Create article");

		$data = array('url' => $this->template->page_url);

		$output = $this->template->loadPage("news/news_create.tpl", $data);
		$content = $this->administrator->box('Create news article', $output);
		$this->administrator->view($content, false, "modules/admin/js/news.js");
	}

	public function send($id = false)
	{
		adminPerm();
		$headline = $this->input->post('headline');
		$content = $this->input->post('content');
		if(strlen($headline) > 70 || empty($headline)){
			die("The headline must be between 1-70 characters long");
		}

		if(empty($content)){
			die("Content can't be empty");
		}

		if($id){
			$this->news_model->update($id, $headline, $content);
		}else{
			$this->news_model->create($headline, $content);
		}

		$this->cache->delete('news_*.cache');
		die("yes");
	}
}