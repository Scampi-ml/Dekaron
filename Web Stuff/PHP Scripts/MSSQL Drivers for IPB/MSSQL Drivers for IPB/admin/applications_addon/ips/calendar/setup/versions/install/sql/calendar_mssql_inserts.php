<?php
# CALENDARS
$INSERT[] = "SET IDENTITY_INSERT cal_calendars ON";
$INSERT[] = "INSERT INTO cal_calendars (cal_id, cal_title, cal_moderate, cal_position, cal_event_limit, cal_bday_limit, cal_rss_export, cal_rss_export_days, cal_rss_export_max, cal_rss_update, cal_rss_update_last, cal_rss_cache, cal_permissions) VALUES (1, 'Community Calendar', 1, 0, 2, 1, 1, 14, 20, 1440, <%time%>, '', 'a:3:{s:9:\"perm_read\";s:1:\"*\";s:9:\"perm_post\";s:3:\"4,3\";s:10:\"perm_nomod\";s:0:\"\";}');";
$INSERT[] = "SET IDENTITY_INSERT cal_calendars OFF";

$max = ipsRegistry::DB()->buildAndFetch( array( 'select' => 'MAX(perm_id) as max',
									    'from'   => 'permission_index' ) );


$max['max']++;

$INSERT[] = "SET IDENTITY_INSERT permission_index ON";
$INSERT[] = "INSERT INTO permission_index (perm_id, app, perm_type, perm_type_id, perm_view, perm_2, perm_3, perm_4, perm_5, perm_6, perm_7, owner_only, friend_only, authorized_users) VALUES ({$max['max']}, 'calendar', 'calendar', 1, ',4,2,3,', ',4,2,3,', ',4,2,3,', '', '', '', '', 0, 0, NULL)";
$INSERT[] = "SET IDENTITY_INSERT permission_index OFF";


$INSERT[] = "INSERT INTO rc_classes (onoff, class_title, class_desc, author, author_url, pversion, my_class, group_can_report, mod_group_perm, extra_data, lockd, app) VALUES(1, 'Calendar Plugin', 'Allows calendar entries to be reported', 'Invision Power Services, Inc', 'http://invisionpower.com', 'v1.0', 'calendar', ',1,2,3,4,6,', ',4,6,', 'N;', 1, 'calendar');";


