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


# CREATE NEW TABLES

$SQL = array();
$DB  = ipsRegistry::DB();
$PRE = ipsRegistry::dbFunctions()->getPrefix();

/* turn off prefix switch-a-roo-ing */
ipsRegistry::dbFunctions()->prefix_changed = true;

ipsRegistry::DB()->dropTable( 'sessions' );

$SQL[] = "CREATE TABLE sessions (
  id VARCHAR(60) NOT NULL DEFAULT '0',
  member_name VARCHAR(64) NULL,
  seo_name VARCHAR(255) NOT NULL DEFAULT '',
  member_id INT NOT NULL DEFAULT '0',
  ip_address VARCHAR(16) NULL,
  browser VARCHAR(200) NOT NULL DEFAULT '',
  running_time INT NOT NULL,
  login_type char(3) DEFAULT '',
  location VARCHAR(40) NULL,
  member_group SMALLINT NULL,
  in_error TINYINT NOT NULL DEFAULT '0',
  location_1_type VARCHAR(10) NOT NULL DEFAULT '',
  location_1_id INT NOT NULL DEFAULT '0',
  location_2_type VARCHAR(10) NOT NULL DEFAULT '',
  location_2_id INT NOT NULL DEFAULT '0',
  location_3_type VARCHAR(10) NOT NULL DEFAULT '',
  location_3_id INT NOT NULL DEFAULT '0',
  current_appcomponent VARCHAR(100) NOT NULL DEFAULT '',
  current_module VARCHAR(100) NOT NULL DEFAULT '',
  current_section VARCHAR(100) NOT NULL DEFAULT '',
  uagent_key VARCHAR(200) NOT NULL DEFAULT '',
  uagent_version VARCHAR(100) NOT NULL DEFAULT '',
  uagent_type VARCHAR(200) NOT NULL DEFAULT '',
  uagent_bypass INT NOT NULL DEFAULT '0',
  search_thread_id INT NOT NULL DEFAULT '0',
  search_thread_time VARCHAR(13) NOT NULL DEFAULT '0',
  PRIMARY KEY (id)
);";

$SQL[] = "CREATE INDEX location1 ON sessions ( location_1_type,location_1_id );";
$SQL[] = "CREATE INDEX location2 ON sessions ( location_2_type,location_2_id );";
$SQL[] = "CREATE INDEX location3 ON sessions ( location_3_type,location_3_id );";
$SQL[] = "CREATE INDEX running_time ON sessions ( running_time );";


ipsRegistry::DB()->renameTable( 'custom_bbcode', 'custom_bbcode_old' );

$SQL[] = "CREATE TABLE custom_bbcode (
  bbcode_id INT NOT NULL IDENTITY,
  bbcode_title VARCHAR(255) NOT NULL DEFAULT '',
bbcode_desc TEXT NULL,
  bbcode_tag VARCHAR(255) NOT NULL DEFAULT '',
bbcode_replace TEXT NULL,
  bbcode_useoption TINYINT NOT NULL DEFAULT '0',
bbcode_example TEXT NULL,
  bbcode_switch_option INT NOT NULL DEFAULT '0',
  bbcode_menu_option_text VARCHAR(200) NOT NULL DEFAULT '',
  bbcode_menu_content_text VARCHAR(200) NOT NULL DEFAULT '',
  bbcode_single_tag TINYINT NOT NULL DEFAULT '0',
  bbcode_groups VARCHAR(255) NULL,
  bbcode_sections VARCHAR(255) NULL,
  bbcode_php_plugin VARCHAR(255) NULL,
  bbcode_parse SMALLINT NOT NULL DEFAULT '1',
  bbcode_no_parsing TINYINT NOT NULL DEFAULT '0',
  bbcode_protected TINYINT NOT NULL DEFAULT '0',
  bbcode_aliases VARCHAR(255) NULL,
  bbcode_optional_option TINYINT NOT NULL DEFAULT '0',
  bbcode_image VARCHAR(255) NULL,
  bbcode_strip_search TINYINT NOT NULL DEFAULT '0',
  bbcode_app VARCHAR(50) NOT NULL DEFAULT '',
  PRIMARY KEY (bbcode_id)
);";


$SQL[] = "CREATE TABLE profile_friends_flood (
  friends_id INT NOT NULL IDENTITY,
  friends_member_id INT NOT NULL DEFAULT '0',
  friends_friend_id INT NOT NULL DEFAULT '0',
  friends_removed INT NOT NULL DEFAULT '0',
  PRIMARY KEY (friends_id)
);";

