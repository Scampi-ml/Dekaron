<?php

/**
 * <pre>
 * Invision Power Services
 * IP.Board v3.1.4
 * MSSQL Database Driver
 * Last Updated: $Date: 2011-01-12 10:32:46 +1300 (Wed, 12 Jan 2011) $
 * </pre>
 *
 * @author 		$Author: mat $
 * @copyright	(c) 2001 - 2009 Invision Power Services, Inc.
 * @license		http://www.invisionpower.com/community/board/license.html
 * @package		IP.Board
 * @subpackage	Kernel
 * @link		http://www.invisionpower.com
 * @since		Wednesday 30th March 2008 15:00
 * @version		$Revision: 502 $
 */


/**
 * Handle base class definitions
 *
 */

if ( ! class_exists( 'dbMain' ) )
{
	require_once( dirname( __FILE__ ) . '/classDb.php' );
}

if( ! interface_exists( 'interface_mssql_lib' ) )
{
	require_once( dirname( __FILE__ ) . '/db_lib/interface_mssql_lib.php' );
}

class db_driver_mssql extends dbMain implements interfaceDb
{
	/**
	* Cached field names in table
	*
	* @access	protected
	* @var 		array 		Field names cached
	*/
	protected $cached_fields		= array();

	/**
	* Cached table names in database
	*
	* @access	protected
	* @var 		array 		Table names cached
	*/
	protected $cached_tables	= array();

	/**
	* Startrow for limit simulation
	*
	* @access	protected
	* @var 		integer 		Startrow of query result
	*/
	public $cur_startrow		= 0;

	/**
	* SQL Connection Engine Object
	*
	* @access	protected
	* @var 		object
	*/
	protected $engine			= null;
	
	/**
	 * Already added fields
	 * Prevents MSSQL getting confused
	 *
	 * @access	private
	 * @var		array
	 */
	private $_addedFields = array();

	/**
	* constructor
	*
	* @access	public
	* @return	void
	*/

	public function __construct()
	{
		//--------------------------------------
		// Set up any required connect vars here
		//--------------------------------------

     	$this->connect_vars['sql_type']		= 'MSSQL';
		$this->connect_vars['sql_unixtype'] = '';
	}

	/*-------------------------------------------------------------------------*/
	// Connect and disconnect methods
	/*-------------------------------------------------------------------------*/

    /**
	* Connect to database server
	*
	* @access	public
	* @return	boolean		Connection successful
	*/

	public function connect()
	{
     	//--------------------------
     	// Load the classes
     	//--------------------------
		if ( ! is_object( $this->engine ) )
		{
			switch ( strtoupper( $this->connect_vars['sql_type'] ) )
			{
				case 'COM':
					require_once( dirname( __FILE__ ) . '/db_lib/mssql_adodb_com.php' );
					break;
				case 'SQLSRV':
					require_once( dirname( __FILE__ ) . '/db_lib/mssql_sqlsrv.php' );
					break;
				default:
					require_once( dirname( __FILE__ ) . '/db_lib/mssql_mssql.php' );
			}
			
			$this->engine = new mssql_lib( $this );
		}

     	//--------------------------
     	// Does the install have all pre-requisites?
     	//--------------------------
		if ( ! $this->engine->check_prerequisites() )
		{
			$this->throwFatalError( $this->engine->connection_error );
			return FALSE;
		}

		//-----------------------------------------
     	// Done SQL prefix yet?
     	//-----------------------------------------

     	$this->_setPrefix();

    	//-----------------------------------------
    	// Load query file
    	//-----------------------------------------

    	$this->_loadCacheFile();

     	//--------------------------
     	// Connect
     	//--------------------------

		$this->obj['sql_host'] = str_replace( "&#092;", "\\", $this->obj['sql_host'] );

		if ( ! $this->connection_id = $this->engine->connect() )
		{
			$this->throwFatalError( $this->engine->connection_error );
			return FALSE;
		}

     	//--------------------------
     	// Remove sensitive data
     	//--------------------------
		unset( $this->obj['sql_host'] );
		unset( $this->obj['sql_user'] );
		unset( $this->obj['sql_pass'] );

		parent::connect();

        return TRUE;
	}

    /**
	* Close database connection
	*
	* @access	public
	* @return	boolean		Closed succesfully
	*/

	public function disconnect()
	{
    	if ( $this->connection_id )
    	{
    		return $this->engine->close( $this->connection_id );
    	}
    	else
    	{
    		return FALSE;
    	}
    }

	/*-------------------------------------------------------------------------*/
	// Building and executing queries
	/*-------------------------------------------------------------------------*/

    /**
	* Execute a direct database query
	*
	* @access	public
	* @param	string		Database query
	* @param	boolean		[Optional] Do not convert table prefix
	* @return	resource	Query id
	*/

