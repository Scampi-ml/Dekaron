<?php
/**
* Installation Schematic File
* Generated on Tue, 04 May 2010 11:57:53 +0000 GMT
*/
$TABLE[] = "CREATE TABLE gallery_albums (
  id bigINT NOT NULL IDENTITY,
  member_id INT NOT NULL DEFAULT '0',
  public_album SMALLINT NOT NULL DEFAULT '0',
  name VARCHAR(60) NOT NULL DEFAULT '',
description VARCHAR(MAX) NULL,
  images bigINT NOT NULL DEFAULT '0',
  comments bigINT NOT NULL DEFAULT '0',
  last_pic_id BIGINT NOT NULL DEFAULT '0',
  category_id BIGINT DEFAULT '0',
  last_pic_date VARCHAR(13) NOT NULL DEFAULT '0',
  last_pic_name VARCHAR(255) NULL,
  def_view VARCHAR(50) NOT NULL DEFAULT 'idate:DESC:*',
  mod_images INT NOT NULL DEFAULT '0',
  mod_comments INT NOT NULL DEFAULT '0',
  name_seo VARCHAR(255) NOT NULL,
  friend_only SMALLINT NOT NULL,
  cover_img_id bigINT NOT NULL,
  parent bigINT NOT NULL,
  profile_album SMALLINT NOT NULL DEFAULT 0,
  PRIMARY KEY (id)
);";
$TABLE[] = "CREATE TABLE gallery_bandwidth (
  bid bigINT NOT NULL IDENTITY,
  member_id INT NOT NULL DEFAULT '0',
  file_name VARCHAR(60) NOT NULL DEFAULT '',
  bdate BIGINT NOT NULL DEFAULT '0',
  bsize BIGINT NOT NULL DEFAULT '0',
  PRIMARY KEY (bid)
);";
$TABLE[] = "CREATE TABLE gallery_categories (
  id BIGINT NOT NULL IDENTITY,
  last_pic_name VARCHAR(255) NULL,
  parent BIGINT NOT NULL DEFAULT '0',
  name VARCHAR(60) NOT NULL DEFAULT '',
description VARCHAR(MAX) NULL,
  c_order BIGINT NOT NULL DEFAULT '0',
  images bigINT NOT NULL DEFAULT '0',
  comments bigINT NOT NULL DEFAULT '0',
  perms_thumbs VARCHAR(120) NOT NULL DEFAULT '',
  perms_view VARCHAR(120) NOT NULL DEFAULT '',
  perms_images VARCHAR(120) NOT NULL DEFAULT '',
  perms_comments VARCHAR(120) NOT NULL DEFAULT '',
  perms_moderate VARCHAR(120) NOT NULL DEFAULT '',
  allow_ibfcode SMALLINT NOT NULL DEFAULT '1',
  allow_html SMALLINT NOT NULL DEFAULT '0',
  password VARCHAR(60) NOT NULL DEFAULT '',
  approve_images SMALLINT NOT NULL DEFAULT '0',
  imgs_per_col BIGINT NOT NULL DEFAULT '4',
  imgs_per_row BIGINT NOT NULL DEFAULT '5',
  watermark_images SMALLINT NOT NULL DEFAULT '0',
  thumbnail SMALLINT NOT NULL DEFAULT '1',
  allow_comments SMALLINT NOT NULL DEFAULT '1',
  approve_comments SMALLINT NOT NULL DEFAULT '0',
  inc_post_count SMALLINT NOT NULL DEFAULT '1',
  status SMALLINT NOT NULL DEFAULT '1',
  last_pic_id BIGINT NOT NULL DEFAULT '0',
  def_view VARCHAR(30) DEFAULT 'idate:DESC:*',
  rate SMALLINT NOT NULL DEFAULT '1',
  allow_movies SMALLINT NOT NULL DEFAULT '0',
  allow_images SMALLINT NOT NULL DEFAULT '1',
  category_only SMALLINT DEFAULT '0',
  album_mode SMALLINT NOT NULL DEFAULT '0',
  last_member_id INT NULL,
  mod_images BIGINT NOT NULL DEFAULT '0',
  mod_comments INT NOT NULL DEFAULT '0',
  cat_rule_method SMALLINT NOT NULL DEFAULT '0',
  cat_rule_title VARCHAR(120) NOT NULL DEFAULT '',
