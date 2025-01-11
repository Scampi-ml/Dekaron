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

$DB->addField( 'groups', 'g_mod_post_unit', 'INT', "'0'" );
$DB->addField( 'groups', 'g_ppd_limit', 'INT', "'0'" );
$DB->addField( 'groups', 'g_ppd_unit', 'INT', "'0'" );
$DB->addField( 'groups', 'g_displayname_unit', 'INT', "'0'" );
$DB->addField( 'groups', 'g_sig_unit', 'INT', "'0'" );
$DB->addField( 'groups', 'g_pm_flood_mins', 'INT', "'0'" );

$DB->addField( 'members', 'members_day_posts', 'VARCHAR(32)', "'0,0'" );


$DB->addIndex( 'members', 'members_bitoptions', 'members_bitoptions' );

$DB->addField( 'banfilters', 'ban_nocache', 'INT', "'0'" );
$DB->addIndex( 'banfilters', 'ban_content', 'ban_content' );
$DB->addIndex( 'banfilters', 'ban_nocache', 'ban_nocache' );

$SQL[] = "UPDATE groups SET g_promotion='-1&-1' WHERE g_access_cp=1;";


$DB->addField( 'faq', 'app', 'VARCHAR(32)', "'core'" );