$SQL[] = "CREATE TABLE core_sys_cp_sessions (
  session_id VARCHAR(32) NOT NULL DEFAULT '',
  session_ip_address VARCHAR(32) NOT NULL DEFAULT '',
  session_member_name VARCHAR(250) NOT NULL DEFAULT '',
  session_member_id INT NOT NULL DEFAULT '0',
  session_member_login_key VARCHAR(32) NOT NULL DEFAULT '',
  session_location VARCHAR(64) NOT NULL DEFAULT '',
  session_log_in_time INT NOT NULL DEFAULT '0',
  session_running_time INT NOT NULL DEFAULT '0',
session_url TEXT NULL,
session_app_data TEXT NULL,
  PRIMARY KEY (session_id)
);";

$SQL[] = "CREATE TABLE core_sys_settings_titles (
  conf_title_id SMALLINT NOT NULL IDENTITY,
  conf_title_title VARCHAR(255) NOT NULL DEFAULT '',
conf_title_desc TEXT NULL,
  conf_title_count SMALLINT NOT NULL DEFAULT '0',
  conf_title_noshow TINYINT NOT NULL DEFAULT '0',
  conf_title_keyword VARCHAR(200) NOT NULL DEFAULT '',
  conf_title_module VARCHAR(200) NOT NULL DEFAULT '',
  conf_title_app VARCHAR(200) NOT NULL DEFAULT '',
  conf_title_tab VARCHAR(32) NULL,
  PRIMARY KEY (conf_title_id)
);";

$SQL[] = "CREATE TABLE core_sys_conf_settings (
  conf_id INT NOT NULL IDENTITY,
  conf_title VARCHAR(255) NOT NULL DEFAULT '',
conf_description TEXT NULL,
  conf_group SMALLINT NOT NULL DEFAULT '0',
  conf_type VARCHAR(255) NOT NULL DEFAULT '',
  conf_key VARCHAR(255) NOT NULL DEFAULT '',
conf_value TEXT NULL,
conf_default TEXT NULL,
conf_extra TEXT NULL,
conf_evalphp TEXT NULL,
  conf_protected TINYINT NOT NULL DEFAULT '0',
  conf_position SMALLINT NOT NULL DEFAULT '0',
  conf_start_group VARCHAR(255) NOT NULL DEFAULT '',
  conf_end_group TINYINT NOT NULL DEFAULT '0',
  conf_add_cache TINYINT NOT NULL DEFAULT '1',
conf_keywords TEXT NULL,
  PRIMARY KEY (conf_id)
);";

$SQL[] = "CREATE TABLE core_item_markers (
  item_key char(32) NOT NULL,
  item_member_id INT NOT NULL DEFAULT '0',
  item_app VARCHAR(255) NOT NULL DEFAULT 'core',
  item_last_update INT NOT NULL DEFAULT '0',
  item_last_saved INT NOT NULL DEFAULT '0',
  item_unread_count INT NOT NULL DEFAULT '0',
item_read_array TEXT NULL,
  item_global_reset INT NOT NULL DEFAULT '0',
  item_app_key_1 INT NOT NULL DEFAULT '0',
  item_app_key_2 INT NOT NULL DEFAULT '0',
  item_app_key_3 INT NOT NULL DEFAULT '0'
);";

$SQL[] = "CREATE INDEX combo_key ON core_item_markers ( item_key,item_member_id,item_app );";
$SQL[] = "CREATE INDEX marker_index ON core_item_markers ( item_member_id,item_app );";
$SQL[] = "CREATE INDEX item_member_id ON core_item_markers ( item_member_id );";
$SQL[] = "CREATE INDEX item_last_saved ON core_item_markers ( item_last_saved );";

$SQL[] = "CREATE TABLE core_item_markers_storage (
  item_member_id INT NOT NULL DEFAULT '0',
item_markers TEXT NULL,
  item_last_updated INT NOT NULL DEFAULT '0',
  item_last_saved INT NOT NULL DEFAULT '0',
  PRIMARY KEY (item_member_id)
);";

$SQL[] = "CREATE INDEX item_last_saved ON core_item_markers_storage ( item_last_saved );";


$SQL[] = "CREATE TABLE template_sandr (
  sandr_session_id INT NOT NULL IDENTITY,
  sandr_set_id INT NOT NULL DEFAULT '0',
  sandr_search_only INT NOT NULL DEFAULT '0',
  sandr_search_all INT NOT NULL DEFAULT '0',
sandr_search_for TEXT NULL,
sandr_replace_with TEXT NULL,
  sandr_is_regex INT NOT NULL DEFAULT '0',
  sandr_template_count INT NOT NULL DEFAULT '0',
  sandr_template_processed INT NOT NULL DEFAULT '0',
sandr_results TEXT NULL,
  sandr_updated INT NOT NULL DEFAULT '0',
  PRIMARY KEY (sandr_session_id)
);";

