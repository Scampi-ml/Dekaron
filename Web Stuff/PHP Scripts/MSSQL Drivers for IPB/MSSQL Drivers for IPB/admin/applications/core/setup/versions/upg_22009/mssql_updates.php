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


# Nothing of interest!

$SQL = array();
$DB  = ipsRegistry::DB();
$PRE = ipsRegistry::dbFunctions()->getPrefix();

$SQL[] = "DELETE FROM conf_settings WHERE conf_key='converge_login_method'";

$DB->changeField('member_extra', 'avatar_location', 'avatar_location', 'varchar(255)', '');
$DB->addField('cal_events', 'event_all_day', 'tinyint', '0');