cat_rule_text VARCHAR(MAX) NULL,
mem_gallery VARCHAR(MAX) NULL,
  last_pic_date VARCHAR(13) NOT NULL DEFAULT '0',
  name_seo VARCHAR(255) NOT NULL,
  cover_img_id bigINT NOT NULL,
  images_per_page SMALLINT NOT NULL DEFAULT '25',
  PRIMARY KEY (id)
);";
$TABLE[] = "CREATE TABLE gallery_comments (
  pid INT NOT NULL IDENTITY,
  append_edit SMALLINT DEFAULT '0',
  edit_time INT NULL,
  author_id INT NOT NULL DEFAULT '0',
  author_name VARCHAR(32) NULL,
  use_sig SMALLINT NOT NULL DEFAULT '0',
  use_emo SMALLINT NOT NULL DEFAULT '0',
  ip_address VARCHAR(16) NOT NULL DEFAULT '',
  post_date INT NOT NULL,
comment VARCHAR(MAX) NULL,
  approved SMALLINT NULL,
  img_id INT NOT NULL DEFAULT '0',
  edit_name VARCHAR(255) NULL,
  PRIMARY KEY (pid)
);";
$TABLE[] = "CREATE TABLE gallery_ecardlog (
  id bigINT NOT NULL IDENTITY,
  img_id bigINT NOT NULL DEFAULT '0',
  edate BIGINT NOT NULL DEFAULT '0',
  member_id INT NOT NULL DEFAULT '0',
  receiver_name VARCHAR(60) NOT NULL DEFAULT '',
  receiver_email VARCHAR(60) NOT NULL DEFAULT '',
  title VARCHAR(60) NOT NULL DEFAULT '',
msg VARCHAR(MAX) NULL,
  bg VARCHAR(7) NOT NULL DEFAULT '',
  font VARCHAR(7) NOT NULL DEFAULT '',
  border VARCHAR(7) NOT NULL DEFAULT '',
  PRIMARY KEY (id)
);";
$TABLE[] = "CREATE TABLE gallery_favorites (
  id bigINT NOT NULL IDENTITY,
  img_id bigINT NOT NULL DEFAULT '0',
  member_id INT NOT NULL DEFAULT '0',
  PRIMARY KEY (id)
);";
$TABLE[] = "CREATE TABLE gallery_form_fields (
  id BIGINT NOT NULL IDENTITY,
  name VARCHAR(60) NOT NULL DEFAULT '',
  description VARCHAR(120) NOT NULL DEFAULT '',
  type VARCHAR(10) NOT NULL DEFAULT '',
content VARCHAR(MAX) NULL,
  required SMALLINT NOT NULL DEFAULT '0',
  position BIGINT NOT NULL DEFAULT '0',
  deleteable SMALLINT NOT NULL DEFAULT '0',
  PRIMARY KEY (id)
);";
$TABLE[] = "CREATE TABLE gallery_image_views (
  views_img INT NOT NULL DEFAULT '0'
);";
$TABLE[] = "CREATE TABLE gallery_images (
  id bigINT NOT NULL IDENTITY,
  member_id INT NOT NULL DEFAULT '0',
  category_id SMALLINT NOT NULL DEFAULT '0',
  album_id bigINT NOT NULL DEFAULT '0',
  caption VARCHAR(255) NOT NULL,
