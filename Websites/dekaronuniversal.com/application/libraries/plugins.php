<?php
class Plugins{
	private $plugins = array();
	private $CI;
	public $module_name;
	public function __construct(){
		$this->CI = &get_instance();
		$this->module_name = $this->CI->router->fetch_module();

		if(is_dir('application/modules/'.$this->module_name.'/plugins')){
			require_once('plugin.php');
			$files = preg_grep('/.+_config.php$/', glob('application/modules/'.$this->module_name.'/plugins/*.php'), PREG_GREP_INVERT);
			foreach($files as $file){
				$pinfo = pathinfo($file, PATHINFO_FILENAME);
				include_once($file);
				$this->plugins[$pinfo] = new $pinfo($this->getConfig($pinfo));
			}
		}
	}
	private function getConfig($filename){
		$filename = 'application/modules/'.$this->module_name.'/plugins/'.$filename.'_config.php';
		if(!file_exists($filename)){
			return null;
		}
		include($filename);
		return (isset($config) ? $config : null);
	}
	public function isLoaded($name){
		$ret = false;
		foreach($this->plugins as $plugin){
			if(strtolower($plugin->name) == strtolower($name)){
				$ret = true;
				break;
			}
		}
		return $ret;
	}
	public function __call($func, $args){
		$ret = array();
		foreach($this->plugins as $plugin){
			if(method_exists($plugin, $func) && is_callable(array($plugin, $func))){
				$ret[$plugin->name] = call_user_func_array(array($plugin, $func), $args);
			}
		}
		return $ret;
	}
	public function __set($name, $value){
		foreach($this->plugins as $plugin){
			$plugin->$name = $value;
		}
	}
	public function __get($name){
		$ret = array();
		foreach($this->plugins as $plugin){
			if(strtolower($plugin->name) == strtolower($name))
				return $plugin;
		}
		foreach($this->plugins as $plugin){
			$ret[$plugin->name] = $plugin->$name;
		}
		return $ret;
	}
}