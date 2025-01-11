<?php
/**
* Installation Schematic File
* Generated on Tue, 04 May 2010 11:57:53 +0000 GMT
*/
$TABLE[] = "CREATE TABLE forum_perms (
  perm_id INT NOT NULL IDENTITY,
  perm_name VARCHAR(250) NOT NULL DEFAULT '',
  PRIMARY KEY (perm_id)
);";
$TABLE[] = "CREATE TABLE forum_tracker (
  frid INT NOT NULL IDENTITY,
  member_id INT NOT NULL,
  forum_id SMALLINT NOT NULL DEFAULT '0',
  start_date INT NULL,
  last_sent INT NOT NULL DEFAULT '0',
  forum_track_type VARCHAR(100) NOT NULL DEFAULT 'delayed',
  PRIMARY KEY (frid)
);";
$TABLE[] = "CREATE TABLE forums (
  id SMALLINT NOT NULL IDENTITY,
  topics INT NULL,
  posts INT NULL,
  last_post INT NULL,
  last_poster_id INT NOT NULL DEFAULT '0',
  last_poster_name VARCHAR(255) NULL,
  name VARCHAR(128) NOT NULL DEFAULT '',
description VARCHAR(MAX) NULL,
  position BIGINT DEFAULT '0',
  use_ibc SMALLINT NULL,
  use_html SMALLINT NULL,
  status SMALLINT DEFAULT '1',
  password VARCHAR(32) NULL,
  password_override VARCHAR(255) NULL,
  last_title VARCHAR(250) NULL,
  last_id INT NULL,
  sort_key VARCHAR(32) NULL,
  sort_order VARCHAR(32) NULL,
  prune SMALLINT NULL,
  topicfilter VARCHAR(32) NOT NULL DEFAULT 'all',
  show_rules SMALLINT NULL,
  preview_posts SMALLINT NULL,
  allow_poll SMALLINT NOT NULL DEFAULT '1',
  allow_pollbump SMALLINT NOT NULL DEFAULT '0',
  inc_postcount SMALLINT NOT NULL DEFAULT '1',
  skin_id INT NULL,
  parent_id INT DEFAULT '-1',
  quick_reply SMALLINT DEFAULT '0',
  redirect_url VARCHAR(250) DEFAULT '',
  redirect_on SMALLINT NOT NULL DEFAULT '0',
  redirect_hits INT NOT NULL DEFAULT '0',
  redirect_loc VARCHAR(250) DEFAULT '',
  rules_title VARCHAR(255) NOT NULL DEFAULT '',
rules_text VARCHAR(MAX) NULL,
  topic_mm_id VARCHAR(250) NOT NULL DEFAULT '',
notify_modq_emails VARCHAR(MAX) NULL,
  sub_can_post SMALLINT DEFAULT '1',
permission_custom_error VARCHAR(MAX) NULL,
permission_array VARCHAR(MAX) NULL,
  permission_showtopic SMALLINT NOT NULL DEFAULT '0',
  queued_topics INT NOT NULL DEFAULT '0',
  queued_posts INT NOT NULL DEFAULT '0',
  forum_allow_rating SMALLINT NOT NULL DEFAULT '0',
  forum_last_deletion INT NOT NULL DEFAULT '0',
  newest_title VARCHAR(250) NULL,
  newest_id INT NOT NULL DEFAULT '0',
  min_posts_post BIGINT NOT NULL,
  min_posts_view BIGINT NOT NULL,
  can_view_others SMALLINT NOT NULL DEFAULT '1',
  hide_last_info SMALLINT NOT NULL DEFAULT '0',
  name_seo VARCHAR(255) NULL,
  seo_last_title VARCHAR(255) NOT NULL DEFAULT '',
  seo_last_name VARCHAR(255) NOT NULL DEFAULT '',
last_x_topic_ids VARCHAR(MAX) NULL,
  forums_bitoptions BIGINT NOT NULL DEFAULT '0',
  deleted_posts INT NOT NULL DEFAULT '0',
  deleted_topics INT NOT NULL DEFAULT '0',
  disable_sharelinks INT NOT NULL DEFAULT '0',
  PRIMARY KEY (id)
);";
$TABLE[] = "CREATE TABLE mod_queued_items (
  id INT NOT NULL IDENTITY,
  type VARCHAR(32) NOT NULL DEFAULT 'post',
  type_id INT NOT NULL DEFAULT '0',
  PRIMARY KEY (id)
);";
$TABLE[] = "CREATE TABLE moderator_logs (
  id INT NOT NULL IDENTITY,
  forum_id INT DEFAULT '0',
  topic_id INT NOT NULL DEFAULT '0',
  post_id INT NULL,
  member_id INT NOT NULL DEFAULT '0',
  member_name VARCHAR(32) NOT NULL DEFAULT '',
  ip_address VARCHAR(16) NOT NULL DEFAULT '0',
  http_referer VARCHAR(255) NULL,
  ctime INT NOT NULL,
  topic_title VARCHAR(128) NULL,
  action VARCHAR(128) NULL,
  query_string VARCHAR(128) NULL,
  PRIMARY KEY (id)
);";
$TABLE[] = "CREATE TABLE moderators (
  mid INT NOT NULL IDENTITY,
