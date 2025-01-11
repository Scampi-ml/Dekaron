<?php

# 2.1.0 beta 1

$DB  = ipsRegistry::DB();
$PRE = ipsRegistry::dbFunctions()->getPrefix();


$DB->dropTable( 'blog_categories' );

$SQL[] = "CREATE TABLE blog_categories (
  category_id BIGINT NOT NULL IDENTITY,
  category_blog_id BIGINT NOT NULL DEFAULT '0',
  category_parent BIGINT NOT NULL DEFAULT '0',
  category_title VARCHAR(255) NOT NULL DEFAULT '',
  category_title_seo VARCHAR(255) NOT NULL DEFAULT '',
  category_position INT NOT NULL DEFAULT '0',
  PRIMARY KEY (category_id)
);";
$SQL[] = "CREATE TABLE blog_category_mapping (
  map_category_id BIGINT NOT NULL,
  map_entry_id BIGINT NOT NULL,
  map_blog_id BIGINT NOT NULL,
  map_is_draft INT NOT NULL DEFAULT '0',
  map_is_private INT NOT NULL DEFAULT '0'
);";

$SQL[] = "CREATE INDEX category_blog_id ON blog_categories ( category_blog_id );";
$SQL[] = "CREATE INDEX member_cat_meow ON blog_categories ( category_id,category_blog_id );";
$SQL[] = "CREATE INDEX cap_map_lookup ON blog_category_mapping ( map_category_id,map_blog_id );";
$SQL[] = "CREATE INDEX map_entry_id ON blog_category_mapping ( map_entry_id );";

$SQL[] = "CREATE TABLE blog_editors_map (
  editor_member_id BIGINT NOT NULL DEFAULT '0',
  editor_blog_id BIGINT NOT NULL DEFAULT '0',
  editor_added BIGINT NOT NULL DEFAULT '0'
);";

$SQL[] = "CREATE INDEX editor_map ON blog_editors_map ( editor_member_id,editor_blog_id );";

$SQL[] = "CREATE TABLE blog_this (
  bt_id INT NOT NULL IDENTITY,
  bt_entry_id INT NOT NULL DEFAULT '0',
  bt_app VARCHAR(255) NOT NULL DEFAULT '',
  bt_id1 INT NOT NULL DEFAULT '0',
  bt_id2 INT NOT NULL DEFAULT '0',
  PRIMARY KEY (bt_id)
);";

$SQL[] = "CREATE INDEX lookup ON blog_this ( bt_app,bt_id1,bt_id2 );";
$SQL[] = "CREATE INDEX entry_id ON blog_this ( bt_entry_id );";

$SQL[] = "CREATE TABLE blog_rssimport (
  rss_id INT NOT NULL IDENTITY,
  rss_blog_id INT NOT NULL DEFAULT '0',
  rss_url VARCHAR(255) NOT NULL DEFAULT '',
  rss_per_go INT NOT NULL DEFAULT '10',
  rss_auth_user VARCHAR(255) NOT NULL DEFAULT '',
  rss_auth_pass VARCHAR(255) NOT NULL DEFAULT '',
  rss_last_import INT NOT NULL DEFAULT '0',
  rss_in_progress INT NOT NULL DEFAULT '0',
  rss_count INT NOT NULL DEFAULT '0',
  rss_tags TEXT NULL,
  rss_cats TEXT NULL,
  PRIMARY KEY (rss_id)
);";

$SQL[] = "CREATE INDEX blog_time ON blog_rssimport ( rss_blog_id,rss_last_import );";
$SQL[] = "CREATE INDEX rss_blog_id ON blog_rssimport ( rss_blog_id );";
$SQL[] = "CREATE INDEX rss_last_import ON blog_rssimport ( rss_last_import );";

if ( ! $DB->checkForTable( 'core_rss_imported' ) )
{
	$SQL[] = "CREATE TABLE core_rss_imported (
	rss_guid			CHAR(32) NOT NULL,
	rss_foreign_id 		INT NOT NULL default '0',
	rss_foreign_key		VARCHAR(100) NOT NULL default '',
	PRIMARY KEY (rss_guid)
);";
}

