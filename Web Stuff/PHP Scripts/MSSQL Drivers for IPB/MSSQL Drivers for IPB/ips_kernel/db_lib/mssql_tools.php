<?php

/**
 * @file		mysql_tools.php 	Provides methods to diagnostic a MSSQL database
 *~TERABYTE_DOC_READY~
 * $Copyright: (c) 2001 - 2011 Invision Power Services, Inc.$
 * $License: http://www.invisionpower.com/company/standards.php#license$
 * $Author: ips_terabyte $
 * @since		Tuesday 1st March 2005 15:40
 * $LastChangedDate: 2010-12-20 10:09:54 -0500 (Mon, 20 Dec 2010) $
 * @version		v3.1.4
 * $Revision: 7456 $
 */

/**
 *
 * @class		db_tools
 * @brief		Provides methods to diagnostic a MSSQL database
 * @note		The file is automatically loaded based on the driver value in conf_global.php
 *
 */
class db_tools
{
	/**
	 * Boolean flag that holds data about missing column/table/index
	 *
	 * @var		$has_issues
	 */
	public $has_issues			= false;

	/**
	 * Diagnose table indexes
	 *
	 * @param	array 	$sql_statements		Array of create table/index statements to check
	 * @param	string 	$issues_to_fix		String of the issue to fix, can be set to 'all' to fix everything
	 * @return	@e array Array of results
	 *
	 * <b>Example Usage:</b>
	 * @code
	 * // Retrieve results
	 * $results = $this->dbIndexDiag( $sql_statements );
	 * // Retrieve results and fix a index
	 * $results = $this->dbIndexDiag( $sql_statements, $issues_to_fix );
	 * // Retrieve results and fix all indexes
	 * $results = $this->dbIndexDiag( $sql_statements, 'all' );
	 * @endcode
	 */
	function dbIndexDiag( $sql_statements, $issues_to_fix='' )
	{
		//-----------------------------------------
		// INIT
		//-----------------------------------------
		$processedTables = array();
		$indexes = array();
		$error_count = 0;

		//-----------------------------------------
		// Do we have SQL statements?
		//-----------------------------------------
		if( is_array($sql_statements) && count($sql_statements) )
		{
			//-----------------------------------------
			// Loop over our statements
			//-----------------------------------------
			foreach( $sql_statements as $definition )
			{

				//-----------------------------------------
				// Handle create table definitions
				//-----------------------------------------
		        if ( preg_match( "#CREATE TABLE\s+?(.+?)\s+?\(#ie", $definition, $matches ) )
		        {
		        	// Found and stored the name of table
		        	$primaryKey;
		        	$primaryFields;
			        $tableName = $matches[1];

			        //-----------------------------------------
			        // Does the table have a primary key?
			        //-----------------------------------------
			        if ( preg_match( "#\s+?PRIMARY\s+?KEY\s+?\((.*?)\)(?:(?:[,\s+?$])?\((.+?)\))?#is", $definition, $fieldMatches ) )
			        {
			        	//-----------------------------------------
			        	// Store any fields matched from the regex as primary keys?
			        	//-----------------------------------------
			        	if ( count($fieldMatches) )
			        	{
			        		$processedTables[$tableName]['primaryKey']	= implode( ",", array_map( 'trim', explode( ",", $fieldMatches[1] ) ) );
	            		}
			        }
			    }

				//-----------------------------------------
				// Handle index definitions
				//-----------------------------------------
		        if ( preg_match( "#CREATE INDEX\s+?(.+?)\s+?ON\s+?(.+?)\s*?\((.+?)\)#ie", $definition, $indexMatches ) )
		        {
				    $tableName = $indexMatches[2];
				    $indexName = $indexMatches[1];
				    $indexColumns = $indexMatches[3];

				    // Add index placeholder if not already set
				    if ( !isset($processedTables[$tableName]['indexes']) )
				    {
				    	$processedTables[$tableName]['indexes'] = array();
					}
	            	$processedTables[$tableName]['indexes'][] = array( $indexName, implode( ",", array_map( 'trim', explode( ",", $indexColumns ) ) ) );
		        }
		    }
	    }

	    // Check that we had any tables to check at all
	    if ( !count($processedTables) )
	    {
		   return false;
		}

		$output = array();

		// Cycle each table to check for inconsistencies
		foreach( $processedTables as $tableName => $data )
		{
			// Remove dummy prefix if still left in the definitions
			$tableName = str_replace( "ibf_", "",$tableName);
			$prefixedTableName = ipsRegistry::$settings['sql_tbl_prefix'].$tableName;

			$output[ $prefixedTableName ]	= array( 'table'  => $prefixedTableName,
													 'status'  => 'ok',
													 'missing' => array() );

			// If the table has a primary key, we need to handle the checking of the key
			if ( isset( $data['primaryKey'] ) )
			{
				$output[ $prefixedTableName ]['index'][] = 'pk__' . $tableName;
				$ok = 0;

				// Fetch the primary key of the active table
				if ( $activeKey = $this->_getPrimaryKey( $tableName ) )
				{
					$ok = 1;
					//-----------------------------------------
					// Handle bad multi column index
					//-----------------------------------------
					if ( $data['primaryKey'] != $activeKey )
					{
						$primaryKeyId = $this->_getPrimaryKeyId( $tableName );

						$ok = 0;
						$output[ $prefixedTableName ]['status'] = 'error';
						//$output[ $prefixedTableName ]['index'][] = $tableName;
						$output[ $prefixedTableName ]['missing'][] = $tableName;
						$output[ $prefixedTableName ]['fixsql'][] = "ALTER TABLE {$prefixedTableName} DROP {$primaryKeyId}; ALTER TABLE {$prefixedTableName} ADD PRIMARY KEY ({$data['primaryKey']});";

						//-----------------------------------------
						// Are we fixing now?
						//-----------------------------------------
						if( preg_replace( '#^' . ipsRegistry::$settings['sql_tbl_prefix'] . '(.+?)#', "\\1", $issues_to_fix ) == $tableName OR $issues_to_fix == 'all' )
						{
							ipsRegistry::DB()->query( "ALTER TABLE {$prefixedTableName} DROP {$primaryKeyId};" );
							ipsRegistry::DB()->dropIndex( $tableName, $tableName, $data['primaryKey'], TRUE );
							$ok	= 1;
						} else {
							$error_count++;
						}
					}
				}
				else
				{
					// No primary key on the table, let us add it.
					$output[ $prefixedTableName ]['status'] = 'error';
					//$output[ $prefixedTableName ]['index'][] = $tableName;
					$output[ $prefixedTableName ]['missing'][] = $tableName;
					$output[ $prefixedTableName ]['fixsql'][] = "ALTER TABLE {$prefixedTableName} ADD PRIMARY KEY ({$data['primaryKey']});";

					//-----------------------------------------
					// Are we fixing now?
					//-----------------------------------------
					if( preg_replace( '#^' . ipsRegistry::$settings['sql_tbl_prefix'] . '(.+?)#', "\\1", $issues_to_fix ) == $tableName OR $issues_to_fix == 'all' )
					{
						ipsRegistry::DB()->addIndex( $tableName, $tableName, $data['primaryKey'], TRUE );
						$ok	= 1;
					} else {
						$error_count++;
					}
				}

				if ( $ok )
				{
					$output[ $prefixedTableName ]['status']	 = 'ok';
					//$output[ $prefixedTableName ]['index'][] = $tableName;
					$output[ $prefixedTableName ]['missing'][] = array();
					$output[ $prefixedTableName ]['fixsql'][] = array();
				}
			}

			if ( isset( $data['indexes'] ) && is_array( $data['indexes'] ) and count( $data['indexes'] ) )
			{
				foreach( $data['indexes'] as $index )
				{
					$indexName = $index[0];
					$indexColumns = $index[1] ? $index[1] : $indexName;
					$ok = 0;

					if ( $activeIndex = $this->_getIndex( $tableName, $indexName ) )
					{
						$ok = 1;

						//-----------------------------------------
						// Multi index column?
						//-----------------------------------------
						if ( $indexColumns != $activeIndex )
						{
							foreach( explode( ',', $indexColumns ) as $mc )
							{
								if ( ! strstr( $activeIndex, $mc ) )
								{
									$output[ $prefixedTableName ]['status'] = 'error';
									$output[ $prefixedTableName ]['index'][] = $indexName;
									$output[ $prefixedTableName ]['missing'][] = $mc;
									$output[ $prefixedTableName ]['fixsql'][] = 'DROP INDEX '.$prefixedTableName.'.'.$indexName.'; CREATE INDEX '.$indexName.' ON '.$prefixedTableName.' ('.$indexColumns.');';

									//-----------------------------------------
									// Are we fixing now?
									//-----------------------------------------
									if( preg_replace( '#^' . ipsRegistry::$settings['sql_tbl_prefix'] . '(.+?)#', "\\1", $issues_to_fix ) == $tableName OR $issues_to_fix == 'all' )
									{
										ipsRegistry::DB()->dropIndex( $tableName, $indexName );
										ipsRegistry::DB()->addIndex( $tableName, $indexName, $indexColumns );

										$ok	= 1;
									} else {
										$ok       = 0;
										$error_count++;
									}
								}
							}
						}
					}
					else
					{
						$output[ $prefixedTableName ]['status']	 = 'error';
						$output[ $prefixedTableName ]['index'][]	 = $indexName;
						$output[ $prefixedTableName ]['missing'][] = $indexName;
						$output[ $prefixedTableName ]['fixsql'][]	 = 'CREATE INDEX '.$indexName.' ON '.$prefixedTableName.' ('.$indexColumns.');';

						//-----------------------------------------
						// Are we fixing now?
						//-----------------------------------------
						if( preg_replace( '#^' . ipsRegistry::$settings['sql_tbl_prefix'] . '(.+?)#', "\\1", $issues_to_fix ) == $tableName OR $issues_to_fix == 'all' )
						{
							ipsRegistry::DB()->addIndex( $tableName, $indexName, $indexColumns );

							$ok	= 1;
						} else {
							$error_count++;
						}
					}

					if ( $ok )
					{
						$output[ $prefixedTableName ]['status']	 = 'ok';
						$output[ $prefixedTableName ]['index'][]	 = $indexName;
						$output[ $prefixedTableName ]['missing'][] = array();
						$output[ $prefixedTableName ]['fixsql'][]	 = array();
					}
				}
			}
		}

		return array( 'error_count'	=> $error_count, 'results' => $output );
	}
	
