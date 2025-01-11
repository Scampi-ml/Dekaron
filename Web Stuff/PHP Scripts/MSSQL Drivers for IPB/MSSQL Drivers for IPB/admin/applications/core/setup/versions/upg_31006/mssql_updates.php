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

if ( $DB->checkForTable( 'cal_events' ) )
{
	if ( $dropsql = $DB->_sql_get_dropdefault_constraint( 'cal_events', 'event_tz' ) )
	{
		$SQL[] = $dropsql;
	}
	$SQL[] = "ALTER TABLE cal_events ALTER COLUMN event_tz VARCHAR( 4 ) NOT NULL";
	$SQL[] = "ALTER TABLE cal_events ADD DEFAULT ('0') FOR event_tz WITH VALUES";
}

$SQL[] = "ALTER TABLE pfields_data ADD pf_filtering TINYINT NOT NULL DEFAULT '0'";

if ( $dropsql = $DB->_sql_get_dropprimary_key( 'mobile_notifications' ) )
{
	$SQL[] = $dropsql;
}

if ( $DB->checkForIndex( 'friends_member_id', 'profile_friends' ) ) $DB->dropIndex( 'profile_friends', 'friends_member_id' );
if ( $DB->checkForIndex( 'status_member_id', 'member_status_updates' ) ) $DB->dropIndex( 'member_status_updates', 'status_member_id' );
if ( $DB->checkForIndex( 'friends_member_id', 'profile_friends_flood' ) ) $DB->dropIndex( 'profile_friends_flood', 'friends_member_id' );
if ( $DB->checkForIndex( 'sys_module_parent', 'core_sys_module' ) ) $DB->dropIndex( 'core_sys_module', 'sys_module_parent' );
if ( $DB->checkForIndex( 'attach_where', 'attachments' ) ) $DB->dropIndex( 'attachments', 'attach_where' );

if ( $dropsql = $DB->_sql_get_dropdefault_constraint( 'moderator_logs', 'topic_title' ) )
{
	$SQL[] = $dropsql;
}
$SQL[] = "ALTER TABLE moderator_logs ALTER COLUMN topic_title VARCHAR( MAX ) NULL;";

if ( $dropsql = $DB->_sql_get_dropdefault_constraint( 'moderator_logs', 'query_string' ) )
{
	$SQL[] = $dropsql;
}
$SQL[] = "ALTER TABLE moderator_logs ALTER COLUMN query_string VARCHAR ( MAX ) NULL;";

if ( $dropsql = $DB->_sql_get_dropdefault_constraint( 'moderator_logs', 'http_referer' ) )
{
	$SQL[] = $dropsql;
}
$SQL[] = "ALTER TABLE moderator_logs ALTER COLUMN http_referer VARCHAR ( MAX ) NULL;";

if ( $dropsql = $DB->_sql_get_dropdefault_constraint( 'moderator_logs', 'action' ) )
{
	$SQL[] = $dropsql;
}
$SQL[] = "ALTER TABLE moderator_logs ALTER COLUMN action VARCHAR ( MAX ) NULL;";

$SQL[] = "CREATE INDEX views_member_id ON profile_portal_views ( views_member_id );";
$SQL[] = "CREATE INDEX views_tid ON topic_views ( views_tid );";
$SQL[] = "DELETE FROM core_sys_conf_settings WHERE conf_key='acp_tutorial_mode';";
$SQL[] = "UPDATE skin_templates SET template_data='\$required_output='''',\$optional_output='''',\$day='''',\$mon='''',\$year=''''' WHERE template_name='membersProfileForm';";

//-----------------------------------------
// Remove unused tables
//-----------------------------------------

if( $DB->checkForTable('facebook_oauth_temp') )
{
	$SQL[] = "DROP TABLE facebook_oauth_temp;";
}

if( $DB->checkForTable('search_index') )
{
	$SQL[] = "DROP TABLE search_index;";
}

