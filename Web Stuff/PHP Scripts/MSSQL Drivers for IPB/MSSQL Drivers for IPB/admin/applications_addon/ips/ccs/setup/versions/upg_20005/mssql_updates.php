<?php

$SQL[]	= "ALTER TABLE ccs_database_fields ADD field_validator TEXT NULL;";

$SQL[]	= "ALTER TABLE ccs_databases ADD database_rss VARCHAR( 255 ) NOT NULL DEFAULT '0',
database_rss_cache VARCHAR(MAX) NULL,
database_field_content VARCHAR( 255 ) NULL,
database_lang_sl VARCHAR( 255 ) NOT NULL DEFAULT '',
database_lang_pl VARCHAR( 255 ) NOT NULL DEFAULT '',
database_lang_su VARCHAR( 255 ) NOT NULL DEFAULT '',
database_lang_pu VARCHAR( 255 ) NOT NULL DEFAULT '',
database_comment_bump BIT NOT NULL DEFAULT '0',
database_featured_article INT NOT NULL DEFAULT '0',
database_is_articles BIT NOT NULL DEFAULT '0',
database_meta_keywords VARCHAR(MAX) NULL,
database_meta_description VARCHAR(MAX) NULL,
database_forum_record BIT NOT NULL DEFAULT '0',
database_forum_comments BIT NOT NULL DEFAULT '0',
database_forum_delete BIT NOT NULL DEFAULT '0',
database_forum_forum INT NOT NULL DEFAULT '0',
database_forum_prefix VARCHAR( 255 ) NULL,
database_forum_suffix VARCHAR( 255 ) NULL;";

$SQL[] = "CREATE INDEX database_is_articles ON ccs_databases ( database_is_articles );";

$SQL[]	= "ALTER TABLE ccs_database_categories ADD category_rss VARCHAR( 255 ) NULL DEFAULT '0',
category_rss_cache VARCHAR(MAX) NULL,
category_furl_name VARCHAR( 255 ) NULL,
category_meta_keywords VARCHAR(MAX) NULL,
category_meta_description VARCHAR(MAX) NULL,
category_template INT NOT NULL DEFAULT '0',
category_forum_override BIT NOT NULL DEFAULT '0',
category_forum_record BIT NOT NULL DEFAULT '0',
category_forum_comments BIT NOT NULL DEFAULT '0',
category_forum_delete BIT NOT NULL DEFAULT '0',
category_forum_forum INT NOT NULL DEFAULT '0',
category_forum_prefix VARCHAR( 255 ) NULL,
category_forum_suffix VARCHAR( 255 ) NULL;";

$SQL[] = "CREATE INDEX category_template ON ccs_database_categories ( category_template );";

$SQL[]	= "CREATE TABLE ccs_database_modqueue (
  mod_id INT NOT NULL IDENTITY,
  mod_database INT NOT NULL default '0',
  mod_record INT NOT NULL default '0',
  mod_comment INT NOT NULL default '0',
  mod_poster INT NOT NULL default '0',
  PRIMARY KEY  (mod_id)
);";

$SQL[] = "CREATE INDEX mod_database ON ccs_database_modqueue ( mod_database,mod_record,mod_comment );";

$SQL[]	= "CREATE TABLE ccs_database_notifications (
  notify_id INT NOT NULL IDENTITY,
  notify_member INT NOT NULL default '0',
  notify_database INT NOT NULL default '0',
  notify_record INT NOT NULL default '0',
  notify_category INT NOT NULL default '0',
  notify_start INT NOT NULL default '0',
  notify_last_sent INT NOT NULL default '0',
  PRIMARY KEY  (notify_id)
);";

$SQL[] = "CREATE INDEX notify_member ON ccs_database_notifications ( notify_member );";
$SQL[] = "CREATE INDEX notify_category ON ccs_database_notifications ( notify_category,notify_database );";
$SQL[] = "CREATE INDEX notify_record ON ccs_database_notifications ( notify_record,notify_database );";

$SQL[]	= "ALTER TABLE ccs_database_moderators ADD moderator_add_record BIT NOT NULL DEFAULT '0';";

//-----------------------------------------
// @link	http://community.invisionpower.com/tracker/issue-21631-mssql-wizard-description-not-null/
//-----------------------------------------

$DB  = ipsRegistry::DB();
$DB->changeField( 'ccs_page_wizard', 'wizard_description', 'wizard_description', 'VARCHAR( MAX )' );


