<?php
/**
* Installation Schematic File
* Generated on Tue, 04 May 2010 11:57:53 +0000 GMT
*/
$TABLE[] = "CREATE TABLE downloads_categories (
  cid INT NOT NULL IDENTITY,
  cparent INT NOT NULL DEFAULT '0',
  cname VARCHAR(255) NOT NULL DEFAULT '',
cdesc VARCHAR(MAX) NULL,
  copen SMALLINT NOT NULL DEFAULT '0',
  cposition INT NOT NULL DEFAULT '0',
cperms VARCHAR(MAX) NULL,
coptions VARCHAR(MAX) NULL,
ccfields VARCHAR(MAX) NULL,
cfileinfo VARCHAR(MAX) NULL,
cdisclaimer VARCHAR(MAX) NULL,
  cname_furl VARCHAR(255) NULL,
  PRIMARY KEY (cid)
);";
$TABLE[] = "CREATE TABLE downloads_ccontent (
  file_id INT NOT NULL DEFAULT '0',
  updated INT DEFAULT '0',
  PRIMARY KEY (file_id)
);";
$TABLE[] = "CREATE TABLE downloads_cfields (
  cf_id SMALLINT NOT NULL IDENTITY,
  cf_title VARCHAR(250) NOT NULL DEFAULT '',
  cf_desc VARCHAR(250) NOT NULL DEFAULT '',
cf_content VARCHAR(MAX) NULL,
  cf_type VARCHAR(250) NOT NULL DEFAULT '',
  cf_not_null SMALLINT NOT NULL DEFAULT '0',
  cf_max_input SMALLINT NOT NULL DEFAULT '0',
cf_input_format VARCHAR(MAX) NULL,
cf_file_format VARCHAR(MAX) NULL,
  cf_position SMALLINT NOT NULL DEFAULT '0',
  cf_topic SMALLINT NOT NULL DEFAULT '0',
  cf_search SMALLINT NOT NULL DEFAULT '0',
  cf_format VARCHAR( MAX ) NULL DEFAULT NULL,
  PRIMARY KEY (cf_id)
);";
$TABLE[] = "CREATE TABLE downloads_comments (
  comment_id INT NOT NULL IDENTITY,
  comment_fid INT NOT NULL DEFAULT '0',
  comment_mid INT NOT NULL DEFAULT '0',
  comment_date VARCHAR(13) NOT NULL DEFAULT '0',
  comment_open SMALLINT NOT NULL DEFAULT '0',
comment_text VARCHAR(MAX) NULL,
  comment_append_edit SMALLINT NOT NULL DEFAULT '0',
  comment_edit_time VARCHAR(11) NOT NULL DEFAULT '0',
  comment_edit_name VARCHAR(255) NULL,
  ip_address VARCHAR(32) NULL,
  use_sig SMALLINT NOT NULL DEFAULT '1',
  use_emo SMALLINT NOT NULL DEFAULT '1',
  comment_author VARCHAR( 255 ),
  PRIMARY KEY (comment_id)
);";
$TABLE[] = "CREATE TABLE downloads_downloads (
  did INT NOT NULL IDENTITY,
  dfid INT NOT NULL DEFAULT '0',
  dtime VARCHAR(13) NOT NULL DEFAULT '0',
  dip VARCHAR(55) NOT NULL DEFAULT '0',
  dmid INT NOT NULL DEFAULT '0',
  dsize INT NOT NULL DEFAULT '0',
  dua VARCHAR(255) NULL,
  dbrowsers VARCHAR(25) NOT NULL DEFAULT '',
  dos VARCHAR(25) NOT NULL DEFAULT '',
  PRIMARY KEY (did)
);";
$TABLE[] = "CREATE TABLE downloads_favorites (
  fid INT NOT NULL IDENTITY,
  fmid INT NOT NULL DEFAULT '0',
  ffid INT NOT NULL DEFAULT '0',
  fupdated VARCHAR(13) NOT NULL DEFAULT '0',
  PRIMARY KEY (fid)
);";
$TABLE[] = "CREATE TABLE downloads_filebackup (
  b_id INT NOT NULL IDENTITY,
  b_fileid INT NOT NULL DEFAULT '0',
  b_filetitle VARCHAR(255) NOT NULL DEFAULT '0',
