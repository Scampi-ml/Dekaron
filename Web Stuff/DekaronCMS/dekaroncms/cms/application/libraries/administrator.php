<?php
class Administrator
{
	protected $CI;
	private $theme_path;
	private $menu;
	private $title;
	private $currentPage;
	private $version;
	
	public function __construct()
	{
		$this->CI = &get_instance();
		$this->theme_path = "application/themes/admin/";
		$this->menu = array();
		$this->showLogIn();
		$this->loadModules();
		$this->getMenuLinks();
	}

	private function showLogIn()
	{
		if(!$this->CI->session->userdata('admin_access'))
		{
			if(count($_POST) == 0)
			{
				$data = array("url" => $this->CI->template->page_url);
				$output = $this->CI->smarty->view($this->theme_path."login.tpl", $data, true);
				die($output);
			}
			else
			{
				$this->logIn();
			}
		}
	}	

	private function logIn()
	{
		$this->CI->load->library('form_validation');

		$this->CI->form_validation->set_rules('username', 'username', 'trim|required|alpha_numeric|xss_clean');
		$this->CI->form_validation->set_rules('password', 'password', 'trim|required|md5|xss_clean');

		if($this->CI->form_validation->run() == FALSE)
		{
			$data = array(
				"url" => $this->CI->template->page_url,
				"validation_errors" => validation_errors()
			);
			$output = $this->CI->smarty->view($this->theme_path."login.tpl", $data, true);
			die($output);
		}
		else
		{			
			if($this->CI->input->post('username') != $this->CI->config->item('admin_username') && $this->CI->input->post('password') != md5($this->CI->config->item('admin_password')))
			{
				$data = array(
					"url" => $this->CI->template->page_url,
					"validation_errors" => 'Incorrect username or password.'
				);
				$output = $this->CI->smarty->view($this->theme_path."login.tpl", $data, true);
				die($output);			
			}
			else
			{
				$this->CI->session->set_userdata(array('admin_access' => true,'admin_nickname' => $this->CI->config->item('admin_nickname')));
				redirect("/admin");
			}
		}
	}
	
	public function setTitle($title)
	{
		$this->title = $title . " - ";
	}
	
	public function getModules()
	{
		$this->loadModules();
		return $this->modules;
	}
	
	public function loadModules()
	{
		if(empty($this->modules))
		{
			foreach(glob("application/modules/*") as $file)
			{
				if(is_dir($file))
				{
					$name = $this->getModuleName($file);
					if(file_exists($file . "/manifest.json"))
					{
						$this->modules[$name] = @file_get_contents($file . "/manifest.json");
						$this->modules[$name] = json_decode($this->modules[$name], true);		
					}					
				}
			}
		}
	}
	
	private function getModuleName($path = "")
	{
		return preg_replace("/application\/modules\//", "", $path);
	}
		
	private function getMenuLinks()
	{
		foreach($this->modules as $module => $manifest)
		{
			if(array_key_exists("admin", $manifest) )
			{
				foreach($manifest['admin'] as $menuGroup)
				{
					if(!array_key_exists($menuGroup['text'], $this->menu))
					{
						$this->menu[$menuGroup['text']] = array('links' => array());
					}

					foreach($menuGroup['links'] as $key => $link)
					{

						$menuGroup['links'][$key]['module'] = $module;

						if($module == $this->CI->router->fetch_module())
						{
							$url = $this->CI->router->fetch_class();
							$menuGroup['links'][$key]['active'] = true;

							if($this->CI->router->fetch_method() != "index")
							{
								$url .= "/".$this->CI->router->fetch_method();
							}

							if($url == $menuGroup['links'][$key]['controller'])
							{
								$this->currentPage = $module."/".$menuGroup['links'][$key]['controller'];
							}
						}
				
						if($module == 'admin')
						{
							array_push($this->menu[$menuGroup['text']]['links'], $menuGroup['links'][$key]);	
						}
						else
						{
							if($this->isEnabled($module))
							{
								array_push($this->menu[$menuGroup['text']]['links'], $menuGroup['links'][$key]);
							}
						}	
					}
				}
			}
		}
	}
	
	public function view($content, $css = false, $js = false)
	{
		$data = array(
			"page" => '<div id="content_ajax">'.$content.'</div>',
			"url" => $this->CI->template->page_url,
			"menu" => $this->menu,
			"title" => $this->title,
			"extra_js" => $js,
			"extra_css" => $css,
			"current_page" => $this->currentPage
		);
		$output = $this->CI->smarty->view($this->theme_path."template.tpl", $data, true);
		die($output);
	}
	
	public function box($title, $body, $full = false, $css = false, $js = false)
	{
		$data = array("headline" => $title, "content" => $body);
		$page = $this->CI->smarty->view($this->theme_path."box.tpl", $data, true);
		if($full)
		{
			$this->view($page, $css, $js);
		}
		else
		{
			return $page;
		}
	}
	
	public function getVersion()
	{
		return trim(file_get_contents('application/config/version.php'));
	}
	
	private function isEnabled($moduleName)
	{
		return CI::$APP->cms_model->getModuleEnabled($moduleName);
	}	
}