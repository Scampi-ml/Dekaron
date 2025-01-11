<?php
class Plugin{
	protected $CI;
	public $module_name;
	private $vars = array();

	public function __construct($config = null){
		$this->CI = &get_instance();
		$this->module_name = $this->CI->router->fetch_module();
		$this->name = get_class($this);
		$this->config = $config;
	}
	
	public function __set($name, $val){
		$this->vars[$name] = $val;
	}

	public function __get($name){
		if(array_key_exists($name, $this->vars)) {
			return $this->vars[$name];
		}else{
			return null;
		}
	}
}