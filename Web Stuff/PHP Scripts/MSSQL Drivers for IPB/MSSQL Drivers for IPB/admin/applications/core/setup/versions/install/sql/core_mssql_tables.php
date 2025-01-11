<?php
/**
* Installation Schematic File
* Generated on Tue, 04 May 2010 11:57:52 +0000 GMT
*/
$TABLE[] = "CREATE TABLE admin_login_logs (
  admin_id INT NOT NULL IDENTITY,
  admin_ip_address VARCHAR(16) NOT NULL DEFAULT '0.0.0.0',
  admin_username VARCHAR(40) NOT NULL DEFAULT '',
  admin_time BIGINT NOT NULL DEFAULT '0',
  admin_success BIGINT NOT NULL DEFAULT '0',
admin_post_details VARCHAR(MAX) NULL,
  PRIMARY KEY (admin_id)
);";
$TABLE[] = "CREATE TABLE admin_logs (
  id bigINT NOT NULL IDENTITY,
  member_id INT NULL,
  ctime INT NOT NULL,
note VARCHAR(MAX) NULL,
  ip_address VARCHAR(255) NOT NULL,
  appcomponent VARCHAR(255) NOT NULL DEFAULT '',
  module VARCHAR(255) NOT NULL DEFAULT '',
  section VARCHAR(255) NOT NULL DEFAULT '',
  do VARCHAR(255) NOT NULL DEFAULT '',
  PRIMARY KEY (id)
);";
$TABLE[] = "CREATE TABLE admin_permission_rows (
  row_id INT NOT NULL,
  row_id_type VARCHAR(13) NOT NULL DEFAULT 'member',
row_perm_cache VARCHAR(MAX) NULL,
  row_updated INT NOT NULL DEFAULT '0',
  PRIMARY KEY (row_id,row_id_type)
);";
$TABLE[] = "CREATE TABLE announcements (
  announce_id BIGINT NOT NULL IDENTITY,
  announce_title VARCHAR(255) NOT NULL DEFAULT '',
announce_post VARCHAR(MAX) NOT NULL,
announce_forum VARCHAR(MAX) NULL,
  announce_member_id INT NOT NULL DEFAULT '0',
  announce_html_enabled SMALLINT NOT NULL DEFAULT '0',
  announce_nlbr_enabled SMALLINT NOT NULL DEFAULT '0',
  announce_views BIGINT NOT NULL DEFAULT '0',
  announce_start BIGINT NOT NULL DEFAULT '0',
  announce_end BIGINT NOT NULL DEFAULT '0',
  announce_active SMALLINT NOT NULL DEFAULT '1',
  PRIMARY KEY (announce_id)
);";
$TABLE[] = "CREATE TABLE api_log (
  api_log_id BIGINT NOT NULL IDENTITY,
  api_log_key VARCHAR(32) NOT NULL,
  api_log_ip VARCHAR(16) NOT NULL,
  api_log_date INT NOT NULL,
api_log_query VARCHAR(MAX) NOT NULL,
  api_log_allowed SMALLINT NOT NULL,
  PRIMARY KEY (api_log_id)
);";
$TABLE[] = "CREATE TABLE api_users (
  api_user_id BIGINT NOT NULL IDENTITY,
  api_user_key char(32) NOT NULL,
  api_user_name VARCHAR(32) NOT NULL,
api_user_perms VARCHAR(MAX) NOT NULL,
  api_user_ip VARCHAR(16) NOT NULL,
  PRIMARY KEY (api_user_id)
);";
$TABLE[] = "CREATE TABLE attachments (
  attach_id INT NOT NULL IDENTITY,
  attach_ext VARCHAR(10) NOT NULL DEFAULT '',
  attach_file VARCHAR(250) NOT NULL DEFAULT '',
  attach_location VARCHAR(250) NOT NULL DEFAULT '',
  attach_thumb_location VARCHAR(250) NOT NULL DEFAULT '',
  attach_thumb_width SMALLINT NOT NULL DEFAULT '0',
  attach_thumb_height SMALLINT NOT NULL DEFAULT '0',
  attach_is_image SMALLINT NOT NULL DEFAULT '0',
  attach_hits INT NOT NULL DEFAULT '0',
  attach_date INT NOT NULL DEFAULT '0',
  attach_post_key VARCHAR(32) NOT NULL DEFAULT '0',
  attach_member_id INT NOT NULL DEFAULT '0',
  attach_filesize INT NOT NULL DEFAULT '0',
  attach_rel_id INT NOT NULL DEFAULT '0',
  attach_rel_module VARCHAR(100) NOT NULL DEFAULT '0',
  attach_img_width INT NOT NULL DEFAULT '0',
  attach_img_height INT NOT NULL DEFAULT '0',
  PRIMARY KEY (attach_id)
);";
$TABLE[] = "CREATE TABLE attachments_type (
  atype_id INT NOT NULL IDENTITY,
  atype_extension VARCHAR(18) NOT NULL DEFAULT '',
  atype_mimetype VARCHAR(255) NOT NULL DEFAULT '',
  atype_post SMALLINT NOT NULL DEFAULT '1',
  atype_photo SMALLINT NOT NULL DEFAULT '0',
atype_img VARCHAR(MAX) NULL,
  PRIMARY KEY (atype_id)
);";
$TABLE[] = "CREATE TABLE badwords (
  wid INT NOT NULL IDENTITY,
  type VARCHAR(250) NOT NULL DEFAULT '',
  swop VARCHAR(250) NULL,
  m_exact SMALLINT DEFAULT '0',
  PRIMARY KEY (wid)
);";
$TABLE[] = "CREATE TABLE banfilters (
  ban_id INT NOT NULL IDENTITY,
  ban_type VARCHAR(10) NOT NULL DEFAULT 'ip',
ban_content VARCHAR(MAX) NULL,
  ban_date INT NOT NULL DEFAULT '0',
  ban_nocache INT NOT NULL DEFAULT '0',
  PRIMARY KEY (ban_id)
);";
$TABLE[] = "CREATE TABLE bbcode_mediatag (
  mediatag_id smallINT NOT NULL IDENTITY,
  mediatag_name VARCHAR(255) NOT NULL,
mediatag_match VARCHAR(MAX) NULL,
mediatag_replace VARCHAR(MAX) NULL,
mediatag_position INT NOT NULL DEFAULT 0,
  PRIMARY KEY (mediatag_id)
);";
$TABLE[] = "CREATE TABLE bulk_mail (
  mail_id INT NOT NULL IDENTITY,
  mail_subject VARCHAR(255) NOT NULL DEFAULT '',
mail_content VARCHAR(MAX) NOT NULL,
mail_groups VARCHAR(MAX) NULL,
mail_opts VARCHAR(MAX) NULL,
  mail_start INT NOT NULL DEFAULT '0',
  mail_updated INT NOT NULL DEFAULT '0',
  mail_sentto INT NOT NULL DEFAULT '0',
  mail_active SMALLINT NOT NULL DEFAULT '0',
  mail_pergo SMALLINT NOT NULL DEFAULT '0',
  PRIMARY KEY (mail_id)
);";
$TABLE[] = "CREATE TABLE cache_store (
  cs_key VARCHAR(255) NOT NULL DEFAULT '',
  cs_value VARCHAR(MAX) NULL,
  cs_extra VARCHAR(MAX) NULL,
  cs_array SMALLINT NOT NULL DEFAULT '0',
  cs_updated INT NOT NULL DEFAULT '0',
  PRIMARY KEY (cs_key)
);";
$TABLE[] = "CREATE TABLE captcha (
  captcha_unique_id VARCHAR(32) NOT NULL DEFAULT '',
  captcha_string VARCHAR(100) NOT NULL DEFAULT '',
  captcha_ipaddress VARCHAR(16) NOT NULL DEFAULT '',
  captcha_date INT NOT NULL DEFAULT '0',
  PRIMARY KEY (captcha_unique_id)
);";
$TABLE[] = "CREATE TABLE content_cache_posts (
  cache_content_id BIGINT NOT NULL DEFAULT '0',
cache_content VARCHAR(MAX) NULL,
  cache_updated INT NOT NULL DEFAULT '0'
);";
$TABLE[] = "CREATE TABLE content_cache_sigs (
  cache_content_id BIGINT NOT NULL DEFAULT '0',
cache_content VARCHAR(MAX) NULL,
  cache_updated INT NOT NULL DEFAULT '0'
);";
$TABLE[] = "CREATE TABLE converge_local (
  converge_api_code VARCHAR(32) NOT NULL DEFAULT '',
  converge_product_id INT NOT NULL DEFAULT '0',
  converge_added INT NOT NULL DEFAULT '0',
  converge_ip_address VARCHAR(16) NOT NULL DEFAULT '',
  converge_url VARCHAR(255) NOT NULL DEFAULT '',
  converge_active INT NOT NULL DEFAULT '0',
  converge_http_user VARCHAR(255) NOT NULL DEFAULT '',
  converge_http_pass VARCHAR(255) NOT NULL DEFAULT '',
  PRIMARY KEY (converge_api_code)
);";
$TABLE[] = "CREATE TABLE core_applications (
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
  app_hide_tab SMALLINT NOT NULL DEFAULT '0',
  PRIMARY KEY (app_id)
);";
$TABLE[] = "CREATE TABLE core_hooks (
  hook_id INT NOT NULL IDENTITY,
  hook_enabled SMALLINT NOT NULL DEFAULT '0',
  hook_name VARCHAR(255) NULL,
hook_desc VARCHAR(MAX) NULL,
  hook_author VARCHAR(255) NULL,
  hook_email VARCHAR(255) NULL,
hook_website VARCHAR(MAX) NULL,
hook_update_check VARCHAR(MAX) NULL,
hook_requirements VARCHAR(MAX) NULL,
  hook_version_human VARCHAR(32) NULL,
  hook_version_long VARCHAR(32) NOT NULL DEFAULT '0',
  hook_installed VARCHAR(13) NOT NULL DEFAULT '0',
  hook_updated VARCHAR(13) NOT NULL DEFAULT '0',
  hook_position INT NOT NULL DEFAULT '0',
hook_extra_data VARCHAR(MAX) NULL,
  hook_key VARCHAR(32) NULL,
  PRIMARY KEY (hook_id)
);";
$TABLE[] = "CREATE TABLE core_hooks_files (
  hook_file_id INT NOT NULL IDENTITY,
  hook_hook_id INT NOT NULL DEFAULT '0',
  hook_file_stored VARCHAR(255) NULL,
  hook_file_real VARCHAR(255) NULL,
  hook_type VARCHAR(32) NULL,
  hook_classname VARCHAR(255) NULL,
hook_data VARCHAR(MAX) NULL,
hooks_source VARCHAR(MAX) NULL,
  PRIMARY KEY (hook_file_id)
);";
$TABLE[] = "CREATE TABLE core_incoming_emails (
  rule_id INT NOT NULL IDENTITY,
  rule_criteria_field VARCHAR(4) NOT NULL,
  rule_criteria_type VARCHAR(4) NOT NULL,
