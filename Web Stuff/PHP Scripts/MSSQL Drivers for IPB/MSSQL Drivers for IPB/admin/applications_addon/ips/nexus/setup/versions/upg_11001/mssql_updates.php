<?php
/**
 * @file		mssql_updates.php		1.1.1 Upgrade SQL
 *
 * $Copyright: $
 * $License: $
 * $Author: mark $
 * $LastChangedDate: 2011-01-06 11:00:03 -0500 (Thu, 06 Jan 2011) $
 * $Revision: 7536 $
 * @since 		16th December 2010
 */

$SQL[] = "ALTER TABLE nexus_invoices ALTER COLUMN i_total decimal(20,2) NOT NULL;";