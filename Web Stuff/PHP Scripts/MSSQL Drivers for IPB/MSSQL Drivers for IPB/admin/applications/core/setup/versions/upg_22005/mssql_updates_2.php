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
$DB  = ipsRegistry::DB();
$PRE = ipsRegistry::dbFunctions()->getPrefix();

# Nothing of interest!

$DB->dropIndex( "posts", "topic_id" );
$SQL[]="ALTER TABLE posts ADD post_edit_reason VARCHAR(255) NOT NULL CONSTRAINT DF_post_edit_reason DEFAULT '' WITH VALUES;";

$SQL[]="CREATE INDEX topic_id ON posts( topic_id , queued , pid , post_date );";
$SQL[]="CREATE INDEX post_key ON posts( post_key );";
$SQL[]="CREATE INDEX ip_address ON posts( ip_address );";

$SQL[]="CREATE INDEX starter_id ON topics( starter_id, forum_id, approved );";

