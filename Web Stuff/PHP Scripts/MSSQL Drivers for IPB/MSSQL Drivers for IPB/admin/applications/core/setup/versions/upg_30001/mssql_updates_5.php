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

# INSERTS AND UPDATES
/* Report center stuff */
$SQL[] = <<<EOF
INSERT INTO rc_classes (onoff, class_title, class_desc, author, author_url, pversion, my_class, group_can_report, mod_group_perm, extra_data, lockd) VALUES(1, 'Simple Plugin Example', 'Plugin that does not require any programming, but does need to be configured.', 'Invision Power Services, Inc', 'http://invisionpower.com', 'v1.0', 'default', ',3,4,6,', ',4,6,', 'a:5:{s:14:"required_input";a:1:{s:8:"video_id";s:13:"[^A-Za-z0-9_]";}s:10:"string_url";s:41:"http://www.youtube.com/watch?v={video_id}";s:12:"string_title";s:25:"#PAGE_TITLE# ({video_id})";s:13:"section_title";s:7:"YouTube";s:11:"section_url";s:22:"http://www.youtube.com";}', 1);
EOF;
$SQL[] = <<<EOF
INSERT INTO rc_classes (onoff, class_title, class_desc, author, author_url, pversion, my_class, group_can_report, mod_group_perm, extra_data, lockd) VALUES(1, 'Forum Plugin', 'This is the plugin used for reporting posts on the forum.', 'Invision Power Services, Inc', 'http://invisionpower.com', 'v1.0', 'post', ',1,2,3,4,6,', ',4,6,', 'a:1:{s:15:"report_supermod";i:1;}', 1);
EOF;
$SQL[] = <<<EOF
INSERT INTO rc_classes (onoff, class_title, class_desc, author, author_url, pversion, my_class, group_can_report, mod_group_perm, extra_data, lockd) VALUES(1, 'Private Messages Plugin', 'This plugin allows private messages to be reported', 'Invision Power Services, Inc', 'http://invisionpower.com', 'v1.0', 'messages', ',1,2,3,4,6,', ',4,6,', 'a:1:{s:18:"plugi_messages_add";s:5:"4";}', 1);
EOF;
$SQL[] = <<<EOF
INSERT INTO rc_classes (onoff, class_title, class_desc, author, author_url, pversion, my_class, group_can_report, mod_group_perm, extra_data, lockd) VALUES(1, 'Member Profiles', 'Allows you to report member profiles', 'Invision Power Services, Inc', 'http://invisionpower.com', 'v1.0', 'profiles', ',1,2,3,4,6,', ',4,6,', 'N;', 1);
EOF;

$SQL[] = "DELETE FROM rc_status";
$SQL[] = "SET IDENTITY_INSERT rc_status ON";
$SQL[] = "INSERT INTO rc_status (status, title, points_per_report, minutes_to_apoint, is_new, is_complete, is_active, rorder) VALUES(1, 'New Report', 1, 5, 1, 0, 1, 1);";
$SQL[] = "INSERT INTO rc_status (status, title, points_per_report, minutes_to_apoint, is_new, is_complete, is_active, rorder) VALUES(2, 'Under Review', 1, 5, 0, 0, 1, 2);";
$SQL[] = "INSERT INTO rc_status (status, title, points_per_report, minutes_to_apoint, is_new, is_complete, is_active, rorder) VALUES(3, 'Complete', 0, 0, 0, 1, 0, 3);";
$SQL[] = "SET IDENTITY_INSERT rc_status OFF";

$SQL[] = "DELETE FROM rc_status_sev";
$SQL[] = "SET IDENTITY_INSERT rc_status_sev ON";
$SQL[] = "INSERT INTO rc_status_sev (id, status, points, img, is_png, width, height) VALUES (1, 1, 1, 'style_extra/report_icons/flag_gray.png', 1, 16, 16);";
$SQL[] = "INSERT INTO rc_status_sev (id, status, points, img, is_png, width, height) VALUES (2, 1, 2, 'style_extra/report_icons/flag_blue.png', 1, 16, 16);";
$SQL[] = "INSERT INTO rc_status_sev (id, status, points, img, is_png, width, height) VALUES (3, 1, 4, 'style_extra/report_icons/flag_green.png', 1, 16, 16);";
$SQL[] = "INSERT INTO rc_status_sev (id, status, points, img, is_png, width, height) VALUES (4, 1, 7, 'style_extra/report_icons/flag_orange.png', 1, 16, 16);";
$SQL[] = "INSERT INTO rc_status_sev (id, status, points, img, is_png, width, height) VALUES (5, 1, 12, 'style_extra/report_icons/flag_red.png', 1, 16, 16);";
$SQL[] = "INSERT INTO rc_status_sev (id, status, points, img, is_png, width, height) VALUES (6, 2, 1, 'style_extra/report_icons/flag_gray_review.png', 1, 16, 16);";
$SQL[] = "INSERT INTO rc_status_sev (id, status, points, img, is_png, width, height) VALUES (7, 3, 0, 'style_extra/report_icons/completed.png', 1, 16, 16);";
$SQL[] = "INSERT INTO rc_status_sev (id, status, points, img, is_png, width, height) VALUES (8, 2, 2, 'style_extra/report_icons/flag_blue_review.png', 1, 16, 16);";
$SQL[] = "INSERT INTO rc_status_sev (id, status, points, img, is_png, width, height) VALUES (9, 2, 4, 'style_extra/report_icons/flag_green_review.png', 1, 16, 16);";
$SQL[] = "INSERT INTO rc_status_sev (id, status, points, img, is_png, width, height) VALUES (10, 2, 7, 'style_extra/report_icons/flag_orange_review.png', 1, 16, 16);";
$SQL[] = "INSERT INTO rc_status_sev (id, status, points, img, is_png, width, height) VALUES (11, 2, 12, 'style_extra/report_icons/flag_red_review.png', 1, 16, 16);";
$SQL[] = "SET IDENTITY_INSERT rc_status_sev OFF";

