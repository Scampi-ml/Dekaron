<?php

$SQL[] = "ALTER TABLE groups ADD g_blog_allowprivclub TINYINT NOT NULL DEFAULT 0";
$SQL[] = "ALTER TABLE groups ADD g_blog_alloweditors TINYINT NOT NULL DEFAULT 0";

$SQL[] = "ALTER TABLE blog_entries ADD entry_author_id INT NOT NULL DEFAULT 0";
$SQL[] = "ALTER TABLE blog_entries ADD entry_author_name VARCHAR(255) NOT NULL DEFAULT ''";
$SQL[] = "ALTER TABLE blog_entries ADD category_id int not null default 0";
$SQL[] = "ALTER TABLE blog_entries ADD entry_use_emo tinyint not null default 0";
$SQL[] = "CREATE INDEX entry_category_id ON blog_entries(blog_id, category_id)";

if ($sql = $this->ipsclass->DB->getsql_dropdefault_constraint("blog_blogs", "blog_num_entries") ) {
	$SQL[] = $sql;
}
$SQL[] = "ALTER TABLE blog_blogs DROP COLUMN blog_num_entries";
if ($sql = $this->ipsclass->DB->getsql_dropdefault_constraint("blog_blogs", "blog_num_drafts") ) {
	$SQL[] = $sql;
}
$SQL[] = "ALTER TABLE blog_blogs DROP COLUMN blog_num_drafts";
if ($sql = $this->ipsclass->DB->getsql_dropdefault_constraint("blog_blogs", "blog_num_comments") ) {
	$SQL[] = $sql;
}
$SQL[] = "ALTER TABLE blog_blogs DROP COLUMN blog_num_comments";
if ($sql = $this->ipsclass->DB->getsql_dropdefault_constraint("blog_blogs", "blog_last_entry") ) {
	$SQL[] = $sql;
}
$SQL[] = "ALTER TABLE blog_blogs DROP COLUMN blog_last_entry";
if ($sql = $this->ipsclass->DB->getsql_dropdefault_constraint("blog_blogs", "blog_last_entryname") ) {
	$SQL[] = $sql;
}
$SQL[] = "ALTER TABLE blog_blogs DROP COLUMN blog_last_entryname";
if ($sql = $this->ipsclass->DB->getsql_dropdefault_constraint("blog_blogs", "blog_last_date") ) {
	$SQL[] = $sql;
}
$SQL[] = "ALTER TABLE blog_blogs DROP COLUMN blog_last_date";
if ($sql = $this->ipsclass->DB->getsql_dropdefault_constraint("blog_blogs", "blog_last_comment") ) {
	$SQL[] = $sql;
}
$SQL[] = "ALTER TABLE blog_blogs DROP COLUMN blog_last_comment";
if ($sql = $this->ipsclass->DB->getsql_dropdefault_constraint("blog_blogs", "blog_last_comment_date") ) {
	$SQL[] = $sql;
}
$SQL[] = "ALTER TABLE blog_blogs DROP COLUMN blog_last_comment_date";
if ($sql = $this->ipsclass->DB->getsql_dropdefault_constraint("blog_blogs", "blog_last_comment_entry") ) {
	$SQL[] = $sql;
}
$SQL[] = "ALTER TABLE blog_blogs DROP COLUMN blog_last_comment_entry";
if ($sql = $this->ipsclass->DB->getsql_dropdefault_constraint("blog_blogs", "blog_last_comment_entryname") ) {
	$SQL[] = $sql;
}
$SQL[] = "ALTER TABLE blog_blogs DROP COLUMN blog_last_comment_entryname";
if ($sql = $this->ipsclass->DB->getsql_dropdefault_constraint("blog_blogs", "blog_last_comment_name") ) {
	$SQL[] = $sql;
}
$SQL[] = "ALTER TABLE blog_blogs DROP COLUMN blog_last_comment_name";
if ($sql = $this->ipsclass->DB->getsql_dropdefault_constraint("blog_blogs", "blog_last_comment_mid") ) {
	$SQL[] = $sql;
}
$SQL[] = "ALTER TABLE blog_blogs DROP COLUMN blog_last_comment_mid";

