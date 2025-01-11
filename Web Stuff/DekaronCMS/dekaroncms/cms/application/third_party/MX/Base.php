<?php (defined('BASEPATH')) OR exit('No direct script access allowed');
require_once dirname(__FILE__).'/Config.php';
class CI extends CI_Controller
{
	public static $APP;
	
	public function __construct()
	{
		self::$APP = $this;	
		global $LANG, $CFG;
		if ( ! is_a($CFG, 'MX_Config')) $CFG = new MX_Config;
		parent::__construct();
	}
}
new CI;