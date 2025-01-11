<?php
/**
 * <pre>
 * Invision Power Services
 * IP.Nexus - 1.1.0 ALPHA 2 Upgrade SQL
 * Last Updated: $Date: 2011-01-03 07:56:57 -0500 (Mon, 03 Jan 2011) $
 * </pre>
 *
 * @author 		$Author: mat $ (Orginal: Mark)
 * @copyright	(c) 2010 Invision Power Services, Inc.
 * @license		http://www.invisionpower.com/community/board/license.html
 * @package		IP.Nexus
 * @link		http://www.invisionpower.com
 * @since		9th December 2010
 * @version		$Revision: 7502 $
 */

/* Severities */
$SQL[] = "CREATE TABLE nexus_support_severities (
  sev_id int NOT NULL IDENTITY,
  sev_name varchar(255) NULL DEFAULT NULL,
  sev_icon varchar(32) NULL DEFAULT NULL,
  sev_color char(6) NULL DEFAULT NULL,
  sev_default tinyint NULL DEFAULT NULL,
  sev_public tinyint NULL DEFAULT NULL,
  sev_position int NULL DEFAULT NULL,
  sev_action varchar(255) NULL DEFAULT NULL,
  PRIMARY KEY (sev_id)
);";
$SQL[] = "INSERT INTO nexus_support_severities ( sev_name, sev_icon, sev_color, sev_default, sev_public, sev_position, sev_action ) VALUES ('Normal', NULL, '000000', 1, 1, NULL, '');";

$SQL[] = "ALTER TABLE nexus_support_requests ADD r_severity int NULL DEFAULT 0;";

$SQL[] = "ALTER TABLE nexus_packages ADD p_support_severity int NULL DEFAULT 0;";

$SQL[] = "ALTER TABLE members ADD cm_no_sev tinyint NULL DEFAULT 0;";

/* Increase group name limit */
$SQL[] = "ALTER TABLE nexus_package_groups ALTER COLUMN pg_name VARCHAR(255);";

/* Email on purchase */
$SQL[] = "ALTER TABLE nexus_packages ADD p_notify VARCHAR(MAX) NOT NULL DEFAULT '';";

/* Advertisement size restrictions */
$SQL[] = "ALTER TABLE nexus_adpacks ADD ap_max_height INT;";
$SQL[] = "ALTER TABLE nexus_adpacks ADD ap_max_width INT;";
$SQL[] = "UPDATE nexus_adpacks SET ap_max_height = -1;";
$SQL[] = "UPDATE nexus_adpacks SET ap_max_width = -1;";

