<?php
/**
* Installation Schematic File
* Generated on Tue, 27 Jan 2009 09:07:50 +0000 GMT
*/
$INDEX[] = "sp_fulltext_database 'enable'";
$INDEX[] = "IF (select FULLTEXTCATALOGPROPERTY ( 'ftcatalog', 'PopulateStatus' )) IS NULL
BEGIN
	exec sp_fulltext_catalog 'ftcatalog', 'create'
END";
$INDEX[] = "sp_fulltext_table 'message_posts', 'Create', 'ftcatalog', 'PK_msg_id'";
$INDEX[] = "sp_fulltext_column 'message_posts', 'msg_post', 'add'";
$INDEX[] = "sp_fulltext_table 'message_posts', 'activate'";
$INDEX[] = "sp_fulltext_table 'message_posts', 'Start_change_tracking'";
$INDEX[] = "sp_fulltext_table 'message_posts', 'Start_background_updateindex'";
$INDEX[] = "sp_fulltext_table 'message_topics', 'Create', 'ftcatalog', 'PK_mt_id'";
$INDEX[] = "sp_fulltext_column 'message_topics', 'mt_title', 'add'";
$INDEX[] = "sp_fulltext_table 'message_topics', 'activate'";
$INDEX[] = "sp_fulltext_table 'message_topics', 'Start_change_tracking'";
$INDEX[] = "sp_fulltext_table 'message_topics', 'Start_background_updateindex'";
?>