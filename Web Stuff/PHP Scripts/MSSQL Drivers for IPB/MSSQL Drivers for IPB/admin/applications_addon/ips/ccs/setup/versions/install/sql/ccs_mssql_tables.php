<?php

$TABLE[]	= "CREATE TABLE ccs_blocks (
  block_id INT NOT NULL IDENTITY,
  block_active TINYINT NOT NULL default '0',
  block_name VARCHAR(255) NOT NULL,
  block_description VARCHAR( MAX ),
  block_key VARCHAR(255) NOT NULL,
  block_type VARCHAR(32) NOT NULL,
  block_config VARCHAR( MAX ),
  block_content VARCHAR( MAX ),
  block_cache_ttl VARCHAR(13) NOT NULL default '0',
  block_cache_last INT NOT NULL default '0',
  block_cache_output VARCHAR( MAX ),
  block_position INT NOT NULL default '0',
  block_category INT NOT NULL default '0',
  PRIMARY KEY(block_id)
);";

$TABLE[]	= "CREATE TABLE ccs_block_wizard (
  wizard_id VARCHAR(32) NOT NULL,
  wizard_step SMALLINT NOT NULL default '0',
  wizard_type VARCHAR(32) default NULL,
  wizard_name VARCHAR( 255 ) NULL,
  wizard_config VARCHAR( MAX ),
  wizard_started VARCHAR( 13 ) NOT NULL DEFAULT '0'
);";

$TABLE[]	= "CREATE TABLE ccs_containers (
  container_id INT NOT NULL IDENTITY,
  container_name VARCHAR(255) NULL,
  container_type VARCHAR(32) NOT NULL,
  container_order INT NOT NULL default '0',
  PRIMARY KEY (container_id)
);";

$TABLE[]	= "CREATE TABLE ccs_folders (
  folder_path VARCHAR( MAX ),
  last_modified VARCHAR(13) NOT NULL default '0'
);";

$TABLE[]	= "CREATE TABLE ccs_pages (
  page_id INT NOT NULL IDENTITY,
  page_name VARCHAR(255) NULL,
  page_seo_name VARCHAR(255) NULL,
  page_description VARCHAR( MAX ),
  page_folder VARCHAR(255) NULL,
  page_type VARCHAR(32) NULL,
  page_last_edited VARCHAR(13) NOT NULL default '0',
  page_template_used INT NOT NULL default '0',
  page_content VARCHAR( MAX ),
  page_cache VARCHAR( MAX ),
  page_view_perms VARCHAR( MAX ),
  page_cache_ttl VARCHAR(13) NOT NULL default '0',
  page_cache_last VARCHAR(13) NOT NULL default '0',
  page_content_only TINYINT NOT NULL default '0',
  page_meta_keywords VARCHAR( MAX ),
  page_meta_description VARCHAR( MAX ),
  page_content_type VARCHAR(32) NOT NULL default 'page',
  page_template VARCHAR( MAX ),
  page_ipb_wrapper BIT NOT NULL DEFAULT '0',
  page_omit_filename BIT NOT NULL DEFAULT '0',
  PRIMARY KEY (page_id)
);";

$TABLE[]	= "CREATE TABLE ccs_page_templates (
  template_id INT NOT NULL IDENTITY,
  template_name VARCHAR(255) NULL,
  template_desc VARCHAR( MAX ),
  template_key VARCHAR(32) NOT NULL,
  template_content VARCHAR( MAX ) NOT NULL,
  template_updated VARCHAR(13) NOT NULL default '0',
  template_position INT NOT NULL default '0',
  template_category INT NOT NULL default '0',
  template_database SMALLINT NOT NULL DEFAULT '0',
  PRIMARY KEY (template_id)
);";

