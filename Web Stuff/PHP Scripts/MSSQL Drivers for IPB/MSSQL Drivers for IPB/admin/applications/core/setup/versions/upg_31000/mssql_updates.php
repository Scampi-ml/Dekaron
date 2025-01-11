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

# 3.1.0 Beta 1

$PRE = trim(ipsRegistry::dbFunctions()->getPrefix());
$DB  = ipsRegistry::DB();
/* */
$DB->changeField( 'members', 'language', 'language', 'INT', '' );

$DB->addField( 'core_item_markers', 'item_is_deleted', 'INT', '0' );
$DB->dropIndex( 'core_item_markers', 'item_member_id' );
$DB->addIndex( 'core_item_markers', 'item_member_id', 'item_member_id, item_is_deleted' );

if ( ! $DB->checkForField( 'pf_search_type', 'pfields_data' ) )
{
	$DB->addField( 'pfields_data', 'pf_search_type', 'VARCHAR(5)', '\'loose\'' );
	$SQL[] = "UPDATE pfields_data SET pf_search_type = 'loose';";
}

$SQL[] = "DELETE FROM core_sys_conf_settings WHERE conf_key='photo_ext';";
$SQL[] = "delete from core_sys_conf_settings where conf_key='seo_r301';";
$SQL[] = "DELETE from core_sys_settings_titles WHERE conf_title_keyword='searchenginespiders';";

$DB->changeField( 'sessions', 'login_type', 'login_type', 'SMALLINT', '0' );
$DB->changeField( 'sessions', 'location_1_type', 'location_1_type', 'VARCHAR(255)', '' );
$DB->changeField( 'sessions', 'location_2_type', 'location_2_type', 'VARCHAR(255)', '' );
$DB->changeField( 'sessions', 'location_3_type', 'location_3_type', 'VARCHAR(255)', '' );

$DB->addIndex( 'core_sys_cp_sessions', 'session_running_time', 'session_running_time' );
$DB->addIndex( 'core_sys_cp_sessions', 'session_member_id', 'session_member_id' );
$DB->addIndex( 'upgrade_history', 'upgrades', 'upgrade_app , upgrade_version_id' );
$DB->addIndex( 'validating', 'lost_pass', 'lost_pass' );
$DB->addIndex( 'members', 'failed_login_count', 'failed_login_count' );
$DB->addIndex( 'validating', 'coppa_user', 'coppa_user' );
$DB->addIndex( 'api_log', 'api_log_date', 'api_log_date' );
$DB->addIndex( 'core_applications', 'app_directory', 'app_directory' );
$DB->addIndex( 'bulk_mail', 'mail_start', 'mail_start' );
$DB->addIndex( 'skin_collections', 'set_is_default', 'set_is_default' );
$DB->addIndex( 'members', 'joined', 'joined' );
$DB->addIndex( 'rc_classes', 'onoff ', 'onoff , mod_group_perm' );
$DB->addIndex( 'task_manager', 'task_key', 'task_application , task_key' );
$DB->addIndex( 'reputation_index', 'member_rep', 'member_id , rep_rating , rep_date' );
$DB->addIndex( 'announcements', 'announce_end', 'announce_end' );

if ( $DB->checkForTable( 'cal_events' ) )
{
	$DB->dropIndex( 'cal_events', 'daterange' );
	$DB->addIndex( 'cal_events', 'daterange', 'event_approved , event_unix_from , event_unix_to' );
	$DB->addIndex( 'cal_calendars', 'cal_rss_export', 'cal_rss_export' );
}

$DB->addIndex( 'core_sys_conf_settings', 'conf_group', 'conf_group , conf_position , conf_title' );
$DB->addIndex( 'core_uagent_groups', 'ugroup_title', 'ugroup_title' );
$DB->addIndex( 'core_uagents', 'ordering', 'uagent_position , uagent_key' );

$DB->addIndex( 'core_sys_conf_settings', 'conf_add_cache', 'conf_add_cache' );
$DB->addIndex( 'emoticons', 'emo_set', 'emo_set' );
$DB->addIndex( 'skin_templates', 'template_set_id', 'template_set_id' );
$DB->addIndex( 'skin_css', 'css_set_id', 'css_set_id' );