b_filedesc VARCHAR(MAX) NULL,
  b_hidden SMALLINT NOT NULL DEFAULT '0',
  b_backup VARCHAR(13) NOT NULL DEFAULT '0',
  b_updated VARCHAR(13) NOT NULL DEFAULT '0',
b_records VARCHAR(MAX) NULL,
b_version VARCHAR( 32 ) NULL DEFAULT NULL,
b_changelog VARCHAR( MAX ) NULL DEFAULT NULL,
  PRIMARY KEY (b_id)
);";
$TABLE[] = "CREATE TABLE downloads_files (
  file_id INT NOT NULL IDENTITY CONSTRAINT PK_file_id PRIMARY KEY,
  file_name VARCHAR(255) NOT NULL DEFAULT '0',
  file_cat INT NOT NULL DEFAULT '0',
  file_open SMALLINT NOT NULL DEFAULT '0',
  file_broken SMALLINT NOT NULL DEFAULT '0',
file_broken_reason VARCHAR(MAX) NULL,
  file_broken_info VARCHAR(255) NULL,
  file_views INT NOT NULL DEFAULT '0',
  file_downloads INT NOT NULL DEFAULT '0',
  file_submitted VARCHAR(13) NOT NULL DEFAULT '0',
  file_updated VARCHAR(13) NOT NULL DEFAULT '0',
file_desc VARCHAR(MAX) NULL,
  file_size INT NOT NULL DEFAULT '0',
  file_submitter INT NOT NULL DEFAULT '0',
  file_approver INT NOT NULL DEFAULT '0',
  file_approvedon VARCHAR(13) NOT NULL DEFAULT '0',
  file_topicid INT NOT NULL DEFAULT '0',
  file_pendcomments SMALLINT NOT NULL DEFAULT '0',
  file_ipaddress VARCHAR(50) NOT NULL DEFAULT '0',
file_sub_mems VARCHAR(MAX) NULL,
file_votes VARCHAR(MAX) NULL,
  file_rating SMALLINT NOT NULL DEFAULT '0',
  file_new SMALLINT NOT NULL DEFAULT '0',
  file_placeholder SMALLINT NOT NULL DEFAULT '0',
  file_name_furl VARCHAR(255) NULL,
  file_topicseoname VARCHAR(255) NULL,
  file_post_key VARCHAR(32) NOT NULL,
  file_cost float NOT NULL DEFAULT '0.00',
  file_nexus VARCHAR(MAX) NOT NULL DEFAULT '',
  file_version VARCHAR( 32 ) NULL DEFAULT NULL,
  file_changelog VARCHAR( MAX ) NULL DEFAULT NULL,
  file_renewal_term INT NOT NULL DEFAULT 0,
  file_renewal_units CHAR(1) NULL DEFAULT NULL,
  file_renewal_price FLOAT NOT NULL DEFAULT '0.00',
  file_featured TINYINT NOT NULL DEFAULT '0',
  file_pinned TINYINT NOT NULL DEFAULT '0',
  file_comments INT NOT NULL DEFAULT '0'
);";
$TABLE[] = "CREATE TABLE downloads_files_records (
  record_id INT NOT NULL IDENTITY,
  record_post_key VARCHAR(32) NOT NULL,
  record_file_id INT NOT NULL DEFAULT '0',
  record_type VARCHAR(32) NOT NULL DEFAULT 'file',
record_location VARCHAR(MAX) NULL,
  record_db_id INT NOT NULL DEFAULT '0',