$SQL[] = "CREATE TABLE question_and_answer (
  qa_id INT NOT NULL IDENTITY,
qa_question TEXT NULL,
qa_answers TEXT NULL,
  PRIMARY KEY (qa_id)
);";

$SQL[] = "CREATE TABLE mod_queued_items (
  id INT NOT NULL IDENTITY,
  type VARCHAR(32) NOT NULL DEFAULT 'post',
  type_id INT NOT NULL DEFAULT '0',
  PRIMARY KEY (id)
);";

$SQL[] = "CREATE INDEX type_id ON mod_queued_items ( type_id );";

ipsRegistry::DB()->renameTable( 'message_topics', 'message_topics_old' );


$SQL[] = "CREATE TABLE message_posts (
  msg_id INT NOT NULL IDENTITY CONSTRAINT PK_msg_id PRIMARY KEY,
  msg_topic_id INT NOT NULL DEFAULT '0',
  msg_date INT NOT NULL,
msg_post TEXT NULL,
  msg_post_key VARCHAR(32) NOT NULL DEFAULT '0',
  msg_author_id INT NOT NULL DEFAULT '0',
  msg_ip_address VARCHAR(16) NOT NULL DEFAULT '0',
  msg_is_first_post INT NOT NULL DEFAULT '0'
);";
$SQL[] = "CREATE TABLE message_topic_user_map (
  map_id INT NOT NULL IDENTITY,
  map_user_id INT NOT NULL DEFAULT '0',
  map_topic_id INT NOT NULL DEFAULT '0',
  map_folder_id VARCHAR(32) NOT NULL DEFAULT '',
  map_read_time INT NOT NULL DEFAULT '0',
  map_user_active INT NOT NULL DEFAULT '0',
  map_user_banned INT NOT NULL DEFAULT '0',
  map_has_unread INT NOT NULL DEFAULT '0',
  map_is_system INT NOT NULL DEFAULT '0',
  map_is_starter INT NOT NULL DEFAULT '0',
  map_left_time INT NOT NULL DEFAULT '0',
  map_ignore_notification INT NOT NULL DEFAULT '0',
  map_last_topic_reply INT NOT NULL DEFAULT '0',
  PRIMARY KEY (map_id)
);";
$SQL[] = "CREATE TABLE message_topics (
  mt_id INT NOT NULL IDENTITY CONSTRAINT PK_mt_id PRIMARY KEY,
  mt_date INT NOT NULL DEFAULT '0',
  mt_title VARCHAR(255) NOT NULL DEFAULT '',
  mt_hasattach SMALLINT NOT NULL DEFAULT '0',
  mt_starter_id INT NOT NULL DEFAULT '0',
  mt_start_time INT NOT NULL DEFAULT '0',
  mt_last_post_time INT NOT NULL DEFAULT '0',
mt_invited_members TEXT NULL,
  mt_to_count INT NOT NULL DEFAULT '0',
  mt_to_member_id INT NOT NULL DEFAULT '0',
  mt_replies INT NOT NULL DEFAULT '0',
  mt_last_msg_id INT NOT NULL DEFAULT '0',
  mt_first_msg_id INT NOT NULL DEFAULT '0',
  mt_is_draft INT NOT NULL DEFAULT '0',
  mt_is_deleted INT NOT NULL DEFAULT '0',
  mt_is_system INT NOT NULL DEFAULT '0'
);";

$SQL[] = "CREATE INDEX msg_topic_id ON message_posts ( msg_topic_id );";
$SQL[] = "CREATE INDEX msg_date ON message_posts ( msg_date );";
$SQL[] = "CREATE INDEX map_main ON message_topic_user_map ( map_user_id,map_topic_id );";
$SQL[] = "CREATE INDEX map_user ON message_topic_user_map ( map_user_id,map_folder_id );";
$SQL[] = "CREATE INDEX mt_starter_id ON message_topics ( mt_starter_id );";
$SQL[] = "CREATE INDEX mt_date ON message_topics ( mt_date );";


$SQL[] = "sp_fulltext_database 'enable'";
$SQL[] = "IF (select FULLTEXTCATALOGPROPERTY ( 'ftcatalog', 'PopulateStatus' )) IS NULL
BEGIN
	exec sp_fulltext_catalog 'ftcatalog', 'create'