$TABLE[]	= "CREATE TABLE ccs_page_wizard (
  wizard_id VARCHAR(32) NOT NULL,
  wizard_step SMALLINT NOT NULL default '0',
  wizard_edit_id INT NOT NULL default '0',
  wizard_name VARCHAR(255) NULL,
  wizard_description VARCHAR( MAX ) NULL,
  wizard_folder VARCHAR(255) NULL,
  wizard_type VARCHAR(32) NULL,
  wizard_template INT NOT NULL default '0',
  wizard_content VARCHAR( MAX ),
  wizard_cache_ttl VARCHAR(13) NOT NULL default '0',
  wizard_perms VARCHAR( MAX ),
  wizard_seo_name VARCHAR(255) NULL,
  wizard_content_only TINYINT NOT NULL default '0',
  wizard_meta_keywords VARCHAR( MAX ),
  wizard_meta_description VARCHAR( MAX ),
  wizard_started VARCHAR( 13 ) NOT NULL DEFAULT '0',
  wizard_previous_type VARCHAR( 32 ) NULL,
  wizard_ipb_wrapper BIT NOT NULL DEFAULT '0',
  wizard_omit_filename BIT NOT NULL DEFAULT '0'
);";

$TABLE[]	= "CREATE TABLE ccs_revisions (
revision_id INT NOT NULL IDENTITY,
revision_type VARCHAR( 32 ) NOT NULL ,
revision_type_id INT NOT NULL ,
revision_content VARCHAR( MAX ) NULL DEFAULT NULL ,
revision_other VARCHAR( MAX ) NULL ,
revision_date INT NOT NULL DEFAULT '0',
revision_member INT NOT NULL DEFAULT '0',
PRIMARY KEY (revision_id)
);";

$TABLE[]	= "CREATE TABLE ccs_template_blocks (
  tpb_id INT NOT NULL IDENTITY,
  tpb_name VARCHAR(255) NULL,
  tpb_params VARCHAR(MAX) NULL,
  tpb_content VARCHAR(MAX) NULL,
  PRIMARY KEY (tpb_id)
);";

$TABLE[]	= "CREATE TABLE ccs_template_cache (
  cache_id INT NOT NULL IDENTITY,
  cache_type VARCHAR(16) NOT NULL,
  cache_type_id INT NOT NULL default '0',
  cache_content VARCHAR( MAX ),
  PRIMARY KEY (cache_id)
);";

$TABLE[]	= "CREATE TABLE ccs_databases (
  database_id INT NOT NULL IDENTITY,
  database_name varchar(255) NOT NULL,
  database_key varchar(255) NOT NULL,
  database_database varchar(255) NULL,
  database_description VARCHAR( MAX ),
  database_field_count INT NOT NULL default '0',
  database_record_count INT NOT NULL default '0',
  database_template_listing INT NOT NULL default '0',
  database_template_display INT NOT NULL default '0',
  database_template_categories INT NOT NULL default '0',
  database_user_editable BIT NOT NULL default '0',
  database_all_editable BIT NOT NULL default '0',
  database_open BIT NOT NULL default '0',
  database_comments BIT NOT NULL default '0',
  database_rate BIT NOT NULL default '0',
  database_revisions BIT NOT NULL DEFAULT '0',
  database_field_title VARCHAR( 255 ) NULL,
  database_field_sort VARCHAR( 255 ) NULL,
  database_field_direction VARCHAR( 4 ) NOT NULL DEFAULT 'desc',
  database_field_perpage INT NOT NULL DEFAULT '25',
  database_comment_approve BIT NOT NULL DEFAULT '0',
  database_record_approve BIT NOT NULL DEFAULT '0',
  database_rss VARCHAR( 255 ) NOT NULL DEFAULT '0',
  database_rss_cache VARCHAR( MAX ) NULL,
  database_field_content VARCHAR( 255 ) NULL,
  database_lang_sl VARCHAR( 255 ) NOT NULL DEFAULT '',
  database_lang_pl VARCHAR( 255 ) NOT NULL DEFAULT '',
  database_lang_su VARCHAR( 255 ) NOT NULL DEFAULT '',
  database_lang_pu VARCHAR( 255 ) NOT NULL DEFAULT '',
  database_comment_bump BIT NOT NULL DEFAULT '0',
  database_featured_article INT NOT NULL DEFAULT '0',
  database_is_articles BIT NOT NULL DEFAULT '0',
  database_meta_keywords VARCHAR( MAX ) NULL,
  database_meta_description VARCHAR( MAX ) NULL,
  database_forum_record BIT NOT NULL DEFAULT '0',
  database_forum_comments BIT NOT NULL DEFAULT '0',
  database_forum_delete BIT NOT NULL DEFAULT '0',
  database_forum_forum INT NOT NULL DEFAULT '0',
  database_forum_prefix VARCHAR( 255 ) NULL,
  database_forum_suffix VARCHAR( 255 ) NULL,
  database_search BIT NOT NULL DEFAULT '0',
  PRIMARY KEY  (database_id)
);";

