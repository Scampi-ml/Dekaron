<?php
class Menu extends MX_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library("administrator");
		$this->load->model("menu_model");
		adminPerm();
	}

	public function index()
	{
		$this->administrator->setTitle("Menu");
		$links = $this->menu_model->getMenuLinks();
		if($links)
		{
			foreach($links as $key => $value)
			{
				$links[$key]['link_short'] = $value['link'];
				if(!preg_match("/https?:\/\//", $value['link'])){
					$links[$key]['link'] = $this->template->page_url . $value['link'];
				}

				$links[$key]['name'] = $links[$key]['name'];

				if(strlen($links[$key]['name']) > 15){
					$links[$key]['name'] = mb_substr($links[$key]['name'], 0, 15) . '...';
				}
			}
		}

		$pages = $this->menu_model->getPages();
		foreach($pages as $k => $v){
			$pages[$k]['name'] = $v['name'];
		}

		$data = array(
			'url' => $this->template->page_url,
			'links' => $links,
			'pages' => $pages
		);

		$output = $this->template->loadPage("menu/menu.tpl", $data);
		$content = $this->administrator->box('Menu links', $output);
		$this->administrator->view($content, false, "modules/admin/js/menu.js");
	}
	
	public function send()
	{
		adminPerm();
		$name = $this->input->post('name');
		$link = $this->input->post('link');
		$side = $this->input->post('side');
		$direct_link = $this->input->post('direct_link');
		$id = $this->menu_model->add($name, $link, $side, $direct_link);
		if($this->input->post('visibility') == "group")
		{
			$this->menu_model->setPermission($id);
		}
		die("yes");
	}
	
	public function delete($id)
	{
		adminPerm();
		if($this->menu_model->delete($id))
		{
			die("success");
		}
		else
		{
			die("An error occurred while trying to delete this menu link.");
		}
		
	}

	public function edit($id = false)
	{
		if(!is_numeric($id) || !$id)
		{
			die();
		}

		$link = $this->menu_model->getMenuLink($id);
	
		if(!$link){
			show_error("There is no link with ID ".$id);
			die();
		}

		$this->administrator->setTitle($link['name']);

		$data = array(
			'url' => $this->template->page_url,
			'link' => $link
		);

		$output = $this->template->loadPage("menu/menu_edit.tpl", $data);
		$content = $this->administrator->box('<a href="'.$this->template->page_url.'menu">Menu links</a> &rarr; '.$link['name'], $output);
		$this->administrator->view($content, false, "modules/admin/js/menu.js");
	}

	public function create()
	{
		$this->administrator->setTitle('Create Link');
		$data = array('url' => $this->template->page_url,);
		$output = $this->template->loadPage("menu/menu_create.tpl", $data);
		$content = $this->administrator->box('Create Link', $output);
		$this->administrator->view($content, false, "modules/admin/js/menu.js");
	}	

	public function move($id = false, $direction = false)
	{
		adminPerm();
		if(!$id || !$direction){
			die();
		}else{
			$order = $this->menu_model->getOrder($id);

			if(!$order){
				die();
			}else{
				if($direction == "up"){
					$target = $this->menu_model->getPreviousOrder($order);
				}else{
					$target = $this->menu_model->getNextOrder($order);
				}

				if(!$target){
					die();
				}else{
					$this->menu_model->setOrder($id, $target['order']);
					$this->menu_model->setOrder($target['id'], $order);
				}
			}
		}
	}

	public function save($id = false)
	{
		adminPerm();

		if(!$id || !is_numeric($id)){
			die();
		}

		$data['name'] = $this->input->post('name');
		$data['link'] = $this->input->post('link');
		$data['side'] = $this->input->post('side');
		$data['direct_link'] = $this->input->post('direct_link');

		$this->menu_model->edit($id, $data);
		$hasPermission = $this->menu_model->hasPermission($id);

		if($this->input->post('visibility') == "group" && !$hasPermission){
			$this->menu_model->setPermission($id);
		}elseif($this->input->post('visibility') != "group" && $hasPermission){
			$this->menu_model->deletePermission($id);
		}
		die("yes");
	}
}