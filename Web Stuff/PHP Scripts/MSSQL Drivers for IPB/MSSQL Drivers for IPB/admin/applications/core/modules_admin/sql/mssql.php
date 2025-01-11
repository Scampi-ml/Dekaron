<?php

/**
 * <pre>
 * Invision Power Services
 * IP.Board v3.1.4
 * mySQL Admin
 * Last Updated: $Date: 2011-01-04 18:03:59 -0500 (Tue, 04 Jan 2011) $
 * </pre>
 *
 * @author 		$Author: bfarber $
 * @copyright	(c) 2001 - 2009 Invision Power Services, Inc.
 * @license		http://www.invisionpower.com/community/board/license.html
 * @package		IP.Board
 * @subpackage	Core
 * @link		http://www.invisionpower.com
 * @version		$Rev: 7523 $
 */

if ( ! defined( 'IN_ACP' ) )
{
	print "<h1>Incorrect access</h1>You cannot access this file directly. If you have recently upgraded, make sure you upgraded 'admin.php'.";
	exit();
}

@set_time_limit(1200);


class admin_core_sql_toolbox_module extends ipsCommand {

	/**
	 * SQL version
	 *
	 * @access	public
	 * @var		string
	 */
	public $sql_version		= "";

	/**
	 * True SQL version
	 *
	 * @access	public
	 * @var		string
	 */
	public $true_version	= "";

	/**
	 * GZIP Header contents for backup
	 *
	 * @access	public
	 * @var		string
	 */
	public $str_gzip_header	= "\x1f\x8b\x08\x00\x00\x00\x00\x00";

	/**
	 * Flag that's set if there's problems
	 *
	 * @access	public
	 * @var		boolean
	 */
	public $db_has_issues	 = false;

	/**
	 * HTML object
	 *
	 * @access	public
	 * @var		object
	 */
	public $html;

	/**
	 * Form code
	 *
	 * @access	public
	 * @var		string
	 */
	public $form_code		= "";

	/**
	 * Form code js
	 *
	 * @access	public
	 * @var		string
	 */
	public $form_code_js	= "";

	/**
	 * Main class entry point
	 *
	 * @access	public
	 * @param	object		ipsRegistry reference
	 * @return	void		[Outputs to screen]
	 */
	public function doExecute( ipsRegistry $registry )
	{
		/* Load HTML and Lang */
		$this->html = $this->registry->output->loadTemplate( 'cp_skin_sql' );
		$this->registry->class_localization->loadLanguageFile( array( 'admin_sql' ) );
		
		/* A bit fugly */
		foreach( $this->lang->words as $k => $v )
		{
			if ( stristr( $v, 'mysql' ) )
			{
				$this->lang->words[ $k ] = str_replace( array( 'MySQL', 'MYSQL', 'mySQL' ), 'MSSQL', $v );
			}
		}
		
		/* URLs */
		$this->form_code	= $this->html->form_code	= 'module=sql&amp;section=toolbox';
		$this->form_code_js	= $this->html->form_code_js	= 'module=sql&section=toolbox';

		/* Get SQL Version */
		$this->DB->getSqlVersion();

		$this->true_version	= $this->html->true_version	= $this->DB->true_version;
   		$this->sql_version	= $this->html->sql_version	= $this->DB->sql_version;

   		/* What to do */
		switch( $this->request['do'] )
		{
			case 'dotool':
				$this->sqlRunTool();
				break;
			case 'runtime':
				$this->registry->output->html = $this->registry->output->global_template->information_box( $this->lang->words['not_supported'], $this->lang->words['not_supported_desc'] );
				break;
			case 'system':
				$this->registry->output->html = $this->registry->output->global_template->information_box( $this->lang->words['not_supported'], $this->lang->words['not_supported_desc'] );
				break;
			case 'processes':
				$this->registry->output->html = $this->registry->output->global_template->information_box( $this->lang->words['not_supported'], $this->lang->words['not_supported_desc'] );
				break;
			case 'runsql':
				$_POST['query'] = isset( $_POST['query'] ) ? $_POST['query'] : '';
				$sqlQuery = $_POST['query'] == "" ? urldecode( $_GET['query'] ) : $_POST['query'];
				$this->sqlViewResults( trim( stripslashes( $sqlQuery ) ) );
				break;
			case 'backup':
				$this->sqlBackupForm();
				break;
			case 'safebackup':
				$this->sqlSafeBackupSplash();
				break;
			case 'dosafebackup':
				$this->sqlDoSafeBackup();
				break;
			case 'export_tbl':
				$this->sqlDoSafeBackup( trim( urldecode( stripslashes( $_GET['tbl'] ) ) ) );
				break;
			default:
				$this->sqlListIndex();
		}

		/* Output */
		$this->registry->output->html_main .= $this->registry->output->global_template->global_frame_wrapper();
		$this->registry->output->sendOutput();
	}

