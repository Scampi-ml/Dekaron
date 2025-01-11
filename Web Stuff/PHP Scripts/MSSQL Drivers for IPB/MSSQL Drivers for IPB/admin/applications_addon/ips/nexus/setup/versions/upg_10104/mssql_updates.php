<?php
/**
 * @file		mssql_updates.php		1.1 Alpha 5 Upgrade SQL
 *
 * $Copyright: $
 * $License: $
 * $Author:  $
 * $LastChangedDate: $
 * $Revision: $
 * @since 		16th December 2010
 */

$SQL[] = "ALTER TABLE nexus_purchases ADD ps_original_invoice INT NOT NULL DEFAULT 0;";

$SQL[] = "ALTER TABLE nexus_invoices ADD i_renewal_ids VARCHAR( MAX ) NOT NULL DEFAULT '';";