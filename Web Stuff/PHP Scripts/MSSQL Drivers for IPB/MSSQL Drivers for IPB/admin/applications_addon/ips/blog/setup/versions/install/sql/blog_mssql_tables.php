<?php
/**
* Installation Schematic File
* Generated on Tue, 04 May 2010 11:57:53 +0000 GMT
*/
$TABLE[] = "CREATE TABLE blog_akismet_logs (
  log_id INT NOT NULL IDENTITY,
  log_date VARCHAR(13) NOT NULL DEFAULT '0',
  log_msg VARCHAR(255) NULL,
log_errors VARCHAR(MAX) NULL,
log_data VARCHAR(MAX) NULL,
  log_type VARCHAR(32) NULL,
  log_etbid INT NOT NULL DEFAULT '0',
  log_isspam SMALLINT NOT NULL DEFAULT '0',
  log_action VARCHAR(255) NULL,
  log_submitted SMALLINT NOT NULL DEFAULT '0',
  log_connect_error SMALLINT NOT NULL DEFAULT '0',
  PRIMARY KEY (log_id)
);";
$TABLE[] = "CREATE TABLE blog_authmembers (
  blog_id INT NOT NULL,
  member_id INT NOT NULL,
  PRIMARY KEY (blog_id,member_id)
);";
$TABLE[] = "CREATE TABLE blog_blogs (
  blog_id INT NOT NULL IDENTITY,
  member_id INT NOT NULL,
  blog_name VARCHAR(250) NULL,
  blog_desc VARCHAR(250) NULL,
  blog_type VARCHAR(10) NULL,
  blog_exturl VARCHAR(250) NULL,
  blog_num_exthits INT DEFAULT '0',
  blog_num_views INT DEFAULT '0',
  blog_private SMALLINT NOT NULL DEFAULT '0',
  blog_pinned SMALLINT NOT NULL DEFAULT '0',
  blog_disabled SMALLINT NOT NULL DEFAULT '0',
  blog_allowguests SMALLINT NOT NULL DEFAULT '1',
  blog_rating_total INT DEFAULT '0',
  blog_rating_count INT DEFAULT '0',
  blog_last_delete INT DEFAULT '0',
  blog_skin_id SMALLINT DEFAULT '0',
  blog_friendly_url VARCHAR(250) DEFAULT '',
blog_settings VARCHAR(MAX) NULL,
  blog_theme_id INT NOT NULL DEFAULT '0',
blog_theme_custom VARCHAR(MAX) NULL,
blog_theme_final VARCHAR(MAX) NULL,
  blog_theme_approved SMALLINT NOT NULL DEFAULT '0',
  blog_header_id INT NOT NULL DEFAULT '0',
blog_last_visitors VARCHAR(MAX) NULL,
  blog_view_level VARCHAR(12) NOT NULL,
blog_categories VARCHAR(MAX) NULL,
  blog_seo_name VARCHAR(255) NULL,
  blog_editors INT NULL,
  blog_groupblog_ids VARCHAR(255) NOT NULL DEFAULT '',
  blog_groupblog_name VARCHAR(255) NOT NULL DEFAULT '',
  blog_groupblog INT NOT NULL DEFAULT '0',
  blog_last_edate INT NOT NULL DEFAULT '0',
  blog_lentry_banish INT DEFAULT '0',
  blog_last_udate INT NOT NULL DEFAULT '0',
  blog_owner_only INT NOT NULL DEFAULT '0',
  blog_authorized_users VARCHAR(255) NULL,
  PRIMARY KEY (blog_id)
);";

$TABLE[] = "CREATE TABLE blog_categories (
  category_id BIGINT NOT NULL IDENTITY,
  category_blog_id BIGINT NOT NULL DEFAULT '0',
  category_parent BIGINT NOT NULL DEFAULT '0',
  category_title VARCHAR(255) NOT NULL DEFAULT '',
  category_title_seo VARCHAR(255) NOT NULL DEFAULT '',
  category_position INT NOT NULL DEFAULT '0',
  PRIMARY KEY (category_id)
);";
$TABLE[] = "CREATE TABLE blog_category_mapping (
  map_category_id BIGINT NOT NULL,
  map_entry_id BIGINT NOT NULL,
  map_blog_id BIGINT NOT NULL,
  map_is_draft INT NOT NULL DEFAULT '0',
  map_is_private INT NOT NULL DEFAULT '0'
);";
$TABLE[] = "CREATE TABLE blog_cblock_cache (
  blog_id INT NOT NULL,
  cbcache_key VARCHAR(32) NOT NULL,
  cbcache_lastupdate INT NOT NULL DEFAULT '0',
  cbcache_refresh SMALLINT NOT NULL DEFAULT '0',
