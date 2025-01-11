<?php
/*
+--------------------------------------------------------------------------
|   IP.Board v3.1.4
|   ========================================
|   by Matthew Mecham
|   (c) 2001 - 2004 Invision Power Services
|   http://www.invisionpower.com
|   ========================================
|   Web: http://www.invisionboard.com
|   Email: matt@invisionpower.com
|   Licence Info: http://www.invisionboard.com/?license
+---------------------------------------------------------------------------
*/

# Nothing of interest!

// $SQL[] = "";

$SQL[] = "CREATE TABLE components (
  com_id int NOT NULL identity,
  com_title varchar(255) NOT NULL default '',
  com_author varchar(255) NOT NULL default '',
  com_url varchar(255) NOT NULL default '',
  com_version varchar(255) NOT NULL default '',
  com_date_added int NOT NULL default 0,
  com_menu_data text NULL,
  com_enabled tinyint NOT NULL default 1,
  com_safemode tinyint NOT NULL default 1,
  com_section varchar(255) NOT NULL default '',
  com_filename varchar(255) NOT NULL default '',
  com_description varchar(255) NOT NULL default '',
  com_url_title varchar(255) NOT NULL default '',
  com_url_uri varchar(255) NOT NULL default '',
  com_position smallint NOT NULL default 10,
  PRIMARY KEY (com_id)
)";


$SQL[] = "CREATE TABLE topic_views (
  views_tid int NOT NULL default 0
)";


$SQL[] = "CREATE TABLE topic_ratings (
  rating_id int NOT NULL identity,
  rating_tid int NOT NULL default 0,
  rating_member_id int NOT NULL default 0,
  rating_value smallint NOT NULL default 0,
  rating_ip_address varchar(16) NOT NULL default '',
  PRIMARY KEY  (rating_id)
)";
$SQL[] = "CREATE INDEX rating_tid ON topic_ratings (rating_tid,rating_member_id)";

$SQL[] = "CREATE TABLE topic_markers (
  marker_member_id int NOT NULL default 0,
  marker_forum_id int NOT NULL default 0,
  marker_last_update int NOT NULL default 0,
  marker_unread smallint NOT NULL default 0,
  marker_topics_read text NULL,
  marker_last_cleared int NOT NULL default 0,
PRIMARY KEY (marker_forum_id,marker_member_id)
)";
$SQL[] = "CREATE INDEX marker_member_id ON topic_markers (marker_member_id)";

$SQL[] = "CREATE TABLE rss_import (
  rss_import_id int NOT NULL identity,
  rss_import_enabled tinyint NOT NULL default 0,
  rss_import_title varchar(255) NOT NULL default '',
  rss_import_url varchar(255) NOT NULL default '',
  rss_import_forum_id int NOT NULL default 0,
  rss_import_mid int NOT NULL default 0,
  rss_import_pergo smallint NOT NULL default 0,
  rss_import_time smallint NOT NULL default 0,
  rss_import_last_import int NOT NULL default 0,
  rss_import_showlink varchar(255) NOT NULL default '0',
  rss_import_topic_open tinyint NOT NULL default 0,
  rss_import_topic_hide tinyint NOT NULL default 0,
  rss_import_inc_pcount tinyint NOT NULL default 0,
  rss_import_topic_pre varchar(50) NOT NULL default '',
  rss_import_charset varchar(200) NOT NULL default '',
  PRIMARY KEY  (rss_import_id)
)";

$SQL[] = "CREATE TABLE rss_imported (
  rss_imported_guid char(32) NOT NULL default '0',
  rss_imported_tid int NOT NULL default 0,
  rss_imported_impid int NOT NULL default 0,
  PRIMARY KEY  (rss_imported_guid)
)";
$SQL[] = "CREATE INDEX rss_imported_impid ON rss_imported (rss_imported_impid)";

$SQL[] = "CREATE TABLE rss_export (
  rss_export_id int NOT NULL identity,
  rss_export_enabled tinyint NOT NULL default 0,
  rss_export_title varchar(255) NOT NULL default '',
  rss_export_image varchar(255) NOT NULL default '',
  rss_export_forums text NULL,
  rss_export_include_post tinyint NOT NULL default 0,
  rss_export_sort varchar(4) NOT NULL default 'DESC',
  rss_export_order varchar(20) NOT NULL default 'start_date',
  rss_export_count smallint NOT NULL default 0,
  rss_export_cache_time smallint NOT NULL default 30,
  rss_export_cache_last int NOT NULL default 0,
  rss_export_cache_content text NULL,
  PRIMARY KEY  (rss_export_id)
)";

$SQL[] = "CREATE TABLE cal_events (
  event_id int NOT NULL identity,
  event_calendar_id int NOT NULL default 0,
  event_member_id int NOT NULL default 0,
  event_content text NULL,
  event_title varchar(255) NOT NULL default '',
  event_smilies tinyint NOT NULL default 0,
  event_perms text NOT NULL,
  event_private tinyint NOT NULL default 0,
  event_approved tinyint NOT NULL default 0,
  event_unixstamp int NOT NULL default 0,
  event_recurring smallint NOT NULL default 0,
  event_tz smallint NOT NULL default 0,
  event_unix_from int NOT NULL default 0,
  event_unix_to int NOT NULL default 0,
  PRIMARY KEY (event_id)
)";
$SQL[] = "CREATE INDEX daterange ON cal_events(event_calendar_id,event_approved,event_unix_from,event_unix_to)";
$SQL[] = "CREATE INDEX approved ON cal_events(event_calendar_id,event_approved)";