END";
$SQL[] = "sp_fulltext_table 'message_posts', 'Create', 'ftcatalog', 'PK_msg_id'";
$SQL[] = "sp_fulltext_column 'message_posts', 'msg_post', 'add'";
$SQL[] = "sp_fulltext_table 'message_posts', 'activate'";
$SQL[] = "sp_fulltext_table 'message_posts', 'Start_change_tracking'";
$SQL[] = "sp_fulltext_table 'message_posts', 'Start_background_updateindex'";
$SQL[] = "sp_fulltext_table 'message_topics', 'Create', 'ftcatalog', 'PK_mt_id'";
$SQL[] = "sp_fulltext_column 'message_topics', 'mt_title', 'add'";
$SQL[] = "sp_fulltext_table 'message_topics', 'activate'";
$SQL[] = "sp_fulltext_table 'message_topics', 'Start_change_tracking'";
$SQL[] = "sp_fulltext_table 'message_topics', 'Start_background_updateindex'";


$SQL[] = "CREATE TABLE error_logs (
  log_id INT NOT NULL IDENTITY,
  log_member INT NOT NULL DEFAULT '0',
  log_date VARCHAR(13) NOT NULL DEFAULT '0',
log_error TEXT NULL,
  log_error_code VARCHAR(24) NOT NULL DEFAULT '0',
  log_ip_address VARCHAR(32) NULL,
log_request_uri TEXT NULL,
  PRIMARY KEY (log_id)
);";

$SQL[] = "CREATE INDEX log_date ON error_logs ( log_date );";

$SQL[] = "CREATE TABLE pfields_groups (
  pf_group_id INT NOT NULL IDENTITY,
  pf_group_name VARCHAR(255) NOT NULL,
  pf_group_key VARCHAR(255) NOT NULL,
  PRIMARY KEY (pf_group_id)
);";

ipsRegistry::DB()->dropTable( 'rc_classes' );
ipsRegistry::DB()->dropTable( 'rc_comments' );
ipsRegistry::DB()->dropTable( 'rc_modpref' );
ipsRegistry::DB()->dropTable( 'rc_reports' );
ipsRegistry::DB()->dropTable( 'rc_reports_index' );
ipsRegistry::DB()->dropTable( 'rc_status' );
ipsRegistry::DB()->dropTable( 'rc_status_sev' );

$SQL[] = "CREATE TABLE rc_classes (
  com_id SMALLINT NOT NULL IDENTITY,
  onoff TINYINT NOT NULL DEFAULT '0',
  class_title VARCHAR(255) NOT NULL DEFAULT '',
class_desc TEXT NOT NULL,
  author VARCHAR(255) NOT NULL DEFAULT '',
  author_url VARCHAR(255) NOT NULL DEFAULT '',
  pversion VARCHAR(255) NOT NULL DEFAULT '',
  my_class VARCHAR(100) NOT NULL DEFAULT '',
  group_can_report VARCHAR(255) NOT NULL DEFAULT '',
  mod_group_perm VARCHAR(255) NOT NULL DEFAULT '',
extra_data TEXT NOT NULL,
  lockd TINYINT NOT NULL DEFAULT '0',
  PRIMARY KEY (com_id)
);";
$SQL[] = "CREATE TABLE rc_comments (
  id INT NOT NULL IDENTITY,
  rid INT NOT NULL DEFAULT '0',
comment TEXT NOT NULL,
  comment_by INT NOT NULL DEFAULT '0',
  comment_date INT NOT NULL DEFAULT '0',
  PRIMARY KEY (id)
);";
$SQL[] = "CREATE TABLE rc_modpref (
  mem_id INT NOT NULL DEFAULT '0',
  by_pm TINYINT NOT NULL DEFAULT '0',
  by_email TINYINT NOT NULL DEFAULT '0',
  by_alert TINYINT NOT NULL DEFAULT '0',
  rss_key VARCHAR(32) NOT NULL DEFAULT '',
  max_points SMALLINT NOT NULL DEFAULT '0',
  reports_pp SMALLINT NOT NULL DEFAULT '0',
rss_cache TEXT NOT NULL,
  PRIMARY KEY (mem_id)
);";
$SQL[] = "CREATE TABLE rc_reports (
  id INT NOT NULL IDENTITY,
  rid INT NOT NULL DEFAULT '0',
report TEXT NOT NULL,
  report_by INT NOT NULL DEFAULT '0',
  date_reported INT NOT NULL DEFAULT '0',
  PRIMARY KEY (id)
);";
$SQL[] = "CREATE TABLE rc_reports_index (
  id INT NOT NULL IDENTITY,
  uid VARCHAR(32) NOT NULL DEFAULT '',
  title VARCHAR(255) NOT NULL DEFAULT '',
  status SMALLINT NOT NULL DEFAULT '1',
  url VARCHAR(255) NOT NULL DEFAULT '',
  img_preview VARCHAR(255) NOT NULL DEFAULT '',
  rc_class SMALLINT NOT NULL DEFAULT '0',
  updated_by INT NOT NULL DEFAULT '0',
  date_updated INT NOT NULL DEFAULT '0',
  date_created INT NOT NULL DEFAULT '0',
  exdat1 INT NOT NULL DEFAULT '0',
  exdat2 INT NOT NULL DEFAULT '0',
  exdat3 INT NOT NULL DEFAULT '0',
  num_reports SMALLINT NOT NULL DEFAULT '0',
  num_comments SMALLINT NOT NULL DEFAULT '0',
  seoname VARCHAR(255) NULL,
  seotemplate VARCHAR(255) NULL,
  PRIMARY KEY (id)
);";
$SQL[] = "CREATE TABLE rc_status (
  status SMALLINT NOT NULL IDENTITY,
  title VARCHAR(100) NOT NULL DEFAULT '',
  points_per_report SMALLINT NOT NULL DEFAULT '1',
