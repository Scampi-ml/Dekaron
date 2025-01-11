<?php

$SQL[] = "ALTER TABLE downloads_files ADD file_renewal_term INT NOT NULL DEFAULT 0;";
$SQL[] = "ALTER TABLE downloads_files ADD file_renewal_units CHAR(1) NULL DEFAULT NULL;";
$SQL[] = "ALTER TABLE downloads_files ADD file_renewal_price FLOAT NOT NULL DEFAULT '0.00';";
$SQL[] = "ALTER TABLE downloads_mods ADD modusefeature TINYINT NOT NULL DEFAULT '0';";
$SQL[] = "ALTER TABLE downloads_files ADD file_featured TINYINT NOT NULL DEFAULT '0';";
$SQL[] = "ALTER TABLE downloads_files ADD file_pinned TINYINT NOT NULL DEFAULT '0';";
$SQL[] = "ALTER TABLE downloads_mods ADD modcanpin TINYINT NOT NULL DEFAULT '0';";
$SQL[] = "ALTER TABLE downloads_files ADD file_comments INT NOT NULL DEFAULT '0';";

$SQL[] = "CREATE INDEX file_featured ON downloads_files ( file_featured );";