$SQL[] = "ALTER TABLE blog_moderators ADD moderate_can_editcblocks tinyint default 0";
$SQL[] = "ALTER TABLE blog_moderators ADD moderate_can_editaboutme tinyint default 0";

$SQL[] = "CREATE TABLE blog_categories(
  category_id int not null identity,
  blog_id int not null default 0,
  category_name varchar(255) not null,
  category_default tinyint not null default 1,
  category_type varchar(12) not null default '',
PRIMARY KEY(category_id))";
$SQL[] = "CREATE INDEX category_blog ON blog_categories(blog_id, category_type)";

$SQL[] = "CREATE TABLE blog_lastinfo(
  blog_id int not null,
  level varchar(15) not null,
  blog_num_entries 				int null default 0,
  blog_num_drafts				int null default 0,
  blog_num_comments				int null default 0,
  blog_last_entry				int null,
  blog_last_entryname			varchar(250) null,
  blog_last_date				int null,
  blog_last_comment				int null,
  blog_last_comment_date		int null,
  blog_last_comment_entry		int null,
  blog_last_comment_entryname	varchar(250) null,
  blog_last_comment_name		varchar(255) null,
  blog_last_comment_mid			int null,
  blog_last_update				int default 0,
PRIMARY KEY(blog_id, level)
)";

$SQL[] = "CREATE TABLE blog_tracker (
  tracker_id int NOT NULL IDENTITY,
  blog_id int NOT NULL,
  member_id int NOT NULL,
PRIMARY KEY(tracker_id)
)";
$SQL[] = "CREATE INDEX tracker_blogentry ON blog_tracker(blog_id, member_id)";

$SQL[] = "CREATE TABLE blog_tracker_queue (
  tq_id int NOT NULL IDENTITY,
  blog_id int NOT NULL,
  entry_id int NOT NULL,
  tq_to varchar(255) NOT NULL default '',
  tq_subject text NOT NULL,
  tq_content text NOT NULL,
  PRIMARY KEY  (tq_id)
)";
$SQL[] = "CREATE INDEX trackqueue_blogentry ON blog_tracker_queue(blog_id, entry_id)";

$SQL[] = "INSERT INTO blog_default_cblocks(cbdef_name, cbdef_function, cbdef_default, cbdef_order, cbdef_locked, cbdef_enabled)
VALUES('Active Users','get_active_users', 0, 8, 0, 1)";
$SQL[] = "INSERT INTO blog_default_cblocks(cbdef_name, cbdef_function, cbdef_default, cbdef_order, cbdef_locked, cbdef_enabled)
VALUES('Categories','get_my_categories', 0, 9, 0, 1)";
$SQL[] = "INSERT INTO blog_default_cblocks(cbdef_name, cbdef_function, cbdef_default, cbdef_order, cbdef_locked, cbdef_enabled)
VALUES('My Search','get_my_search', 0, 10, 0, 1)";

$SQL[] ="INSERT INTO custom_bbcode (bbcode_title, bbcode_desc, bbcode_tag, bbcode_replace, bbcode_useoption, bbcode_example) VALUES ('Extract Blog Entry', 'This will allow users to define an extract for an entry. Only this piece of the entry will be displayed on the main blog page and will show up in the RSS feed.', 'extract', '<!--blog.extract.start-->{content}<!--blog.extract.end-->', 0, '[extract]This is an example![/extract]')";
$SQL[] ="INSERT INTO custom_bbcode (bbcode_title, bbcode_desc, bbcode_tag, bbcode_replace, bbcode_useoption, bbcode_example) VALUES ('Blog Link', 'This tag provides an easy way to link to a blog.', 'blog', '<a href=''index.php?autocom=blog&amp;blogid={option}''>{content}</a>', 1, '[blog=100]Click me![/blog]')";
$SQL[] ="INSERT INTO custom_bbcode (bbcode_title, bbcode_desc, bbcode_tag, bbcode_replace, bbcode_useoption, bbcode_example) VALUES ('Blog Entry Link', 'This tag provides an easy way to link to a blog entry.', 'entry', '<a href=''index.php?autocom=blog&amp;cmd=showentry&amp;eid={option}''>{content}</a>', 1, '[entry=100]Click me![/entry]')";

$SQL[] ="DELETE FROM conf_settings WHERE conf_key='blog_allow_stripheader'";
