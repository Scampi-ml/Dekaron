<?php

$SQL[] = "CREATE TABLE blog_updatepings(
  ping_id int not null identity,
  ping_active tinyint not null default 0,
  ping_time int not null default 0,
  ping_tries tinyint not null default 0,
  blog_id int not null,
  entry_id int not null,
  ping_service varchar(30) not null default '',
PRIMARY KEY(ping_id))";
$SQL[] = "CREATE INDEX blog_activetime ON blog_updatepings(ping_active, ping_time)";
$SQL[] = "CREATE INDEX blog_blogentry ON blog_updatepings(blog_id, entry_id)";

$SQL[] = "CREATE TABLE blog_views (
blog_id int not null
)";

$SQL[] = "CREATE TABLE blog_trackback_spamlogs(
	trackback_id			int not null identity,
	blog_id					int null default 0,
	entry_id				int not null,
	ip_address				varchar(16) null,
	trackback_url			varchar(255) not null,
	trackback_title			varchar(255) null,
	trackback_excerpt		varchar(255) null,
	trackback_blog_name		varchar(255) null,
	trackback_date			int null,
	trackback_queued		tinyint not null default 0,
PRIMARY KEY(trackback_id)
)";

$SQL[] = "ALTER TABLE blog_moderators ADD moderate_can_del_trackback TINYINT DEFAULT 0";
$SQL[] = "ALTER TABLE blog_trackback ADD blog_id INT DEFAULT 0";
$SQL[] = "ALTER TABLE blog_trackback ADD ip_address varchar(16)";
$SQL[] = "ALTER TABLE blog_trackback ADD trackback_queued TINYINT DEFAULT 0";

$SQL[] = "INSERT INTO attachments( attach_file, attach_location, attach_thumb_location, attach_hits, attach_date, attach_post_key, attach_member_id,
                                       attach_filesize, attach_thumb_width, attach_thumb_height, attach_is_image, attach_ext, attach_rel_id,
                                       attach_rel_module )
          SELECT attach_file, attach_location, attach_thumb_location, attach_hits, attach_date, attach_post_key, attach_member_id, 
                 attach_filesize, attach_thumb_width, attach_thumb_height, attach_is_image, attach_ext,
                 case when attach_entry_id > 0 then attach_entry_id else attach_cbcus_id end,
                 case when attach_entry_id > 0 then 'blogentry' else 'blogcblock' end
          FROM blog_attachments;";
$SQL[] = "DROP TABLE blog_attachments";

if ($dropsql = $this->install->ipsclass->DB->getsql_dropdefault_constraint("blog_moderators", "moderate_can_editaboutme") ) {
	$SQL[] = $dropsql;
}
$SQL[] = "ALTER TABLE blog_moderators DROP COLUMN moderate_can_editaboutme";

$SQL[] = "DELETE FROM conf_settings WHERE conf_key='blog_allow_aboutme'";
         