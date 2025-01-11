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

# CREATE NEW TABLES
$SQL[] = "CREATE TABLE content_cache_posts (
  cache_content_id INT NOT NULL DEFAULT '0',
cache_content VARCHAR( MAX ) NULL,
  cache_updated INT NOT NULL DEFAULT '0'
);";

$SQL[] = "CREATE TABLE content_cache_sigs (
  cache_content_id INT NOT NULL DEFAULT '0',
cache_content VARCHAR( MAX ) NULL,
  cache_updated INT NOT NULL DEFAULT '0'
);";

$SQL[] = "CREATE INDEX cache_content_id ON content_cache_posts ( cache_content_id );";
$SQL[] = "CREATE INDEX date_index ON content_cache_posts ( cache_updated );";
$SQL[] = "CREATE INDEX cache_content_id ON content_cache_sigs ( cache_content_id );";
$SQL[] = "CREATE INDEX date_index ON content_cache_sigs ( cache_updated );";

?>