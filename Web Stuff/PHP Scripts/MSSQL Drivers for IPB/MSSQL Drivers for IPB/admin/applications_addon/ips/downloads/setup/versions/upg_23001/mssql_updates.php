<?php

$SQL[] = "ALTER TABLE groups ADD idm_bypass_revision TINYINT NOT NULL DEFAULT '0';";
$SQL[] = "CREATE INDEX record_added ON downloads_temp_records ( record_added );";
$SQL[] = "CREATE INDEX dtime ON downloads_downloads ( dtime );";