$DB->dropIndex( 'message_topic_user_map', 'map_user' );
$DB->addIndex( 'message_topic_user_map', 'map_user', 'map_user_id , map_folder_id , map_last_topic_reply' );
	
$DB->addField( 'validating', 'spam_flag', 'TINYINT', '0' );
$DB->addIndex( 'validating', 'spam_flag', 'spam_flag' );
$DB->addIndex( 'validating', 'member_id', 'member_id' );

$DB->addField( 'core_sys_lang', 'lang_protected', 'SMALLINT', '0' );

$SQL[] = "CREATE TABLE member_status_actions (
  action_id INT NOT NULL IDENTITY,
  action_status_id BIGINT NOT NULL DEFAULT '0',
  action_reply_id BIGINT NOT NULL DEFAULT '0',
  action_member_id BIGINT NOT NULL DEFAULT '0',
  action_date BIGINT NOT NULL DEFAULT '0',
  action_key VARCHAR(200) NOT NULL DEFAULT '',
  action_status_owner BIGINT NOT NULL DEFAULT '0',
  action_app VARCHAR(255) NOT NULL DEFAULT 'members',
  action_custom_text VARCHAR(MAX),
  action_custom INT NOT NULL DEFAULT '0',
  action_custom_url  VARCHAR(MAX),
  PRIMARY KEY (action_id)
);";
$SQL[] = "CREATE INDEX action_status_id ON member_status_actions ( action_status_id );";
$SQL[] = "CREATE INDEX action_member_id ON member_status_actions (  action_member_id , action_date  );";
$SQL[] = "CREATE INDEX action_date ON member_status_actions ( action_date );";
$SQL[] = "CREATE INDEX action_custom ON member_status_actions (  action_custom , action_date  );";

$SQL[] = "CREATE TABLE member_status_replies (
  reply_id INT NOT NULL IDENTITY,
  reply_status_id BIGINT NOT NULL DEFAULT '0',
  reply_member_id BIGINT NOT NULL DEFAULT '0',
  reply_date BIGINT NOT NULL DEFAULT '0',
  reply_content  VARCHAR(MAX),
  PRIMARY KEY (reply_id)
);";
$SQL[] = "CREATE INDEX reply_status_id ON member_status_replies ( reply_status_id );";
$SQL[] = "CREATE INDEX reply_member_id ON member_status_replies ( reply_member_id );";
$SQL[] = "CREATE INDEX reply_status_count ON member_status_replies ( reply_status_id,reply_member_id );";
$SQL[] = "CREATE INDEX reply_date ON member_status_replies ( reply_date );";

$SQL[] = "CREATE TABLE member_status_updates (
  status_id INT NOT NULL IDENTITY,
  status_member_id BIGINT NOT NULL DEFAULT '0',
  status_date BIGINT NOT NULL DEFAULT '0',
  status_content  VARCHAR(MAX),
  status_replies BIGINT NOT NULL DEFAULT '0',
  status_last_ids  VARCHAR(MAX),
  status_is_latest INT NOT NULL DEFAULT '0',
  status_is_locked INT NOT NULL DEFAULT '0',
  status_hash VARCHAR(32) NOT NULL DEFAULT '',
  status_imported INT NOT NULL DEFAULT '0',
  status_creator VARCHAR(100) NOT NULL DEFAULT '',
  PRIMARY KEY (status_id)
);";
$SQL[] = "CREATE INDEX status_member_id ON member_status_updates ( status_member_id );";
$SQL[] = "CREATE INDEX status_date ON member_status_updates ( status_date );";
$SQL[] = "CREATE INDEX status_is_latest ON member_status_updates (  status_is_latest , status_date  );";
$SQL[] = "CREATE INDEX s_hash ON member_status_updates ( status_member_id,status_hash,status_imported );";
 
