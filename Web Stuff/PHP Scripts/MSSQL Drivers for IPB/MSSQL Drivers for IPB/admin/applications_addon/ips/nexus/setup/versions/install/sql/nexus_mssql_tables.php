<?php
/**
 * <pre>
 * Invision Power Services
 * IP.Nexus - Install SQL (MSSQL)
 * Last Updated: $Date: 2011-01-06 11:00:03 -0500 (Thu, 06 Jan 2011) $
 * </pre>
 *
 * @author 		$Author: mark $ (Orginal: Mark)
 * @copyright	(c) 2010 Invision Power Services, Inc.
 * @license		http://www.invisionpower.com/community/board/license.html
 * @package		IP.Nexus
 * @link		http://www.invisionpower.com
 * @since		31st March 2010
 * @version		$Revision: 7536 $
 */

$TABLE[] = "CREATE TABLE nexus_adpacks (
ap_id INT IDENTITY NOT NULL PRIMARY KEY ,
ap_desc TEXT DEFAULT NULL ,
ap_locations VARCHAR(MAX) NOT NULL  DEFAULT '',
ap_exempt VARCHAR(MAX) NOT NULL  DEFAULT '',
ap_expire INT NOT NULL  DEFAULT 0,
ap_expire_unit CHAR(1) NOT NULL ,
ap_price FLOAT NOT NULL  DEFAULT 0,
ap_order INT NOT NULL  DEFAULT 0,
ap_name VARCHAR(128) NOT NULL ,
ap_max_height INT(3) NOT NULL DEFAULT 0,
ap_max_width INT(3) NOT NULL DEFAULT 0,
UNIQUE ( ap_order )
)";

$TABLE[] = "CREATE TABLE nexus_ads (
  ad_id INT IDENTITY NOT NULL,
  ad_locations VARCHAR(MAX) NOT NULL  DEFAULT '',
  ad_image VARCHAR(255) NOT NULL  DEFAULT '',
  ad_link VARCHAR(255) NOT NULL  DEFAULT '',
  ad_html VARCHAR(MAX) NOT NULL  DEFAULT '',
  ad_exempt VARCHAR(MAX) NOT NULL  DEFAULT '',
  ad_clicks INT NOT NULL  DEFAULT 0,
  ad_impressions INT NOT NULL  DEFAULT 0,
  ad_active TINYINT NOT NULL  DEFAULT 0,
  ad_expire INT NOT NULL  DEFAULT 0,
  ad_expire_unit CHAR(1) NOT NULL  DEFAULT '',
  ad_start INT( 10 ) NOT NULL DEFAULT 0 ,
  ad_end INT( 10 ) NOT NULL DEFAULT 0 ,
  ad_paid TINYINT NOT NULL DEFAULT 0,
  ad_member INT NOT NULL DEFAULT 0,
  PRIMARY KEY (ad_id)
)";

$TABLE[] = "CREATE TABLE nexus_alternate_contacts (
  main_id INT NOT NULL  DEFAULT 0,
  alt_id INT NOT NULL  DEFAULT 0,
  purchases VARCHAR(MAX) NOT NULL  DEFAULT '',
  PRIMARY KEY  (main_id,alt_id)
)";

$TABLE[] = "CREATE TABLE nexus_coupons (
  c_id INT IDENTITY NOT NULL,
  c_code VARCHAR(25) NOT NULL  DEFAULT '',
  c_discount FLOAT NOT NULL,
  c_unit CHAR(1) NOT NULL  DEFAULT '',
  c_products VARCHAR(MAX) NOT NULL  DEFAULT '',
  c_limit_discount TINYINT NOT NULL  DEFAULT 0,
  c_groups VARCHAR(MAX) NOT NULL  DEFAULT '',
  c_uses INT NOT NULL  DEFAULT 0,
  c_member_uses INT NOT NULL  DEFAULT 0,
  c_start INT NOT NULL  DEFAULT 0,
  c_end INT NOT NULL  DEFAULT 0,
  c_used_by VARCHAR(MAX) NOT NULL  DEFAULT '',
  PRIMARY KEY  (c_id)
)";

