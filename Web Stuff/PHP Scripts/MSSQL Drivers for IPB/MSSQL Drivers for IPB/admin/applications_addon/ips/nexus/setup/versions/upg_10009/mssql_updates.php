<?php
/**
 * <pre>
 * Invision Power Services
 * IP.Nexus - 1.0 Beta 4 Upgrade SQL
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

$SQL[] = "ALTER TABLE nexus_shipping DROP COLUMN s_cost;";
$SQL[] = "ALTER TABLE nexus_shipping DROP COLUMN s_weight;";

$SQL[] = "ALTER TABLE nexus_shipping ADD s_locations VARCHAR( MAX ) NOT NULL DEFAULT '';";
$SQL[] = "ALTER TABLE nexus_shipping ADD s_type CHAR NOT NULL DEFAULT '';";
$SQL[] = "ALTER TABLE nexus_shipping ADD s_rates VARCHAR( MAX ) NOT NULL DEFAULT '';";
$SQL[] = "ALTER TABLE nexus_shipping ADD s_tax INT NOT NULL DEFAULT 0;";

$SQL[] = "ALTER TABLE nexus_purchases ADD ps_invoice_pending TINYINT NOT NULL DEFAULT 0;";