minutes_to_apoint INT NOT NULL DEFAULT '5',
  is_new TINYINT NOT NULL DEFAULT '0',
  is_complete TINYINT NOT NULL DEFAULT '0',
  is_active TINYINT NOT NULL DEFAULT '0',
  rorder SMALLINT NOT NULL DEFAULT '0',
  PRIMARY KEY (status)
);";
$SQL[] = "CREATE TABLE rc_status_sev (
  id SMALLINT NOT NULL IDENTITY,
  status SMALLINT NOT NULL DEFAULT '0',
  points SMALLINT NOT NULL DEFAULT '0',
  img VARCHAR(255) NOT NULL DEFAULT '',
  is_png TINYINT NOT NULL DEFAULT '0',
  width SMALLINT NOT NULL DEFAULT '16',
  height SMALLINT NOT NULL DEFAULT '16',
  PRIMARY KEY (id)
);";


$SQL[] = "CREATE INDEX uid ON rc_reports_index ( uid );";
$SQL[] = "CREATE INDEX status ON rc_status_sev ( status,points );";


$SQL[] = "CREATE TABLE reputation_cache (
  id bigINT NOT NULL IDENTITY,
  app VARCHAR(32) NOT NULL,
  type VARCHAR(32) NOT NULL,
  type_id INT NOT NULL,
  rep_points INT NOT NULL,
  PRIMARY KEY (id)
);";
$SQL[] = "CREATE TABLE reputation_index (
  id bigINT NOT NULL IDENTITY,
  member_id INT NOT NULL,
  app VARCHAR(32) NOT NULL,
  type VARCHAR(32) NOT NULL,
  type_id INT NOT NULL,
misc TEXT NOT NULL,
  rep_date INT NOT NULL,
rep_msg TEXT NOT NULL,
  rep_rating TINYINT NOT NULL,
  PRIMARY KEY (id)
);";
$SQL[] = "CREATE TABLE reputation_levels (
  level_id INT NOT NULL IDENTITY,
  level_points INT NOT NULL,
  level_title VARCHAR(255) NOT NULL,
  level_image VARCHAR(255) NOT NULL,
  PRIMARY KEY (level_id)
);";

$SQL[] = "CREATE INDEX app ON reputation_cache ( app,type,type_id );";
$SQL[] = "CREATE INDEX app ON reputation_index ( app,type,type_id,member_id );";



$SQL[] = "CREATE TABLE core_hooks (
  hook_id INT NOT NULL IDENTITY,
  hook_enabled TINYINT NOT NULL DEFAULT '0',
  hook_name VARCHAR(255) NULL,
hook_desc TEXT NULL,
  hook_author VARCHAR(255) NULL,
  hook_email VARCHAR(255) NULL,
hook_website TEXT NULL,
hook_update_check TEXT NULL,
hook_requirements TEXT NULL,
  hook_version_human VARCHAR(32) NULL,
  hook_version_long VARCHAR(32) NOT NULL DEFAULT '0',
  hook_installed VARCHAR(13) NOT NULL DEFAULT '0',
  hook_updated VARCHAR(13) NOT NULL DEFAULT '0',
  hook_position INT NOT NULL DEFAULT '0',
hook_extra_data TEXT NULL,
  hook_key VARCHAR(32) NULL,
  PRIMARY KEY (hook_id)
);";

$SQL[] = "CREATE TABLE core_hooks_files (
  hook_file_id INT NOT NULL IDENTITY,
  hook_hook_id INT NOT NULL DEFAULT '0',
  hook_file_stored VARCHAR(255) NULL,
  hook_file_real VARCHAR(255) NULL,
  hook_type VARCHAR(32) NULL,
  hook_classname VARCHAR(255) NULL,
hook_data TEXT NULL,
hooks_source TEXT NULL,
  PRIMARY KEY (hook_file_id)
);";

$SQL[] = "CREATE INDEX hook_hook_id ON core_hooks_files ( hook_hook_id );";

