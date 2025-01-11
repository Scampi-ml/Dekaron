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

# ALTER TOPICS TABLES
$DB->addField( 'topics', 'title_seo', 'VARCHAR(250)', "''" );
$DB->addField( 'topics', 'seo_last_name', 'VARCHAR(255)', "''" );
$DB->addField( 'topics', 'seo_first_name', 'VARCHAR(255)', "''" );
$DB->changeField( 'topics', 'description', 'description', 'VARCHAR(250)', "NULL" );

$DB->addField( 'voters', 'member_choices', 'text' );

$DB->addField( 'polls', 'poll_view_voters', 'int', "'0'" );

$DB->addIndex( 'tracker', 'tm_id', 'topic_id, member_id' );

$DB->addIndex( 'forum_tracker', 'member_id', 'member_id' );
$DB->addIndex( 'forum_tracker', 'fm_id', 'member_id, forum_id' );

