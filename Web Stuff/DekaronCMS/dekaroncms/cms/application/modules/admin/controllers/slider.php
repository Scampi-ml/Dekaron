<?php
class Slider extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('administrator');
		$this->load->model('slider_model');	
		adminPerm();
	}

	public function index()
	{
		$this->administrator->setTitle("Manage slider");
		$slides = $this->cms_model->getSlides();

		if($slides)
		{
			foreach($slides as $key => $value)
			{
				$slides[$key]['image'] = preg_replace("/{path}/", "", $value['image']);

				if(strlen($slides[$key]['image']) > 15)
				{
					$slides[$key]['image'] = "...".mb_substr($slides[$key]['image'], strlen($slides[$key]['image'])-15, 15);
				}

				if(strlen($value['text']) > 12)
				{
					$slides[$key]['text'] = mb_substr($value['text'], 0, 12) . '...';
				}

				if(strlen($value['link']) > 12)
				{
					$slides[$key]['link_short'] = mb_substr($value['link'], 0, 12) . '...';
				}
				else
				{
					$slides[$key]['link_short'] = $value['link'];
				}
			}
		}

		$data = array(
			'url' => $this->template->page_url,
			'slides' => $slides,
			"slider" => $this->config->item('slider'),
			"slider_home" => $this->config->item('slider_home'),
			"slider_interval" => $this->config->item('slider_interval'),
			"slider_style" => $this->config->item('slider_style')
		);

		$output = $this->template->loadPage("slider/slider.tpl", $data);
		$content = $this->administrator->box('Manage slider', $output);
		$this->administrator->view($content, false, "modules/admin/js/slider.js");
	}

	public function create()
	{
		$this->administrator->setTitle("Manage slider");
		$output = $this->template->loadPage("slider/slider_create.tpl");
		$content = $this->administrator->box('Create slider', $output);
		$this->administrator->view($content, false, "modules/admin/js/slider.js");
	}

	public function add()
	{
		adminPerm();
		$data["image"] = $this->input->post("image");
		$data["link"] = $this->input->post("link");
		$data["text"] = $this->input->post("text");

		if(!preg_match("/http:\/\//", $data['image']))
		{
			$data['image'] = "{path}".$data['image'];
		}

		$this->slider_model->add($data);

		die('window.location.reload(true)');
	}

	public function edit($id = false)
	{
		if(!is_numeric($id) || !$id)
		{
			die();
		}

		$slide = $this->slider_model->getSlide($id);

		if(!$slide)
		{
			show_error("There is no slide with ID ".$id);

			die();
		}

		$this->administrator->setTitle('Slide #'.$slide['id']);

		$data = array(
			'url' => $this->template->page_url,
			'slide' => $slide
		);

		$output = $this->template->loadPage("slider/slider_edit.tpl", $data);
		$content = $this->administrator->box('<a href="'.$this->template->page_url.'admin/slider">Manage slider</a> &rarr; Slide #'.$slide['id'], $output);
		$this->administrator->view($content, false, "modules/admin/js/slider.js");
	}

	public function move($id = false, $direction = false)
	{
		adminPerm();
		$order = $this->slider_model->getOrder($id);

		if(!$order)
		{
			die();
		}
		else
		{
			if($direction == "up")
			{
				$target = $this->slider_model->getPreviousOrder($order);
			}
			else
			{
				$target = $this->slider_model->getNextOrder($order);
			}

			if(!$target)
			{
				die();
			}
			else
			{
				$this->slider_model->setOrder($id, $target['order']);
				$this->slider_model->setOrder($target['id'], $order);
			}
		}
	}

	public function saveSettings()
	{
		adminPerm();
		require_once('application/libraries/configeditor.php');

		$slider = $this->input->post("show_slider");

		if(!is_numeric($this->input->post("slider_interval")) || !$this->input->post("slider_interval"))
		{
			$slider_interval = 5000;
		}
		else
		{
			$slider_interval = (int)$this->input->post("slider_interval");
		}

		$slider_style = $this->input->post("slider_style");

		if($slider == "always")
		{
			$slider = true;
			$slider_home = false;
		}
		elseif($slider == "home")
		{
			$slider = true;
			$slider_home = true;
		}
		else
		{
			$slider = false;
			$slider_home = false;
		}

		$Config = new ConfigEditor("application/config/cms.php");

		$Config->set('slider', $slider);
		$Config->set('slider_interval', $slider_interval);
		$Config->set('slider_home', $slider_home);
		$Config->set('slider_style', $slider_style);

		$Config->save();

		die("yes");
	}

	public function save($id = false)
	{
		adminPerm();
		if(!$id || !is_numeric($id))
		{
			die("ID is not a number");
		}

		$data["image"] = $this->input->post("image");
		$data["link"] = $this->input->post("link");
		$data["text"] = $this->input->post("text");

		if(!preg_match("/http:\/\//", $data['image']))
		{
			$data['image'] = "{path}".$data['image'];
		}

		$this->slider_model->edit($id, $data);

		die("yes");
	}

	public function delete($id = false)
	{
		adminPerm();
		if(!$id || !is_numeric($id))
		{
			die("ID is not a number");
		}

		$this->slider_model->delete($id);
	}
}