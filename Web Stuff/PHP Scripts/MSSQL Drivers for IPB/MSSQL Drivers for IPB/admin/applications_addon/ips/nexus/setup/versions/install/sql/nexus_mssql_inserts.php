<?php
/**
 * <pre>
 * Invision Power Services
 * IP.Nexus - Install SQL
 * Last Updated: $Date: 2010-12-17 07:53:02 -0500 (Fri, 17 Dec 2010) $
 * </pre>
 *
 * @author 		$Author: ips_terabyte $ (Orginal: Mark)
 * @copyright	(c) 2010 Invision Power Services, Inc.
 * @license		http://www.invisionpower.com/community/board/license.html
 * @package		IP.Nexus
 * @link		http://www.invisionpower.com
 * @since		31st March 2010
 * @version		$Revision: 7443 $
 */

/* Incoming Email Rules */
$INSERT[] = <<<SQL
INSERT INTO core_incoming_emails ( rule_criteria_field, rule_criteria_type, rule_criteria_value, rule_app, rule_added_date, rule_added_by ) VALUES('sbjt', 'regx', '\\\[SR\\\d+-.+\\\]', 'nexus', DATEDIFF(s, '19700101', GETDATE()), 1);
SQL;

/* Payment Gateways and methods */
$INSERT[] = "SET IDENTITY_INSERT nexus_gateways ON;";
$INSERT[] = <<<SQL
INSERT INTO nexus_gateways (g_id, g_key, g_name, g_settings, g_testmode, g_position, g_payout) VALUES
(3, 'authnet', 'Authorize.Net - AIM', 'a:2:{s:9:"api_login";a:1:{s:4:"type";s:9:"formInput";}s:9:"trans_key";a:1:{s:4:"type";s:9:"formInput";}}', 0, 3, 0),
(1, 'manual', 'Manual Payments', 'a:1:{s:7:"details";a:3:{s:4:"type";s:12:"formTextarea";s:7:"default";s:0:"";s:6:"payout";b:1;}}', 0, 1, 1),
(2, 'paypal', 'PayPal', 'a:2:{s:5:"email";a:3:{s:4:"type";s:9:"formInput";s:7:"default";s:0:"";s:6:"payout";b:1;}s:13:"subscriptions";a:3:{s:4:"type";s:9:"formYesNo";s:7:"default";i:0;s:6:"payout";b:0;}}', 0, 2, 0);
SQL;
$INSERT[] = "SET IDENTITY_INSERT nexus_gateways OFF;";
$INSERT[] = "SET IDENTITY_INSERT nexus_paymethods ON;";
$INSERT[] = <<<SQL
INSERT INTO nexus_paymethods (m_id, m_gateway, m_name, m_settings, m_active, m_position) VALUES
(1, 1, 'Check', 'a:1:{s:7:"details";s:32:"Please make checks payable to...";}', 0, 1),
(2, 1, 'Bank Wire', 'a:1:{s:7:"details";s:25:"Please send payment to...";}', 0, 2),
(6, 3, 'Credit / Debit Card', 'a:2:{s:9:"api_login";s:0:"";s:9:"trans_key";s:0:"";}', 0, 2),
(3, 2, 'PayPal', 'a:2:{s:5:"email";s:0:"";s:13:"subscriptions";s:1:"0";}', 0, 0);
SQL;
$INSERT[] = "SET IDENTITY_INSERT nexus_paymethods OFF;";

/* Support Statuses */
$INSERT[] = "SET IDENTITY_INSERT nexus_support_statuses ON;";
$INSERT[] = <<<SQL
INSERT INTO nexus_support_statuses ( status_id, status_name, status_public_name, status_public_set, status_default_member, status_default_staff, status_is_locked, status_assign, status_position, status_open, status_color ) VALUES
(1, 'Open', 'Open', '', 1, 0, 0, 0, 0, 1, '000000'),
(4, 'Hold', 'On Hold', '', 0, 0, 0, 0, 0, 1, '000000'),
(3, 'Closed', 'Awaiting your reply', '', 0, 1, 0, 0, 0, 0, '000000'),
(5, 'Resolved', 'Resolved', 'Mark resolved', 0, 0, 0, 1, 0, 0, '000000'),
(6, 'Working', 'In Progress', '', 0, 0, 0, 0, 1, 1, '000000'),
(7, 'Spam', 'Marked as Spam - Reply if this is an error', '', 0, 0, 0, 0, 0, 0, '000000'),
(8, 'Scheduled', 'Scheduled', '', 0, 0, 0, 0, 1, 1, '000000');
SQL;
$INSERT[] = "SET IDENTITY_INSERT nexus_support_statuses OFF;";

