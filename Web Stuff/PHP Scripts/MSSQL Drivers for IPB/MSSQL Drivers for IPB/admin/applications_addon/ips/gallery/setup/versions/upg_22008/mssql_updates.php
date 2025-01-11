<?php

if ($sql = $this->install->ipsclass->DB->getsql_dropdefault_constraint("gallery_images", "file_size") ) {
	$SQL[] = $sql;
}
$SQL[]	= "ALTER TABLE gallery_images ALTER COLUMN file_size bigint";
$SQL[]	= "ALTER TABLE gallery_images ADD DEFAULT 0 FOR file_size";

?>