<?php

$INDEX[] = "EXEC sp_fulltext_table 'downloads_files', 'Create', 'ftcatalog', 'PK_file_id'";
$INDEX[] = "EXEC sp_fulltext_column 'downloads_files','file_desc','add'";
$INDEX[] = "EXEC sp_fulltext_table 'downloads_files','activate'";
$INDEX[] = "EXEC sp_fulltext_table 'downloads_files', 'Start_change_tracking'";
$INDEX[] = "EXEC sp_fulltext_table 'downloads_files', 'Start_background_updateindex'";