record_thumb VARCHAR(MAX) NULL,
  record_storagetype VARCHAR(24) NOT NULL DEFAULT 'web',
  record_realname VARCHAR(255) NOT NULL,
  record_link_type VARCHAR(255) NULL,
  record_mime SMALLINT NOT NULL DEFAULT '0',
  record_size INT NOT NULL DEFAULT '0',
  record_backup SMALLINT NOT NULL DEFAULT '0',
  record_default TINYINT NOT NULL DEFAULT '0',
  PRIMARY KEY (record_id)
);";
$TABLE[] = "CREATE TABLE downloads_filestorage (
  storage_id INT NOT NULL IDENTITY,
  storage_file VARBINARY(MAX),
  storage_ss VARBINARY(MAX),
  storage_thumb VARBINARY(MAX),
  PRIMARY KEY (storage_id)
);";
$TABLE[] = "CREATE TABLE downloads_fileviews (
  view_id INT NOT NULL IDENTITY,
  view_fid INT NOT NULL DEFAULT '0',
  PRIMARY KEY (view_id)
);";

$TABLE[] = "CREATE TABLE downloads_mime (
  mime_id INT NOT NULL IDENTITY,
  mime_extension VARCHAR(18) NOT NULL DEFAULT '',
  mime_mimetype VARCHAR(255) NOT NULL DEFAULT '',
mime_file VARCHAR(MAX) NULL,
mime_screenshot VARCHAR(MAX) NULL,
mime_inline VARCHAR(MAX) NULL,
mime_img VARCHAR(MAX) NULL,
  PRIMARY KEY (mime_id)
);";
$TABLE[] = "CREATE TABLE downloads_mimemask (
  mime_maskid INT NOT NULL IDENTITY,
  mime_masktitle VARCHAR(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (mime_maskid)
);";
$TABLE[] = "CREATE TABLE downloads_mods (
  modid INT NOT NULL IDENTITY,
  modtype SMALLINT NOT NULL DEFAULT '0',
  modgmid VARCHAR(255) NOT NULL DEFAULT '0',
  modcanedit SMALLINT NOT NULL DEFAULT '0',
  modcandel SMALLINT NOT NULL DEFAULT '0',
  modcanapp SMALLINT NOT NULL DEFAULT '0',
  modcanbrok SMALLINT NOT NULL DEFAULT '0',
  modcancomments SMALLINT NOT NULL DEFAULT '0',
modcats VARCHAR(MAX) NULL,
modchangeauthor TINYINT NOT NULL DEFAULT '0',
modusefeature TINYINT NOT NULL DEFAULT '0',
modcanpin TINYINT NOT NULL DEFAULT '0',
  PRIMARY KEY (modid)
);";
$TABLE[] = "CREATE TABLE downloads_sessions (
  dsess_id VARCHAR(32) NOT NULL,
  dsess_mid INT NOT NULL DEFAULT '0',
  dsess_ip VARCHAR(32) NULL,
  dsess_file INT NOT NULL DEFAULT '0',
  dsess_start VARCHAR(13) NOT NULL DEFAULT '0',
  dsess_end VARCHAR(13) NOT NULL DEFAULT '0',
  PRIMARY KEY (dsess_id)
);";
$TABLE[] = "CREATE TABLE downloads_temp_records (
  record_id INT NOT NULL IDENTITY,
  record_post_key VARCHAR(32) NOT NULL,
  record_file_id INT NOT NULL DEFAULT '0',
  record_type VARCHAR(32) NOT NULL DEFAULT 'file',
record_location VARCHAR(MAX) NULL,
  record_realname VARCHAR(255) NULL,
  record_mime SMALLINT NOT NULL DEFAULT '0',
  record_size INT NOT NULL DEFAULT '0',
  record_added VARCHAR(13) NOT NULL DEFAULT '0',
  PRIMARY KEY (record_id)
);";