	/**
	 * Run selected tool on selected tables
	 *
	 * @access	public
	 * @return	void
	 */
	public function sqlRunTool()
	{
		/* have we got some there tables me laddo? */
		$tables = array();

 		foreach( $this->request as $key => $value )
 		{
 			if( preg_match( "/^tbl_(\S+)$/", $key, $match ) )
 			{
 				if( $this->request[ $match[0] ] )
 				{
 					$tables[] = $match[1];
 				}
 			}
 		}

 		/* Make sure we have tables to run this on */
 		if( count( $tables ) < 1 )
 		{
 			$this->registry->output->showError( $this->lang->words['my_seltables'], 11145 );
 		}

		/* What tool is one running? */
		if( strtoupper( $this->request['tool'] ) == 'DROP' || strtoupper( $this->request['tool'] ) == 'CREATE' || strtoupper( $this->request['tool'] ) == 'FLUSH' )
		{
			$this->registry->output->showError( $this->lang->words['my_cantdo'], 2114, true );
		}

		/**
		 * Rikki wants a stupid template so we can output his stupid header.  Yes, this creates more work for me.
		 * This template serves no other purpose than to make Rikki happy.  Must make Rikki happy.  Rikki gets cranky when he's not happy.
		 *
		 * Ask him about roundabouts sometime.  Apparently...they're round.
		 */
		$this->registry->output->html .= $this->html->sqlToolResultHeader();

		/* Loop through each table and run the tool */
		foreach( $tables as $table )
		{
			/* Run the query */
			$this->DB->query( strtoupper( $this->request['tool'] ) . " TABLE $table" );

			/* Results */
			$fields = $this->DB->getResultFields();
			$data   = $this->DB->fetch();

			/* Print the headers - we don't what or how many so... */
			$columns = array();
			$cnt     = count( $fields );

			for( $i = 0; $i < $cnt; $i++ )
			{
				$columns[] = $fields[$i]->name;
			}

			/* Grab the rows - we don't what or how many so... */
			$rows = array();

			for( $i = 0; $i < $cnt; $i++ )
			{
				$rows[] = $data[ $fields[$i]->name ];
			}

			/* Add to output */
			$this->registry->output->html .= $this->html->sqlToolResult( "Result: " . $this->request['tool'] . " " . $table, $columns, $rows );
		}
	}

	/**
	 * Safe backup splash screen
	 *
	 * @access	public
	 * @return	void
	 */
	public function sqlSafeBackupSplash()
	{
		/* Output */
		$this->registry->output->extra_nav[] = array( '', $this->lang->words['my_backupnav'] );
		$this->registry->output->html            .= $this->html->sqlSafeBackupSplashScreen();
	}

