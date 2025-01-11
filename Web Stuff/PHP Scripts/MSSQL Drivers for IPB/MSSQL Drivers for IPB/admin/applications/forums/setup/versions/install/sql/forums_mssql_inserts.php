<?php
# FORUMS: Last field: forums_bitoptions
$INSERT[] = "SET IDENTITY_INSERT forums ON";
$INSERT[] = "INSERT INTO forums (id, topics, posts, last_post, last_poster_id, last_poster_name, name, description, position, use_ibc, use_html, status, password, password_override, last_title, last_id, sort_key, sort_order, prune, topicfilter, show_rules, preview_posts, allow_poll, allow_pollbump, inc_postcount, skin_id, parent_id, quick_reply, redirect_url, redirect_on, redirect_hits, redirect_loc, rules_title, rules_text, topic_mm_id, notify_modq_emails, sub_can_post, permission_custom_error, permission_array, permission_showtopic, queued_topics, queued_posts, forum_allow_rating, forum_last_deletion, newest_title, newest_id, min_posts_post, min_posts_view, can_view_others, hide_last_info, name_seo, seo_last_title, seo_last_name, last_x_topic_ids, forums_bitoptions) VALUES (1, 0, 0, 0, 0, '', 'A Test Category', 'A test category that may be removed at any time' , 1, 1, 0, 1, '', '', '', 0, 'last_post', 'Z-A', 30, 'all', 0, 0, 1, 1, 1, NULL, -1, 0, '', 0, 0, '', '', '', '', '', 0, '', 'a:6:{s:11:\"start_perms\";s:1:\"*\";s:11:\"reply_perms\";s:1:\"*\";s:10:\"read_perms\";s:1:\"*\";s:12:\"upload_perms\";s:1:\"*\";s:14:\"download_perms\";s:1:\"*\";s:10:\"show_perms\";s:1:\"*\";}', 1, 0, 0, 1, 1, '', 0,0,0,1,0,'a-test-category','','','', 0);";
$INSERT[] = "INSERT INTO forums (id, topics, posts, last_post, last_poster_id, last_poster_name, name, description, position, use_ibc, use_html, status, password, password_override, last_title, last_id, sort_key, sort_order, prune, topicfilter, show_rules, preview_posts, allow_poll, allow_pollbump, inc_postcount, skin_id, parent_id, quick_reply, redirect_url, redirect_on, redirect_hits, redirect_loc, rules_title, rules_text, topic_mm_id, notify_modq_emails, sub_can_post, permission_custom_error, permission_array, permission_showtopic, queued_topics, queued_posts, forum_allow_rating, forum_last_deletion, newest_title, newest_id, min_posts_post, min_posts_view, can_view_others, hide_last_info, name_seo, seo_last_title, seo_last_name, last_x_topic_ids, forums_bitoptions) VALUES (2, 1, 1, <%time%>, 1, '<%admin_name%>', 'A Test Forum', 'A test forum that may be removed at any time', 1, 1, 0, 1, '', '', 'Welcome!', 1, 'last_post', 'Z-A', 100, 'all', 0, 0, 1, 1, 1, NULL, 1, 1, '', 0, 0, '', '', '', '', '', 1, '', 'a:6:{s:11:\"start_perms\";s:1:\"*\";s:11:\"reply_perms\";s:1:\"*\";s:10:\"read_perms\";s:1:\"*\";s:12:\"upload_perms\";s:1:\"*\";s:14:\"download_perms\";s:1:\"*\";s:10:\"show_perms\";s:1:\"*\";}', 0, 0, 0, 0, 1, '', 0,0,0,1,0,'a-test-forum','welcome','<%admin_seoname%>','a:1:{i:1;i:<%time%>;} ', 0);";
$INSERT[] = "SET IDENTITY_INSERT forums OFF";

$max = ipsRegistry::DB()->buildAndFetch( array( 'select' => 'MAX(perm_id) as max',
									    'from'   => 'permission_index' ) );


