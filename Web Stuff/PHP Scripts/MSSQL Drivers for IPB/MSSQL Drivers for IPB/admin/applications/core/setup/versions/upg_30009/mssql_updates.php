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

# 3.0.2

$SQL = array();
$DB  = ipsRegistry::DB();
$PRE = ipsRegistry::dbFunctions()->getPrefix();

# Bug 17345 Removes unrequired task files
$SQL[] = "DELETE FROM task_manager WHERE task_key IN ('doexpiresubs', 'expiresubs') AND task_application != 'subscriptions';";


$SQL[] = "CREATE TABLE spam_service_log (
  id INT NOT NULL IDENTITY,
  log_date INT NOT NULL DEFAULT '0',
  log_code INT NOT NULL DEFAULT '0',
  log_msg VARCHAR(32) NOT NULL DEFAULT '',
  email_address varchar(255) NOT NULL,
  ip_address VARCHAR(32) NOT NULL DEFAULT '',
  PRIMARY KEY  (id)
);";

?>