if( $DB->checkForTable('templates_diff_import') )
{
	$SQL[] = "DROP TABLE templates_diff_import;";
}

if( $DB->checkForTable('template_diff_changes') )
{
	$SQL[] = "DROP TABLE template_diff_changes;";
}

if( $DB->checkForTable('template_diff_session') )
{
	$SQL[] = "DROP TABLE template_diff_session;";
}

//-----------------------------------------
// And unused columns *sigh*
// Fun fact:
// Matt said: YES - and all below apart from that massive ALTER list and Im not touching that. :p so there
//-----------------------------------------

if( $DB->checkForField( 'attach_approved', 'attachments' ) )
{
	if ( $dropsql = $DB->_sql_get_dropdefault_constraint( 'attachments', 'attach_approved' ) )
	{
		$SQL[] = $dropsql;
	}
	$SQL[] = "ALTER TABLE attachments DROP COLUMN attach_approved;";
}

if( $DB->checkForField( 'attach_temp', 'attachments' ) )
{
	if ( $dropsql = $DB->_sql_get_dropdefault_constraint( 'attachments', 'attach_temp' ) )
	{
		$SQL[] = $dropsql;
	}
	$SQL[] = "ALTER TABLE attachments DROP COLUMN attach_temp;";
}

if( $DB->checkForField( 'mail_honor', 'bulk_mail' ) )
{
	if ( $dropsql = $DB->_sql_get_dropdefault_constraint( 'bulk_mail', 'mail_honor' ) )
	{
		$SQL[] = $dropsql;
	}
	$SQL[] = "ALTER TABLE bulk_mail DROP COLUMN mail_honor;";
}

if( $DB->checkForField( 'rss_foreign_id', 'core_rss_imported' ) )
{
	if ( $dropsql = $DB->_sql_get_dropdefault_constraint( 'core_rss_imported', 'rss_foreign_id' ) )
	{
		$SQL[] = $dropsql;
	}
	$SQL[] = "ALTER TABLE core_rss_imported DROP COLUMN rss_foreign_id;";
}

if( $DB->checkForField( 'share_url', 'core_share_links' ) )
{
	if ( $dropsql = $DB->_sql_get_dropdefault_constraint( 'core_share_links', 'share_url' ) )
	{
		$SQL[] = $dropsql;
	}
	$SQL[] = "ALTER TABLE core_share_links DROP COLUMN share_url;";
}

if( $DB->checkForField( 'share_markup', 'core_share_links' ) )
{
	if ( $dropsql = $DB->_sql_get_dropdefault_constraint( 'core_share_links', 'share_markup' ) )
	{
		$SQL[] = $dropsql;
	}
	$SQL[] = "ALTER TABLE core_share_links DROP COLUMN share_markup;";
}

if( $DB->checkForField( 'conf_end_group', 'core_sys_conf_settings' ) )
{
	if ( $dropsql = $DB->_sql_get_dropdefault_constraint( 'core_sys_conf_settings', 'conf_end_group' ) )
	{
		$SQL[] = $dropsql;
	}
	$SQL[] = "ALTER TABLE core_sys_conf_settings DROP COLUMN conf_end_group;";
}

if( $DB->checkForField( 'lang_currency_symbol', 'core_sys_lang' ) )
{
	if ( $dropsql = $DB->_sql_get_dropdefault_constraint( 'core_sys_lang', 'lang_currency_symbol' ) )
	{
		$SQL[] = $dropsql;
	}
	$SQL[] = "ALTER TABLE core_sys_lang DROP COLUMN lang_currency_symbol;";
}

if( $DB->checkForField( 'lang_decimal', 'core_sys_lang' ) )
{
	if ( $dropsql = $DB->_sql_get_dropdefault_constraint( 'core_sys_lang', 'lang_decimal' ) )
	{
		$SQL[] = $dropsql;
	}
	$SQL[] = "ALTER TABLE core_sys_lang DROP COLUMN lang_decimal;";
}