$SQL[] = "ALTER TABLE blog_blogs ADD blog_seo_name varchar(255) default null;";
$SQL[] = "ALTER TABLE blog_blogs ADD blog_categories TEXT null;";
$SQL[] = "ALTER TABLE blog_blogs ADD blog_editors INT;";
$SQL[] = "ALTER TABLE blog_blogs ADD blog_groupblog_ids VARCHAR(255) NOT NULL default '';";
$SQL[] = "ALTER TABLE blog_blogs ADD blog_groupblog_name VARCHAR(255) NOT NULL default '';";
$SQL[] = "ALTER TABLE blog_blogs ADD blog_groupblog INT NOT NULL DEFAULT '0';";
$SQL[] = "ALTER TABLE blog_blogs ADD blog_last_edate INT NOT NULL default '0';";
$SQL[] = "ALTER TABLE blog_blogs ADD blog_lentry_banish INT NOT NULL DEFAULT '0';";
$SQL[] = "ALTER TABLE blog_blogs ADD blog_last_udate INT NOT NULL default '0';";
$SQL[] = "ALTER TABLE blog_blogs ADD blog_owner_only INT NOT NULL default '0';";
$SQL[] = "ALTER TABLE blog_blogs ADD blog_authorized_users VARCHAR(255) NULL;";
$SQL[] = "CREATE INDEX blog_lentry_banish ON blog_blogs (blog_lentry_banish);";
$SQL[] = "CREATE INDEX blog_groupblog ON blog_blogs (blog_groupblog);";
$SQL[] = "CREATE INDEX blog_grabber ON blog_blogs (blog_disabled, blog_type, blog_view_level);";
$SQL[] = "CREATE INDEX blog_view_level ON blog_blogs (blog_view_level);";
$SQL[] = "CREATE INDEX blog_pinned ON blog_blogs (blog_pinned);";
$SQL[] = "CREATE INDEX blog_last_edate ON blog_blogs (blog_last_edate);";
$SQL[] = "CREATE INDEX as_list_view ON blog_blogs (blog_pinned, blog_disabled, blog_allowguests, blog_last_edate);";
$SQL[] = "CREATE INDEX auth_user ON blog_blogs (blog_owner_only, blog_authorized_users);";


$SQL[] = "ALTER TABLE blog_lastinfo ADD blog_tag_cloud text null;";
$SQL[] = "ALTER TABLE blog_lastinfo ADD blog_cblocks text null;";
$SQL[] = "ALTER TABLE blog_lastinfo ADD blog_last_comment_20 text null;";
$SQL[] = "ALTER TABLE blog_lastinfo ADD blog_cblocks_available text null;";

$SQL[] = "UPDATE blog_blogs SET [{$PRE}blog_blogs].blog_last_edate=[{$PRE}blog_lastinfo].blog_last_date
		 	FROM [{$PRE}blog_blogs], [{$PRE}blog_lastinfo]
		 	WHERE [{$PRE}blog_blogs].blog_id=[{$PRE}blog_lastinfo].blog_id;";

$SQL[] = "UPDATE blog_blogs SET [{$PRE}blog_blogs].blog_last_udate=[{$PRE}blog_lastinfo].blog_last_update
		 	FROM [{$PRE}blog_blogs], [{$PRE}blog_lastinfo]
		 	WHERE [{$PRE}blog_blogs].blog_id=[{$PRE}blog_lastinfo].blog_id;";

$SQL[] = "UPDATE blog_blogs SET [{$PRE}blog_blogs].blog_owner_only=[{$PRE}permission_index].owner_only, [{$PRE}blog_blogs].blog_authorized_users=[{$PRE}permission_index].authorized_users
		 	FROM [{$PRE}blog_blogs], [{$PRE}permission_index]
		 	WHERE [{$PRE}permission_index].app='blog' AND [{$PRE}blog_blogs].blog_id=[{$PRE}permission_index].perm_type_id;";



if ( $DB->checkForField( 'entry_category', 'blog_entries' ) )
{
	$DB->dropField( 'blog_entries', 'entry_category' );
}

