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

$DB = ipsRegistry::DB();

$SQL[] = "UPDATE custom_bbcode SET bbcode_desc='[html]<div class=\"outer\">\n<p>Hello World</p>\n</div>[/html]' where bbcode_tag='html';";

/* Have to add this into 3.0.0 upgrader now, so check here if we're upgrade > 3.0.0 */
if ( ! $DB->checkForField( 'mediatag_position', 'bbcode_mediatag' ) )
{
	$DB->addField( 'bbcode_mediatag', 'mediatag_position', 'INT', "'0'" );
}