if( $DB->checkForField( 'lang_comma', 'core_sys_lang' ) )
{
	if ( $dropsql = $DB->_sql_get_dropdefault_constraint( 'core_sys_lang', 'lang_comma' ) )
	{
		$SQL[] = $dropsql;
	}
	$SQL[] = "ALTER TABLE core_sys_lang DROP COLUMN lang_comma;";
}

if( $DB->checkForField( 'sys_login_skin', 'core_sys_login' ) )
{
	if ( $dropsql = $DB->_sql_get_dropdefault_constraint( 'core_sys_login', 'sys_login_skin' ) )
	{
		$SQL[] = $dropsql;
	}
	$SQL[] = "ALTER TABLE core_sys_login DROP COLUMN sys_login_skin;";
}

if( $DB->checkForField( 'sys_login_language', 'core_sys_login' ) )
{
	if ( $dropsql = $DB->_sql_get_dropdefault_constraint( 'core_sys_login', 'sys_login_language' ) )
	{
		$SQL[] = $dropsql;
	}
	$SQL[] = "ALTER TABLE core_sys_login DROP COLUMN sys_login_language;";
}

if( $DB->checkForField( 'sys_login_last_visit', 'core_sys_login' ) )
{
	if ( $dropsql = $DB->_sql_get_dropdefault_constraint( 'core_sys_login', 'sys_login_last_visit' ) )
	{
		$SQL[] = $dropsql;
	}
	$SQL[] = "ALTER TABLE core_sys_login DROP COLUMN sys_login_last_visit;";
}

if( $DB->checkForField( 'sys_module_parent', 'core_sys_module' ) )
{
	if ( $dropsql = $DB->_sql_get_dropdefault_constraint( 'core_sys_module', 'sys_module_parent' ) )
	{
		$SQL[] = $dropsql;
	}
	$SQL[] = "ALTER TABLE core_sys_module DROP COLUMN sys_module_parent;";
}

if( $DB->checkForField( 'sys_module_tables', 'core_sys_module' ) )
{
	if ( $dropsql = $DB->_sql_get_dropdefault_constraint( 'core_sys_module', 'sys_module_tables' ) )
	{
		$SQL[] = $dropsql;
	}
	$SQL[] = "ALTER TABLE core_sys_module DROP COLUMN sys_module_tables;";
}

if( $DB->checkForField( 'sys_module_hooks', 'core_sys_module' ) )
{
	if ( $dropsql = $DB->_sql_get_dropdefault_constraint( 'core_sys_module', 'sys_module_hooks' ) )
	{
		$SQL[] = $dropsql;
	}
	$SQL[] = "ALTER TABLE core_sys_module DROP COLUMN sys_module_hooks;";
}

if( $DB->checkForField( 'conf_title_module', 'core_sys_settings_titles' ) )
{
	if ( $dropsql = $DB->_sql_get_dropdefault_constraint( 'core_sys_settings_titles', 'conf_title_module' ) )
	{
		$SQL[] = $dropsql;
	}
	$SQL[] = "ALTER TABLE core_sys_settings_titles DROP COLUMN conf_title_module;";
}

if( $DB->checkForField( 'bbcode_parse', 'custom_bbcode' ) )
{
	if ( $dropsql = $DB->_sql_get_dropdefault_constraint( 'custom_bbcode', 'bbcode_parse' ) )
	{
		$SQL[] = $dropsql;
	}
	$SQL[] = "ALTER TABLE custom_bbcode DROP COLUMN bbcode_parse;";
}

if( $DB->checkForField( 'topic_id', 'email_logs' ) )
{
	if ( $dropsql = $DB->_sql_get_dropdefault_constraint( 'email_logs', 'topic_id' ) )
	{
		$SQL[] = $dropsql;
	}
	$SQL[] = "ALTER TABLE email_logs DROP COLUMN topic_id;";
}

