<?php
class Items extends MX_Controller 
{
	private $data;

	public function __construct()
	{
		parent::__construct();
		$this->load->library("administrator");
		$this->load->model("donate_paypal_model");
		adminPerm();
	}

	public function index()
	{
		$this->administrator->setTitle("Donate Paypal Items");
		
		$this->data['url'] = $this->template->page_url;
		$this->getItems();

		$output = $this->template->loadPage("donate_paypal_items.tpl", $this->data);
		$content = $this->administrator->box('Donate Paypal Items', $output);
		$this->administrator->view($content, false, "modules/donate_paypal/js/donate_paypal_items.js");
	}

	public function add()
	{
		$this->administrator->setTitle("Add Item");
		
		$this->data['url'] = $this->template->page_url;


		$output = $this->template->loadPage("donate_paypal_items_add.tpl", $this->data);
		$content = $this->administrator->box('Add Item', $output);
		$this->administrator->view($content, false, "modules/donate_paypal/js/donate_paypal_items.js");
	}

	public function edit($id)
	{
		$this->administrator->setTitle("Edit Item");
		
		$this->data['url'] = $this->template->page_url;

		adminPerm();
		if(!is_numeric($id) || !$id)
		{
			die();
		}

		$item = $this->donate_paypal_model->getItem($id);
	
		if(!$item)
		{
			show_error("There is no item with ID ".$id);
			die();
		}

		$this->data['item'] = $item;

		$output = $this->template->loadPage("donate_paypal_items_edit.tpl", $this->data);
		$content = $this->administrator->box('Edit Item', $output);
		$this->administrator->view($content, false, "modules/donate_paypal/js/donate_paypal_items.js");
	}	

	private function getItems()
	{
		$items = $this->donate_paypal_model->getItems();
		$this->data['items'] = $items;
	}	

	public function create()
	{
		adminPerm();
		$this->donate_paypal_model->add(
			$this->input->post('price'),
			$this->input->post('coins')
		);
		die("yes");
	}

	public function remove($id)
	{
		adminPerm();
		if(!is_numeric($id) || !$id)
		{
			die("ID is not a number");
		}		
		$re = $this->donate_paypal_model->remove($id);
		if($re)
		{
			die("yes");
		}
		else
		{
			die("no");	
		}
		
	}	

	public function save($id)
	{
		adminPerm();
		if(!is_numeric($id) || !$id)
		{
			die("ID is not a number");
		}		
		$this->donate_paypal_model->edit(
			$id,
			$this->input->post('price'),
			$this->input->post('coins')
		);
		die("yes");
	}	
}