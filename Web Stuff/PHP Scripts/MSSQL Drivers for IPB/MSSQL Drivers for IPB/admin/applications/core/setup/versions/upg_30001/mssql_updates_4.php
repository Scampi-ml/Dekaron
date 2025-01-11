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
ipsRegistry::DB()->allow_sub_select=1;

/* turn off prefix switch-a-roo-ing */
ipsRegistry::dbFunctions()->prefix_changed = true;

# ALTER ALL OTHER TABLES
$DB->addField( 'pfields_data', 'pf_group_id', 'INT', "'0'" );
$DB->addField( 'pfields_data', 'pf_icon', 'varchar(255)' );
$DB->addField( 'pfields_data', 'pf_key', 'varchar(255)' );
//$DB->changeField( 'pfields_data', 'pf_input_format', 'pf_input_format', 'text' );

$DB->dropIndex( 'moderators', 'forum_id' );

$DB->addField( 'moderators', 'forum_id_tmp', 'varchar(MAX)', "''" );
$DB->query( "UPDATE [{$PRE}moderators] SET forum_id_tmp=CAST(forum_id as varchar)" );
$DB->dropField( 'moderators', 'forum_id' );
$DB->changeField( 'moderators', 'forum_id_tmp', 'forum_id' );

$DB->addField( 'moderators', 'mod_bitoptions', 'INT', "'0'" );

$DB->addField( 'groups', 'g_rep_max_positive', 'INT', "'0'" );
$DB->addField( 'groups', 'g_rep_max_negative', 'INT', "'0'" );

$DB->addField( 'groups', 'g_mod_preview', 'TINYINT', "'0'" );
$DB->addField( 'groups', 'g_signature_limits', 'varchar(255)' );
$DB->addField( 'groups', 'g_can_add_friends', 'TINYINT', "'1'" );
$DB->addField( 'groups', 'g_hide_online_list', 'TINYINT', "'0'" );
$DB->addField( 'groups', 'g_bitoptions', 'INT', "'0'" );
$DB->addField( 'groups', 'g_pm_perday', 'INT', "'0'" );

$DB->update( 'groups', array( 'g_can_add_friends' => 1 ) );

/* Cannot simply add an indexed identity column, so... */
$DB->renameTable( 'forums', 'forums_bak' );
$DB->update( 'forums_bak', array( 'last_id' => 0 ), "last_id is NULL" );

$DB->query( "CREATE TABLE [{$PRE}forums] (
	id INT NOT NULL IDENTITY,
	topics int NULL,
	posts int NULL,
	last_post int NULL,
	last_poster_id int NOT NULL default 0,
	last_poster_name varchar(255) NULL,
	name varchar(128) NOT NULL default '',
	description varchar(max) NULL,
	position smallint NOT NULL default 0,
	use_ibc tinyint NULL,
	use_html tinyint NULL,
	status varchar(10) NULL,
	password varchar(32) NULL,
	password_override VARCHAR( 255 ) NULL,
	last_title varchar(250) NULL DEFAULT '',
	last_id int NOT NULL DEFAULT 0,
	sort_key varchar(32) NULL,
	sort_order varchar(32) NULL,
	prune smallint NULL,
	topicfilter VARCHAR( 32 ) NOT NULL DEFAULT 'all',
	show_rules tinyint NULL,
	preview_posts tinyint NULL,
	allow_poll tinyint NOT NULL default 1,
	allow_pollbump tinyint NOT NULL default 0,
	inc_postcount tinyint NOT NULL default 1,
	skin_id int NULL,
	parent_id int NULL default -1,
	quick_reply tinyint NULL default 0,
	redirect_url varchar(250) NULL default '',
	redirect_on tinyint NOT NULL default 0,
	redirect_hits int NOT NULL default 0,
	redirect_loc varchar(250) NULL default '',
	rules_title varchar(255) NOT NULL default '',
	rules_text varchar(max) NULL,
	topic_mm_id varchar(250) NOT NULL default '',
	notify_modq_emails varchar(max) NULL default '',
	sub_can_post tinyint default 1,
	permission_custom_error varchar(max) NULL,
	permission_array varchar(max) NULL,
	permission_showtopic tinyint NOT NULL default 0,
	queued_topics int NOT NULL default 0,
	queued_posts int NOT NULL default 0,
	forum_allow_rating tinyint NOT NULL default 0,
	forum_last_deletion int NOT NULL default 0,
	newest_title VARCHAR( 250 ) NULL default '',
	newest_id INT NOT NULL default 0,
PRIMARY KEY  (id)
)" );

