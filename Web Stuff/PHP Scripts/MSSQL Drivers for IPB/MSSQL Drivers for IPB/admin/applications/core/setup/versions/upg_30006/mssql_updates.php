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

# RC 2

$DB->changeField( 'forums', 'last_poster_name', 'last_poster_name', 'VARCHAR(255)' );

$DB->changeField( 'error_logs', 'log_error_code', 'log_error_code', 'VARCHAR(24)' );

$DB->dropIndex( 'tracker', 'tm_id' );
$DB->addIndex( 'tracker', 'tm_id', 'member_id,topic_id' );

$DB->dropIndex( 'forum_tracker', 'fm_id' );
$DB->addIndex( 'forum_tracker', 'fm_id', 'forum_id' );

$DB->changeField( 'topics', 'starter_name', 'starter_name', 'VARCHAR(255)' );
$DB->changeField( 'topics', 'last_poster_name', 'last_poster_name', 'VARCHAR(255)' );


?>