$SQL[] = "CREATE TABLE inline_notifications (
notify_id INT NOT NULL IDENTITY ,
notify_to_id INT NOT NULL DEFAULT '0',
notify_sent INT NOT NULL DEFAULT '0',
notify_read INT NOT NULL DEFAULT '0',
notify_title  VARCHAR(MAX) NULL ,
notify_text VARCHAR(MAX) NULL DEFAULT NULL ,
notify_from_id INT NOT NULL DEFAULT '0',
notify_type_key VARCHAR(255) NULL DEFAULT NULL ,
notify_url  VARCHAR(MAX) null,
PRIMARY KEY (notify_id)
);";
$SQL[] = "CREATE INDEX notify_to_id ON inline_notifications (  notify_to_id , notify_sent  );";
$SQL[] = "CREATE INDEX grabber ON inline_notifications ( notify_to_id, notify_read, notify_sent );";

$SQL[] = "CREATE TABLE core_soft_delete_log (
  sdl_id INT NOT NULL IDENTITY,
  sdl_obj_id INT NOT NULL DEFAULT '0',
  sdl_obj_key VARCHAR(20) NOT NULL DEFAULT '',
  sdl_obj_member_id INT NOT NULL DEFAULT '0',
  sdl_obj_date INT NOT NULL DEFAULT '0',
  sdl_obj_reason  VARCHAR(MAX),
  sdl_locked INT NOT NULL DEFAULT '0',
  PRIMARY KEY (sdl_id)
);";
$SQL[] = "CREATE INDEX look_up ON core_soft_delete_log ( sdl_obj_id,sdl_obj_key );";

$SQL[] = "CREATE TABLE twitter_connect (
	t_key		VARCHAR(32) NOT NULL default '',
	t_token		VARCHAR(255) NOT NULL default '',
	t_secret	VARCHAR(255) NOT NULL default '',
	t_time		INT NOT NULL default '0'
);";


$SQL[] = "CREATE TABLE core_share_links (
	share_id	 BIGINT NOT NULL IDENTITY,
	share_title		VARCHAR(255) NOT NULL DEFAULT '',
	share_url		 VARCHAR(MAX),
	share_key		VARCHAR(50) NOT NULL DEFAULT '',
	share_enabled	INT NOT NULL DEFAULT '0',
	share_position	INT NOT NULL DEFAULT '0',
	share_markup	 VARCHAR(MAX),
	share_canonical INT NOT NULL DEFAULT '1',
	PRIMARY KEY (share_id)
);";


$SQL[] = "CREATE TABLE core_share_links_log (
	log_id				  INT NOT NULL IDENTITY,
	log_date			  INT NOT NULL default '0',
	log_member_id		  INT NOT NULL default '0',
	log_url				   VARCHAR(MAX),
	log_title			   VARCHAR(MAX),
	log_share_key		  VARCHAR(50) NOT NULL default '',
	log_data_app		  VARCHAR(50) NOT NULL default '',
	log_data_type		  VARCHAR(50) NOT NULL default '',
	log_data_primary_id   INT NOT NULL default '0',
	log_data_secondary_id INT NOT NULL default '0',
	log_ip_address		  VARCHAR(16) NOT NULL DEFAULT '',
	PRIMARY KEY (log_id)
);";
$SQL[] = "CREATE INDEX findstuff ON core_share_links_log ( log_data_app, log_data_type, log_data_primary_id );";
$SQL[] = "CREATE INDEX log_date ON core_share_links_log ( log_date );";
$SQL[] = "CREATE INDEX log_member_id ON core_share_links_log ( log_member_id );";
$SQL[] = "CREATE INDEX log_share_key ON core_share_links_log ( log_share_key );";
$SQL[] = "CREATE INDEX log_ip_address ON core_share_links_log ( log_ip_address );";

$SQL[] = "CREATE TABLE core_share_links_caches (
	cache_id		INT NOT NULL IDENTITY,
	cache_key		VARCHAR(255) NOT NULL default '',
	cache_data		 VARCHAR(MAX),
	cache_date		INT NOT NULL default '0',
	PRIMARY KEY ( cache_id )
);";


