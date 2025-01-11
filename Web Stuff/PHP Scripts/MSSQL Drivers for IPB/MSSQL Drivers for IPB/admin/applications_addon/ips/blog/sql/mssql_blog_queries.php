<?php

/**
 * <pre>
 * Invision Power Services
 * IP.Board vVERSION_NUMBER
 * Last Updated: $LastChangedDate: 2010-12-17 07:53:02 -0500 (Fri, 17 Dec 2010) $
 * </pre>
 *
 * @author 		$Author: ips_terabyte $
 * @copyright	(c) 2001 - 2009 Invision Power Services, Inc.
 * @license		http://www.invisionpower.com/community/board/license.html
 * @package		IP.Blog
 * @link		http://www.invisionpower.com
 * @since		27th January 2004
 * @version		$Rev: 7443 $
 *
 */



class sql_blog_queries extends db_driver_mssql
{
     protected $db  = "";
     protected $tbl = "";

    /*========================================================================*/
    // Set up...
    /*========================================================================*/

    function sql_blog_queries( &$obj )
    {
    	$this->db	= &$obj;
		$this->tbl	= ips_DBRegistry::getPrefix();
    }

    /*========================================================================*/

    

    function blog_rebuild_getcounts( $a )
    {
    	return "SELECT SUM(CASE WHEN entry_status='published' THEN 1 ELSE 0 END) as blog_num_entries,
    				   SUM(CASE WHEN entry_status='draft' THEN 1 ELSE 0 END) as blog_num_drafts
     			FROM {$this->tbl}blog_entries WHERE blog_id={$a['blog_id']} {$a['extra']}";
    }

	function random_album_image( $a )
	{
		return "SELECT TOP 1 b.id, b.caption, b.directory, b.masked_file_name, b.file_name, b.file_type, b.thumbnail, b.media
			    FROM {$this->tbl}gallery_albums a, {$this->tbl}gallery_images b
			    WHERE a.id=b.album_id and a.member_id = {$a['member_id']} {$a['extra']}
				ORDER BY RAND((( DATEPART(mm, GETDATE()))*(DATEPART(ss, GETDATE()))* DATEPART(ms, GETDATE()))/b.id*(DATEPART(ss, GETDATE())))";
	}

    function updateblogviews_get( $a )
    {
    	return "SELECT blog_id, COUNT(*) as blogviews
    		   FROM {$this->tbl}blog_views
    		   GROUP BY blog_id";
    }   

} // end class


?>