rule_criteria_value VARCHAR(MAX) NOT NULL,
  rule_app VARCHAR(255) NOT NULL,
  rule_added_by INT NOT NULL,
  rule_added_date INT NOT NULL,
  PRIMARY KEY (rule_id)
);";
$TABLE[] = "CREATE TABLE core_item_markers (
  item_key char(32) NOT NULL,
  item_member_id INT NOT NULL DEFAULT '0',
  item_app VARCHAR(255) NOT NULL DEFAULT 'core',
  item_last_update INT NOT NULL DEFAULT '0',
  item_last_saved INT NOT NULL DEFAULT '0',
  item_unread_count INT NOT NULL DEFAULT '0',
item_read_array VARCHAR(MAX) NULL,
  item_global_reset INT NOT NULL DEFAULT '0',
  item_app_key_1 INT NOT NULL DEFAULT '0',
  item_app_key_2 INT NOT NULL DEFAULT '0',
  item_app_key_3 INT NOT NULL DEFAULT '0',
  item_is_deleted INT NOT NULL DEFAULT '0'
);";
$TABLE[] = "CREATE TABLE core_item_markers_storage (
  item_member_id INT NOT NULL DEFAULT '0',
item_markers VARCHAR(MAX) NULL,
  item_last_updated INT NOT NULL DEFAULT '0',
  item_last_saved INT NOT NULL DEFAULT '0',
  PRIMARY KEY (item_member_id)
);";
$TABLE[] = "CREATE TABLE core_like (
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
$TABLE[] = "CREATE TABLE core_like_cache (
  like_cache_id VARCHAR(32) NOT NULL,
  like_cache_app VARCHAR(150) NOT NULL DEFAULT '',
  like_cache_area VARCHAR(200) NOT NULL DEFAULT '',
  like_cache_rel_id BIGINT NOT NULL DEFAULT '0',
  like_cache_data VARCHAR(MAX),
  like_cache_expire INT NOT NULL DEFAULT '0',
  PRIMARY KEY (like_cache_id)
);";
$TABLE[] = "CREATE TABLE core_rss_imported (
  rss_guid char(32) NOT NULL,
  rss_foreign_key VARCHAR(100) NOT NULL DEFAULT '',
  PRIMARY KEY (rss_guid)
);";
$TABLE[] = "CREATE TABLE core_share_links (
  share_id BIGINT NOT NULL IDENTITY,
  share_title VARCHAR(255) NOT NULL DEFAULT '',
  share_key VARCHAR(50) NOT NULL DEFAULT '',
  share_enabled INT NOT NULL DEFAULT '0',
  share_position INT NOT NULL DEFAULT '0',
  share_canonical INT NOT NULL DEFAULT '1',
  PRIMARY KEY (share_id)
);";
$TABLE[] = "CREATE TABLE core_share_links_caches (
  cache_id INT NOT NULL IDENTITY,
  cache_key VARCHAR(255) NOT NULL DEFAULT '',
cache_data VARCHAR(MAX) NULL,
  cache_date INT NOT NULL DEFAULT '0',
  PRIMARY KEY (cache_id)
);";
$TABLE[] = "CREATE TABLE core_share_links_log (
  log_id INT NOT NULL IDENTITY,
  log_date INT NOT NULL DEFAULT '0',
  log_member_id INT NOT NULL DEFAULT '0',
log_url VARCHAR(MAX) NULL,
log_title VARCHAR(MAX) NULL,
  log_share_key VARCHAR(50) NOT NULL DEFAULT '',
  log_data_app VARCHAR(50) NOT NULL DEFAULT '',
  log_data_type VARCHAR(50) NOT NULL DEFAULT '',
  log_data_primary_id INT NOT NULL DEFAULT '0',
  log_data_secondary_id INT NOT NULL DEFAULT '0',
  log_ip_address VARCHAR(16) NOT NULL DEFAULT '',
  PRIMARY KEY (log_id)
);";
$TABLE[] = "CREATE TABLE core_soft_delete_log (
  sdl_id INT NOT NULL IDENTITY,
  sdl_obj_id INT NOT NULL DEFAULT '0',
  sdl_obj_key VARCHAR(20) NOT NULL DEFAULT '',
  sdl_obj_member_id INT NOT NULL DEFAULT '0',
  sdl_obj_date INT NOT NULL DEFAULT '0',
sdl_obj_reason VARCHAR(MAX) NULL,
  sdl_locked INT NOT NULL DEFAULT '0',
  PRIMARY KEY (sdl_id)
);";
$TABLE[] = "CREATE TABLE core_sys_conf_settings (
  conf_id INT NOT NULL IDENTITY,
  conf_title VARCHAR(255) NOT NULL DEFAULT '',
conf_description VARCHAR(MAX) NULL,
  conf_group SMALLINT NOT NULL DEFAULT '0',
  conf_type VARCHAR(255) NOT NULL DEFAULT '',
  conf_key VARCHAR(255) NOT NULL DEFAULT '',
conf_value VARCHAR(MAX) NULL,
conf_default VARCHAR(MAX) NULL,
conf_extra VARCHAR(MAX) NULL,
conf_evalphp VARCHAR(MAX) NULL,
  conf_protected SMALLINT NOT NULL DEFAULT '0',
  conf_position SMALLINT NOT NULL DEFAULT '0',
  conf_start_group VARCHAR(255) NOT NULL DEFAULT '',
  conf_add_cache SMALLINT NOT NULL DEFAULT '1',
conf_keywords VARCHAR(MAX) NULL,
  PRIMARY KEY (conf_id)
);";
$TABLE[] = "CREATE TABLE core_sys_cp_sessions (
  session_id VARCHAR(32) NOT NULL DEFAULT '',
  session_ip_address VARCHAR(32) NOT NULL DEFAULT '',
  session_member_name VARCHAR(250) NOT NULL DEFAULT '',
  session_member_id INT NOT NULL DEFAULT '0',
  session_member_login_key VARCHAR(32) NOT NULL DEFAULT '',
  session_location VARCHAR(64) NOT NULL DEFAULT '',
  session_log_in_time INT NOT NULL DEFAULT '0',
  session_running_time INT NOT NULL DEFAULT '0',
session_url VARCHAR(MAX) NULL,
session_app_data VARCHAR(MAX) NULL,
  PRIMARY KEY (session_id)
);";
$TABLE[] = "CREATE TABLE core_sys_lang (
  lang_id INT NOT NULL IDENTITY,
  lang_short VARCHAR(18) NOT NULL,
  lang_title VARCHAR(255) NOT NULL,
  lang_default SMALLINT NOT NULL DEFAULT '0',
  lang_isrtl SMALLINT NOT NULL DEFAULT '0',
  lang_protected SMALLINT NOT NULL DEFAULT '0',
  PRIMARY KEY (lang_id)
);";
$TABLE[] = "CREATE TABLE core_sys_lang_words (
  word_id BIGINT NOT NULL IDENTITY,
  lang_id INT NOT NULL,
  word_app VARCHAR(255) NOT NULL,
  word_pack VARCHAR(255) NOT NULL,
  word_key VARCHAR(64) NOT NULL,
word_default VARCHAR(MAX) NOT NULL,
word_custom VARCHAR(MAX) NULL,
  word_default_version VARCHAR(10) NOT NULL DEFAULT '1',
  word_custom_version VARCHAR(10) NULL,
  word_js SMALLINT NOT NULL DEFAULT '0',
  PRIMARY KEY (word_id)
);";
$TABLE[] = "CREATE TABLE core_sys_login (
  sys_login_id INT NOT NULL DEFAULT '0',
sys_cookie VARCHAR(MAX) NULL,
  PRIMARY KEY (sys_login_id)
);";
$TABLE[] = "CREATE TABLE core_sys_module (
  sys_module_id INT NOT NULL IDENTITY,
  sys_module_title VARCHAR(32) NOT NULL DEFAULT '',
  sys_module_application VARCHAR(32) NOT NULL DEFAULT '',
  sys_module_key VARCHAR(32) NOT NULL DEFAULT '',
  sys_module_description VARCHAR(100) NOT NULL DEFAULT '',
  sys_module_version VARCHAR(32) NOT NULL,
  sys_module_parent VARCHAR(32) NOT NULL DEFAULT '',
  sys_module_protected SMALLINT NOT NULL DEFAULT '0',
  sys_module_visible SMALLINT NOT NULL DEFAULT '1',
  sys_module_tables VARCHAR(255) NOT NULL DEFAULT '',
  sys_module_hooks VARCHAR(255) NOT NULL DEFAULT '',
  sys_module_position INT NOT NULL DEFAULT '0',
  sys_module_admin INT NOT NULL DEFAULT '0',
  PRIMARY KEY (sys_module_id)
);";
$TABLE[] = "CREATE TABLE core_sys_settings_titles (
  conf_title_id SMALLINT NOT NULL IDENTITY,
  conf_title_title VARCHAR(255) NOT NULL DEFAULT '',
conf_title_desc VARCHAR(MAX) NULL,
  conf_title_count SMALLINT NOT NULL DEFAULT '0',
  conf_title_noshow SMALLINT NOT NULL DEFAULT '0',
  conf_title_keyword VARCHAR(200) NOT NULL DEFAULT '',
  conf_title_app VARCHAR(200) NOT NULL DEFAULT '',
  conf_title_tab VARCHAR(32) NULL,
  PRIMARY KEY (conf_title_id)
);";

$TABLE[] = "CREATE TABLE core_uagent_groups (
  ugroup_id INT NOT NULL IDENTITY,
  ugroup_title VARCHAR(255) NOT NULL DEFAULT '',
ugroup_array VARCHAR(MAX) NULL,
  PRIMARY KEY (ugroup_id)
);";
$TABLE[] = "CREATE TABLE core_uagents (
  uagent_id INT NOT NULL IDENTITY,
  uagent_key VARCHAR(200) NOT NULL DEFAULT '',
  uagent_name VARCHAR(200) NOT NULL DEFAULT '',
uagent_regex VARCHAR(MAX) NULL,
  uagent_regex_capture INT NOT NULL DEFAULT '0',
  uagent_type VARCHAR(200) NOT NULL DEFAULT '',
  uagent_position INT NOT NULL DEFAULT '0',
  PRIMARY KEY (uagent_id)
);";
$TABLE[] = "CREATE TABLE custom_bbcode (
  bbcode_id INT NOT NULL IDENTITY,
  bbcode_title VARCHAR(255) NOT NULL DEFAULT '',
bbcode_desc VARCHAR(MAX) NULL,
  bbcode_tag VARCHAR(255) NOT NULL DEFAULT '',
bbcode_replace VARCHAR(MAX) NULL,
  bbcode_useoption SMALLINT NOT NULL DEFAULT '0',
