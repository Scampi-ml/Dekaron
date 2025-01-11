<?php

/**
 * <pre>
 * Invision Power Services
 * IP.Board v3.1.4
 * SQL installation methods
 * Last Updated: $Date: 2010-12-17 08:03:58 -0500 (Fri, 17 Dec 2010) $
 * </pre>
 *
 * @author 		Matt Mecham
 * @copyright	(c) 2001 - 2009 Invision Power Services, Inc.
 * @license		http://www.invisionpower.com/community/board/license.html
 * @package		IP.Board
 * @link		http://www.invisionpower.com
 * @since		1st December 2008
 * @version		$Revision: 7446 $
 *
 */

class install_extra
{
	/**
	 * Errors
	 *
	 * @access	public
	 * @var		array
	 */
	public $errors     = array();

	/**
	 * Extra info
	 *
	 * @access	public
	 * @var		array
	 */
	public $info_extra = array();

	/**
	 * Set Prefix
	 *
	 * @access	public
	 * @var		string
	 */
	public $prefix		= '';

	/**
	 * Constructor
	 *
	 * @access	public
	 * @param	object	Registry reference
	 * @return	void
	 */
	public function __construct( ipsRegistry $registry )
	{
		/* Make registry objects */
		$this->registry = $registry;
		$this->DB       = $this->registry->DB();
		$this->settings =& $this->registry->fetchSettings();
		$this->request  =& $this->registry->fetchRequest();
	}

	/**
	 * Set db prefix
	 *
	 * @access	public
	 * @param	object	Registry reference
	 * @return	void
	 */
	public function setDbPrefix( $prefix='' )
	{
		if( $prefix )
		{
			$this->prefix	= $prefix;
		}
		else if( class_exists( 'IPSSetUp' ) )
		{
			$this->prefix	= IPSSetUp::getSavedData('db_pre');
		}
		else
		{
			$this->prefix	= $this->settings['sql_tbl_prefix'];
		}
		
		/* Fail safe */
		if ( ! $this->prefix AND ! $prefix AND $this->settings['sql_tbl_prefix'] )
		{
			$this->prefix = $this->settings['sql_tbl_prefix'];
		}
	}

	/**
	 * before_inserts_run
	 * Allows one to run SQL commands before any inserts are run
	 *
	 * Use ipsRegistry::DB()->query("") to run queries
	 *
	 * @access	public
	 * @param	string	Type of inserts to run
	 * @return	void
	 */
	public function before_inserts_run( $type )
	{
		$this->setDbPrefix();

		switch( $type )
		{
			case 'applications':
			case 'modules':
			case 'settings':
			case 'templates':
				ipsRegistry::DB()->setTableIdentityInsert( 'skin_collections', 'ON' );
				break;
			case 'css':
				break;
			case 'skinset':
				ipsRegistry::DB()->setTableIdentityInsert( 'skin_collections', 'ON' );
				break;
			case 'tasks':
			case 'bbcode':
				break;
			case 'media':
				break;
			case 'languages':
			case 'bbcode':
			case 'faq':
			case 'login':
			case 'useragents':
				break;
			case 'groups':
				ipsRegistry::DB()->setTableIdentityInsert( 'groups', 'ON' );
				break;
			case 'attachments':
			case 'hooks':
			case 'caches':
				break;
		}
	}

	/**
	 * after_inserts_run
	 * Allows one to run SQL commands AFTER any inserts are run
	 *
	 * Use ipsRegistry::DB()->query("") to run queries
	 *
	 * @access	public
	 * @param	string	Type of inserts to run
	 * @return	void
	 */
	public function after_inserts_run( $type )
	{
		switch( $type )
		{
			case 'applications':
			case 'modules':
			case 'settings':
			case 'templates':
				ipsRegistry::DB()->setTableIdentityInsert( 'skin_collections', 'OFF' );
				break;
			case 'css':
				break;
			case 'skinset':
				ipsRegistry::DB()->setTableIdentityInsert( 'skin_collections', 'OFF' );
				break;
			case 'tasks':
			case 'bbcode':
				break;
			case 'media':
				break;
			case 'languages':
			case 'bbcode':
			case 'faq':
			case 'login':
			case 'useragents':
				break;
			case 'groups':
				ipsRegistry::DB()->setTableIdentityInsert( 'groups', 'OFF' );
				break;
			case 'attachments':
			case 'hooks':
			case 'caches':
				break;
		}
	}

	/**
	 * Alter create table statements before being run
	 *
	 * @access	public
	 * @param	string	Query
	 * @return	string	Query
	 */
	public function process_query_create( $query )
	{
		$this->setDbPrefix();

		if ( $this->prefix )
		{
			$query = preg_replace( "#^CREATE TABLE (\S+) #", "CREATE TABLE " . $this->prefix."\\1 ", $query );
			$query = preg_replace( "#(\S+)(.*)IDENTITY PK_(\S+) PRIMARY KEY#", "\\1\\2IDENTITY " . $this->prefix."PK_\\3 PRIMARY KEY", $query );
			$query = preg_replace( "#(\S+)(.*)IDENTITY CONSTRAINT PK_(\S+) PRIMARY KEY#", "\\1\\2IDENTITY CONSTRAINT " . $this->prefix."PK_\\3 PRIMARY KEY", $query );
			$query = preg_replace( "#^CREATE INDEX (\S+) ON (\S+) #", "CREATE INDEX \\1 ON " . $this->prefix."\\2 " , $query );
			$query = preg_replace( "#^CREATE UNIQUE INDEX (\S+) ON (\S+) #", "CREATE UNIQUE INDEX \\1 ON " . $this->prefix."\\2 " , $query );
			$query = preg_replace( "#^INSERT INTO (\S+) #" , "INSERT INTO "  . $this->prefix."\\1 " , $query );
			$query = preg_replace( "#^REPLACE INTO (\S+) #", "REPLACE INTO " . $this->prefix."\\1 ", $query );
			$query = preg_replace( "#^ALTER TABLE (\S+) #" , "ALTER TABLE "  . $this->prefix."\\1 " , $query );
			$query = preg_replace( "# PK_(\S+)#", " " . $this->prefix."PK_\\1", $query );
		}

		return $query;
	}

