<?php
/**
 * <pre>
 * Invision Power Services
 * IP.Nexus - 1.0 Alpha 5 Upgrade SQL
 * Last Updated: $Date: 2010-12-17 07:53:02 -0500 (Fri, 17 Dec 2010) $
 * </pre>
 *
 * @author 		$Author: ips_terabyte $ (Orginal: Mark)
 * @copyright	(c) 2010 Invision Power Services, Inc.
 * @license		http://www.invisionpower.com/community/board/license.html
 * @package		IP.Nexus
 * @link		http://www.invisionpower.com
 * @since		28th July 2010
 * @version		$Revision: 7443 $
 */

$SQL[] = "ALTER TABLE nexus_ship_orders ADD o_shipped_date INT NOT NULL DEFAULT 0;";
$SQL[] = "ALTER TABLE nexus_packages ADD p_seo_name VARCHAR(128) NOT NULL DEFAULT '';";
$SQL[] = "ALTER TABLE nexus_package_groups ADD pg_seo_name VARCHAR(32) NOT NULL DEFAULT '';";
$SQL[] = "ALTER TABLE nexus_adpacks ADD ap_name VARCHAR(128) NOT NULL DEFAULT '';";
$SQL[] = "ALTER TABLE nexus_support_departments ADD dpt_notify VARCHAR(MAX) NOT NULL DEFAULT '';";
$SQL[] = "ALTER TABLE nexus_support_departments ADD dpt_notify_reply TINYINT NOT NULL DEFAULT 0;";