bbcode_example VARCHAR(MAX) NULL,
  bbcode_switch_option INT NOT NULL DEFAULT '0',
  bbcode_menu_option_text VARCHAR(200) NOT NULL DEFAULT '',
  bbcode_menu_content_text VARCHAR(200) NOT NULL DEFAULT '',
  bbcode_single_tag SMALLINT NOT NULL DEFAULT '0',
  bbcode_groups VARCHAR(255) NULL,
  bbcode_sections VARCHAR(255) NULL,
  bbcode_php_plugin VARCHAR(255) NULL,
  bbcode_no_parsing SMALLINT NOT NULL DEFAULT '0',
  bbcode_protected SMALLINT NOT NULL DEFAULT '0',
  bbcode_aliases VARCHAR(255) NULL,
  bbcode_optional_option SMALLINT NOT NULL DEFAULT '0',
  bbcode_image VARCHAR(255) NULL,
  bbcode_strip_search SMALLINT NOT NULL DEFAULT '0',
  bbcode_app VARCHAR(50) NOT NULL DEFAULT '',
bbcode_custom_regex VARCHAR(MAX) NULL,
  PRIMARY KEY (bbcode_id)
);";
$TABLE[] = "CREATE TABLE dnames_change (
  dname_id INT NOT NULL IDENTITY,
  dname_member_id INT NOT NULL DEFAULT '0',
  dname_date INT NOT NULL DEFAULT '0',
  dname_ip_address VARCHAR(16) NOT NULL DEFAULT '',
  dname_previous VARCHAR(255) NOT NULL DEFAULT '',
  dname_current VARCHAR(255) NOT NULL DEFAULT '',
  PRIMARY KEY (dname_id)
);";
$TABLE[] = "CREATE TABLE email_logs (
  email_id INT NOT NULL IDENTITY,
  email_subject VARCHAR(255) NOT NULL DEFAULT '',
email_content VARCHAR(MAX) NULL,
  email_date INT NOT NULL DEFAULT '0',
  from_member_id INT NOT NULL DEFAULT '0',
  from_email_address VARCHAR(250) NOT NULL DEFAULT '',
  from_ip_address VARCHAR(16) NOT NULL DEFAULT '127.0.0.1',
  to_member_id INT NOT NULL DEFAULT '0',
  to_email_address VARCHAR(250) NOT NULL DEFAULT '',
  PRIMARY KEY (email_id)
);";
$TABLE[] = "CREATE TABLE emoticons (
  id SMALLINT NOT NULL IDENTITY,
  typed VARCHAR(32) NOT NULL DEFAULT '',
  image VARCHAR(128) NOT NULL DEFAULT '',
  clickable SMALLINT NOT NULL DEFAULT '1',
  emo_set VARCHAR(64) NOT NULL DEFAULT 'default',
  PRIMARY KEY (id)
);";
$TABLE[] = "CREATE TABLE error_logs (
  log_id INT NOT NULL IDENTITY,
  log_member INT NOT NULL DEFAULT '0',
  log_date VARCHAR(13) NOT NULL DEFAULT '0',
log_error VARCHAR(MAX) NULL,
  log_error_code VARCHAR(24) NOT NULL DEFAULT '0',
  log_ip_address VARCHAR(32) NOT NULL,
log_request_uri VARCHAR(MAX) NULL,
  PRIMARY KEY (log_id)
);";
$TABLE[] = "CREATE TABLE faq (
  id INT NOT NULL IDENTITY,
  title VARCHAR(128) NOT NULL DEFAULT '',
text VARCHAR(MAX) NULL,
description VARCHAR(MAX) NULL,
  position SMALLINT NOT NULL DEFAULT '0',
  app VARCHAR(32) NOT NULL DEFAULT 'core',
  PRIMARY KEY (id)
);";
$TABLE[] = "CREATE TABLE groups (
  g_id BIGINT NOT NULL IDENTITY,
  g_view_board SMALLINT NULL,
  g_mem_info SMALLINT NULL,
  g_other_topics SMALLINT NULL,
  g_use_search SMALLINT NULL,
  g_email_friend SMALLINT NULL,
  g_edit_profile SMALLINT NULL,
  g_post_new_topics SMALLINT NULL,
  g_reply_own_topics SMALLINT NULL,
  g_reply_other_topics SMALLINT NULL,
  g_edit_posts SMALLINT NULL,
  g_delete_own_posts SMALLINT NULL,
  g_open_close_posts SMALLINT NULL,
  g_delete_own_topics SMALLINT NULL,
  g_post_polls SMALLINT NULL,
  g_vote_polls SMALLINT NULL,
  g_use_pm SMALLINT DEFAULT '0',
  g_is_supmod SMALLINT NULL,
  g_access_cp SMALLINT NULL,
  g_title VARCHAR(32) NOT NULL DEFAULT '',
  g_append_edit SMALLINT NULL,
  g_access_offline SMALLINT NULL,
  g_avoid_q SMALLINT NULL,
  g_avoid_flood SMALLINT NULL,
g_icon VARCHAR(MAX) NULL,
  g_attach_max bigINT NULL,
  g_avatar_upload SMALLINT DEFAULT '0',
  prefix VARCHAR(250) NULL,
  suffix VARCHAR(250) NULL,
  g_max_messages INT DEFAULT '50',
  g_max_mass_pm INT DEFAULT '0',
  g_search_flood INT DEFAULT '20',
  g_edit_cutoff INT DEFAULT '0',
  g_promotion VARCHAR(10) DEFAULT '-1&-1',
  g_hide_from_list SMALLINT DEFAULT '0',
  g_post_closed SMALLINT DEFAULT '0',
  g_perm_id VARCHAR(255) NOT NULL DEFAULT '',
  g_photo_max_vars VARCHAR(200) DEFAULT '100:150:150',
  g_dohtml SMALLINT NOT NULL DEFAULT '0',
  g_edit_topic SMALLINT NOT NULL DEFAULT '0',
  g_email_limit VARCHAR(15) NOT NULL DEFAULT '10:15',
  g_bypass_badwords SMALLINT NOT NULL DEFAULT '0',
  g_can_msg_attach SMALLINT NOT NULL DEFAULT '0',
  g_attach_per_post INT NOT NULL DEFAULT '0',
  g_topic_rate_setting SMALLINT NOT NULL DEFAULT '0',
  g_dname_changes INT NOT NULL DEFAULT '0',
  g_dname_date INT NOT NULL DEFAULT '0',
    g_mod_preview SMALLINT NOT NULL DEFAULT '0',
  g_rep_max_positive INT NOT NULL DEFAULT '0',
  g_rep_max_negative INT NOT NULL DEFAULT '0',
  g_signature_limits VARCHAR(255) NULL,
  g_can_add_friends SMALLINT NOT NULL DEFAULT '1',
  g_hide_online_list SMALLINT NOT NULL DEFAULT '0',
  g_bitoptions BIGINT NOT NULL DEFAULT '0',
  g_pm_perday SMALLINT NOT NULL DEFAULT '0',
  g_mod_post_unit BIGINT NOT NULL DEFAULT '0',
  g_ppd_unit BIGINT NOT NULL DEFAULT '0',
  g_displayname_unit BIGINT NOT NULL DEFAULT '0',
  g_sig_unit BIGINT NOT NULL DEFAULT '0',
  g_ppd_limit BIGINT NOT NULL DEFAULT '0',
  g_pm_flood_mins BIGINT NOT NULL DEFAULT '0',
  g_max_notifications INT NOT NULL DEFAULT '0',
  g_max_bgimg_upload INT NOT NULL DEFAULT '0',
  PRIMARY KEY (g_id)
);";
$TABLE[] = "CREATE TABLE ignored_users (
  ignore_id INT NOT NULL IDENTITY,
  ignore_owner_id INT NOT NULL DEFAULT '0',
  ignore_ignore_id INT NOT NULL DEFAULT '0',
  ignore_messages INT NOT NULL DEFAULT '0',
  ignore_topics INT NOT NULL DEFAULT '0',
  PRIMARY KEY (ignore_id)
);";
$TABLE[] = "CREATE TABLE inline_notifications (
  notify_id INT NOT NULL IDENTITY,
  notify_to_id INT NOT NULL DEFAULT '0',
  notify_sent INT NOT NULL DEFAULT '0',
  notify_read INT NOT NULL DEFAULT '0',
notify_title VARCHAR(MAX) NULL,
notify_text VARCHAR(MAX) NULL,
  notify_from_id INT NOT NULL DEFAULT '0',
  notify_type_key VARCHAR(255) NULL,
notify_url VARCHAR(MAX) NULL,
  PRIMARY KEY (notify_id)
);";
$TABLE[] = "CREATE TABLE login_methods (
  login_id INT NOT NULL IDENTITY,
  login_title VARCHAR(255) NOT NULL DEFAULT '',
  login_description VARCHAR(255) NOT NULL DEFAULT '',
  login_folder_name VARCHAR(255) NOT NULL DEFAULT '',
  login_maintain_url VARCHAR(255) NOT NULL DEFAULT '',
  login_register_url VARCHAR(255) NOT NULL DEFAULT '',
login_alt_login_html VARCHAR(MAX) NULL,
login_alt_acp_html VARCHAR(MAX) NULL,
  login_settings INT NOT NULL DEFAULT '0',
  login_enabled INT NOT NULL DEFAULT '0',
  login_safemode INT NOT NULL DEFAULT '0',
  login_replace_form INT NOT NULL DEFAULT '0',
  login_user_id VARCHAR(255) NOT NULL DEFAULT 'username',
  login_login_url VARCHAR(255) NOT NULL DEFAULT '',
  login_logout_url VARCHAR(255) NOT NULL DEFAULT '',
  login_order SMALLINT NOT NULL DEFAULT '0',
  PRIMARY KEY (login_id)
);";
$TABLE[] = "CREATE TABLE mail_error_logs (
  mlog_id INT NOT NULL IDENTITY,
  mlog_date INT NOT NULL DEFAULT '0',
  mlog_to VARCHAR(250) NOT NULL DEFAULT '',
  mlog_from VARCHAR(250) NOT NULL DEFAULT '',
  mlog_subject VARCHAR(250) NOT NULL DEFAULT '',
  mlog_content VARCHAR(250) NOT NULL DEFAULT '',
mlog_msg VARCHAR(MAX) NULL,
  mlog_code VARCHAR(200) NOT NULL DEFAULT '',
mlog_smtp_msg VARCHAR(MAX) NULL,
  PRIMARY KEY (mlog_id)
);";
$TABLE[] = "CREATE TABLE mail_queue (
  mail_id INT NOT NULL IDENTITY,
  mail_date INT NOT NULL DEFAULT '0',
  mail_to VARCHAR(255) NOT NULL DEFAULT '',
  mail_from VARCHAR(255) NOT NULL DEFAULT '',
mail_subject VARCHAR(MAX) NULL,
mail_content VARCHAR(MAX) NULL,
  mail_html_on INT NOT NULL DEFAULT '0',
  PRIMARY KEY (mail_id)
);";
$TABLE[] = "CREATE TABLE member_status_actions (
  action_id INT NOT NULL IDENTITY,
  action_status_id BIGINT NOT NULL DEFAULT '0',
  action_reply_id BIGINT NOT NULL DEFAULT '0',
  action_member_id BIGINT NOT NULL DEFAULT '0',
  action_date BIGINT NOT NULL DEFAULT '0',
  action_key VARCHAR(200) NOT NULL DEFAULT '',
  action_status_owner BIGINT NOT NULL DEFAULT '0',
  action_app VARCHAR(255) NOT NULL DEFAULT 'members',