$SQL[] = "CREATE TABLE tags_index (
  id bigINT NOT NULL IDENTITY,
  app VARCHAR(255) NOT NULL,
  tag VARCHAR(255) NOT NULL,
  type VARCHAR(32) NOT NULL,
  type_id bigINT NOT NULL,
  type_2 VARCHAR(32) NOT NULL,
  type_id_2 bigINT NOT NULL,
  updated INT NOT NULL,
misc TEXT NOT NULL,
  member_id INT NOT NULL,
  PRIMARY KEY (id)
);";

$SQL[] = "CREATE INDEX app ON tags_index ( app );";

$SQL[] = "CREATE TABLE core_uagent_groups (
  ugroup_id INT NOT NULL IDENTITY,
  ugroup_title VARCHAR(255) NOT NULL DEFAULT '',
ugroup_array TEXT NULL,
  PRIMARY KEY (ugroup_id)
);";
$SQL[] = "CREATE TABLE core_uagents (
  uagent_id INT NOT NULL IDENTITY,
  uagent_key VARCHAR(200) NOT NULL DEFAULT '',
  uagent_name VARCHAR(200) NOT NULL DEFAULT '',
uagent_regex TEXT NULL,
  uagent_regex_capture INT NOT NULL DEFAULT '0',
  uagent_type VARCHAR(200) NOT NULL DEFAULT '',
  uagent_position INT NOT NULL DEFAULT '0',
  PRIMARY KEY (uagent_id)
);";

$SQL[] = "CREATE INDEX uagent_key ON core_uagents ( uagent_key );";

$SQL[] = "CREATE TABLE skin_replacements (
  replacement_id INT NOT NULL IDENTITY,
  replacement_key VARCHAR(255) NOT NULL DEFAULT '',
replacement_content TEXT NULL,
  replacement_set_id INT NOT NULL DEFAULT '0',
  replacement_added_to INT NOT NULL DEFAULT '0',
  PRIMARY KEY (replacement_id)
);";

$SQL[] = "CREATE INDEX replacement_set_id ON skin_replacements ( replacement_set_id );";

ipsRegistry::DB()->renameTable( 'skin_templates', 'skin_templates_old' );


$SQL[] = "CREATE TABLE skin_templates (
  template_id INT NOT NULL IDENTITY,
  template_set_id INT NOT NULL DEFAULT '0',
  template_group VARCHAR(255) NOT NULL DEFAULT '',
template_content TEXT NULL,
  template_name VARCHAR(255) NULL,
template_data TEXT NULL,
  template_updated INT NOT NULL DEFAULT '0',
  template_removable INT NOT NULL DEFAULT '0',
  template_added_to INT NOT NULL DEFAULT '0',
  template_user_added INT NOT NULL DEFAULT '0',
  template_user_edited INT NOT NULL DEFAULT '0',
  PRIMARY KEY (template_id)
);";

$SQL[] = "CREATE TABLE skin_collections (
  set_id INT NOT NULL IDENTITY,
  set_name VARCHAR(200) NOT NULL DEFAULT '',
  set_key VARCHAR(100) NOT NULL DEFAULT '',
  set_parent_id INT NOT NULL DEFAULT '-1',
set_parent_array TEXT NULL,
set_child_array TEXT NULL,
set_permissions TEXT NOT NULL,
  set_is_default INT NOT NULL DEFAULT '0',
  set_author_name VARCHAR(255) NOT NULL DEFAULT '',
  set_author_url VARCHAR(255) NOT NULL DEFAULT '',
  set_image_dir VARCHAR(255) NOT NULL DEFAULT 'default',
  set_emo_dir VARCHAR(255) NOT NULL DEFAULT 'default',
  set_css_inline INT NOT NULL DEFAULT '0',
set_css_groups TEXT NULL,
  set_added INT NOT NULL DEFAULT '0',
  set_updated INT NOT NULL DEFAULT '0',
  set_output_format VARCHAR(200) NOT NULL DEFAULT 'html',
set_locked_uagent TEXT NULL,
  set_hide_from_list INT NOT NULL DEFAULT '0',
  set_minify INT NOT NULL DEFAULT '0',
  PRIMARY KEY (set_id)
);";

$SQL[] = "CREATE INDEX parent_set_id ON skin_collections ( set_parent_id,set_id );";

$SQL[] = "CREATE TABLE skin_css (
  css_id INT NOT NULL IDENTITY,
  css_set_id INT NOT NULL DEFAULT '0',
  css_updated INT NOT NULL DEFAULT '0',
  css_group VARCHAR(255) NOT NULL DEFAULT '0',
