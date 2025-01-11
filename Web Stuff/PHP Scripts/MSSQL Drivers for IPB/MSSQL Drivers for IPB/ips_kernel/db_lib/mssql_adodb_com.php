<?php

/**
 * @file		mssql_adob_com.php 	Provides methods to work with a MSSQL Database Engine ADODB over COM
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
 * @brief		Provides methods to work with a MSSQL Database Engine ADODB over COM
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
	 * Number of affected rows by last update query
	 *
	 * @var		$rows_affected
	 */
	protected $rows_affected	= 0;
	
	/**
	 * Array for resultset cache
	 *
	 * @var		$result_set
	 */
	protected $result_set		= array();
	
	/**
	 * Array for Recordset resource cache
	 *
	 * @var		$result_set
	 */
	protected $rs				= array();
	
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
	 * Check if COM extension exists
	 *
	 * @return	@e boolean True if the extension exists
	 */
	public function check_prerequisites()
	{
		if ( ! class_exists('COM') )
		{
			$this->connection_error = "PHP COM extension not loaded";
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
		$dsn = "Provider=SQLOLEDB.1;Password={$this->parent->obj['sql_pass']};Persist Security Info=False;User ID={$this->parent->obj['sql_user']};Initial Catalog={$this->parent->obj['sql_database']};Data Source={$this->parent->obj['sql_host']}";
		$connection_id = new COM("ADODB.Connection");
		$connection_id->CursorLocation = 3;

		try
		{
			$connection_id->Open($dsn);
		}
		catch ( com_exception $e )
		{
			$this->connection_error = "Failed to connect to the database";
	   		foreach ( $connection_id->Errors as $id => $error)
			{
	       		$this->connection_error .= "\r\n".$error->Description;
	       	}
	       	return FALSE;
		}

		if ( ! $this->query( "SET TRANSACTION ISOLATION LEVEL READ COMMITTED", $connection_id ) )
		{
			return FALSE;
		}

		return $connection_id;
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
		try
		{
			$connection_id->Close();
		}
		catch ( com_exception $e )
		{
			return FALSE;
		}
		return TRUE;
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
		$query_id = uniqid( 'qid' );
		try
		{
		    $this->rs[$query_id] = $connection_id->Execute( $the_query, $this->rows_affected, 1);
		}
		catch ( com_exception $e )
		{
			return FALSE;
		}
		return $query_id;
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
		$this->startrow[ $query_id ] = $start_row;
		if ($start_row > 0 && $this->rs[$query_id]->RecordCount > $start_row )
		{
			$this->rs[$query_id]->Move( $start_row );
		}
		else if ($start_row > 0 && $this->rs[$query_id]->RecordCount )
		{
			$this->rs[$query_id]->Move( $this->rs[$query_id]->RecordCount );
		}
	}
	
    /**
	 * Retrieve row from database
	 *
	 * @param	resource	$query_id	Query result id
	 * @return	@e mixed Result set array, or FALSE
	 * 
	 * <b>Example Usage:</b>
	 * @code
	 * // Fetch results
	 * $results = $this->fetch( $query_id );
	 * @endcode
	 */
	public function fetch( $query_id )
	{
		if ( ! $this->rs[ $query_id ]->EOF )
		{
			$array = array();
			foreach ( $this->rs[ $query_id ]->Fields as $id => $field )
			{
				$array[$field->name] = rtrim($field->value);
			}

			try
			{
				$this->rs[ $query_id ]->MoveNext();
			}
			catch ( com_exception $e )
			{
		       	$this->parent->throwFatalError("MSSQL fetch row error:\n".$this->parent->last_query);
		    }

			return $array;
		}
		else
		{
			return FALSE;
		}
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
        return $this->rows_affected;
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
        return ( $this->rs[$query_id]->RecordCount - $this->startrow[$query_id] ) > 0 ? ( $this->rs[$query_id]->RecordCount - $this->startrow[$query_id] ) : 0;
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
	   	@$this->rs[$query_id]->Close();
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
		
		foreach ( $this->rs[$query_id]->Fields as $id => $field )
		{
			$Fields[]->name = $field->name;
		}
		
		return $Fields;
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
		$error_no = 0;
		
   		foreach ( $connection_id->Errors as $id => $error)
		{
       		$error_no = $error->NativeError;
       	}
       	
		return $error_no;
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
   		$error_str = '';
   		foreach ( $connection_id->Errors as $id => $error)
		{
       		$error_str = $error->Description;
       	}
		return $error_str;
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
		$qid = $this->query( "SELECT serverproperty('ProductVersion') AS version", $connection_id );

		$result = $this->fetch( $qid );

		return $result['version'];
	}
}