$DB->setTableIdentityInsert( 'forums', 'ON' );
ipsRegistry::DB()->allow_sub_select=1;
$DB->query( "INSERT INTO [{$PRE}forums] (id,topics,posts,last_post,last_poster_id,last_poster_name,name,description,position,use_ibc,use_html,status,password,password_override,last_title,last_id,sort_key,sort_order,prune,topicfilter,show_rules,preview_posts,allow_poll,allow_pollbump,inc_postcount,skin_id,parent_id,quick_reply,redirect_url,redirect_on,redirect_hits,redirect_loc,rules_title,rules_text,topic_mm_id,notify_modq_emails,sub_can_post,permission_custom_error,permission_array,permission_showtopic,queued_topics,queued_posts,forum_allow_rating,forum_last_deletion,newest_title,newest_id) SELECT id,topics,posts,last_post,last_poster_id,last_poster_name,name,description,position,use_ibc,use_html,status,password,password_override,last_title,last_id,sort_key,sort_order,prune,topicfilter,show_rules,preview_posts,allow_poll,allow_pollbump,inc_postcount,skin_id,parent_id,quick_reply,redirect_url,redirect_on,redirect_hits,redirect_loc,rules_title,rules_text,topic_mm_id,notify_modq_emails,sub_can_post,permission_custom_error,permission_array,permission_showtopic,queued_topics,queued_posts,forum_allow_rating,forum_last_deletion,newest_title,newest_id FROM " . $PRE . "forums_bak" );
$DB->setTableIdentityInsert( 'forums', 'OFF' );

$DB->dropTable( 'forums_bak' );

$DB->addField( 'forums', 'can_view_others', 'INT', "'1'" );
$DB->addField( 'forums', 'min_posts_post', 'INT', "'0'" );
$DB->addField( 'forums', 'min_posts_view', 'INT', "'0'" );
$DB->addField( 'forums', 'hide_last_info', 'INT', "'0'" );
$DB->addField( 'forums', 'name_seo', 'VARCHAR(255)', "''" );
$DB->addField( 'forums', 'seo_last_title', 'VARCHAR(255)', "''" );
$DB->addField( 'forums', 'seo_last_name', 'VARCHAR(255)', "''" );
$DB->addField( 'forums', 'last_x_topic_ids', 'varchar(max)' );
$DB->addField( 'forums', 'forums_bitoptions', 'INT', "'0'" );

$DB->update( 'forums', array( 'can_view_others' => 1 ) );

$DB->addField( 'cache_store', 'cs_updated', 'INT', "'0'" );

$DB->addField( 'task_manager', 'task_application', 'varchar(100)', "''" );

$DB->addField( 'admin_permission_rows', 'row_id_type', 'varchar(13)', "'member'" );

//$DB->dropIndex( 'admin_permission_rows', 'row_member_id' );
$DB->changeField( 'admin_permission_rows', 'row_member_id', 'row_id' );


$DB->addIndex( 'admin_permission_rows', 'row_id_combo', 'row_id,row_id_type' );

$DB->addField( 'login_methods', 'login_alt_acp_html', 'varchar(max)' );
$DB->addField( 'login_methods', 'login_order', 'INT', "'0'" );

$DB->dropField( 'login_methods', 'login_installed' );
$DB->dropField( 'login_methods', 'login_type' );
$DB->dropField( 'login_methods', 'login_allow_create' );