cbcache_content VARCHAR(MAX) NULL,
  PRIMARY KEY (blog_id,cbcache_key)
);";
$TABLE[] = "CREATE TABLE blog_cblocks (
  cblock_id INT NOT NULL IDENTITY,
  blog_id INT NOT NULL,
  member_id INT NOT NULL,
  cblock_order SMALLINT DEFAULT '0',
  cblock_show SMALLINT DEFAULT '0',
  cblock_type VARCHAR(10) NULL,
  cblock_ref_id INT NOT NULL,
  cblock_position VARCHAR(10) NOT NULL DEFAULT 'right',
cblock_config VARCHAR(MAX) NULL,
  PRIMARY KEY (cblock_id)
);";
$TABLE[] = "CREATE TABLE blog_comments (
  comment_id INT NOT NULL IDENTITY,
  entry_id INT NOT NULL,
  member_id INT NULL,
  member_name VARCHAR(255) NULL,
  ip_address VARCHAR(16) NULL,
  comment_date INT NULL,
  comment_use_sig SMALLINT DEFAULT '0',
  comment_use_emo SMALLINT DEFAULT '0',
  comment_html_state SMALLINT DEFAULT '0',
  comment_append_edit SMALLINT DEFAULT '0',
  comment_queued SMALLINT DEFAULT '0',
  comment_edit_time INT NULL,
  comment_edit_name VARCHAR(255) NULL,
comment_text VARCHAR(MAX) NULL,
  PRIMARY KEY (comment_id)
);";
$TABLE[] = "CREATE TABLE blog_custom_cblocks (
  cbcus_id INT NOT NULL IDENTITY,
  cbcus_name VARCHAR(255) NULL,
cbcus VARCHAR(MAX) NULL,
  cbcus_post_key VARCHAR(32) NULL,
  cbcus_has_attach SMALLINT DEFAULT '0',
  cbcus_html_state SMALLINT DEFAULT '0',
  PRIMARY KEY (cbcus_id)
);";
$TABLE[] = "CREATE TABLE blog_default_cblocks (
  cbdef_id INT NOT NULL IDENTITY,
  cbdef_name VARCHAR(255) NULL,
  cbdef_function VARCHAR(255) NULL,
  cbdef_default SMALLINT DEFAULT '0',
  cbdef_order SMALLINT DEFAULT '0',
  cbdef_locked SMALLINT DEFAULT '0',
  cbdef_enabled SMALLINT DEFAULT '0',
  PRIMARY KEY (cbdef_id)
);";
$TABLE[] = "CREATE TABLE blog_editors_map (
  editor_member_id BIGINT NOT NULL DEFAULT '0',
  editor_blog_id BIGINT NOT NULL DEFAULT '0',
  editor_added BIGINT NOT NULL DEFAULT '0'
);";
$TABLE[] = "CREATE TABLE blog_entries (
  entry_id INT NOT NULL IDENTITY CONSTRAINT PK_entry_id PRIMARY KEY,
  blog_id INT NOT NULL,
  entry_author_id INT NOT NULL DEFAULT '0',
  entry_author_name VARCHAR(255) NOT NULL DEFAULT '',
  entry_date INT NOT NULL,
  entry_name VARCHAR(250) NULL,
entry VARCHAR(MAX) NULL,
  entry_status VARCHAR(10) NOT NULL,
  entry_locked SMALLINT DEFAULT '0',
  entry_num_comments INT DEFAULT '0',
  entry_last_comment INT NULL,
  entry_last_comment_date INT NULL,
  entry_last_comment_name VARCHAR(255) NULL,
  entry_last_comment_mid INT NULL,
  entry_queued_comments SMALLINT NOT NULL DEFAULT '0',
  entry_has_attach SMALLINT DEFAULT '0',
  entry_post_key VARCHAR(32) NULL,
  entry_edit_time INT NULL,
  entry_edit_name VARCHAR(255) NULL,
  entry_html_state SMALLINT DEFAULT '0',
  entry_use_emo SMALLINT DEFAULT '0',
  entry_trackbacks SMALLINT NOT NULL DEFAULT '0',