action_custom_text VARCHAR(MAX) NULL,
  action_custom INT NOT NULL DEFAULT '0',
action_custom_url VARCHAR(MAX) NULL,
  PRIMARY KEY (action_id)
);";
$TABLE[] = "CREATE TABLE member_status_replies (
  reply_id INT NOT NULL IDENTITY,
  reply_status_id BIGINT NOT NULL DEFAULT '0',
  reply_member_id BIGINT NOT NULL DEFAULT '0',
  reply_date BIGINT NOT NULL DEFAULT '0',
reply_content VARCHAR(MAX) NULL,
  PRIMARY KEY (reply_id)
);";
$TABLE[] = "CREATE TABLE member_status_updates (
  status_id INT NOT NULL IDENTITY,
  status_member_id BIGINT NOT NULL DEFAULT '0',
  status_date BIGINT NOT NULL DEFAULT '0',
status_content VARCHAR(MAX) NULL,
  status_replies BIGINT NOT NULL DEFAULT '0',
status_last_ids VARCHAR(MAX) NULL,
  status_is_latest INT NOT NULL DEFAULT '0',
  status_is_locked INT NOT NULL DEFAULT '0',
  status_hash VARCHAR(32) NOT NULL DEFAULT '',
  status_imported INT NOT NULL DEFAULT '0',
  status_creator VARCHAR(100) NOT NULL DEFAULT '',
  PRIMARY KEY (status_id)
);";
$TABLE[] = "CREATE TABLE members (
  member_id INT NOT NULL IDENTITY,
  name VARCHAR(255) NOT NULL DEFAULT '',
  member_group_id SMALLINT NOT NULL DEFAULT '0',
  email VARCHAR(150) NOT NULL DEFAULT '',
  joined INT NOT NULL DEFAULT '0',
  ip_address VARCHAR(16) NOT NULL DEFAULT '',
  posts INT DEFAULT '0',
  title VARCHAR(64) NULL,
  allow_admin_mails SMALLINT NULL,
  time_offset VARCHAR(10) NULL,
  hide_email VARCHAR(8) NULL,
  email_full SMALLINT NULL,
  skin SMALLINT NULL,
  warn_level INT NULL,
  warn_lastwarn INT NOT NULL DEFAULT '0',
  language VARCHAR(32) NULL,
  last_post INT NULL,
  restrict_post VARCHAR(100) NOT NULL DEFAULT '0',
  view_sigs SMALLINT DEFAULT '1',
  view_img SMALLINT DEFAULT '1',
  view_avs SMALLINT DEFAULT '1',
  bday_day INT NOT NULL,
  bday_month INT NOT NULL,
  bday_year INT NULL,
  msg_count_new INT NOT NULL DEFAULT '0',
  msg_count_total INT NOT NULL DEFAULT '0',
  msg_count_reset INT NOT NULL DEFAULT '0',
  msg_show_notification INT NOT NULL DEFAULT '0',
  misc VARCHAR(128) NULL,
  last_visit INT DEFAULT '0',
  last_activity INT DEFAULT '0',
  dst_in_use SMALLINT DEFAULT '0',
  view_prefs VARCHAR(64) DEFAULT '-1&-1',
  coppa_user SMALLINT DEFAULT '0',
  mod_posts VARCHAR(100) NOT NULL DEFAULT '0',
  auto_track VARCHAR(50) DEFAULT '0',
  temp_ban VARCHAR(100) DEFAULT '0',
  sub_end INT NOT NULL DEFAULT '0',
  login_anonymous char(3) NOT NULL DEFAULT '0&0',
ignored_users VARCHAR(MAX) NULL,
  mgroup_others VARCHAR(255) NOT NULL DEFAULT '',
  org_perm_id VARCHAR(255) NOT NULL DEFAULT '',
  member_login_key VARCHAR(32) NOT NULL DEFAULT '',
  member_login_key_expire INT NOT NULL DEFAULT '0',
  subs_pkg_chosen SMALLINT NOT NULL DEFAULT '0',
has_blog VARCHAR(MAX) NULL,
  has_gallery SMALLINT NOT NULL DEFAULT '0',
  members_editor_choice char(3) NOT NULL DEFAULT 'std',
  members_auto_dst SMALLINT NOT NULL DEFAULT '1',
  members_display_name VARCHAR(255) NOT NULL DEFAULT '',
  members_seo_name VARCHAR(255) NOT NULL DEFAULT '',
  members_created_remote SMALLINT NOT NULL DEFAULT '0',
members_cache VARCHAR(MAX) NULL,
  members_disable_pm INT NOT NULL DEFAULT '0',
  members_l_display_name VARCHAR(255) NOT NULL DEFAULT '',
  members_l_username VARCHAR(255) NOT NULL DEFAULT '',
failed_logins VARCHAR(MAX) NULL,
  failed_login_count SMALLINT NOT NULL DEFAULT '0',
  members_profile_views BIGINT NOT NULL DEFAULT '0',
  members_pass_hash VARCHAR(32) NOT NULL DEFAULT '',
  members_pass_salt VARCHAR(5) NOT NULL DEFAULT '',
identity_url VARCHAR(MAX) NULL,
  member_banned SMALLINT NOT NULL DEFAULT '0',
    member_uploader VARCHAR(32) NOT NULL DEFAULT 'default',
  members_bitoptions BIGINT NOT NULL DEFAULT '0',
  fb_uid bigINT NOT NULL DEFAULT '0',
  fb_lastsync INT NOT NULL DEFAULT '0',
  members_day_posts VARCHAR(32) NOT NULL DEFAULT '0,0',
  live_id VARCHAR(32) NULL,
  twitter_token VARCHAR(255) NOT NULL DEFAULT '',
  twitter_secret VARCHAR(255) NOT NULL DEFAULT '',
  twitter_id VARCHAR(255) NOT NULL DEFAULT '',
  notification_cnt INT NOT NULL DEFAULT '0',
  tc_lastsync INT NOT NULL DEFAULT '0',
  fb_session VARCHAR(200) NOT NULL DEFAULT '',
  fb_emailhash VARCHAR(60) NOT NULL DEFAULT '',
fb_token VARCHAR(MAX) NULL,
ips_mobile_token VARCHAR(64) NULL,
  PRIMARY KEY (member_id)
);";
$TABLE[] = "CREATE TABLE members_partial (
  partial_id INT NOT NULL IDENTITY,
  partial_member_id INT NOT NULL DEFAULT '0',
  partial_date INT NOT NULL DEFAULT '0',
  partial_email_ok INT NOT NULL DEFAULT '0',
  PRIMARY KEY (partial_id)
);";

$TABLE[] = "CREATE TABLE mobile_notifications (
  id INT IDENTITY,
  notify_title VARCHAR(MAX) NOT NULL,
  notify_date INT NOT NULL,
  member_id INT NOT NULL,
  notify_sent INT NOT NULL DEFAULT '0'
);";

$TABLE[] = "CREATE TABLE openid_temp (
  id VARCHAR(32) NOT NULL,
referrer VARCHAR(MAX) NULL,
  privacy SMALLINT NOT NULL DEFAULT '0',
  cookiedate SMALLINT NOT NULL DEFAULT '0',
fullurl VARCHAR(MAX) NULL,
  PRIMARY KEY (id)
);";
$TABLE[] = "CREATE TABLE permission_index (
  perm_id BIGINT NOT NULL IDENTITY,
  app VARCHAR(32) NOT NULL,
  perm_type VARCHAR(32) NOT NULL,
  perm_type_id BIGINT NOT NULL,
perm_view VARCHAR(MAX) NOT NULL,
perm_2 VARCHAR(MAX) NULL,
perm_3 VARCHAR(MAX) NULL,
perm_4 VARCHAR(MAX) NULL,
perm_5 VARCHAR(MAX) NULL,
perm_6 VARCHAR(MAX) NULL,
perm_7 VARCHAR(MAX) NULL,
  owner_only SMALLINT NOT NULL DEFAULT '0',
  friend_only SMALLINT NOT NULL DEFAULT '0',
  authorized_users VARCHAR(255) NULL,
  PRIMARY KEY (perm_id)
);";
$TABLE[] = "CREATE TABLE pfields_content (
  member_id INT NOT NULL DEFAULT '0',
  updated INT DEFAULT '0',
field_1 VARCHAR(MAX) NULL,
field_2 VARCHAR(MAX) NULL,
field_3 VARCHAR(MAX) NULL,
field_4 VARCHAR(MAX) NULL,
field_5 VARCHAR(MAX) NULL,
field_6 VARCHAR(MAX) NULL,
field_7 VARCHAR(MAX) NULL,
field_8 VARCHAR(MAX) NULL,
field_13 VARCHAR(MAX) NULL,
field_14 VARCHAR(MAX) NULL,
field_15 VARCHAR(MAX) NULL,
field_16 VARCHAR(MAX) NULL,
field_17 VARCHAR(MAX) NULL,
  PRIMARY KEY (member_id)
);";
$TABLE[] = "CREATE TABLE pfields_data (
  pf_id SMALLINT NOT NULL IDENTITY,
  pf_title VARCHAR(250) NOT NULL DEFAULT '',
  pf_desc VARCHAR(250) NOT NULL DEFAULT '',
pf_content VARCHAR(MAX) NULL,
  pf_type VARCHAR(250) NOT NULL DEFAULT '',
  pf_not_null SMALLINT NOT NULL DEFAULT '0',
  pf_member_hide SMALLINT NOT NULL DEFAULT '0',
  pf_max_input SMALLINT NOT NULL DEFAULT '0',
  pf_member_edit SMALLINT NOT NULL DEFAULT '0',
  pf_position SMALLINT NOT NULL DEFAULT '0',
  pf_show_on_reg SMALLINT NOT NULL DEFAULT '0',
pf_input_format VARCHAR(MAX) NULL,
  pf_admin_only SMALLINT NOT NULL DEFAULT '0',
pf_topic_format VARCHAR(MAX) NULL,
  pf_group_id INT NOT NULL,
  pf_icon VARCHAR(255) NULL,
  pf_key VARCHAR(255) NULL,
  pf_search_type varchar(5) NOT NULL default 'loose',
  pf_filtering TINYINT NOT NULL DEFAULT '0',
  PRIMARY KEY (pf_id)
);";
$TABLE[] = "CREATE TABLE pfields_groups (
  pf_group_id INT NOT NULL IDENTITY,
  pf_group_name VARCHAR(255) NOT NULL,
  pf_group_key VARCHAR(255) NOT NULL,
  PRIMARY KEY (pf_group_id)
);";
$TABLE[] = "CREATE TABLE profile_comments (
  comment_id INT NOT NULL IDENTITY,
  comment_for_member_id BIGINT NOT NULL DEFAULT '0',
  comment_by_member_id BIGINT NOT NULL DEFAULT '0',
  comment_date BIGINT NOT NULL DEFAULT '0',
  comment_ip_address VARCHAR(16) NOT NULL DEFAULT '0',
