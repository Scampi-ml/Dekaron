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

$DB->addField('rss_import', 'rss_import_allow_html', 'tinyint', '0');
$DB->changeField('sessions', 'browser', 'browser', 'varchar(200)', '');