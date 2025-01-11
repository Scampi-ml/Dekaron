<?php
/**
* Installation Schematic File
* Generated on Wed, 30 Sep 2009 08:00:42 +0000 GMT
*/
$PRE = trim( ipsRegistry::dbFunctions()->getPrefix() );

/* Ensure this doesn't get run if we're checking diagnostics */
if ( $this->request['module']  != 'diagnostics' AND $this->request['section'] != 'diagnostics' )
{ 
	/* Ok, so did we do an upgrade? If so we have these tables */
	if ( ipsRegistry::DB()->checkForTable( 'subscription_trans' ) )
	{
		/* Do nothing */
		$TABLE = array();
		
		/* Upgrade from 2.0.0 tables */
		if ( ! ipsRegistry::DB()->checkForField( 'submethod_sandbox', 'subscription_methods' ) )
		{ 
			ipsRegistry::DB()->addField( 'subscription_methods', 'submethod_sandbox', 'INT', '0' );
			ipsRegistry::DB()->addField( 'subscription_methods', 'submethod_debug_email', 'VARCHAR(255)', "''" );
			ipsRegistry::DB()->addField( 'subscription_methods', 'submethod_debug_all', 'INT', "'0'" );
			
			ipsRegistry::DB()->addField( 'subscriptions', 'sub_show_on_reg', 'INT', "'1'" );
			ipsRegistry::DB()->addField( 'subscriptions', 'sub_change_primary', 'INT', "'1'" );
			
			ipsRegistry::DB()->addIndex( 'subscription_logs', 'sublog_member_id', 'sublog_member_id' );
			
			ipsRegistry::DB()->addField( 'subscription_trans', 'subtrans_recurring', 'INT', "'0'" );
			ipsRegistry::DB()->addField( 'subscriptions', 'sub_currency', 'VARCHAR(10)', "''" );
			ipsRegistry::DB()->addField( 'subscription_trans', 'subtrans_to_pay', 'DECIMAL(10,2)', "'0.00'" );
			
			ipsRegistry::DB()->query("UPDATE {$PRE}subscriptions SET sub_currency='USD' WHERE sub_currency='';");
			
			ipsRegistry::DB()->addField( 'subscriptions', 'sub_renew_days', 'INT', "'0'" );
			
			ipsRegistry::DB()->addField( 'subscription_trans', 'subtrans_is_renewing', 'INT', "'0'" );
			ipsRegistry::DB()->query("UPDATE {$PRE}subscription_methods SET submethod_title='SagePay', submethod_name='sagepay' WHERE submethod_name='protx'");
		}
	
		return;
	}
}

$TABLE[] = "CREATE TABLE subscription_currency (
  subcurrency_code VARCHAR(10) NOT NULL DEFAULT '',
  subcurrency_desc VARCHAR(250) NOT NULL DEFAULT '',
  subcurrency_exchange decimal(16,8) NOT NULL DEFAULT '0.00000000',
  subcurrency_default TINYINT NOT NULL DEFAULT '0',
  PRIMARY KEY (subcurrency_code)
);";
$TABLE[] = "CREATE TABLE subscription_extra (
  subextra_id SMALLINT NOT NULL IDENTITY,
  subextra_sub_id SMALLINT NOT NULL DEFAULT '0',
  subextra_method_id SMALLINT NOT NULL DEFAULT '0',
  subextra_product_id VARCHAR(250) NOT NULL DEFAULT '0',
  subextra_can_upgrade TINYINT NOT NULL DEFAULT '0',
  subextra_recurring TINYINT NOT NULL DEFAULT '0',
subextra_custom_1 TEXT NULL,
subextra_custom_2 TEXT NULL,
subextra_custom_3 TEXT NULL,
subextra_custom_4 TEXT NULL,
subextra_custom_5 TEXT NULL,
  PRIMARY KEY (subextra_id)
);";
$TABLE[] = "CREATE TABLE subscription_logs (
  sublog_id INT NOT NULL IDENTITY,
  sublog_date INT NOT NULL DEFAULT '0',
  sublog_member_id INT NOT NULL DEFAULT '0',
  sublog_transid INT NOT NULL DEFAULT '0',
  sublog_ipaddress VARCHAR(16) NOT NULL DEFAULT '',