$max['max']++;
$INSERT[] = "SET IDENTITY_INSERT permission_index ON";
$INSERT[] ="INSERT INTO permission_index (perm_id, app, perm_type, perm_type_id, perm_view, perm_2, perm_3, perm_4, perm_5, perm_6, perm_7, owner_only, friend_only, authorized_users) VALUES ({$max['max']}, 'forums', 'forum', 1, '*', '*', '*', '*', ',4,3,', ',4,3,', '', 0, 0, NULL);";
$max['max']++;
$INSERT[] ="INSERT INTO permission_index (perm_id, app, perm_type, perm_type_id, perm_view, perm_2, perm_3, perm_4, perm_5, perm_6, perm_7, owner_only, friend_only, authorized_users) VALUES ({$max['max']}, 'forums', 'forum', 2, '*', '*', '*', '*', ',4,3,', ',4,3,', '', 0, 0, NULL);";
$INSERT[] = "SET IDENTITY_INSERT permission_index OFF";


$INSERT[] = "SET IDENTITY_INSERT forum_perms ON";
$INSERT[] = "INSERT INTO forum_perms (perm_id, perm_name) VALUES ('1', 'Validating Forum Set');";
$INSERT[] = "INSERT INTO forum_perms (perm_id, perm_name) VALUES ('2', 'Guest Forum Set');";
$INSERT[] = "INSERT INTO forum_perms (perm_id, perm_name) VALUES ('3', 'Member Forum Set');";
$INSERT[] = "INSERT INTO forum_perms (perm_id, perm_name) VALUES ('4', 'Admin Forum Set');";
$INSERT[] = "INSERT INTO forum_perms (perm_id, perm_name) VALUES ('5', 'Banned Forum Set');";
$INSERT[] = "INSERT INTO forum_perms (perm_id, perm_name) VALUES ('6', 'Moderator Forum Set');";
$INSERT[] = "SET IDENTITY_INSERT forum_perms OFF";

$INSERT[] = "SET IDENTITY_INSERT posts ON";
$INSERT[] = "INSERT INTO posts (pid, append_edit, edit_time, author_id, author_name, use_sig, use_emo, ip_address, post_date, icon_id, post, queued, topic_id, post_title, new_topic, edit_name, post_key, post_parent, post_htmlstate, post_edit_reason) VALUES (1, 0, NULL, 1, '<%admin_name%>', 0, 1, '127.0.0.1', <%time%>, 0, 'Welcome to your new Invision Power Board&#33;<br /><br />  <br /><br /> Congratulations on your purchase of our software and setting up your community.  Please take some time and read through the Getting Started Guide and Administrator Documentation.  The Getting Started Guide will walk you through some of the necessary steps to setting up an IP.Board and starting your community. The Administrator Documentation takes you through the details of the capabilities of IP.Board.<br /><br />  <br /><br /> You can remove this message, topic, forum or even category at any time.<br /><br />  <br /><br /> [url=http://external.ipslink.com/ipboard30/landing/?p=docs-ipb]Go to the documentation now...[/url]', 0, 1, NULL, 1, NULL, '0', 0, 0, '');";
$INSERT[] = "SET IDENTITY_INSERT posts OFF";

# TOPICS: seo_first_name
$INSERT[] = "SET IDENTITY_INSERT topics ON";
$INSERT[] = "INSERT INTO topics (tid, title, description, state, posts, starter_id, start_date, last_poster_id, last_post, icon_id, starter_name, last_poster_name, poll_state, last_vote, views, forum_id, approved, author_mode, pinned, moved_to, total_votes, topic_hasattach, topic_firstpost, topic_queuedposts, topic_open_time, topic_close_time, topic_rating_total, topic_rating_hits, title_seo, seo_last_name, seo_first_name ) VALUES (1, 'Welcome', '', 'open', 0, 1, <%time%>, 1, <%time%>, 0, '<%admin_name%>', '<%admin_name%>', '0', 0, 1, 2, 1, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 'welcome', '<%admin_seoname%>', '<%admin_seoname%>' );";
$INSERT[] = "SET IDENTITY_INSERT topics OFF";

?>