$SQL[] = "ALTER TABLE blog_entries ADD entry_category TEXT null;";
$SQL[] = "ALTER TABLE blog_entries ADD entry_name_seo varchar(255) NOT NULL default '';";
$SQL[] = "ALTER TABLE blog_entries ADD entry_tag_cache TEXT null;";
$SQL[] = "ALTER TABLE blog_entries ADD entry_short TEXT null;";
$SQL[] = "ALTER TABLE blog_entries ADD entry_rating_total INT default '0';";
$SQL[] = "ALTER TABLE blog_entries ADD entry_rating_count INT default '0';";
$SQL[] = "ALTER TABLE blog_entries ADD entry_rss_import	INT NOT NULL default '0';";
$SQL[] = "ALTER TABLE blog_entries ADD entry_banish	INT NOT NULL default '0';";
$SQL[] = "CREATE INDEX entry_banish ON blog_entries (entry_banish);";
$SQL[] = "CREATE INDEX entry_rss_import ON blog_entries (entry_rss_import);";
$SQL[] = "CREATE INDEX entry_status ON blog_entries (entry_status);";
$SQL[] = "CREATE INDEX entry_date ON blog_entries ( entry_date );";

$SQL[] = "CREATE INDEX entry_comment ON blog_comments ( comment_id, entry_id );";

$DB->dropField( 'members', 'has_blog' );
$DB->addField( 'members', 'has_blog', 'text', 'null' );
$DB->update( 'members', array( 'has_blog' => 'recache' ) );

if ( ! $DB->checkForField( 'tag_hidden', 'tags_index' ) )
{
	$SQL[] = "ALTER TABLE tags_index ADD tag_hidden INT NOT NULL default '0';";
	$SQL[] = "CREATE INDEX tag_grab ON tags_index (app, type, type_id, type_2, type_id_2, tag_hidden);";
}

$SQL[] = "ALTER TABLE blog_ratings ADD entry_id int default '0';";
$SQL[] = "CREATE INDEX entryrating_blog_id ON blog_ratings (member_id, blog_id, entry_id);";

$SQL[] = "UPDATE blog_default_cblocks SET cbdef_name='Tags', cbdef_function='get_my_tags' where cbdef_function='get_my_categories';";
$SQL[] = "INSERT INTO blog_default_cblocks (cbdef_name, cbdef_function, cbdef_default, cbdef_order, cbdef_locked, cbdef_enabled) VALUES ('Categories', 'get_my_categories', 1, 11, 0, 1 );";

$SQL[] = "DELETE from core_sys_conf_settings WHERE conf_key='blog_default_view';";
$SQL[] = "DELETE from core_sys_conf_settings WHERE conf_key='blog_allow_viewmode';";
$SQL[] = "DELETE from core_sys_conf_settings WHERE conf_key='blog_lastread_cutoff';";
$SQL[] = "DELETE from core_sys_conf_settings WHERE conf_key='blog_resize_img_percent';";
$SQL[] = "DELETE from core_sys_conf_settings WHERE conf_key='blog_resize_linked_img';";
$SQL[] = "DELETE from core_sys_conf_settings WHERE conf_key='blog_allow_draft';";
$SQL[] = "DELETE from core_sys_conf_settings WHERE conf_key='blog_show_img_upload';";
$SQL[] = "DELETE from core_sys_conf_settings WHERE conf_key='blog_thumb';";
$SQL[] = "DELETE from core_sys_conf_settings WHERE conf_key='blog_guest_captcha';";
$SQL[] = "DELETE from core_sys_conf_settings WHERE conf_key='blog_showstats';";

$SQL[] = "ALTER TABLE blog_tracker ADD entry_id int NOT NULL DEFAULT '0';";
$SQL[] = "DROP INDEX blog_tracker.tracker_blogentry;";
$SQL[] = "CREATE INDEX tracker_blogentry ON blog_tracker (blog_id,member_id,entry_id);";

$SQL[] = "ALTER TABLE blog_tracker ADD auto_comments INT NOT NULL default '0';";
$SQL[] = "CREATE INDEX auto_comments ON blog_tracker (auto_comments);";

$SQL[] = "DELETE FROM blog_tracker_queue;";

$SQL[] = "DELETE FROM core_sys_module WHERE sys_module_application='blog' AND sys_module_key='groups';";






