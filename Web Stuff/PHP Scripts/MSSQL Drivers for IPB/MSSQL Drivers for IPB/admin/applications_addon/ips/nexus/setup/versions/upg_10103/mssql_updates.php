<?php
/**
 * @file		mysql_updates.php		1.1 Alpha 4 Upgrade SQL
 *
 * $Copyright: $
 * $License: $
 * $Author: mat $
 * $LastChangedDate: 2011-01-03 07:56:57 -0500 (Mon, 03 Jan 2011) $
 * $Revision: 7502 $
 * @since 		16th December 2010
 */

$SQL[] = "ALTER TABLE nexus_ads ADD ad_start INT NOT NULL DEFAULT 0;";
$SQL[] = "ALTER TABLE nexus_ads ADD ad_end INT NOT NULL DEFAULT 0;";

$SQL[] = "ALTER TABLE nexus_adpacks ADD ap_desc VARCHAR( MAX ) DEFAULT NULL;";

