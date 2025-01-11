<?php
/*
+--------------------------------------------------------------------------
|   IP.Board v3.1.4
|   ========================================
|   by Matthew Mecham
|   (c) 2001 - 2004 Invision Power Services
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

$DB->changeField('topic_markers', 'marker_unread', 'marker_unread', 'int', '0');

$SQL[] = "delete from conf_settings where conf_key='csite_search_show';";
$SQL[] = "delete from conf_settings where conf_key='csite_skinchange_show';";

$DB->changeField('forums', 'last_poster_name', 'last_poster_name', 'varchar(255)', '');
$DB->addField('announcements', 'announce_nlbr_enabled', 'tinyint', '0');

$DB->changeField('subscription_trans', 'subtrans_start_date', 'subtrans_start_date', 'varchar(13)', '0');
$DB->changeField('subscription_trans', 'subtrans_end_date', 'subtrans_end_date', 'varchar(13)', '0');

$SQL[] = "CREATE TABLE api_log (
  api_log_id 		int NOT NULL identity,
  api_log_key 		VARCHAR(32) NOT NULL,
  api_log_ip 		VARCHAR(16) NOT NULL,
  api_log_date 		INT NOT NULL,
  api_log_query 	VARCHAR( MAX ) NULL,
  api_log_allowed 	TINYINT NOT NULL,
  PRIMARY KEY  (api_log_id)
);";

$SQL[] = "CREATE TABLE api_users (
  api_user_id		INT NOT NULL identity,
  api_user_key		CHAR(32) NOT NULL,
  api_user_name		VARCHAR(32) NOT NULL,
  api_user_perms 	VARCHAR( MAX ) NULL,
  api_user_ip 		VARCHAR(16) NOT NULL,
  PRIMARY KEY  (api_user_id)
);";

$DB->addField('skin_sets', 'set_protected', 'tinyint', '0');