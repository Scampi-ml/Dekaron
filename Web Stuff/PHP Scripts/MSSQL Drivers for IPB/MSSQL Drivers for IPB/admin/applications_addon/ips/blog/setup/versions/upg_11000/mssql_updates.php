<?php

$SQL[] = "CREATE TABLE blog_moderators (
	moderate_id	int not null identity,
	moderate_type varchar(10) not null,
	moderate_mg_id int not null,
	moderate_can_edit_comments tinyint not null default 0,
	moderate_can_edit_entries tinyint not null default 0,
	moderate_can_del_comments tinyint not null default 0,
	moderate_can_del_entries tinyint not null default 0,
	moderate_can_lock tinyint not null default 0,
	moderate_can_publish tinyint not null default 0,
	moderate_can_view_draft tinyint not null default 0,
	moderate_can_view_private tinyint not null default 0,
	moderate_can_warn tinyint not null default 0,
	moderate_can_pin tinyint not null default 0,
	moderate_can_disable tinyint not null default 0,
PRIMARY KEY (moderate_id)
)";

$SQL[] = "CREATE TABLE blog_ratings (
  rating_id int NOT NULL identity,
  member_id int NOT NULL,
  blog_id int NOT NULL,
  rating_date int NOT NULL,
  rating smallint NOT NULL default 0,
PRIMARY KEY (rating_id)
)";
$SQL[] = "CREATE INDEX rating_blog_id ON blog_ratings (blog_id, member_id)";

$SQL[] = "ALTER TABLE blog_blogs ADD blog_rating_total int default 0";
$SQL[] = "ALTER TABLE blog_blogs ADD blog_rating_count int default 0";
$SQL[] = "ALTER TABLE blog_blogs ADD blog_last_delete int default 0";

$SQL[] = "CREATE TABLE blog_read (
  blog_id int NOT NULL,
  member_id int NOT NULL,
  last_read int NOT NULL default 0,
  unread_count smallint NOT NULL default 0,
  last_count int NOT NULL default 0,
  entries_read text NULL,
PRIMARY KEY (blog_id, member_id)
)";

$SQL[] = "ALTER TABLE blog_entries ADD entry_last_update int default 0";
$SQL[] = "ALTER TABLE blog_entries ADD entry_gallery_album int default 0";
$SQL[] = "CREATE INDEX entry_last_update ON blog_entries (blog_id, entry_status, entry_last_update)";
$SQL[] = "UPDATE blog_entries
SET entry_last_update = entry_date
WHERE entry_date>entry_last_comment_date or entry_last_comment_date is null";
$SQL[] = "UPDATE blog_entries
SET entry_last_update = entry_last_comment_date
WHERE entry_last_comment_date>=entry_date and entry_last_comment_date is not null";

$SQL[] = "ALTER TABLE blog_cblocks ADD cblock_position VARCHAR(10) NOT NULL default 'right'";

$SQL[] = "INSERT INTO skin_macro (macro_value, macro_replace, macro_can_remove, macro_set) VALUES ('B_NONEW', '<img src=''style_images/<#IMG_DIR#>/bb_nonew.gif'' border=''0'' alt=''Hosted Blog'' />', 1, 1)";

$SQL[] = "INSERT INTO blog_default_cblocks(cbdef_name, cbdef_function, cbdef_default, cbdef_order, cbdef_locked, cbdef_enabled)
VALUES('Last 10 Comments','get_last_comments', 1, 5, 0, 1)";
