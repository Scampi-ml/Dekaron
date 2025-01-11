<?php

$SQL[]	= "UPDATE core_applications SET app_title='IP.Content' WHERE app_directory='ccs';";

$SQL[] = "CREATE INDEX page_content_type ON ccs_pages ( page_content_type );";

$SQL[]	= "CREATE TABLE ccs_database_fields (
  field_id INT NOT NULL IDENTITY,
  field_database_id INT NOT NULL,
  field_name varchar(255) NOT NULL,
  field_description VARCHAR( MAX ),
  field_key varchar(255) NOT NULL,
  field_type varchar(255) NULL,
  field_required BIT NOT NULL default '0',
  field_user_editable BIT NOT NULL default '0',
  field_position INT NOT NULL default '0',
  field_max_length INT NOT NULL default '0',
  field_extra VARCHAR( MAX ),
  PRIMARY KEY  (field_id)
);";

$SQL[]	= "CREATE TABLE ccs_databases (
  database_id INT NOT NULL IDENTITY,
  database_name varchar(255) NOT NULL,
  database_key varchar(255) NOT NULL,
  database_database varchar(255) NULL,
  database_description VARCHAR( MAX ),
  database_field_count INT NOT NULL default '0',
  database_record_count INT NOT NULL default '0',
  database_template_listing INT NOT NULL default '0',
  database_template_display INT NOT NULL default '0',
  database_user_editable BIT NOT NULL default '0',
  database_all_editable BIT NOT NULL default '0',
  database_open BIT NOT NULL default '0',
  database_comments BIT NOT NULL default '0',
  database_rate BIT NOT NULL default '0',
  database_revisions BIT NOT NULL DEFAULT '0',
  PRIMARY KEY  (database_id)
);";

$SQL[]	= "ALTER TABLE ccs_page_templates ADD template_database SMALLINT NOT NULL DEFAULT '0';";

$SQL[] = "CREATE INDEX template_database ON ccs_page_templates ( template_database );";

$SQL[]	= "CREATE TABLE ccs_database_revisions (
revision_id INT NOT NULL IDENTITY,
revision_database_id INT NOT NULL,
revision_record_id INT NOT NULL,
revision_data VARCHAR( MAX ) NULL,
revision_date varchar(13) NOT NULL DEFAULT '0',
revision_member_id INT NOT NULL DEFAULT '0',
PRIMARY KEY  (revision_id)
);";

$SQL[]	= "CREATE TABLE ccs_attachments_map (
map_id INT NOT NULL IDENTITY,
map_attach_id INT NOT NULL DEFAULT '0',
map_database_id INT NOT NULL DEFAULT  '0',
map_field_id INT NOT NULL DEFAULT '0',
map_record_id INT NOT NULL DEFAULT '0',
PRIMARY KEY  (map_id)
);";

$SQL[]	= "CREATE TABLE ccs_database_ratings (
rating_id INT NOT NULL IDENTITY,
rating_user_id INT NOT NULL DEFAULT '0',
rating_database_id INT NOT NULL DEFAULT '0',
rating_record_id INT NOT NULL DEFAULT '0',
rating_rating INT NOT NULL DEFAULT '0',
rating_added VARCHAR( 13 ) NOT NULL DEFAULT '0',
rating_ip_address VARCHAR( 16 ) NOT NULL DEFAULT '0',
PRIMARY KEY  (rating_id)
);";

$SQL[]	= "CREATE TABLE ccs_database_comments (
comment_id INT NOT NULL IDENTITY,
comment_user INT NOT NULL DEFAULT '0',
comment_database_id INT NOT NULL DEFAULT '0',
comment_record_id INT NOT NULL DEFAULT '0',
comment_date VARCHAR( 13 ) NOT NULL DEFAULT '0',
comment_ip_address VARCHAR( 16 ) NOT NULL DEFAULT '0',
comment_post VARCHAR( MAX ) NULL,
PRIMARY KEY  (comment_id)
);";

$SQL[] = "CREATE UNIQUE INDEX database_key ON ccs_databases ( database_key );";
$SQL[] = "CREATE INDEX field_database_id ON ccs_database_fields ( field_database_id );";
$SQL[] = "CREATE INDEX field_key ON ccs_database_fields ( field_key );";
$SQL[] = "CREATE INDEX revision_database_id ON ccs_database_revisions ( revision_database_id , revision_record_id );";
$SQL[] = "CREATE INDEX revision_member_id ON ccs_database_revisions ( revision_member_id );";
$SQL[] = "CREATE INDEX map_database_id ON ccs_attachments_map ( map_database_id );";
$SQL[] = "CREATE INDEX map_attach_id ON ccs_attachments_map ( map_attach_id );";
$SQL[] = "CREATE INDEX rating_user_id ON ccs_database_ratings ( rating_user_id , rating_database_id , rating_record_id );";
$SQL[] = "CREATE INDEX comment_user ON ccs_database_comments ( comment_user );";

