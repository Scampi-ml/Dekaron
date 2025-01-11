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

$DB->addIndex( 'topics', 'start_date', 'start_date' );

if ( ! $DB->checkForField( 'map_last_topic_reply', 'message_topic_user_map' ) )
{
	$DB->addField( 'message_topic_user_map', 'map_last_topic_reply', 'INT', "'0'" );
}

ipsRegistry::dbFunctions()->prefix_changed = true;

$DB->query("UPDATE [{$PRE}message_topic_user_map] SET [{$PRE}message_topic_user_map].map_last_topic_reply=[{$PRE}message_topics].mt_last_post_time
		 	FROM [{$PRE}message_topic_user_map], [{$PRE}message_topics]
		 	WHERE [{$PRE}message_topic_user_map].map_topic_id=[{$PRE}message_topics].mt_id;");

ipsRegistry::dbFunctions()->prefix_changed = false;

$DB->changeField( 'core_sys_module', 'sys_module_version', 'sys_module_version', 'VARCHAR(32)' );

$DB->changeField( 'core_sys_lang_words', 'word_js', 'word_js', 'TINYINT', "'0'" );

$SQL[] = "UPDATE core_sys_conf_settings SET conf_value=conf_default WHERE conf_key='links_external' AND conf_value LIKE '';";

$DB->changeField( 'members', 'fb_uid', 'fb_uid', 'BIGINT', "'0'" );

$SQL[] = "delete from core_sys_conf_settings where conf_key='spider_suit';";

$SQL[] = "DELETE FROM core_sys_conf_settings WHERE conf_key='c_cache_days';";

$SQL[] = "update profile_portal set pp_setting_count_friends = 1 where pp_setting_count_friends > 0;";
$SQL[] = "update profile_portal set pp_setting_count_comments = 1 where pp_setting_count_comments > 0;";

/* Media tag */
$tag = $DB->buildAndFetch( array( 'select' => '*',
								  'from'   => 'bbcode_mediatag',
								  'where'  => "mediatag_replace LIKE '%webjay.org%'" ) );
								  
if ( $tag['mediatag_id'] )
{
	$DB->update( 'bbcode_mediatag',
		array( 'mediatag_replace' => '<object type="application/x-shockwave-flash" data="{board_url}/public/mp3player.swf" width="300" height="40"><param name="movie" value="{board_url}/public/mp3player.swf" /><param name="FlashVars" value="mp3=$1.mp3&autoplay=1&loop=0&volume=100&showstop=1&showinfo=0" /></object>'),
		'mediatag_id=' . $tag['mediatag_id'] );
}



