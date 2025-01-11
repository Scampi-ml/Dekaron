<?php

$SQL = array();
if ($sql = $this->install->ipsclass->DB->getsql_dropdefault_constraint("gallery_media_types", "mime_type") ) 
{
	$SQL[] = $sql;
}

$SQL[]	= "ALTER TABLE gallery_media_types ALTER COLUMN mime_type varchar(50) NOT NULL;";
$SQL[] 	= "ALTER TABLE gallery_media_types ADD DEFAULT '' FOR mime_type";


?>