if( $DB->checkForField( 'redirect_loc', 'forums' ) )
{
	if ( $dropsql = $DB->_sql_get_dropdefault_constraint( 'forums', 'redirect_loc' ) )
	{
		$SQL[] = $dropsql;
	}
	$SQL[] = "ALTER TABLE forums DROP COLUMN redirect_loc;";
}

if( $DB->checkForField( 'topic_mm_id', 'forums' ) )
{
	if ( $dropsql = $DB->_sql_get_dropdefault_constraint( 'forums', 'topic_mm_id' ) )
	{
		$SQL[] = $dropsql;
	}
	$SQL[] = "ALTER TABLE forums DROP COLUMN topic_mm_id;";
}

if( $DB->checkForField( 'permission_array', 'forums' ) )
{
	if ( $dropsql = $DB->_sql_get_dropdefault_constraint( 'forums', 'permission_array' ) )
	{
		$SQL[] = $dropsql;
	}
	$SQL[] = "ALTER TABLE forums DROP COLUMN permission_array;";
}

if( $DB->checkForField( 'g_invite_friend', 'groups' ) )
{
	if ( $dropsql = $DB->_sql_get_dropdefault_constraint( 'groups', 'g_invite_friend' ) )
	{
		$SQL[] = $dropsql;
	}
	$SQL[] = "ALTER TABLE groups DROP COLUMN g_invite_friend;";
}

if( $DB->checkForField( 'g_can_remove', 'groups' ) )
{
	if ( $dropsql = $DB->_sql_get_dropdefault_constraint( 'groups', 'g_can_remove' ) )
	{
		$SQL[] = $dropsql;
	}
	$SQL[] = "ALTER TABLE groups DROP COLUMN g_can_remove;";
}

if( $DB->checkForField( 'login_date', 'login_methods' ) )
{
	if ( $dropsql = $DB->_sql_get_dropdefault_constraint( 'login_methods', 'login_date' ) )
	{
		$SQL[] = $dropsql;
	}
	$SQL[] = "ALTER TABLE login_methods DROP COLUMN login_date;";
}

if( $DB->checkForField( 'mail_type', 'mail_queue' ) )
{
	if ( $dropsql = $DB->_sql_get_dropdefault_constraint( 'mail_queue', 'mail_type' ) )
	{
		$SQL[] = $dropsql;
	}
	$SQL[] = "ALTER TABLE mail_queue DROP COLUMN mail_type;";
}

if( $DB->checkForField( 'edit_user', 'moderators' ) )
{
	if ( $dropsql = $DB->_sql_get_dropdefault_constraint( 'moderators', 'edit_user' ) )
	{
		$SQL[] = $dropsql;
	}
	$SQL[] = "ALTER TABLE moderators DROP COLUMN edit_user;";
}

if( $DB->checkForField( 'rating_added', 'profile_ratings' ) )
{
	if ( $dropsql = $DB->_sql_get_dropdefault_constraint( 'profile_ratings', 'rating_added' ) )
	{
		$SQL[] = $dropsql;
	}
	$SQL[] = "ALTER TABLE profile_ratings DROP COLUMN rating_added;";
}

if( $DB->checkForField( 'misc', 'reputation_index' ) )
{
	if ( $dropsql = $DB->_sql_get_dropdefault_constraint( 'reputation_index', 'misc' ) )
	{
		$SQL[] = $dropsql;
	}
	$SQL[] = "ALTER TABLE reputation_index DROP COLUMN misc;";
}

if( $DB->checkForField( 'pp_profile_update', 'profile_portal' ) )
{
	if ( $dropsql = $DB->_sql_get_dropdefault_constraint( 'profile_portal', 'pp_profile_update' ) )
	{
		$SQL[] = $dropsql;
	}
	$SQL[] = "ALTER TABLE profile_portal DROP COLUMN pp_profile_update;";
}