$SQL[] = "CREATE TABLE core_incoming_emails (
	rule_id INT NOT NULL IDENTITY PRIMARY KEY ,
	rule_criteria_field VARCHAR(4) NOT NULL ,
	rule_criteria_type VARCHAR(4) NOT NULL ,
	rule_criteria_value  VARCHAR(MAX) NOT NULL ,
	rule_app VARCHAR(255) NOT NULL ,
	rule_added_by INT NOT NULL ,
	rule_added_date INT NOT NULL
);";


$SQL[] = "CREATE TABLE search_sessions (
	session_id			VARCHAR(32) NOT NULL DEFAULT '',
	session_created		INT NOT NULL DEFAULT '0',
	session_updated 	INT NOT NULL DEFAULT '0',
	session_member_id	INT NOT NULL DEFAULT '0',
	session_data		 VARCHAR(MAX),
	PRIMARY KEY (session_id)
);";
$SQL[] = "CREATE INDEX session_updated ON search_sessions ( session_updated );";

$SQL[] = "CREATE TABLE skin_merge_session (
	merge_id				INT NOT NULL IDENTITY,
	merge_date				INT NOT NULL DEFAULT '0',
	merge_set_id			INT NOT NULL DEFAULT '0',
	merge_master_key		VARCHAR(200) NOT NULL DEFAULT '',
	merge_old_version		VARCHAR(200) NOT NULL DEFAULT '',
	merge_new_version		VARCHAR(200) NOT NULL DEFAULT '',
	merge_templates_togo	INT NOT NULL DEFAULT '0',
	merge_css_togo			INT NOT NULL DEFAULT '0',
	merge_templates_done	INT NOT NULL DEFAULT '0',
	merge_css_done			INT NOT NULL DEFAULT '0',
	merge_m_templates_togo	INT NOT NULL DEFAULT '0',
	merge_m_css_togo		INT NOT NULL DEFAULT '0',
	merge_m_templates_done	INT NOT NULL DEFAULT '0',
	merge_m_css_done		INT NOT NULL DEFAULT '0',
	merge_diff_done			INT NOT NULL DEFAULT '0',
	PRIMARY KEY (merge_id)
);";


$SQL[] = "CREATE TABLE skin_merge_changes (
	change_id				INT NOT NULL IDENTITY,
	change_key				VARCHAR(255) NOT NULL DEFAULT '',
	change_session_id		INT NOT NULL DEFAULT '0',
	change_updated			INT NOT NULL DEFAULT '0',
	change_data_group		VARCHAR(255) NOT NULL DEFAULT '',
	change_data_title		VARCHAR(255) NOT NULL DEFAULT '',
	change_data_content		 VARCHAR(MAX),
	change_data_type		VARCHAR(10) NOT NULL DEFAULT 'template',
	change_is_new			INT NOT NULL DEFAULT '0',
	change_is_diff			INT NOT NULL DEFAULT '0',
	change_can_merge		INT NOT NULL DEFAULT '0',
	change_merge_content	 VARCHAR(MAX),
	change_is_conflict		INT NOT NULL DEFAULT '0',
	change_final_content	 VARCHAR(MAX),
	change_changes_applied	INT NOT NULL DEFAULT '0',
	change_original_content  VARCHAR(MAX),
	PRIMARY KEY (change_id)
);";
$SQL[] = "CREATE INDEX change_key ON skin_merge_changes ( change_key, change_data_type );";

$SQL[] = "CREATE TABLE facebook_oauth_temp (
	f_key		VARCHAR(32) NOT NULL default '',
	f_token		VARCHAR(255) NOT NULL default '',
	f_time		INT NOT NULL default '0'
);";
	

$DB->addField( 'members', 'twitter_id', 'VARCHAR(255)', '' );
$DB->addField( 'members', 'twitter_token', 'VARCHAR(255)', '' );
$DB->addField( 'members', 'twitter_secret', 'VARCHAR(255)', '' );
$DB->addField( 'members', 'notification_cnt', 'INT', '0' );
$DB->addField( 'members', 'tc_lastsync', 'INT', '0' );
$DB->addField( 'members', 'fb_session', 'VARCHAR(200)', '' );
$DB->dropField( 'members', 'fb_emailallow' );
$DB->addField( 'members', 'fb_token', ' VARCHAR(MAX)', '' );

