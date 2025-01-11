<?php
/**
 * <pre>
 * Invision Power Services
 * IP.Board v3.1.4
 * Reports content SQL query cache file
 * Last Updated: $LastChangedDate: 2010-12-17 07:40:13 -0500 (Fri, 17 Dec 2010) $
 * </pre>
 *
 * @author 		$Author: ips_terabyte $
 * @author		Based on original "Report Center" by Luke Scott
 * @copyright	(c) 2001 - 2009 Invision Power Services, Inc.
 * @license		http://www.invisionpower.com/community/board/license.html
 * @package		IP.Board
 * @subpackage	Core
 * @link		http://www.invisionpower.com
 * @version		$Rev: 7442 $
 *
 */

class report_sql_queries
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
		$this->db	=& $database;
	}

	/**
	 * Creates a permissions where clause - repeated often, so cached to save us from typing
	 *
 	 * @access	public
	 * @param	array 	Parameters
	 * @return	sting	Where clause
	 */
	public function join_com_permissions( $data=array() )
	{
		$com_sql='';
		if( ! $data['NOTCACHE'] )
		{
			print 'This is NOT a cached query. Do not run directly';
			exit;
		}
		if( is_array($data['COMS']) && count($data['COMS']) > 0 )
		{
			while( list($k1, $v1) = each($data['COMS']) )
			{
				$exch = array();
				$cids[] = $k1;
				if( is_array( $v1 ) && count( $v1 ) )
				{
					$com_sql .= ' AND (rcl.com_id!=' . $k1;
					while( list($k2, $v2) = each($v1) )
					{
						if( is_array($v2) && count($v2) > 0 )
						{
							$proper	= array();
							
							foreach( $v2 as $_v2 )
							{
								if( $_v2 )
								{
									$proper[]	= $_v2;
								}
							}

							if( count($proper) )
							{
								$exch[] = 'rep.' . $k2 . ' IN(' . implode(',',$proper) . ')';
							}
						}
						elseif( is_numeric($v2) && $v2 > 0 )
						{
							$exch[] = 'rep.' . $k2 . '=' . $v2;
						}
						else
						{
							$exch[] = 'rep.' . $k2 . "='" . $this->db->addSlashes($v2) . "'";
						}
					}

					if( count($exch) > 0 )
					{
						$com_sql .= ' OR ' . implode(' AND ', $exch ) . ')';
					}
					else
					{
						$com_sql .= ')';
					}
				}
			}
			return 'rcl.com_id IN(' . implode( ',' , $cids ) . ')' . $com_sql;
		}
		else
		{
			return 'rcl.com_id < 0';
		}
	}

	/**
	 * Grab the reports for the reported content index page
	 *
 	 * @access	public
	 * @param	array 	Parameters
	 * @return	string	Database query
	 */
	public function reports_index( $data=array() )
	{
		$this->db->cur_startrow = $data['START'];
	
		$time = time();
		$ids  = array( 0 => 0 );
		
		$this->db->query( "SELECT TOP ".($data['START']+$data['LIMIT'])." rep.id, MAX(star.points) as points "
			 . "FROM " . $this->db->obj['sql_tbl_prefix'] . "rc_reports_index rep "
			 . "LEFT JOIN " . $this->db->obj['sql_tbl_prefix'] . "members mem ON (mem.member_id=rep.updated_by) "
			 . "LEFT JOIN " . $this->db->obj['sql_tbl_prefix'] . "rc_status stat ON (stat.status=rep.status) "
			 . "LEFT JOIN " . $this->db->obj['sql_tbl_prefix'] . "rc_status_sev star ON (((rep.num_reports * stat.points_per_report)+FLOOR((({$time}-rep.date_created)/60)/stat.minutes_to_apoint))>=star.points AND star.status=rep.status) "
			 . "LEFT JOIN " . $this->db->obj['sql_tbl_prefix'] . "rc_classes rcl ON (rcl.com_id=rep.rc_class) "
			 . "WHERE ".$data['WHERE']." "
			 . "GROUP BY rep.id, points, stat.rorder, rep.date_updated "
			 . "ORDER BY stat.rorder ASC, rep.date_updated DESC " );
			 
		while( $row = $this->db->fetch() )
		{
			ipsRegistry::$settings['_tmpPoints'][ $row['id'] ] = $row['points'];
			$ids[ $row['id'] ] = $row['id'];
		}
	
		return "SELECT rep.*, rcl.my_class, rcl.extra_data, mem.members_display_name as n_updated_by, mem.members_seo_name as n_updated_seoname, mem.member_group_id, "
			 . "((rep.num_reports * stat.points_per_report)+FLOOR((({$time}-rep.date_created)/60)/stat.minutes_to_apoint)) as built_points "
			 . "FROM " . $this->db->obj['sql_tbl_prefix'] . "rc_reports_index rep "
			 . "LEFT JOIN " . $this->db->obj['sql_tbl_prefix'] . "members mem ON (mem.member_id=rep.updated_by) "
			 . "LEFT JOIN " . $this->db->obj['sql_tbl_prefix'] . "rc_status stat ON (stat.status=rep.status) "
			 . "LEFT JOIN " . $this->db->obj['sql_tbl_prefix'] . "rc_status_sev star ON (((rep.num_reports * stat.points_per_report)+FLOOR((({$time}-rep.date_created)/60)/stat.minutes_to_apoint))>=star.points AND star.status=rep.status) "
			 . "LEFT JOIN " . $this->db->obj['sql_tbl_prefix'] . "rc_classes rcl ON (rcl.com_id=rep.rc_class) "
			 . "WHERE rep.id IN (" . implode( ',', $ids ) . ") "
			 . "ORDER BY stat.rorder ASC, built_points DESC, rep.date_updated DESC ";
	}

	/**
	 * Grab a report
	 *
 	 * @access	public
	 * @param	array 	Parameters
	 * @return	string	Database query
	 */
	public function grab_report( $data=array() )
	{
		$time = time();
		$ids  = array( 0 => 0 );
		
		$this->db->query("SELECT rep.id, MAX(star.points) as points "
			 . "FROM " . $this->db->obj['sql_tbl_prefix'] . "rc_reports rep "
			 . "LEFT JOIN " . $this->db->obj['sql_tbl_prefix'] . "members mem ON (mem.member_id=rep.report_by) "
			 . "LEFT JOIN " . $this->db->obj['sql_tbl_prefix'] . "rc_reports_index rei ON (rei.id=rep.rid) "
			 . "LEFT JOIN " . $this->db->obj['sql_tbl_prefix'] . "groups grop ON (grop.g_id=mem.member_group_id) "
			 . "LEFT JOIN " . $this->db->obj['sql_tbl_prefix'] . "sessions s ON (s.member_id=mem.member_id) "
			 . "LEFT JOIN " . $this->db->obj['sql_tbl_prefix'] . "rc_status stat ON (stat.status=rei.status) "
			 . "LEFT JOIN " . $this->db->obj['sql_tbl_prefix'] . "rc_status_sev star ON (((rei.num_reports * stat.points_per_report)+FLOOR((({$time}-rei.date_created)/60)/stat.minutes_to_apoint))>=star.points AND star.status=rei.status) "
			 . "WHERE rep.rid= " . $data['rid'] . " "
			 . "GROUP BY rep.id, points, rep.date_reported "
			 . "ORDER BY rep.date_reported ASC " );
		
		while( $row = $this->db->fetch() )
		{
			ipsRegistry::$settings['_tmpPoints'][ $row['id'] ] = $row['points'];
			$ids[ $row['id'] ] = $row['id'];
		}


		return "SELECT rep.*, rcl.my_class, mem.members_display_name, mem.member_group_id, mem.member_id, mem.mgroup_others, mem.members_seo_name,"
			 . "rei.url, rei.seoname, rei.seotemplate, rei.rc_class, rei.title, rei.status, rei.img_preview, grop.g_is_supmod as iscop, s.id as session_id, "
			 . "((rei.num_reports * stat.points_per_report)+FLOOR((({$time}-rei.date_created)/60)/stat.minutes_to_apoint)) as built_points "
			 . "FROM " . $this->db->obj['sql_tbl_prefix'] . "rc_reports rep "
			 . "LEFT JOIN " . $this->db->obj['sql_tbl_prefix'] . "members mem ON (mem.member_id=rep.report_by) "
			 . "LEFT JOIN " . $this->db->obj['sql_tbl_prefix'] . "rc_reports_index rei ON (rei.id=rep.rid) "
			 . "LEFT JOIN " . $this->db->obj['sql_tbl_prefix'] . "groups grop ON (grop.g_id=mem.member_group_id) "
			 . "LEFT JOIN " . $this->db->obj['sql_tbl_prefix'] . "sessions s ON (s.member_id=mem.member_id) "
			 . "LEFT JOIN " . $this->db->obj['sql_tbl_prefix'] . "rc_status stat ON (stat.status=rei.status) "
			 . "LEFT JOIN " . $this->db->obj['sql_tbl_prefix'] . "rc_classes rcl ON (rcl.com_id=rei.rc_class) "
			 . "WHERE rep.id IN (" . implode( ',', $ids ) . ") "
			 . "ORDER BY rep.date_reported ASC ";
	}	
	
	/**
	 * Grab the new status based on points, etc.
	 *
 	 * @access	public
	 * @param	array 	Parameters
	 * @return	string	Database query
	 */
	public function pull_new_status_single( $data=array() )
	{
		$time = time();

		return "SELECT TOP 1 rep.status, MAX(star.points) as points FROM " . $this->db->obj['sql_tbl_prefix'] . "rc_reports_index rep "
			. "LEFT JOIN " . $this->db->obj['sql_tbl_prefix'] . "rc_status stat ON (stat.status=rep.status) "
			 . "LEFT JOIN " . $this->db->obj['sql_tbl_prefix'] . "rc_status_sev star ON (((rep.num_reports * stat.points_per_report)+FLOOR((({$time}-rep.date_created)/60)/stat.minutes_to_apoint))>=star.points AND star.status=rep.status) "
			 . "WHERE rep.id=".$data['ID']." "
			 . "GROUP BY rep.id, points, rep.status";
	}

	/**
	 * Get permissions to access a class
	 *
 	 * @access	public
	 * @param	array 	Parameters
	 * @return	string	Database query
	 */
	public function get_class_permissions( $data=array() )
	{
		return "SELECT com_id, my_class, extra_data, app FROM " . $this->db->obj['sql_tbl_prefix'] . "rc_classes WHERE onoff=1 AND " . $this->db->buildRegexp( $data['COL'], $data['GROUP_IDS'] );
	}
}