<?php

/**
 * @file		mssql_odbc.php 	Provides methods to work with a MSSQL Database Engine ODBC
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
 * @class		mssql_lib
 * @implements	interface_mssql_lib
 * @brief		Provides methods to work with a MSSQL Database Engine ODBC
 *
 */
class mssql_lib implements interface_mssql_lib
{
	/**
	 * Reference to the parent driver object
	 *
	 * @var		$parent
	 */
	protected $parent			= null;
	
	/**
	 * String that holds the connection error
	 *
	 * @var		$connection_error
	 */
	public $connection_error	= '';
	
	/**
	 * Array for startrow cache results
	 *
	 * @var		$startrow
	 */
	protected $startrow			= array();
	
	/**
	 * Array for currentrow cache results
	 *
	 * @var		$currentrow
	 */
	protected $currentrow		= array();
	
	/**
	 * Constructor
	 *
	 * @param	object		$parent_class		Parent object
	 * @return	@e void
	 */
	public function __construct( $parent_class )
	{
		$this->parent = $parent_class;
	}
	
	/**
	 * Check if ODBC extension exists
	 *
	 * @return	@e boolean True if the extension exists
	 */
	public function check_prerequisites()
	{
		if ( ! function_exists( 'odbc_connect' ) )
		{
			$this->connection_error = "PHP ODBC extension not loaded";
			return FALSE;
		}
		
		return TRUE;
	}
	
    /**
	 * Connect to database server
	 *
	 * @return	@e mixed Connection ID otherwise FALSE on fail
	 * 
	 * <b>Example Usage:</b>
	 * @code
	 * $connectionID = $this->connect();
	 * @endcode
	 */
	public function connect()
	{
		if ( $this->parent->obj['persistent'] )
		{
	 		$connection_id = @odbc_pconnect( $this->parent->obj['sql_host'], $this->parent->obj['sql_user'], $this->parent->obj['sql_pass'],  SQL_CUR_USE_DRIVER );
	 	}
	 	else
	 	{
	 		$connection_id = @odbc_connect( $this->parent->obj['sql_host'], $this->parent->obj['sql_user'], $this->parent->obj['sql_pass'] ,  SQL_CUR_USE_DRIVER );
		}

		if ( ! $connection_id )
		{
			$this->connection_error = "Failed to connect to the database";
			return FALSE;
		}

		odbc_autocommit( $connection_id, TRUE );
		ini_set ( 'odbc.defaultlrl' , $this->textsize );
		return $connection_id;
	}
	
    /**
	 * Close the database connection
	 *
	 * @param	resource	$connection_id		Connection ID
	 * @return	@e void
	 * 
	 * <b>Example Usage:</b>
	 * @code
	 * $this->close();
	 * @endcode
	 */
	public function close( $connection_id )
	{
		return @odbc_close( $connection_id );
	}
	
    /**
	 * Execute a direct database query
	 *
	 * @param	string		$the_query		Database query
	 * @param	resource	$connection_id	Connection ID
	 * @return	@e mixed Query ID otherwise FALSE on fail
	 * 
	 * <b>Example Usage:</b>
	 * @code
	 * $queryID = $this->query( $the_query, $connection_id );
	 * @endcode
	 */
	public function query( $the_query='', $connection_id )
	{
		if ( ! $qid = @odbc_exec( $connection_id, $the_query ) )
		{
			return FALSE;
		}
		else
		{
			$this->startrow[ intval( $qid ) ] = 0;
			$this->currentrow[ intval( $qid ) ] = 0;
			return $qid;
		}
	}
	
    /**
	 * Simulate limit in SQL Server
	 *
	 * @param	resource	$query_id		Query ID
	 * @param	integer		$start_row		First row to return from result set
	 * @return	@e void
	 * 
	 * <b>Example Usage:</b>
	 * @code
	 * $this->limit_simulation( $query_id, $start_row );
	 * @endcode
	 */
	public function limit_simulation( $query_id, $start_row )
	{
		$this->startrow[ intval( $query_id ) ] = $start_row;
		$this->currentrow[ intval( $query_id ) ] = $start_row;
	}
		