$TABLE[] = "CREATE TABLE nexus_customer_history (
  log_id INT IDENTITY NOT NULL,
  log_member INT NOT NULL  DEFAULT 0,
  log_by INT NOT NULL  DEFAULT 0,
  log_type VARCHAR(32) NOT NULL  DEFAULT '',
  log_data VARCHAR(MAX) NOT NULL  DEFAULT '',
  log_date REAL NOT NULL,
  PRIMARY KEY (log_id)
)";

$TABLE[] = "CREATE TABLE nexus_donate_goals (
  d_id INT IDENTITY NOT NULL,
  d_name VARCHAR(32) NOT NULL DEFAULT '',
  d_desc VARCHAR(MAX) NOT NULL DEFAULT '',
  d_goal FLOAT NOT NULL DEFAULT 0,
  d_current FLOAT NOT NULL DEFAULT 0,
  d_position INT NOT NULL DEFAULT 0,
  PRIMARY KEY  (d_id)
)";

$TABLE[] = "CREATE TABLE nexus_gateways (
  g_id INT IDENTITY NOT NULL,
  g_key VARCHAR(32) NOT NULL  DEFAULT '',
  g_name VARCHAR(128) NOT NULL  DEFAULT '',
  g_settings VARCHAR(MAX) NOT NULL  DEFAULT '',
  g_testmode TINYINT NOT NULL  DEFAULT 0,
  g_position INT DEFAULT NULL,
  g_payout TINYINT NOT NULL DEFAULT 0,
  PRIMARY KEY  (g_id)
)";

$TABLE[] = "CREATE TABLE nexus_invoices (
  i_id INT IDENTITY NOT NULL,
  i_status CHAR(4) NOT NULL  DEFAULT '',
  i_title VARCHAR(128) NOT NULL  DEFAULT '',
  i_member INT NOT NULL  DEFAULT 0,
  i_items VARCHAR(MAX) NOT NULL  DEFAULT '',
  i_total DECIMAL(20,2) NOT NULL,
  i_date INT NOT NULL  DEFAULT 0,
  i_return_uri VARCHAR(255) NOT NULL  DEFAULT '',
  i_paid INT NOT NULL  DEFAULT 0,
  i_status_extra VARCHAR(MAX) NOT NULL  DEFAULT '',
  i_discount INT NOT NULL  DEFAULT 0,
  i_temp CHAR(4) NOT NULL  DEFAULT '',
  i_ordersteps TINYINT NOT NULL  DEFAULT 0,
  i_noreminder TINYINT NOT NULL  DEFAULT 0,
  i_renewal_ids VARCHAR(MAX) NOT NULL  DEFAULT '',
  PRIMARY KEY  (i_id)
)";

$TABLE[] = "CREATE TABLE nexus_notes (
  note_id INT IDENTITY NOT NULL,
  note_member INT NOT NULL  DEFAULT 0,
  note_text VARCHAR(MAX) NOT NULL  DEFAULT '',
  note_author INT NOT NULL  DEFAULT 0,
  note_date INT NOT NULL  DEFAULT 0,
  PRIMARY KEY  (note_id)
)";

