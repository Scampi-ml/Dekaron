<?php
/**
 * @file		mssql_nexus_queries.php		Cached MSSQL queries for Nexus
 *
 * $Copyright: $
 * $License: $
 * $Author: mark $
 * $LastChangedDate: 2011-01-04 05:16:27 +1300 (Tue, 04 Jan 2011) $
 * $Revision: 7507 $
 * @since 		[since]
 */

/**
 *
 * @class	sql_nexus_queries
 * @brief	Cached MSSQL queries for Nexus
 *
 */
class sql_nexus_queries extends db_driver_mssql
{
     protected $db  = "";
     protected $tbl = "";
     
   	const VIEW_CAT 		= 1;
	const VIEW_FEATURED	= 2;
	const VIEW_POPULAR	= 3;
	const VIEW_IDM		= 4;

    /*========================================================================*/
    // Set up...
    /*========================================================================*/

    function sql_nexus_queries( &$obj )
    {
    	$this->db	= &$obj;
    	$this->tbl	= ips_DBRegistry::getPrefix();
    }

    /*========================================================================*/

    function nexus_get_store_count( $a )
    {
		$groups = array_filter( array_merge( array( $a['member']['member_group_id'] ), explode( ',', $a['member']['mgroup_others'] ) ), create_function( '$v', 'return (bool) $v;' ) );
    	$baseWhere = "p_store=1 AND " . $this->buildWherePermission( $groups, 'p_member_groups' );

    	switch ( $a['type'] )
    	{
    		case self::VIEW_CAT:
				return <<<SQL
SELECT count(*) as count
FROM {$this->tbl}nexus_packages
WHERE {$baseWhere} AND p_group IN( {$a['extra']} )
;
SQL;

			case self::VIEW_FEATURED:
				return <<<SQL
SELECT count(*) as count
FROM {$this->tbl}nexus_packages
WHERE {$baseWhere} AND p_featured=1
;
SQL;
    			
    		case self::VIEW_POPULAR:
				return <<<SQL
SELECT count( DISTINCT( ps.ps_item_id ) ) as count
FROM  {$this->tbl}nexus_packages p
LEFT JOIN {$this->tbl}nexus_purchases ps
	ON ( ps.ps_item_id=p.p_id )
WHERE {$baseWhere} AND ps.ps_app='nexus' AND ps.ps_type='package'
SQL;
    		
    		case self::VIEW_IDM:
				return <<<SQL
SELECT count(*) as count
FROM {$this->tbl}nexus_packages
WHERE {$baseWhere} AND p_id IN( {$a['extra']} )
;
SQL;
    	
    	}
    	
    }
    	
    function nexus_get_store_packages( $a )
    {
    	$groups = array_filter( array_merge( array( $a['member']['member_group_id'] ), explode( ',', $a['member']['mgroup_others'] ) ), create_function( '$v', 'return (bool) $v;' ) );
    	$baseWhere = "p_store=1 AND " . $this->buildWherePermission( $groups, 'p_member_groups' );
    	$query = "";
    	
    	$PRE = $this->tbl;
    	$this->obj['sql_tbl_prefix'] = "";
    	
    	switch ( $a['type'] )
    	{
    		case self::VIEW_CAT:				
    			$this->build( array(
    					"select"	=>	"*",
    					"from"		=>	"{$PRE}nexus_packages",
    					"where"		=>	"{$baseWhere} AND p_group IN ( {$a['extra']} )",
    					"order"		=>	"p_position",
    					"limit"		=>	$a['limit'],
    				) );
    			
    			$this->obj['sql_tbl_prefix'] = $PRE;
    			
    			$query = $this->fetchSqlString();
    			
    			$this->cur_query = '';
    			
    			return $query;

			case self::VIEW_FEATURED:
    			$this->build( array(
    					"select"	=>	"*",
    					"from"		=>	"{$PRE}nexus_packages",
    					"where"		=>	"{$baseWhere} AND p_featured = 1",
    					"order"		=>	"p_position",
    					"limit"		=>	$a['limit'],
    				) );
    			
    			$this->obj['sql_tbl_prefix'] = $PRE;
    			$query = $this->fetchSqlString();
    			
    			$this->cur_query = '';
    			
    			return $query;
					
    		case self::VIEW_POPULAR:
    			
    			$query .= "SET NOCOUNT ON;\n" ;
				$query .= "DECLARE @packageinfo TABLE ( p_id int, ps_count int null );\n" ;
				$query .= "INSERT INTO @packageinfo ( p_id ) select p_id from {$PRE}nexus_packages;\n" ;
				$query .= "UPDATE @packageinfo SET ps_count = ( SELECT COUNT( ps.ps_item_id ) FROM {$PRE}nexus_purchases ps WHERE ps.ps_item_id = p_id AND ps_app='nexus' AND ps_type='package' );\n" ;
				
				
				
    			$this->build( array(
    					"select"	=>	"p.*",
    					"from"		=>	array( "{$PRE}nexus_packages" => "p" ),
    					"where"		=>	"{$baseWhere}",
    					"order"		=>	"ps_count DESC",
    					"limit"		=>	$a['limit'],
    					"add_join"	=>	array ( array (
    								"select"	=>	"ps_count",
    								"from"		=>	array ( "@packageinfo" => "pi" ),
    								"where"		=>	"pi.p_id = p.p_id",
    								"type"		=>	"inner",
    								)
    							)
    				) );
    			
    			$this->obj['sql_tbl_prefix'] = $PRE;
    				
    			$this->db->allow_sub_select = 1;
    			$query .= $this->fetchSqlString();
    			
    			$this->cur_query = '';
    			
    			return $query;
    		
    		case self::VIEW_IDM:
				$this->build( array(
    					"select"	=>	"*",
    					"from"		=>	"{$PRE}nexus_packages",
    					"where"		=>	"{$baseWhere} AND p_id IN {$a['extra']}",
    					"order"		=>	"p_position",
    					"limit"		=>	$a['limit'],
    				) );
    			
    			$this->obj['sql_tbl_prefix'] = $PRE;
    			
    			$query = $this->fetchSqlString();
    			
    			$this->cur_query = '';
    			
    			return $query;
    	
    	}
    
    }

} // end class


?>