	public function query( $the_query, $bypass=false )
	{
		//-----------------------------------------
		// Change the table prefix if needed
        //-----------------------------------------
        if ( $this->no_prefix_convert )
        {
        	$bypass = 1;
        }

        if ( ! $bypass )
        {
			if ( $this->obj['sql_tbl_prefix'] != "ibf_" and ! $this->prefix_changed )
			{
			   $the_query = preg_replace("/\sibf_(\S+?)([\s\.,]|$)/", " ".$this->obj['sql_tbl_prefix']."\\1\\2", $the_query);
			}
        }

        //-----------------------------------------
        // Debug?
        //-----------------------------------------
        if ( $this->obj['debug'] OR ( $this->obj['use_debug_log'] AND $this->obj['debug_log'] ) )
        {
			IPSDebug::startTimer();
    	}

		//-----------------------------------------
		// Stop sub selects? (UNION)
		//-----------------------------------------
		if ( ! IPS_DB_ALLOW_SUB_SELECTS )
		{
			# On the spot allowance?
			if ( ! $this->allow_sub_select )
			{
				$_tmp = strtolower( $this->_removeAllQuotes($the_query) );

				if ( preg_match( "#(?:/\*|\*/)#i", $_tmp ) )
				{
					$this->throwFatalError( "You are not allowed to use comments in your SQL query.\nAdd \ipsRegistry::DB()->allow_sub_select=1; before any query construct to allow them\n\n$the_query" );
					return false;
				}

				if ( preg_match( "#[^_a-zA-Z]union[^_a-zA-Z]#s", $_tmp ) )
				{
					$this->throwFatalError( "UNION query joins are not allowed.\nAdd \ipsRegistry::DB()->allow_sub_select=1; before any query construct to allow them\n\n$the_query" );
					return false;
				}
				else if ( preg_match_all( "#[^_a-zA-Z](select)[^_a-zA-Z]#s", $_tmp, $matches ) )
				{
					if ( count( $matches ) > 1 AND substr( $_tmp, 0, 18 ) != 'if exists ( select' )
					{
						$this->throwFatalError( "SUB SELECT query joins are not allowed.\nAdd \ipsRegistry::DB()->allow_sub_select=1; before any query construct to allow them\n\n$the_query" );
						return false;
					}
				}
			}
		}
		
    	//-----------------------------------------
    	// Run the query
    	//-----------------------------------------
		$this->query_id = $this->engine->query( $the_query, $this->connection_id );

      	//-----------------------------------------
      	// Reset array...
      	//-----------------------------------------
      	
      	$this->allow_sub_select = false;

		if (! $this->query_id )
		{
			$this->throwFatalError("MSSQL query error:\r\n$the_query");
		}

        //-----------------------------------------
        // MSSQL limit simulation?
        //-----------------------------------------
		if ( strtoupper( substr( ltrim( $the_query ), 0, 6 )) == 'SELECT' )
		{
			$this->engine->limit_simulation( $this->query_id, $this->cur_startrow );
		}
		$this->cur_startrow = 0;

        //-----------------------------------------
        // Debug?
        //-----------------------------------------
		if ( $this->obj['use_debug_log'] AND $this->obj['debug_log'] )
		{
			$endtime  = IPSDebug::endTimer();

			$this->engine->query( 'SET SHOWPLAN_ALL ON', $this->connection_id );
			$eid = $this->engine->query( $the_query, $this->connection_id );

			while ( $array = $this->engine->fetch( $eid ) )
			{
				$_data .= "\n+------------------------------------------------------------------------------+";
				$_data .= "\n|Statement Text: ". $array['StmtText'];
				$_data .= "\n|Type: ". $array['Type'];
				$_data .= "\n|Estimate Rows: ". $array['EstimateRows'];
				$_data .= "\n|Estimate IO: ". $array['EstimateIO'];
				$_data .= "\n|Estimate CPU: ". $array['EstimateCPU'];
				$_data .= "\n|Average Row Size: ". $array['AvgRowSize'];
				$_data .= "\n|Total Subtree Cost: ". $array['TotalSubtreeCost'];
				$_data .= "\n|Warnings: ". $array['Warnings'];
				$_data .= "\n|Estimate Executions: ". $array['EstimateExecutions'];
				$_data .= "\n+------------------------------------------------------------------------------+";
			}

			$this->engine->freeResult( $eid );
			$this->engine->query( 'SET SHOWPLAN_ALL OFF', $this->connection_id );

			$this->writeDebugLog( $the_query, $_data, $endtime );
		}
		else if ($this->obj['debug'])
        {
            // Yeah debug. I love debug. It helps you see that a board is actually running on MSSQL
			$endtime  = IPSDebug::endTimer();

        	$shutdown = ($this->is_shutdown ? 'SHUTDOWN ' : '');

			$this->engine->query( 'SET SHOWPLAN_ALL ON', $this->connection_id );
			$eid = $this->engine->query( $the_query, $this->connection_id );

			$this->debug_html .= "<table width='95%' border='1' cellpadding='6' cellspacing='0' bgcolor='#FEFEFE'  align='center'>
									   <tr>
	    							   	 <td colspan='8' style='font-size:14px' bgcolor='#FFC5Cb'><b>{$shutdown}Query:</b></td>
    								   </tr>
									   <tr>
									    <td colspan='8' style='font-family:courier, monaco, arial;font-size:14px;color:black'>$the_query</td>
									   </tr>\n";

			while ( $array = $this->engine->fetch( $eid ) )
			{
				$this->debug_html .= "  <tr>
    <td colspan='8' style='font-size:14px' bgcolor='#EFEFEF'><b>Statement Text</b></td>
  </tr>
  <tr>
	  <td colspan='8' style='font-family:courier new, courier, monaco, arial;font-size:14px'>$array[StmtText]</td>
	</tr>
   <tr bgcolor='#FFC5Cb'>
	 <td><b>type</b></td><td><b>estimate rows</b></td>
	 <td><b>estimate IO</b></td><td><b>estimate CPU</b></td><td><b>avg row size</b></td>
	 <td><b>total subtree cost</b></td><td><b>Warnings</b></td><td><b>estimate executions</b></td>
   </tr>\n";
				$type_col = '#FFFFFF';

				$this->debug_html .= "<tr bgcolor='#FFFFFF'>
										 <td bgcolor='$type_col'>$array[Type]&nbsp;</td>
										 <td>$array[EstimateRows]&nbsp;</td>
										 <td>$array[EstimateIO]&nbsp;</td>
										 <td>$array[EstimateCPU]&nbsp;</td>
										 <td>$array[AvgRowSize]&nbsp;</td>
										 <td>$array[TotalSubtreeCost]&nbsp;</td>
										 <td>$array[Warnings]&nbsp;</td>
										 <td>$array[EstimateExecutions]&nbsp;</td>
									   </tr>\n";
			}

			$this->engine->freeResult( $eid );
			$this->engine->query( 'SET SHOWPLAN_ALL OFF', $this->connection_id );

   			$this->sql_time += $endtime;
			if ($endtime > 0.1)
			{
                // I have yet to see the red ones. Keep em green baby.
				$endtime = "<span style='color:red'><b>$endtime</b></span>";
			}

			$this->debug_html .= "<tr>
										  <td colspan='8' bgcolor='#FFD6DC' style='font-size:14px'><b>MSSQL time</b>: $endtime</b></td>
										  </tr>
										  </table>\n<br />\n";

		}

		$this->query_count++;

        $this->obj['cached_queries'][] = $the_query;

        return $this->query_id;
	}

	/*-------------------------------------------------------------------------*/
	// Managing the result set
	/*-------------------------------------------------------------------------*/

    /**
	* Retrieve number of rows affected by last query
	*
	* @access	public
	* @return	integer		Number of rows affected by last query
	*/

	public function getAffectedRows()
	{
		return $this->engine->affected_rows( $this->connection_id );
	}

    /**
	* Retrieve number of rows in result set
	*
	* @access	public
	* @param	resource	[Optional] Query id
	* @return	integer		Number of rows in result set
	*/

	public function getTotalRows( $query_id=null )
	{
		if ( ! $query_id )
   		{
    		$query_id = $this->query_id;
    	}

		return $this->engine->num_rows( $this->query_id );
    }

    /**
	* Retrieve latest identity insert id
	*
	* @access	public
	* @return	integer		Last identity id assigned
	*/

	public function getInsertId()
	{
		if ( ! $qid = $this->engine->query("SELECT @@IDENTITY AS insert_id", $this->connection_id) )
		{
			$this->throwFatalError("MSSQL query error: Failed to fetch insert id");
		}
		$result = $this->engine->fetch( $qid );
		return $result['insert_id'];
	}

    /**
	 * Retrieve the current thread id
	 *
	 * @access	public
	 * @return	integer		Current thread id
	 */

	public function getThreadId()
	{
		if ( ! $qid = $this->engine->query("SELECT @@SPID AS thread_id", $this->connection_id) )
		{
			$this->throwFatalError("MSSQL query error: Failed to fetch current thread id");
		}
		$result = $this->engine->fetch( $qid );
		return $result['thread_id'];
	}

    /**
	* Free result set from memory
	*
	* @access	public
	* @param	resource	[Optional] Query id
	* @return	void
	*/

	public function freeResult( $query_id=null )
	{
   		if ( ! $query_id )
   		{
    		$query_id = $this->query_id;
    	}

		$this->engine->freeResult( $query_id );
   }

    /**
	* Retrieve row from database
	*
	* @access	public
	* @param	resource	[Optional] Query result id
	* @return	mixed		Result set array, or void
	*/

	public function fetch( $query_id=null )
	{
    	if ( ! $query_id )
    	{
    		$query_id = $this->query_id;
    	}

        $this->record_row = $this->engine->fetch( $query_id );

        return $this->record_row;
    }

	/**
	* Return the number calculated rows (as if there was no limit clause)
	*
	* @access	public
	* @param	string 		[ alias name for the count(*) ]
	* @return	int			The number of rows
	*/
	public function fetchCalculatedRows( $alias='count' )
	{
		return intval( $this->_calcRows );
	}

    /**
	* Get array of fields in result set
	*
	* @access	public
	* @param	resource	[Optional] Query id
	* @return	array		Fields in result set
	*/

	public function getResultFields( $query_id=null )
	{
   		if ( !$query_id )
   		{
    		$query_id = $this->query_id;
    	}

		return $this->engine->result_fields( $query_id );
	}

	/*-------------------------------------------------------------------------*/
	// Database testing and management
	/*-------------------------------------------------------------------------*/

    /**
	* Get array of table names in database
	*
	* @access	public
	* @return	array		SQL tables
	*/

