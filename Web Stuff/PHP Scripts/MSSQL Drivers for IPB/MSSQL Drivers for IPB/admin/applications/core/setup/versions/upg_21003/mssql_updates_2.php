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

$DB->dropIndex('topics', 'last_post');
$DB->dropIndex('topics', 'forum_id');
$DB->dropField('topics', 'rating');
$DB->addField('topics', 'topic_open_time', 'int', '0');
$DB->addField('topics', 'topic_close_time', 'int', '0');
$DB->addField('topics', 'topic_rating_total', 'smallint', '0');
$DB->addField('topics', 'topic_rating_hits', 'smallint', '0');
$DB->changeField('topics', 'approved', 'approved', 'tinyint', '0');
$DB->addIndex('topics', 'forum_id', 'forum_id, pinned, approved');
$DB->addIndex('topics', 'last_post', 'forum_id, pinned, last_post');