comment_content VARCHAR(MAX) NULL,
  comment_approved SMALLINT NOT NULL DEFAULT '0',
  PRIMARY KEY (comment_id)
);";
$TABLE[] = "CREATE TABLE profile_friends (
  friends_id INT NOT NULL IDENTITY,
  friends_member_id BIGINT NOT NULL DEFAULT '0',
  friends_friend_id BIGINT NOT NULL DEFAULT '0',
  friends_approved SMALLINT NOT NULL DEFAULT '0',
  friends_added BIGINT NOT NULL DEFAULT '0',
  PRIMARY KEY (friends_id)
);";
$TABLE[] = "CREATE TABLE profile_friends_flood (
  friends_id INT NOT NULL IDENTITY,
  friends_member_id BIGINT NOT NULL DEFAULT '0',
  friends_friend_id BIGINT NOT NULL DEFAULT '0',
  friends_removed BIGINT NOT NULL DEFAULT '0',
  PRIMARY KEY (friends_id)
);";
$TABLE[] = "CREATE TABLE profile_portal (
  pp_member_id INT NOT NULL DEFAULT '0',
pp_last_visitors VARCHAR(MAX) NULL,
  pp_rating_hits BIGINT NOT NULL DEFAULT '0',
  pp_rating_value BIGINT NOT NULL DEFAULT '0',
  pp_rating_real BIGINT NOT NULL DEFAULT '0',
  pp_main_photo VARCHAR(255) NOT NULL DEFAULT '',
  pp_main_width BIGINT NOT NULL DEFAULT '0',
  pp_main_height BIGINT NOT NULL DEFAULT '0',
  pp_thumb_photo VARCHAR(255) NOT NULL DEFAULT '',
  pp_thumb_width BIGINT NOT NULL DEFAULT '0',
  pp_thumb_height BIGINT NOT NULL DEFAULT '0',
  pp_gender VARCHAR(10) NOT NULL DEFAULT '',
  pp_setting_moderate_comments SMALLINT NOT NULL DEFAULT '0',
  pp_setting_moderate_friends SMALLINT NOT NULL DEFAULT '0',
  pp_setting_count_friends INT NOT NULL DEFAULT '0',
  pp_setting_count_comments INT NOT NULL DEFAULT '0',
  pp_setting_count_visitors INT NOT NULL DEFAULT '0',
pp_about_me VARCHAR(MAX) NULL,
  pp_reputation_points INT NOT NULL DEFAULT '0',
notes VARCHAR(MAX) NULL,
signature VARCHAR(MAX) NULL,
  avatar_location VARCHAR(255) NULL,
  avatar_size VARCHAR(9) NOT NULL DEFAULT '0',
  avatar_type VARCHAR(15) NULL,
pconversation_filters VARCHAR(MAX) NULL,
fb_photo VARCHAR(MAX) NULL,
fb_photo_thumb VARCHAR(MAX) NULL,
  fb_bwoptions BIGINT NOT NULL DEFAULT '0',
tc_photo VARCHAR(MAX) NULL,
  tc_bwoptions BIGINT NOT NULL DEFAULT '0',
  tc_last_sid_import bigINT NOT NULL DEFAULT '0',
pp_customization VARCHAR(MAX) NULL,
  PRIMARY KEY (pp_member_id)
);";
$TABLE[] = "CREATE TABLE profile_portal_views (
  views_member_id INT NOT NULL DEFAULT '0'
);";
$TABLE[] = "CREATE TABLE profile_ratings (
  rating_id INT NOT NULL IDENTITY,
  rating_for_member_id INT NOT NULL DEFAULT '0',
  rating_by_member_id INT NOT NULL DEFAULT '0',
  rating_ip_address VARCHAR(16) NOT NULL DEFAULT '',
  rating_value INT NOT NULL DEFAULT '0',
  PRIMARY KEY (rating_id)
);";
$TABLE[] = "CREATE TABLE question_and_answer (
  qa_id INT NOT NULL IDENTITY,
qa_question VARCHAR(MAX) NULL,
qa_answers VARCHAR(MAX) NULL,
  PRIMARY KEY (qa_id)
);";
$TABLE[] = "CREATE TABLE rc_classes (
  com_id SMALLINT NOT NULL IDENTITY,
  onoff SMALLINT NOT NULL DEFAULT '0',
  class_title VARCHAR(255) NOT NULL DEFAULT '',
class_desc VARCHAR(MAX) NOT NULL,
  author VARCHAR(255) NOT NULL DEFAULT '',
  author_url VARCHAR(255) NOT NULL DEFAULT '',
  pversion VARCHAR(255) NOT NULL DEFAULT '',
  my_class VARCHAR(100) NOT NULL DEFAULT '',
  group_can_report VARCHAR(MAX) NOT NULL DEFAULT '',
  mod_group_perm VARCHAR(MAX) NOT NULL DEFAULT '',
extra_data VARCHAR(MAX) NOT NULL,
  lockd SMALLINT NOT NULL DEFAULT '0',
  app VARCHAR(32) NOT NULL,
  PRIMARY KEY (com_id)
);";

$TABLE[] = "CREATE TABLE rc_comments (
  id INT NOT NULL IDENTITY,
  rid INT NOT NULL DEFAULT '0',
comment VARCHAR(MAX) NOT NULL,
  comment_by INT NOT NULL DEFAULT '0',
  comment_date INT NOT NULL DEFAULT '0',
  PRIMARY KEY (id)
);";
$TABLE[] = "CREATE TABLE rc_modpref (
  mem_id INT NOT NULL DEFAULT '0',
  rss_key VARCHAR(32) NOT NULL DEFAULT '',
rss_cache VARCHAR(MAX) NOT NULL,
  PRIMARY KEY (mem_id)
);";
$TABLE[] = "CREATE TABLE rc_reports (
  id INT NOT NULL IDENTITY,
  rid INT NOT NULL DEFAULT '0',
report VARCHAR(MAX) NOT NULL,
  report_by INT NOT NULL DEFAULT '0',
  date_reported INT NOT NULL DEFAULT '0',
  PRIMARY KEY (id)
);";
$TABLE[] = "CREATE TABLE rc_reports_index (
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
$TABLE[] = "CREATE TABLE rc_status (
  status SMALLINT NOT NULL IDENTITY,
  title VARCHAR(100) NOT NULL DEFAULT '',
  points_per_report SMALLINT NOT NULL DEFAULT '1',
minutes_to_apoint INT NOT NULL DEFAULT '5',
  is_new SMALLINT NOT NULL DEFAULT '0',
  is_complete SMALLINT NOT NULL DEFAULT '0',
  is_active SMALLINT NOT NULL DEFAULT '0',
  rorder SMALLINT NOT NULL DEFAULT '0',
  PRIMARY KEY (status)
);";
$TABLE[] = "CREATE TABLE rc_status_sev (
  id SMALLINT NOT NULL IDENTITY,
  status SMALLINT NOT NULL DEFAULT '0',
  points SMALLINT NOT NULL DEFAULT '0',
  img VARCHAR(255) NOT NULL DEFAULT '',
  is_png SMALLINT NOT NULL DEFAULT '0',
  width SMALLINT NOT NULL DEFAULT '16',
  height SMALLINT NOT NULL DEFAULT '16',
  PRIMARY KEY (id)
);";
$TABLE[] = "CREATE TABLE reputation_cache (
  id bigINT NOT NULL IDENTITY,
  app VARCHAR(32) NOT NULL,
  type VARCHAR(32) NOT NULL,
  type_id BIGINT NOT NULL,
  rep_points INT NOT NULL,
  PRIMARY KEY (id)
);";
$TABLE[] = "CREATE TABLE reputation_index (
  id bigINT NOT NULL IDENTITY,
  member_id INT NOT NULL,
  app VARCHAR(32) NOT NULL,
  type VARCHAR(32) NOT NULL,
  type_id BIGINT NOT NULL,
  rep_date BIGINT NOT NULL,
rep_msg VARCHAR(MAX) NOT NULL,
  rep_rating SMALLINT NOT NULL,
  PRIMARY KEY (id)
);";
$TABLE[] = "CREATE TABLE reputation_levels (
  level_id INT NOT NULL IDENTITY,
  level_points INT NOT NULL,
  level_title VARCHAR(255) NOT NULL,
  level_image VARCHAR(255) NOT NULL,
  PRIMARY KEY (level_id)
);";
$TABLE[] = "CREATE TABLE rss_export (
  rss_export_id INT NOT NULL IDENTITY,
  rss_export_enabled SMALLINT NOT NULL DEFAULT '0',
  rss_export_title VARCHAR(255) NOT NULL DEFAULT '',
  rss_export_desc VARCHAR(255) NOT NULL DEFAULT '',
  rss_export_image VARCHAR(255) NOT NULL DEFAULT '',
rss_export_forums VARCHAR(MAX) NULL,
  rss_export_include_post SMALLINT NOT NULL DEFAULT '0',
  rss_export_count SMALLINT NOT NULL DEFAULT '0',
  rss_export_cache_time SMALLINT NOT NULL DEFAULT '30',
  rss_export_cache_last INT NOT NULL DEFAULT '0',
rss_export_cache_content VARCHAR(MAX) NULL,
  rss_export_sort VARCHAR(4) NOT NULL DEFAULT 'DESC',
  rss_export_order VARCHAR(20) NOT NULL DEFAULT 'start_date',
  PRIMARY KEY (rss_export_id)
);";
$TABLE[] = "CREATE TABLE rss_import (
  rss_import_id INT NOT NULL IDENTITY,
  rss_import_enabled SMALLINT NOT NULL DEFAULT '0',
  rss_import_title VARCHAR(255) NOT NULL DEFAULT '',
  rss_import_url VARCHAR(255) NOT NULL DEFAULT '',
  rss_import_forum_id INT NOT NULL DEFAULT '0',
  rss_import_mid INT NOT NULL DEFAULT '0',
  rss_import_pergo SMALLINT NOT NULL DEFAULT '0',
  rss_import_time SMALLINT NOT NULL DEFAULT '0',
  rss_import_last_import INT NOT NULL DEFAULT '0',
  rss_import_showlink VARCHAR(255) NOT NULL DEFAULT '0',
  rss_import_topic_open SMALLINT NOT NULL DEFAULT '0',
  rss_import_topic_hide SMALLINT NOT NULL DEFAULT '0',
  rss_import_inc_pcount SMALLINT NOT NULL DEFAULT '0',
  rss_import_topic_pre VARCHAR(50) NOT NULL DEFAULT '',
  rss_import_charset VARCHAR(200) NOT NULL DEFAULT '',
  rss_import_allow_html SMALLINT NOT NULL DEFAULT '0',
  rss_import_auth SMALLINT NOT NULL DEFAULT '0',
  rss_import_auth_user VARCHAR(255) NOT NULL DEFAULT 'Not Needed',
  rss_import_auth_pass VARCHAR(255) NOT NULL DEFAULT 'Not Needed',
  PRIMARY KEY (rss_import_id)
);";
$TABLE[] = "CREATE TABLE rss_imported (
  rss_imported_guid char(32) NOT NULL DEFAULT '0',
  rss_imported_tid INT NOT NULL DEFAULT '0',
  rss_imported_impid INT NOT NULL DEFAULT '0',
  PRIMARY KEY (rss_imported_guid)
);";