	public function getTableNames()
	{
	    if ( is_array( $this->cached_tables ) AND count( $this->cached_tables ) )
	    {
		    return $this->cached_tables;
	    }

		$qid = $this->engine->query( "SELECT name FROM sysobjects WHERE xtype='U' AND name<>'dtproperties' ORDER BY name", $this->connection_id );

	    if( $qid )
	    {
			while ( $result = $this->engine->fetch( $qid ) )
			{
				$this->cached_tables[] = $result[ 'name' ];
			}
			$this->engine->freeResult( $qid );
		}

		return $this->cached_tables;
	}

    /**
	* Retrieve SQL server version
	*
	* @access	public
	* @return	string		SQL Server version
	*/

	public function getSqlVersion()
	{
		if ( ! $this->sql_version and ! $this->true_version )
		{
			$result = $this->engine->get_version( $this->connection_id );

			$this->true_version = $result;

			$tmp                = explode( '.', preg_replace( "#[^\d\.]#", "\\1", $result['version'] ) );
			$this->sql_version = sprintf('%d%02d%02d', $tmp[0], $tmp[1], $tmp[2] );
   		}

   		return $this->sql_version;
	}

	/*-------------------------------------------------------------------------*/
	// Building, formatting and parsing a query
	/*-------------------------------------------------------------------------*/

    /**
	* Escape strings for DB insertion
	*
	* @access	public
	* @param	string		Text to escape
	* @return	string		Escaped text
	*/

	public function addSlashes( $t )
	{
        return str_replace( chr(0), "'+CHAR(0)+'", str_replace( "'", "''", $t ) );
	}

    /**
	* Build order by clause
	*
	* @access	protected
	* @param	string		Order by clause
	* @return	void
	*/

	protected function _buildOrderBy( $order )
	{
    	if ( $order )
    	{
    		$this->cur_query .= ' ORDER BY ' . $order;
    	}
	}

    /**
	* Build having clause
	*
	* @access	protected
	* @param	string		Having clause
	* @return	void
	*/

	protected function _buildHaving( $having_clause )
	{
    	if ( $having_clause )
    	{
    		$this->cur_query .= ' HAVING ' . $having_clause;
    	}
	}

    /**
	* Build group by clause
	*
	* @access	protected
	* @param	string		Group by clause
	* @return	void
	*/

	protected function _buildGroupBy( $group )
	{
    	if ( $group )
    	{
    		if ( is_array( $this->_get ) )
    		{
	    		foreach( $this->_get as $g )
	    		{
	    			foreach( explode( ',', $g ) as $field )
	    			{
	    				$field = trim( $field );
	
	    				if ( ! $field OR strstr( $field, '*' ) OR strstr( $field, '(' ) OR stristr( $field, 'case ' ) )
	    				{
	    					continue;
	    				}
	
	    				if ( stristr( $field, ' as' ) )
	    				{
	    					$field = trim( preg_replace( '/^(.+?)\s+?AS.*$/i', '\\1', $field ) );
	    				}
	
	    				if ( strstr( $group, $field ) )
	    				{
	    					continue;
	    				}
	
	    				if ( $field )
	    				{
	    					$group .= ','.$field;
	    				}
	    			}
	    		}
			}
			
			$this->_get = '';
			
    		$this->cur_query .= ' GROUP BY ' . $group;
    	}
    }

    /**
	* Build limit clause
	*
	* @access	protected
	* @param	integer		Start offset
	* @param	integer		[Optional] Number of records
	* @return	void
	*/

	protected function _buildLimit( $offset, $limit=0 )
	{
		//-----------------------------------------
		// INIT
		//-----------------------------------------

		$offset = intval( $offset );
		$offset = ( $offset < 0 ) ? 0 : $offset;
		$limit  = intval( $limit );

    	if ( $limit )
    	{
    		$this->cur_query = preg_replace ("/^SELECT /i", "SELECT TOP ".($offset+$limit)." ", $this->cur_query);
			$this->cur_startrow = $offset;
    	}
    	else
    	{
 	  		$this->cur_query = preg_replace ("/^SELECT /i", "SELECT TOP ".$offset." ", $this->cur_query);
			$this->cur_startrow = 0;
     	}
	}

    /**
	* Build concat string
	*
	* @access	public
	* @param	array		Array of data to concat
	* @return	string		SQL-formatted concat string
	*/

	public function buildConcat( $data )
	{
		$return_string = '';

		if( is_array($data) AND count($data) )
		{
			$concat = array();

			foreach( $data as $databit )
			{
				$concat[] = $databit[1] == 'string' ? "'" . $databit[0] . "'" : 'CAST( '.$databit[0].' AS VARCHAR )';
			}

			if( count($concat) )
			{
				$return_string = implode( '+', $concat );
			}
		}
		return $return_string;
	}

    /**
	 * Build CAST string
	 *
	 * @param	string		Value to CAST
	 * @return	string		Column type to cast as (only UNSIGNED supported at this time!!)
	 */
	public function buildCast( $data, $columnType )
	{
		$columnType	= str_ireplace( "unsigned", "BIGINT", $columnType );

		return "CAST( {$data} AS {$columnType} )";
	}

    /**
	 * Build between statement
	 *
	 * @access	public
	 * @param	string		Column
	 * @param	integer		Value 1
	 * @param	integer		Value 2
	 * @return	string		SQL-formatted between statement
	 */
	public function buildBetween( $column, $value1, $value2 )
	{
		return "{$column} BETWEEN {$value1} AND {$value2}";
	}

    /**
	* Build regexp string (ONLY supports a regexp equivalent of "or field like value")
	*
	* @access	public
	* @param	string		Database column
	* @param	array		Array of values to allow
	* @return	string		SQL-formatted concat string
	*/
	public function buildRegexp( $column, $data )
	{
		return "(" . $this->buildLikeChain( $column, $data ) . ")";
	}

	/**
	 * Build LIKE CHAIN string (ONLY supports a regexp equivalent of "or field like value")
	 *
	 * @access	public
	 * @param	string		Database column
	 * @param	array		Array of values to allow
	 * @return	string		SQL-formatted concat string
	 */
	public function buildLikeChain( $column, $data )
	{
		$return = $column . " LIKE '*'";

		if ( is_array( $data ) )
		{
			foreach( $data as $id )
			{
				$return .= " OR ',' + " . $column . " + ',' LIKE '%," . $id . ",%'";
			}
		}

		return $return;
	}

    /**
	* Build instr string
	*
	* @access	public
	* @param	string		String to look for
	* @param	string		String to look in
	* @return	string		SQL-formatted instr string
	*/

	public function buildInstring( $look_for, $look_in )
	{
		if( $look_for AND $look_in )
		{
			return "CHARINDEX( " . $look_in . ", '" . $look_for . "' )";
		}
		else
		{
			return '';
		}
	}

    /**
	* Build substr string
	*
	* @access	public
	* @param	string		String of characters/Column
	* @param	integer		Offset
	* @param	integer		[Optional] Number of chars
	* @return	string		SQL-formatted substr string
	*/

	public function buildSubstring( $look_for, $offset, $length=0 )
	{
		$return = '';

		if( $look_for AND $offset )
		{
			$return = "SUBSTRING(" . $look_for . ", " . $offset;

			if( $length )
			{
				$return .= ", " . $length;
			}
			else
			{
				$return .= ", " . $this->buildLength( $look_for ) . ")";
			}

			$return .= ")";
		}

		return $return;
	}

    /**
	* Build distinct string
	*
	* @access	public
	* @param	string		Column name
	* @return	string		SQL-formatted distinct string
	*/

	public function buildDistinct( $column )
	{
		return "DISTINCT(" . $column . ")";
	}

    /**
	* Build length string
	*
	* @access	public
	* @param	string		Column name
	* @return	string		SQL-formatted length string
	*/

	public function buildLength( $column )
	{
		return "DATALENGTH(" . $column . ")";
	}

    /**
	* Build right string
	*
	* @access	public
	* @param	string		Column name
	* @param	integer		Number of chars
	* @return	string		SQL-formatted right string
	*/

