<?php
class Admin extends MX_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library("administrator");
		$this->load->model("downloads_model");
		adminPerm();
	}

	public function index()
	{
		$this->administrator->setTitle("Downloads");
		$data = array(
			'url' => $this->template->page_url,
			'downloads' => $this->downloads_model->getDownloads(),
		);

		$output = $this->template->loadPage("admin.tpl", $data);
		$content = $this->administrator->box('Downloads', $output);
		$this->administrator->view($content, false, "modules/downloads/js/downloads.js");
	}

	public function edit($id = false)
	{
		adminPerm();
		if(!is_numeric($id) || !$id)
		{
			die();
		}

		$download = $this->downloads_model->getDownload($id);
	
		if(!$download)
		{
			show_error("There is no download with ID ".$id);
			die();
		}

		$this->administrator->setTitle($download['download_name']);

		$data = array(
			'url' => $this->template->page_url,
			'download' => $download
		);

		$output = $this->template->loadPage("downloads_edit.tpl", $data);
		$content = $this->administrator->box('<a href="'.$this->template->page_url.'downloads">Downloads links</a> &rarr; '.$download['download_name'], $output);
		$this->administrator->view($content, false, "modules/downloads/js/downloads.js");
	}	

	public function create()
	{
		$this->administrator->setTitle('Create Download');
		$data = array('url' => $this->template->page_url,);
		$output = $this->template->loadPage("downloads_create.tpl", $data);
		$content = $this->administrator->box('Create Download', $output);
		$this->administrator->view($content, false, "modules/downloads/js/downloads.js");
	}	


	
	public function saveEdit($id)
	{
		adminPerm();
		if(!$id || !is_numeric($id))
		{
			die("Invalid ID");
		}	

		$data = array(
			'download_name' => $this->input->post('name'),
			'download_link' => $this->input->post('link')
		);

		$this->downloads_model->edit($id, $data);
		die("yes");
	}
	
	public function delete($id)
	{
		adminPerm();
		if($this->downloads_model->delete($id))
		{
			die("yes");
		}
		else
		{
			die("An error occurred while trying to delete this download.");
		}
	}

	public function add()
	{
		adminPerm();
		$name = $this->input->post('name');
		$link = $this->input->post('link');
		$this->downloads_model->add($name, $link);
		die("yes");
	}
}