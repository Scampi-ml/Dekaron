<?php

/**
 * @file		mssql_sqlsrv.php 	Provides methods to work with a MSSQL Database Engine with SQLSRV extension
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
 * @brief		Provides methods to work with a MSSQL Database Engine with SQLSRV extension
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
	 * Resource that holds the connection ID
	 *
	 * @var 	$connection_id
	 */
	protected $connection_id	= null;
	
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
	 * Array with the latest errors
	 *
	 * @var 	$errors
	 */
	protected $errors			= array();
	
	/**
	 * Resource that holds the query ID
	 *
	 * @var 	$queryID
	 */
	protected $queryID			= null;
	
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
	 * Check if SQLSRV extension exists
	 *
	 * @return	@e boolean True if the extension exists
	 */
	public function check_prerequisites()
	{
		if ( ! function_exists( 'sqlsrv_connect' ) )
		{
			$this->connection_error = "PHP SQLSRV extension not loaded";
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
		sqlsrv_configure("WarningsReturnAsErrors", 0);
		//sqlsrv_configure('LogSubsystems', SQLSRV_LOG_SYSTEM_ALL );

		if ( $this->parent->obj['sql_charset'] )
		{
			$this->connection_id = @sqlsrv_connect( $this->parent->obj['sql_host'],
	 												array(	'UID'				=> $this->parent->obj['sql_user'] ,
	 														'PWD'				=> $this->parent->obj['sql_pass'],
	 														'Database'			=> $this->parent->obj['sql_database'],
	 														'CharacterSet'	    => $this->parent->obj['sql_charset'],
	 														'ConnectionPooling'	=> $this->parent->obj['persistent'] ? 1 : 0
	 											   )	 );
		}
		else
		{
	 		$this->connection_id = @sqlsrv_connect( $this->parent->obj['sql_host'],
	 												array(	'UID'				=> $this->parent->obj['sql_user'] ,
	 														'PWD'				=> $this->parent->obj['sql_pass'],
	 														'Database'			=> $this->parent->obj['sql_database'],
	 														'ConnectionPooling'	=> $this->parent->obj['persistent'] ? 1 : 0
	 											   )	 );
	 	}

		$this->connection_error = '';
		if ( ! $this->connection_id )
		{
			foreach( sqlsrv_errors() as $error )
			{
				$this->connection_error .= "SQLSTATE: ".$error['SQLSTATE']."<br/>";
				$this->connection_error .= "Code: ".$error['code']."<br/>";
				$this->connection_error .= "Message: ".$error['message']."<br/>";
			}
			
			return FALSE;
		}

		return $this->connection_id;
	}
	
    /**
	 * Close the database connection
	 *
	 * @param	resource	$connection_id		Connection ID
	 * @return	@e boolean TRUE if database connection is closed
	 * 
	 * <b>Example Usage:</b>
	 * @code
	 * $isClosed = $this->close();
	 * @endcode
	 */
	public function close( $connection_id )
	{
		return @sqlsrv_close( $connection_id );
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
		if ( !$this->queryId = sqlsrv_query( $connection_id, $the_query ) )
		{
			$this->errors = sqlsrv_errors();
			return false;
		}
		else
		{
			$this->errors = array();
			$this->startrow[ intval( $this->queryId ) ] = 0;
			return $this->queryId;
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
		if ( $start_row > 1 )
		{
			for ( $i=1; $i <= $start_row; $i++ )
			{
				sqlsrv_fetch( $query_id );
			}
		}
	}
	
	/**
	 * Retrieve row from database
	 *
	 * @param	resource	$query_id	Query result id
	 * @return	@e mixed Result set array, or void
	 * 
	 * <b>Example Usage:</b>
	 * @code
	 * // Fetch results
	 * $results = $this->fetch( $query_id );
	 * @endcode
	 */
	public function fetch( $query_id )
	{
		return sqlsrv_fetch_array( $query_id, SQLSRV_FETCH_ASSOC );
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
		return sqlsrv_rows_affected( $this->queryId );
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

		if ( ! $qid = @sqlsrv_query( $this->connection_id, $tmp_query ) )
		{
			$this->errors = sqlsrv_errors();
			$this->parent->throwFatalError( "MSSQL query error: ".$tmp_query );
		}
		else
		{
	        $row = sqlsrv_fetch_array( $qid );
	        sqlsrv_free_stmt( $qid );
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
		@sqlsrv_free_stmt($query_id);
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
    	$fields = array();

		foreach( sqlsrv_field_metadata( $query_id ) as $field )
		{
	        $fields[] = $field['Name'];
		}

		return $fields;
	}
	
    /**
	 * Get SQL error number
	 *
	 * @param	resource	$connection_id		Connection ID
	 * @return	@e mixed Error number/code
	 * 
	 * <b>Example Usage:</b>
	 * @code
	 * // Get any error code
	 * $error = $this->error_code( $connection_id );
	 * @endcode
	 */
	public function error_code( $connection_id )
	{
		$errorcode = 0;
		if ( is_array( $this->errors ) )
		{
			foreach( $this->errors as $error )
			{
				$errorcode = $error['code'];
			}
		}
		return $errorcode;
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
		$errorstring = '';
		if ( is_array( $this->errors ) )
		{
			foreach( $this->errors as $error )
			{
				$errorstring .= $error['message']."\r\n";
			}
		}
		return $errorstring;
	}
	
    /**
	 * Get SQL Server version number
	 *
	 * @param	resource	$connection_id		Connection ID
	 * @return	@e string Version number
	 * 
	 * <b>Example Usage:</b>
	 * @code
	 * $version = $this->get_version( $connection_id );
	 * @endcode
	 */
	public function get_version( $connection_id )
	{
		$server_info = sqlsrv_server_info( $connection_id );
		return $server_info['SQLServerVersion'];
	}
}