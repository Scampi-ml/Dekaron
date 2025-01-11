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

# 3.0.3

$SQL = array();
$DB  = ipsRegistry::DB();
$PRE = ipsRegistry::dbFunctions()->getPrefix();

$DB->addIndex( 'message_topic_user_map', 'map_topic_id', 'map_topic_id' );

$PRE = trim(ipsRegistry::dbFunctions()->getPrefix());
$DB  = ipsRegistry::DB();

if ( ! $DB->checkForField( 'tag_hidden', 'tags_index' ) )
{
	$DB->addField( 'tags_index', 'tag_hidden', 'INT', '0' );
}


if ( ! $DB->checkForField( 'map_last_topic_reply', 'message_topic_user_map' ) )
{
	$DB->addField( 'message_topic_user_map', 'map_last_topic_reply', 'INT', '0' );
}

// Yes, this looks weird, but the DB driver will prepend the prefix only to the first instance of a table name.
$SQL[] = "UPDATE message_topic_user_map SET [{$PRE}message_topic_user_map].map_last_topic_reply=[{$PRE}message_topics].mt_last_post_time
		 	FROM [{$PRE}message_topic_user_map], [{$PRE}message_topics]
		 	WHERE [{$PRE}message_topic_user_map].map_topic_id=[{$PRE}message_topics].mt_id;";

$SQL[] = "CREATE TABLE core_rss_imported (
	rss_guid			CHAR(32) NOT NULL,
	rss_foreign_id 		INT NOT NULL default '0',
	rss_foreign_key		VARCHAR(100) NOT NULL default '',
	PRIMARY KEY (rss_guid)
);";




