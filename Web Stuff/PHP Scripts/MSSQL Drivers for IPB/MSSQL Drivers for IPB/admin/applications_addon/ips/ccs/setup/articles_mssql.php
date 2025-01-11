<?php

if ( ! defined( 'IN_IPB' ) )
{
	print "<h1>Incorrect access</h1>You cannot access this file directly. If you have recently upgraded, make sure you upgraded all the relevant files.";
	exit();
}

class articleTables_mssql
{
	/**
	 * Constructor
	 *
	 * @access	public
	 * @param	object		Registry object
	 * @return	void
	 */
	public function __construct( ipsRegistry $registry ) 
	{
		/* Make object */
		$this->registry =  $registry;
		$this->DB       =  $this->registry->DB();
		$this->settings =& $this->registry->fetchSettings();
		$this->request  =& $this->registry->fetchRequest();
		$this->cache    =  $this->registry->cache();
		$this->caches   =& $this->registry->cache()->fetchCaches();
	}
	
	/**
	 * Run query
	 *
	 * @access	public
	 * @param	int		Database id
	 * @param	array 	Fields
	 * @return	void
	 */
	public function createTable( $_databaseId, $_fieldIds )
	{
		$query = "CREATE TABLE " . $this->registry->dbFunctions()->getPrefix() . "ccs_custom_database_{$_databaseId} (
			primary_id_field INT IDENTITY,
			member_id INT NOT NULL DEFAULT '0',
			record_saved INT NOT NULL DEFAULT '0',
			record_updated INT NOT NULL DEFAULT '0',
			post_key VARCHAR(32) NOT NULL DEFAULT '0',
			rating_real INT NOT NULL DEFAULT '0',
			rating_hits INT NOT NULL DEFAULT '0',
			rating_value INT NOT NULL DEFAULT '0',
			category_id INT NOT NULL DEFAULT '0',
			record_locked INT NOT NULL DEFAULT '0',
			record_comments INT NOT NULL DEFAULT '0',
			record_views INT NOT NULL DEFAULT '0',
			record_approved INT NOT NULL DEFAULT '0',
			record_pinned INT NOT NULL DEFAULT '0',
			record_dynamic_furl VARCHAR( 255 ) NULL DEFAULT NULL,
			record_static_furl VARCHAR( 255 ) NULL DEFAULT NULL,
			record_meta_keywords VARCHAR(MAX) NULL DEFAULT NULL,
			record_meta_description VARCHAR(MAX) NULL DEFAULT NULL,
			record_template INT NOT NULL DEFAULT '0',
			record_topicid INT NOT NULL DEFAULT '0',";
			
		foreach( $_fieldIds as $_field )
		{
			$query	.= "\n			{$_field} VARCHAR(MAX) NULL,";
		}
			
		$query .= "\n			PRIMARY KEY (primary_id_field)\n )";
		
		$return_die				= $this->DB->return_die;
		$this->DB->return_die	= true;
		$this->DB->query( $query );
		
		$this->DB->query("CREATE INDEX record_approved ON " . $this->registry->dbFunctions()->getPrefix() . "ccs_custom_database_{$_databaseId} ( record_approved );" );
		$this->DB->query("CREATE INDEX record_static_furl ON " . $this->registry->dbFunctions()->getPrefix() . "ccs_custom_database_{$_databaseId} ( record_static_furl );");
		$this->DB->query("CREATE INDEX record_topicid ON " . $this->registry->dbFunctions()->getPrefix() . "ccs_custom_database_{$_databaseId} ( record_topicid );");
		$this->DB->query("CREATE INDEX category_id ON " . $this->registry->dbFunctions()->getPrefix() . "ccs_custom_database_{$_databaseId} ( category_id );");
		
		$this->DB->return_die	= $return_die;
		
		return;
	}
}
