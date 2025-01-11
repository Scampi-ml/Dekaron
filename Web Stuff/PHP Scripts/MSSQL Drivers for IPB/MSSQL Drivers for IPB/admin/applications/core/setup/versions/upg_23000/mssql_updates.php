<?php
/*
+--------------------------------------------------------------------------
|   IP.Board v3.1.4
|   ========================================
|   by Matthew Mecham
|   (c) 2001 - 2004 Invision Power Services
|   http://www.invisionpower.com
|   ========================================
|   Web: http://www.invisionboard.com
|   Email: matt@invisionpower.com
|   Licence Info: http://www.invisionboard.com/?license
+---------------------------------------------------------------------------
*/
$SQL = array();
$DB  = ipsRegistry::DB();
$PRE = ipsRegistry::dbFunctions()->getPrefix();

if ( $this->DB->checkForField( "forums", "last_title" ) )
{
	$DB->changeField('forums', 'last_title', 'last_title', 'varchar(250)');
}
else
{
	$SQL[] = "ALTER TABLE forums ADD last_title VARCHAR(250) NULL";
}

if ( !$this->DB->checkForField( "forums", "last_id" ) )
{
	$SQL[] = "ALTER TABLE forums ADD last_id INT NULL";	
}

$DB->changeField('forums', 'newest_title', 'newest_title', 'varchar(250)');

$SQL[] = "CREATE TABLE skin_url_mapping (
	map_id			int NOT NULL IDENTITY,
	map_title		VARCHAR(200) NOT NULL default '',
	map_match_type	VARCHAR(10) NOT NULL default 'contains',
	map_url			VARCHAR(200) NOT NULL default '',
	map_skin_set_id	INT NOT NULL default 0,
	map_date_added	INT NOT NULL default 0,
	PRIMARY KEY (map_id)
);";

$DB->addField('mail_queue', 'mail_html_on', 'tinyint', '0');
$DB->addField('skin_templates', 'group_names_secondary', 'text');

$SQL[] = "CREATE TABLE skin_template_links (
	link_id				INT NOT NULL IDENTITY,
	link_set_id			INT default 0 NOT NULL,
	link_group_name		VARCHAR(255) NULL,
	link_template_name	VARCHAR(255) NULL,
	link_used_in		VARCHAR(255) NULL,
	PRIMARY KEY (link_id)
);";

$DB->changeField('profile_portal', 'pp_main_width', 'pp_main_width', 'smallint');
$DB->changeField('profile_portal', 'pp_main_height', 'pp_main_height', 'smallint');
$DB->changeField('profile_portal', 'pp_thumb_width', 'pp_thumb_width', 'smallint');
$DB->changeField('profile_portal', 'pp_thumb_height', 'pp_thumb_height', 'smallint');