entry_sent_trackbacks VARCHAR(MAX) NULL,
  entry_last_update INT DEFAULT '0',
  entry_gallery_album INT DEFAULT '0',
  entry_poll_state SMALLINT NOT NULL DEFAULT '0',
  entry_last_vote INT NOT NULL DEFAULT '0',
  entry_featured SMALLINT NOT NULL DEFAULT '0',
  entry_hastags SMALLINT NOT NULL DEFAULT '0',
entry_category VARCHAR(MAX) NULL,
  entry_name_seo VARCHAR(255) NOT NULL DEFAULT '',
entry_tag_cache VARCHAR(MAX) NULL,
entry_short VARCHAR(MAX) NULL,
  entry_rating_total INT DEFAULT '0',
  entry_rating_count INT DEFAULT '0',
  entry_banish INT DEFAULT '0',
  entry_rss_import INT NOT NULL DEFAULT '0',
  entry_future_date INT NOT NULL DEFAULT '0'
);";
$TABLE[] = "CREATE TABLE blog_headers (
  header_id INT NOT NULL IDENTITY,
  header_on SMALLINT NOT NULL DEFAULT '0',
  header_image VARCHAR(255) NULL,
  header_tile VARCHAR(255) NULL,
header_opts VARCHAR(MAX) NULL,
  PRIMARY KEY (header_id)
);";
$TABLE[] = "CREATE TABLE blog_lastinfo (
  blog_id INT NOT NULL,
  blog_num_entries INT DEFAULT '0',
  blog_num_drafts INT DEFAULT '0',
  blog_num_comments INT DEFAULT '0',
  blog_last_entry INT NULL,
  blog_last_entryname VARCHAR(250) NULL,
  blog_last_date INT NULL,
  blog_last_comment INT NULL,
  blog_last_comment_date INT NULL,
  blog_last_comment_entry INT NULL,
  blog_last_comment_entryname VARCHAR(250) NULL,
  blog_last_comment_name VARCHAR(255) NULL,
  blog_last_comment_mid INT NULL,
  blog_last_update INT DEFAULT '0',
blog_last_entry_excerpt VARCHAR(MAX) NULL,
blog_tag_cloud VARCHAR(MAX) NULL,
blog_cblocks VARCHAR(MAX) NULL,
blog_last_comment_20 VARCHAR(MAX) NULL,
blog_cblocks_available VARCHAR(MAX) NULL,
  PRIMARY KEY (blog_id)
);";
$TABLE[] = "CREATE TABLE blog_mediatag (
  mediatag_id smallINT NOT NULL IDENTITY,
  mediatag_name VARCHAR(255) NOT NULL,
mediatag_match VARCHAR(MAX) NULL,
mediatag_replace VARCHAR(MAX) NULL,
  PRIMARY KEY (mediatag_id)
);";
$TABLE[] = "CREATE TABLE blog_moderators (
  moderate_id INT NOT NULL IDENTITY,
  moderate_type VARCHAR(10) NOT NULL,
  moderate_mg_id INT NOT NULL,
  moderate_can_edit_comments SMALLINT NOT NULL DEFAULT '0',
  moderate_can_edit_entries SMALLINT NOT NULL DEFAULT '0',
  moderate_can_del_comments SMALLINT NOT NULL DEFAULT '0',
  moderate_can_del_entries SMALLINT NOT NULL DEFAULT '0',
  moderate_can_lock SMALLINT NOT NULL DEFAULT '0',
  moderate_can_publish SMALLINT NOT NULL DEFAULT '0',
  moderate_can_approve SMALLINT NOT NULL DEFAULT '0',
  moderate_can_editcblocks SMALLINT NOT NULL DEFAULT '0',
  moderate_can_del_trackback SMALLINT NOT NULL DEFAULT '0',
  moderate_can_view_draft SMALLINT NOT NULL DEFAULT '0',
  moderate_can_view_private SMALLINT NOT NULL DEFAULT '0',
  moderate_can_warn SMALLINT NOT NULL DEFAULT '0',
  moderate_can_pin SMALLINT NOT NULL DEFAULT '0',
  moderate_can_disable SMALLINT NOT NULL DEFAULT '0',
  moderator_can_feature SMALLINT NOT NULL DEFAULT '0',
  PRIMARY KEY (moderate_id)
);";
$TABLE[] = "CREATE TABLE blog_pingservices (
  blog_service_id INT NOT NULL IDENTITY,
  blog_service_key VARCHAR(10) NOT NULL,
  blog_service_name VARCHAR(255) NOT NULL DEFAULT '',
  blog_service_host VARCHAR(255) NOT NULL DEFAULT '',
  blog_service_port SMALLINT NULL,
  blog_service_path VARCHAR(255) NOT NULL DEFAULT '',
  blog_service_methodname VARCHAR(255) NOT NULL DEFAULT '',
  blog_service_extended SMALLINT NOT NULL DEFAULT '0',
  blog_service_enabled SMALLINT NOT NULL DEFAULT '0',
  PRIMARY KEY (blog_service_id)
);";
$TABLE[] = "CREATE TABLE blog_polls (
  poll_id INT NOT NULL IDENTITY,
  entry_id INT NOT NULL DEFAULT '0',
  start_date INT NULL,