$TABLE[] = "CREATE TABLE downloads_urls (
  url_id VARCHAR(32) NOT NULL,
  url_file INT NOT NULL DEFAULT '0',
  url_ip VARCHAR(32) NULL,
  url_created VARCHAR(13) NOT NULL DEFAULT '0',
  url_expires VARCHAR(13) NOT NULL DEFAULT '0',
  PRIMARY KEY (url_id)
);";
$TABLE[] = "CREATE INDEX cparent ON downloads_categories ( cparent );";
$TABLE[] = "CREATE INDEX position_order ON downloads_categories ( cparent,cposition );";
$TABLE[] = "CREATE INDEX cf_position ON downloads_cfields ( cf_position );";
$TABLE[] = "CREATE INDEX comment_fid ON downloads_comments ( comment_fid );";
$TABLE[] = "CREATE INDEX dfid ON downloads_downloads ( dfid,dsize );";
$TABLE[] = "CREATE INDEX dmid ON downloads_downloads ( dmid );";
$TABLE[] = "CREATE INDEX ffid ON downloads_favorites ( ffid );";
$TABLE[] = "CREATE INDEX fmid ON downloads_favorites ( fmid );";
$TABLE[] = "CREATE INDEX b_fileid ON downloads_filebackup ( b_fileid );";
$TABLE[] = "CREATE INDEX file_views ON downloads_files ( file_views );";
$TABLE[] = "CREATE INDEX file_downloads ON downloads_files ( file_downloads );";
$TABLE[] = "CREATE INDEX file_cat ON downloads_files ( file_cat );";
$TABLE[] = "CREATE INDEX file_submitter ON downloads_files ( file_submitter );";
$TABLE[] = "CREATE INDEX file_broken ON downloads_files ( file_broken );";
$TABLE[] = "CREATE INDEX file_open ON downloads_files ( file_open, file_cat, file_submitted );";
$TABLE[] = "CREATE INDEX file_rating ON downloads_files ( file_rating );";
$TABLE[] = "CREATE INDEX file_post_key ON downloads_files ( file_post_key );";
$TABLE[] = "CREATE INDEX record_post_key ON downloads_files_records ( record_post_key );";
$TABLE[] = "CREATE INDEX record_file_id ON downloads_files_records ( record_file_id );";
$TABLE[] = "CREATE INDEX record_db_id ON downloads_files_records ( record_db_id );";
$TABLE[] = "CREATE INDEX record_realname ON downloads_files_records ( record_realname );";
$TABLE[] = "CREATE INDEX record_type ON downloads_files_records ( record_type,record_file_id,record_backup );";
$TABLE[] = "CREATE INDEX dsess_mid ON downloads_sessions ( dsess_mid,dsess_ip );";
$TABLE[] = "CREATE INDEX dsess_start ON downloads_sessions ( dsess_start );";
$TABLE[] = "CREATE INDEX record_post_key ON downloads_temp_records ( record_post_key );";
$TABLE[] = "CREATE INDEX record_file_id ON downloads_temp_records ( record_file_id );";
$TABLE[] = "CREATE INDEX url_file ON downloads_urls ( url_file );";
$TABLE[] = "CREATE INDEX url_expires ON downloads_urls ( url_expires );";
$TABLE[] = "CREATE INDEX file_featured ON downloads_files ( file_featured );";
$TABLE[] = "CREATE INDEX record_added ON downloads_temp_records ( record_added );";
$TABLE[] = "CREATE INDEX dtime ON downloads_downloads ( dtime );";

$TABLE[] = "ALTER TABLE groups ADD idm_restrictions TEXT NULL;";
$TABLE[] = "ALTER TABLE groups ADD idm_bypass_paid INT NULL;";
$TABLE[] = "ALTER TABLE groups ADD idm_add_paid INT NULL;";
$TABLE[] = "ALTER TABLE groups ADD idm_report_files TINYINT NOT NULL DEFAULT '0';";
$TABLE[] = "ALTER TABLE groups ADD idm_view_downloads TINYINT NOT NULL DEFAULT '0';";
$TABLE[] = "ALTER TABLE groups ADD idm_bypass_revision TINYINT NOT NULL DEFAULT '0';";