$DB->addIndex( 'members', 'fb_uid', 'fb_uid' );
$DB->addIndex( 'members', 'twitter_id', 'twitter_id' );


$DB->addField( 'profile_portal', 'tc_last_sid_import', 'BIGINT', '0' );
$DB->addField( 'profile_portal', 'tc_photo', ' VARCHAR(MAX)', '' );
$DB->addField( 'profile_portal', 'tc_bwoptions', 'INT', '0' );
$DB->addField( 'profile_portal', 'pp_customization', ' VARCHAR(MAX)', '' );

$DB->addField( 'groups', 'g_max_notifications', 'INT', '0' );
$DB->addField( 'groups', 'g_max_bgimg_upload', 'INT', '0' );

$DB->addField( 'rc_classes', 'app', 'VARCHAR(32)', '' );
$DB->addField( 'forums', 'disable_sharelinks', 'INT', '0' );

$DB->addField( 'topics', 'topic_deleted_posts', 'INT', '0' );
$DB->addField( 'forums', 'deleted_posts', 'INT', '0' );
$DB->addField( 'forums', 'deleted_topics', 'INT', '0' );

$DB->addField( 'forums', 'rules_raw_html', 'SMALLINT', '0' );

$SQL[] = "UPDATE rc_classes SET app='core' WHERE my_class='default';";
$SQL[] = "UPDATE rc_classes SET app='forums' WHERE my_class='post';";
$SQL[] = "UPDATE rc_classes SET app='blog' WHERE my_class='blog';";
$SQL[] = "UPDATE rc_classes SET app='gallery' WHERE my_class='gallery';";
$SQL[] = "UPDATE rc_classes SET app='downloads' WHERE my_class='downloads';";
$SQL[] = "UPDATE rc_classes SET app='members' WHERE my_class='messages';";
$SQL[] = "UPDATE rc_classes SET app='members' WHERE my_class='profiles';";
$SQL[] = "UPDATE rc_classes SET app='calendar' WHERE my_class='calendar';";

	
$SQL[] = "SET IDENTITY_INSERT core_share_links ON;";
$SQL[] = "INSERT INTO core_share_links (share_id, share_title, share_url, share_key, share_enabled, share_position, share_markup, share_canonical) VALUES(1, 'Twitter', 'http://twitter.com/home?status={title}%20{url}', 'twitter', 1, 1, '',1);";
$SQL[] = "INSERT INTO core_share_links (share_id, share_title, share_url, share_key, share_enabled, share_position, share_markup, share_canonical) VALUES(2, 'Facebook', 'http://www.facebook.com/share.php?u={url}', 'facebook', 1, 2, '',1);";
$SQL[] = "INSERT INTO core_share_links (share_id, share_title, share_url, share_key, share_enabled, share_position, share_markup, share_canonical) VALUES(3, 'Digg', 'http://digg.com/submit?phase=2&amp;url={url}&amp;title={title}', 'digg', 1, 3, '',1);";
$SQL[] = "INSERT INTO core_share_links (share_id, share_title, share_url, share_key, share_enabled, share_position, share_markup, share_canonical) VALUES(4, 'Del.icio.us', 'http://del.icio.us/post?v=2&amp;url={url}&amp;title={title}', 'delicious', 1, 4, '',1);";
$SQL[] = "INSERT INTO core_share_links (share_id, share_title, share_url, share_key, share_enabled, share_position, share_markup, share_canonical) VALUES(5, 'Reddit', 'http://reddit.com/submit?url={url}&amp;title={title}', 'reddit', 1, 5, '',1);";
$SQL[] = "INSERT INTO core_share_links (share_id, share_title, share_url, share_key, share_enabled, share_position, share_markup, share_canonical) VALUES(6, 'StumbleUpon', 'http://www.stumbleupon.com/submit?url={url}&title={title}', 'stumble', 1, 6, '',1);";
$SQL[] = "INSERT INTO core_share_links (share_id, share_title, share_url, share_key, share_enabled, share_position, share_markup, share_canonical) VALUES(8, 'Email', '', 'email', 1, 7, '',1);";
$SQL[] = "INSERT INTO core_share_links (share_id, share_title, share_url, share_key, share_enabled, share_position, share_markup, share_canonical) VALUES(9, 'Buzz', '', 'buzz', 1, 3, '', 1);";
$SQL[] = "INSERT INTO core_share_links (share_id, share_title, share_url, share_key, share_enabled, share_position, share_markup, share_canonical) VALUES(10, 'Print', '', 'print', 1, 10, '', 0);";
$SQL[] = "INSERT INTO core_share_links (share_id, share_title, share_url, share_key, share_enabled, share_position, share_markup, share_canonical) VALUES(11, 'Download', '', 'download', 1, 11, '', 0);";
$SQL[] = "SET IDENTITY_INSERT core_share_links OFF;";