$TABLE[] = "CREATE TABLE nexus_packages (
  p_id INT IDENTITY NOT NULL,
  p_name VARCHAR(128) NOT NULL  DEFAULT '',
  p_seo_name VARCHAR(128) NOT NULL  DEFAULT '',
  p_desc VARCHAR(MAX) NOT NULL  DEFAULT '',
  p_group INT NOT NULL  DEFAULT 0,
  p_physical TINYINT NOT NULL  DEFAULT 0,
  p_shipping VARCHAR(MAX) NOT NULL  DEFAULT '',
  p_weight INT NOT NULL  DEFAULT 0,
  p_stock INT NOT NULL  DEFAULT 0,
  p_reg TINYINT NOT NULL  DEFAULT 0,
  p_store TINYINT NOT NULL  DEFAULT 0,
  p_member_groups VARCHAR(MAX) NOT NULL  DEFAULT '',
  p_allow_upgrading TINYINT NOT NULL  DEFAULT 0,
  p_upgrade_charge TINYINT NOT NULL  DEFAULT 0,
  p_allow_downgrading TINYINT NOT NULL  DEFAULT 0,
  p_downgrade_refund TINYINT NOT NULL  DEFAULT 0,
  p_base_price VARCHAR(MAX) NOT NULL  DEFAULT '',
  p_tax INT NOT NULL  DEFAULT 0,
  p_renewals INT NOT NULL  DEFAULT 0,
  p_renewal_price VARCHAR(MAX) NOT NULL  DEFAULT '',
  p_renewal_unit CHAR(1) NOT NULL  DEFAULT '',
  p_renewal_days INT NOT NULL  DEFAULT 0,
  p_primary_group INT NOT NULL  DEFAULT 0,
  p_secondary_group VARCHAR(MAX) NOT NULL  DEFAULT '',
  p_perm_set VARCHAR(MAX) NOT NULL  DEFAULT '',
  p_return_primary TINYINT NOT NULL  DEFAULT 0,
  p_return_secondary TINYINT NOT NULL  DEFAULT 0,
  p_return_perm TINYINT NOT NULL  DEFAULT 0,
  p_module VARCHAR(250) NOT NULL  DEFAULT '',
  p_position INT NOT NULL  DEFAULT 0,
  p_associable VARCHAR(MAX) NOT NULL  DEFAULT '',
  p_force_assoc TINYINT NOT NULL  DEFAULT 0,
  p_assoc_error VARCHAR(MAX) NOT NULL  DEFAULT '',
  p_discounts VARCHAR(MAX) NOT NULL  DEFAULT '',
  p_page VARCHAR(MAX) NOT NULL  DEFAULT '',
  p_support TINYINT NOT NULL  DEFAULT 0,
  p_support_department INT NOT NULL  DEFAULT 0,
  p_support_severity int(5) NULL DEFAULT 0,
  p_image VARCHAR( 255 ) NOT NULL  DEFAULT '',
  p_featured TINYINT NOT NULL  DEFAULT 0,
  p_upsell TINYINT NOT NULL  DEFAULT 0,
  p_notify TEXT NOT NULL DEFAULT '',
  PRIMARY KEY  (p_id)
)";

$TABLE[] = "CREATE TABLE nexus_package_fields (
  cf_id INT IDENTITY NOT NULL,
  cf_name VARCHAR(128) NOT NULL  DEFAULT '',
  cf_desc VARCHAR(MAX) NOT NULL  DEFAULT '',
  cf_type VARCHAR(10) NOT NULL  DEFAULT '',
  cf_extra VARCHAR(MAX) NOT NULL  DEFAULT '',
  cf_packages VARCHAR(MAX) NOT NULL  DEFAULT '',
  cf_position INT NOT NULL  DEFAULT 0,
  cf_sticky TINYINT NOT NULL  DEFAULT 0,
  cf_purchase TINYINT NOT NULL  DEFAULT 0,
  cf_required TINYINT NOT NULL  DEFAULT 0,
  cf_editable TINYINT NOT NULL  DEFAULT 0,
  PRIMARY KEY  (cf_id)
)";

$TABLE[] = "CREATE TABLE nexus_package_groups (
  pg_id INT IDENTITY NOT NULL,
  pg_name VARCHAR(255) NOT NULL  DEFAULT '',
  pg_seo_name VARCHAR(32) NOT NULL  DEFAULT '',
  pg_position INT NOT NULL  DEFAULT 0,
  pg_parent INT NOT NULL  DEFAULT 0,
  PRIMARY KEY  (pg_id)
)";

$TABLE[] = "CREATE TABLE nexus_paymethods (
  m_id INT IDENTITY NOT NULL,
  m_gateway INT NOT NULL  DEFAULT 0,
  m_name VARCHAR(128) NOT NULL  DEFAULT '',
  m_settings VARCHAR(MAX) NOT NULL  DEFAULT '',
  m_active TINYINT NOT NULL  DEFAULT 0,
  m_position INT NOT NULL  DEFAULT 0,
  PRIMARY KEY  (m_id)
)";

