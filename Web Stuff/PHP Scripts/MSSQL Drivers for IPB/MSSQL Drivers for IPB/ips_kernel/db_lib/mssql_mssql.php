<?php

/**
 * @file		mssql_adob_com.php 	Provides methods to work with a MSSQL Database Engine over PHP MSSQL extension
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
 * Textsize allowed size
 */
define( 'MSSQL_DB_TEXTSIZE', 2147483647 );

/**
 * Textlimit allowed size
 */
define( 'MSSQL_DB_TEXTLIMIT', 2147483647 );


/**
 *
 * @class		mssql_lib
 * @implements	interface_mssql_lib
 * @brief		Provides methods to work with a MSSQL Database Engine over PHP MSSQL extension
 *
 */
class mssql_lib implements interface_mssql_lib
{
	/**
	* Reference to the parent driver object
	*
	* @access	protected
	* @var 		object 		Reference to the parent driver object
	*/
	protected $parent			= null;

	/**
	* Connection error string
	*
	* @access	public
	* @var 		string 		Connection error string
	*/
	public $connection_error	= '';

	/**
	* Startrow cache for results
	*
	* @access	protected
	* @var 		array 		Startrow cache for results
	*/
	protected $startrow			= array();

	/**
	* constructor
	*
	* @access	public
	* @param	object		Parent object
	* @return	void
	*/

	public function __construct( $parent_class )
	{
		$this->parent = $parent_class;
	}

	/**
	* Check required extensions
	*
	* @access	public
	* @return	boolean		Required extensions enabled
	*/
	public function check_prerequisites()
	{
		if ( ! function_exists( 'mssql_connect' ) )
		{
			$this->connection_error = "PHP MSSQL extension not loaded";
			return FALSE;
		}
		return TRUE;

	}

    /**
	* Connect to database server
	*
	* @access	public
	* @return	resource	Connection ID
	*/
	public function connect()
	{
		$textsize_set = 0;
		
		if ( !$this->parent->connect_vars['sql_unixtype'] )
		{
			ini_set("mssql.textsize", MSSQL_DB_TEXTSIZE );
			ini_set("mssql.textlimit", MSSQL_DB_TEXTLIMIT );
			$textsize_set = 1;
		}

		if ( $this->parent->obj['persistent'] )
		{
	 		$connection_id = @mssql_pconnect( $this->parent->obj['sql_host'] ,
											  $this->parent->obj['sql_user'] ,
											  $this->parent->obj['sql_pass'] ,
											  $this->parent->obj['force_new_connection']
											);
		}
		else
		{
	 		$connection_id = @mssql_connect( $this->parent->obj['sql_host'] ,
											 $this->parent->obj['sql_user'] ,
											 $this->parent->obj['sql_pass'] ,
											 $this->parent->obj['force_new_connection']
										   );
		}

		if ( ! $connection_id )
		{
			$this->connection_error = 'Failed to connect to the database';
			return FALSE;
		}

        if ( ! @mssql_select_db($this->parent->obj['sql_database'], $connection_id) )
        {
        	$this->connection_error = 'Failed to select the database '.$this->parent->obj['sql_database'];
        	return FALSE;
        }

		// Only do this when textsize is not set yet.
		if (!$textsize_set && $this->parent->connect_vars['sql_unixtype'] == 'freetds' ) mssql_query("set textsize ".$this->textsize, $connection_id);

		return $connection_id;
	}

    /**
	* Close the database connection
	*
	* @access	public
	* @param	resource	Connection ID
	* @return	boolean		Database connection closed
	*/
	public function close( $connection_id )
	{
		return @mssql_close( $connection_id );
	}

    /**
	* Execute a direct database query
	*
	* @access	public
	* @param	string		Database query
	* @param	resource	Connection ID
	* @return	resource	Query ID
	*/
	public function query( $the_query='', $connection_id )
	{
		$qid = @mssql_query ( $the_query, $connection_id );
		if ( $qid ) $this->startrow[ intval( $qid ) ] = 0;
		return $qid;
	}

    /**
	* Simulate limit in SQL Server
	*
	* @access	public
	* @param	resource	Query ID
	* @param	integer		First row to return from result set
	* @return	void
	*/
	public function limit_simulation( $query_id, $start_row )
	{
		$this->startrow[ intval( $query_id ) ] = $start_row;
		if ( $start_row > 0 && mssql_num_rows($query_id) > $start_row )
		{
			mssql_data_seek ( $query_id, $start_row );
		}
	}

    /**
	* Retrieve row from database
	*
	* @access	public
	* @param	resource	[Optional] Query result id
	* @return	mixed		Result set array, or void
	*/
	public function fetch( $query_id )
	{
		if ( $this->startrow[ intval( $query_id ) ] >= mssql_num_rows($query_id))
		{
			return false;
		}
		else
		{
			if ( $this->parent->connect_vars['sql_unixtype'] == 'sybase' )
			{
				$row = mssql_fetch_assoc( $query_id );
			}
			else
			{
				$row = mssql_fetch_array( $query_id, MSSQL_ASSOC );
			}

            // Trailing spaces need to be trimed. The extension always returns trailing spaces
			$record_row = "";
			if(is_array($row)) {
				while(list($key, $val) = each($row)) {
					$record_row[$key] = rtrim($val);
				}
			}
		}
		return $record_row;
	}

    /**
	* Retrieve the column names of a resultset
	*
	* @access	public
	* @param	resource	Query ID
	* @return	integer		Column names of a resultset
	*/
	public function affected_rows( $connection_id )
	{
       	return mssql_rows_affected( $connection_id );
    }

    /**
	* Retrieve number of rows in a resultset
	*
	* @access	public
	* @param	resource	Query ID
	* @return	integer		Number of rows in the resultset
	*/
	public function num_rows( $query_id )
	{
		return ( mssql_num_rows($query_id) - $this->startrow[ intval($query_id) ] ) > 0 ? ( mssql_num_rows($query_id) - $this->startrow[ intval( $query_id ) ] ) : 0;
	}

    /**
	* Free the result
	*
	* @access	public
	* @param	resource	Query ID
	* @return	void
	*/
	public function freeResult( $query_id )
	{
	   	@mssql_free_result($query_id);
	}

    /**
	* Retrieve number of rows in a resultset
	*
	* @access	public
	* @param	resource	Query ID
	* @return	integer		Number of rows in the resultset
	*/
	public function result_fields( $query_id )
	{
		while ( $field = mssql_fetch_field( $query_id ) )
		{
	        $Fields[] = $field->name;
		}
		return $Fields;
	}

    /**
	* Get SQL error number
	*
	* @access	public
	* @param	resource	Connection ID
	* @return	mixed		Error number/code
	*/
	public function error_code( $connection_id )
	{
		if ( $result = @mssql_query("SELECT @@ERROR AS errorcode", $connection_id) )
		{
			$array = mssql_fetch_array( $result, MSSQL_ASSOC );
			return $array['errorcode'];
		}
		else
		{
			return 0;
		}
	}

    /**
	* Get SQL error message
	*
	* @access	protected
	* @param	resource	Connection ID
	* @return	string		Error message
	*/
	public function error_string( $connection_id )
	{
		return mssql_get_last_message();
	}

    /**
	* Get SQL Server version number
	*
	* @access	public
	* @param	resource	Connection ID
	* @return	string		Version number
	*/
	public function get_version( $connection_id )
	{
		$qid = $this->query( "SELECT serverproperty('ProductVersion') AS version", $connection_id );

		$result = $this->fetch( $qid );

		return $result['version'];
	}

}

?>