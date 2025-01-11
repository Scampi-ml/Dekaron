<?php

$SQL[] = "CREATE TABLE downloads_sessions (
dsess_id VARCHAR( 32 ) NOT NULL ,
dsess_mid INT NOT NULL DEFAULT 0,
dsess_ip VARCHAR( 32 ) NULL ,
dsess_file INT NOT NULL DEFAULT 0,
dsess_start VARCHAR( 13 ) NOT NULL DEFAULT '0',
dsess_end VARCHAR( 13 ) NOT NULL DEFAULT '0',
PRIMARY KEY ( dsess_id )
);";
$SQL[] = "CREATE INDEX dsess_midip ON downloads_sessions( dsess_mid , dsess_ip );";

$SQL[] = "ALTER TABLE downloads_cfields ADD cf_topic TINYINT NOT NULL DEFAULT 0;";
$SQL[] = "ALTER TABLE downloads_cfields ADD cf_search TINYINT NOT NULL DEFAULT 0;";

$SQL[] = "ALTER TABLE downloads_comments ADD comment_append_edit TINYINT NOT NULL DEFAULT 0;";
$SQL[] = "ALTER TABLE downloads_comments ADD comment_edit_time VARCHAR( 11 ) NOT NULL DEFAULT '0';";
$SQL[] = "ALTER TABLE downloads_comments ADD comment_edit_name VARCHAR( 255 ) NULL;";
$SQL[] = "ALTER TABLE downloads_comments ADD ip_address VARCHAR( 32 ) NULL;";
$SQL[] = "ALTER TABLE downloads_comments ADD use_sig TINYINT NOT NULL DEFAULT 1;";
$SQL[] = "ALTER TABLE downloads_comments ADD use_emo TINYINT NOT NULL DEFAULT 1;";

$SQL[] = "ALTER TABLE downloads_files ADD file_broken_info VARCHAR( 255 ) NULL;";
