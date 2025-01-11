<?php

$SQL[] = "ALTER TABLE gallery_images ADD medium_file_name VARCHAR( 75 ) NOT NULL default ''";
$SQL[] = "ALTER TABLE groups ADD g_can_search_gallery TINYINT NOT NULL DEFAULT 1";
$SQL[] = "ALTER TABLE gallery_categories ADD cat_rule_method TINYINT NOT NULL DEFAULT 0";
$SQL[] = "ALTER TABLE gallery_categories ADD cat_rule_title VARCHAR( 120 ) NOT NULL DEFAULT ''";
$SQL[] = "ALTER TABLE gallery_categories ADD cat_rule_text TEXT NOT NULL DEFAULT ''";
$SQL[] = "ALTER TABLE gallery_images ADD credit_info TEXT NOT NULL DEFAULT ''";
$SQL[] = "ALTER TABLE gallery_images ADD copyright VARCHAR( 120 ) NOT NULL DEFAULT ''";
$SQL[] = "ALTER TABLE contacts ADD gallery_album_perms TEXT NOT NULL DEFAULT ''";


?>