	public function buildRight( $column, $chars )
	{
		return "RIGHT(" . $column . "," . intval($chars) . ")";
	}

    /**
	* Build left string
	*
	* @access	public
	* @param	string		Column name
	* @param	integer		Number of chars
	* @return	string		SQL-formatted left string
	*/

	public function buildLeft( $column, $chars )
	{
		return "LEFT(" . $column . "," . intval($chars) . ")";
	}
	
	/**
	 * Build lower string - not needed in MSSQL
	 *
	 * @access	public
	 * @param	string		Column name
	 * @return	string		SQL-formatted length string
	 */
	public function buildLower( $column )
	{
		return $column;
	}
	
    /**
	* Build "is null" and "is not null" string
	*
	* @access	public
	* @param	boolean		is null flag
	* @return	string		[Optional] SQL-formatted "is null" or "is not null" string
	*/

	public function buildIsNull( $is_null=true )
	{
		return $is_null ? " IS NULL " : " IS NOT NULL ";
	}

    /**
	* Build from_unixtime string
	*
	* @access	public
	* @param	string		Column name
	* @param	string		[Optional] Format
	* @return	string		SQL-formatted from_unixtime string
	*/

	public function buildFromUnixtime( $column, $format=NULL )
	{
		$unixtime = "DATEADD(s, {$column}, '01-01-1970')";

		if ( $format != NULL )
		{
			return $this->buildDateFormat( $unixtime, $format );
		}
		return sprintf( "\n\n(CAST(DATEPART(yyyy, ".$unixtime.") AS VARCHAR)\n + CHAR(45) + \nCAST(DATEPART(mm, ".$unixtime.") AS VARCHAR)\n + CHAR(45) + \nCAST(DATEPART(dd, ".$unixtime.")  AS VARCHAR)\n + CHAR(32) + \nCAST(DATEPART(hh, ".$unixtime.") AS VARCHAR)\n + CHAR(58) + \nCAST(DATEPART(mi, ".$unixtime.") AS VARCHAR)\n + CHAR(58) + \nCAST(DATEPART(ss, ".$unixtime.") AS VARCHAR\n) )\n\n", $column );

		//return sprintf( "\n\n(CAST(DATEPART(yyyy, ".$unixtime.") AS VARCHAR)\n + CHAR(45) + \nCAST(DATEPART(mm, ".$unixtime.") AS VARCHAR)\n + CHAR(45) + \nCAST(DATEPART(dd, ".$unixtime.")  AS VARCHAR)\n + CHAR(32) + \nCAST(DATEPART(hh, ".$unixtime.") AS VARCHAR)\n + CHAR(58) + \nCAST(DATEPART(mi, ".$unixtime.") AS VARCHAR)\n + CHAR(58) + \nCAST(DATEPART(ss, ".$unixtime.") AS VARCHAR\n) as %s)\n\n", $column );
	}

    /**
	 * Build fulltext search string
	 *
	 * @param	string		Column to search against
	 * @param	string		String to search
	 * @param	boolean		Search in boolean mode
	 * @param	boolean		Return a "as ranking" statement from the build
	 * @param	boolean		Use fulltext search
	 * @return	string		Fulltext search statement
	 */
	public function buildSearchStatement( $column, $keyword, $booleanMode=true, $returnRanking=false, $useFulltext=true )
	{
		if ( $useFulltext )
		{
			$_function = 'CONTAINS';
			$keyword   = trim( $keyword );
			
			if ( strstr( $keyword, ' ' ) AND substr( $keyword, 0, 1 ) != '"' )
			{
				$_function = 'FREETEXT';
			}
			
			return $_function . "( {$column}, '{$keyword}' )" . ( $returnRanking === TRUE ? ' as ranking' : '' );
		}
		else
		{
			return $column . ' LIKE \'%' . str_replace( array( '"', "'" ), '', $keyword ) . '%\'';
		}
	}

    /**
	* Build date_format string
	*
	* @access	public
	* @param	string		Date string
	* @param	string		Format
	* @return	string		SQL-formatted date_format string
	*/

	public function buildDateFormat( $column, $format )
	{
		$_f = $format;
		
		//$format = "'{$format}'"
		// Converted to http://msdn.microsoft.com/en-us/library/ms174420.aspx from http://dev.mysql.com/doc/refman/5.0/en/date-and-time-functions.html#function_date-format
		$specifiers = array( '%c' => "DATEPART(mm, {$column})",
							 '%d' => "DATEPART(dd, {$column})",
							 '%e' => "DATEPART(d, {$column})",
							 '%H' => "DATEPART(hh, {$column})",
							 '%I' => "DATEPART(hh, {$column})",
							 '%i' => "DATEPART(mi, {$column})",
							 '%j' => "DATEPART(dy, {$column})",
							 '%k' => "DATEPART(hh, {$column})",
							 '%l' => "DATEPART(hh, {$column})",
							 '%m' => "DATEPART(mm, {$column})",
							 '%S' => "DATEPART(ss, {$column})",
							 '%s' => "DATEPART(s, {$column}))",
							 '%w' => "(DATEPART(dw, {$column}) - 1)",
							 '%V' => "DATEPART(wk, {$column})",
							 '%v' => "DATEPART(wk, {$column})",
                             '%Y' => "DATEPART(yyyy, {$column})",
							 '%y' => "DATEPART(yy, {$column})" );

		foreach ( $specifiers as $specifier => $replace )
		{
			$startPosition = strpos( $_f, $specifier );

			if ( $startPosition !== FALSE )
			{
				// Found the specifier

				if ( strlen($specifier) == strlen($_f) )
				{
					// Do a straight replace
					$format = str_replace( $specifier, "\nCAST({$replace} AS VARCHAR)", $format );
				}
				elseif ( $startPosition == 0 )
				{
					// Replace, pad end
					$format = str_replace( $specifier, "\nCAST({$replace} AS VARCHAR)+", $format );
				}
				elseif ( $startPosition + strlen($specifier) == strlen($_f) )
				{
					// Replace, pad front
					$format = str_replace( $specifier, "\n+CAST({$replace} AS VARCHAR)", $format );
				}
				else
				{
					// Middle of format, pad both ends of replacement
					$format = str_replace( $specifier, "\n+CAST({$replace} AS VARCHAR)+", $format );
				}
			}
		}
		// Check for multiple + signs in a row
		return preg_replace( '#\+{2,}#', '+', preg_replace( "#\+\s+?\+#", " + ", $format ) );
	}
	
	/**
	 * Build rand() string
	 *
	 * @access	public
	 * @return	string		SQL-formatted random order string
	 */
	public function buildRandomOrder()
	{
		return "NEWID()";
	}

	/**
	 * Builds a call to MD5 equivalent
	 *
	 * @access public
	 * @return string		SQL-formatted MD5 function call string
	 */
	public function buildMd5Statement( $statement )
	{
		return "SUBSTRING( master.dbo.fn_varbintohexstr( HashBytes( 'MD5', " . $statement . " ) ), 3, 32)";
	}

	/**
	* Build calc rows
	* This is always called before the limit is applied
	*
	* @access	public
	*/
	protected function _buildCalcRows()
	{
		/* For other engines */
		if ( $this->cur_query )
		{
			$_query = preg_replace( "#SELECT\s{1,}(.+?)\s{1,}FROM\s{1,}#i", "", $this->cur_query );
			$_query = preg_replace( "#(ORDER BY.*)$#is", '', $_query );
			$_query = 'SELECT COUNT(*) as count FROM '.$_query;
			$this->query( $_query );
			$count = $this->fetch();

			$this->_calcRows = intval( $count['count'] );
		}
	}

    /**
	* Build select statement
	*
	* @access	protected
	* @param	string		Columns to retrieve
	* @param	string		Table name
	* @param	string		[Optional] Where clause
	* @param	array 		[Optional] Joined table data
	* @return	void
	*/