# Profile fields stuff
$SQL[] = "DELETE FROM pfields_data";
$SQL[] = "SET IDENTITY_INSERT pfields_data ON;";
$SQL[] = "INSERT INTO pfields_data (pf_id, pf_title, pf_desc, pf_content, pf_type, pf_not_null, pf_member_hide, pf_max_input, pf_member_edit, pf_position, pf_show_on_reg, pf_input_format, pf_admin_only, pf_topic_format, pf_group_id, pf_icon, pf_key) VALUES (1, 'AIM', '', '', 'input', 0, 0, 0, 1, 0, 0, '', 0, '', 1, 'style_extra/cprofile_icons/profile_aim.gif', 'aim');";
$SQL[] = "INSERT INTO pfields_data (pf_id, pf_title, pf_desc, pf_content, pf_type, pf_not_null, pf_member_hide, pf_max_input, pf_member_edit, pf_position, pf_show_on_reg, pf_input_format, pf_admin_only, pf_topic_format, pf_group_id, pf_icon, pf_key) VALUES (2, 'MSN', '', '', 'input', 0, 0, 0, 1, 0, 0, '', 0, '', 1, 'style_extra/cprofile_icons/profile_msn.gif', 'msn')";
$SQL[] = "INSERT INTO pfields_data (pf_id, pf_title, pf_desc, pf_content, pf_type, pf_not_null, pf_member_hide, pf_max_input, pf_member_edit, pf_position, pf_show_on_reg, pf_input_format, pf_admin_only, pf_topic_format, pf_group_id, pf_icon, pf_key) VALUES (3, 'Website URL', '', '', 'input', 0, 0, 0, 1, 0, 0, '', 0, '', 1, 'style_extra/cprofile_icons/profile_website.gif', 'website')";
$SQL[] = "INSERT INTO pfields_data (pf_id, pf_title, pf_desc, pf_content, pf_type, pf_not_null, pf_member_hide, pf_max_input, pf_member_edit, pf_position, pf_show_on_reg, pf_input_format, pf_admin_only, pf_topic_format, pf_group_id, pf_icon, pf_key) VALUES (4, 'ICQ', '', '', 'input', 0, 0, 0, 1, 0, 0, '', 0, '', 1, 'style_extra/cprofile_icons/profile_icq.gif', 'icq')";
$SQL[] = "INSERT INTO pfields_data (pf_id, pf_title, pf_desc, pf_content, pf_type, pf_not_null, pf_member_hide, pf_max_input, pf_member_edit, pf_position, pf_show_on_reg, pf_input_format, pf_admin_only, pf_topic_format, pf_group_id, pf_icon, pf_key) VALUES (5, 'Gender', '', 'u=Not Telling|m=Male|f=Female', 'drop', 0, 0, 0, 1, 0, 0, '', 0, '', 2, '', 'gender')";
$SQL[] = "INSERT INTO pfields_data (pf_id, pf_title, pf_desc, pf_content, pf_type, pf_not_null, pf_member_hide, pf_max_input, pf_member_edit, pf_position, pf_show_on_reg, pf_input_format, pf_admin_only, pf_topic_format, pf_group_id, pf_icon, pf_key) VALUES (6, 'Location', '', '', 'input', 0, 0, 0, 1, 0, 0, '', 0, '<span class=''ft''>{title}</span><span class=''fc''>{content}</span>', 2, '', 'location');";
$SQL[] = "INSERT INTO pfields_data (pf_id, pf_title, pf_desc, pf_content, pf_type, pf_not_null, pf_member_hide, pf_max_input, pf_member_edit, pf_position, pf_show_on_reg, pf_input_format, pf_admin_only, pf_topic_format, pf_group_id, pf_icon, pf_key) VALUES (7, 'Interests', '', '', 'textarea', 0, 0, 0, 1, 0, 0, '', 0, '', 2, '', 'interests')";
$SQL[] = "INSERT INTO pfields_data (pf_id, pf_title, pf_desc, pf_content, pf_type, pf_not_null, pf_member_hide, pf_max_input, pf_member_edit, pf_position, pf_show_on_reg, pf_input_format, pf_admin_only, pf_topic_format, pf_group_id, pf_icon, pf_key) VALUES (8, 'Yahoo', '', '', 'input', 0, 0, 0, 1, 0, 0, '', 0, '', 1, 'style_extra/cprofile_icons/profile_yahoo.gif', 'yahoo')";
$SQL[] = "INSERT INTO pfields_data (pf_id, pf_title, pf_desc, pf_content, pf_type, pf_not_null, pf_member_hide, pf_max_input, pf_member_edit, pf_position, pf_show_on_reg, pf_input_format, pf_admin_only, pf_topic_format, pf_group_id, pf_icon, pf_key) VALUES (9, 'Jabber', '', '', 'input', 0, 0, 0, 1, 0, 0, '', 0, '', 1, 'style_extra/cprofile_icons/profile_jabber.gif', 'jabber')";
$SQL[] = "INSERT INTO pfields_data (pf_id, pf_title, pf_desc, pf_content, pf_type, pf_not_null, pf_member_hide, pf_max_input, pf_member_edit, pf_position, pf_show_on_reg, pf_input_format, pf_admin_only, pf_topic_format, pf_group_id, pf_icon, pf_key) VALUES (10, 'Skype', '', '', 'input', 0, 0, 0, 1, 0, 0, '', 0, '', 1, 'style_extra/cprofile_icons/profile_skype.gif', 'skype');";
$SQL[] = "SET IDENTITY_INSERT pfields_data OFF;";