forum_id VARCHAR(MAX) NULL,
  member_name VARCHAR(32) NOT NULL DEFAULT '',
  member_id INT NOT NULL DEFAULT '0',
  edit_post SMALLINT NULL,
  edit_topic SMALLINT NULL,
  delete_post SMALLINT NULL,
  delete_topic SMALLINT NULL,
  view_ip SMALLINT NULL,
  open_topic SMALLINT NULL,
  close_topic SMALLINT NULL,
  mass_move SMALLINT NULL,
  mass_prune SMALLINT NULL,
  move_topic SMALLINT NULL,
  pin_topic SMALLINT NULL,
  unpin_topic SMALLINT NULL,
  post_q SMALLINT NULL,
  topic_q SMALLINT NULL,
  allow_warn SMALLINT NULL,
  edit_user SMALLINT NOT NULL DEFAULT '0',
  is_group SMALLINT DEFAULT '0',
  group_id SMALLINT NULL,
  group_name VARCHAR(200) NULL,
  split_merge SMALLINT DEFAULT '0',
  can_mm SMALLINT NOT NULL DEFAULT '0',
  mod_can_set_open_time SMALLINT NOT NULL DEFAULT '0',
  mod_can_set_close_time SMALLINT NOT NULL DEFAULT '0',
  mod_bitoptions BIGINT NOT NULL DEFAULT '0',
  PRIMARY KEY (mid)
);";
$TABLE[] = "CREATE TABLE polls (
  pid INT NOT NULL IDENTITY,
  tid INT NOT NULL DEFAULT '0',
  start_date INT NULL,
choices VARCHAR(MAX) NULL,
  starter_id INT NOT NULL DEFAULT '0',
  votes SMALLINT NOT NULL DEFAULT '0',
  forum_id SMALLINT NOT NULL DEFAULT '0',
  poll_question VARCHAR(255) NULL,
  poll_only SMALLINT NOT NULL DEFAULT '0',
  poll_view_voters INT NOT NULL DEFAULT '0',
  PRIMARY KEY (pid)
);";
$TABLE[] = "CREATE TABLE posts (
  pid INT NOT NULL IDENTITY CONSTRAINT PK_pid PRIMARY KEY,
  append_edit SMALLINT DEFAULT '0',
  edit_time INT NULL,
  author_id INT NOT NULL DEFAULT '0',
  author_name VARCHAR(255) NULL,
  use_sig SMALLINT NOT NULL DEFAULT '0',
  use_emo SMALLINT NOT NULL DEFAULT '0',
  ip_address VARCHAR(16) NOT NULL DEFAULT '',
  post_date INT DEFAULT '0',
  icon_id SMALLINT NULL,
  post VARCHAR(MAX) NULL,
  queued SMALLINT NOT NULL DEFAULT '0',
  topic_id INT NOT NULL DEFAULT '0',
  post_title VARCHAR(255) NULL,
  new_topic SMALLINT DEFAULT '0',
  edit_name VARCHAR(255) NULL,
  post_key VARCHAR(32) NOT NULL DEFAULT '0',
  post_parent INT NOT NULL DEFAULT '0',
  post_htmlstate SMALLINT NOT NULL DEFAULT '0',
  post_edit_reason VARCHAR(255) NOT NULL DEFAULT ''
);";
$TABLE[] = "CREATE TABLE topic_mmod (
  mm_id SMALLINT NOT NULL IDENTITY,
  mm_title VARCHAR(250) NOT NULL DEFAULT '',
  mm_enabled SMALLINT NOT NULL DEFAULT '0',
  topic_state VARCHAR(10) NOT NULL DEFAULT 'leave',
  topic_pin VARCHAR(10) NOT NULL DEFAULT 'leave',
  topic_move SMALLINT NOT NULL DEFAULT '0',
  topic_move_link SMALLINT NOT NULL DEFAULT '0',
  topic_title_st VARCHAR(250) NOT NULL DEFAULT '',
  topic_title_end VARCHAR(250) NOT NULL DEFAULT '',
  topic_reply SMALLINT NOT NULL DEFAULT '0',
topic_reply_content VARCHAR(MAX) NULL,
  topic_reply_postcount SMALLINT NOT NULL DEFAULT '0',