	protected function _buildSelect( $get, $table, $where, $add_join=array(), $calcRows=FALSE )
	{
		$this->_get = '';
		if( !count($add_join) )
		{
			if( is_array( $table ) )
			{
				$_tables	= array();

				foreach( $table as $tbl => $alias )
				{
					$_tables[] = $this->obj['sql_tbl_prefix'] . $tbl . ' ' . $alias;
				}

				$table	= implode( ', ', $_tables );
			}
			else
			{
				$table	= $this->obj['sql_tbl_prefix'] . $table;
			}

	    	$this->cur_query = "SELECT {$get} FROM " . $table;

	    	if ( $where != '' )
	    	{
	    		/* Attempt to fix != '' issues on text and vchar fields */
				if ( preg_match( "#!=\s?(?:''|\"\")#", $where ) )
				{
					$where = preg_replace( "#(\s|\.)(\S+?)\s?!=\s?(''|\"\")#", "\\1\\2 NOT LIKE \\3", $where );
					//$where = preg_replace( "#(\s|\.)(\S+?)\s?!=\s?(''|\"\")#", "DATALENGTH(\\1\\2) > 0", $where );
				}

	    		$this->cur_query .= " WHERE " . $where;
	    	}

	    	return;
    	}
    	else
		{
	    	//-----------------------------------------
	    	// OK, here we go...
	    	//-----------------------------------------

	    	$select_array   = array();
	    	$from_array     = array();
	    	$joinleft_array = array();
	    	$where_array    = array();
	    	$final_from     = array();

	    	$select_array[] = $get;
	    	$from_array[]   = $table;

	    	if ( $where )
	    	{
	    		$where_array[]  = $where;
	    	}

	    	//-----------------------------------------
	    	// Loop through JOINs and sort info
	    	//-----------------------------------------

	    	if ( is_array( $add_join ) and count( $add_join ) )
	    	{
	    		foreach( $add_join as $join )
	    		{
	    			# Push join's select to stack
	    			if ( isset($join['select']) AND $join['select'] )
	    			{
	    				$select_array[] = $join['select'];
	    			}

	    			if ( $join['type'] == 'inner' )
	    			{
	    				# Join is inline
	    				$from_array[]  = $join['from'];

	    				if ( $join['where'] )
	    				{
	    					$where_array[] = $join['where'];
	    				}
	    			}
	    			else if ( $join['type'] == 'left' OR !$join['type'] )
	    			{
	    				# Join is left or not specified (assume left)
	    				$tmp = " LEFT JOIN ";

	    				foreach( $join['from'] as $tbl => $alias )
						{
							$tmp .= $this->obj['sql_tbl_prefix'].$tbl.' '.$alias;
						}

	    				if ( $join['where'] )
	    				{
	    					$tmp .= " ON ( ".$join['where']." ) ";
	    				}

	    				$joinleft_array[] = $tmp;

	    				unset( $tmp );
	    			}
	    			else
	    			{
	    				# Not using any other type of join
	    			}
	    		}
	    	}

	    	//-----------------------------------------
	    	// Build it..
	    	//-----------------------------------------

	    	foreach( $from_array as $i )
			{
				foreach( $i as $tbl => $alias )
				{
					$final_from[] = $this->obj['sql_tbl_prefix'] . $tbl . ' ' . $alias;
				}
			}

	    	$get   = implode( ","     , $select_array   );
	    	$table = implode( ","     , $final_from     );
	    	$where = implode( " AND " , $where_array    );
	    	$join  = implode( "\n"    , $joinleft_array );
	    	
			$this->_get = $select_array;
			
	    	$this->cur_query .= "SELECT {$get} FROM {$table}";

	    	if ( $join )
	    	{
	    		$this->cur_query .= " " . $join . " ";
	    	}

	    	if ( $where != "" )
	    	{
	    		/* Attempt to fix != '' issues on text and vchar fields */
				if ( preg_match( "#!=\s?(?:''|\"\")#", $where ) )
				{
					$where = preg_replace( "#(\s|\.)(\S+?)\s?!=\s?(''|\"\")#", "\\1\\2 NOT LIKE \\3", $where );
				}

	    		$this->cur_query .= " WHERE " . $where;
	    	}
		}
	}

	/*-------------------------------------------------------------------------*/
	// Error handling and logging
	/*-------------------------------------------------------------------------*/

    /**
	* Get SQL error number
	*
	* @access	protected
	* @return	mixed		Error number/code
	*/

	protected function _getErrorNumber()
	{
		if ( $this->connection_id )
		{
			return $this->engine->error_code( $this->connection_id );
		}
		else
		{
			return "--";
		}
	}

    /**
	* Get SQL error message
	*
	* @access	protected
	* @return	string		Error message
	*/

	protected function _getErrorString()
	{
		if ( $this->connection_id )
		{
			return $this->engine->error_string( $this->connection_id );
		}
		else
		{
			return $this->engine->connection_error;
		}
	}

	/*-------------------------------------------------------------------------*/
	// Quick query calls
	/*-------------------------------------------------------------------------*/

    /**
	 * Delete data from a table
	 *
	 * @access	public
	 * @param	string 		Table name
	 * @param	string 		[Optional] Where clause
	 * @param	string		[Optional] Order by
	 * @param	array		[Optional] Limit clause
	 * @param	boolean		[Optional] Run on shutdown
	 * @return	resource	Query id
	 */
	public function delete( $table, $where='', $orderBy='', $limit=array(), $shutdown=false )
	{
	    if ( ! $where )
	    {
		    $this->cur_query = "TRUNCATE TABLE " . $this->obj['sql_tbl_prefix'] . $table;
	    }
	    else
	    {
    		$this->cur_query = "DELETE FROM " . $this->obj['sql_tbl_prefix'] . $table . " WHERE " . $where;
		}

		if ( $where AND $orderBy )
		{
			$this->_buildOrderBy( $orderBy );
		}

		if ( $where AND $limit AND is_array( $limit ) )
		{
			$this->_buildLimit( $limit[0], $limit[1] );
		}

		$result	= $this->_determineShutdownAndRun( $this->cur_query, $shutdown );

		$this->cur_query	= '';

		return $result;
	}

    /**
	* Update data in a table
	*
	* @access	public
	* @param	string 		Table name
	* @param	mixed 		Array of field => values, or pre-formatted "SET" clause
	* @param	string 		[Optional] Where clause
	* @param	boolean		[Optional] Run on shutdown
	* @param	boolean		[Optional] $set is already pre-formatted
	* @return	resource	Query id
	*/

	public function update( $table, $set, $where='', $shutdown=false, $preformatted=false )
    {
    	//-----------------------------------------
    	// Form query
    	//-----------------------------------------

    	$dba   = $preformatted ? $set : $this->compileUpdateString( $set );

    	$query = "UPDATE " . $this->obj['sql_tbl_prefix'] . $table . " SET " . $dba;

    	if ( $where )
    	{
    		$query .= " WHERE " . $where;
    	}

    	return $this->_determineShutdownAndRun( $query, $shutdown );
    }

    /**
	* Insert data into a table
	*
	* @access	public
	* @param	string 		Table name
	* @param	array 		Array of field => values
	* @param	boolean		Run on shutdown
	* @return	resource	Query id
	*/

	public function insert( $table, $set, $shutdown=false )
	{
    	//-----------------------------------------
    	// Form query
    	//-----------------------------------------

    	$dba   = $this->compileInsertString( $set );

		$query = "INSERT INTO " . $this->obj['sql_tbl_prefix'] . $table . " ({$dba['FIELD_NAMES']}) VALUES({$dba['FIELD_VALUES']})";

		return $this->_determineShutdownAndRun( $query, $shutdown );
    }