description VARCHAR(MAX) NULL,
  directory VARCHAR(60) NOT NULL DEFAULT '',
  masked_file_name VARCHAR(255) NOT NULL,
  medium_file_name VARCHAR(255) NOT NULL,
  file_name VARCHAR(255) NOT NULL,
  file_size BIGINT NOT NULL DEFAULT '0',
  file_type VARCHAR(50) NOT NULL DEFAULT '',
  approved SMALLINT NOT NULL DEFAULT '0',
  thumbnail SMALLINT NOT NULL DEFAULT '0',
  views bigINT NOT NULL DEFAULT '0',
  comments BIGINT NOT NULL DEFAULT '0',
  comments_queued INT NOT NULL DEFAULT '0',
  idate BIGINT NOT NULL DEFAULT '0',
  ratings_total BIGINT NOT NULL DEFAULT '0',
  ratings_count BIGINT NOT NULL DEFAULT '0',
  rating SMALLINT NOT NULL DEFAULT '0',
  pinned SMALLINT NOT NULL DEFAULT '0',
  lastcomment BIGINT NOT NULL DEFAULT '0',
  media SMALLINT NOT NULL,
credit_info VARCHAR(MAX) NULL,
  copyright VARCHAR(120) NOT NULL DEFAULT '',
metadata VARCHAR(MAX) NULL,
  media_thumb VARCHAR(75) NOT NULL DEFAULT '0',
  caption_seo VARCHAR(255) NOT NULL,
image_notes VARCHAR(MAX) NOT NULL,
  PRIMARY KEY (id)
);";
$TABLE[] = "CREATE TABLE gallery_media_types (
  id BIGINT NOT NULL IDENTITY,
  icon VARCHAR(60) NOT NULL DEFAULT '',
  title VARCHAR(80) NOT NULL DEFAULT '',
  mime_type VARCHAR(50) NOT NULL DEFAULT '',
  extension VARCHAR(32) NOT NULL DEFAULT '',
  allowed SMALLINT NOT NULL DEFAULT '0',
  allow_user_thumb SMALLINT NOT NULL DEFAULT '0',
display_code VARCHAR(MAX) NULL,
  default_type SMALLINT NOT NULL DEFAULT '0',
  PRIMARY KEY (id)
);";
$TABLE[] = "CREATE TABLE gallery_ratings (
  id bigINT NOT NULL IDENTITY,
  member_id INT NOT NULL DEFAULT '0',
  img_id bigINT NOT NULL DEFAULT '0',
  rdate BIGINT NOT NULL DEFAULT '0',
  rate SMALLINT NOT NULL DEFAULT '0',
  PRIMARY KEY (id)
);";
$TABLE[] = "CREATE TABLE gallery_subscriptions (
  sub_id INT NOT NULL IDENTITY,
  sub_mid INT NOT NULL DEFAULT '0',
  sub_type VARCHAR(25) NOT NULL DEFAULT 'image',
  sub_toid INT NOT NULL DEFAULT '0',
  sub_added VARCHAR(13) NOT NULL DEFAULT '0',
  sub_last VARCHAR(13) NOT NULL DEFAULT '0',
  PRIMARY KEY (sub_id)
);";

$TABLE[] = "CREATE INDEX member_id ON gallery_albums ( member_id );";
$TABLE[] = "CREATE INDEX public_album ON gallery_albums ( public_album );";
$TABLE[] = "CREATE INDEX category_id ON gallery_albums ( category_id );";
$TABLE[] = "CREATE INDEX last_pic_date ON gallery_albums ( last_pic_date );";
$TABLE[] = "CREATE INDEX member_id_2 ON gallery_albums ( member_id,name );";
$TABLE[] = "CREATE INDEX file_name ON gallery_bandwidth ( file_name );";
$TABLE[] = "CREATE INDEX member_id ON gallery_bandwidth ( member_id );";
$TABLE[] = "CREATE INDEX bdate ON gallery_bandwidth ( bdate );";
$TABLE[] = "CREATE INDEX parent ON gallery_categories ( parent );";
$TABLE[] = "CREATE INDEX img_id ON gallery_comments ( img_id,author_id );";
$TABLE[] = "CREATE INDEX author_id ON gallery_comments ( author_id );";
$TABLE[] = "CREATE INDEX post_date ON gallery_comments ( post_date );";
$TABLE[] = "CREATE INDEX img_id_2 ON gallery_comments ( img_id,pid );";
$TABLE[] = "CREATE INDEX member_id ON gallery_favorites ( member_id );";
$TABLE[] = "CREATE INDEX category_id ON gallery_images ( category_id );";
$TABLE[] = "CREATE INDEX album_id ON gallery_images ( album_id );";
$TABLE[] = "CREATE INDEX approved ON gallery_images ( approved );";
$TABLE[] = "CREATE INDEX member_id ON gallery_images ( member_id );";
$TABLE[] = "CREATE INDEX album_id_2 ON gallery_images ( album_id,approved,idate );";
$TABLE[] = "CREATE INDEX member_id ON gallery_ratings ( member_id );";
$TABLE[] = "CREATE INDEX img_id ON gallery_ratings ( img_id );";
$TABLE[] = "CREATE INDEX sub_mid ON gallery_subscriptions ( sub_mid );";

