<?php

$SQL = array();

$SQL[] = "CREATE INDEX post_date ON gallery_comments (post_date)";

$SQL[] = "CREATE TABLE gallery_subscriptions (
	sub_id INT NOT NULL IDENTITY,
	sub_mid INT NOT NULL DEFAULT '0',
	sub_type VARCHAR( 25 ) NOT NULL DEFAULT 'image',
	sub_toid INT NOT NULL DEFAULT '0',
	sub_added VARCHAR( 13 ) NOT NULL DEFAULT '0',
	sub_last VARCHAR( 13 ) NOT NULL DEFAULT '0',
PRIMARY KEY ( sub_id )
);";
$SQL[] = "CREATE INDEX 	sub_mid ON gallery_subscriptions ( sub_mid );";

$SQL[]	= "ALTER TABLE gallery_albums ADD def_view VARCHAR( 50 ) NOT NULL DEFAULT 'idate:DESC:*';";
$SQL[]	= "ALTER TABLE groups ADD g_album_private TINYINT NOT NULL DEFAULT 1;";
$SQL[]	= "DELETE FROM conf_settings WHERE conf_key='gallery_guest_access';";

$SQL[]	= "EXEC sp_rename 'gallery_categories.last_pic','last_pic_id','COLUMN'";
if ($dropsql = $this->install->ipsclass->DB->getsql_dropdefault_constraint("gallery_categories", "last_name") )
{
	$SQL[] = $dropsql;
}
$SQL[]	= "ALTER TABLE gallery_categories DROP COLUMN last_name;";
$SQL[]	= "ALTER TABLE gallery_categories ADD last_pic_date VARCHAR( 13 ) NOT NULL DEFAULT '0';";
$SQL[]	= "ALTER TABLE gallery_categories ADD last_pic_name VARCHAR( 255 ) NULL;";

if ($dropsql = $this->install->ipsclass->DB->getsql_dropdefault_constraint("gallery_albums", "last_name") )
{
	$SQL[] = $dropsql;
}
$SQL[]	= "ALTER TABLE gallery_albums DROP COLUMN last_name;";
$SQL[]	= "ALTER TABLE gallery_albums ADD last_pic_date VARCHAR( 13 ) NOT NULL DEFAULT '0';";
$SQL[]	= "EXEC sp_rename 'gallery_albums.last_pic','last_pic_id','COLUMN'";
$SQL[]	= "ALTER TABLE gallery_albums ADD last_pic_name VARCHAR( 255 ) NULL ;";

$SQL[]	= "INSERT INTO cache_store ( cs_key , cs_value , cs_extra , cs_array ) VALUES ( 'gallery_media_types', '', '', '1' );";
$SQL[]	= "INSERT INTO cache_store ( cs_key , cs_value , cs_extra , cs_array ) VALUES ( 'gallery_stats', '', '', '1' );";
$SQL[]	= "INSERT INTO cache_store ( cs_key , cs_value , cs_extra , cs_array ) VALUES ( 'gallery_post_form', '', '', '1' );";
$SQL[]	= "INSERT INTO cache_store ( cs_key , cs_value , cs_extra , cs_array ) VALUES ( 'gallery_albums', '', '', '1' );";

?>