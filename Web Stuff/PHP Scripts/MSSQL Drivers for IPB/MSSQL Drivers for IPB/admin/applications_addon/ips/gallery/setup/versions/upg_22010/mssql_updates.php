<?php

$SQL[]	= "ALTER TABLE groups ADD g_gal_avatar TINYINT NOT NULL DEFAULT 1;";
$SQL[] = "ALTER TABLE gallery_images ADD comments_queued int NOT NULL DEFAULT 0;";
$SQL[] = "ALTER TABLE gallery_categories ADD mod_comments int NOT NULL DEFAULT 0;";
$SQL[] = "ALTER TABLE gallery_albums ADD mod_images int NOT NULL DEFAULT 0;";
$SQL[] = "ALTER TABLE gallery_albums ADD mod_comments int NOT NULL DEFAULT 0;";

?>