$SQL[] = "DELETE FROM pfields_groups";
$SQL[] = "SET IDENTITY_INSERT pfields_groups ON;";
$SQL[] = "INSERT INTO pfields_groups (pf_group_id, pf_group_name, pf_group_key) VALUES (1, 'Contact Methods', 'contact');";
$SQL[] = "INSERT INTO pfields_groups (pf_group_id, pf_group_name, pf_group_key) VALUES (2, 'Profile Information', 'profile_info');";
$SQL[] = "INSERT INTO pfields_groups (pf_group_id, pf_group_name, pf_group_key) VALUES (3, 'Previous Fields', 'previous');";
$SQL[] = "SET IDENTITY_INSERT pfields_groups OFF;";

/* Can't use replace on TEXT in MSSQL so- */
$DB->build( array( 'select' => '*',
				   'from'   => 'attachments_type' ) );
$o = $DB->execute();

while( $g = $DB->fetch( $o ) )
{
	$DB->update( 'attachments_type', array( 'atype_img' => str_replace( 'folder_mime_types/', 'style_extra/mime_types', $g['atype_img'] ) ), 'atype_id=' . $g['atype_id'] );
}

$SQL[] = "UPDATE login_methods SET login_alt_acp_html = '<label for=''openid''>Open ID</label> <input type=''text'' size=''20'' id=''openid'' name=''openid_url'' value=''http://''>' WHERE login_folder_name='openid';";

# Enable internal method on upgrade, but put it after any others
$SQL[] = "UPDATE login_methods SET login_enabled=1,login_order=7 WHERE login_folder_name='internal';";

$SQL[] = "DELETE FROM skin_cache;";
$SQL[] = "DELETE FROM skin_templates_cache;";
$SQL[] = "DELETE FROM skin_url_mapping;";

$SQL[] = "DELETE FROM cache_store WHERE cs_key='skin_id_cache';";
$SQL[] = "DELETE FROM cache_store WHERE cs_key='forum_cache';";

$SQL[] = "DELETE FROM reputation_levels";
$SQL[] = "SET IDENTITY_INSERT reputation_levels ON";
$SQL[] = "INSERT INTO reputation_levels (level_id, level_points, level_title, level_image) VALUES(1, -20, 'Bad', '');";
$SQL[] = "INSERT INTO reputation_levels (level_id, level_points, level_title, level_image) VALUES(2, -10, 'Poor', '');";
$SQL[] = "INSERT INTO reputation_levels (level_id, level_points, level_title, level_image) VALUES(3, 0, 'Neutral', '');";
$SQL[] = "INSERT INTO reputation_levels (level_id, level_points, level_title, level_image) VALUES(4, 10, 'Good', '');";
$SQL[] = "INSERT INTO reputation_levels (level_id, level_points, level_title, level_image) VALUES(5, 20, 'Excellent', '');";
$SQL[] = "SET IDENTITY_INSERT reputation_levels OFF";

?>