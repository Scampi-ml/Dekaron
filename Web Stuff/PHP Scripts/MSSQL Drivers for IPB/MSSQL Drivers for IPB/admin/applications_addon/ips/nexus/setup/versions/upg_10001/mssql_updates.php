<?php
/**
 * <pre>
 * Invision Power Services
 * IP.Nexus - 1.0 Alpha 1 Upgrade SQL
 * Last Updated: $Date: 2010-12-17 07:53:02 -0500 (Fri, 17 Dec 2010) $
 * </pre>
 *
 * @author 		$Author: ips_terabyte $ (Orginal: Mark)
 * @copyright	(c) 2010 Invision Power Services, Inc.
 * @license		http://www.invisionpower.com/community/board/license.html
 * @package		IP.Nexus
 * @link		http://www.invisionpower.com
 * @since		17th June 2010
 * @version		$Revision: 7443 $
 */

$SQL[] = "ALTER TABLE nexus_support_statuses ADD status_color CHAR(6) NOT NULL DEFAULT '';";
$SQL[] = "ALTER TABLE nexus_support_requests ADD r_last_staff_reply INT NOT NULL DEFAULT 0;";
$SQL[] = "ALTER TABLE nexus_purchases ADD ps_admin_uri VARCHAR(255) NOT NULL DEFAULT '';";