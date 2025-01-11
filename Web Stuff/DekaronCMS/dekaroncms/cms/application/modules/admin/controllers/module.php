<?php
class Module extends MX_Controller
{
	private $coreModules;
	private $Modules;

	public function __construct()
	{
		parent::__construct();
		$this->coreModules = array('admin','logout','error','news','sidebox','page','slider');
		$this->load->library('administrator');
		$this->load->model('module_model');
		$this->getModules();
		adminPerm();
	}

	public function index()
	{
		$this->administrator->setTitle("Modules");
		$data = array(
			'url' => $this->template->page_url,
			'modules' => $this->modules,
			'core_modules' => $this->coreModules
		);
		$output = $this->template->loadPage("modules/modules.tpl", $data);
		$content = $this->administrator->box('Modules', $output);
		$this->administrator->view($content, false, "modules/admin/js/module.js");
	}

	private function getModules()
	{	
		$this->modules = $this->module_model->getModules();
		$this->scanModules();
	}
	
	public function enable($moduleName)
	{
		adminPerm();
		if(!$this->module_model->findModule($moduleName))
		{
			// needs to be installed
			$module = file_get_contents("application/modules/".$moduleName."/manifest.json");
			$module = json_decode($module, true);
			$install = $this->installModule($module);
			die($install);	
		}
		else
		{
			$this->module_model->enableModule($moduleName);	
		}
		die("SUCCESS");	
	}
	
	public function disable($moduleName)
	{	
		adminPerm();
		if(array_key_exists($moduleName, $this->coreModules))
		{
			die("CORE");
		}	
		$this->module_model->disableModule($moduleName);
		die("SUCCESS");
	}


	public function uninstallModule($moduleName)
	{
		if(in_array($moduleName, $this->coreModules))
		{
			die("CORE");
		}

		$module = file_get_contents("application/modules/".$moduleName."/manifest.json");
		$module = json_decode($module, true);

		if(is_array($module))
		{		
			if(isset($module['uninstall_sql']))
			{
				$this->module_model->RunSQLModule($module['uninstall_sql']);
			}

			if(isset($module['uninstall_file']))
			{
				include($module['uninstall_file']);
			}
		}
		$this->module_model->removeModule($moduleName);
		$this->module_model->removeModuleRoles($moduleName);
		$this->module_model->removeModuleConfig($moduleName);
		$this->module_model->removeModuleMenu($moduleName);
		$this->cache->delete('templates/*.php');
		$this->remove_directory("application/modules/".$moduleName);

		die("SUCCESS");
	}

	private function scanModules()
	{
		foreach(glob("application/modules/*") as $file)
		{
			$name = $this->getModuleName($file);
			if(in_array($name, $this->coreModules))
			{
				continue;
			}
			elseif ($name == 'index.html')
			{
				continue;
			}
			else
			{
				
				if(!$this->module_model->findModule($name))
				{
					$module = file_get_contents($file."/manifest.json");
					$module = json_decode($module, true);		
					if(!is_array($module))
					{
						show_error("The manifest.json file for <b>".strtolower($name)."</b> is not properly formatted");
					}
					else
					{
						$module = array_merge($module, array('install' => 'yes'));
						$this->modules[] = $module;
					}
				}
			}
		}	
	}

	private function getModuleName($path = "")
	{
		return preg_replace("/application\/modules\//", "", $path);
	}



	private function installModule($data)
	{
		if(is_array($data))
		{		
			if(isset($data['install_file']))
			{
				include($data['install_file']);
			}

			if(isset($data['install_sql']))
			{
				$this->module_model->RunSQLModule($data['install_sql']);
			}

			if($data['isucp'] == 1)
			{
				$this->module_model->addUcpModule($data['module_name']);
			}			

			$insert = array(
				'module_name' => $data['module_name'],
				'name' => $data['name'],
				'description' => $data['description'],
				'author' => $data['author'],
				'website' => $data['website'],
				'version' => $data['version'],
				'update' => 0,
				'enabled' => 1,
				'isadmin' => $data['isadmin'],
				'isucp' => $data['isucp']
			);
			$this->module_model->addModule($insert);	

			return "INSTALL";
		}
		else
		{
			return "Install data is not a valid array";
		}	
	}

    private function remove_directory($directory, $empty=FALSE)
    {
        if(substr($directory,-1) == '/') {
            $directory = substr($directory,0,-1);
        }

        if(!file_exists($directory) || !is_dir($directory)) {
            return FALSE;
        } elseif(!is_readable($directory)) {

        return FALSE;

        } else {

            $handle = opendir($directory);
            while (FALSE !== ($item = readdir($handle)))
            {
                if($item != '.' && $item != '..') {
                    $path = $directory.'/'.$item;
                    if(is_dir($path)) {
                        $this->remove_directory($path);
                    }else{
                        unlink($path);
                    }
                }
            }
            closedir($handle);
            if($empty == FALSE)
            {
                if(!rmdir($directory))
                {
                    return FALSE;
                }
            }
        return TRUE;
        }	
    }

}