	/**
	 * Diagnose table structure
	 *
	 * @param	array 	$sql_statements		Array of create table/columns statements to check
	 * @param	string 	$issues_to_fix		String of the issue to fix, can be set to 'all' to fix everything
	 * @return	@e array Array of results
	 *
	 * <b>Example Usage:</b>
	 * @code
	 * // Retrieve results
	 * $results = $this->dbTableDiag( $sql_statements );
	 * // Retrieve results and fix a table/column
	 * $results = $this->dbTableDiag( $sql_statements, $issues_to_fix );
	 * // Retrieve results and fix all tables/columns
	 * $results = $this->dbTableDiag( $sql_statements, 'all' );
	 * @endcode
	 */
	public function dbTableDiag( $sql_statements, $issues_to_fix='' )
	{
		$queries_needed = array();
		$tables_needed = array();
		$error_count = 0;

		if( is_array( $sql_statements ) && count( $sql_statements ) )
		{
			foreach( $sql_statements as $the_table )
			{
				$expected_columns = array();

				if( preg_match("#CREATE TABLE\s+?(.+?)\s+?\(#ie", $the_table, $bits))
				{
					$tableName = $bits[1];
					$tableName = str_replace( "ibf_", "", $tableName );

					$table_defs[$tableName] = str_replace( "ibf_", ipsRegistry::$settings['sql_tbl_prefix'], $the_table );

					// Get the columns and lose the first line (it's the table name)
					$columns_array = explode( "\n", $the_table );
					array_shift($columns_array);

					// Get rid of the end junk
					if ( (strpos(end($columns_array), ");") == 0) ||
						 (strpos(end($columns_array), ")") == 0)  ||
						 (strpos(end($columns_array), ";") == 0) )
					{
						array_pop($columns_array);
					}

					reset($columns_array);

					foreach( $columns_array as $col )
					{
						//-----------------------------------------
						// Find the column name
						//-----------------------------------------

						$temp		= preg_split( "/[\s]+/" , trim($col) );
						$columnName	= $temp[0];

						//-----------------------------------------
						// If this is a real column, map it
						//-----------------------------------------

						if( !in_array( $columnName, array( "PRIMARY", "KEY", "UNIQUE", "", "(", ";", ");" ) ) )
						{
							$expected_columns[]								= $columnName;
							$this->columns_to_defs[ $tableName ][ $columnName ]	= trim( str_replace( ',', ';', $col ) );
						}
					}
				}
				elseif ( preg_match("#ALTER TABLE ([a-z_]*) ADD ([a-z_]*) #is", $the_table, $bits) )
				{
					if( $bits[1] != "" &&
						$bits[2] != "" &&
						$bits[2] != 'INDEX' &&
						strpos($bits[2], 'TYPE') === false )
					{
						$tableName = trim($bits[1]);
						$tableName = str_replace( "ibf_", "", $tableName );
						$col_name = trim($bits[2]);

						$expected_columns[] = $col_name;
						$this->columns_to_defs[$tableName][$col_name] = preg_replace( "#ALTER TABLE ([a-z_]*) ADD ([a-z_]*) #is", '$2 ', $the_table).";";
					}
				}
				else
				{
					continue;
				}

				// Get the current schema....
				if ( ! ipsRegistry::DB()->checkForTable( $tableName ) )
				{
					//-----------------------------------------
					// Are we fixing now?
					//-----------------------------------------
					if ( $issues_to_fix == $tableName OR $issues_to_fix == 'all' )
					{
						ipsRegistry::DB()->query( $table_definitions[ $tableName ] );

						continue;
					}

					$output[ $tableName ]	= array( 'key'		=> $tableName,
													 'table'	=> ipsRegistry::$settings['sql_tbl_prefix'].$tableName,
													 'status'	=> 'error',
													 'message'	=> 'missing table',
													 'fixsql'	=> array( $table_defs[$tableName] )
													);
					$error_count++;
				}
				else
				{
					// Here we go...
					$missing 		= array();

					foreach( $expected_columns as $trymeout )
					{
						if( ! ipsRegistry::DB()->checkForField( $trymeout, $tableName ) )
						{
							$missing[] 		= $trymeout;
							$query_needed 	= "ALTER TABLE " . ipsRegistry::$settings['sql_tbl_prefix'] . $tableName . " ADD " . $this->columns_to_defs[$tableName][$trymeout];

							//-----------------------------------------
							// Are we fixing now?
							//-----------------------------------------
							if ( $issues_to_fix == $tableName OR $issues_to_fix == 'all' )
							{
								ipsRegistry::DB()->query( $query_needed );

								continue;
							}

							$output[ $tableName ]	= array( 'key'		=> $tableName,
															 'table'	=> ipsRegistry::$settings['sql_tbl_prefix'].$tableName,
															 'status'	=> 'error',
															 'message'	=> 'missing column \''.$trymeout.'\'',
															 'fixsql'	=> array( $query_needed )
															);
							$error_count++;
						}
					}
					if( !count( $missing ) )
					{
						$output[ $tableName ]	= array( 'key'		=> $tableName,
														 'table'	=> ipsRegistry::$settings['sql_tbl_prefix'].$tableName,
														 'status'	=> 'ok',
														 'message'	=> '',
														 'fixsql'	=> array()
														);
					}
				}
			}
		}

		return array( 'error_count'	=> $error_count, 'results' => $output );
	}
	