$TABLE[] = "CREATE TABLE search_results (
  id VARCHAR(32) NOT NULL DEFAULT '',
topic_id VARCHAR(MAX) NULL,
  search_date INT NOT NULL DEFAULT '0',
  topic_max INT NOT NULL DEFAULT '0',
  sort_key VARCHAR(32) NOT NULL DEFAULT 'last_post',
  sort_order VARCHAR(4) NOT NULL DEFAULT 'desc',
  member_id INT DEFAULT '0',
  ip_address VARCHAR(64) NULL,
post_id VARCHAR(MAX) NULL,
  post_max INT NOT NULL DEFAULT '0',
query_cache VARCHAR(MAX) NULL,
  PRIMARY KEY (id)
);";
$TABLE[] = "CREATE TABLE search_sessions (
  session_id VARCHAR(32) NOT NULL DEFAULT '',
  session_created INT NOT NULL DEFAULT '0',
  session_updated INT NOT NULL DEFAULT '0',
  session_member_id INT NOT NULL DEFAULT '0',
session_data VARCHAR(MAX) NULL,
  PRIMARY KEY (session_id)
);";
$TABLE[] = "CREATE TABLE sessions (
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
  in_error SMALLINT NOT NULL DEFAULT '0',
  location_1_type VARCHAR(255) NOT NULL,
  location_1_id INT NOT NULL DEFAULT '0',
  location_2_type VARCHAR(255) NOT NULL,
  location_2_id INT NOT NULL DEFAULT '0',
  location_3_type VARCHAR(255) NOT NULL,
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
$TABLE[] = "CREATE TABLE skin_cache (
  cache_id INT NOT NULL IDENTITY,
  cache_updated INT NOT NULL DEFAULT '0',
  cache_type VARCHAR(200) NOT NULL DEFAULT '',
  cache_set_id INT NOT NULL DEFAULT '0',
  cache_key_1 VARCHAR(200) NOT NULL DEFAULT '',
  cache_value_1 VARCHAR(200) NOT NULL DEFAULT '',
  cache_key_2 VARCHAR(200) NOT NULL DEFAULT '',
  cache_value_2 VARCHAR(200) NOT NULL DEFAULT '',
  cache_value_3 VARCHAR(200) NOT NULL DEFAULT '',
cache_content VARCHAR(MAX) NOT NULL,
  cache_key_3 VARCHAR(200) NOT NULL DEFAULT '',
  cache_key_4 VARCHAR(200) NOT NULL DEFAULT '',
  cache_value_4 VARCHAR(200) NOT NULL DEFAULT '',
  cache_key_5 VARCHAR(200) NOT NULL DEFAULT '',
  cache_value_5 VARCHAR(200) NOT NULL DEFAULT '',
  cache_key_6 VARCHAR(200) NOT NULL DEFAULT '',
  cache_value_6 VARCHAR(200) NOT NULL DEFAULT '',
  PRIMARY KEY (cache_id)
);";
$TABLE[] = "CREATE TABLE skin_collections (
  set_id INT NOT NULL IDENTITY,
  set_name VARCHAR(200) NOT NULL DEFAULT '',
  set_key VARCHAR(100) NOT NULL DEFAULT '',
  set_parent_id INT NOT NULL DEFAULT '-1',
set_parent_array VARCHAR(MAX) NULL,
set_child_array VARCHAR(MAX) NULL,
set_permissions VARCHAR(MAX) NOT NULL,
  set_is_default INT NOT NULL DEFAULT '0',
  set_author_name VARCHAR(255) NOT NULL DEFAULT '',
  set_author_url VARCHAR(255) NOT NULL DEFAULT '',
  set_image_dir VARCHAR(255) NOT NULL DEFAULT 'default',
  set_emo_dir VARCHAR(255) NOT NULL DEFAULT 'default',
  set_css_inline INT NOT NULL DEFAULT '0',
set_css_groups VARCHAR(MAX) NULL,
  set_added INT NOT NULL DEFAULT '0',
  set_updated INT NOT NULL DEFAULT '0',
  set_output_format VARCHAR(200) NOT NULL DEFAULT 'html',
set_locked_uagent VARCHAR(MAX) NULL,
  set_hide_from_list INT NOT NULL DEFAULT '0',
  set_minify INT NOT NULL DEFAULT '0',
  set_master_key VARCHAR(100) NOT NULL DEFAULT '0',
  set_order INT NOT NULL,
  PRIMARY KEY (set_id)
);";
$TABLE[] = "CREATE TABLE skin_css (
  css_id INT NOT NULL IDENTITY,
  css_set_id INT NOT NULL DEFAULT '0',
  css_updated INT NOT NULL DEFAULT '0',
  css_group VARCHAR(255) NOT NULL DEFAULT '0',
css_content VARCHAR(MAX) NULL,
  css_position INT NOT NULL DEFAULT '0',
  css_added_to INT NOT NULL DEFAULT '0',
  css_app VARCHAR(200) NOT NULL DEFAULT '0',
  css_app_hide INT NOT NULL DEFAULT '0',
css_attributes VARCHAR(MAX) NULL,
  css_removed INT NOT NULL DEFAULT '0',
  css_modules VARCHAR(250) NOT NULL DEFAULT '',
  css_master_key VARCHAR(100) NOT NULL DEFAULT '',
  PRIMARY KEY (css_id)
);";
$TABLE[] = "CREATE TABLE skin_css_previous (
  p_css_id INT NOT NULL IDENTITY,
  p_css_group VARCHAR(255) NOT NULL DEFAULT '0',
p_css_content VARCHAR(MAX) NULL,
  p_css_app VARCHAR(200) NOT NULL DEFAULT '0',
p_css_attributes VARCHAR(MAX) NULL,
  p_css_modules VARCHAR(250) NOT NULL DEFAULT '',
  p_css_master_key VARCHAR(100) NOT NULL DEFAULT '',
  p_css_long_version VARCHAR(100) NOT NULL DEFAULT '',
  p_css_human_version VARCHAR(100) NOT NULL DEFAULT '',
  PRIMARY KEY (p_css_id)
);";
$TABLE[] = "CREATE TABLE skin_merge_changes (
  change_id INT NOT NULL IDENTITY,
  change_key VARCHAR(255) NOT NULL DEFAULT '',
  change_session_id INT NOT NULL DEFAULT '0',
  change_updated INT NOT NULL DEFAULT '0',
  change_data_group VARCHAR(255) NOT NULL DEFAULT '',
  change_data_title VARCHAR(255) NOT NULL DEFAULT '',
change_data_content VARCHAR(MAX) NULL,
  change_data_type VARCHAR(10) NOT NULL DEFAULT 'template',
  change_is_new INT NOT NULL DEFAULT '0',
  change_is_diff INT NOT NULL DEFAULT '0',
  change_can_merge INT NOT NULL DEFAULT '0',
change_merge_content VARCHAR(MAX) NULL,
  change_is_conflict INT NOT NULL DEFAULT '0',
change_final_content VARCHAR(MAX) NULL,
  change_changes_applied INT NOT NULL DEFAULT '0',
change_original_content VARCHAR(MAX) NULL,
  PRIMARY KEY (change_id)
);";
$TABLE[] = "CREATE TABLE skin_merge_session (
  merge_id INT NOT NULL IDENTITY,
  merge_date INT NOT NULL DEFAULT '0',
  merge_set_id INT NOT NULL DEFAULT '0',
  merge_master_key VARCHAR(200) NOT NULL DEFAULT '',
  merge_old_version VARCHAR(200) NOT NULL DEFAULT '',
  merge_new_version VARCHAR(200) NOT NULL DEFAULT '',
  merge_templates_togo INT NOT NULL DEFAULT '0',
  merge_css_togo INT NOT NULL DEFAULT '0',
  merge_templates_done INT NOT NULL DEFAULT '0',
  merge_css_done INT NOT NULL DEFAULT '0',
  merge_m_templates_togo INT NOT NULL DEFAULT '0',
  merge_m_css_togo INT NOT NULL DEFAULT '0',
  merge_m_templates_done INT NOT NULL DEFAULT '0',
  merge_m_css_done INT NOT NULL DEFAULT '0',
  merge_diff_done INT NOT NULL DEFAULT '0',
  PRIMARY KEY (merge_id)
);";
$TABLE[] = "CREATE TABLE skin_replacements (
  replacement_id INT NOT NULL IDENTITY,
  replacement_key VARCHAR(255) NOT NULL DEFAULT '',
replacement_content VARCHAR(MAX) NULL,
  replacement_set_id INT NOT NULL DEFAULT '0',
  replacement_added_to INT NOT NULL DEFAULT '0',
  replacement_master_key VARCHAR(100) NOT NULL DEFAULT '',
  PRIMARY KEY (replacement_id)
);";
$TABLE[] = "CREATE TABLE skin_templates (
  template_id INT NOT NULL IDENTITY,
  template_set_id INT NOT NULL DEFAULT '0',
  template_group VARCHAR(255) NOT NULL DEFAULT '',
template_content VARCHAR(MAX) NULL,
  template_name VARCHAR(255) NULL,
template_data VARCHAR(MAX) NULL,
  template_updated INT NOT NULL DEFAULT '0',
  template_removable INT NOT NULL DEFAULT '0',
  template_added_to INT NOT NULL DEFAULT '0',
  template_user_added INT NOT NULL DEFAULT '0',
  template_user_edited INT NOT NULL DEFAULT '0',
  template_master_key VARCHAR(100) NOT NULL DEFAULT '',
  PRIMARY KEY (template_id)
);";
$TABLE[] = "CREATE TABLE skin_templates_cache (
  template_id VARCHAR(32) NOT NULL DEFAULT '',
  template_group_name VARCHAR(255) NOT NULL DEFAULT '',
template_group_content VARCHAR(MAX) NULL,
  template_set_id INT NOT NULL DEFAULT '0',
  PRIMARY KEY (template_id)
);";
$TABLE[] = "CREATE TABLE skin_templates_previous (
  p_template_id INT NOT NULL IDENTITY,
  p_template_group VARCHAR(255) NOT NULL DEFAULT '',
p_template_content VARCHAR(MAX) NULL,
  p_template_name VARCHAR(255) NULL,
