<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Smarty Class
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Smarty
 * @link		http://www.coolphptools.com/codeigniter-smarty
 */
require_once( BASEPATH.'smarty/Smarty.class.php' );

class CI_Smarty extends Smarty
{
	function __construct()
	{
		parent::__construct();

		$this->compile_dir = APPPATH . "cache/templates";
		$this->template_dir = APPPATH . "views";
		$this->assign( 'APPPATH', APPPATH );
		$this->assign( 'BASEPATH', BASEPATH );

		// Assign CodeIgniter object by reference to CI
		if ( method_exists( $this, 'assignByRef') )
		{
			$CI = &get_instance();
			$this->assignByRef("ci", $CI);
		}

		log_message('debug', "Smarty Class Initialized");
	}

	function view($template, $data = array(), $return = FALSE)
	{
		try
		{
			if($data == ''){ $data = array(); }
			
			foreach($data as $key => $val)
			{
				$this->assign($key, $val);
			}
			
			if($return == FALSE)
			{
				$CI = &get_instance();
				if(method_exists($CI->output, 'set_output'))
				{
					$CI->output->set_output( $this->fetch($template) );
				}
				else
				{
					$CI->output->final_output = $this->fetch($template);
				}
				return;
			}
			else
			{
				return $this->fetch($template);
			}
		}
		catch(SmartyException $e)
		{
			return "<span style='color:red;'><div style='font-size:16px;color:black;font-weight:bold;text-align:center;'>An error has occured while trying to load the requested view.</div><br /><br /><b>Template path:</b> ".$template."<br /><br /><b>Error:</b> ".nl2br(preg_replace("/Stack trace\:/", "<br /><b>Stack trace:</b>", $e))."</span>";
		}
	}
}
// END Smarty Class
