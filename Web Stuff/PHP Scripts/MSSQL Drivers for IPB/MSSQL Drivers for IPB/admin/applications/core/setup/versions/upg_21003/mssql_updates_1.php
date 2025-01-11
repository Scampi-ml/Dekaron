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
$DB->addField('members', 'members_auto_dst', 'tinyint', '1');
$DB->addField('members', 'members_cache', 'text', '');
$DB->addField('members', 'members_disable_pm', 'tinyint', '0');
$DB->addField('members', 'members_display_name', 'varchar(255)', '');
$DB->addField('members', 'members_created_remote', 'tinyint', '0');
$DB->addField('members', 'members_editor_choice', 'varchar(3)', 'std');
$DB->addField('members', 'members_markers', 'text', '');
$SQL[] = "UPDATE members SET members_display_name=name";
$DB->addIndex('members', 'members_display_name', 'members_display_name');
$DB->addField('message_text', 'msg_ip_address', 'varchar(16)', '0');