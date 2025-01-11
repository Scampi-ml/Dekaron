<?php
/**
 * <pre>
 * Invision Power Services
 * IP.Board v3.1.2
 * Calendar SQL query cache file
 * Last Updated: $LastChangedDate: 2010-01-15 10:18:44 -0500 (Fri, 15 Jan 2010) $
 * </pre>
 *
 * @author 		$Author: bfarber $
 * @author		Based on original "Report Center" by Luke Scott
 * @copyright	(c) 2001 - 2009 Invision Power Services, Inc.
 * @license		http://www.invisionpower.com/community/board/license.html
 * @package		IP.Board
 * @subpackage	Core
 * @link		http://www.invisionpower.com
 * @version		$Rev: 5713 $
 *
 */

class public_calendar_sql_queries
{
	/**
	 * Database object handle
	 *
	 * @var		object
	 * @access	private
	 */
	private	$db;

	/**
	 * Constructor
	 *
 	 * @access	public
	 * @param	object	Database reference
	 * @return	void
	 */
	public function __construct( &$database )
	{
		$this->db	  =& $database;
		$this->prefix =  $database->obj['sql_tbl_prefix'];
	}

	/**
	 * SQL
	 *
 	 * @access	public
	 * @param	array 	Parameters
	 * @return	sting	Where clause
	 */
	public function fetchEventsAll( $a=array() )
	{
		print "SELECT * FROM {$this->prefix}cal_events
				WHERE {$extra} event_approved='1'
						AND ( (event_unix_to >= '{$a['timenow']}' AND event_unix_from <= '{$a['timethen']}' )
						OR ( event_unix_to='0' AND event_unix_from >= '{$a['timenow']}' AND event_unix_from <= '{$a['timethen']}' )
						OR ( event_recurring='3' AND " . $this->db->buildFromUnixtime( 'event_unix_from', '%c' ) . "='{$a['month']}' AND event_unix_to <= '{$a['timethen']}' ) )";
		exit;

	}

	/**
	 * SQL
	 *
 	 * @access	public
	 * @param	array 	Parameters
	 * @return	sting	Where clause
	 */
	public function fetchEventsCal( $a=array() )
	{
		print "SELECT * FROM {$this->prefix}cal_events
				WHERE event_calendar_id={$a['event_calendar_id']}
						AND {$extra}
						AND ( (event_unix_to >= {$a['timenow']} AND event_unix_from <= {$a['timethen']} )
						OR ( event_unix_to=0 AND event_unix_from >= {$a['timenow']} AND event_unix_from <= {$a['timethen']} )
						OR ( event_recurring=3 AND " . $this->db->buildFromUnixtime( 'event_unix_from', '%c' ) . "={$a['month']} AND event_unix_to <= {$a['timethen']} ) )";
		exit;
	}

}