<?php

$SQL[] = "ALTER TABLE gallery_albums ADD category_id INT DEFAULT 0";
$SQL[] = "ALTER TABLE gallery_albums ADD last_name VARCHAR( 255 ) NULL";
$SQL[] = "ALTER TABLE gallery_categories ADD category_only TINYINT DEFAULT 0";
$SQL[] = "ALTER TABLE gallery_categories ADD last_name VARCHAR( 255 ) NULL";
$SQL[] = "ALTER TABLE gallery_categories ADD last_member_id INT NULL ";
$SQL[] = "ALTER TABLE groups ADD g_multi_file_limit SMALLINT DEFAULT 0";
$SQL[] = "ALTER TABLE groups ADD g_zip_upload TINYINT DEFAULT 0";
$SQL[] = "ALTER TABLE gallery_media_types ALTER COLUMN extension VARCHAR( 32 ) NOT NULL";
$SQL[] = "ALTER TABLE gallery_media_types ADD default_type TINYINT DEFAULT 0 NOT NULL";
$DB->Query("select a.name from sysobjects a, syscolumns b, sysobjects c
            where a.type='D' and a.id=b.cdefault and b.id=c.id and b.name='directory' and c.name='gallery_images'");
if ($constraint = $DB->fetch_row()) { 
	$SQL[] = "ALTER TABLE gallery_images DROP CONSTRAINT ".$constraint['name'];
}
$SQL[] = "ALTER TABLE gallery_images ALTER COLUMN directory INT NOT NULL"; 
$SQL[] = "ALTER TABLE gallery_images add default 0 for directory WITH VALUES";

$DB->Query("select a.name from sysobjects a, syscolumns b, sysobjects c
            where a.type='D' and a.id=b.cdefault and b.id=c.id and b.name='member_id' and c.name='gallery_albums'");
if ($constraint = $DB->fetch_row()) { 
	$SQL[] = "ALTER TABLE gallery_albums DROP CONSTRAINT ".$constraint['name'];
}
$SQL[] = "ALTER TABLE gallery_albums ALTER COLUMN member_id INT NOT NULL";
$SQL[] = "ALTER TABLE gallery_albums add default 0 for member_id WITH VALUES";

$SQL[] = "exec sp_rename 'gallery_bandwidth','gallery_bandwidth_old'";
$SQL[] = "CREATE TABLE gallery_bandwidth (
  member_id int NOT NULL default 0,
  file_name varchar(60) NOT NULL default '',
  date int NOT NULL default 0,
  size int NOT NULL default 0,
  PRIMARY KEY  (member_id,date)
);";
$SQL[] = "INSERT INTO gallery_bandwidth SELECT * FROM gallery_bandwidth_old"; 
$SQL[] = "DROP TABLE gallery_bandwidth_old"; 

$DB->Query("select a.name from sysobjects a, syscolumns b, sysobjects c
            where a.type='D' and a.id=b.cdefault and b.id=c.id and b.name='member_id' and c.name='gallery_ecardlog'");
if ($constraint = $DB->fetch_row()) { 
	$SQL[] = "ALTER TABLE gallery_ecardlog DROP CONSTRAINT ".$constraint['name'];
}
$SQL[] = "ALTER TABLE gallery_ecardlog ALTER COLUMN member_id INT NOT NULL";
$SQL[] = "ALTER TABLE gallery_ecardlog add default 0 for member_id WITH VALUES";

$DB->Query("select a.name from sysobjects a, syscolumns b, sysobjects c
            where a.type='D' and a.id=b.cdefault and b.id=c.id and b.name='member_id' and c.name='gallery_favorites'");
if ($constraint = $DB->fetch_row()) { 
	$SQL[] = "ALTER TABLE gallery_favorites DROP CONSTRAINT ".$constraint['name'];
}
$SQL[] = "ALTER TABLE gallery_favorites ALTER COLUMN member_id INT NOT NULL";
$SQL[] = "ALTER TABLE gallery_favorites add default 0 for member_id WITH VALUES";

$DB->Query("select a.name from sysobjects a, syscolumns b, sysobjects c
            where a.type='D' and a.id=b.cdefault and b.id=c.id and b.name='member_id' and c.name='gallery_images'");
if ($constraint = $DB->fetch_row()) { 
	$SQL[] = "ALTER TABLE gallery_images DROP CONSTRAINT ".$constraint['name'];
}
$SQL[] = "ALTER TABLE gallery_images ALTER COLUMN member_id INT NOT NULL";
$SQL[] = "ALTER TABLE gallery_images add default 0 for member_id WITH VALUES";

$DB->Query("select a.name from sysobjects a, syscolumns b, sysobjects c
            where a.type='D' and a.id=b.cdefault and b.id=c.id and b.name='member_id' and c.name='gallery_ratings'");
if ($constraint = $DB->fetch_row()) { 
	$SQL[] = "ALTER TABLE gallery_ratings DROP CONSTRAINT ".$constraint['name'];
}
$SQL[] = "ALTER TABLE gallery_ratings ALTER COLUMN member_id INT NOT NULL";
$SQL[] = "ALTER TABLE gallery_ratings add default 0 for member_id WITH VALUES";
$SQL[] = "CREATE INDEX member_id ON gallery_ratings (member_id)";

$SQL[] = "ALTER TABLE gallery_categories ADD album_mode TINYINT DEFAULT 0 NOT NULL";
$DB->Query("select a.name from sysobjects a, syscolumns b, sysobjects c
            where a.type='D' and a.id=b.cdefault and b.id=c.id and b.name='extension' and c.name='gallery_media_types'");
if ($constraint = $DB->fetch_row()) { 
	$SQL[] = "ALTER TABLE gallery_media_types DROP CONSTRAINT ".$constraint['name'];
}
$SQL[] = "ALTER TABLE gallery_media_types ALTER COLUMN extension varchar(32) NOT NULL"; 
$SQL[] = "ALTER TABLE gallery_media_types add default '' for extension WITH VALUES";
$SQL[] = "INSERT INTO gallery_media_types(icon,title,mime_type,extension,allowed,allow_user_thumb,thumb_width,thumb_height,thumb_prop,display_code,default_type) VALUES ('folder_mime_types/gif.gif', 'JPEG', 'image/jpeg', '.jpg,.jpeg', 1, 0, 0, 0, 0, '<#IMAGE#>', 1)";
$SQL[] = "INSERT INTO gallery_media_types(icon,title,mime_type,extension,allowed,allow_user_thumb,thumb_width,thumb_height,thumb_prop,display_code,default_type) VALUES ('folder_mime_types/gif.gif', 'PNG', 'image/png', '.png', 1, 0, 0, 0, 0, '<#IMAGE#>', 1)";
$SQL[] = "INSERT INTO gallery_media_types(icon,title,mime_type,extension,allowed,allow_user_thumb,thumb_width,thumb_height,thumb_prop,display_code,default_type) VALUES ('folder_mime_types/gif.gif', 'GIF', 'image/gif', '.gif', 1, 0, 0, 0, 0, '<#IMAGE#>', 1)";

?>