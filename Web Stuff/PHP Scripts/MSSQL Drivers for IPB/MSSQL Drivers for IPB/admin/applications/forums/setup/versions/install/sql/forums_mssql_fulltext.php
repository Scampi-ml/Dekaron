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
$INDEX[] = "sp_fulltext_table 'posts', 'Create', 'ftcatalog', 'PK_pid'";
$INDEX[] = "sp_fulltext_column 'posts', 'post', 'add'";
$INDEX[] = "sp_fulltext_table 'posts', 'activate'";
$INDEX[] = "sp_fulltext_table 'posts', 'Start_change_tracking'";
$INDEX[] = "sp_fulltext_table 'posts', 'Start_background_updateindex'";
$INDEX[] = "sp_fulltext_table 'topics', 'Create', 'ftcatalog', 'PK_tid'";
$INDEX[] = "sp_fulltext_column 'topics', 'title', 'add'";
$INDEX[] = "sp_fulltext_table 'topics', 'activate'";
$INDEX[] = "sp_fulltext_table 'topics', 'Start_change_tracking'";
$INDEX[] = "sp_fulltext_table 'topics', 'Start_background_updateindex'";
?>