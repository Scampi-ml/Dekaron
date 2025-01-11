<?php

/**
 * <pre>
 * Invision Power Services
 * IP.CCS mssql abstraction layer for database management
 * Last Updated: $Date: 2010-12-30 10:10:34 -0500 (Thu, 30 Dec 2010) $
 * </pre>
 *
 * @author 		$Author: mat $
 * @copyright	(c) 2001 - 2009 Invision Power Services, Inc.
 * @license		http://www.invisionpower.com/community/board/license.html
 * @package		IP.Content
 * @link		http://www.invisionpower.com
 * @since		2nd Sept 2009
 * @version		$Revision: 7493 $
 */

if ( ! defined( 'IN_ACP' ) )
{
	print "<h1>Incorrect access</h1>You cannot access this file directly.";
	exit();
}

class ccs_database_abstraction
{
	/**#@+
	 * Registry objects
	 *
	 * @access	protected
	 * @var		object
	 */	
	protected $registry;
	protected $DB;
	protected $settings;
	protected $request;
	protected $lang;
	protected $member;
	protected $memberData;
	protected $caches;
	protected $cache;
	/**#@-*/
	
	/**
	 * Constructor
	 *
	 * @access	public
	 * @param	object		Registry
	 * @return	void
	 */
	public function __construct( ipsRegistry $registry )
	{
		/* Make object */
		$this->registry		= $registry;
		$this->DB			= $this->registry->DB();
		$this->settings		=& $this->registry->fetchSettings();
		$this->request		=& $this->registry->fetchRequest();
		$this->lang			= $this->registry->getClass('class_localization');
		$this->member		= $this->registry->member();
		$this->memberData	=& $this->registry->member()->fetchMemberData();
		$this->cache		= $this->registry->cache();
		$this->caches		=& $this->registry->cache()->fetchCaches();
	}
	
	/**
	 * Create a new database table
	 *
	 * @access	public
	 * @param	string		Table name
	 * @return	bool
	 */
	public function createTable( $name )
	{
		if( !$name )
		{
			return false;
		}
		
		$query = "CREATE TABLE {$name} (
			primary_id_field INT NOT NULL IDENTITY,
			member_id INT NOT NULL DEFAULT '0',
			record_saved VARCHAR(13) NOT NULL DEFAULT '0',
			record_updated VARCHAR(13) NOT NULL DEFAULT '0',
			post_key VARCHAR(32) NOT NULL DEFAULT '0',
			rating_real INT NOT NULL DEFAULT '0',
			rating_hits INT NOT NULL DEFAULT '0',
			rating_value INT NOT NULL DEFAULT '0',
			category_id INT NOT NULL DEFAULT '0',
			record_locked BIT NOT NULL DEFAULT '0',
			record_comments INT NOT NULL DEFAULT '0',
			record_views INT NOT NULL DEFAULT '0',
			record_approved BIT NOT NULL DEFAULT '0',
			record_pinned BIT NOT NULL DEFAULT '0',
			record_dynamic_furl VARCHAR( 255 ) DEFAULT NULL,
			record_static_furl VARCHAR( 255 ) DEFAULT NULL,	
			record_meta_keywords VARCHAR( MAX ) NULL,
			record_meta_description VARCHAR( MAX ) NULL,
			record_template INT NOT NULL DEFAULT '0',
			record_topicid INT NOT NULL DEFAULT '0',		
			PRIMARY KEY (primary_id_field)
		)";

		$return_die				= $this->DB->return_die;
		$this->DB->return_die	= true;
		$this->DB->query( $query );
		$this->DB->return_die	= $return_die;
		
		if( $this->DB->failed )
		{
			return false;
		}
		else
		{
			$query	= "CREATE INDEX record_approved ON {$name} ( record_approved )";
			$query1	= "CREATE INDEX category_id ON {$name} ( category_id )";
			$query2	= "CREATE INDEX record_static_furl ON {$name} ( record_static_furl )";
			$query3	= "CREATE INDEX record_topicid ON {$name} ( record_topicid )";
	
			$this->DB->return_die	= true;
			$this->DB->query( $query );
			$this->DB->query( $query1 );
			$this->DB->query( $query2 );
			$this->DB->query( $query3 );
			$this->DB->return_die	= $return_die;
		
			return true;
		}
	}
}