$TABLE[] = "ALTER TABLE members ADD gallery_perms VARCHAR(10) DEFAULT '1:1:1' NOT NULL";

$TABLE[] = "ALTER TABLE groups ADD g_max_diskspace INT default '0' NOT NULL";
$TABLE[] = "ALTER TABLE groups ADD g_max_upload INT default '0' NOT NULL";
$TABLE[] = "ALTER TABLE groups ADD g_max_transfer INT default '0' NOT NULL";
$TABLE[] = "ALTER TABLE groups ADD g_max_views INT default '0' NOT NULL";
$TABLE[] = "ALTER TABLE groups ADD g_create_albums TINYINT default '0' NOT NULL";
$TABLE[] = "ALTER TABLE groups ADD g_album_limit INT default '0' NOT NULL";
$TABLE[] = "ALTER TABLE groups ADD g_img_album_limit INT default '0' NOT NULL";
$TABLE[] = "ALTER TABLE groups ADD g_slideshows TINYINT default '0' NOT NULL";
$TABLE[] = "ALTER TABLE groups ADD g_favorites TINYINT default '0' NOT NULL";
$TABLE[] = "ALTER TABLE groups ADD g_comment TINYINT default '0' NOT NULL";
$TABLE[] = "ALTER TABLE groups ADD g_rate TINYINT default '0' NOT NULL";
$TABLE[] = "ALTER TABLE groups ADD g_ecard TINYINT default '0' NOT NULL";
$TABLE[] = "ALTER TABLE groups ADD g_edit_own TINYINT default '0' NOT NULL";
$TABLE[] = "ALTER TABLE groups ADD g_del_own TINYINT default '0' NOT NULL";
$TABLE[] = "ALTER TABLE groups ADD g_move_own TINYINT default '0' NOT NULL";
$TABLE[] = "ALTER TABLE groups ADD g_mod_albums TINYINT default '0' NOT NULL";
$TABLE[] = "ALTER TABLE groups ADD g_img_local TINYINT default '0' NOT NULL";
$TABLE[] = "ALTER TABLE groups ADD g_movies TINYINT default '0' NOT NULL";
$TABLE[] = "ALTER TABLE groups ADD g_movie_size INT default '0' NOT NULL";
$TABLE[] = "ALTER TABLE groups ADD g_multi_file_limit INT  DEFAULT 0";
$TABLE[] = "ALTER TABLE groups ADD g_zip_upload INT  DEFAULT 0";
$TABLE[] = "ALTER TABLE groups ADD g_can_search_gallery INT DEfAULT '0' NOT NULL";
$TABLE[] = "ALTER TABLE groups ADD g_gallery_use INT NOT NULL DEFAULT '1';";
$TABLE[] = "ALTER TABLE groups ADD g_album_private INT NOT NULL DEFAULT '1';";
$TABLE[] = "ALTER TABLE groups ADD g_gallery_cat_cover INT NOT NULL default '0';";
$TABLE[] = "ALTER TABLE groups ADD g_max_notes INT NOT NULL default '5';";