if( $DB->checkForField( 'pp_bio_content', 'profile_portal' ) )
{
	if ( $dropsql = $DB->_sql_get_dropdefault_constraint( 'profile_portal', 'pp_bio_content' ) )
	{
		$SQL[] = $dropsql;
	}
	$SQL[] = "ALTER TABLE profile_portal DROP COLUMN pp_bio_content;";
}

if( $DB->checkForField( 'pp_comment_count', 'profile_portal' ) )
{
	if ( $dropsql = $DB->_sql_get_dropdefault_constraint( 'profile_portal', 'pp_comment_count' ) )
	{
		$SQL[] = $dropsql;
	}
	$SQL[] = "ALTER TABLE profile_portal DROP COLUMN pp_comment_count;";
}

if( $DB->checkForField( 'pp_setting_notify_comments', 'profile_portal' ) )
{
	if ( $dropsql = $DB->_sql_get_dropdefault_constraint( 'profile_portal', 'pp_setting_notify_comments' ) )
	{
		$SQL[] = $dropsql;
	}
	$SQL[] = "ALTER TABLE profile_portal DROP COLUMN pp_setting_notify_comments;";
}

if( $DB->checkForField( 'pp_setting_notify_friend', 'profile_portal' ) )
{
	if ( $dropsql = $DB->_sql_get_dropdefault_constraint( 'profile_portal', 'pp_setting_notify_friend' ) )
	{
		$SQL[] = $dropsql;
	}
	$SQL[] = "ALTER TABLE profile_portal DROP COLUMN pp_setting_notify_friend;";
}

if( $DB->checkForField( 'pp_friend_count', 'profile_portal' ) )
{
	if ( $dropsql = $DB->_sql_get_dropdefault_constraint( 'profile_portal', 'pp_friend_count' ) )
	{
		$SQL[] = $dropsql;
	}
	$SQL[] = "ALTER TABLE profile_portal DROP COLUMN pp_friend_count;";
}

if( $DB->checkForField( 'pp_gender', 'profile_portal' ) )
{
	if ( $dropsql = $DB->_sql_get_dropdefault_constraint( 'profile_portal', 'pp_gender' ) )
	{
		$SQL[] = $dropsql;
	}
	$SQL[] = "ALTER TABLE profile_portal DROP COLUMN pp_gender;";
}

if( $DB->checkForField( 'pp_profile_views', 'profile_portal' ) )
{
	if ( $dropsql = $DB->_sql_get_dropdefault_constraint( 'profile_portal', 'pp_profile_views' ) )
	{
		$SQL[] = $dropsql;
	}
	$SQL[] = "ALTER TABLE profile_portal DROP COLUMN pp_profile_views;";
}

if( $DB->checkForField( 'links', 'profile_portal' ) )
{
	if ( $dropsql = $DB->_sql_get_dropdefault_constraint( 'profile_portal', 'links' ) )
	{
		$SQL[] = $dropsql;
	}
	$SQL[] = "ALTER TABLE profile_portal DROP COLUMN links;";
}

if( $DB->checkForField( 'bio', 'profile_portal' ) )
{
	if ( $dropsql = $DB->_sql_get_dropdefault_constraint( 'profile_portal', 'bio' ) )
	{
		$SQL[] = $dropsql;
	}
	$SQL[] = "ALTER TABLE profile_portal DROP COLUMN bio;";
}

if( $DB->checkForField( 'ta_size', 'profile_portal' ) )
{
	if ( $dropsql = $DB->_sql_get_dropdefault_constraint( 'profile_portal', 'ta_size' ) )
	{
		$SQL[] = $dropsql;
	}
	$SQL[] = "ALTER TABLE profile_portal DROP COLUMN ta_size;";
}

if( $DB->checkForField( 'fb_status', 'profile_portal' ) )
{
	if ( $dropsql = $DB->_sql_get_dropdefault_constraint( 'profile_portal', 'fb_status' ) )
	{
		$SQL[] = $dropsql;
	}
	$SQL[] = "ALTER TABLE profile_portal DROP COLUMN fb_status;";
}