p_template_data VARCHAR(MAX) NULL,
  p_template_master_key VARCHAR(100) NOT NULL DEFAULT '',
  p_template_long_version VARCHAR(100) NOT NULL DEFAULT '',
  p_template_human_version VARCHAR(100) NOT NULL DEFAULT '',
  PRIMARY KEY (p_template_id)
);";
$TABLE[] = "CREATE TABLE skin_url_mapping (
  map_id INT NOT NULL IDENTITY,
  map_title VARCHAR(200) NOT NULL DEFAULT '',
  map_match_type VARCHAR(10) NOT NULL DEFAULT 'contains',
  map_url VARCHAR(200) NOT NULL DEFAULT '',
  map_skin_set_id BIGINT NOT NULL DEFAULT '0',
  map_date_added BIGINT NOT NULL DEFAULT '0',
  PRIMARY KEY (map_id)
);";
$TABLE[] = "CREATE TABLE spam_service_log (
  id BIGINT NOT NULL IDENTITY,
  log_date BIGINT NOT NULL,
  log_code SMALLINT NOT NULL,
  log_msg VARCHAR(32) NOT NULL,
  email_address VARCHAR(255) NOT NULL,
  ip_address VARCHAR(32) NOT NULL,
  PRIMARY KEY (id)
);";
$TABLE[] = "CREATE TABLE spider_logs (
  sid INT NOT NULL IDENTITY,
  bot VARCHAR(255) NOT NULL DEFAULT '',
query_string VARCHAR(MAX) NULL,
  entry_date INT NOT NULL DEFAULT '0',
  ip_address VARCHAR(16) NOT NULL DEFAULT '',
  PRIMARY KEY (sid)
);";

$TABLE[] = "CREATE TABLE tags_index (
  id bigINT NOT NULL IDENTITY,
  app VARCHAR(255) NOT NULL,
  tag VARCHAR(255) NOT NULL,
  type VARCHAR(32) NOT NULL,
  type_id bigINT NOT NULL,
  type_2 VARCHAR(32) NOT NULL,
  type_id_2 bigINT NOT NULL,
  updated BIGINT NOT NULL,
  member_id INT NOT NULL,
  tag_hidden INT NOT NULL DEFAULT '0',
  PRIMARY KEY (id)
);";
$TABLE[] = "CREATE TABLE task_logs (
  log_id INT NOT NULL IDENTITY,
  log_title VARCHAR(255) NOT NULL DEFAULT '',
  log_date INT NOT NULL DEFAULT '0',
  log_ip VARCHAR(16) NOT NULL DEFAULT '0',
log_desc VARCHAR(MAX) NULL,
  PRIMARY KEY (log_id)
);";
$TABLE[] = "CREATE TABLE task_manager (
  task_id INT NOT NULL IDENTITY,
  task_title VARCHAR(255) NOT NULL DEFAULT '',
  task_file VARCHAR(255) NOT NULL DEFAULT '',
  task_next_run INT NOT NULL DEFAULT '0',
  task_week_day SMALLINT NOT NULL DEFAULT '-1',
  task_month_day SMALLINT NOT NULL DEFAULT '-1',
  task_hour SMALLINT NOT NULL DEFAULT '-1',
  task_minute SMALLINT NOT NULL DEFAULT '-1',
  task_cronkey VARCHAR(32) NOT NULL DEFAULT '',
  task_log SMALLINT NOT NULL DEFAULT '0',
task_description VARCHAR(MAX) NULL,
  task_enabled SMALLINT NOT NULL DEFAULT '1',
  task_key VARCHAR(30) NOT NULL DEFAULT '',
  task_safemode SMALLINT NOT NULL DEFAULT '0',
  task_locked INT NOT NULL DEFAULT '0',
  task_application VARCHAR(100) NOT NULL,
  PRIMARY KEY (task_id)
);";
$TABLE[] = "CREATE TABLE template_sandr (
  sandr_session_id INT NOT NULL IDENTITY,
  sandr_set_id INT NOT NULL DEFAULT '0',
  sandr_search_only INT NOT NULL DEFAULT '0',
  sandr_search_all INT NOT NULL DEFAULT '0',
sandr_search_for VARCHAR(MAX) NULL,
sandr_replace_with VARCHAR(MAX) NULL,
  sandr_is_regex INT NOT NULL DEFAULT '0',
  sandr_template_count INT NOT NULL DEFAULT '0',
  sandr_template_processed INT NOT NULL DEFAULT '0',
sandr_results VARCHAR(MAX) NULL,
  sandr_updated INT NOT NULL DEFAULT '0',
  PRIMARY KEY (sandr_session_id)
);";
$TABLE[] = "CREATE TABLE titles (
  id SMALLINT NOT NULL IDENTITY,
  posts INT NOT NULL,
  title VARCHAR(128) NULL,
  pips VARCHAR(128) NULL,
  PRIMARY KEY (id)
);";
$TABLE[] = "CREATE TABLE twitter_connect (
  t_key VARCHAR(32) NOT NULL DEFAULT '',
  t_token VARCHAR(255) NOT NULL DEFAULT '',
  t_secret VARCHAR(255) NOT NULL DEFAULT '',
  t_time INT NOT NULL DEFAULT '0'
);";
$TABLE[] = "CREATE TABLE upgrade_history (
  upgrade_id INT NOT NULL IDENTITY,
  upgrade_version_id INT NOT NULL DEFAULT '0',
  upgrade_version_human VARCHAR(200) NOT NULL DEFAULT '',
  upgrade_date INT NOT NULL DEFAULT '0',
  upgrade_mid INT NOT NULL DEFAULT '0',
upgrade_notes VARCHAR(MAX) NOT NULL,
  upgrade_app VARCHAR(32) NOT NULL DEFAULT 'core',
  PRIMARY KEY (upgrade_id)
);";
$TABLE[] = "CREATE TABLE upgrade_sessions (
  session_id VARCHAR(32) NOT NULL DEFAULT '',
  session_member_id INT NOT NULL DEFAULT '0',
  session_member_key VARCHAR(32) NOT NULL DEFAULT '',
  session_start_time INT NOT NULL DEFAULT '0',
  session_current_time INT NOT NULL DEFAULT '0',
  session_ip_address VARCHAR(16) NOT NULL DEFAULT '',
  session_section VARCHAR(32) NOT NULL DEFAULT '',
session_post VARCHAR(MAX) NULL,
session_get VARCHAR(MAX) NULL,
session_data VARCHAR(MAX) NULL,
session_extra VARCHAR(MAX) NULL,
  PRIMARY KEY (session_id)
);";
$TABLE[] = "CREATE TABLE validating (
  vid VARCHAR(32) NOT NULL DEFAULT '',
  member_id INT NOT NULL DEFAULT '0',
  real_group SMALLINT NOT NULL DEFAULT '0',
  temp_group SMALLINT NOT NULL DEFAULT '0',
  entry_date INT NOT NULL DEFAULT '0',
  coppa_user SMALLINT NOT NULL DEFAULT '0',
  lost_pass SMALLINT NOT NULL DEFAULT '0',
  new_reg SMALLINT NOT NULL DEFAULT '0',
  email_chg SMALLINT NOT NULL DEFAULT '0',
  ip_address VARCHAR(16) NOT NULL DEFAULT '0',
  user_verified SMALLINT NOT NULL DEFAULT '0',
  prev_email VARCHAR(150) NOT NULL DEFAULT '0',
  spam_flag SMALLINT NOT NULL DEFAULT '0',
  PRIMARY KEY (vid)
);";
$TABLE[] = "CREATE TABLE voters (
  vid INT NOT NULL IDENTITY,
  ip_address VARCHAR(16) NOT NULL DEFAULT '',
  vote_date INT NOT NULL DEFAULT '0',
  tid INT NOT NULL DEFAULT '0',
  member_id INT NOT NULL DEFAULT '0',
  forum_id SMALLINT NOT NULL DEFAULT '0',
member_choices VARCHAR(MAX) NULL,
  PRIMARY KEY (vid)
);";
$TABLE[] = "CREATE TABLE warn_logs (
  wlog_id INT NOT NULL IDENTITY,
  wlog_mid INT NOT NULL DEFAULT '0',
wlog_notes VARCHAR(MAX) NULL,
  wlog_contact VARCHAR(250) NOT NULL DEFAULT 'none',
