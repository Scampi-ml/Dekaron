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

$SQL = array();
$DB  = ipsRegistry::DB();
$PRE = ipsRegistry::dbFunctions()->getPrefix();

# ALTER MEMBER TABLES
$DB->changeField( 'members', 'id', 'member_id' );
$DB->changeField( 'members', 'mgroup', 'member_group_id' );
$DB->addField( 'members', 'members_pass_hash', 'varchar(32)', "''" );
$DB->addField( 'members', 'members_pass_salt', 'varchar(5)', "''" );
$DB->addField( 'members', 'member_banned', 'int', "'0'" );
$DB->addField( 'members', 'identity_url', 'VARCHAR( MAX )' );
$DB->addIndex( 'members', 'member_banned', 'member_banned' );


# FIX NULL COLUMNS
$DB->update( 'members', array( 'new_msg' => 0 ), 'new_msg IS NULL' );
$DB->update( 'members', array( 'msg_total' => 0 ), 'msg_total IS NULL' );
$DB->update( 'members', array( 'show_popup' => 0 ), 'show_popup IS NULL' );

$DB->changeField( 'members', 'new_msg', 'msg_count_new' );
$DB->changeField( 'members', 'msg_total', 'msg_count_total' );
$DB->addField( 'members', 'msg_count_reset', 'int', "'0'" );
$DB->changeField( 'members', 'show_popup', 'msg_show_notification' );
$DB->addField( 'members', 'member_uploader', 'varchar(32)', "'default'" );
$DB->dropField( 'members', 'members_markers' );
$DB->addField( 'members', 'members_seo_name', 'varchar(255)', "''" );
$DB->addField( 'members', 'members_bitoptions', 'int', "'0'" );

$DB->addField( 'members', 'fb_uid', 'int', "'0'" );
$DB->addField( 'members', 'fb_emailhash', 'varchar(60)', "''" );
$DB->addField( 'members', 'fb_emailallow', 'int', "'0'" );
$DB->addField( 'members', 'fb_lastsync', 'int', "'0'" );

$DB->addField( 'profile_portal', 'notes', 'VARCHAR( MAX )' );
$DB->addField( 'profile_portal', 'links', 'VARCHAR( MAX )' );
$DB->addField( 'profile_portal', 'bio', 'VARCHAR( MAX )' );
$DB->addField( 'profile_portal', 'ta_size', 'varchar(3)', "''" );
$DB->addField( 'profile_portal', 'signature', 'VARCHAR( MAX )' );
$DB->addField( 'profile_portal', 'avatar_location', 'varchar(255)', "''" );
$DB->addField( 'profile_portal', 'avatar_size', 'varchar(9)', "'0'" );
$DB->addField( 'profile_portal', 'avatar_type', 'varchar(15)', "''" );
$DB->addField( 'profile_portal', 'pconversation_filters', 'VARCHAR( MAX )' );
$DB->addField( 'profile_portal', 'fb_photo', 'VARCHAR( MAX )' );
$DB->addField( 'profile_portal', 'fb_photo_thumb', 'VARCHAR( MAX )' );
$DB->addField( 'profile_portal', 'fb_bwoptions', 'int', "'0'" );
$DB->addField( 'profile_portal', 'pp_reputation_points', 'int', "'0'" );
$DB->addField( 'profile_portal', 'pp_status', 'VARCHAR( MAX )' );
$DB->addField( 'profile_portal', 'pp_status_update', 'varchar(13)', "'0'" );

/* Can't use replace on TEXT in MSSQL so- */
$DB->build( array( 'select' => '*',
				   'from'   => 'groups' ) );
$o = $DB->execute();

while( $g = $DB->fetch( $o ) )
{
	$DB->update( 'groups', array( 'g_icon' => str_replace( 'style_images/<#IMG_DIR#>/folder_team_icons/', 'public/style_extra/team_icons/', $g['g_icon'] ) ), 'g_id=' . $g['g_id'] );
}