	/**
	 * Alter create index statements before being run
	 *
	 * @access	public
	 * @param	string	Query
	 * @return	string	Query
	 */
	public function process_query_index( $query )
	{
		$this->setDbPrefix();

		if ( $this->prefix )
		{
			$query = preg_replace( "#select FULLTEXTCATALOGPROPERTY \( '(\S+)', 'PopulateStatus' \)#i", "select FULLTEXTCATALOGPROPERTY ( '" . $this->prefix . "\\1', 'PopulateStatus' )", $query );
			$query = preg_replace( "#exec sp_fulltext_catalog '(\S+)', 'create'#i", "exec sp_fulltext_catalog '" . $this->prefix . "\\1', 'create'", $query );
			$query = preg_replace( "#sp_fulltext_table\s{1,}'(\S+)',\s{1,}'(\S+)',\s{1,}'(\S+)',\s{1,}'(\S+)'#i", "sp_fulltext_table '" . $this->prefix . "\\1', '\\2', '" . $this->prefix . "\\3', '\\4'", $query );
			$query = preg_replace( "#sp_fulltext_table '(\S+)', '(\S+)'$#i", "sp_fulltext_table '" . $this->prefix . "\\1', '\\2'", $query );
			$query = preg_replace( "#sp_fulltext_column\s{0,}'(\S+)',\s{0,}'(\S+)',\s{0,}'(\S+)'#i", "sp_fulltext_column '" . $this->prefix . "\\1', '\\2', '\\3'", $query );
			$query = preg_replace( "#(\s|'|\")PK_(\S+)#", " \\1" . $this->prefix."PK_\\2", $query );
			$query = preg_replace( "#(\s|'|\")ftcatalog(\s|'|\")#", " \\1" . $this->prefix."ftcatalog\\2", $query );
		}
		//IPSDebug::addLogMessage( $query, 'mssql', array(), true );
		ipsRegistry::DB()->allow_sub_select=1;
		
		return $query;
	}

	/**
	 * Alter insert statements before being run
	 *
	 * @access	public
	 * @param	string	Query
	 * @return	string	Query
	 */
	public function process_query_insert( $query )
	{
		$this->setDbPrefix();

		if ( $this->prefix )
		{
			$query = preg_replace( "#^CREATE TABLE (\S+) #", "CREATE TABLE " . $this->prefix."\\1 ", $query );
			$query = preg_replace( "#^INSERT INTO (\S+) #" , "INSERT INTO "  . $this->prefix."\\1 " , $query );
			$query = preg_replace( "#^REPLACE INTO (\S+) #", "REPLACE INTO " . $this->prefix."\\1 ", $query );
			$query = preg_replace( "#^ALTER TABLE (\S+) #" , "ALTER TABLE "  . $this->prefix."\\1 " , $query );
			$query = preg_replace( "#^SET IDENTITY_INSERT (\S+) #" , "SET IDENTITY_INSERT "  . $this->prefix."\\1 " , $query );
			$query = preg_replace( "# PK_(\S+)#", " " . $this->prefix."PK_\\1", $query );
		}

		return $query;
	}

	/**
	 * Return additional HTML to show on install form
	 *
	 * @access	public
	 * @return	string	HTML
	 */
	public function install_form_extra()
	{
		$extra = "<tr>
					<td class='title'>SQL interface?</td>
					<td class='content'><select name='sql_type' class='sql_form'><option value='MSSQL' selected='selected'>PHP MSSQL Extension</option><option value='SQLSRV'>SQL Server Driver for PHP</option><option value='COM'>ADODB over COM</option></select></td>
				  </tr>
				  <tr>
				    <td class='content' colspan='2'>The MSSQL driver uses the PHP MSSQL extension to connect to SQL Server per default. As an alternative you can use ADODB over COM on Windows environments</td>
				  </tr>";
		$extra .= "<tr>
					<td class='title'>SQL Connection library?</td>
					<td class='content'><select name='sql_unixtype' class='sql_form'><option value='' selected='selected'>None</option><option value='freetds'>FreeTDS library</option><option value='sybase'>Sybase library</option></select></td>
				  </tr>
				  <tr>
				    <td class='content' colspan='2'>If you are on a *nix host, select the library used to connect to SQL Server; on a Windows host you can leave it on default 'None'</td>
				  </tr>";
		return $extra;

	}

	/**
	 * Save additional info from install form
	 *
	 * @access	public
	 * @return	void
	 */
	public function install_form_process()
	{
		//-----------------------------------------
		// When processed, return all vars to save
		// in conf_global in the array $this->info_extra
		// This will also be saved into $INFO[] for
		// the installer
		//-----------------------------------------

/*		if ( ! $_REQUEST['sql_freetds'] )
		{
			$this->errors[] = 'You must complete the required SQL section!';
			return;
		}
*/
		$this->info_extra['sql_type']		= in_array( $_REQUEST['sql_type'], array( 'COM', 'MSSQL', 'SQLSRV' ) ) ? $_REQUEST['sql_type'] : 'MSSQL';
		$this->info_extra['sql_unixtype']	= $_REQUEST['sql_unixtype']=='sybase'?'sybase':($_REQUEST['sql_unixtype']=='freetds'?'freetds':'');
	}

}