$TABLE[] = "CREATE TABLE nexus_payouts (
  po_id INT IDENTITY NOT NULL,
  po_amount FLOAT NOT NULL,
  po_member INT NOT NULL  DEFAULT 0,
  po_gateway INT NOT NULL  DEFAULT 0,
  po_data VARCHAR(MAX) NOT NULL  DEFAULT '',
  po_status VARCHAR(4) NOT NULL  DEFAULT '',
  po_date INT NOT NULL  DEFAULT 0,
  PRIMARY KEY  (po_id)
)";

$TABLE[] = "CREATE TABLE nexus_product_options (
  opt_id int IDENTITY NOT NULL,
  opt_package int DEFAULT NULL,
  opt_values VARCHAR( MAX ),
  opt_stock int DEFAULT NULL,
  opt_base_price float DEFAULT NULL,
  opt_renew_price float DEFAULT NULL,
  PRIMARY KEY (opt_id)
);";

$TABLE[] = "CREATE TABLE nexus_referral_banners (
rb_id INT IDENTITY NOT NULL PRIMARY KEY ,
rb_url VARCHAR( 255 ) NOT NULL ,
rb_upload TINYINT NOT NULL  DEFAULT 0,
rb_order INT NOT NULL
)";

$TABLE[] = "CREATE TABLE nexus_ship_orders (
o_id INT IDENTITY NOT NULL PRIMARY KEY ,
o_invoice INT NOT NULL  DEFAULT 0,
o_data VARCHAR(MAX) NOT NULL  DEFAULT '',
o_status CHAR(4) NOT NULL ,
o_method INT NOT NULL  DEFAULT 0,
o_items VARCHAR(MAX) NOT NULL  DEFAULT '',
o_date INT NOT NULL  DEFAULT 0,
o_shipped_date INT NOT NULL DEFAULT 0
)";

$TABLE[] = "CREATE TABLE nexus_shipping (
  s_id INT IDENTITY NOT NULL,
  s_name VARCHAR(255) NOT NULL  DEFAULT '',
  s_locations VARCHAR(MAX) NOT NULL DEFAULT '',
  s_type CHAR NOT NULL DEFAULT '',
  s_rates VARCHAR(MAX) NOT NULL DEFAULT '',
  s_tax INT NOT NULL DEFAULT 0,
  s_order INT NOT NULL  DEFAULT 0,
  PRIMARY KEY  (s_id)
)";

$TABLE[] = "CREATE TABLE nexus_paypal_subscriptions (
  s_id VARCHAR(19) NOT NULL ,
  s_items VARCHAR(MAX) NOT NULL  DEFAULT '',
  s_start_trans INT NOT NULL  DEFAULT 0,
  s_method INT NOT NULL  DEFAULT 0,
  PRIMARY KEY ( s_id )
)";

$TABLE[] = "CREATE TABLE nexus_purchases (
  ps_id INT IDENTITY NOT NULL,
  ps_member INT NOT NULL DEFAULT 0,
  ps_name VARCHAR(128) NOT NULL DEFAULT '',
  ps_active TINYINT NOT NULL DEFAULT 1,
  ps_cancelled TINYINT NOT NULL DEFAULT 0,
  ps_start INT NOT NULL DEFAULT 0,
  ps_expire INT NOT NULL DEFAULT 0,
  ps_renewals INT NOT NULL DEFAULT 0,
  ps_renewal_price FLOAT NOT NULL DEFAULT 0,
  ps_renewal_unit CHAR(1) NOT NULL DEFAULT 'm',
  ps_app VARCHAR(255) NOT NULL DEFAULT '',
  ps_type VARCHAR(255) NOT NULL DEFAULT '',
  ps_item_id INT NOT NULL DEFAULT 0,
  ps_item_uri VARCHAR(255) NOT NULL DEFAULT '',
  ps_admin_uri VARCHAR(255) NOT NULL DEFAULT '',
  ps_custom_fields VARCHAR(MAX) NOT NULL DEFAULT '',
  ps_extra VARCHAR(MAX) NOT NULL DEFAULT '',
  ps_parent INT NOT NULL DEFAULT 0,
  ps_invoice_pending TINYINT NOT NULL DEFAULT 0,
  ps_pay_to INT( 8 ) DEFAULT NULL,
  ps_commission INT( 2 ) DEFAULT NULL,
  ps_original_invoice INT( 10 ) NOT NULL DEFAULT 0,
  PRIMARY KEY (ps_id)
)";