/* Grab stuff */
$DB->build( array( 'select' => '*',
				   'from'   => 'skin_collections' ) );
$DB->execute();

$skins = array();

while( $row = $DB->fetch() )
{
	if ( in_array( $row['set_key'], array( 'default', 'lofi', 'xmlskin' ) ) )
	{
		$skins[ $row['set_key'] ] = $row['set_id'];
	}
}

$ids = implode( ',', array_values( $skins ) );

/* Do we have a master skin? */
if ( ! $skins['default'] )
{
	/* Insert it */
	$DB->insert( 'skin_collections', array( 'set_name'      	 => 'IP.Board',
											'set_key'       	 => 'default',
											'set_parent_id'		 => 0,
											'set_parent_array'   => 'a:0:{}',
											'set_child_array'    => 'a:0:{}',
											'set_permissions'    => '*',
											'set_is_default'     => 0,
											'set_author_name'	 => "Invision Power Services, Inc",
										    'set_author_url'	 => 'http://www.invisionpower.com',
										    'set_image_dir'		 => 'master',
										    'set_emo_dir'		 => 'default',
										    'set_hide_from_list' => 1,
										    'set_css_groups'	 => '<![CDATA[a:20:{s:6:"1.5832";a:2:{s:9:"css_group";s:15:"calendar_select";s:12:"css_position";s:1:"1";}s:6:"1.5846";a:2:{s:9:"css_group";s:6:"ipblog";s:12:"css_position";s:1:"1";}s:6:"1.5833";a:2:{s:9:"css_group";s:12:"ipb_calendar";s:12:"css_position";s:1:"1";}s:6:"1.5834";a:2:{s:9:"css_group";s:10:"ipb_common";s:12:"css_position";s:1:"1";}s:6:"1.5835";a:2:{s:9:"css_group";s:10:"ipb_editor";s:12:"css_position";s:1:"1";}s:6:"0.5836";a:2:{s:9:"css_group";s:8:"ipb_help";s:12:"css_position";s:1:"0";}s:6:"0.5837";a:2:{s:9:"css_group";s:6:"ipb_ie";s:12:"css_position";s:1:"0";}s:6:"1.5838";a:2:{s:9:"css_group";s:18:"ipb_login_register";s:12:"css_position";s:1:"1";}s:6:"1.5839";a:2:{s:9:"css_group";s:13:"ipb_messenger";s:12:"css_position";s:1:"1";}s:6:"1.5840";a:2:{s:9:"css_group";s:9:"ipb_mlist";s:12:"css_position";s:1:"1";}s:6:"1.5841";a:2:{s:9:"css_group";s:9:"ipb_print";s:12:"css_position";s:1:"1";}s:6:"1.5842";a:2:{s:9:"css_group";s:11:"ipb_profile";s:12:"css_position";s:1:"1";}s:6:"2.5843";a:2:{s:9:"css_group";s:10:"ipb_search";s:12:"css_position";s:1:"2";}s:6:"1.5844";a:2:{s:9:"css_group";s:10:"ipb_styles";s:12:"css_position";s:1:"1";}s:6:"1.5845";a:2:{s:9:"css_group";s:7:"ipb_ucp";s:12:"css_position";s:1:"1";}s:6:"1.5847";a:2:{s:9:"css_group";s:6:"ipchat";s:12:"css_position";s:1:"1";}s:6:"1.5848";a:2:{s:9:"css_group";s:9:"ipcontent";s:12:"css_position";s:1:"1";}s:6:"1.5849";a:2:{s:9:"css_group";s:11:"ipdownloads";s:12:"css_position";s:1:"1";}s:6:"1.5850";a:2:{s:9:"css_group";s:9:"ipgallery";s:12:"css_position";s:1:"1";}s:6:"1.5851";a:2:{s:9:"css_group";s:19:"ipgallery_slideshow";s:12:"css_position";s:1:"1";}}]]>',
										    'set_output_format'  => 'html' ) );
}