$TABLE[]	= "CREATE TABLE ccs_database_fields (
  field_id INT NOT NULL IDENTITY,
  field_database_id INT NOT NULL,
  field_name varchar(255) NOT NULL,
  field_description VARCHAR( MAX ),
  field_key varchar(255) NOT NULL,
  field_type varchar(255) NULL,
  field_required BIT NOT NULL default '0',
  field_user_editable BIT NOT NULL default '0',
  field_position INT NOT NULL default '0',
  field_max_length INT NOT NULL default '0',
  field_extra VARCHAR( MAX ),
  field_html BIT NOT NULL default '0',
  field_is_numeric BIT NOT NULL default '0',
  field_truncate INT NOT NULL default '100',
  field_default_value VARCHAR( MAX ) NULL,
  field_display_listing INT NOT NULL DEFAULT '1',
  field_display_display INT NOT NULL DEFAULT '1',
  field_format_opts VARCHAR( MAX ) NULL,
  field_validator VARCHAR( MAX ) NULL,
  field_topic_format VARCHAR( MAX ) NULL,
  PRIMARY KEY  (field_id)
);";

$TABLE[]	= "CREATE TABLE ccs_database_revisions (
revision_id INT NOT NULL IDENTITY,
revision_database_id INT NOT NULL,
revision_record_id INT NOT NULL,
revision_data VARCHAR( MAX ) NULL,
revision_date varchar(13) NOT NULL DEFAULT '0',
revision_member_id INT NOT NULL DEFAULT '0',
PRIMARY KEY  (revision_id)
);";

$TABLE[]	= "CREATE TABLE ccs_attachments_map (
map_id INT NOT NULL IDENTITY,
map_attach_id INT NOT NULL DEFAULT '0',
map_database_id INT NOT NULL DEFAULT  '0',
map_field_id INT NOT NULL DEFAULT '0',
map_record_id INT NOT NULL DEFAULT '0',
PRIMARY KEY  (map_id)
);";

$TABLE[]	= "CREATE TABLE ccs_database_ratings (
rating_id INT NOT NULL IDENTITY,
rating_user_id INT NOT NULL DEFAULT '0',
rating_database_id INT NOT NULL DEFAULT '0',
rating_record_id INT NOT NULL DEFAULT '0',
rating_rating INT NOT NULL DEFAULT '0',
rating_added VARCHAR( 13 ) NOT NULL DEFAULT '0',
rating_ip_address VARCHAR( 16 ) NOT NULL DEFAULT '0',
PRIMARY KEY  (rating_id)
);";

$TABLE[]	= "CREATE TABLE ccs_database_comments (
comment_id INT NOT NULL IDENTITY,
comment_user INT NOT NULL DEFAULT '0',
comment_database_id INT NOT NULL DEFAULT '0',
comment_record_id INT NOT NULL DEFAULT '0',
comment_date VARCHAR( 13 ) NOT NULL DEFAULT '0',
comment_ip_address VARCHAR( 16 ) NOT NULL DEFAULT '0',
comment_post VARCHAR( MAX ) NULL,
comment_approved BIT NOT NULL DEFAULT '0',
PRIMARY KEY  (comment_id)
);";

