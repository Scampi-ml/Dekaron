<?php
/*
+--------------------------------------------------------------------------
|   IP.Board v3.1.4
|   ========================================
|   by Matthew Mecham
|   (c) 2001 - 2009 Invision Power Services
|   http://www.invisionpower.com
|   ========================================
|   Web: http://www.invisionboard.com
|   Email: matt@invisionpower.com
|   Licence Info: http://www.invisionboard.com/?license
+---------------------------------------------------------------------------
*/

# 3.0.3

$SQL = array();
$DB  = ipsRegistry::DB();
$PRE = ipsRegistry::dbFunctions()->getPrefix();

$DB->addIndex( 'admin_logs', 'ip_address', 'ip_address' );
$DB->addIndex( 'dnames_change', 'dname_ip_address', 'dname_ip_address' );
$DB->addIndex( 'error_logs', 'log_ip_address', 'log_ip_address' );
$DB->addIndex( 'message_posts', 'msg_ip_address', 'msg_ip_address' );
$DB->addIndex( 'moderator_logs', 'ip_address', 'ip_address' );
$DB->addIndex( 'profile_comments', 'comment_ip_address', 'comment_ip_address' );
$DB->addIndex( 'profile_ratings', 'rating_ip_address', 'rating_ip_address' );
$DB->addIndex( 'topic_ratings', 'rating_ip_address', 'rating_ip_address' );
$DB->addIndex( 'validating', 'ip_address', 'ip_address' );
$DB->addIndex( 'voters', 'ip_address', 'ip_address' );

$DB->addIndex( 'sessions', 'member_id', 'member_id' );
//$DB->addIndex( 'profile_portal', 'pp_status', 'pp_status, pp_status_update' );

$DB->addField( 'members', 'live_id', 'VARCHAR( 32 )' );

$_e = '';
$_f = '';

if ( $DB->checkForField( 'gallery_perms', 'members' ) )
{
	$_f = "\ngallery_perms VARCHAR(10) NULL,\n";
	$_e = ',gallery_perms';
}

/* Now fix an issue causing during the 2.3.6 upgrade */
/* Cannot simply add an indexed identity column, so... */
$DB->renameTable( 'members', 'members_bak' );

ipsRegistry::dbFunctions()->prefix_changed = true;

$DB->query( "CREATE TABLE [{$PRE}members] (
  member_id INT NOT NULL IDENTITY,
  name VARCHAR(255) NOT NULL DEFAULT '',
  member_group_id SMALLINT NOT NULL DEFAULT '0',
  email VARCHAR(150) NOT NULL DEFAULT '',
  joined INT NOT NULL DEFAULT '0',
  ip_address VARCHAR(16) NOT NULL DEFAULT '',
  posts INT DEFAULT '0',
  title VARCHAR(64) NULL,
  allow_admin_mails TINYINT NULL,
  time_offset VARCHAR(10) NULL,
  hide_email VARCHAR(8) NULL,
  email_pm TINYINT DEFAULT '1',
  email_full TINYINT NULL,
  skin SMALLINT NULL,
  warn_level INT NULL,
  warn_lastwarn INT NOT NULL DEFAULT '0',
  language VARCHAR(32) NULL,
  last_post INT NULL,
  restrict_post VARCHAR(100) NOT NULL DEFAULT '0',
  view_sigs TINYINT DEFAULT '1',
  view_img TINYINT DEFAULT '1',
  view_avs TINYINT DEFAULT '1',
  view_pop TINYINT DEFAULT '1',
  bday_day INT NULL,
  bday_month INT NULL,
  bday_year INT NULL,
  msg_count_new INT NOT NULL DEFAULT '0',
  msg_count_total INT NOT NULL DEFAULT '0',
  msg_count_reset INT NOT NULL DEFAULT '0',
  msg_show_notification INT NOT NULL DEFAULT '0',
  misc VARCHAR(128) NULL,
  last_visit INT DEFAULT '0',
  last_activity INT DEFAULT '0',
  dst_in_use TINYINT DEFAULT '0',
  view_prefs VARCHAR(64) DEFAULT '-1&-1',
  coppa_user TINYINT DEFAULT '0',
  mod_posts VARCHAR(100) NOT NULL DEFAULT '0',
  auto_track VARCHAR(50) DEFAULT '0',
  temp_ban VARCHAR(100) DEFAULT '0',
  sub_end INT NOT NULL DEFAULT '0',
  login_anonymous char(3) NOT NULL DEFAULT '0&0',
ignored_users VARCHAR( MAX ) NULL,
  mgroup_others VARCHAR(255) NOT NULL DEFAULT '',
  org_perm_id VARCHAR(255) NOT NULL DEFAULT '',
  member_login_key VARCHAR(32) NOT NULL DEFAULT '',
  member_login_key_expire INT NOT NULL DEFAULT '0',
  subs_pkg_chosen SMALLINT NOT NULL DEFAULT '0',
  has_blog TINYINT NOT NULL DEFAULT '0',
  has_gallery TINYINT NOT NULL DEFAULT '0',{$_f}
  members_editor_choice char(3) NOT NULL DEFAULT 'std',
  members_auto_dst TINYINT NOT NULL DEFAULT '1',
  members_display_name VARCHAR(255) NOT NULL DEFAULT '',
  members_seo_name VARCHAR(255) NOT NULL DEFAULT '',
  members_created_remote TINYINT NOT NULL DEFAULT '0',
members_cache VARCHAR( MAX ) NULL,
  members_disable_pm INT NOT NULL DEFAULT '0',
  members_l_display_name VARCHAR(255) NOT NULL DEFAULT '0',
  members_l_username VARCHAR(255) NOT NULL DEFAULT '0',
failed_logins VARCHAR( MAX ) NULL,
  failed_login_count SMALLINT NOT NULL DEFAULT '0',
  members_profile_views INT NOT NULL DEFAULT '0',
  members_pass_hash VARCHAR(32) NOT NULL DEFAULT '',
  members_pass_salt VARCHAR(5) NOT NULL DEFAULT '',
identity_url VARCHAR( MAX ) NULL,
  member_banned TINYINT NOT NULL DEFAULT '0',
    member_uploader VARCHAR(32) NOT NULL DEFAULT 'default',
  members_bitoptions INT NOT NULL DEFAULT '0',
  fb_uid INT NOT NULL DEFAULT '0',
  fb_emailhash VARCHAR(60) NOT NULL DEFAULT '',
  fb_emailallow INT NOT NULL DEFAULT '0',
  fb_lastsync INT NOT NULL DEFAULT '0',
  members_day_posts VARCHAR(32) NOT NULL DEFAULT '0,0',
  live_id VARCHAR( 32 ) NULL,
  PRIMARY KEY (member_id)
);");

