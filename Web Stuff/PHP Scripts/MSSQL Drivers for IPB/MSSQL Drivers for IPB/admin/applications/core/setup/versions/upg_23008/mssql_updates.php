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

$DB->addField('profile_portal', 'pp_about_me', 'VARCHAR( MAX )');
$DB->changeField('moderator_logs', 'topic_title', 'topic_title', 'varchar(255)');
$DB->changeField('moderator_logs', 'query_string', 'query_string', 'varchar(255)');

$SQL[] = "UPDATE cal_events SET event_unix_from= (event_unix_from - (event_tz * 2)) WHERE event_timeset != '0';";