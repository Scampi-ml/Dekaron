<?php



$INDEX[] = "sp_fulltext_database 'enable'";

$INDEX[] = "IF (select FULLTEXTCATALOGPROPERTY ( 'ftcatalog', 'PopulateStatus' )) IS NULL

BEGIN

	exec sp_fulltext_catalog 'ftcatalog', 'create'

END";





$INDEX[] = "sp_fulltext_table 'blog_entries', 'Create', 'ftcatalog', 'PK_entry_id'";

$INDEX[] = "sp_fulltext_column 'blog_entries', 'entry_name','add'";

$INDEX[] = "sp_fulltext_column 'blog_entries', 'entry','add'";

$INDEX[] = "sp_fulltext_table 'blog_entries', 'activate'";

$INDEX[] = "sp_fulltext_table 'blog_entries', 'Start_change_tracking'";

$INDEX[] = "sp_fulltext_table 'blog_entries', 'Start_background_updateindex'";

