<?php
/*
+--------------------------------------------------------------------------
|   IP.Board v3.1.4
|   ========================================
|   by Matthew Mecham
|   (c) 2001 - 2009 Invision Power Services
|   http://www.invisionpower.com
|   ========================================
|   Web: http://www.invisionboard.com
|   Email: matt@invisionpower.com
|   Licence Info: http://www.invisionboard.com/?license
+---------------------------------------------------------------------------
*/

$SQL = array();
$DB  = ipsRegistry::DB();
$PRE = ipsRegistry::dbFunctions()->getPrefix();

$SQL[] = "CREATE TABLE mobile_notifications (
  id BIGINT NOT NULL IDENTITY,
  notify_title VARCHAR(MAX) NOT NULL,
  notify_date BIGINT NOT NULL,
  member_id INT NOT NULL,
  notify_sent SMALLINT NOT NULL DEFAULT '0',
  PRIMARY KEY (id)
);";

$DB->addField( 'members', 'ips_mobile_token', 'VARCHAR(64)', '' );