$TABLE[] = "CREATE TABLE nexus_referrals (
  member_id INT NOT NULL  DEFAULT 0,
  referred_by INT NOT NULL  DEFAULT 0,
  amount FLOAT NOT NULL,
  PRIMARY KEY  (member_id)
)";

$TABLE[] = "CREATE TABLE nexus_support_departments (
  dpt_id INT IDENTITY NOT NULL,
  dpt_name VARCHAR(255) NOT NULL  DEFAULT '',
  dpt_open TINYINT NOT NULL  DEFAULT 0,
  dpt_require_package TINYINT NOT NULL  DEFAULT 0,
  dpt_packages VARCHAR(MAX) NOT NULL  DEFAULT '',
  dpt_position INT NOT NULL  DEFAULT 0,
  dpt_email VARCHAR(255) NOT NULL  DEFAULT '',
  dpt_notify VARCHAR(MAX) NOT NULL  DEFAULT '',
  dpt_notify_reply TINYINT NOT NULL  DEFAULT 0,
  PRIMARY KEY  (dpt_id)
)";

$TABLE[] = "CREATE TABLE nexus_support_replies (
  reply_id INT IDENTITY NOT NULL,
  reply_request INT NOT NULL  DEFAULT 0,
  reply_member INT NOT NULL  DEFAULT 0,
  reply_type CHAR(1) NOT NULL  DEFAULT '',
  reply_post VARCHAR(MAX) NOT NULL  DEFAULT '',
  reply_hidden TINYINT NOT NULL  DEFAULT 0,
  reply_date INT NOT NULL  DEFAULT 0,
  reply_email VARCHAR(255) NOT NULL  DEFAULT '',
  PRIMARY KEY  (reply_id)
)";

$TABLE[] = "CREATE TABLE nexus_support_requests (
  r_id INT IDENTITY NOT NULL,
  r_title VARCHAR(255) NOT NULL  DEFAULT '',
  r_member INT NOT NULL  DEFAULT 0,
  r_department INT NOT NULL  DEFAULT 0,
  r_purchase INT NOT NULL  DEFAULT 0,
  r_status SMALLINT NOT NULL  DEFAULT 0,
  r_severity int(5) NULL DEFAULT 0,
  r_started INT NOT NULL  DEFAULT 0,
  r_last_reply INT NOT NULL  DEFAULT 0,
  r_last_reply_by INT NOT NULL  DEFAULT 0,
  r_last_new_reply INT NOT NULL  DEFAULT 0,
  r_last_staff_reply INT NOT NULL  DEFAULT 0,
  r_staff INT NOT NULL  DEFAULT 0,
  r_staff_lock INT NOT NULL DEFAULT 0,
  r_replies INT NOT NULL  DEFAULT 0,
  r_notify VARCHAR(MAX) NOT NULL  DEFAULT '',
  r_email VARCHAR(255) NOT NULL  DEFAULT '',
  r_email_key CHAR(3) NOT NULL  DEFAULT '' ,
  PRIMARY KEY  (r_id)
)";

$TABLE[] = "CREATE TABLE nexus_support_severities (
  sev_id int(5) NOT NULL AUTO_INCREMENT,
  sev_name varchar(255) DEFAULT NULL,
  sev_icon varchar(32) DEFAULT NULL,
  sev_color char(6) DEFAULT NULL,
  sev_default tinyint(1) DEFAULT NULL,
  sev_public tinyint(1) DEFAULT NULL,
  sev_position int(5) DEFAULT NULL,
  sev_action varchar(255) DEFAULT NULL,
  PRIMARY KEY (sev_id)
);";

