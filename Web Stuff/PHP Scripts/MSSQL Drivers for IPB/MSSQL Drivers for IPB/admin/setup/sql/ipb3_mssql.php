<?php

/**
 * <pre>
 * Invision Power Services
 * IP.Board v3.1.4
 * SQL for upgrader
 * Last Updated: $Date: 2010-12-17 08:03:58 -0500 (Fri, 17 Dec 2010) $
 * </pre>
 *
 * @author 		Matt Mecham
 * @copyright	(c) 2001 - 2009 Invision Power Services, Inc.
 * @license		http://www.invisionpower.com/community/board/license.html
 * @package		IP.Board
 * @link		http://www.invisionpower.com
 * @since		1st December 2008
 * @version		$Revision: 7446 $
 *
 */

$UPGRADE_HISTORY_TABLE = "CREATE TABLE upgrade_history (
  upgrade_id 			INT NOT NULL IDENTITY,
  upgrade_version_id 	INT NOT NULL DEFAULT '0',
  upgrade_version_human VARCHAR(200) NOT NULL DEFAULT '',
  upgrade_date 			INT NOT NULL DEFAULT '0',
  upgrade_mid 			INT NOT NULL DEFAULT '0',
  upgrade_notes 		TEXT NULL,
  upgrade_app 			VARCHAR(32) NOT NULL DEFAULT 'core',
  PRIMARY KEY (upgrade_id)
);";

$UPGRADE_TABLE_FIELD   = "ALTER TABLE upgrade_history ADD upgrade_app VARCHAR(32) NOT NULL DEFAULT 'core'";

$UPGRADE_SESSION_TABLE = "CREATE TABLE upgrade_sessions (
	session_id				VARCHAR(32)	NOT NULL DEFAULT '',
	session_member_id		INT NOT NULL DEFAULT 0,
	session_member_key		VARCHAR(32) NOT NULL DEFAULT '',
	session_start_time		INT NOT NULL DEFAULT 0,
	session_current_time	INT NOT NULL DEFAULT 0,
	session_ip_address		VARCHAR(16) NOT NULL DEFAULT '',
	session_section			VARCHAR(32) NOT NULL DEFAULT '',
	session_post			TEXT NULL,
	session_get				TEXT NULL,
	session_data			TEXT NULL,
	session_extra			TEXT NULL
);";

$UPGRADE_TEMPLATE_PREVIOUS = "CREATE TABLE skin_templates_previous (
  p_template_id int NOT NULL IDENTITY,
  p_template_group varchar(255) NOT NULL DEFAULT '',
  p_template_content VARCHAR(MAX),
  p_template_name varchar(255) DEFAULT NULL,
  p_template_data VARCHAR(MAX) null,
  p_template_master_key	VARCHAR(100) NOT NULL DEFAULT '',
  p_template_long_version	VARCHAR(100) NOT NULL DEFAULT '',
  p_template_human_version	VARCHAR(100) NOT NULL DEFAULT '',
  PRIMARY KEY (p_template_id)
);";

$UPGRADE_CSS_PREVIOUS = "CREATE TABLE skin_css_previous (
  p_css_id int NOT NULL IDENTITY,
  p_css_group varchar(255) NOT NULL DEFAULT '0',
  p_css_content VARCHAR(MAX),
  p_css_app varchar(200) NOT NULL DEFAULT '0',
  p_css_attributes VARCHAR(MAX) null,
  p_css_modules varchar(250) NOT NULL DEFAULT '',
  p_css_master_key VARCHAR(100) NOT NULL DEFAULT '',
  p_css_long_version	VARCHAR(100) NOT NULL DEFAULT '',
  p_css_human_version	VARCHAR(100) NOT NULL DEFAULT '',
  PRIMARY KEY (p_css_id)
);";