    /**
	 * Insert record into table if not present, otherwise update existing record
	 *
	 * @access	public
	 * @param	string 		Table name
	 * @param	array 		Array of field => values
	 * @param	array 		Array of fields to check
	 * @param	boolean		[Optional] Run on shutdown
	 * @return	resource	Query id
	 */
	public function replace( $table, $set, $where, $shutdown=false )
	{
    	//-----------------------------------------
    	// Form query
    	//-----------------------------------------

		$set2 = array();
		
		foreach( $set as $field => $value )
		{
			if ( in_array( $field,  $where ) )
			{
				$sel[] = $field." = '".$this->addSlashes($value)."'";
			}
			else
			{
				$set2[$field] = $value;
			}
		}
		
		$wherestmt = implode( " AND ", $sel );
		$keyfields = implode( ", ", $where );

		$dbi = $this->compileInsertString( $set );
		$dba = $this->compileUpdateString( $set2 );
		
		$this->allow_sub_select = 1;
		
    	$query = 'IF EXISTS ( SELECT ' . $keyfields  .' FROM ' . $this->obj['sql_tbl_prefix'] . $table . ' WHERE ' . $wherestmt . ' )
	UPDATE ' . $this->obj['sql_tbl_prefix'] . $table . ' SET ' . $dba . ' WHERE ' . $wherestmt . '
ELSE
	INSERT INTO ' . $this->obj['sql_tbl_prefix'] . $table . ' (' . $dbi['FIELD_NAMES'] . ') VALUES(' . $dbi['FIELD_VALUES'] . ')';

    	return $this->_determineShutdownAndRun( $query, $shutdown );
    }

    /**
	 * Kill a thread
	 *
	 * @param	integer 	Thread ID
	 * @return	resource	Query id
	 */
	public function kill( $threadId )
	{
	    return $this->query( "KILL {$threadId}" );
	}

	/*-------------------------------------------------------------------------*/
	// Database testing and management
	/*-------------------------------------------------------------------------*/

    /**
	* Subqueries supported by driver?
	*
	* @access	public
	* @return	boolean		Subqueries supported
	*/

	public function checkSubquerySupport()
	{
		return TRUE;
	}

    /**
	* Fulltext searching supported by driver?
	*
	* @access	public
	* @return	boolean		Fulltext supported
	*/

	public function checkFulltextSupport()
	{
		return $this->checkBooleanFulltextSupport();
	}

    /**
	* Boolean fulltext searching supported by driver?
	*
	* @access	public
	* @return	boolean		Boolean fulltext supported
	*/

	public function checkBooleanFulltextSupport()
	{
		if ( ! $qid = $this->engine->query( "SELECT fulltextserviceproperty('IsFulltextInstalled') as ft", $this->connection_id ) )
		{
			$this->throwFatalError("MSSQL query error: Failed to get fulltext property");
		}
		$result = $this->engine->fetch( $qid );
		$mssql_fulltext = $result['ft'];

		if ( $mssql_fulltext )
		{
		    return TRUE;
		}
		else
		{
		    return FALSE;
		}
	}

    /**
	* Test to see whether a field exists in a table
	*
	* @access	public
	* @param	string		Field name
	* @param	string		Table name
	* @return	boolean		Field exists or not
	*/

	public function checkForField( $field, $table )
	{
		$table = $this->obj['sql_tbl_prefix'] . $table;
		
	    if( array_key_exists( $table, $this->cached_fields ) )
	    {
		    if( in_array( $field, $this->cached_fields[ $table ] ) )
		    {
			    return true;
		    }
		    else
		    {
			    return false;
		    }
	    }

		$qid = $this->engine->query( "SELECT b.name FROM sysobjects a INNER JOIN syscolumns b ON a.id=b.id WHERE a.xtype='U' AND a.name= '" . $table . "' ORDER BY colid", $this->connection_id );
		if ( $qid )
		{
			while ( $fields = $this->fetch( $qid ) )
			{
				$this->cached_fields[ $table ][] = $fields['name'];
			}
			$this->engine->freeResult( $qid );

			if ( isset($this->cached_fields[ $table ]) && in_array( $field, $this->cached_fields[ $table ] ) )
			{
				return TRUE;
			}
		}

		return FALSE;
	}

    /**
	* Test to see whether a table exists
	*
	* @access	public
	* @param	string		Table name
	* @return	boolean		Table exists or not
	*/