	/**
	 * Get the primary keys of a table
	 *
	 * @param	string 	$tbl			Name of the table
	 * @return	@e string Comma separated string of the primary keys column names
	 *
	 * <b>Example Usage:</b>
	 * @code
	 * $keys = $this->_getPrimaryKey( $tbl );
	 * @endcode
	 */
    private function _getPrimaryKey( $tbl )
    {
        $fields = array();
        
		ipsRegistry::DB()->allow_sub_select = 1;
		
        $qid = ipsRegistry::DB()->query( "SELECT name
        								  FROM   syscolumns
        								  WHERE  id IN ( SELECT id
        								  				 FROM sysobjects
        								  				 WHERE name = '" . ipsRegistry::$settings['sql_tbl_prefix'].$tbl . "') AND colid IN ( SELECT SIK.colid
        								  				 																				      FROM sysindexkeys SIK
        								  				 																				      JOIN sysobjects SO ON SIK.id = SO.id
        								  				 																				      WHERE SIK.indid = 1 AND SO.name='" . ipsRegistry::$settings['sql_tbl_prefix'].$tbl . "' )" );
		
        while ( $row = ipsRegistry::DB()->fetch( $qid ) )
        {
            $fields[] = $row['name'];
        }
        
        return implode( ",", $fields );
    }
	
	/**
	 * Get the primary key of a table from an ID
	 *
	 * @param	string 	$tbl			Name of the table
	 * @return	@e mixed Name of the column with the primary key ID, otherwise FALSE
	 *
	 * <b>Example Usage:</b>
	 * @code
	 * $key = $this->_getPrimaryKeyId( $tbl );
	 * @endcode
	 */
    private function _getPrimaryKeyId( $tbl )
    {
        $fields = array();
        
		ipsRegistry::DB()->allow_sub_select = 1;
		
        $qid = ipsRegistry::DB()->query( "SELECT object_name(parent_obj) ObjectName, name
        								  FROM sysobjects
        								  WHERE xtype = 'PK' AND parent_obj = (object_id('" . ipsRegistry::$settings['sql_tbl_prefix'].$tbl . "'))");
        $row = ipsRegistry::DB()->fetch($qid);
        
        return $row ? $row['name'] : FALSE;
	}
	
	/**
	 * Get column names of an index
	 *
	 * @param	string 	$tbl			Name of the table
	 * @param	string	$index_name		Name of the index to retrieve
	 * @return	@e string Comma separated string of the indexes found
	 *
	 * <b>Example Usage:</b>
	 * @code
	 * $indexes = $this->_getIndex( $tbl, $index_name );
	 * @endcode
	 */
    private function _getIndex( $tbl, $index_name )
    {
        $fields = array();
 		ipsRegistry::DB()->allow_sub_select = 1;
        $qid = ipsRegistry::DB()->query( "SELECT d.name
											FROM       sysobjects a
											INNER JOIN sysindexes b ON a.id=b.id
											INNER JOIN sysindexkeys c ON b.id=c.id AND b.indid=c.indid
											INNER JOIN syscolumns d ON c.id=d.id and c.colid=d.colid
											WHERE a.name='".ipsRegistry::$settings['sql_tbl_prefix']."$tbl' AND a.xtype='U'
											AND b.name not in (SELECT q.name
															   FROM       sysobjects q
															   WHERE q.xtype = 'PK'
															   AND q.parent_obj = (
																					SELECT x.id
																					FROM sysobjects x
																					WHERE x.name='".ipsRegistry::$settings['sql_tbl_prefix']."$tbl' AND x.xtype='U' )
															  )
											AND b.name = '$index_name'
											order by c.indid, c.keyno" );
        while ( $row = ipsRegistry::DB()->fetch( $qid ) )
        {
            $fields[] = $row['name'];
        }

        return implode( ",", $fields );
    }
	
	/**
	 * Remove ticks from statement
	 *
	 * @param	string 	$data		String to clean
	 * @return	@e string String with ticks removed
	 *
	 * <b>Example Usage:</b>
	 * @code
	 * $query = $this->_sqlStripTicks( $data );
	 * @endcode
	 */
	private function _sqlStripTicks( $data )
	{
		return str_replace( "`", "", $data );
	}
}