<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once( BASEPATH.'smarty/libs/Smarty.class.php' );

class CI_Smarty extends Smarty {

	function __construct()
	{
		parent::__construct();

		$this->compile_dir = APPPATH . "cache/templates";
		$this->template_dir = APPPATH . "views";
		$this->assign( 'APPPATH', APPPATH );
		$this->assign( 'BASEPATH', BASEPATH );		
		
		// By ME
		$this->assign( 'BASE_URL', base_url() );
		$this->assign( 'SITE_URL', site_url() );
		
		/*
		
		
          public 'force_compile' => boolean false
          public 'compile_check' => boolean true
          public 'use_sub_dirs' => boolean false
          public 'allow_ambiguous_resources' => boolean false
          public 'caching' => boolean false
          public 'merge_compiled_includes' => boolean false
          public 'inheritance_merge_compiled_includes' => boolean true
          public 'cache_lifetime' => int 3600
          public 'force_cache' => boolean false		
		
		*/
		

		// Assign CodeIgniter object by reference to CI
		if ( method_exists( $this, 'assignByRef') )
		{
			$ci =& get_instance();
			$this->assignByRef("ci", $ci);
		}

		log_message('debug', "Smarty Class Initialized");
	}

	function view($template, $data = array(), $return = FALSE)
	{				
		foreach ($data as $key => $val)
		{
			$this->assign($key, $val);
		}
		
		if ($return == FALSE)
		{
			$CI =& get_instance();
			if (method_exists( $CI->output, 'set_output' ))
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
}
// END Smarty Class
