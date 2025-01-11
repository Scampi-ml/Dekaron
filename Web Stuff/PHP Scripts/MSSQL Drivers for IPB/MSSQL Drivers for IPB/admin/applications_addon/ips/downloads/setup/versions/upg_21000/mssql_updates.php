<?php

$SQL[] = "ALTER TABLE downloads_categories ADD cname_furl VARCHAR( 255 ) DEFAULT NULL;";
$SQL[] = "ALTER TABLE downloads_files ADD file_name_furl VARCHAR( 255 ) DEFAULT NULL;";
$SQL[] = "ALTER TABLE downloads_files ADD file_topicseoname VARCHAR( 255 ) DEFAULT NULL;";
$SQL[] = "ALTER TABLE downloads_files ADD file_post_key VARCHAR( 32 ) DEFAULT NULL;";
$SQL[] = "ALTER TABLE downloads_filebackup ADD b_records TEXT NULL;";


$TABLE[] = "CREATE TABLE downloads_urls (
  url_id VARCHAR( 32 ) NOT NULL,
  url_file INT NOT NULL DEFAULT '0',
  url_ip VARCHAR( 32 ) NULL,
  url_created VARCHAR( 13 ) NOT NULL DEFAULT '0',
  url_expires VARCHAR( 13 ) NOT NULL DEFAULT '0',
  PRIMARY KEY ( url_id )
);";

$SQL[] = "CREATE TABLE downloads_files_records (
  record_id int NOT NULL IDENTITY,
  record_post_key varchar(32) default NULL,
  record_file_id int NOT NULL default '0',
  record_type varchar(32) NOT NULL default 'file',
  record_location text null,
  record_db_id int NOT NULL default '0',
  record_thumb text null,
  record_storagetype varchar(24) NOT NULL default 'web',
  record_realname varchar(255) default NULL,
  record_link_type varchar(255) default NULL,
  record_mime int NOT NULL default '0',
  record_size int NOT NULL default '0',
  record_backup bit NOT NULL default '0',
  PRIMARY KEY  (record_id)
);";

$SQL[] = "CREATE TABLE downloads_temp_records (
  record_id int NOT NULL IDENTITY,
  record_post_key varchar(32) default NULL,
  record_file_id int NOT NULL default '0',
  record_type varchar(32) NOT NULL default 'file',
  record_location text null,
  record_realname varchar(255) default NULL,
  record_mime int NOT NULL default '0',
  record_size int NOT NULL default '0',
  record_added varchar(13) NOT NULL default '0',
  PRIMARY KEY  (record_id)
);";


$SQL[] = "CREATE INDEX url_file ON downloads_urls ( url_file );";
$SQL[] = "CREATE INDEX record_post_key ON downloads_files_records ( record_post_key );";
$SQL[] = "CREATE INDEX record_file_id ON downloads_files_records ( record_file_id );";
$SQL[] = "CREATE INDEX record_db_id ON downloads_files_records ( record_db_id );";
$SQL[] = "CREATE INDEX record_realname ON downloads_files_records ( record_realname );";
$SQL[] = "CREATE INDEX record_type ON downloads_files_records ( record_type , record_file_id , record_backup );";
$SQL[] = "CREATE INDEX record_post_key ON downloads_temp_records ( record_post_key );";
$SQL[] = "CREATE INDEX record_file_id ON downloads_temp_records ( record_file_id );";
$SQL[] = "CREATE INDEX file_post_key ON downloads_files ( file_post_key );";

ipsRegistry::DB()->dropIndex( 'downloads_filestorage', 'storage_id' );
ipsRegistry::DB()->addIndex( 'downloads_filestorage', 'storage_id', 'storage_id', true );