	/**
	 * Retrieve row from database
	 *
	 * @param	resource	$query_id	[Optional] Query result id
	 * @return	@e array Result set array
	 * 
	 * <b>Example Usage:</b>
	 * @code
	 * // Fetch results - Query ID is optional if you want the last one
	 * $results = $this->fetch();
	 * $results = $this->fetch( $query_id );
	 * @endcode
	 */	
	public function fetch( $query_id )
	{
		if ($query_id == "")
		{
			$query_id = $this->query_id;
		}

		$this->current_row[ intval( $query_id ) ]++;
		if ( $this->start_row[ intval( $query_id ) ] == ($this->current_row[ intval( $query_id ) ]-1) && $this->start_row[ intval( $query_id ) ] > 1 )
		{
			$this->record_row = odbc_fetch_array( $query_id, $this->current_row[ intval( $query_id ) ] );
		}
		else
		{
			$this->record_row = odbc_fetch_array( $query_id );
		}

		return $this->record_row;
	}
	
    /**
	 * Retrieve number of rows affected by last query
	 *
	 * @param	resource	$connection_id		Connection ID
	 * @return	@e integer Number of rows affected by last query
	 * 
	 * <b>Example Usage:</b>
	 * @code
	 * // Fetch number of rows
	 * $affectedRows = $this->affected_rows( $connection_id );
	 * @endcode
	 */
	public function affected_rows( $connection_id )
	{
		return odbc_num_rows( $this->parent->query_id );
	}
	
    /**
	 * Retrieve number of rows in a resultset
	 *
	 * @param	resource	$query_id		Query ID
	 * @return	@e integer Number of rows in the resultset
	 * 
	 * <b>Example Usage:</b>
	 * @code
	 * // Fetch number of rows for a resultset
	 * $affectedRows = $this->num_rows( $query_id );
	 * @endcode
	 */
	public function num_rows( $query_id )
	{
		$tmp_query = preg_replace( "#(ORDER BY.*)$#is", '', $this->parent->obj['cached_queries'][$this->parent->query_count-1] );

		$first = stripos( $tmp_query, ',' );
		$last = stripos( $tmp_query, 'FROM' );
		if ( $first > 0 && $first < $last )
		{
			$tmp_query = substr( $tmp_query, 0, $first ).' '.substr( $tmp_query, $last );
		}
        $tmp_query = "SELECT COUNT(*) as num_rows FROM ( ".$tmp_query." ) as CNT";
		if ( ! $qid = @odbc_exec ( $this->parent->connection_id, $tmp_query ) )
		{
			$this->parent->throwFatalError("MSSQL query error: {$tmp_query}");
		}
		else
		{
	        $row = odbc_fetch_array( $qid );
	        odbc_free_result( $qid );
			$result_rows = $row['num_rows'];
		}

		return ( $result_rows - $this->startrow[ intval($query_id) ] ) > 0 ? ( $result_rows - $this->startrow[ intval( $query_id ) ] ) : 0;
	}
	
    /**
	 * Free the result
	 *
	 * @param	resource	$query_id		Query ID
	 * @return	@e void
	 * 
	 * <b>Example Usage:</b>
	 * @code
	 * // Clear results
	 * $this->freeResult( $query_id );
	 * @endcode
	 */
	public function freeResult( $query_id )
	{
		@odbc_free_result($query_id);
	}
	
    /**
	 * Retrieve the column names of a resultset
	 *
	 * @param	resource	$query_id		Query ID
	 * @return	@e array Column names of a resultset
	 * 
	 * <b>Example Usage:</b>
	 * @code
	 * // Get column names
	 * $columnNames = $this->result_fields( $query_id );
	 * @endcode
	 */
	public function result_fields( $query_id )
	{
		$Fields = array();
		
		for ( $i=1; $i <= odbc_num_fields ( $query_id ); $i++ )
		{
			$Fields[]->name = odbc_field_name( $query_id, $i );
		}
		
		return $Fields;
	}
	
    /**
	 * Get SQL error number
	 *
	 * @param	resource	$connection_id		Connection ID
	 * @return	@e string Error code
	 * 
	 * <b>Example Usage:</b>
	 * @code
	 * // Get any error code
	 * $error = $this->error_code( $connection_id );
	 * @endcode
	 */
	public function error_code( $connection_id )
	{
		return odbc_error( $connection_id );
	}
	
    /**
	 * Get SQL error message
	 *
	 * @param	resource	$connection_id		Connection ID
	 * @return	@e string Error message
	 * 
	 * <b>Example Usage:</b>
	 * @code
	 * // Get any error message
	 * $error = $this->error_string( $connection_id );
	 * @endcode
	 */
	public function error_string( $connection_id )
	{
		return odbc_errormsg( $connection_id );
	}
}