<?php

/**
 * @file		interface_mssql_lib.php 	MSSQL Database Engine Interface
 *~TERABYTE_DOC_READY~
 * $Copyright: (c) 2001 - 2011 Invision Power Services, Inc.$
 * $License: http://www.invisionpower.com/company/standards.php#license$
 * $Author: ips_terabyte $
 * @since		Wednesday 30th March 2008 15:00
 * $LastChangedDate: 2010-12-20 10:09:54 -0500 (Mon, 20 Dec 2010) $
 * @version		v3.1.4
 * $Revision: 7456 $
 */

/**
 *
 * @interface	captchaPlugin
 * @brief		MSSQL Database Engine Interface
 *
 */
interface interface_mssql_lib
{
	/**
	 * Constructor
	 *
	 * @param	object		$parent_class		Parent object
	 * @return	@e void
	 */
	public function __construct( $parent_class );

	/**
	 * Check required extensions
	 *
	 * @return	@e boolean Required extensions enabled
	 */
	public function check_prerequisites();

    /**
	 * Connect to database server
	 *
	 * @return	@e resource Connection ID
	 */
	public function connect();

    /**
	 * Close the database connection
	 *
	 * @param	resource	$connection_id		Connection ID
	 * @return	@e boolean Database connection closed
	 */
	public function close( $connection_id );

    /**
	 * Execute a direct database query
	 *
	 * @param	string		$the_query		Database query
	 * @param	resource	$connection_id	Connection ID
	 * @return	@e mixed Query ID otherwise FALSE on fail
	 */
	public function query( $the_query='', $connection_id );

    /**
	 * Simulate limit in SQL Server
	 *
	 * @param	resource	$query_id		Query ID
	 * @param	integer		$start_row		First row to return from result set
	 * @return	@e void
	 */
	public function limit_simulation( $query_id, $start_row );

    /**
	 * Retrieve row from database
	 *
	 * @param	resource	$query_id		Query result id
	 * @return	@e mixed Result set array, or FALSE
	 */
	public function fetch ( $query_id );

    /**
	 * Retrieve number of rows affected by last query
	 *
	 * @param	resource	$connection_id		Connection ID
	 * @return	@e integer Number of rows affected by last query
	 */
	public function affected_rows( $connection_id );

    /**
	 * Retrieve number of rows in a resultset
	 *
	 * @param	resource	$query_id		Query ID
	 * @return	@e integer Number of rows in the resultset
	 */
	public function num_rows( $query_id );

    /**
	 * Free the result
	 *
	 * @param	resource	$query_id		Query ID
	 * @return	@e void
	 */
	public function freeResult( $query_id );

    /**
	 * Retrieve number of rows in a resultset
	 *
	 * @param	resource	$query_id		Query ID
	 * @return	@e integer Number of rows in the resultset
	 */
	public function result_fields( $query_id );

    /**
	 * Get SQL error number
	 *
	 * @param	resource	$connection_id	Connection ID
	 * @return	@e mixed Error number/code
	 */
	public function error_code( $connection_id );

    /**
	 * Get SQL error message
	 *
	 * @param	resource	$connection_id	Connection ID
	 * @return	@e string Error message
	 */
	public function error_string( $connection_id );
}