$TABLE[]	= "CREATE TABLE ccs_database_categories (
category_id INT NOT NULL IDENTITY,
category_database_id INT NOT NULL DEFAULT '0',
category_name VARCHAR( 255 ) NULL,
category_parent_id INT NOT NULL DEFAULT '0',
category_last_record_id INT NOT NULL DEFAULT '0',
category_last_record_date VARCHAR( 13 ) NOT NULL DEFAULT '0',
category_last_record_member INT NOT NULL DEFAULT '0',
category_last_record_name VARCHAR( 255 ) NULL,
category_last_record_seo_name VARCHAR( 255 ) NULL,
category_description VARCHAR( MAX ) NULL,
category_position INT NOT NULL DEFAULT '0',
category_records INT NOT NULL DEFAULT '0',
category_has_perms BIT NOT NULL DEFAULT '0',
category_show_records BIT NOT NULL DEFAULT '1',
category_rss VARCHAR( 255 ) NULL DEFAULT '0',
category_rss_cache VARCHAR( MAX ) NULL,
category_furl_name VARCHAR( 255 ) NULL,
category_meta_keywords VARCHAR( MAX ) NULL,
category_meta_description VARCHAR( MAX ) NULL,
category_template INT NOT NULL DEFAULT '0',
category_forum_override BIT NOT NULL DEFAULT '0',
category_forum_record BIT NOT NULL DEFAULT '0',
category_forum_comments BIT NOT NULL DEFAULT '0',
category_forum_delete BIT NOT NULL DEFAULT '0',
category_forum_forum INT NOT NULL DEFAULT '0',
category_forum_prefix VARCHAR( 255 ) NULL,
category_forum_suffix VARCHAR( 255 ) NULL,
category_records_queued INT NOT NULL DEFAULT '0',
PRIMARY KEY  (category_id)
);";

$TABLE[]	= "CREATE TABLE ccs_database_moderators (
moderator_id INT NOT NULL IDENTITY,
moderator_database_id INT NOT NULL DEFAULT '0',
moderator_type VARCHAR( 16 ) NULL,
moderator_type_id INT NOT NULL DEFAULT '0',
moderator_delete_record BIT NOT NULL DEFAULT '0',
moderator_edit_record BIT NOT NULL DEFAULT '0',
moderator_lock_record BIT NOT NULL DEFAULT '0',
moderator_unlock_record BIT NOT NULL DEFAULT '0',
moderator_delete_comment BIT NOT NULL DEFAULT '0',
moderator_approve_record BIT NOT NULL DEFAULT '0',
moderator_approve_comment BIT NOT NULL DEFAULT '0',
moderator_pin_record BIT NOT NULL DEFAULT '0',
moderator_add_record BIT NOT NULL DEFAULT '0',
PRIMARY KEY (moderator_id)
);";

$TABLE[]	= "CREATE TABLE ccs_database_modqueue (
  mod_id INT NOT NULL IDENTITY,
  mod_database INT NOT NULL default '0',
  mod_record INT NOT NULL default '0',
  mod_comment INT NOT NULL default '0',
  mod_poster INT NOT NULL default '0',
  PRIMARY KEY  (mod_id)
);";

$TABLE[] = "CREATE INDEX mod_database ON ccs_database_modqueue ( mod_database,mod_record,mod_comment );";

$TABLE[]	= "CREATE TABLE ccs_database_notifications (
  notify_id INT NOT NULL IDENTITY,
  notify_member INT NOT NULL default '0',
  notify_database INT NOT NULL default '0',
  notify_record INT NOT NULL default '0',
  notify_category INT NOT NULL default '0',
  notify_start INT NOT NULL default '0',
  notify_last_sent INT NOT NULL default '0',
  PRIMARY KEY  (notify_id)
);";

