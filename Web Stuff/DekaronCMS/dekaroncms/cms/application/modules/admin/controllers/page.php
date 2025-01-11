<?php

class Page extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('administrator');
		$this->load->model('page_model');
		adminPerm();	
	}

	public function index()
	{
		$this->administrator->setTitle("Pages");

		$pages = $this->page_model->getPages(true);

		if($pages)
		{
			foreach($pages as $key => $value)
			{
				$pages[$key]['name'] = $pages[$key]['name'];

				if(strlen($pages[$key]['name']) > 20)
				{
					$pages[$key]['name'] = mb_substr($pages[$key]['name'], 0, 20) . '...';
				}
			}
		}

		$data = array(
			'url' => $this->template->page_url,
			'pages' => $pages
		);

		$output = $this->template->loadPage("page/page.tpl", $data);
		$content = $this->administrator->box('Custom pages', $output);
		$this->administrator->view($content, false, "modules/admin/js/page.js");
	}

	public function edit($id = false)
	{
		adminPerm();

		if(!$id || !is_numeric($id))
		{
			die();
		}

		$page = $this->page_model->getPage($id);

		if($page == false)
		{
			show_error("There is no page with ID ".$id);

			die();
		}
		$this->administrator->setTitle($page['name']);

		$data = array(
			'url' => $this->template->page_url,
			'page' => $page
		);

		$output = $this->template->loadPage("page/page_edit.tpl", $data);
		$content = $this->administrator->box('<a href="'.$this->template->page_url.'admin/page">Custom pages</a> &rarr; '.$page['name'], $output);
		$this->administrator->view($content, false, "modules/admin/js/page.js");
	}

	public function create($id = false)
	{
		$this->administrator->setTitle('Create Page');

		$data = array(
			'url' => $this->template->page_url
		);

		$output = $this->template->loadPage("page/page_create.tpl", $data);
		$content = $this->administrator->box('Create Page', $output);
		$this->administrator->view($content, false, "modules/admin/js/page.js");
	}	

	public function delete($id = false)
	{
		adminPerm();

		if(!$id)
		{
			die();
		}
		
		$this->cache->delete('page_*.cache');
		$this->page_model->delete($id);
		die("yes");
	}

	public function send($id = false)
	{
		adminPerm();

		$headline = $this->input->post('name');
		$identifier = $this->input->post('identifier');
		$content = $this->input->post('content');

		if(strlen($headline) > 70 || empty($headline))
		{
			die("The headline must be between 1-70 characters long");
		}

		if(empty($content))
		{
			die("Content can't be empty");
		}

		if(empty($identifier) || !preg_match("/^[A-Za-z0-9]*$/", $identifier))
		{
			die("Identifier can't be empty and may only contain numbers and letters");
		}

		$identifier = strtolower($identifier);

		if($identifier == "admin")
		{
			die("The identifier <b>admin</b> is reserved by the system");
		}

		if($this->page_model->pageExists($identifier, $id))
		{
			die("The identifier is already in use");
		}

		if($id)
		{
			$this->page_model->update($id, $headline, $identifier, $content);
			$this->cache->delete('page_*.cache');

			$hasPermission = $this->page_model->hasPermission($id);

			if($this->input->post('visibility') == "group" && !$hasPermission)
			{
				$this->page_model->setPermission($id);
			}
			elseif($this->input->post('visibility') != "group" && $hasPermission)
			{
				$this->page_model->deletePermission($id);
			}
		}
		else
		{
			$id = $this->page_model->create($headline, $identifier, $content);

			if($this->input->post('visibility') == "group")
			{
				$this->page_model->setPermission($id);
			}
		}

		die("yes");
	}
}