ipsRegistry::dbFunctions()->prefix_changed = false;

ipsRegistry::DB()->update( 'members_bak', array( 'has_gallery' => 0 ), 'has_gallery IS NULL' );
ipsRegistry::DB()->update( 'members_bak', array( 'has_blog' => 0 ), 'has_blog IS NULL' );
ipsRegistry::DB()->update( 'members_bak', array( 'restrict_post' => 0 ), 'restrict_post IS NULL OR restrict_post LIKE \'\'' );
ipsRegistry::DB()->update( 'members_bak', array( 'ignored_users' => '' ), 'ignored_users IS NULL' );
ipsRegistry::DB()->update( 'members_bak', array( 'members_cache' => '' ), 'members_cache IS NULL' );
ipsRegistry::DB()->update( 'members_bak', array( 'failed_logins' => '' ), 'failed_logins IS NULL' );
ipsRegistry::DB()->update( 'members_bak', array( 'identity_url' => '' ), 'identity_url IS NULL' );
ipsRegistry::DB()->update( 'members_bak', array( 'misc' => '' ), 'misc IS NULL' );
ipsRegistry::DB()->update( 'members_bak', array( 'email_pm' => '0' ), 'email_pm IS NULL' );
ipsRegistry::DB()->update( 'members_bak', array( 'temp_ban' => '0' ), 'temp_ban IS NULL or temp_ban LIKE \'\'' );


$DB->setTableIdentityInsert( 'members', 'ON' );
ipsRegistry::DB()->allow_sub_select=1;

$DB->query("INSERT INTO [{$PRE}members]
				(member_id,name,member_group_id,email,joined,ip_address,posts,title,allow_admin_mails,time_offset,hide_email,email_pm,email_full,skin,warn_level,warn_lastwarn,language,last_post,restrict_post,view_sigs,view_img,view_avs,view_pop,bday_day,bday_month,bday_year,msg_count_new,msg_count_total,msg_count_reset,msg_show_notification,misc,last_visit,last_activity,dst_in_use,view_prefs,coppa_user,mod_posts,auto_track,temp_ban,sub_end,login_anonymous,ignored_users,mgroup_others,org_perm_id,member_login_key,member_login_key_expire,subs_pkg_chosen,has_blog,has_gallery,members_editor_choice,members_auto_dst,members_display_name,members_seo_name,members_created_remote,members_cache,members_disable_pm,members_l_display_name,members_l_username,failed_logins,failed_login_count,members_profile_views,members_pass_hash,members_pass_salt,identity_url,member_banned,member_uploader,members_bitoptions,fb_uid,fb_emailhash,fb_emailallow,fb_lastsync,members_day_posts,live_id{$_e})
			SELECT member_id,name,member_group_id,email,joined,ip_address,posts,title,allow_admin_mails,time_offset,hide_email,email_pm,email_full,skin,warn_level,warn_lastwarn,language,last_post,restrict_post,view_sigs,view_img,view_avs,view_pop,bday_day,bday_month,bday_year,msg_count_new,msg_count_total,msg_count_reset,msg_show_notification,misc,last_visit,last_activity,dst_in_use,view_prefs,coppa_user,mod_posts,auto_track,temp_ban,sub_end,login_anonymous,ignored_users,mgroup_others,org_perm_id,member_login_key,member_login_key_expire,subs_pkg_chosen,has_blog,has_gallery,members_editor_choice,members_auto_dst,members_display_name,members_seo_name,members_created_remote,members_cache,members_disable_pm,members_l_display_name,members_l_username,failed_logins,failed_login_count,members_profile_views,members_pass_hash,members_pass_salt,identity_url,member_banned,member_uploader,members_bitoptions,fb_uid,fb_emailhash,fb_emailallow,fb_lastsync,members_day_posts,live_id{$_e}
				FROM [{$PRE}members_bak] WHERE [{$PRE}members_bak].member_id > 0");
$DB->setTableIdentityInsert( 'members', 'OFF' );

$DB->dropTable( 'members_bak' ); 

$DB->query("CREATE INDEX members_l_display_name ON [{$PRE}members] ( members_l_display_name );");
$DB->query("CREATE INDEX members_l_username ON [{$PRE}members] ( members_l_username );");
$DB->query("CREATE INDEX mgroup ON [{$PRE}members] ( member_group_id );");
$DB->query("CREATE INDEX bday_day ON [{$PRE}members] ( bday_day );");
$DB->query("CREATE INDEX bday_month ON [{$PRE}members] ( bday_month );");
$DB->query("CREATE INDEX member_banned ON [{$PRE}members] ( member_banned );");
$DB->query("CREATE INDEX members_bitoptions ON [{$PRE}members] ( members_bitoptions );");
$DB->addIndex( 'members', 'ip_address', 'ip_address' );

