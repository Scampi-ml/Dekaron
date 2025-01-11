<?php
/**
 * <pre>
 * Invision Power Services
 * IP.Nexus - 1.0 Beta 7 Upgrade SQL
 * Last Updated: $Date: 2010-12-17 07:53:02 -0500 (Fri, 17 Dec 2010) $
 * </pre>
 *
 * @author 		$Author: ips_terabyte $ (Orginal: Mark)
 * @copyright	(c) 2010 Invision Power Services, Inc.
 * @license		http://www.invisionpower.com/community/board/license.html
 * @package		IP.Nexus
 * @link		http://www.invisionpower.com
 * @since		13th October 2010
 * @version		$Revision: 7443 $
 */

$SQL[] = "ALTER TABLE nexus_support_requests ADD r_staff_lock INT NOT NULL DEFAULT 0";
$SQL[] = "ALTER TABLE nexus_invoices ALTER COLUMN i_title VARCHAR( 128 ) NULL";