choices VARCHAR(MAX) NULL,
  starter_id INT NOT NULL DEFAULT '0',
  votes SMALLINT NOT NULL DEFAULT '0',
  poll_question VARCHAR(255) NULL,
  PRIMARY KEY (poll_id)
);";
$TABLE[] = "CREATE TABLE blog_ratings (
  rating_id INT NOT NULL IDENTITY,
  member_id INT NOT NULL,
  blog_id INT NOT NULL,
  rating_date INT NOT NULL,
  rating SMALLINT NOT NULL DEFAULT '0',
  entry_id INT DEFAULT '0',
  PRIMARY KEY (rating_id)
);";
$TABLE[] = "CREATE TABLE blog_read (
  blog_id INT NOT NULL,
  member_id INT NOT NULL,
  last_read INT NOT NULL DEFAULT '0',
  unread_count SMALLINT NOT NULL DEFAULT '0',
  last_count INT NOT NULL DEFAULT '0',
entries_read VARCHAR(MAX) NULL,
  PRIMARY KEY (blog_id,member_id)
);";
$TABLE[] = "CREATE TABLE blog_rsscache (
  blog_id INT NOT NULL,
  rsscache_refresh SMALLINT NOT NULL DEFAULT '0',
rsscache_feed VARCHAR(MAX) NULL,
  PRIMARY KEY (blog_id)
);";
$TABLE[] = "CREATE TABLE blog_rssimport (
  rss_id INT NOT NULL IDENTITY,
  rss_blog_id INT NOT NULL DEFAULT '0',
  rss_url VARCHAR(255) NOT NULL DEFAULT '',
  rss_per_go INT NOT NULL DEFAULT '10',
  rss_auth_user VARCHAR(255) NOT NULL DEFAULT '',
  rss_auth_pass VARCHAR(255) NOT NULL DEFAULT '',
  rss_last_import INT NOT NULL DEFAULT '0',
  rss_in_progress INT NOT NULL DEFAULT '0',
  rss_count INT NOT NULL DEFAULT '0',
rss_tags VARCHAR(MAX) NULL,
rss_cats VARCHAR(MAX) NULL,
  PRIMARY KEY (rss_id)
);";
$TABLE[] = "CREATE TABLE blog_themes (
  theme_id INT NOT NULL IDENTITY,
  theme_on SMALLINT NOT NULL DEFAULT '0',
theme_css VARCHAR(MAX) NULL,
  theme_images VARCHAR(255) NULL,
theme_opts VARCHAR(MAX) NULL,
  theme_name VARCHAR(255) NULL,
  theme_author VARCHAR(255) NULL,
  theme_homepage VARCHAR(255) NULL,
  theme_email VARCHAR(255) NULL,