$TABLE[] = "CREATE TABLE nexus_support_staff (
  staff_type CHAR(1) NOT NULL  DEFAULT '',
  staff_id INT NOT NULL  DEFAULT 0,
  staff_departments VARCHAR(MAX) NOT NULL  DEFAULT '',
  PRIMARY KEY (staff_type,staff_id)
)";

$TABLE[] = "CREATE TABLE nexus_support_statuses (
  status_id INT IDENTITY NOT NULL,
  status_name VARCHAR(128) NOT NULL  DEFAULT '',
  status_public_name VARCHAR(128) NOT NULL  DEFAULT '',
  status_public_set VARCHAR(255) NOT NULL  DEFAULT '',
  status_default_member TINYINT NOT NULL  DEFAULT 0,
  status_default_staff TINYINT NOT NULL  DEFAULT 0,
  status_is_locked TINYINT NOT NULL  DEFAULT 0,
  status_assign TINYINT NOT NULL  DEFAULT 0,
  status_position INT NOT NULL  DEFAULT 0,
  status_open TINYINT NOT NULL  DEFAULT 0,
  status_color CHAR(6) NOT NULL  DEFAULT '',
  PRIMARY KEY (status_id)
)";

$TABLE[] = "CREATE TABLE nexus_support_stock_actions (
  action_id INT IDENTITY NOT NULL,
  action_name VARCHAR(255) NOT NULL  DEFAULT '',
  action_department INT NOT NULL  DEFAULT 0,
  action_status INT NOT NULL  DEFAULT 0,
  action_staff INT NOT NULL  DEFAULT 0,
  action_message VARCHAR(MAX) NOT NULL  DEFAULT '',
  action_position INT NOT NULL  DEFAULT 0,
  PRIMARY KEY (action_id)
)";

$TABLE[] = "CREATE TABLE nexus_support_tracker (
  member_id INT NOT NULL  DEFAULT 0,
  request_id INT NOT NULL  DEFAULT 0,
  PRIMARY KEY (member_id,request_id)
)";

$TABLE[] = "CREATE TABLE nexus_tax (
  t_id INT IDENTITY NOT NULL,
  t_name VARCHAR(255) NOT NULL  DEFAULT '',
  t_rate VARCHAR(MAX) NOT NULL  DEFAULT '',
  t_order INT NOT NULL  DEFAULT 0,
  PRIMARY KEY ( t_id )
)";

$TABLE[] = "CREATE TABLE nexus_transactions (
  t_id INT IDENTITY NOT NULL,
  t_member INT NOT NULL DEFAULT 0,
  t_invoice INT NOT NULL DEFAULT 0,
  t_method INT NOT NULL DEFAULT 0,
  t_status CHAR(4) NOT NULL DEFAULT 'pend',
  t_amount FLOAT NOT NULL DEFAULT 0,
  t_date INT NOT NULL DEFAULT 0,
  t_extra VARCHAR(MAX) NOT NULL DEFAULT '',
  PRIMARY KEY  (t_id)
)";

