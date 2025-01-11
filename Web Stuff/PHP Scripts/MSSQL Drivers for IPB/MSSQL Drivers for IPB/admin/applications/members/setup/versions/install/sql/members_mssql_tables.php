<?php
/**
* Installation Schematic File
* Generated on Tue, 04 May 2010 11:57:53 +0000 GMT
*/
$TABLE[] = "CREATE TABLE message_posts (
  msg_id INT NOT NULL IDENTITY CONSTRAINT PK_msg_id PRIMARY KEY,
  msg_topic_id INT NOT NULL DEFAULT '0',
  msg_date INT NOT NULL,
msg_post VARCHAR(MAX) NULL,
  msg_post_key VARCHAR(32) NOT NULL DEFAULT '0',
  msg_author_id INT NOT NULL DEFAULT '0',
  msg_ip_address VARCHAR(16) NOT NULL DEFAULT '0',
  msg_is_first_post INT NOT NULL DEFAULT '0'
);";
$TABLE[] = "CREATE TABLE message_topic_user_map (
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
$TABLE[] = "CREATE TABLE message_topics (
  mt_id INT NOT NULL IDENTITY CONSTRAINT PK_mt_id PRIMARY KEY,
  mt_date INT NOT NULL DEFAULT '0',
  mt_title VARCHAR(255) NOT NULL DEFAULT '',
  mt_hasattach SMALLINT NOT NULL DEFAULT '0',
  mt_starter_id INT NOT NULL DEFAULT '0',
  mt_start_time INT NOT NULL DEFAULT '0',
  mt_last_post_time INT NOT NULL DEFAULT '0',
mt_invited_members VARCHAR(MAX) NULL,
  mt_to_count INT NOT NULL DEFAULT '0',
  mt_to_member_id INT NOT NULL DEFAULT '0',
  mt_replies INT NOT NULL DEFAULT '0',
  mt_last_msg_id INT NOT NULL DEFAULT '0',
  mt_first_msg_id INT NOT NULL DEFAULT '0',
  mt_is_draft INT NOT NULL DEFAULT '0',
  mt_is_deleted INT NOT NULL DEFAULT '0',
  mt_is_system INT NOT NULL DEFAULT '0'
);";
$TABLE[] = "CREATE INDEX msg_topic_id ON message_posts ( msg_topic_id );";
$TABLE[] = "CREATE INDEX msg_date ON message_posts ( msg_date );";
$TABLE[] = "CREATE INDEX msg_ip_address ON message_posts ( msg_ip_address );";
$TABLE[] = "CREATE INDEX map_main ON message_topic_user_map ( map_user_id,map_topic_id );";
$TABLE[] = "CREATE INDEX map_topic_id ON message_topic_user_map ( map_topic_id );";
$TABLE[] = "CREATE INDEX map_topic_id_2 ON message_topic_user_map ( map_topic_id );";
$TABLE[] = "CREATE INDEX map_user ON message_topic_user_map ( map_user_id,map_folder_id,map_last_topic_reply );";
$TABLE[] = "CREATE INDEX mt_starter_id ON message_topics ( mt_starter_id );";
$TABLE[] = "CREATE INDEX mt_date ON message_topics ( mt_date );";
?>