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

$DB->dropField( 'admin_logs', 'act' );
$DB->dropField( 'admin_logs', 'code' );

# ALTER LOG TABLES
$DB->addField( 'admin_logs', 'appcomponent', 'varchar(255)', "''" );
$DB->addField( 'admin_logs', 'module', 'varchar(255)', "''" );
$DB->addField( 'admin_logs', 'section', 'varchar(255)', "''" );
$DB->addField( 'admin_logs', 'do', 'varchar(255)', "''" );


$DB->addIndex( 'spider_logs', 'entry_date', 'entry_date' );
$DB->addIndex( 'task_logs', 'log_date', 'log_date' );
$DB->addIndex( 'admin_logs', 'ctime', 'ctime' );
$DB->addIndex( 'moderator_logs', 'ctime', 'ctime' );

$DB->addField( 'bbcode_mediatag', 'mediatag_position', 'INT', "'0'" );
$DB->addField( 'custom_bbcode', 'bbcode_custom_regex', 'varchar(max)' );