/* Add fields to members */
$INSERT[] = "ALTER TABLE  members ADD  cm_first_name VARCHAR( 64 ) NOT NULL DEFAULT '';";
$INSERT[] = "ALTER TABLE  members ADD  cm_last_name VARCHAR( 64 ) NOT NULL DEFAULT '';";
$INSERT[] = "ALTER TABLE  members ADD  cm_address_1 VARCHAR( 128 ) NOT NULL DEFAULT '';";
$INSERT[] = "ALTER TABLE  members ADD  cm_address_2 VARCHAR( 128 ) NOT NULL DEFAULT '';";
$INSERT[] = "ALTER TABLE  members ADD  cm_city VARCHAR( 64 ) NOT NULL DEFAULT '';";
$INSERT[] = "ALTER TABLE  members ADD  cm_state VARCHAR( 64 ) NOT NULL DEFAULT '';";
$INSERT[] = "ALTER TABLE  members ADD  cm_zip VARCHAR( 12 ) NOT NULL DEFAULT '';";
$INSERT[] = "ALTER TABLE  members ADD  cm_country CHAR( 2 ) NOT NULL DEFAULT '';";
$INSERT[] = "ALTER TABLE  members ADD  cm_phone VARCHAR( 32 ) NOT NULL DEFAULT '';";
$INSERT[] = "ALTER TABLE  members ADD  cm_credits FLOAT NOT NULL DEFAULT 0.0;";
$INSERT[] = "ALTER TABLE  members ADD  cm_reg INT NOT NULL DEFAULT 0";
$INSERT[] = "ALTER TABLE  members ADD  referred_by INT NOT NULL DEFAULT 0;";
$INSERT[] = "ALTER TABLE  members ADD  cm_no_sev tinyint(1) NULL DEFAULT 0;";

/* Add indexes */
$TABLE[] = "CREATE INDEX ad_active ON nexus_ads ( ad_active );";
$TABLE[] = "CREATE INDEX c_code ON nexus_coupons ( c_code );";
$TABLE[] = "CREATE INDEX log_member ON nexus_customer_history ( log_member );";
$TABLE[] = "CREATE INDEX log_date ON nexus_customer_history ( log_date );";
$TABLE[] = "CREATE INDEX d_position ON nexus_donate_goals ( d_position );";
$TABLE[] = "CREATE INDEX g_position ON nexus_gateways ( g_position );";
$TABLE[] = "CREATE INDEX i_member ON nexus_invoices ( i_member );";
$TABLE[] = "CREATE INDEX i_date ON nexus_invoices ( i_date );";
$TABLE[] = "CREATE INDEX i_status ON nexus_invoices ( i_status );";
$TABLE[] = "CREATE INDEX note_member ON nexus_notes ( note_member );";
$TABLE[] = "CREATE INDEX p_position ON nexus_packages ( p_position );";
$TABLE[] = "CREATE INDEX cf_position ON nexus_package_fields ( cf_position );";
$TABLE[] = "CREATE INDEX pg_position ON nexus_package_groups ( pg_position );";
$TABLE[] = "CREATE INDEX pg_parent ON nexus_package_groups ( pg_parent );";
$TABLE[] = "CREATE INDEX m_position ON nexus_paymethods ( m_position );";
$TABLE[] = "CREATE INDEX po_date ON nexus_payouts ( po_date );";
// Check with Mark on this one
$TABLE[] = "CREATE INDEX rb_order ON nexus_referral_banners ( rb_order );";
$TABLE[] = "CREATE INDEX s_order ON nexus_shipping ( s_order );";
// end
$TABLE[] = "CREATE INDEX ps_member ON nexus_purchases ( ps_member );";
$TABLE[] = "CREATE INDEX sort ON nexus_purchases ( ps_cancelled, ps_active, ps_start );";
$TABLE[] = "CREATE INDEX referred_by ON nexus_referrals ( referred_by );";
$TABLE[] = "CREATE INDEX dpt_email ON nexus_support_departments ( dpt_email );";
$TABLE[] = "CREATE INDEX dpt_position ON nexus_support_departments ( dpt_position );";
$TABLE[] = "CREATE INDEX reply_request ON nexus_support_replies ( reply_request );";
$TABLE[] = "CREATE INDEX reply_date ON nexus_support_replies ( reply_date );";
$TABLE[] = "CREATE INDEX r_member ON nexus_support_requests ( r_member );";
$TABLE[] = "CREATE INDEX r_started ON nexus_support_requests ( r_started );";
$TABLE[] = "CREATE INDEX status_position ON nexus_support_statuses ( status_position );";
$TABLE[] = "CREATE INDEX action_position ON nexus_stock_actions ( action_position );";
$TABLE[] = "CREATE INDEX t_order ON nexus_tax ( t_order );";