/* Shipping Methods */
$INSERT[] = <<<SQL
INSERT INTO nexus_shipping (s_id, s_name, s_locations, s_type, s_rates, s_tax, s_order) VALUES (11, 'Free Shipping', '*', 'w', 'a:1:{i:0;a:2:{s:5:"value";s:0:"";s:4:"cost";s:1:"0";}}', 0, 1);
SQL;

/* Misc. example data */
$INSERT[] = "INSERT INTO nexus_package_groups ( pg_name, pg_seo_name, pg_position, pg_parent ) VALUES ('Widgets', 'widgets', 1, 0);";
$INSERT[] = "INSERT INTO nexus_packages VALUES (1, 'Widget', 'widget', 'This is just an example package which can be deleted.', 1, 0, '1', 0, -1, 0, 1, '*', 0, 0, 0, 0, '10', 0, 0, '', 'm', 0, 0, '', '', 1, 1, 1, '', 1, '', 0, '', 'a:2:{s:7:\"loyalty\";a:0:{}s:6:\"bundle\";a:0:{}}', 'Congratulations on purchasing your widget&#33;', 0, 1, 0, '', 1, 0, '');";
$INSERT[] = "INSERT INTO nexus_support_departments (dpt_name, dpt_open, dpt_require_package, dpt_packages, dpt_position, dpt_email ) VALUES ('Sales', 1, 0, '', 1, '');";

/* Support Staff */
ipsRegistry::DB()->build( array( 'select' => 'g_id',
				   'from'   => 'groups',
				   'where'  => 'g_access_cp=1' ) );
$o = ipsRegistry::DB()->execute();
while( $row = ipsRegistry::DB()->fetch( $o ) )
{
	$INSERT[] = "INSERT INTO nexus_support_staff VALUES ( 'g', {$row['g_id']}, '*' );";
}

$INSERT[] = "SET IDENTITY_INSERT nexus_ads ON";
/* Ads */
if ( isset( ipsRegistry::$settings ) and !empty( ipsRegistry::$settings ) )
{
	$active = ipsRegistry::$settings['ad_code_global_enabled'];
	$exempt = ipsRegistry::$settings['ad_code_exempt_groups'];
	foreach ( array( 'ad_code_global_header', 'ad_code_global_footer', 'ad_code_board_index_header', 'ad_code_board_index_footer', 'ad_code_board_sidebar', 'ad_code_forum_view_header', 'ad_code_forum_view_footer', 'ad_code_forum_view_topic_code', 'ad_code_topic_view_header', 'ad_code_topic_view_footer', 'ad_code_topic_view_code' ) as $location )
	{
		if ( ipsRegistry::$settings[ $location ] )
		{
			$code = ipsRegistry::$settings[ $location ];
			$INSERT[] = <<<SQL
INSERT INTO nexus_ads ( ad_id, ad_locations, ad_image, ad_link, ad_html, ad_exempt, ad_clicks, ad_impressions, ad_active, ad_expire, ad_expire_unit, ad_paid, ad_member ) VALUES (
NULL ,  '{$location}',  '',  '',  '{$code}',  '{$exempt}',  '0',  '0',  '{$active}',  '0',  'c',  '1',  '0'
);
SQL;
$INSERT[] = "SET IDENTITY_INSERT nexus_ads OFF";
		}
	}
}

/* Support Severities */
$INSERT[] = "INSERT INTO nexus_support_severities VALUES (1, 'Normal', NULL, '000000', 1, 1, NULL, '');";