css_content TEXT NULL,
  css_position INT NOT NULL DEFAULT '0',
  css_added_to INT NOT NULL DEFAULT '0',
  css_app VARCHAR(200) NOT NULL DEFAULT '0',
  css_app_hide INT NOT NULL DEFAULT '0',
css_attributes TEXT NULL,
  css_removed INT NOT NULL DEFAULT '0',
  css_modules VARCHAR(250) NOT NULL DEFAULT '',
  css_user_added INT NOT NULL DEFAULT '0',
  css_user_edited INT NOT NULL DEFAULT '0',
  PRIMARY KEY (css_id)
);";

$SQL[] = "CREATE TABLE skin_cache (
  cache_id INT NOT NULL IDENTITY,
  cache_updated INT NOT NULL DEFAULT '0',
  cache_type VARCHAR(200) NOT NULL DEFAULT '',
  cache_set_id INT NOT NULL DEFAULT '0',
  cache_key_1 VARCHAR(200) NOT NULL DEFAULT '',
  cache_value_1 VARCHAR(200) NOT NULL DEFAULT '',
  cache_key_2 VARCHAR(200) NOT NULL DEFAULT '',
  cache_value_2 VARCHAR(200) NOT NULL DEFAULT '',
  cache_value_3 VARCHAR(200) NOT NULL DEFAULT '',
cache_content TEXT NOT NULL,
  cache_key_3 VARCHAR(200) NOT NULL DEFAULT '',
  cache_key_4 VARCHAR(200) NOT NULL DEFAULT '',
  cache_value_4 VARCHAR(200) NOT NULL DEFAULT '',
  cache_key_5 VARCHAR(200) NOT NULL DEFAULT '',
  cache_value_5 VARCHAR(200) NOT NULL DEFAULT '',
  cache_key_6 VARCHAR(200) NOT NULL DEFAULT '',
  cache_value_6 VARCHAR(200) NOT NULL DEFAULT '',
  PRIMARY KEY (cache_id)
);";

$SQL[] = "CREATE INDEX cache_type ON skin_cache ( cache_type );";
$SQL[] = "CREATE INDEX cache_set_id ON skin_cache ( cache_set_id );";

$SQL[] = "CREATE TABLE bbcode_mediatag (
  mediatag_id smallINT NOT NULL IDENTITY,
  mediatag_name VARCHAR(255) NOT NULL,
mediatag_match TEXT NULL,
mediatag_replace TEXT NULL,
  PRIMARY KEY (mediatag_id)
);";

$SQL[] = "CREATE TABLE ignored_users (
  ignore_id INT NOT NULL IDENTITY,
  ignore_owner_id INT NOT NULL DEFAULT '0',
  ignore_ignore_id INT NOT NULL DEFAULT '0',
  ignore_messages INT NOT NULL DEFAULT '0',
  ignore_topics INT NOT NULL DEFAULT '0',
  PRIMARY KEY (ignore_id)
);";

$SQL[] = "CREATE INDEX ignore_owner_id ON ignored_users ( ignore_owner_id );";
$SQL[] = "CREATE INDEX ignore_ignore_id ON ignored_users ( ignore_ignore_id );";

$SQL[] = "CREATE TABLE captcha (
  captcha_unique_id VARCHAR(32) NOT NULL DEFAULT '',
  captcha_string VARCHAR(100) NOT NULL DEFAULT '',
  captcha_ipaddress VARCHAR(16) NOT NULL DEFAULT '',
  captcha_date INT NOT NULL DEFAULT '0',
  PRIMARY KEY (captcha_unique_id)
);";

$SQL[] = "CREATE TABLE permission_index (
  perm_id INT NOT NULL IDENTITY,
  app VARCHAR(32) NOT NULL,
  perm_type VARCHAR(32) NOT NULL,
  perm_type_id INT NOT NULL,
perm_view TEXT NOT NULL,
perm_2 TEXT NOT NULL,
perm_3 TEXT NOT NULL,
perm_4 TEXT NOT NULL,
perm_5 TEXT NOT NULL,
perm_6 TEXT NOT NULL,
perm_7 TEXT NOT NULL,
  owner_only TINYINT NOT NULL DEFAULT '0',
  friend_only TINYINT NOT NULL DEFAULT '0',
  authorized_users VARCHAR(255) NULL,
  PRIMARY KEY (perm_id)
);";

$SQL[] = "CREATE INDEX perm_index ON permission_index ( perm_type,perm_type_id );";
$SQL[] = "CREATE INDEX perm_type ON permission_index ( app,perm_type,perm_type_id );";

$SQL[] = "CREATE TABLE openid_temp (
  id VARCHAR(32) NOT NULL,
referrer TEXT NULL,
  privacy TINYINT NOT NULL DEFAULT '0',
  cookiedate TINYINT NOT NULL DEFAULT '0',
