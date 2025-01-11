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

if ( $DB->checkForTable('core_like_cache') )
{
	$SQL[] = "DROP TABLE core_like_cache;";
}

if ( $DB->checkForTable('core_like') )
{
	$SQL[] = "DROP TABLE core_like;";
}

$SQL[] = "CREATE TABLE core_like (
  like_id VARCHAR(32) NOT NULL,
  like_lookup_id VARCHAR(32) DEFAULT NULL,
  like_app VARCHAR(150) NOT NULL DEFAULT '',
  like_area VARCHAR(200) NOT NULL DEFAULT '',
  like_rel_id BIGINT NOT NULL DEFAULT '0',
  like_member_id INT NOT NULL DEFAULT '0',
  like_is_anon INT NOT NULL DEFAULT '0',
  like_added INT NOT NULL DEFAULT '0',
  like_notify_do INT NOT NULL DEFAULT '0',
  like_notify_meta VARCHAR(MAX),
  like_notify_freq VARCHAR(200) NOT NULL DEFAULT '',
  like_notify_sent INT NOT NULL DEFAULT '0',
  PRIMARY KEY (like_id)
);";
$SQL[] = "CREATE TABLE core_like_cache (
  like_cache_id VARCHAR(32) NOT NULL,
  like_cache_app VARCHAR(150) NOT NULL DEFAULT '',
  like_cache_area VARCHAR(200) NOT NULL DEFAULT '',
  like_cache_rel_id BIGINT NOT NULL DEFAULT '0',
  like_cache_data VARCHAR(MAX),
  like_cache_expire INT NOT NULL DEFAULT '0',
  PRIMARY KEY (like_cache_id)
);";

$SQL[] = "CREATE INDEX find_rel_favs ON core_like (like_lookup_id, like_is_anon, like_added);";
$SQL[] = "CREATE INDEX like_member_id ON core_like (like_member_id, like_added);";