sublog_data TEXT NULL,
sublog_postdata TEXT NULL,
  PRIMARY KEY (sublog_id)
);";
$TABLE[] = "CREATE TABLE subscription_methods (
  submethod_id SMALLINT NOT NULL IDENTITY,
  submethod_title VARCHAR(250) NOT NULL DEFAULT '',
  submethod_name VARCHAR(20) NOT NULL DEFAULT '',
  submethod_email VARCHAR(250) NOT NULL DEFAULT '',
submethod_sid TEXT NULL,
submethod_custom_1 TEXT NULL,
submethod_custom_2 TEXT NULL,
submethod_custom_3 TEXT NULL,
submethod_custom_4 TEXT NULL,
submethod_custom_5 TEXT NULL,
  submethod_is_cc TINYINT NOT NULL DEFAULT '0',
  submethod_is_auto TINYINT NOT NULL DEFAULT '0',
submethod_desc TEXT NULL,
submethod_logo TEXT NULL,
  submethod_active TINYINT NOT NULL DEFAULT '0',
  submethod_use_currency VARCHAR(10) NOT NULL DEFAULT 'USD',
  submethod_sandbox INT NOT NULL DEFAULT '0',
  submethod_debug_email VARCHAR(255) NOT NULL DEFAULT '',
  submethod_debug_all INT NOT NULL DEFAULT '0',
  PRIMARY KEY (submethod_id)
);";

$TABLE[] = "CREATE TABLE subscription_trans (
  subtrans_id INT NOT NULL IDENTITY,
  subtrans_sub_id SMALLINT NOT NULL DEFAULT '0',
  subtrans_member_id INT NOT NULL DEFAULT '0',
  subtrans_old_group SMALLINT NOT NULL DEFAULT '0',
  subtrans_paid decimal(10,2) NOT NULL DEFAULT '0.00',
  subtrans_cumulative decimal(10,2) NOT NULL DEFAULT '0.00',
  subtrans_method VARCHAR(20) NOT NULL DEFAULT '',
  subtrans_start_date VARCHAR(13) NOT NULL DEFAULT '0',
  subtrans_end_date VARCHAR(13) NOT NULL DEFAULT '0',
  subtrans_state VARCHAR(200) NOT NULL DEFAULT '',
  subtrans_trxid VARCHAR(200) NOT NULL DEFAULT '',
  subtrans_subscrid VARCHAR(200) NOT NULL DEFAULT '',
  subtrans_currency VARCHAR(10) NOT NULL DEFAULT 'USD',
  subtrans_recurring INT NOT NULL DEFAULT '0',
  subtrans_to_pay decimal(10,2) NOT NULL DEFAULT '0.00',
  subtrans_is_renewing INT NOT NULL DEFAULT '0',
  PRIMARY KEY (subtrans_id)
);";
$TABLE[] = "CREATE TABLE subscriptions (
  sub_id SMALLINT NOT NULL IDENTITY,
  sub_title VARCHAR(250) NOT NULL DEFAULT '',
sub_desc TEXT NULL,
  sub_new_group INT NOT NULL DEFAULT '0',
  sub_length SMALLINT NOT NULL DEFAULT '1',
  sub_unit char(2) NOT NULL DEFAULT 'm',
  sub_cost decimal(10,2) NOT NULL DEFAULT '0.00',
  sub_run_module VARCHAR(250) NOT NULL DEFAULT '',
  sub_show_on_reg INT NOT NULL DEFAULT '1',
  sub_change_primary INT NOT NULL DEFAULT '1',
  sub_currency VARCHAR(10) NOT NULL DEFAULT '',
  sub_renew_days INT NOT NULL DEFAULT '0',
  PRIMARY KEY (sub_id)
);";
$TABLE[] = "CREATE INDEX sublog_member_id ON subscription_logs ( sublog_member_id );";
$TABLE[] = "CREATE INDEX gateway_name ON subscription_payment_gateways ( gateway_name );";
$TABLE[] = "CREATE INDEX gateway_active ON subscription_payment_gateways ( gateway_active );";