fullurl TEXT NULL,
  PRIMARY KEY (id)
);";

$SQL[] = "CREATE TABLE core_applications (
  app_id INT NOT NULL IDENTITY,
  app_title VARCHAR(255) NOT NULL DEFAULT '',
  app_public_title VARCHAR(255) NOT NULL DEFAULT '',
  app_description VARCHAR(255) NOT NULL DEFAULT '',
  app_author VARCHAR(255) NOT NULL DEFAULT '',
  app_version VARCHAR(255) NOT NULL DEFAULT '',
  app_long_version INT NOT NULL DEFAULT '10000',
  app_directory VARCHAR(255) NOT NULL DEFAULT '',
  app_added INT NOT NULL DEFAULT '0',
  app_position INT NOT NULL DEFAULT '0',
  app_protected INT NOT NULL DEFAULT '0',
  app_enabled INT NOT NULL DEFAULT '0',
  app_location VARCHAR(32) NOT NULL DEFAULT '',
  app_hide_tab INT NOT NULL DEFAULT '0',
  PRIMARY KEY (app_id)
);";

$SQL[] = "CREATE TABLE core_sys_module (
  sys_module_id INT NOT NULL IDENTITY,
  sys_module_title VARCHAR(32) NOT NULL DEFAULT '',
  sys_module_application VARCHAR(32) NOT NULL DEFAULT '',
  sys_module_key VARCHAR(32) NOT NULL DEFAULT '',
  sys_module_description VARCHAR(100) NOT NULL DEFAULT '',
  sys_module_version VARCHAR(10) NOT NULL DEFAULT '',
  sys_module_parent VARCHAR(32) NOT NULL DEFAULT '',
  sys_module_protected TINYINT NOT NULL DEFAULT '0',
  sys_module_visible TINYINT NOT NULL DEFAULT '1',
  sys_module_tables VARCHAR(255) NOT NULL DEFAULT '',
  sys_module_hooks VARCHAR(255) NOT NULL DEFAULT '',
  sys_module_position INT NOT NULL DEFAULT '0',
  sys_module_admin INT NOT NULL DEFAULT '0',
  PRIMARY KEY (sys_module_id)
);";

$SQL[] = "CREATE INDEX sys_module_application ON core_sys_module ( sys_module_application );";
$SQL[] = "CREATE INDEX sys_module_visible ON core_sys_module ( sys_module_visible );";
$SQL[] = "CREATE INDEX sys_module_key ON core_sys_module ( sys_module_key );";
$SQL[] = "CREATE INDEX sys_module_parent ON core_sys_module ( sys_module_parent );";

$SQL[] = "CREATE TABLE core_sys_lang (
  lang_id INT NOT NULL IDENTITY,
  lang_short VARCHAR(18) NOT NULL,
  lang_title VARCHAR(255) NOT NULL,
  lang_currency_name VARCHAR(4) NOT NULL DEFAULT '',
  lang_currency_symbol char(2) NOT NULL DEFAULT '',
  lang_decimal char(2) NOT NULL DEFAULT '',
  lang_comma char(2) NOT NULL DEFAULT '',
  lang_default TINYINT NOT NULL DEFAULT '0',
  lang_isrtl TINYINT NOT NULL DEFAULT '0',
  PRIMARY KEY (lang_id)
);";

$SQL[] = "CREATE INDEX lang_short ON core_sys_lang ( lang_short );";
$SQL[] = "CREATE INDEX lang_default ON core_sys_lang ( lang_default );";

$SQL[] = "CREATE TABLE core_sys_lang_words (
  word_id INT NOT NULL IDENTITY,
  lang_id INT NOT NULL,
  word_app VARCHAR(255) NOT NULL,
  word_pack VARCHAR(255) NOT NULL,
  word_key VARCHAR(64) NOT NULL,
word_default TEXT NOT NULL,
word_custom TEXT NULL,
  word_default_version VARCHAR(10) NOT NULL DEFAULT '1',
  word_custom_version VARCHAR(10) NULL,
  word_js TINYINT NOT NULL,
  PRIMARY KEY (word_id)
);";

$SQL[] = "CREATE INDEX word_js ON core_sys_lang_words ( word_js );";
$SQL[] = "CREATE INDEX word_find ON core_sys_lang_words ( lang_id,word_app,word_pack );";

$SQL[] = "CREATE TABLE core_sys_login (
  sys_login_id INT NOT NULL DEFAULT '0',
  sys_login_skin INT NULL,
  sys_login_language VARCHAR(32) NULL,
  sys_login_last_visit INT DEFAULT '0',
sys_cookie TEXT NULL,
  PRIMARY KEY (sys_login_id)
);";

?>