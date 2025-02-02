<?php

$SQL[] = "CREATE TABLE blog_trackback(
	trackback_id			int not null identity,
	entry_id				int not null,
	trackback_url			varchar(255) not null,
	trackback_title			varchar(255),
	trackback_excerpt		varchar(255),
	trackback_blog_name		varchar(255),
	trackback_date			int,
PRIMARY KEY(trackback_id)
)";
$SQL[] = "CREATE INDEX entry_id ON blog_trackback(entry_id)";

$SQL[] = "ALTER TABLE blog_entries ADD entry_trackbacks smallint not null default 0";
$SQL[] = "ALTER TABLE blog_entries ADD entry_sent_trackbacks text null";

$SQL[] = "INSERT INTO skin_macro (macro_value, macro_replace, macro_can_remove, macro_set) VALUES ('P_SENDTB', '<img src=''style_images/<#IMG_DIR#>/p_sendtb.gif'' border=''0''  alt=''Send Trackback'' />', 1, 1)";