$TABLE[] = "CREATE INDEX notify_member ON ccs_database_notifications ( notify_member );";
$TABLE[] = "CREATE INDEX notify_category ON ccs_database_notifications ( notify_category,notify_database );";
$TABLE[] = "CREATE INDEX notify_record ON ccs_database_notifications ( notify_record,notify_database );";

$TABLE[] = "CREATE INDEX block_cache_ttl ON ccs_blocks ( block_cache_ttl );";
$TABLE[] = "CREATE INDEX block_active ON ccs_blocks ( block_active );";
$TABLE[] = "CREATE INDEX block_key ON ccs_blocks ( block_key );";
$TABLE[] = "CREATE INDEX block_category ON ccs_blocks ( block_category );";
$TABLE[] = "CREATE INDEX wizard_id ON ccs_block_wizard ( wizard_id );";
$TABLE[] = "CREATE INDEX page_seo_name ON ccs_pages ( page_seo_name );";
$TABLE[] = "CREATE INDEX page_template_used ON ccs_pages ( page_template_used );";
$TABLE[] = "CREATE INDEX page_folder ON ccs_pages ( page_folder );";
$TABLE[] = "CREATE INDEX page_content_type ON ccs_pages ( page_content_type );";
$TABLE[] = "CREATE UNIQUE INDEX template_key ON ccs_page_templates ( template_key );";
$TABLE[] = "CREATE INDEX template_category ON ccs_page_templates ( template_category );";
$TABLE[] = "CREATE INDEX template_database ON ccs_page_templates ( template_database );";
$TABLE[] = "CREATE INDEX wizard_id ON ccs_page_wizard ( wizard_id );";
$TABLE[] = "CREATE INDEX cache_type ON ccs_template_cache ( cache_type,cache_type_id );";

$TABLE[] = "CREATE UNIQUE INDEX database_key ON ccs_databases ( database_key );";
$TABLE[] = "CREATE INDEX database_is_articles ON ccs_databases ( database_is_articles );";
$TABLE[] = "CREATE INDEX field_database_id ON ccs_database_fields ( field_database_id );";
$TABLE[] = "CREATE INDEX field_key ON ccs_database_fields ( field_key );";
$TABLE[] = "CREATE INDEX revision_database_id ON ccs_database_revisions ( revision_database_id , revision_record_id );";
$TABLE[] = "CREATE INDEX revision_member_id ON ccs_database_revisions ( revision_member_id );";
$TABLE[] = "CREATE INDEX map_database_id ON ccs_attachments_map ( map_database_id , map_record_id );";
$TABLE[] = "CREATE INDEX map_attach_id ON ccs_attachments_map ( map_attach_id );";
$TABLE[] = "CREATE INDEX rating_user_id ON ccs_database_ratings ( rating_user_id , rating_database_id , rating_record_id );";
$TABLE[] = "CREATE INDEX comment_user ON ccs_database_comments ( comment_user );";
$TABLE[] = "CREATE INDEX comment_database_id ON ccs_database_comments ( comment_database_id , comment_record_id , comment_date );";
$TABLE[] = "CREATE INDEX category_database_id ON ccs_database_categories ( category_database_id );";
$TABLE[] = "CREATE INDEX category_template ON ccs_database_categories ( category_template );";
$TABLE[] = "CREATE INDEX moderator_database_id ON ccs_database_moderators ( moderator_database_id );";

$TABLE[] = "CREATE INDEX revision_type ON ccs_revisions ( revision_type , revision_type_id, revision_date );";
$TABLE[] = "CREATE INDEX revision_member ON ccs_revisions ( revision_member );";

$TABLE[] = "CREATE INDEX tpb_name ON ccs_template_blocks ( tpb_name );";
$TABLE[] = "CREATE INDEX container_type ON ccs_containers ( container_type, container_order );";

