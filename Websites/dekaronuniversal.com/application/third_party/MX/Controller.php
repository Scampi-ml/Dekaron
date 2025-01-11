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
			CI::$APP->template->show404();
		}

		// Make sure the module has a manifest
		if(!file_exists($path."/manifest.json"))
		{
			show_error("The manifest.json file for <b>".strtolower($moduleName)."</b> does not exist");
		}

		$module = file_get_contents($path."/manifest.json");
		$module = json_decode($module, true);

		// Make sure it was real JSON
		if(!is_array($module))
		{
			show_error("The manifest.json file for <b>".strtolower($moduleName)."</b> is not properly formatted");
		}

		// Is the module enabled?
		if(!isset($module['enabled']) || !$module['enabled'])
		{
			CI::$APP->template->show404();
		}

		// Default to current version
		if(!array_key_exists("min_required_version", $module))
		{
			$module['min_required_version'] = CI::$APP->config->item('CMSVersion');
		}

		// Does the module got the correct version?
		if(!CI::$APP->template->compareVersions($module['min_required_version'], CI::$APP->config->item('CMSVersion')))
		{
			show_error("The module <b>".strtolower($moduleName)."</b> requires DekaronCMS v".$module['min_required_version'].", please update at janvier123.be/dekaroncms");
		}

		/* copy a loader instance and initialize */
		$this->load = clone load_class('Loader');
		$this->load->initialize($this);	
		
		/* autoload module items */
		$this->load->_autoloader($this->autoload);

		$this->cookieLogIn();
	}
	
	public function __get($class) {
		return CI::$APP->$class;
	}

	public function cookieLogIn()
	{
		if(!CI::$APP->user->isOnline())
		{
			$username = CI::$APP->input->cookie("dkcms_username");
			$password = CI::$APP->input->cookie("dkcms_password");

			if($username && $password)
			{
				$check = CI::$APP->user->setUserDetails($username, $password);

				if($check == 0)
				{
					redirect('news');
				}
			}
		}
	}
}