/* Do we have a lofi skin? */
if ( ! $skins['lofi'] )
{
	/* Insert it */
	$DB->insert( 'skin_collections', array( 'set_name'      	 => 'IP.Board Lofi',
											'set_key'       	 => 'lofi',
											'set_parent_id'		 => 0,
											'set_parent_array'   => 'a:0:{}',
											'set_child_array'    => 'a:0:{}',
											'set_permissions'    => '*',
											'set_is_default'     => 0,
											'set_author_name'	 => "Invision Power Services, Inc",
										    'set_author_url'	 => 'http://www.invisionpower.com',
										    'set_image_dir'		 => 'master',
										    'set_emo_dir'		 => 'default',
										    'set_hide_from_list' => 1,
										    'set_css_groups'	 => '<![CDATA[a:20:{s:6:"1.5832";a:2:{s:9:"css_group";s:15:"calendar_select";s:12:"css_position";s:1:"1";}s:6:"1.5846";a:2:{s:9:"css_group";s:6:"ipblog";s:12:"css_position";s:1:"1";}s:6:"1.5833";a:2:{s:9:"css_group";s:12:"ipb_calendar";s:12:"css_position";s:1:"1";}s:6:"1.5834";a:2:{s:9:"css_group";s:10:"ipb_common";s:12:"css_position";s:1:"1";}s:6:"1.5835";a:2:{s:9:"css_group";s:10:"ipb_editor";s:12:"css_position";s:1:"1";}s:6:"0.5836";a:2:{s:9:"css_group";s:8:"ipb_help";s:12:"css_position";s:1:"0";}s:6:"0.5837";a:2:{s:9:"css_group";s:6:"ipb_ie";s:12:"css_position";s:1:"0";}s:6:"1.5838";a:2:{s:9:"css_group";s:18:"ipb_login_register";s:12:"css_position";s:1:"1";}s:6:"1.5839";a:2:{s:9:"css_group";s:13:"ipb_messenger";s:12:"css_position";s:1:"1";}s:6:"1.5840";a:2:{s:9:"css_group";s:9:"ipb_mlist";s:12:"css_position";s:1:"1";}s:6:"1.5841";a:2:{s:9:"css_group";s:9:"ipb_print";s:12:"css_position";s:1:"1";}s:6:"1.5842";a:2:{s:9:"css_group";s:11:"ipb_profile";s:12:"css_position";s:1:"1";}s:6:"2.5843";a:2:{s:9:"css_group";s:10:"ipb_search";s:12:"css_position";s:1:"2";}s:6:"1.5844";a:2:{s:9:"css_group";s:10:"ipb_styles";s:12:"css_position";s:1:"1";}s:6:"1.5845";a:2:{s:9:"css_group";s:7:"ipb_ucp";s:12:"css_position";s:1:"1";}s:6:"1.5847";a:2:{s:9:"css_group";s:6:"ipchat";s:12:"css_position";s:1:"1";}s:6:"1.5848";a:2:{s:9:"css_group";s:9:"ipcontent";s:12:"css_position";s:1:"1";}s:6:"1.5849";a:2:{s:9:"css_group";s:11:"ipdownloads";s:12:"css_position";s:1:"1";}s:6:"1.5850";a:2:{s:9:"css_group";s:9:"ipgallery";s:12:"css_position";s:1:"1";}s:6:"1.5851";a:2:{s:9:"css_group";s:19:"ipgallery_slideshow";s:12:"css_position";s:1:"1";}}]]>',
										    'set_output_format'  => 'html' ) );
}

