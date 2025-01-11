<?php

$SQL[] = "DROP TABLE downloads_ip2ext;";
$SQL[] = "ALTER TABLE downloads_downloads DROP COLUMN dcountry;";
$SQL[] = "UPDATE rc_classes SET app='downloads' WHERE my_class='downloads';";
$SQL[] = "ALTER TABLE downloads_cfields ADD cf_format VARCHAR( MAX ) NULL DEFAULT NULL;";
$SQL[] = "ALTER TABLE downloads_comments ADD comment_author VARCHAR( 255 ) NULL DEFAULT NULL;";
$SQL[] = "ALTER TABLE groups ADD idm_report_files TINYINT NOT NULL DEFAULT '0';";
$SQL[] = "UPDATE groups SET idm_report_files=1;";
$SQL[] = "ALTER TABLE groups ADD idm_view_downloads TINYINT NOT NULL DEFAULT '0';";
$SQL[] = "ALTER TABLE downloads_mods ADD modchangeauthor TINYINT NOT NULL DEFAULT '0';";
$SQL[] = "ALTER TABLE downloads_files ADD file_version VARCHAR( 32 ) NULL DEFAULT NULL;";
$SQL[] = "ALTER TABLE downloads_files ADD file_changelog VARCHAR( MAX ) NULL DEFAULT NULL;";
$SQL[] = "ALTER TABLE downloads_filebackup ADD b_version VARCHAR( 32 ) NULL DEFAULT NULL;";
$SQL[] = "ALTER TABLE downloads_filebackup ADD b_changelog VARCHAR( MAX ) NULL DEFAULT NULL;";
$SQL[] = "ALTER TABLE downloads_files_records ADD record_default TINYINT NOT NULL DEFAULT '0';";

$SQL[] = "DROP INDEX file_open ON downloads_files;";
$SQL[] = "CREATE INDEX file_open ON downloads_files ( file_open, file_cat, file_submitted );";

$SQL[] = "DELETE FROM core_sys_conf_settings WHERE conf_key='idm_allow_emaillinks';";
$SQL[] = "DELETE FROM core_sys_conf_settings WHERE conf_key='idm_comment_display';";
$SQL[] = "DELETE FROM core_sys_conf_settings WHERE conf_key='idm_guest_report';";