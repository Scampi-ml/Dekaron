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
$DB  = ipsRegistry::DB();
$PRE = ipsRegistry::dbFunctions()->getPrefix();

# Nothing of interest!
$SQL[]="ALTER TABLE members ADD members_profile_views INT NOT NULL default 0";
$SQL[]="ALTER TABLE members ADD member_login_key_expire	INT NOT NULL default 0";

$SQL[]="alter table members ADD members_l_display_name VARCHAR(255) NOT NULL default '0'";
$SQL[]="alter table members ADD members_l_username   VARCHAR(255) NOT NULL default '0'";

$DB->dropIndex( "members", "name" );

if ($sql = $DB->_sql_get_dropdefault_constraint("members", "legacy_password") ) {
	$SQL[] = $sql;
}
$SQL[]="ALTER TABLE members DROP COLUMN legacy_password";

$SQL[]="CREATE INDEX members_l_username ON members (members_l_username)";
$SQL[]="CREATE INDEX members_l_display_name ON members (members_l_display_name)";

$SQL[]="ALTER TABLE members ADD failed_logins VARCHAR( MAX ) NULL";
$SQL[]="ALTER TABLE members ADD failed_login_count SMALLINT DEFAULT 0 NOT NULL";

$SQL[]="ALTER TABLE members_partial ADD partial_email_ok tinyint NOT NULL default 0";

$SQL[] ="ALTER TABLE attachments ADD attach_rel_id INT NOT NULL default 0";
$SQL[] ="ALTER TABLE attachments ADD attach_rel_module VARCHAR(100) NOT NULL default '0'";
$SQL[] ="ALTER TABLE attachments ADD attach_img_width SMALLINT NOT NULL default 0";
$SQL[] ="ALTER TABLE attachments ADD attach_img_height SMALLINT NOT NULL default 0";

$DB->dropIndex( "attachments", "attach_mid_size" );
$DB->dropIndex( "attachments", "attach_pid" );
$DB->dropIndex( "attachments", "attach_msg" );
$SQL[] ="CREATE INDEX attach_pid ON attachments (attach_rel_id)";
$SQL[] ="CREATE INDEX attach_mid_size ON attachments (attach_member_id,attach_rel_module, attach_filesize)";
$SQL[] ="CREATE INDEX attach_where ON attachments (attach_rel_module, attach_rel_id)";

