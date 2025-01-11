<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/** load the CI class for Modular Extensions **/
require dirname(__FILE__).'/Base.php';

class MX_Controller 
{
	public $autoload = array();
	private $standardModule = "news";

	public function __construct() 
	{
		$class = str_replace(CI::$APP->config->item('controller_suffix'), '', get_class($this));
		
		log_message('debug', $class." MX_Controller Initialized");

		Modules::$registry[strtolower($class)] = $this;

		// We need the MODULE name, not the controller
		$moduleName = CI::$APP->uri->segment(1);

		// Default module
		if(!$moduleName)
		{
			$moduleName = $this->standardModule;
		}

		// Check if the path exists to the requested module, also make sure to check if the module exists.
		$path = APPPATH.'modules/'.strtolower($moduleName);

		// Does the folder exist?
		if(!is_dir($path))
		{
			CI::$APP->template->showError('Module is not found');
		}

		// Make sure the module has a manifest

		if(file_exists($path."/manifest.json"))
		{
			$module = file_get_contents($path."/manifest.json");
			$module = json_decode($module, true);

			// Make sure it was real JSON
			if(!is_array($module))
			{
				show_error("The manifest.json file for <b>".strtolower($moduleName)."</b> is not properly formatted");
			}
		}

		// Is the module enabled?
		if(!CI::$APP->cms_model->getModuleEnabled($moduleName))
		{
			CI::$APP->template->showError('Module is not installed or disabled.');
		}
		
		$this->load = clone load_class('Loader');
		$this->load->initialize($this);	
		$this->load->_autoloader($this->autoload);
	}	

	public function __get($class) {
		return CI::$APP->$class;
	}
}