mm_forums VARCHAR(MAX) NULL,
  topic_approve SMALLINT NOT NULL DEFAULT '0',
  PRIMARY KEY (mm_id)
);";
$TABLE[] = "CREATE TABLE topic_ratings (
  rating_id INT NOT NULL IDENTITY,
  rating_tid INT NOT NULL DEFAULT '0',
  rating_member_id INT NOT NULL DEFAULT '0',
  rating_value SMALLINT NOT NULL DEFAULT '0',
  rating_ip_address VARCHAR(16) NOT NULL DEFAULT '',
  PRIMARY KEY (rating_id)
);";
$TABLE[] = "CREATE TABLE topic_views (
  views_tid INT NOT NULL DEFAULT '0'
);";
$TABLE[] = "CREATE TABLE topics (
  tid INT NOT NULL IDENTITY CONSTRAINT PK_tid PRIMARY KEY,
  title VARCHAR(250) NOT NULL DEFAULT '',
  description VARCHAR(250) NULL,
  state VARCHAR(8) NULL,
  posts INT NULL,
  starter_id INT NOT NULL DEFAULT '0',
  start_date INT NOT NULL,
  last_poster_id INT NOT NULL DEFAULT '0',
  last_post INT NOT NULL,
  icon_id SMALLINT NULL,
  starter_name VARCHAR(255) NULL,
  last_poster_name VARCHAR(255) NULL,
  poll_state VARCHAR(8) NULL,
  last_vote INT NULL,
  views INT NULL,
  forum_id SMALLINT NOT NULL DEFAULT '0',
  approved SMALLINT NOT NULL DEFAULT '0',
  author_mode SMALLINT NULL,
  pinned SMALLINT NULL,
  moved_to VARCHAR(64) NULL,
  total_votes INT NOT NULL DEFAULT '0',
  topic_hasattach SMALLINT NOT NULL DEFAULT '0',
  topic_firstpost INT NOT NULL DEFAULT '0',
  topic_queuedposts INT NOT NULL DEFAULT '0',
  topic_open_time INT NOT NULL DEFAULT '0',
  topic_close_time INT NOT NULL DEFAULT '0',
  topic_rating_total SMALLINT NOT NULL DEFAULT '0',
  topic_rating_hits SMALLINT NOT NULL DEFAULT '0',
  title_seo VARCHAR(250) NOT NULL DEFAULT '',
  seo_last_name VARCHAR(255) NOT NULL DEFAULT '',
  seo_first_name VARCHAR(255) NOT NULL DEFAULT '',
  topic_deleted_posts INT NOT NULL DEFAULT '0'
);";
$TABLE[] = "CREATE TABLE tracker (
  trid INT NOT NULL IDENTITY,
  member_id INT NOT NULL DEFAULT '0',
  topic_id INT NOT NULL DEFAULT '0',
  start_date INT NULL,
  last_sent INT NOT NULL DEFAULT '0',
  topic_track_type VARCHAR(100) NOT NULL DEFAULT 'delayed',
  PRIMARY KEY (trid)
);";
$TABLE[] = "CREATE INDEX member_id ON forum_tracker ( member_id );";
$TABLE[] = "CREATE INDEX fm_id ON forum_tracker ( forum_id );";
$TABLE[] = "CREATE INDEX position ON forums ( position,parent_id );";
$TABLE[] = "CREATE INDEX type_id ON mod_queued_items ( type_id );";
$TABLE[] = "CREATE INDEX ctime ON moderator_logs ( ctime );";
$TABLE[] = "CREATE INDEX ip_address ON moderator_logs ( ip_address );";
$TABLE[] = "CREATE INDEX group_id ON moderators ( group_id );";
$TABLE[] = "CREATE INDEX member_id ON moderators ( member_id );";
$TABLE[] = "CREATE INDEX tid ON polls ( tid );";
$TABLE[] = "CREATE INDEX author_id ON posts ( author_id,topic_id );";
$TABLE[] = "CREATE INDEX ip_address ON posts ( ip_address );";
$TABLE[] = "CREATE INDEX post_key ON posts ( post_key );";
$TABLE[] = "CREATE INDEX post_date ON posts ( post_date );";
$TABLE[] = "CREATE INDEX topic_id ON posts ( topic_id,queued,pid,post_date );";
$TABLE[] = "CREATE INDEX rating_tid ON topic_ratings ( rating_tid,rating_member_id );";
$TABLE[] = "CREATE INDEX rating_ip_address ON topic_ratings ( rating_ip_address );";
$TABLE[] = "CREATE INDEX topic_firstpost ON topics ( topic_firstpost );";
$TABLE[] = "CREATE INDEX forum_id ON topics ( forum_id,pinned,approved );";
$TABLE[] = "CREATE INDEX starter_id ON topics ( starter_id,forum_id,approved );";
$TABLE[] = "CREATE INDEX last_post_sorting ON topics ( last_post,forum_id );";
$TABLE[] = "CREATE INDEX start_date ON topics ( start_date );";
$TABLE[] = "CREATE INDEX last_x_topics ON topics ( forum_id,approved,start_date );";
$TABLE[] = "CREATE INDEX last_post ON topics ( forum_id,pinned,last_post,state );";
$TABLE[] = "CREATE INDEX topic_id ON tracker ( topic_id );";
$TABLE[] = "CREATE INDEX tm_id ON tracker ( member_id,topic_id );";
?>