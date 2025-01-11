<?php

$SQL[] = "ALTER TABLE downloads_files ADD file_url VARCHAR( 255 ) NULL";
$SQL[] = "ALTER TABLE downloads_files ADD file_ssurl VARCHAR( 255 ) NULL";
$SQL[] = "ALTER TABLE downloads_files ADD file_realname VARCHAR( 255 ) NULL";
$SQL[] = "ALTER TABLE downloads_files ADD file_broken_reason TEXT NULL;";

$SQL[] = "ALTER TABLE groups ADD idm_restrictions TEXT NULL;";

$SQL[] = "CREATE TABLE downloads_filebackup (
b_id INT NOT NULL IDENTITY,
b_fileid INT NOT NULL DEFAULT 0,
b_filetitle VARCHAR( 255 ) NOT NULL DEFAULT '0',
b_filedesc TEXT NULL ,
b_filename VARCHAR( 255 ) NOT NULL DEFAULT '0',
b_ssname VARCHAR( 255 ) NOT NULL DEFAULT '0',
b_thumbname VARCHAR( 255 ) NOT NULL DEFAULT '0',
b_filemime INT NOT NULL DEFAULT 0,
b_ssmime INT NOT NULL DEFAULT 0,
b_filemeta TEXT NULL ,
b_storage VARCHAR( 10 ) NOT NULL DEFAULT 'web',
b_hidden TINYINT NOT NULL DEFAULT 0,
b_backup VARCHAR( 13 ) NOT NULL DEFAULT '0',
b_updated VARCHAR( 13 ) NOT NULL DEFAULT '0',
b_fileurl VARCHAR( 255 ) NULL ,
b_ssurl VARCHAR( 255 ) NULL ,
PRIMARY KEY( b_id )
)";
$SQL[] = "CREATE INDEX b_fileid ON downloads_filebackup( b_fileid )";

