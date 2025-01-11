<?php
class Edit extends MX_Controller
{
	private $module;
	private $manifest;
	private $configs;

	public function __construct()
	{
		parent::__construct();
		$this->load->library('administrator');
		adminPerm();
		require_once('application/libraries/configeditor.php');
	}

	public function index($module = false)
	{
		if(!$module || !file_exists("application/modules/".$module."/") || !$this->administrator->hasConfigs($module))
		{
			show_error('This pages is not accessable without a config parameter.');
			die();
		}
		
		$this->module = $module;
		$this->loadModule();
		$this->loadConfigs();
		$this->administrator->setTitle($this->manifest['name']);
		$data = array(
			"configs" => $this->configs,
			"moduleName" => $module,
			"url" => $this->template->page_url
		);
		$output = $this->template->loadPage("edit/edit.tpl", $data);
		$content = $this->administrator->box('<a href="'.$this->template->page_url.'admin">Edit Config</a> &rarr; '.$this->manifest['name'], $output);
		$this->administrator->view($content, false, "modules/admin/js/settings.js");
	}

	private function loadModule()
	{
		$this->manifest = @file_get_contents("application/modules/".$this->module."/manifest.json");
			
		if(!$this->manifest)
		{
			die("The module <b>".$this->module."</b> is missing manifest.json");
		}
		else
		{
			$this->manifest = json_decode($this->manifest, true);
			if(!array_key_exists("name", $this->manifest))
			{
				$this->manifest['name'] = ucfirst($this->module);
			}
		}
	}

	private function loadConfigs()
	{
		foreach(glob("application/modules/".$this->module."/config/*") as $file)
		{
			$this->getConfig($file);
		}
	}

	private function getConfig($file)
	{
		include($file);
		$this->configs[$this->getConfigName($file)] = $config;
		$this->configs[$this->getConfigName($file)]['source'] = $this->getConfigSource($file);
	}

	private function getConfigSource($file)
	{
		$handle = fopen($file, "r");
		$data = fread($handle, filesize($file));
		fclose($handle);
		return $data;
	}

	private function getConfigName($path = "")
	{
		return preg_replace("/application\/modules\/".$this->module."\/config\/([A-Za-z0-9_-]*)\.php/", "$1", $path);
	}

	public function save($module = false, $name = false)
	{
		if(!$name || !$module || !$this->configExists($module, $name))
		{
			die("Invalid module or config name");
		}
		else
		{
			if($this->input->post())
			{
				$Config = new ConfigEditor("application/modules/".$module."/config/".$name.".php");

				foreach($this->input->post() as $key => $value)
				{
					$Config->set($key, $value);
				}
				
				$Config->save();

				die("The settings have been saved!");
			}
			else
			{
				die("No data to set");
			}
		}
	}

	public function saveSource($module = false, $name = false)
	{
		if(!$name || !$module || !$this->configExists($module, $name))
		{
			die("Invalid module or config name");
		}
		else
		{
			if($this->input->post("source"))
			{
				$file = fopen("application/modules/".$module."/config/".$name.".php", "w");
				fwrite($file, $this->input->post("source"));
				fclose($file);

				die("The settings have been saved!");
			}
			else
			{
				die("No data to set");
			}
		}
	}

	private function configExists($module, $file)
	{
		if(file_exists("application/modules/".$module."/config/".$file.".php"))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}