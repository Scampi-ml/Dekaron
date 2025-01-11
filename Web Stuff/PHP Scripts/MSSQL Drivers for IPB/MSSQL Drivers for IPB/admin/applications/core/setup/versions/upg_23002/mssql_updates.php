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

$DB->addIndex('topics', 'last_post_sorting', 'last_post,forum_id');
$DB->dropIndex('profile_comments', 'my_comments');

$DB->addIndex('profile_comments', 'my_comments', 'comment_for_member_id,comment_date');
$DB->addIndex('sessions', 'running_time', 'running_time');

$DB->dropField('conf_settings', 'conf_help_key');