if( $DB->checkForField( 'pp_status', 'profile_portal' ) )
{
	if ( $dropsql = $DB->_sql_get_dropdefault_constraint( 'profile_portal', 'pp_status' ) )
	{
		$SQL[] = $dropsql;
	}
	$SQL[] = "ALTER TABLE profile_portal DROP COLUMN pp_status;";
}

if( $DB->checkForField( 'pp_status_update', 'profile_portal' ) )
{
	if ( $dropsql = $DB->_sql_get_dropdefault_constraint( 'profile_portal', 'pp_status_update' ) )
	{
		$SQL[] = $dropsql;
	}
	$SQL[] = "ALTER TABLE profile_portal DROP COLUMN pp_status_update;";
}

if( $DB->checkForField( 'max_points', 'rc_modpref' ) )
{
	if ( $dropsql = $DB->_sql_get_dropdefault_constraint( 'rc_modpref', 'max_points' ) )
	{
		$SQL[] = $dropsql;
	}
	$SQL[] = "ALTER TABLE rc_modpref DROP COLUMN max_points;";
}

if( $DB->checkForField( 'reports_pp', 'rc_modpref' ) )
{
	if ( $dropsql = $DB->_sql_get_dropdefault_constraint( 'rc_modpref', 'reports_pp' ) )
	{
		$SQL[] = $dropsql;
	}
	$SQL[] = "ALTER TABLE rc_modpref DROP COLUMN reports_pp;";
}

if( $DB->checkForField( 'by_pm', 'rc_modpref' ) )
{
	if ( $dropsql = $DB->_sql_get_dropdefault_constraint( 'rc_modpref', 'by_pm' ) )
	{
		$SQL[] = $dropsql;
	}
	$SQL[] = "ALTER TABLE rc_modpref DROP COLUMN by_pm;";
}

if( $DB->checkForField( 'by_email', 'rc_modpref' ) )
{
	if ( $dropsql = $DB->_sql_get_dropdefault_constraint( 'rc_modpref', 'by_email' ) )
	{
		$SQL[] = $dropsql;
	}
	$SQL[] = "ALTER TABLE rc_modpref DROP COLUMN by_email;";
}

if( $DB->checkForField( 'by_alert', 'rc_modpref' ) )
{
	if ( $dropsql = $DB->_sql_get_dropdefault_constraint( 'rc_modpref', 'by_alert' ) )
	{
		$SQL[] = $dropsql;
	}
	$SQL[] = "ALTER TABLE rc_modpref DROP COLUMN by_alert;";
}

if( $DB->checkForField( 'misc', 'tags_index' ) )
{
	if ( $dropsql = $DB->_sql_get_dropdefault_constraint( 'tags_index', 'misc' ) )
	{
		$SQL[] = $dropsql;
	}
	$SQL[] = "ALTER TABLE tags_index DROP COLUMN misc;";
}

if( $DB->checkForField( 'total_votes', 'topics' ) )
{
	if ( $dropsql = $DB->_sql_get_dropdefault_constraint( 'topics', 'total_votes' ) )
	{
		$SQL[] = $dropsql;
	}
	$SQL[] = "ALTER TABLE topics DROP COLUMN total_votes;";
}

if( $DB->checkForField( 'email_pm', 'members' ) )
{
	if ( $dropsql = $DB->_sql_get_dropdefault_constraint( 'members', 'email_pm' ) )
	{
		$SQL[] = $dropsql;
	}
	$SQL[] = "ALTER TABLE members DROP COLUMN email_pm;";
}

if( $DB->checkForField( 'view_pop', 'members' ) )
{
	if ( $dropsql = $DB->_sql_get_dropdefault_constraint( 'members', 'view_pop' ) )
	{
		$SQL[] = $dropsql;
	}
	$SQL[] = "ALTER TABLE members DROP COLUMN view_pop;";
}