<?php
/**
 * <pre>
 * Invision Power Services
 * IP.Nexus - 1.0.1 Upgrade SQL
 * Last Updated: $Date: 2010-12-17 07:53:02 -0500 (Fri, 17 Dec 2010) $
 * </pre>
 *
 * @author 		$Author: ips_terabyte $ (Orginal: Mark)
 * @copyright	(c) 2010 Invision Power Services, Inc.
 * @license		http://www.invisionpower.com/community/board/license.html
 * @package		IP.Nexus
 * @link		http://www.invisionpower.com
 * @since		4th November 2010
 * @version		$Revision: 7443 $
 */

$SQL[] = <<<SQL
INSERT INTO core_incoming_emails (rule_criteria_field, rule_criteria_type, rule_criteria_value, rule_app, rule_added_by, rule_added_date) VALUES('sbjt', 'regx', '\\\[SR\\\d+-.+\\\]', 'nexus', 0, 0);
SQL;

$SQL[] = "ALTER TABLE nexus_support_requests ADD r_email_key CHAR(3);";
$SQL[] = "ALTER TABLE nexus_paypal_subscriptions ADD s_method INT NOT NULL DEFAULT 0;";
$SQL[] = "UPDATE nexus_paypal_subscriptions SET s_method = s_methos;";
$SQL[] = "ALTER TABLE nexus_paypal_subscriptions DROP COLUMN s_methos;";
$SQL[] = "ALTER TABLE nexus_purchases ALTER COLUMN ps_name VARCHAR( 128 );";
$SQL[] = "ALTER TABLE nexus_invoices ADD i_noreminder TINYINT NOT NULL DEFAULT 0;";