/* Make sure we have a HTML default... */
$skin = $DB->buildAndFetch( array( 'select' => 'set_id',
								   'from'   => 'skin_collections',
								   'where'  => 'set_output_format=\'html\' AND set_is_default=1' ) );
								   
if ( ! $skin['set_id'] )
{
	$DB->update( 'skin_collections', array( 'set_is_default' => 1, 'set_hide_from_list' => 0 ), "set_key='default'" );
}

if ( ! $DB->checkForField( 'bbcode_custom_regex', 'custom_bbcode' ) )
{
	$DB->addField( 'custom_bbcode', 'bbcode_custom_regex', ' VARCHAR(MAX)', '' );
}

$DB->addField( 'skin_templates', 'template_master_key', 'VARCHAR(100)', '' );
$DB->addIndex( 'skin_templates', 'template_master_key', 'template_master_key' );

$DB->addField( 'skin_css', 'css_master_key', 'VARCHAR(100)', '' );

$DB->addField( 'skin_collections', 'set_master_key', 'VARCHAR(100)', '' );

# will need to sort children out too
$uagents = 'a:2:{s:6:"groups";a:0:{}s:7:"uagents";a:10:{s:10:"blackberry";s:0:"";s:6:"iphone";s:0:"";s:9:"ipodtouch";s:0:"";s:12:"sonyericsson";s:0:"";s:5:"nokia";s:0:"";s:8:"motorola";s:0:"";s:7:"samsung";s:0:"";s:3:"htc";s:0:"";s:2:"lg";s:0:"";s:4:"palm";s:0:"";}}';
$SQL[] = "UPDATE skin_collections SET set_master_key='root' WHERE set_key='default';";
$SQL[] = "UPDATE skin_collections SET set_name='IP.Board Mobile', set_master_key='mobile', set_key='mobile', set_image_dir='mobile', set_locked_uagent='{$uagents}' WHERE set_key='lofi';";
$SQL[] = "UPDATE skin_collections SET set_master_key='xmlskin' WHERE set_key='xmlskin';";

$SQL[] = "UPDATE skin_templates SET template_master_key='root' WHERE template_set_id=0;";

$SQL[] = "UPDATE skin_css SET css_master_key='root' WHERE css_set_id=0;";

if ( trim($ids) )
{
	$SQL[] = "DELETE FROM skin_templates WHERE template_set_id IN (" . $ids . ");";
	$SQL[] = "DELETE FROM skin_css WHERE css_set_id IN (" . $ids . ");";
}

$DB->addField( 'skin_collections', 'set_order', 'INT', '' );
$DB->addIndex( 'skin_collections', 'set_order', 'set_order' );

$DB->addField( 'skin_replacements', 'replacement_master_key', 'VARCHAR(100)', '' );
$SQL[] = "UPDATE skin_replacements SET replacement_master_key='root' WHERE replacement_set_id=0;";


# Optimizations
$DB->dropIndex( 'forum_tracker', 'member_id' );
$DB->addIndex( 'forum_tracker', 'member_id', 'member_id , last_sent' );

$DB->dropIndex( 'tracker', 'tm_id' );
$DB->addIndex( 'tracker', 'tm_id', 'member_id , topic_id , last_sent' );

$DB->addIndex( 'forum_tracker', 'forum_track_type', 'forum_track_type' );
$DB->addIndex( 'tracker', 'topic_track_type', 'topic_track_type' );

$DB->addIndex( 'members', 'email', 'email' );

if ( $DB->checkForTable( 'core_topicmarker_debug' ) )
{
	$DB->dropTable( 'core_topicmarker_debug' );
}