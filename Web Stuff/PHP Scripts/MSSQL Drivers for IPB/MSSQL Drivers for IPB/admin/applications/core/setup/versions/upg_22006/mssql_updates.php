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

$DB->addField('custom_bbcode', 'bbcode_switch_option', 'tinyint', '0');
$DB->addField('custom_bbcode', 'bbcode_add_into_menu', 'tinyint', '0');
$DB->addField('custom_bbcode', 'bbcode_menu_option_text', 'varchar(200)', '');
$DB->addField('custom_bbcode', 'bbcode_menu_content_text', 'varchar(200)', '');