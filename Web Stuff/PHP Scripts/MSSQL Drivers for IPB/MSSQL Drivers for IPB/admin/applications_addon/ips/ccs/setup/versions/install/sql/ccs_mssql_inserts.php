<?php

$INSERT	= array();

class ccs_templates
{
	/**#@+
	 * Registry objects
	 *
	 * @access	protected
	 * @var		object
	 */	
	protected $registry;
	protected $DB;
	/**#@-*/
	
	/**
	 * Constructor
	 *
	 * @access	public
	 * @param	object	ipsRegistry
	 * @return	void
	 */
	public function __construct()
	{
		/* Make object */
		$this->registry		= ipsRegistry::instance();
		$this->DB			= $this->registry->DB();
		
		/* Block templates */
		$this->_importTemplates();
		
		/* Default site */
		$this->_importSite();
		
		/* Databases */
		$this->_importDatabase();
	}
	
	/**
	 * Import the block templates
	 *
	 * @access	protected
	 * @return	void
	 */
	protected function _importTemplates()
	{
		$content	= file_get_contents( IPS_ROOT_PATH . 'applications_addon/ips/ccs/xml/block_templates.xml' );
		
		require_once( IPS_KERNEL_PATH.'classXML.php' );

		$xml = new classXML( IPS_DOC_CHAR_SET );
		$xml->loadXML( $content );
		
		foreach( $xml->fetchElements('template') as $template )
		{
			$_template	= $xml->fetchElementsFromRecord( $template );

			if( $_template['tpb_name'] )
			{
				unset($_template['tpb_id']);
				
				$this->DB->insert( "ccs_template_blocks", $_template );
			}
		}
	}
	
	/**
	 * Now we get to import the default site.  Fun!
	 *
	 * @access	protected
	 * @return	void
	 */
	protected function _importSite()
	{
		//-----------------------------------------
		// Get the data from XML
		//-----------------------------------------
		
		$content	= file_get_contents( IPS_ROOT_PATH . 'applications_addon/ips/ccs/xml/demosite.xml' );
		
		require_once( IPS_KERNEL_PATH.'classXML.php' );

		$xml = new classXML( IPS_DOC_CHAR_SET );
		$xml->loadXML( $content );
		
		//-----------------------------------------
		// Blocks
		//-----------------------------------------
		
		$this->DB->setTableIdentityInsert( "ccs_blocks", "ON" );
		
		foreach( $xml->fetchElements('block') as $block )
		{
			$_block	= $xml->fetchElementsFromRecord( $block );

			$this->DB->insert( "ccs_blocks", $_block );
		}
		
		$this->DB->setTableIdentityInsert( "ccs_blocks", "OFF" );

		//-----------------------------------------
		// Containers
		//-----------------------------------------
		
		$this->DB->setTableIdentityInsert( "ccs_containers", "ON" );
		
		foreach( $xml->fetchElements('container') as $container )
		{
			$_container	= $xml->fetchElementsFromRecord( $container );

			$this->DB->insert( "ccs_containers", $_container );
		}
		
		$this->DB->setTableIdentityInsert( "ccs_containers", "OFF" );

		//-----------------------------------------
		// Templates
		//-----------------------------------------
		
		$this->DB->setTableIdentityInsert( "ccs_page_templates", "ON" );
		
		foreach( $xml->fetchElements('template') as $template )
		{
			$_template	= $xml->fetchElementsFromRecord( $template );

			$_template['template_updated']	= str_replace( '{--time--}', time(), $_template['template_updated'] );
			
			$this->DB->insert( "ccs_page_templates", $_template );
		}
		
		$this->DB->setTableIdentityInsert( "ccs_page_templates", "OFF" );

		//-----------------------------------------
		// Pages
		//-----------------------------------------
		
		$this->DB->setTableIdentityInsert( "ccs_pages", "ON" );
		
		foreach( $xml->fetchElements('page') as $page )
		{
			$_page	= $xml->fetchElementsFromRecord( $page );
			
			$_page['page_content']      = trim( $_page['page_content'] );
			$_page['page_cache']        = trim( $_page['page_cache'] );
			$_page['page_view_perms']   = trim( $_page['page_view_perms'] );
			$_page['page_template']     = trim( $_page['page_template'] );
			$_page['page_meta_keywords']     = trim( $_page['page_meta_keywords'] );
			$_page['page_meta_description']  = trim( $_page['page_meta_description'] );
		
			$_page['page_last_edited']	= str_replace( '{--time--}', time(), $_page['page_last_edited'] );
			
			$this->DB->insert( "ccs_pages", $_page );
		}
		
		$this->DB->setTableIdentityInsert( "ccs_pages", "OFF" );

		//-----------------------------------------
		// Block templates
		//-----------------------------------------

		//$this->DB->setTableIdentityInsert( "ccs_template_blocks", "ON" );
		
		foreach( $xml->fetchElements('tblock') as $tblock )
		{
			$_tblock	= $xml->fetchElementsFromRecord( $tblock );

			unset($_tblock['tpb_id']);
			
			$this->DB->insert( "ccs_template_blocks", $_tblock );
		}
		
		//$this->DB->setTableIdentityInsert( "ccs_template_blocks", "OFF" );

		//-----------------------------------------
		// Rebuild normal template caches
		//-----------------------------------------
		
		require_once( IPS_KERNEL_PATH . 'classTemplateEngine.php' );
		$engine					= new classTemplate( IPS_ROOT_PATH . 'sources/template_plugins' );

		$this->DB->build( array( 'select' => '*', 'from' => 'ccs_page_templates' ) );
		$outer	= $this->DB->execute();
		
		while( $r = $this->DB->fetch( $outer ) )
		{
			$cache	= array(
							'cache_type'	=> 'template',
							'cache_type_id'	=> $r['template_id'],
							);
	
			$cache['cache_content']	= $engine->convertHtmlToPhp( 'template_' . $r['template_key'], $r['template_database'] ? '$data' : '', $r['template_content'], '', false, true );
			
			$hasIt	= $this->DB->buildAndFetch( array( 'select' => 'cache_id', 'from' => 'ccs_template_cache', 'where' => "cache_type='template' AND cache_type_id={$r['template_id']}" ) );
			
			if( $hasIt['cache_id'] )
			{
				$this->DB->update( 'ccs_template_cache', $cache, "cache_type='template' AND cache_type_id={$r['template_id']}" );
			}
			else
			{
				$this->DB->insert( 'ccs_template_cache', $cache );
			}
		}
		
		//-----------------------------------------
		// And rebuild the rest...
		//-----------------------------------------
		
		$classToLoad = IPSLib::loadLibrary( IPSLib::getAppDir( 'ccs' ) . '/sources/pages.php', 'pageBuilder', 'ccs' );
		$_pagesClass = new $classToLoad( $this->registry );
		$_pagesClass->recacheTemplateCache( $engine );

		//-----------------------------------------
		// Done?
		//-----------------------------------------
		
		return true;
	}

	/**
	 * Insert the default database stuff too...
	 *
	 * @access	public
	 * @return	void
	 */
	public function _importDatabase()
	{
		define( 'CCS_UPGRADE', false );
		
		require_once( IPSLib::getAppDir( 'ccs' ) . "/setup/articles.php" );
		$_setupDb	= new setup_articles();
		$_setupDb->doExecute( $this->registry );
	}
}

$templateInstall = new ccs_templates();
