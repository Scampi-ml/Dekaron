
<?php

/**
 * <pre>
 * Invision Power Services
 * IP.Board v3.1.4
 * Last Updated: $LastChangedDate: 2010-01-15 15:18:44 +0000 (Fri, 15 Jan 2010) $
 * </pre>
 *
 * @author 		$Author: bfarber $
 * @copyright	(c) 2001 - 2009 Invision Power Services, Inc.
 * @license		http://www.invisionpower.com/community/board/license.html
 * @package		IP.Blog
 * @link		http://www.invisionpower.com
 * @since		27th January 2004
 * @version		$Rev: 5713 $
 *
 */



class public_ipseo_sql_queries extends db_driver_mssql
{
     protected $db  = "";
     protected $tbl = "";

    /* Construct */
    public function __construct( &$obj )
    {
    	$this->DB     = ipsRegistry::DB();
    	$this->prefix = ips_DBRegistry::getPrefix();
    }

    /*========================================================================*/

    public function ipseo_increment_keyword_count( $keyword )
    {
		$keyword = $this->DB->addSlashes($keyword);
		
		
		
    	$query   = "IF NOT EXISTS ( SELECT keyword FROM {$this->prefix}search_keywords WHERE keyword = '{$keyword}' ) INSERT INTO {$this->prefix}search_keywords (keyword, count) VALUES ('{$keyword}', 1) ELSE UPDATE {$this->prefix}search_keywords SET count = count + 1 WHERE keyword = '{$keyword}'";
		
    	return $query;
	}
}
?>