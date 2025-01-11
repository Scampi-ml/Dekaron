<?php

// Add comment_approved for new comments functionality:
$SQL[] = "ALTER TABLE blog_comments ADD comment_approved INT DEFAULT '0'";
$SQL[] = "UPDATE blog_comments SET comment_approved = 1 WHERE comment_queued = 0";
$SQL[] = "UPDATE blog_comments SET comment_approved = 0 WHERE comment_queued = 1";

// Get DB prefix:
$PRE = ipsRegistry::dbFunctions()->getPrefix();
$DB  = ipsRegistry::DB();

// Convert tracker to like:
if ( $DB->checkForTable('blog_tracker') )
{
	$SQL[] = "INSERT INTO core_like ( like_id, like_lookup_id, like_app, like_area, like_rel_id, like_member_id, like_is_anon, like_added, like_notify_do, like_notify_freq ) SELECT " . $DB->buildMd5Statement( "'blog;blog;' + CONVERT( varchar, blog_id ) + ';' + CONVERT( varchar, member_id )" ) . " AS like_id, " . $DB->buildMd5Statement( "'blog;blog;' + CONVERT( varchar, blog_id )" ) . " AS like_lookup_id, 'blog' AS like_app, 'blog' AS like_area, blog_id AS like_rel_id, member_id AS like_member_id, 0 AS like_is_anon, '" . time() . "' AS like_added, 1 AS like_notify_do, 'immediate' AS like_notify_freq FROM blog_tracker;";
	
	$SQL[] = "INSERT INTO core_like ( like_id, like_lookup_id, like_app, like_area, like_rel_id, like_member_id, like_is_anon, like_added, like_notify_do, like_notify_freq ) SELECT " . $DB->buildMd5Statement( "'blog;entries;' + CONVERT( varchar, entry_id ) + ';' + CONVERT( varchar, member_id )" ) . " AS like_id, " . $DB->buildMd5Statement( "'blog;entries;' + CONVERT( varchar, entry_id )" ) . " AS like_lookup_id, 'blog' AS like_app, 'entries' AS like_area, entry_id AS like_rel_id, member_id AS like_member_id, 0 AS like_is_anon, '" . time() . "' AS like_added, 1 AS like_notify_do, 'immediate' AS like_notify_freq FROM blog_tracker WHERE entry_id <> 0 AND entry_id IS NOT NULL;";

	$SQL[] = "DROP TABLE blog_tracker;";
	$SQL[] = "DROP TABLE blog_tracker_queue;";
}

// Fix for bug #25360 - http://community.invisionpower.com/tracker/issue-25360-report-plugin-not-updated-properly/
$SQL[] = "UPDATE rc_classes SET app = 'blog' WHERE my_class = 'blog'";