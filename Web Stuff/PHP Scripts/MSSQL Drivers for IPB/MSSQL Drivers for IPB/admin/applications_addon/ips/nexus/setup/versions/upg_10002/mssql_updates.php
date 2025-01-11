<?php
/**
 * <pre>
 * Invision Power Services
 * IP.Nexus - 1.0 Alpha 2 Upgrade SQL
 * Last Updated: $Date: 2010-12-17 07:53:02 -0500 (Fri, 17 Dec 2010) $
 * </pre>
 *
 * @author 		$Author: ips_terabyte $ (Orginal: Mark)
 * @copyright	(c) 2010 Invision Power Services, Inc.
 * @license		http://www.invisionpower.com/community/board/license.html
 * @package		IP.Nexus
 * @link		http://www.invisionpower.com
 * @since		12th July 2010
 * @version		$Revision: 7443 $
 */

$SQL[] = "ALTER TABLE nexus_customer_history ALTER COLUMN log_date REAL;";