	public function checkForTable( $table )
	{
        // hurray for sp_tables.
		$qid = $this->engine->query ( "EXEC sp_tables '" . $this->obj['sql_tbl_prefix'] . $table ."'", $this->connection_id );
		
		if ( $qid && $result = $this->engine->fetch( $qid ) )
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	/**
	* Rename database table
	*
	* @access	public
	* @param	string		Original Table Name
	* @param	string		New Table name
	* @return	resource	Query id
	*/

	public function renameTable( $table, $renameTo )
	{
    	$this->allow_sub_select = 1;
		return $this->query( "IF (SELECT name FROM sysobjects WHERE xtype='U' AND name='" . $this->obj['sql_tbl_prefix'] . $table . "') IS NOT NULL
		  BEGIN
			  EXEC sp_rename '" . $this->obj['sql_tbl_prefix'] . $table . "', '" . $this->obj['sql_tbl_prefix'] . $renameTo . "'
		  END");
	}
	
    /**
	* Drop database table
	*
	* @access	public
	* @param	string		Table to drop
	* @return	resource	Query id
	*/

	public function dropTable( $table )
	{
    	$this->allow_sub_select = 1;
		return $this->query( "IF (SELECT name FROM sysobjects WHERE xtype='U' AND name='" . $this->obj['sql_tbl_prefix'] . $table . "') IS NOT NULL
  BEGIN
	  DROP TABLE " . $this->obj['sql_tbl_prefix'] . $table . '
  END');
	}

    /**
	* Drop field in database table
	*
	* @access	public
	* @param	string		Table name
	* @param	string		Field to drop
	* @return	resource	Query id
	*/

	public function dropField( $table, $field )
	{	
		/* Already added? */
		if ( isset( $this->_addedFields[ $this->obj['sql_tbl_prefix'] . $table . '----' . $field ] ) )
		{
			unset( $this->_addedFields[ $this->obj['sql_tbl_prefix'] . $table . '----' . $field ] );
		}
		
		if ( $sql = $this->_sql_get_dropdefault_constraint( $table, $field ) )
		{
			$this->query( $sql );
		}
		return $this->query( "ALTER TABLE " . $this->obj['sql_tbl_prefix'] . $table . " DROP COLUMN " . $field );
	}

    /**
	* Add field to table in database
	*
	* @access	public
	* @param	string		Table name
	* @param	string		Field to add
	* @param	string		Field type
	* @param	string		[Optional] Default value
	* @return	resource	Query id
	*/

	public function addField( $table, $field, $type, $default=NULL, $identity=false )
	{
		/* Already added? */
		if ( isset( $this->_addedFields[ $this->obj['sql_tbl_prefix'] . $table . '----' . $field ] ) )
		{
			return TRUE;
		}
		
		$_extra = 'NULL';
		
		if ( strtolower( substr( trim($type), 0, 3 ) ) == 'int' )
		{
			$type = 'int';
		}
	
		if ( $default != NULL && !$identity )
		{
			$default = ( stristr( $default, 'int' ) ) ? intval( $default ) : $default;
			$_extra  = "NOT NULL DEFAULT ({$default})";
		}
		
		if ( $identity )
		{
			$_extra = "NOT NULL IDENTITY (1,1)";
		}
		
		/* Store locally */
		$this->_addedFields[ $this->obj['sql_tbl_prefix'] . $table . '----' . $field ] = 1;
		
		return $this->query( "ALTER TABLE " . $this->obj['sql_tbl_prefix'] . $table . " ADD {$field} {$type} {$_extra}" );
	}

    /**
	* Change field in database table
	*
	* @access	public
	* @param	string		Table name
	* @param	string		Existing field name
	* @param	string		New field name
	* @param	string		Field type
	* @param	string		[Optional] Default value
	* @return	resource	Query id
	*/

	public function changeField( $table, $org_field, $new_field, $type='', $default=NULL )
	{
		/* Already added? */
		if ( isset( $this->_addedFields[ $this->obj['sql_tbl_prefix'] . $table . '----' . $org_field ] ) )
		{
			unset( $this->_addedFields[ $this->obj['sql_tbl_prefix'] . $table . '----' . $org_field ] );
			
			$this->_addedFields[ $this->obj['sql_tbl_prefix'] . $table . '----' . $new_field ] = 1;
		}
		
		if ( substr( trim($type), 0, 3 ) == 'int' ) $type = 'int';

		if ( $sql = $this->_sql_get_dropdefault_constraint( $table, $org_field ) ) {
			$this->query( $sql );
		}
		
		if ( $org_field != $new_field )
		{
			$this->query( "EXEC SP_RENAME '".$this->obj['sql_tbl_prefix']."{$table}.[{$org_field}]', '{$new_field}', 'COLUMN'" );
			
			if ( $type )
			{
				$this->query( "ALTER TABLE ".$this->obj['sql_tbl_prefix']."{$table} ALTER COLUMN $new_field $type" );
			}
			
			if ( $default != NULL )
			{
				$this->query( "ALTER TABLE ".$this->obj['sql_tbl_prefix']."{$table} ADD DEFAULT {$default} FOR {$new_field} WITH VALUES" );
			}
		}
		else
		{
			$this->query( "ALTER TABLE ".$this->obj['sql_tbl_prefix']."{$table} ALTER COLUMN $org_field $type NULL" );
			
			if ( $default != NULL)
			{
				$this->query( "ALTER TABLE ".$this->obj['sql_tbl_prefix']."{$table} ADD DEFAULT {$default} FOR {$org_field} WITH VALUES" );
			}
		}
	}

    /**
	* Optimize database table
	*
	* @access	public
	* @param	string		Table name
	* @return	resource	Query id
	*/
	public function optimize( $table )
	{
		return TRUE;
	}
	
	/**
	* Add index to database column
	*
	* @access	public
	* @param	string		Table name		table
	* @param	string		Index name		multicol
	* @param	string		Fieldlist		col1, col2
	* @param	bool		Is primary key?
	* @return	resource	Query id
	*/
	public function addIndex( $table, $name, $fieldlist, $isPrimary=false )
	{
		$fieldlist = ( $fieldlist ) ? $fieldlist : $name;
		
		if ( $isPrimary )
		{
			return $this->query( "ALTER TABLE ".$this->obj['sql_tbl_prefix'] . $table . " ADD CONSTRAINT " . $this->obj['sql_tbl_prefix'] . "pk_" . $name . " PRIMARY KEY (" . $fieldlist . ")" );
		}
		else
		{
			return $this->query( "CREATE INDEX " . $name . " ON  ".$this->obj['sql_tbl_prefix'] . $table . ' ( ' . $fieldlist . ' )' );
		}
	}
	
	/**
	* Drop index
	*
	* @access	public
	* @param	string		Table name		table
	* @param	string		Index name		multicol
	* @return	resource	Query id
	*/
	public function dropIndex( $table, $name )
	{
		/* Is this a constraint? */
		if ( $sql = $this->_sql_get_dropdefault_constraint( $table, $name ) )
		{
			$this->query( $sql );
		}
		
		return $this->query( "DROP INDEX ".$this->obj['sql_tbl_prefix'] . $table . '.' . $name );
	}

	
    /**
	* Add fulltext index to database column
	*
	* @access	public
	* @param	string		Table name
	* @param	string		Field name
	* @return	resource	Query id
	*/
	public function addFulltextIndex( $table, $field )
	{
        $this->query( "sp_fulltext_database 'enable'");
		$this->allow_sub_select = 1;
        $this->query( "IF (select FULLTEXTCATALOGPROPERTY (  '".$this->obj['sql_tbl_prefix']."ftcatalog', 'PopulateStatus' )) IS NULL
                       BEGIN
	                       exec sp_fulltext_catalog '".$this->obj['sql_tbl_prefix']."ftcatalog', 'create'
                       END");
		$this->allow_sub_select = 1;
		$this->query( "SELECT name FROM sysobjects
					   WHERE xtype='PK' AND parent_obj=(SELECT id FROM sysobjects where xtype='U' and name='".$this->obj['sql_tbl_prefix']."{$table}')");
		$indexname = $this->fetch();
        $this->query( "sp_fulltext_table '".$this->obj['sql_tbl_prefix']."{$table}', 'Create', 'ibf_ftcatalog', '{$indexname['name']}'");
        $qid = $this->query( "sp_fulltext_column '".$this->obj['sql_tbl_prefix']."{$table}','{$field}','add'");
        $this->query( "sp_fulltext_table '".$this->obj['sql_tbl_prefix']."{$table}','activate'");
        $this->query( "sp_fulltext_table '".$this->obj['sql_tbl_prefix']."{$table}', 'start_change_tracking'");
        $this->query( "sp_fulltext_table '".$this->obj['sql_tbl_prefix']."{$table}', 'start_background_updateindex'");

        return $qid;
	}

	/**
	 * Gets whether the specified table has a fulltext index on it (MSSQL won't let us create two)
	 * 
	 * @access	public
	 * @param	string		$table
	 * @return	bool		Whether fulltext index exists on table
	 */
	public function _checkForFulltextIndex( $table )
	{

		$this->query( "SELECT OBJECTPROPERTYEX( OBJECT_ID( '" . $table . "' ), 'TableFulltextKeyColumn' ) AS HasFulltext" );
		
		$fulltextexists = $this->fetch();

		return ( $fulltextexists['HasFulltext'] == 1 );
	}
	
    /**
	* Drop the default constraint of a field in a table
	*
	* @access	public
	* @param	string		Table name
	* @param	string		Field name
	* @return	string		Query
	*/
	public function _sql_get_dropdefault_constraint( $table, $field )
	{
		$qid = $this->engine->query( " SELECT a.name from sysobjects a, syscolumns b, sysobjects c WHERE a.type='D' AND a.id=b.cdefault AND b.id=c.id AND b.name='" . $field . "' AND c.name='" . $this->obj['sql_tbl_prefix'] . $table . "'", $this->connection_id );
		
		if ( $qid && $constraint = $this->engine->fetch( $qid ) )
		{
			if ( $constraint['name'] )
			{
				return "ALTER TABLE " . $this->obj['sql_tbl_prefix'] . $table . " DROP CONSTRAINT " . $constraint['name'];
			}
		}
		
		return FALSE;
	}

	/**
	* Drop the primary key of a table
	*
	* @access	public
	* @param	string		Table name
	* @return	string		Query
	*/
	public function _sql_get_dropprimary_key( $table )
	{
		$qid = $this->engine->query( "select name from sysobjects where	xtype = 'PK' and parent_obj = (object_id('" .$this->obj['sql_tbl_prefix'] . $table . "'))", $this->connection_id);
		
		if ( $qid && $primarykey = $this->engine->fetch( $qid ) )
		{
			if ( $primarykey['name'] )
			{
				return "ALTER TABLE " . $this->obj['sql_tbl_prefix'] . $table . " DROP CONSTRAINT " . $primarykey['name'];
			}
		}
		
		return FALSE;
	}

    /**
	* Get table schematic
	*
	* @access	public
	* @param	string		Table name
	* @return	array		SQL schematic array
	* @todo		Needs to be completed
	*/
	public function getTableSchematic( $table )
	{
		// Near impossible, at the moment.
		return array();
	}
	
    /**
	 * Get array of field names in table
	 *
	 * @param	string		Table name
	 * @return	array		SQL tables
	 */
	public function getFieldNames( $table )
	{
		//-----------------------------------------
		// Inline field name caching
		//-----------------------------------------
		
		static $_fields		= array();
		
		if( count($_fields[ $table ]) )
		{
			return $_fields[ $table ];
		}

		$current			= $this->return_die;
		$this->return_die 	= true;

		$qid = $this->query( "SELECT name FROM sys.columns WHERE object_id = OBJECT_ID(N'" . $this->obj['sql_tbl_prefix'] . $table . "')" );

		$this->return_die 	= $current;

		if( $qid )
		{
			while( $r = $this->fetch($qid) )
			{
				$_fields[ $table ][]	= $r['name'];
			}

			return $_fields[ $table ];
		}
		else
		{
			return array();
		}
	}

    /**
	* Determine if table already has a fulltext index
	*
	* @access	public
	* @param	string		Table name
	* @return	boolean		Fulltext index exists
	*/

	public function getFulltextStatus( $table )
	{
		if ( $this->checkBooleanFulltextSupport() )
		{
			$qid = $this->engine->query( "SELECT DATABASEPROPERTY('{$this->obj['sql_database']}', 'IsFulltextEnabled') as FullTextEnabled", $this->connection_id );
			if ( $qid && $result = $this->engine->fetch( $qid ) )
			{
				if ($result['FullTextEnabled'])
				{
					$qid2 = $this->engine->query( "EXEC sp_help_fulltext_columns '".$this->obj['sql_tbl_prefix']."{$table}'", $this->connection_id );
					if ( $qid2 && $this->engine->fetch( $qid2 ) )
					{
						return TRUE;
					}
				}
			}
		}
		return FALSE;
	}

    /**
	* Compiles SQL fields for insertion
	*
	* @access	public
	* @param	array		Array of field => value pairs
	* @return	array		FIELD_NAMES (string) FIELD_VALUES (string)
	*/

	public function compileInsertString( $data )
    {
    	$field_names	= "";
		$field_values	= "";

		foreach( $data as $k => $v )
		{
			$add_slashes = 1;

			if ( $this->manual_addslashes )
			{
				$add_slashes = 0;
			}

			if ( isset($this->no_escape_fields[ $k ]) AND $this->no_escape_fields[ $k ] )
			{
				$add_slashes = 0;
			}

			if ( $add_slashes )
			{
				$v = $this->addSlashes( $v );
			}

			$field_names  .= "$k,";

			//-----------------------------------------
			// Forcing data type?
			//-----------------------------------------

			if ( !empty($this->force_data_type[ $k ]) )
			{
				if ( $this->force_data_type[ $k ] == 'string' )
				{
					$field_values .= "'$v',";
				}
				else if ( $this->force_data_type[ $k ] == 'int' )
				{
					$field_values .= intval($v).",";
				}
				else if ( $this->force_data_type[ $k ] == 'float' )
				{
					$field_values .= floatval($v).",";
				}
			}

			//-----------------------------------------
			// No? best guess it is then..
			//-----------------------------------------

			else
			{
				$field_values .= "'$v',";
			}
		}

		$field_names  = rtrim( $field_names, ","  );
		$field_values = rtrim( $field_values, "," );

		return array( 'FIELD_NAMES'  => $field_names,
					  'FIELD_VALUES' => $field_values,
					);
	}

    /**
	* Compiles SQL fields for update query
	*
	* @access	public
	* @param	array		Array of field => value pairs
	* @return	string		SET .... update string
	*/

	public function compileUpdateString( $data )
	{
		$return_string = "";

		foreach( $data as $k => $v )
		{
			//-----------------------------------------
			// Adding slashes?
			//-----------------------------------------

			$add_slashes = 1;

			if ( $this->manual_addslashes )
			{
				$add_slashes = 0;
			}

			if ( isset($this->no_escape_fields[ $k ]) && $this->no_escape_fields[ $k ] )
			{
				$add_slashes = 0;
			}

			if ( $add_slashes )
			{
				$v = $this->addSlashes( $v );
			}

			//-----------------------------------------
			// Forcing data type?
			//-----------------------------------------

			if ( !empty($this->force_data_type[ $k ]) )
			{
				if ( $this->force_data_type[ $k ] == 'string' )
				{
					$return_string .= $k . "='".$v."',";
				}
				else if ( $this->force_data_type[ $k ] == 'int' )
				{
					if ( strstr( $v, 'plus:' ) )
					{
						$return_string .= $k . "=" . $k . '+' . intval( str_replace( 'plus:', '', $v ) ).",";
					}
					else if ( strstr( $v, 'minus:' ) )
					{
						$return_string .= $k . "=" . $k . '-' . intval( str_replace( 'minus:', '', $v ) ).",";
					}
					else
					{
						$return_string .= $k . "=".intval($v).",";
					}
				}
				else if ( $this->force_data_type[ $k ] == 'float' )
				{
					$return_string .= $k . "=".floatval($v).",";
				}
			}

			//-----------------------------------------
			// No? best guess it is then..
			//-----------------------------------------

			else
			{
				$return_string .= $k . "='".$v."',";
			}
		}

		$return_string = rtrim( $return_string, "," );

		return $return_string;
	}

	public function tableIsIdentity( $tableName )
	{
		$queryResult = $this->engine->query( "SELECT OBJECTPROPERTY(OBJECT_ID(TABLE_NAME), 'TableHasIdentity') AS isIdentity FROM information_schema.tables WHERE table_name = '{$this->obj['sql_tbl_prefix']}{$tableName}'", $this->connection_id );
		if( $queryResult && $result = $this->engine->fetch( $queryResult ) )
		{
			if( $result['isIdentity'] == 1)
			{
				return TRUE;
			}
		}
		return FALSE;
	}

	public function setTableIdentityInsert( $tableName, $status='OFF' )
	{
		if( !in_array( $status, array('ON', 'OFF') ) )
		{
			$status = 'OFF';
		}

		// Table doesn't have an identity column, return
		if( $this->tableIsIdentity( $tableName ) !== TRUE )
		{
			return TRUE;
		}

		$queryResult = $this->engine->query( "SET IDENTITY_INSERT {$this->obj['sql_tbl_prefix']}{$tableName} {$status}", $this->connection_id );
		if( $queryResult )
		{
			return TRUE;
		}

		return FALSE;
	}
	
	public function setQueryRowLocking( $status='OFF' )
	{
		if ( !in_array( $status, array( 'ON', 'OFF' ) ) )
		{
			$status = 'OFF';
		}
		
		$queryResult = $this->engine->query( "SET TRANSACTION ISOLATION LEVEL " . ( $status == 'OFF' ? "READ COMMITTED" : "READ UNCOMMITTED" ), $this->connection_id );
		if( $queryResult )
		{
			return TRUE;
		}

		return FALSE;
	}

	/**
	 * Test to see whether an index exists in a table
	 *
	 * @access	public
	 * @param	string		Index name
	 * @param	string		Table name
	 * @return	boolean		Field exists or not
	 */
	public function checkForIndex( $index, $table )
	{
		$queryResult = $this->engine->query( "SELECT COUNT(name) AS indexExists FROM sys.indexes WHERE name = '{$index}' and object_id = OBJECT_ID(N'{$this->obj['sql_tbl_prefix']}{$table}')", $this->connection_id );
		if( $queryResult && $result = $this->engine->fetch( $queryResult ) )
		{
			if( $result['indexExists'] == 1)
			{
				return TRUE;
			}
		}
		return FALSE;
	}

	/**
	 * Reset forced data types
	 * 
	 * @deprecated Not implemented by driver
	 */
	public function resetDataTypes()
	{
		return;	
	}
	
	/**
	 * @param string $t
	 * @deprecated Not implemented by driver.  Returns unmodified text
	 */
	public function removeSlashes( $t )
	{
		return $t;
	}
}

?>