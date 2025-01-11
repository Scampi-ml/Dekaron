<?php
/**
 * <pre>
 * Invision Power Services
 * IP.Nexus - 1.1.0 ALPHA 1 Upgrade SQL
 * Last Updated: $Date: 2010-12-17 07:53:02 -0500 (Fri, 17 Dec 2010) $
 * </pre>
 *
 * @author 		$Author: ips_terabyte $ (Orginal: Mark)
 * @copyright	(c) 2010 Invision Power Services, Inc.
 * @license		http://www.invisionpower.com/community/board/license.html
 * @package		IP.Nexus
 * @link		http://www.invisionpower.com
 * @since		2nd December 2010
 * @version		$Revision: 7443 $
 */

$SQL[] = "CREATE TABLE nexus_product_options (
  opt_id int IDENTITY NOT NULL,
  opt_package int DEFAULT NULL,
  opt_values VARCHAR( MAX ),
  opt_stock int DEFAULT NULL,
  opt_base_price float DEFAULT NULL,
  opt_renew_price float DEFAULT NULL,
  PRIMARY KEY (opt_id)
);";