	/**
	 * Runs the database backup
	 *
	 * @access	public
	 * @param	string	$tbl_name	Specify a table to backup, leave blank to backup all
	 * @return	void
	 */
	public function sqlDoSafeBackup( $tableName=NULL )
	{
		/* Backup All Tables */
		if ( $tableName == NULL )
		{
			$skip        = intval( $this->request['skip'] );
			$createTable  = intval( $this->request['create_tbl'] );
			$enableGzip = intval( $this->request['enable_gzip'] );
			$filename    = 'ipb_db_backup';
		}
		/* Backup specfic table */
		else
		{
			$skip        = 0;
			$createTable  = 0;
			$enableGzip = 1;
			$filename    = $tableName;
		}

		/* Setup */
		$output = "";
		@header("Pragma: no-cache");
		$doGzip = FALSE;

		/* Gzip? */
		if ( $enableGzip )
		{
			$phpVersion = phpversion();

			if ( $phpVersion >= '4.0' )
			{
				if ( extension_loaded('zlib') )
				{
					$doGzip = TRUE;
				}
			}
		}

		if ( $doGzip === TRUE )
		{
			@ob_start();
			@ob_implicit_flush(0);
			header( "Content-Type: text/x-delimtext; name=\"{$filename}.sql.gz\"; charset=" . IPS_DOC_CHAR_SET );
			header( "Content-disposition: attachment; filename={$filename}.sql.gz" );
		}
		else
		{
			header( "Content-Type: text/x-delimtext; name=\"{$filename}.sql\"; charset=" . IPS_DOC_CHAR_SET );
			header( "Content-disposition: attachment; filename={$filename}.sql" );
		}

		/* Get tables to work on */
		if ( $tableName == NULL )
		{
			$tablesData = $this->DB->getTableNames();

			foreach ( $tablesData as $tableName )
			{
				/* Ensure that we're only peeking at IBF tables */
				if ( preg_match( "/^" . $this->settings['sql_tbl_prefix'] . "/", $tableName ) )
				{
					/* We've started our headers, so print as we go to stop  poss memory problems */
					$this->sqlGetTableSQL($tableName, (bool)$createTable, $skip);
				}
			}
		}
		else
		{
			$this->sqlGetTableSQL($tableName, (bool)$createTable, $skip);
		}

		/* Gzip the result */
		if( $doGzip == TRUE )
		{
			$size     = ob_get_length();
			$crc      = crc32( ob_get_contents() );
			$contents = gzcompress( ob_get_contents() );
			ob_end_clean();
			echo $this->str_gzip_header . substr( $contents, 0, strlen( $contents ) - 4 ) . $this->sqlGzipFourChars( $crc ) . $this->sqlGzipFourChars( $size );
		}
		exit;
	}

	/**
	 * Displays the form for backing up an sql database
	 *
	 * @access	public
	 * @return	void
	 * @author	Josh
	 */
	public function sqlBackupForm()
	{
		/* Check mySQL Version */
		if ( $this->sql_version < 3232 )
		{
			$this->registry->output->showError( $this->lang->words['my_tooold'], 11146 );
		}

		/* Form Elements */
		$form = array();

		$form['create_tbl']  = $this->registry->output->formYesNo( 'create_tbl', 1);
		$form['skip']        = $this->registry->output->formYesNo( 'skip', 1);
		$form['enable_gzip'] = $this->registry->output->formYesNo( 'enable_gzip', 0 );

		/* Output */
		$this->registry->output->html           .= $this->html->sqlBackupForm( $form );
	}

