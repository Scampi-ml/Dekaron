<?php

$SQL[] = "ALTER TABLE blog_lastinfo ADD blog_last_entry_excerpt TEXT NULL ";

$SQL[] = "CREATE TABLE blog_akismet_logs (
  log_id int NOT NULL identity,
  log_date varchar(13) NOT NULL default '0',
  log_msg varchar(255) default NULL,
  log_errors text null,
  log_data text null,
  log_type varchar(32) default NULL,
  log_etbid int NOT NULL default 0,
  log_isspam tinyint NOT NULL default 0,
  log_action varchar(255) default NULL,
  log_submitted tinyint NOT NULL default 0,
  log_connect_error tinyint NOT NULL default 0,
  PRIMARY KEY  (log_id)
)";
$SQL[] = "CREATE INDEX log_etbid ON blog_akismet_logs(log_etbid)";

$SQL[] = "CREATE TABLE blog_headers (
header_id int NOT NULL identity,
header_on tinyint NOT NULL DEFAULT 0,
header_image VARCHAR( 255 ) NULL ,
header_tile VARCHAR( 255 ) NULL ,
header_opts TEXT NULL ,
PRIMARY KEY  (header_id)
)";
$SQL[] = "CREATE INDEX header_on ON blog_headers(header_on)";

$SQL[] = "CREATE TABLE blog_themes (
theme_id int NOT NULL identity ,
theme_on tinyint NOT NULL DEFAULT '0',
theme_css text NULL ,
theme_images VARCHAR( 255 ) NULL ,
theme_opts TEXT NULL ,
theme_name VARCHAR( 255 ) NULL ,
theme_author VARCHAR( 255 ) NULL ,
theme_homepage VARCHAR( 255 ) NULL ,
theme_email VARCHAR( 255 ) NULL ,
theme_desc TEXT NULL,
PRIMARY KEY  (theme_id)
)";
$SQL[] = "CREATE INDEX theme_on ON blog_themes(theme_on)";

$SQL[] = "CREATE TABLE blog_mediatag (
  mediatag_id int NOT NULL identity,
  mediatag_name varchar(255) NOT NULL,
  mediatag_match text NULL,
  mediatag_replace text NULL,
  PRIMARY KEY  (mediatag_id)
)";

$SQL[] = "ALTER TABLE blog_blogs ADD blog_theme_id INT NOT NULL DEFAULT 0";
$SQL[] = "ALTER TABLE blog_blogs ADD blog_theme_custom TEXT NULL ";
$SQL[] = "ALTER TABLE blog_blogs ADD blog_theme_final TEXT NULL";
$SQL[] = "ALTER TABLE blog_blogs ADD blog_theme_approved TINYINT NOT NULL DEFAULT 0";
$SQL[] = "ALTER TABLE blog_blogs ADD blog_header_id INT NOT NULL DEFAULT 0";
$SQL[] = "ALTER TABLE blog_blogs ADD blog_last_visitors TEXT NULL";

$SQL[] = "INSERT INTO cache_store (cs_key ,cs_value ,cs_extra ,cs_array) VALUES ('blog_headers', NULL , '', '1')";
$SQL[] = "INSERT INTO cache_store (cs_key ,cs_value ,cs_extra ,cs_array) VALUES ('blog_themes', NULL , '', '1')";

$SQL[] = "ALTER TABLE blog_cblocks ADD cblock_config TEXT NULL";

$SQL[] = "INSERT INTO blog_mediatag (mediatag_name, mediatag_match, mediatag_replace) VALUES ( 'YouTube', 'http://youtube.com/watch?v={1}', '<object width=\"425\" height=\"355\"><param name=\"movie\" value=\"http://youtube.com/v/\$1\"></param><param name=\"wmode\" value=\"transparent\"></param><embed src=\"http://youtube.com/v/\$1\" type=\"application/x-shockwave-flash\" wmode=\"transparent\" width=\"425\" height=\"355\"></embed></object>')";
$SQL[] = "INSERT INTO blog_mediatag (mediatag_name, mediatag_match, mediatag_replace) VALUES ( 'Google Video', 'http://video.google.com/videoplay?docid={1}', '<embed style=\"width:400px; height:326px;\" id=\"VideoPlayback\" type=\"application/x-shockwave-flash\" src=\"http://video.google.com/googleplayer.swf?docId=\$1&hl=en\" flashvars=\"\"> </embed>')";
$SQL[] = "INSERT INTO blog_mediatag (mediatag_name, mediatag_match, mediatag_replace) VALUES ( 'MySpace Video', 'http://vids.myspace.com/index.cfm?fuseaction=vids.individual(&amp;|&amp;amp;)VideoID={2}', '<embed src=\"http://lads.myspace.com/videos/vplayer.swf\" flashvars=\"m=\$2&v=2&type=video\" type=\"application/x-shockwave-flash\" width=\"430\" height=\"346\"></embed>')";
$SQL[] = "INSERT INTO blog_mediatag (mediatag_name, mediatag_match, mediatag_replace) VALUES ( 'GameTrailers', 'http://www.gametrailers.com/player/{1}.html', '<object classid=\"clsid:d27cdb6e-ae6d-11cf-96b8-444553540000\"  codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0\" id=\"gtembed\" width=\"480\" height=\"392\">	<param name=\"allowScriptAccess\" value=\"sameDomain\" /> 	<param name=\"allowFullScreen\" value=\"true\" /> <param name=\"movie\" value=\"http://www.gametrailers.com/remote_wrap.php?mid=\$1\"/> <param name=\"quality\" value=\"high\" /> <embed src=\"http://www.gametrailers.com/remote_wrap.php?mid=\$1\" swLiveConnect=\"true\" name=\"gtembed\" align=\"middle\" allowScriptAccess=\"sameDomain\" allowFullScreen=\"true\" quality=\"high\" pluginspage=\"http://www.macromedia.com/go/getflashplayer\" type=\"application/x-shockwave-flash\" width=\"480\" height=\"392\"></embed> </object>')";
$SQL[] = "INSERT INTO blog_mediatag (mediatag_name, mediatag_match, mediatag_replace) VALUES ( 'Flickr Image Set', 'http://www.flickr.com/photos/{1}/sets/{2}/', '<iframe align=\"center\" src=\"http://www.flickr.com/slideShow/index.gne?user_id=\$1&set_id=\$2\" frameBorder=\"0\" width=\"500\" height=\"500\"></iframe>')";
$SQL[] = "INSERT INTO blog_mediatag (mediatag_name, mediatag_match, mediatag_replace) VALUES ( 'MP3', '{1}.mp3', '<embed src=''http://webjay.org/flash/xspf_player'' width=''300'' height=''40'' wmode=''transparent'' flashVars=''playlist_url=\$1.mp3&rounded_corner=1&skin_color_1=0,0,0,0&skin_color_2=0,0,0,0'' type=''application/x-shockwave-flash'' pluginspage=''http://www.adobe.com/go/getflashplayer''/>')";

$SQL[] = "ALTER TABLE blog_entries ADD entry_featured tinyint NOT NULL DEFAULT 0";
$SQL[] = "CREATE INDEX entry_featured ON blog_entries(entry_featured)";