theme_desc VARCHAR(MAX) NULL,
  theme_css_overwrite SMALLINT NOT NULL DEFAULT '0',
  PRIMARY KEY (theme_id)
);";
$TABLE[] = "CREATE TABLE blog_this (
  bt_id INT NOT NULL IDENTITY,
  bt_entry_id INT NOT NULL DEFAULT '0',
  bt_app VARCHAR(255) NOT NULL DEFAULT '',
  bt_id1 INT NOT NULL DEFAULT '0',
  bt_id2 INT NOT NULL DEFAULT '0',
  PRIMARY KEY (bt_id)
);";
$TABLE[] = "CREATE TABLE blog_trackback (
  trackback_id INT NOT NULL IDENTITY,
  blog_id INT DEFAULT '0',
  entry_id INT NOT NULL,
  ip_address VARCHAR(16) NULL,
  trackback_url VARCHAR(255) NOT NULL,
  trackback_title VARCHAR(255) NULL,
  trackback_excerpt VARCHAR(255) NULL,
  trackback_blog_name VARCHAR(255) NULL,
  trackback_date INT NULL,
  trackback_queued SMALLINT DEFAULT '0',
  PRIMARY KEY (trackback_id)
);";
$TABLE[] = "CREATE TABLE blog_trackback_spamlogs (
  trackback_id INT NOT NULL IDENTITY,
  blog_id INT DEFAULT '0',
  entry_id INT NOT NULL,
  ip_address VARCHAR(16) NULL,
  trackback_url VARCHAR(255) NOT NULL,
  trackback_title VARCHAR(255) NULL,
  trackback_excerpt VARCHAR(255) NULL,
  trackback_blog_name VARCHAR(255) NULL,
  trackback_date INT NULL,
  trackback_queued SMALLINT DEFAULT '0',
  PRIMARY KEY (trackback_id)
);";
$TABLE[] = "CREATE TABLE blog_tracker (
  tracker_id INT NOT NULL IDENTITY,
  blog_id INT NOT NULL,
  member_id INT NOT NULL,
  entry_id INT NOT NULL DEFAULT '1',
  auto_comments INT NOT NULL DEFAULT '0',
  PRIMARY KEY (tracker_id)
);";
$TABLE[] = "CREATE TABLE blog_tracker_queue (
  tq_id INT NOT NULL IDENTITY,
  blog_id INT NOT NULL,
  entry_id INT NOT NULL,
  tq_to VARCHAR(255) NOT NULL DEFAULT '',
tq_subject VARCHAR(MAX) NOT NULL,
tq_content VARCHAR(MAX) NOT NULL,
  PRIMARY KEY (tq_id)
);";
$TABLE[] = "CREATE TABLE blog_updatepings (
  ping_id INT NOT NULL IDENTITY,
  ping_active SMALLINT NOT NULL DEFAULT '0',
  ping_time INT NOT NULL DEFAULT '0',
  ping_tries SMALLINT NOT NULL DEFAULT '0',
  blog_id INT NOT NULL,
  entry_id INT NOT NULL,
  ping_service VARCHAR(30) NOT NULL DEFAULT '',
  PRIMARY KEY (ping_id)
);";

