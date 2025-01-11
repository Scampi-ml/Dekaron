<?php

class Module extends MX_Controller
{
	private $coreModules;

	public function __construct()
	{
		parent::__construct();
		$this->coreModules = array('admin', 'login', 'logout', 'error', 'news');
		$this->load->library('administrator');
		require_once('application/libraries/prettyjson.php');
		requirePermission("view");
	}

	public function index()
	{
		// Change the title
		$this->administrator->setTitle("Modules");

		$this->administrator->loadModules();

		// Prepare my data
		$data = array(
			'url' => $this->template->page_url,
			'enabled_modules' => $this->administrator->getEnabledModules(),
			'disabled_modules' => $this->administrator->getDisabledModules(),
		);

		// Load my view
		$output = $this->template->loadPage("modules.tpl", $data);

		// Put my view in the main box with a headline
		$content = $this->administrator->box('Modules', $output);

		// Output my content. The method accepts the same arguments as template->view
		$this->administrator->view($content, false, "modules/admin/js/module.js");
	}

	public function enable($moduleName)
	{
		requirePermission("toggleModules");

		$this->changeManifest($moduleName, "enabled", true);

		die('SUCCESS');
	}
	
	public function disable($moduleName)
	{
		requirePermission("toggleModules");

		if(!in_array($moduleName, $this->coreModules))
		{
			$this->changeManifest($moduleName, "enabled", false);

			die('SUCCESS');
		}
		else
		{
			die('CORE');
		}
	}
	
	public function changeManifest($moduleName, $setting, $newValue)
	{
		requirePermission("editModuleConfigs");

		$filePath = "application/modules/".$moduleName."/manifest.json";
		$manifest = json_decode(file_get_contents($filePath), true);

		// Replace the setting with the newValue
		$manifest[$setting] = $newValue;

		$prettyJSON = new PrettyJSON($manifest);

		// Rewrite the file with the new data
		$fileHandle = fopen($filePath, "w");
		fwrite($fileHandle, $prettyJSON->get());
		fclose($fileHandle);
	}
}