	/**
	 * Run a mysql query and display results
	 *
	 * @access	public
	 * @param	string	$sql	The query to run
	 * @return	void
	 */
	public function sqlViewResults( $sql )
	{
		/* INIT */
		$limit			= 50;
		$pages			= "";
		$the_queries	= array();

		/* Title Map */
		$map = array( 'processes' 	=> $this->lang->words['my_processes'],
					  'runtime'   	=> $this->lang->words['my_runtime'],
					  'system'    	=> $this->lang->words['my_sysvar'],
					);

		/* Figure out the title */
		if ( !empty( $map[ $this->request['do'] ] ) )
		{
			$tbl_title = $map[ $this->request['do'] ];
			$man_query = 0;
		}
		else
		{
			$tbl_title = $this->lang->words['my_manual'];
			$man_query = 1;
		}

		/* Turn off error die */
		$this->DB->return_die = 1;

		/* Split up multiple queries */
		$the_queries = array();

		if( strstr( $sql, ";" ) )
		{
			$the_queries = preg_split( "/;[\r\n|\n]+/", $sql, -1, PREG_SPLIT_NO_EMPTY );
		}
		else
		{
			if( $sql )
			{
				$the_queries[] = $sql;
			}
		}

		$columns			= array();
		$rows				= array();
		$queryCntForArray	= 0;

		if( ! count( $the_queries ) )
		{
			$the_queries[ $queryCntForArray ]	= '';
			$columns[ $queryCntForArray ][]		= $this->lang->words['manual_error'];
			$rows[ $queryCntForArray ][]		= array( 'error' => $this->lang->words['manual_noquery'] );
		}
		else
		{
			/* Loop through the queries and run them */
			foreach( $the_queries as $sql )
			{
				/* INIT */
				$links 	= "";
				$sql 	= trim( $sql );

				/* Check the sql */
				$test_sql = str_replace( "\'", "", $sql );
				$apos_count = substr_count( $test_sql, "'" );

				if( $apos_count % 2 != 0 )
				{
					$columns[ $queryCntForArray ][]	= $this->lang->words['manual_error'];
					$rows[ $queryCntForArray ][]	= array( 'error' => $this->lang->words['manual_invalid'] . htmlspecialchars( $sql ) );

					unset( $apos_count, $test_sql );
					continue;
				}

				unset( $apos_count, $test_sql );

				/* Check for drop and flush */
				if ( preg_match( "/^(DROP|FLUSH)/i",$sql ) )
				{
					$columns[ $queryCntForArray ][]	= $this->lang->words['manual_error'];
					$rows[ $queryCntForArray ][]	= array( 'error' => $this->lang->words['manual_notallowed'] );
					continue;
				}
				/* Protect admin_login_logs */
				else if ( preg_match( "/^(?!SELECT)/i", preg_replace( "#\s{1,}#s", "", $sql ) ) and preg_match( "/admin_login_logs/i", preg_replace( "#\s{1,}#s", "", $sql ) ) )
				{
					$columns[ $queryCntForArray ][]	= $this->lang->words['manual_error'];
					$rows[ $queryCntForArray ][]	= array( 'error' => $this->lang->words['manual_loginlogs'] );
					continue;
				}

				/* Setup for query */
				$this->DB->error = "";
				$this->DB->allow_sub_select = 1;

				/* Run the query */
				$this->DB->query( $sql, 1 );

				/* Check for errors... */
				if ( $this->DB->error != "")
				{
					$columns[ $queryCntForArray ][]	= $this->lang->words['manual_error'];
					$rows[ $queryCntForArray ][]	= array( 'error' => htmlspecialchars( $this->DB->error ) );
					continue;
				}

				/* Build display rows */
				$rows[ $queryCntForArray ]		= array();
				$columns[ $queryCntForArray ]	= array();

				if ( preg_match( "/^SELECT/i", $sql ) or preg_match( "/^SHOW/i", $sql ) )
				{
					/* Sort out the pages and stuff, auto limit if need be */
					if ( !preg_match( "/^SHOW/i", $sql ) AND ! preg_match( "/TOP[ 0-9,]+$/i", $sql ) )
					{
						/* Start value */
						$start = $this->request['st'] ? intval( $this->request['st'] ) : 0;

						/* Count the number of rows we got back */
						$rows_returned = $this->DB->getTotalRows();

						/* Paginate the results */
						if( $rows_returned > $limit )
						{
							$links = $this->registry->output->generatePagination( array(
																						'totalItems'        => $rows_returned,
																						'itemsPerPage'      => $limit,
																						'currentStartValue' => $start,
																						'baseUrl'           => "{$this->settings['base_url']}{$this->form_code}&do=runsql&query=" . urlencode( $sql ),
																				)	);

							/* Reformat the query with a LIMIT */
							if( substr( $sql, -1, 1 ) == ";" )
							{
								$sql = substr( $sql, 0, -1 );
							}
							
							$this->DB->cur_startrow = $start;
							
							$sql = preg_replace( '#^SELECT#', "SELECT TOP " . ( $start + $limit ) . " ", $sql );

							/* Re-run with limit */
							$this->DB->query( $sql, 1 );
						}
					}

					/* Create the columns array */
					$fields = $this->DB->getResultFields();
					$cnt    = count( $fields );

					for( $i = 0; $i < $cnt; $i++ )
					{
						$columns[ $queryCntForArray ][] = $fields[$i];
					}

					/* Populate the rows array */
					while( $r = $this->DB->fetch() )
					{
						/* Loop through the results and add to row */
						$row = array();

						for( $i = 0; $i < $cnt; $i++ )
						{
							if( $man_query == 1 )
							{
								if( IPSText::mbstrlen( $r[ $fields[$i] ] ) > 200 AND ! preg_match( "/^SHOW/i", $sql ) )
								{
									$r[ $fields[$i] ] = IPSText::truncate( $r[ $fields[$i] ], 200 ) .'...';
								}
							}

							$row[] = nl2br( htmlspecialchars( wordwrap( $r[ $fields[$i] ] , 50, "\n", 1 ) ) );
						}

						/* Add to output array */
						$rows[ $queryCntForArray ][] = $row;
					}
				}
				else
				{
					$columns[ $queryCntForArray ][]	= '';
					$rows[ $queryCntForArray ][]	= array( $this->lang->words['query_executed_successfully'] );
				}

				$this->DB->freeResult();

				$queryCntForArray++;
			}
		}

		/* Output */
		$this->registry->output->html           .= $this->html->sqlViewResults( $the_queries, $columns, $rows, $links );

	}