$TABLE[] = "CREATE TABLE blog_views (
  blog_id INT NOT NULL
);";
$TABLE[] = "CREATE TABLE blog_voters (
  vote_id INT NOT NULL IDENTITY,
  ip_address VARCHAR(16) NOT NULL DEFAULT '',
  vote_date INT NOT NULL DEFAULT '0',
  entry_id INT NOT NULL DEFAULT '0',
  member_id INT NOT NULL DEFAULT '0',
  PRIMARY KEY (vote_id)
);";
$TABLE[] = "CREATE INDEX log_etbid ON blog_akismet_logs ( log_etbid );";
$TABLE[] = "CREATE INDEX member_id ON blog_authmembers ( member_id );";
$TABLE[] = "CREATE INDEX blog_member_id ON blog_blogs ( member_id );";
$TABLE[] = "CREATE INDEX blog_groupblog ON blog_blogs ( blog_groupblog );";
$TABLE[] = "CREATE INDEX blog_grabber ON blog_blogs ( blog_disabled,blog_type,blog_view_level );";
$TABLE[] = "CREATE INDEX blog_pinned ON blog_blogs ( blog_pinned );";
$TABLE[] = "CREATE INDEX blog_last_edate ON blog_blogs ( blog_last_edate );";
$TABLE[] = "CREATE INDEX blog_view_level ON blog_blogs ( blog_view_level );";
$TABLE[] = "CREATE INDEX blog_lentry_banish ON blog_blogs ( blog_lentry_banish );";
$TABLE[] = "CREATE INDEX as_list_view ON blog_blogs ( blog_pinned,blog_disabled,blog_allowguests,blog_last_edate );";
$TABLE[] = "CREATE INDEX auth_user ON blog_blogs ( blog_owner_only,blog_authorized_users );";
$TABLE[] = "CREATE INDEX category_blog_id ON blog_categories ( category_blog_id );";
$TABLE[] = "CREATE INDEX member_cat_meow ON blog_categories ( category_id,category_blog_id );";
$TABLE[] = "CREATE INDEX cap_map_lookup ON blog_category_mapping ( map_category_id,map_blog_id );";
$TABLE[] = "CREATE INDEX map_entry_id ON blog_category_mapping ( map_entry_id );";
$TABLE[] = "CREATE INDEX cblock_blog_id ON blog_cblocks ( blog_id );";
$TABLE[] = "CREATE INDEX cblock_member_id ON blog_cblocks ( member_id );";
$TABLE[] = "CREATE INDEX cblock_ref_id ON blog_cblocks ( cblock_ref_id );";
$TABLE[] = "CREATE INDEX comment_entry_id ON blog_comments ( entry_id );";
$TABLE[] = "CREATE INDEX comment_member_id ON blog_comments ( member_id );";
$TABLE[] = "CREATE INDEX entry_comment ON blog_comments ( comment_id,entry_id );";
$TABLE[] = "CREATE INDEX cbdef_enabled ON blog_default_cblocks ( cbdef_enabled,cbdef_order );";
$TABLE[] = "CREATE INDEX editor_map ON blog_editors_map ( editor_member_id,editor_blog_id );";
$TABLE[] = "CREATE INDEX entry_blog_id ON blog_entries ( blog_id,entry_status,entry_date );";
$TABLE[] = "CREATE INDEX entry_last_update ON blog_entries ( blog_id,entry_status,entry_last_update );";
$TABLE[] = "CREATE INDEX entry_category_id ON blog_entries ( blog_id );";
$TABLE[] = "CREATE INDEX entry_featured ON blog_entries ( entry_featured );";
$TABLE[] = "CREATE INDEX entry_date ON blog_entries ( entry_date );";
$TABLE[] = "CREATE INDEX entry_status ON blog_entries ( entry_status );";
$TABLE[] = "CREATE INDEX entry_banish ON blog_entries ( entry_banish );";
$TABLE[] = "CREATE INDEX entry_rss_import ON blog_entries ( entry_rss_import );";
$TABLE[] = "CREATE INDEX entry_future_date ON blog_entries ( entry_future_date,entry_date );";
$TABLE[] = "CREATE INDEX header_on ON blog_headers ( header_on );";
$TABLE[] = "CREATE INDEX entry_id ON blog_polls ( entry_id );";
$TABLE[] = "CREATE INDEX rating_blog_id ON blog_ratings ( blog_id,member_id );";
$TABLE[] = "CREATE INDEX entryrating_blog_id ON blog_ratings ( member_id,blog_id,entry_id );";
$TABLE[] = "CREATE INDEX blog_time ON blog_rssimport ( rss_blog_id,rss_last_import );";
$TABLE[] = "CREATE INDEX rss_blog_id ON blog_rssimport ( rss_blog_id );";
$TABLE[] = "CREATE INDEX rss_last_import ON blog_rssimport ( rss_last_import );";
$TABLE[] = "CREATE INDEX theme_on ON blog_themes ( theme_on );";
$TABLE[] = "CREATE INDEX lookup ON blog_this ( bt_app,bt_id1,bt_id2 );";
$TABLE[] = "CREATE INDEX entry_id ON blog_this ( bt_entry_id );";
$TABLE[] = "CREATE INDEX entry_id ON blog_trackback ( entry_id );";
$TABLE[] = "CREATE INDEX tracker_blogentry ON blog_tracker ( blog_id,member_id,entry_id );";
$TABLE[] = "CREATE INDEX auto_comments ON blog_tracker ( auto_comments );";
$TABLE[] = "CREATE INDEX trackqueue_blogentry ON blog_tracker_queue ( blog_id,entry_id );";
$TABLE[] = "CREATE INDEX blog_activetime ON blog_updatepings ( ping_active,ping_time );";
$TABLE[] = "CREATE INDEX blog_blogentry ON blog_updatepings ( blog_id,entry_id );";
$TABLE[] = "CREATE INDEX entry_id ON blog_voters ( entry_id,member_id );";
?>