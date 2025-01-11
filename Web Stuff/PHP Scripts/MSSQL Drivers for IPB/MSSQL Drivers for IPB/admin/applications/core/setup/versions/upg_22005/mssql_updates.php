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

$SQL = array();
$DB  = ipsRegistry::DB();
$PRE = ipsRegistry::dbFunctions()->getPrefix();

$DB->addField('conf_settings_titles', 'conf_title_module', 'varchar(200)', '');

$SQL[] = "CREATE TABLE converge_local (
	converge_api_code	VARCHAR(32) NOT NULL default '',
	converge_product_id	INT NOT NULL default 0,
	converge_added		INT NOT NULL default 0,
	converge_ip_address	VARCHAR(16) NOT NULL default '',
	converge_url		VARCHAR(255) NOT NULL default '',
	converge_active		TINYINT NOT NULL default 0,
	converge_http_user  VARCHAR(255) NOT NULL default '',
	converge_http_pass	VARCHAR(255) NOT NULL default '',
	PRIMARY KEY (converge_api_code )
);";
//$DB->addIndex('converge_local', 'converge_active', 'converge_active');
$SQL[] = "CREATE INDEX converge_active ON converge_local ( converge_active );";

$SQL[] = "CREATE TABLE admin_login_logs (
	admin_id			INT NOT NULL identity,
	admin_ip_address	VARCHAR(16) NOT NULL default '0.0.0.0',
	admin_username		VARCHAR(40) NOT NULL default '',
	admin_time			INT NOT NULL default 0,
	admin_success		TINYINT NOT NULL default 0,
    admin_post_details	VARCHAR( MAX ) NOT NULL default '',
	PRIMARY KEY (admin_id)
)";
//$DB->addIndex('admin_login_logs', 'admin_ip_address', 'admin_ip_address');
//$DB->addIndex('admin_login_logs', 'admin_time', 'admin_time');
$SQL[] = "CREATE INDEX admin_ip_address ON admin_login_logs ( admin_ip_address );";
$SQL[] = "CREATE INDEX admin_time ON admin_login_logs ( admin_time );";

$SQL[] = "CREATE TABLE profile_friends (
	friends_id			INT NOT NULL IDENTITY,
	friends_member_id	INT NOT NULL default 0,
	friends_friend_id	INT NOT NULL default 0,
	friends_approved	TINYINT NOT NULL default 0,
	friends_added		INT NOT NULL default 0,
	PRIMARY KEY( friends_id )
);";
//$DB->addIndex('profile_friends', 'my_friends', 'friends_member_id, friends_friend_id');
//$DB->addIndex('profile_friends', 'friends_member_id', 'friends_member_id');
$SQL[] = "CREATE INDEX my_friends ON profile_friends ( friends_member_id, friends_friend_id );";
$SQL[] = "CREATE INDEX friends_member_id ON profile_friends ( friends_member_id );";

$SQL[] = "CREATE TABLE profile_comments (
	comment_id				INT NOT NULL identity,
	comment_for_member_id	INT NOT NULL default 0,
	comment_by_member_id	INT NOT NULL default 0,
	comment_date			INT NOT NULL default 0,
	comment_ip_address		VARCHAR(16) NOT NULL default '0',
	comment_content			VARCHAR( MAX ) NOT NULL default '',
	comment_approved		TINYINT NOT NULL DEFAULT 0,
	PRIMARY KEY( comment_id )
);";
//$DB->addIndex('profile_comments', 'my_comments', 'comment_for_member_id');
$SQL[] = "CREATE INDEX my_comments ON profile_comments ( comment_for_member_id );";

$SQL[] = "CREATE TABLE profile_ratings (
	rating_id				INT NOT NULL identity,
	rating_for_member_id	INT NOT NULL default 0,
	rating_by_member_id		INT NOT NULL default 0,
	rating_added			INT NOT NULL default 0,
	rating_ip_address		VARCHAR(16) NOT NULL default '',
	rating_value			SMALLINT NOT NULL default 0,
	PRIMARY KEY ( rating_id )
);";
//$DB->addIndex('profile_ratings', 'rating_for_member_id', 'rating_for_member_id');
$SQL[] = "CREATE INDEX rating_for_member_id ON profile_ratings ( rating_for_member_id );";

$SQL[] = "CREATE TABLE profile_portal (
	pp_member_id					INT NOT NULL,
	pp_profile_update				INT NOT NULL default 0,
	pp_bio_content					VARCHAR( MAX ) NOT NULL default '',
	pp_last_visitors				VARCHAR( MAX ) NOT NULL default '',
	pp_comment_count				INT NOT NULL default 0,
	pp_rating_hits					INT NOT NULL default 0,
	pp_rating_value					INT NOT NULL default 0,
	pp_rating_real					INT NOT NULL default 0,
	pp_main_photo					VARCHAR(255) NOT NULL default '',
	pp_main_width					SMALLINT NOT NULL default 0,
	pp_main_height					SMALLINT NOT NULL default 0,
	pp_thumb_photo					VARCHAR(255) NOT NULL default '',
	pp_thumb_width					SMALLINT NOT NULL default 0,
	pp_thumb_height					SMALLINT NOT NULL default 0,
	pp_gender						VARCHAR(10) NOT NULL default '',
	pp_setting_notify_comments		VARCHAR(10) NOT NULL default 'email',
	pp_setting_notify_friend    	VARCHAR(10) NOT NULL default 'email',
	pp_setting_moderate_comments	TINYINT NOT NULL default 0,
	pp_setting_moderate_friends		TINYINT NOT NULL default 0,
    pp_setting_count_friends        SMALLINT NOT NULL default 0,
    pp_setting_count_comments       SMALLINT NOT NULL default 0,
    pp_setting_count_visitors       SMALLINT NOT NULL default 0,
    pp_profile_views                INT NOT NULL default 0,
	PRIMARY KEY ( pp_member_id )
);";

$SQL[] = "CREATE TABLE profile_portal_views (
  views_member_id int NOT NULL default 0
);";

$DB->dropTable('calendar_events');