<?php
/**
* Installation Schematic File
* Generated on Tue, 04 May 2010 11:57:53 +0000 GMT
*/
$TABLE[] = "CREATE TABLE cal_calendars (
  cal_id BIGINT NOT NULL IDENTITY,
  cal_title VARCHAR(255) NOT NULL DEFAULT '0',
  cal_moderate SMALLINT NOT NULL DEFAULT '0',
  cal_position INT NOT NULL DEFAULT '0',
  cal_event_limit BIGINT NOT NULL DEFAULT '0',
  cal_bday_limit BIGINT NOT NULL DEFAULT '0',
  cal_rss_export SMALLINT NOT NULL DEFAULT '0',
  cal_rss_export_days BIGINT NOT NULL DEFAULT '0',
  cal_rss_export_max SMALLINT NOT NULL DEFAULT '0',
  cal_rss_update BIGINT NOT NULL DEFAULT '0',
  cal_rss_update_last BIGINT NOT NULL DEFAULT '0',
cal_rss_cache VARCHAR(MAX) NULL,
cal_permissions VARCHAR(MAX) NULL,
  PRIMARY KEY (cal_id)
);";
$TABLE[] = "CREATE TABLE cal_events (
  event_id BIGINT NOT NULL IDENTITY,
  event_calendar_id BIGINT NOT NULL DEFAULT '0',
  event_member_id INT NOT NULL DEFAULT '0',
event_content VARCHAR(MAX) NULL,
  event_title VARCHAR(255) NOT NULL DEFAULT '',
  event_smilies SMALLINT NOT NULL DEFAULT '0',
event_perms VARCHAR(MAX) NULL,
  event_private SMALLINT NOT NULL DEFAULT '0',
  event_approved SMALLINT NOT NULL DEFAULT '0',
  event_unixstamp BIGINT NOT NULL DEFAULT '0',
  event_recurring BIGINT NOT NULL DEFAULT '0',
  event_tz VARCHAR( 4 ) NOT NULL DEFAULT '0',
  event_timeset VARCHAR(6) NOT NULL DEFAULT '0',
  event_unix_from BIGINT NOT NULL DEFAULT '0',
  event_unix_to BIGINT NOT NULL DEFAULT '0',
  event_all_day SMALLINT NOT NULL DEFAULT '0',
  PRIMARY KEY (event_id)
);";
$TABLE[] = "CREATE INDEX cal_rss_export ON cal_calendars ( cal_rss_export );";
$TABLE[] = "CREATE INDEX approved ON cal_events ( event_calendar_id,event_approved );";
$TABLE[] = "CREATE INDEX daterange ON cal_events ( event_approved,event_unix_from,event_unix_to );";
?>