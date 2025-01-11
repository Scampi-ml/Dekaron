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
# Nothing of interest!

$DB->dropIndex('sessions', 'in_topic');
$DB->dropIndex('sessions', 'in_forum');
$DB->dropField('sessions', 'in_forum');
$DB->dropField('sessions', 'in_topic');
$DB->addField('sessions', 'location_1_type', 'varchar(10)', '');
$DB->addField('sessions', 'location_1_id', 'int', '0');
$DB->addField('sessions', 'location_2_type', 'varchar(10)', '');
$DB->addField('sessions', 'location_2_id', 'int', '0');
$DB->addField('sessions', 'location_3_type', 'varchar(10)', '');
$DB->addField('sessions', 'location_3_id', 'int', '0');
$DB->addIndex('sessions', 'location1', 'location_1_type,location_1_id');
$DB->addIndex('sessions', 'location2', 'location_2_type,location_2_id');
$DB->addIndex('sessions', 'location3', 'location_3_type,location_3_id');

$DB->addField('forums', 'forum_last_deletion', 'int', '0');
$DB->addField('forums', 'forum_allow_rating', 'tinyint', '0');
$DB->addField('groups', 'g_topic_rate_setting', 'smallint', '0');
$DB->addField('groups', 'g_dname_changes', 'smallint', '0');
$DB->addField('groups', 'g_dname_date', 'int', '0');
$DB->addField('validating', 'user_verified', 'tinyint', '0');
$DB->addField('moderators', 'mod_can_set_open_time', 'tinyint', '0');
$DB->addField('moderators', 'mod_can_set_close_time', 'tinyint', '0');
$DB->addField('task_manager', 'task_locked', 'int', '0');

$DB->addIndex('search_results', 'id', 'id', TRUE);
$DB->addIndex('search_results', 'search_date', 'search_date');