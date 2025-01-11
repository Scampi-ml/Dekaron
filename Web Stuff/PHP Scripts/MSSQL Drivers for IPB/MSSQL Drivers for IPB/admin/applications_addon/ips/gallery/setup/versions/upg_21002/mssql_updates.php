<?php

$SQL = array();

# Fix the date columns - reserved mysql word

$SQL[]	= "EXEC sp_rename 'gallery_bandwidth.date','bdate','COLUMN';";
$SQL[]	= "EXEC sp_rename 'gallery_images.date','idate','COLUMN';";
$SQL[]	= "EXEC sp_rename 'gallery_ecardlog.date','edate','COLUMN';";
$SQL[]	= "EXEC sp_rename 'gallery_ratings.date','rdate','COLUMN';";

# Fix date column for the category view definition column
if ($sql = $this->install->ipsclass->DB->getsql_dropdefault_constraint("gallery_categories", "def_view") ) {
	$SQL[] = $sql;
}
$SQL[]	= "ALTER TABLE gallery_categories ADD DEFAULT 'idate:DESC:*' FOR def_view";
$SQL[]	= "UPDATE gallery_categories SET def_view=REPLACE(def_view, 'date:', 'idate:');";
$SQL[]	= "UPDATE gallery_categories SET def_view=REPLACE(def_view, ':30', ':*');";

# Some other cols

if ($sql = $this->install->ipsclass->DB->getsql_dropdefault_constraint("gallery_albums", "description") ) {
	$SQL[] = $sql;
}
$SQL[]	= "ALTER TABLE gallery_albums ALTER COLUMN description TEXT NOT NULL";
$SQL[]	= "ALTER TABLE gallery_albums ADD DEFAULT '' FOR description";

$SQL[]	= "ALTER TABLE gallery_images ADD metadata TEXT NOT NULL DEFAULT ''";
$SQL[]	= "ALTER TABLE gallery_images ADD media_thumb VARCHAR( 75 ) NULL";

if ($sql = $this->install->ipsclass->DB->getsql_dropdefault_constraint("gallery_media_types", "thumb_width") ) {
	$SQL[] = $sql;
}
if ($sql = $this->install->ipsclass->DB->getsql_dropdefault_constraint("gallery_media_types", "thumb_height") ) {
	$SQL[] = $sql;
}
if ($sql = $this->install->ipsclass->DB->getsql_dropdefault_constraint("gallery_media_types", "thumb_prop") ) {
	$SQL[] = $sql;
}
$SQL[]	= "ALTER TABLE gallery_media_types DROP COLUMN thumb_width";
$SQL[]	= "ALTER TABLE gallery_media_types DROP COLUMN thumb_height";
$SQL[]	= "ALTER TABLE gallery_media_types DROP COLUMN thumb_prop";

$SQL[]	= "ALTER TABLE gallery_categories ADD mem_gallery TEXT NULL";

$SQL[] = "INSERT INTO gallery_media_types(icon, title, mime_type, extension, allowed, allow_user_thumb, display_code, default_type) VALUES ('win_player.gif', 'MPEG', 'video/mpeg', '.mpg, .mpeg', 1, 0, '<embed src=\"{FILE}\" width=\"200\" height=\"200\" autostart=\"true\">', 0);";
$SQL[] = "INSERT INTO gallery_media_types(icon, title, mime_type, extension, allowed, allow_user_thumb, display_code, default_type) VALUES ('win_player.gif', 'AVI', 'video/x-msvideo', '.avi', 1, 0, '<embed src=\"{FILE}\" width=\"200\" height=\"200\" autostart=\"true\">', 0);";
$SQL[] = "INSERT INTO gallery_media_types(icon, title, mime_type, extension, allowed, allow_user_thumb, display_code, default_type) VALUES ('flash.gif', 'Flash', 'application/x-shockwave-flash', '.swf', 1, 1, '<object width=\"550\" height=\"400\">\n<param name=\"movie\" value=\"{FILE}\">\n<embed src=\"{FILE}\" width=\"550\" height=\"400\">\n</embed>\n</object>', 0);";

$SQL[]	= "CREATE INDEX public_album ON gallery_albums(public_album)";

if ($sql = $this->install->ipsclass->DB->getsql_dropdefault_constraint("gallery_images", "file_type") ) {
	$SQL[] = $sql;
}
$SQL[] = "ALTER TABLE gallery_images ALTER COLUMN file_type varchar(50) NOT NULL";
$SQL[] = "ALTER TABLE gallery_images ADD DEFAULT '0' FOR file_type";
				
$SQL[] = "CREATE INDEX album_id ON gallery_images(album_id)";
$SQL[] = "CREATE INDEX member_id ON gallery_images(member_id)";

$SQL[] = "CREATE INDEX img_id ON gallery_ratings(img_id)";

$SQL[] 	= "UPDATE gallery_form_fields SET required=0 WHERE LOWER(name) IN ('caption', 'description', 'photo information')";

?>