$SQL[] = "CREATE TABLE members_partial (
  partial_id int NOT NULL identity,
  partial_member_id int NOT NULL default 0,
  partial_date int NOT NULL default 0,
  PRIMARY KEY  (partial_id)
)";
$SQL[] = "CREATE INDEX partial_member_id ON members_partial (partial_member_id)";

$SQL[]="CREATE TABLE dnames_change (
  dname_id int NOT NULL identity,
  dname_member_id int NOT NULL default 0,
  dname_date int NOT NULL default 0,
  dname_ip_address varchar(16) NOT NULL default '',
  dname_previous varchar(255) NOT NULL default '',
  dname_current varchar(255) NOT NULL default '',
  PRIMARY KEY  (dname_id)
)";
$SQL[]="CREATE INDEX dname_member_id ON dnames_change (dname_member_id)";
$SQL[]="CREATE INDEX date_id ON dnames_change (dname_member_id,dname_date)";

$SQL[] = "CREATE TABLE cal_calendars (
  cal_id int NOT NULL identity,
  cal_title varchar(255) NOT NULL default '0',
  cal_moderate tinyint NOT NULL default 0,
  cal_position smallint NOT NULL default 0,
  cal_event_limit smallint NOT NULL default 0,
  cal_bday_limit smallint NOT NULL default 0,
  cal_rss_export tinyint NOT NULL default 0,
  cal_rss_export_days tinyint NOT NULL default 0,
  cal_rss_export_max smallint NOT NULL default 0,
  cal_rss_update smallint NOT NULL default 0,
  cal_rss_update_last int NOT NULL default 0,
  cal_rss_cache text NULL,
  cal_permissions text NULL,
  PRIMARY KEY (cal_id)
)";

$SQL[] = "CREATE TABLE login_methods (
  login_id int NOT NULL identity,
  login_title varchar(255) NOT NULL default '',
  login_description varchar(255) NOT NULL default '',
  login_folder_name varchar(255) NOT NULL default '',
  login_maintain_url varchar(255) NOT NULL default '',
  login_register_url varchar(255) NOT NULL default '',
  login_type varchar(30) NOT NULL default '',
  login_alt_login_html text NULL,
  login_date int NOT NULL default 0,
  login_settings tinyint NOT NULL default 0,
  login_enabled tinyint NOT NULL default 0,
  login_safemode tinyint NOT NULL default 0,
  login_installed tinyint NOT NULL default 0,
  login_replace_form tinyint NOT NULL default 0,
  login_allow_create tinyint NOT NULL default 0,
  PRIMARY KEY  (login_id)
)";

$SQL[] = "CREATE TABLE admin_permission_rows (
  row_member_id INT NOT NULL,
  row_perm_cache TEXT,
  row_updated INT NOT NULL DEFAULT 0,
PRIMARY KEY (row_member_id)
)";

$SQL[] = "CREATE TABLE admin_permission_keys (
  perm_key VARCHAR(255) NOT NULL,
  perm_main VARCHAR(255) NOT NULL,
  perm_child VARCHAR(255) NOT NULL,
  perm_bit VARCHAR(255) NOT NULL,
  PRIMARY KEY (perm_key)
)";
$SQL[] = "CREATE INDEX perm_main ON admin_permission_keys (perm_main)";
$SQL[] = "CREATE INDEX perm_child ON admin_permission_keys (perm_child)";

$SQL[] = "CREATE TABLE templates_diff_import (
	diff_key			VARCHAR(255) NOT NULL,
	diff_func_group		VARCHAR(150) NOT NULL,
	diff_func_name		VARCHAR(250) NOT NULL,
	diff_func_data		TEXT NULL,
	diff_func_content	TEXT NULL,
	diff_session_id		INT NOT NULL default 0,
	PRIMARY KEY (diff_key)
)";
$SQL[] = "CREATE INDEX diff_func_group ON templates_diff_import (diff_func_group)";
$SQL[] = "CREATE INDEX diff_func_name ON templates_diff_import (diff_func_name)";

$SQL[] = "CREATE TABLE template_diff_session (
	diff_session_id				INT NOT NULL identity,
	diff_session_togo			INT NOT NULL default 0,
	diff_session_done			INT NOT NULL default 0,
	diff_session_updated		INT NOT NULL default 0,
	diff_session_title			VARCHAR(255) NOT NULL default '',
	diff_session_ignore_missing TINYINT NOT NULL default 0,
	PRIMARY KEY (diff_session_id)
)";

$SQL[] = "CREATE TABLE template_diff_changes (
	diff_change_key			VARCHAR(255) NOT NULL,
	diff_change_func_group	VARCHAR(150) NOT NULL,
	diff_change_func_name	VARCHAR(250) NOT NULL,
	diff_change_content		TEXT,
	diff_change_type		TINYINT NOT NULL default 0,
	diff_session_id		    INT NOT NULL default 0,
	PRIMARY KEY (diff_change_key)
)";
$SQL[] = "CREATE INDEX diff_change_func_group ON template_diff_changes (diff_change_func_group)";
$SQL[] = "CREATE INDEX diff_change_type ON template_diff_changes (diff_change_type)";