	/**
	* admin_core_sql_toolbox_module::sqlListIndex
	*
	* List SQL Toolbox index page. Shows tables
	* and all relevent data.
	*
	* @access	public
	* @return	void
	*/
	public function sqlListIndex()
	{
		/* INIT */
		$totalIndexSize = 0;
		$totalTableSize = 0;

		/* Get a list of tables */
		$tableNames = $this->DB->getTableNames();

		/* Loop through the results */
		$tableRows = array();

		foreach($tableNames as $tableName)
		{
			/* Check to ensure it's a table for this install... */
			if( !preg_match( "/^" . $this->settings['sql_tbl_prefix'] ."/", $tableName ) )
			{
				continue;
			}

			$this->DB->query("sp_spaceused {$tableName}");
			$tableData = $this->DB->fetch();

			$totalIndexSize += $indexSize = preg_replace("/([0-9]+) KB/i", "$1", $tableData['index_size']);
			$totalTableSize += $tableSize = preg_replace("/([0-9]+) KB/i", "$1", $tableData['data']);

			/* Add to output array */
			$tableRows[] = array( 'table'	  => $tableName,
								  'rows'	  => $tableData['rows'],
								  'query'	  => urlencode( "SELECT * FROM {$tableName}" ),
								  'tableSize' => $indexSize,
								  'indexSize' => $tableSize );
		}

		/* Output */
		$this->registry->output->html .= $this->html->sqlListTables( $tableRows, $totalIndexSize, $totalTableSize );
	}

	/**
	 * Internal handler to return content from table
	 *
	 * @access	public
	 * @param	string	Table
	 * @param	boolean	Whether to show create table or not
	 * @param	boolean	Whether to skip non-essential tables
	 * @return	void
	 * @author	Josh
	 */
	public function sqlGetTableSQL( $tableName, $createTable, $skipUnnecessaryTables=FALSE )
	{
		/* Add create table statement? */
		if ( $createTable )
		{
			/* Generate table structure */
			$this->DB->query( "EXEC sp_help {$this->settings['sql_database']}.{$tableName}" );
			$ctable = $this->DB->fetch();

			echo $this->sqlStripTicks( $ctable['Create Table'] ).";\n";
		}

		/* Are we skipping? */
		if ( $skipUnnecessaryTables == TRUE )
		{
			if ( $tableName == $this->settings['sql_tbl_prefix'].'admin_sessions' || $tableName == $this->settings['sql_tbl_prefix'].'sessions' || $tableName == $this->settings['sql_tbl_prefix'].'captcha' )
			{
				return TRUE;
			}
		}

		/* Get the data */
   		$this->DB->build( array( 'select' => '*', 'from' => $tableName ) );
   		$tableDataRes = $this->DB->execute();

		/* Check to make sure rows are in this table, if not return. */
		$totalRowCount = $this->DB->getTotalRows($tableDataRes);

		if ( $totalRowCount < 1 )
		{
			return TRUE;
		}

		/* Get col names */
		$fieldsList = "";
		$fields = $this->DB->getResultFields();

		$fieldsList = implode( ', ', $fields );

		/* Loop through the rows */
		// May need to check and handle table identity columns.
		while ( $row = $this->DB->fetch($tableDataRes) )
		{
			$valuesList = implode( "', '", $row );

			echo "INSERT INTO {$tableName} ($fieldsList) VALUES ( '{$valuesList}' );\n";
		}

		return TRUE;
	}

	/**
	 * Add slashes to single quotes to stop sql breaks
	 *
	 * @access	public
	 * @param	string	$data	String to add slashes too
	 * @return	string
	 */
	public function sqlAddSlashes($data)
	{
		$data = str_replace('\\', '\\\\', $data);
        $data = str_replace('\'', '\\\'', $data);
        $data = str_replace("\r", '\r'  , $data);
        $data = str_replace("\n", '\n'  , $data);

        return $data;
	}

	/**
	 * Gzip
	 *
	 * @access	public
	 * @param	string	$val
	 * @return	string
	 */
    public function sqlGzipFourChars( $val )
	{
		for ($i = 0; $i < 4; $i ++)
		{
			$return .= chr($val % 256);
			$val     = floor($val / 256);
		}

		return $return;
	}
}