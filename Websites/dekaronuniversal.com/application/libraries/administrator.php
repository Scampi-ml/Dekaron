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
		if(!$this->CI->input->is_ajax_request() && !isset($_GET['is_json_ajax']))
		{
			$this->loadModules();
			$this->getMenuLinks();
		}
	}
	private function logIn(
	){
		$username = $this->CI->input->post('username');
		$password = $this->CI->input->post('password');
		$check = $this->CI->user->setUserDetails($username, md5($password));
		if($check != 'ok')
		{
			die($check);
		}
		
		if(!hasPermission("view", "admin"))
		{
			die("permission");
		}
		
		$this->CI->session->set_userdata(array('admin_access' => true));
		die("welcome");
	}
	
	public function setTitle($title){
		$this->title = $title . " - ";
	}
	
	public function getModules(){
		$this->loadModules();
		return $this->modules;
	}
	
	public function loadModules(){
		if(empty($this->modules)){
			foreach(glob("application/modules/*") as $file){
				if(is_dir($file)){
					$name = $this->getModuleName($file);
					$this->modules[$name] = @file_get_contents($file . "/manifest.json");
					if(!$this->modules[$name]){
						die("The module <b>".$name."</b> is missing manifest.json");
					}else{
						$this->modules[$name] = json_decode($this->modules[$name], true);
						if(!array_key_exists("name", $this->modules[$name])){
							$this->modules[$name]['name'] = $name;
						}
						if(!array_key_exists("enabled", $this->modules[$name])){
							$this->modules[$name]["enabled"] = false;
						}
						if(!array_key_exists("description", $this->modules[$name])){
							$this->modules[$name]['description'] = "This module has no description";
						}
						if($this->hasConfigs($name)){
							$this->modules[$name]['has_configs'] = true;
						}else{
							$this->modules[$name]['has_configs'] = false;
						}
					}
				}
			}
		}
	}
	
	private function getModuleName($path = ""){
		return preg_replace("/application\/modules\//", "", $path);
	}
	
	public function hasConfigs($moduleName){
		if(file_exists("application/modules/".$moduleName."/config")){
			return true;
		}else{
			return false;
		}
	}
	
	private function getMenuLinks(){
		foreach($this->modules as $module => $manifest){
			if(array_key_exists("enabled", $manifest) && $manifest['enabled'] == true && array_key_exists("admin", $manifest)){
				if(array_key_exists("group", $manifest['admin'])){
					$manifest['admin'] = array($manifest['admin']['group']);
				}
				foreach($manifest['admin'] as $menuGroup){
					if(!array_key_exists($menuGroup['text'], $this->menu)){
						$this->menu[$menuGroup['text']] = array(
							'links' => array(),
							'icon' => $menuGroup['icon']
						);
					}
					foreach($menuGroup['links'] as $key => $link){
						if(!array_key_exists("requirePermission", $link) || hasPermission($link['requirePermission'], $module)){
							$menuGroup['links'][$key]['module'] = $module;
							if($module == $this->CI->router->fetch_module()){
								$url = $this->CI->router->fetch_class();
								if($this->CI->router->fetch_method() != "index"){
									$url .= "/".$this->CI->router->fetch_method();
								}
								if($url == $menuGroup['links'][$key]['controller']){
									$menuGroup['links'][$key]['active'] = true;
									$this->currentPage = $module."/".$menuGroup['links'][$key]['controller'];
								}
							}
							array_push($this->menu[$menuGroup['text']]['links'], $menuGroup['links'][$key]);
						}
					}
					if(empty($this->currentPage) && $this->CI->router->fetch_module() == "admin"){
						switch($this->CI->router->fetch_class()){
							case "admin": $this->currentPage = "admin/"; break;
						}
					}
				}
			}
		}
	}
	
	public function view($content, $css = false, $js = false){
		if($this->CI->input->is_ajax_request() && isset($_GET['is_json_ajax']) && $_GET['is_json_ajax'] == 1){
			$array = array(
				"title" => ($this->title) ? $this->title : "",
				"content" => $content,
				"js" => $js,
				"css" => $css
			);
			die(json_encode($array));
		}
		$data = array(
			"page" => '<div id="content_ajax">'.$content.'</div>',
			"url" => $this->CI->template->page_url,
			"menu" => $this->menu,
			"title" => $this->title,
			"extra_js" => $js,
			"extra_css" => $css,
			"nickname" => $this->CI->user->getNickname($this->CI->session->userdata('id')),
			"current_page" => $this->currentPage,
			"defaultLanguage" => $this->CI->config->item('language'),
			"languages" => $this->CI->language->getAllLanguages()
		);
		$output = $this->CI->smarty->view($this->theme_path."template.tpl", $data, true);
		die($output);
	}
	
	public function box($title, $body, $full = false, $css = false, $js = false){
		$data = array(
			"headline" => $title, 
			"content" => $body
		);
		$page = $this->CI->smarty->view($this->theme_path."box.tpl", $data, true);
		if($full){
			$this->view($page, $css, $js);
		}else{
			return $page;
		}
	}
	
	public function getVersion(){
		return $this->CI->config->item('CSMSVersion');
	}
	
	public function isEnabled($moduleName){
		return $this->modules[$moduleName]["enabled"];
	}
	
	public function getEnabledModules(){
		$enabled = array();
		foreach($this->getModules() as $name => $manifest){
			if($manifest['enabled']){
				$enabled[$name] = $manifest;
			}
		}
		return $enabled;
	}
	
	public function getDisabledModules(){
		$disabled = array();
		foreach($this->getModules() as $name => $manifest){
			if(!array_key_exists("enabled", $manifest) || !$manifest['enabled']){
				$disabled[$name] = $manifest;
			}
		}
		return $disabled;
	}
	
	private function showLogIn(){
		if(!$this->CI->session->userdata('admin_access') || !hasPermission("view", "admin")){
			if($this->CI->input->post('send')){
				$this->logIn();
			}else{
				if(!$this->CI->input->is_ajax_request() && !isset($_GET['is_json_ajax'])){
					$data = array(
						"url" => $this->CI->template->page_url,
						"isOnline" => $this->CI->user->isOnline(),
						"username" => $this->CI->user->getUsername(),
					);
					$output = $this->CI->smarty->view($this->theme_path."login.tpl", $data, true);
					die($output);
				}else{
					die('<script>window.location.reload(true);</script>');
				}
			}
		}
	}
}