wlog_contact_content VARCHAR(MAX) NULL,
  wlog_date INT NOT NULL DEFAULT '0',
  wlog_type VARCHAR(6) NOT NULL DEFAULT 'pos',
  wlog_addedby INT NOT NULL DEFAULT '0',
  PRIMARY KEY (wlog_id)
);";
$TABLE[] = "CREATE INDEX admin_ip_address ON admin_login_logs ( admin_ip_address );";
$TABLE[] = "CREATE INDEX admin_time ON admin_login_logs ( admin_time );";
$TABLE[] = "CREATE INDEX ctime ON admin_logs ( ctime );";
$TABLE[] = "CREATE INDEX ip_address ON admin_logs ( ip_address );";
$TABLE[] = "CREATE INDEX announce_end ON announcements ( announce_end );";
$TABLE[] = "CREATE INDEX api_log_date ON api_log ( api_log_date );";
$TABLE[] = "CREATE INDEX attach_pid ON attachments ( attach_rel_id );";
$TABLE[] = "CREATE INDEX attach_post_key ON attachments ( attach_post_key );";
$TABLE[] = "CREATE INDEX attach_mid_size ON attachments ( attach_member_id,attach_rel_module,attach_filesize );";
$TABLE[] = "CREATE INDEX atype ON attachments_type ( atype_post,atype_photo );";
$TABLE[] = "CREATE INDEX atype_extension ON attachments_type ( atype_extension );";
$TABLE[] = "CREATE INDEX ban_nocache ON banfilters ( ban_nocache );";
$TABLE[] = "CREATE INDEX mail_start ON bulk_mail ( mail_start );";
$TABLE[] = "CREATE INDEX captcha_date ON captcha ( captcha_date );";
$TABLE[] = "CREATE INDEX cache_content_id ON content_cache_posts ( cache_content_id );";
$TABLE[] = "CREATE INDEX date_index ON content_cache_posts ( cache_updated );";
$TABLE[] = "CREATE INDEX cache_content_id ON content_cache_sigs ( cache_content_id );";
$TABLE[] = "CREATE INDEX date_index ON content_cache_sigs ( cache_updated );";
$TABLE[] = "CREATE INDEX converge_active ON converge_local ( converge_active );";
$TABLE[] = "CREATE INDEX app_directory ON core_applications ( app_directory );";
$TABLE[] = "CREATE INDEX hook_hook_id ON core_hooks_files ( hook_hook_id );";
$TABLE[] = "CREATE INDEX combo_key ON core_item_markers ( item_key,item_member_id,item_app );";
$TABLE[] = "CREATE INDEX marker_index ON core_item_markers ( item_member_id,item_app );";
$TABLE[] = "CREATE INDEX item_last_saved ON core_item_markers ( item_last_saved );";
$TABLE[] = "CREATE INDEX item_member_id ON core_item_markers ( item_member_id,item_is_deleted );";
$TABLE[] = "CREATE INDEX item_last_saved ON core_item_markers_storage ( item_last_saved );";
$TABLE[]  = "CREATE INDEX find_rel_favs ON core_like (like_lookup_id, like_is_anon, like_added);";
$TABLE[] = "CREATE INDEX like_member_id ON core_like (like_member_id, like_added);";
$TABLE[] = "CREATE INDEX rss_guid ON core_rss_imported ( rss_guid,rss_foreign_key );";
$TABLE[] = "CREATE INDEX findstuff ON core_share_links_log ( log_data_app,log_data_type,log_data_primary_id );";
$TABLE[] = "CREATE INDEX log_date ON core_share_links_log ( log_date );";
$TABLE[] = "CREATE INDEX log_member_id ON core_share_links_log ( log_member_id );";
$TABLE[] = "CREATE INDEX log_share_key ON core_share_links_log ( log_share_key );";
$TABLE[] = "CREATE INDEX log_ip_address ON core_share_links_log ( log_ip_address );";
$TABLE[] = "CREATE INDEX look_up ON core_soft_delete_log ( sdl_obj_id,sdl_obj_key );";
$TABLE[] = "CREATE INDEX conf_key ON core_sys_conf_settings ( conf_key );";
$TABLE[] = "CREATE INDEX conf_group ON core_sys_conf_settings ( conf_group,conf_position,conf_title );";
$TABLE[] = "CREATE INDEX conf_add_cache ON core_sys_conf_settings ( conf_add_cache );";
$TABLE[] = "CREATE INDEX session_running_time ON core_sys_cp_sessions ( session_running_time );";
$TABLE[] = "CREATE INDEX session_member_id ON core_sys_cp_sessions ( session_member_id );";
$TABLE[] = "CREATE INDEX lang_short ON core_sys_lang ( lang_short );";
$TABLE[] = "CREATE INDEX lang_default ON core_sys_lang ( lang_default );";
$TABLE[] = "CREATE INDEX word_js ON core_sys_lang_words ( word_js );";
$TABLE[] = "CREATE INDEX word_find ON core_sys_lang_words ( lang_id,word_app,word_pack );";
$TABLE[] = "CREATE INDEX sys_module_application ON core_sys_module ( sys_module_application );";
$TABLE[] = "CREATE INDEX sys_module_visible ON core_sys_module ( sys_module_visible );";
$TABLE[] = "CREATE INDEX sys_module_key ON core_sys_module ( sys_module_key );";
$TABLE[] = "CREATE INDEX sys_module_parent ON core_sys_module ( sys_module_parent );";
$TABLE[] = "CREATE INDEX conf_title_keyword ON core_sys_settings_titles ( conf_title_keyword );";
$TABLE[] = "CREATE INDEX ugroup_title ON core_uagent_groups ( ugroup_title );";
$TABLE[] = "CREATE INDEX uagent_key ON core_uagents ( uagent_key );";
$TABLE[] = "CREATE INDEX ordering ON core_uagents ( uagent_position,uagent_key );";
$TABLE[] = "CREATE INDEX dname_member_id ON dnames_change ( dname_member_id );";
$TABLE[] = "CREATE INDEX date_id ON dnames_change ( dname_member_id,dname_date );";
$TABLE[] = "CREATE INDEX dname_ip_address ON dnames_change ( dname_ip_address );";
$TABLE[] = "CREATE INDEX from_member_id ON email_logs ( from_member_id );";
$TABLE[] = "CREATE INDEX email_date ON email_logs ( email_date );";
$TABLE[] = "CREATE INDEX emo_set ON emoticons ( emo_set );";
$TABLE[] = "CREATE INDEX log_date ON error_logs ( log_date );";
$TABLE[] = "CREATE INDEX log_ip_address ON error_logs ( log_ip_address );";
$TABLE[] = "CREATE INDEX ignore_owner_id ON ignored_users ( ignore_owner_id );";
$TABLE[] = "CREATE INDEX ignore_ignore_id ON ignored_users ( ignore_ignore_id );";
$TABLE[] = "CREATE INDEX grabber ON inline_notifications ( notify_to_id,notify_read,notify_sent );";
$TABLE[] = "CREATE INDEX action_status_id ON member_status_actions ( action_status_id );";
$TABLE[] = "CREATE INDEX action_member_id ON member_status_actions ( action_member_id );";
$TABLE[] = "CREATE INDEX action_date ON member_status_actions ( action_date );";
$TABLE[] = "CREATE INDEX action_custom ON member_status_actions ( action_custom );";
$TABLE[] = "CREATE INDEX reply_status_id ON member_status_replies ( reply_status_id );";
$TABLE[] = "CREATE INDEX reply_member_id ON member_status_replies ( reply_member_id );";
$TABLE[] = "CREATE INDEX reply_status_count ON member_status_replies ( reply_status_id,reply_member_id );";
$TABLE[] = "CREATE INDEX reply_date ON member_status_replies ( reply_date );";
$TABLE[] = "CREATE INDEX status_date ON member_status_updates ( status_date );";
$TABLE[] = "CREATE INDEX status_is_latest ON member_status_updates ( status_is_latest );";
$TABLE[] = "CREATE INDEX s_hash ON member_status_updates ( status_member_id,status_hash,status_imported );";
$TABLE[] = "CREATE INDEX members_l_username ON members ( members_l_username );";
$TABLE[] = "CREATE INDEX bday_day ON members ( bday_day );";
$TABLE[] = "CREATE INDEX bday_month ON members ( bday_month );";
$TABLE[] = "CREATE INDEX member_banned ON members ( member_banned );";
$TABLE[] = "CREATE INDEX members_bitoptions ON members ( members_bitoptions );";
$TABLE[] = "CREATE INDEX mgroup ON members ( member_group_id );";
$TABLE[] = "CREATE INDEX members_l_display_name ON members ( members_l_display_name );";
$TABLE[] = "CREATE INDEX ip_address ON members ( ip_address );";
$TABLE[] = "CREATE INDEX failed_login_count ON members ( failed_login_count );";
$TABLE[] = "CREATE INDEX joined ON members ( joined );";
$TABLE[] = "CREATE INDEX fb_uid ON members ( fb_uid );";
$TABLE[] = "CREATE INDEX twitter_id ON members ( twitter_id );";
$TABLE[] = "CREATE INDEX email ON members ( email );";
$TABLE[] = "CREATE INDEX partial_member_id ON members_partial ( partial_member_id );";
$TABLE[] = "CREATE INDEX perm_index ON permission_index ( perm_type,perm_type_id );";
$TABLE[] = "CREATE INDEX perm_type ON permission_index ( app,perm_type,perm_type_id );";
$TABLE[] = "CREATE INDEX my_comments ON profile_comments ( comment_for_member_id,comment_date );";
$TABLE[] = "CREATE INDEX comment_ip_address ON profile_comments ( comment_ip_address );";
$TABLE[] = "CREATE INDEX my_friends ON profile_friends ( friends_member_id,friends_friend_id );";
$TABLE[] = "CREATE INDEX my_friends ON profile_friends_flood ( friends_member_id,friends_friend_id );";
$TABLE[] = "CREATE INDEX views_member_id ON profile_portal_views ( views_member_id );";
$TABLE[] = "CREATE INDEX rating_for_member_id ON profile_ratings ( rating_for_member_id );";
$TABLE[] = "CREATE INDEX rating_ip_address ON profile_ratings ( rating_ip_address );";
//$TABLE[] = "CREATE INDEX onoff ON rc_classes ( onoff,mod_group_perm(255) );";
$TABLE[] = "CREATE INDEX uid ON rc_reports_index ( uid );";
$TABLE[] = "CREATE INDEX status ON rc_status_sev ( status,points );";
$TABLE[] = "CREATE INDEX app ON reputation_cache ( app,type,type_id );";
$TABLE[] = "CREATE INDEX app ON reputation_index ( app,type,type_id,member_id );";
$TABLE[] = "CREATE INDEX member_rep ON reputation_index ( member_id,rep_rating,rep_date );";
$TABLE[] = "CREATE INDEX rss_import_enabled ON rss_import ( rss_import_enabled,rss_import_last_import );";
$TABLE[] = "CREATE INDEX rss_imported_impid ON rss_imported ( rss_imported_impid );";
$TABLE[] = "CREATE INDEX search_date ON search_results ( search_date );";
$TABLE[] = "CREATE INDEX location1 ON sessions ( location_1_type,location_1_id );";
$TABLE[] = "CREATE INDEX location2 ON sessions ( location_2_type,location_2_id );";
$TABLE[] = "CREATE INDEX location3 ON sessions ( location_3_type,location_3_id );";
$TABLE[] = "CREATE INDEX running_time ON sessions ( running_time );";
$TABLE[] = "CREATE INDEX member_id ON sessions ( member_id );";
$TABLE[] = "CREATE INDEX cache_type ON skin_cache ( cache_type );";
$TABLE[] = "CREATE INDEX cache_set_id ON skin_cache ( cache_set_id );";
$TABLE[] = "CREATE INDEX parent_set_id ON skin_collections ( set_parent_id,set_id );";
$TABLE[] = "CREATE INDEX set_is_default ON skin_collections ( set_is_default );";
$TABLE[] = "CREATE INDEX set_order ON skin_collections ( set_order );";
$TABLE[] = "CREATE INDEX css_set_id ON skin_css ( css_set_id );";
$TABLE[] = "CREATE INDEX change_key ON skin_merge_changes ( change_key,change_data_type );";
$TABLE[] = "CREATE INDEX replacement_set_id ON skin_replacements ( replacement_set_id );";
$TABLE[] = "CREATE INDEX template_set_id ON skin_templates ( template_set_id );";
$TABLE[] = "CREATE INDEX template_master_key ON skin_templates ( template_master_key );";
$TABLE[] = "CREATE INDEX template_set_id ON skin_templates_cache ( template_set_id );";
$TABLE[] = "CREATE INDEX template_group_name ON skin_templates_cache ( template_group_name );";
$TABLE[] = "CREATE INDEX entry_date ON spider_logs ( entry_date );";
$TABLE[] = "CREATE INDEX app ON tags_index ( app );";
$TABLE[] = "CREATE INDEX tag_grab ON tags_index ( app,type,type_id,type_2,type_id_2,tag_hidden );";
$TABLE[] = "CREATE INDEX log_date ON task_logs ( log_date );";
$TABLE[] = "CREATE INDEX task_key ON task_manager ( task_application,task_key );";
$TABLE[] = "CREATE INDEX task_next_run ON task_manager ( task_enabled,task_next_run );";
$TABLE[] = "CREATE INDEX posts ON titles ( posts );";
$TABLE[] = "CREATE INDEX upgrades ON upgrade_history ( upgrade_app,upgrade_version_id );";
$TABLE[] = "CREATE INDEX new_reg ON validating ( new_reg );";
$TABLE[] = "CREATE INDEX ip_address ON validating ( ip_address );";
$TABLE[] = "CREATE INDEX lost_pass ON validating ( lost_pass );";
$TABLE[] = "CREATE INDEX coppa_user ON validating ( coppa_user );";
$TABLE[] = "CREATE INDEX spam_flag ON validating ( spam_flag );";
$TABLE[] = "CREATE INDEX member_id ON validating ( member_id );";
$TABLE[] = "CREATE INDEX tid ON voters ( tid );";
$TABLE[] = "CREATE INDEX ip_address ON voters ( ip_address );";
?>