<?php

$SQL[]	= "CREATE TABLE ccs_database_categories (
category_id INT NOT NULL IDENTITY,
category_database_id MEDIUMINT NOT NULL DEFAULT '0',
category_name VARCHAR( 255 ) NULL,
category_parent_id INT NOT NULL DEFAULT '0',
category_last_record_id INT NOT NULL DEFAULT '0',
category_last_record_date VARCHAR( 13 ) NOT NULL DEFAULT '0',
category_last_record_member INT NOT NULL DEFAULT '0',
category_last_record_name VARCHAR( 255 ) NULL,
category_last_record_seo_name VARCHAR( 255 ) NULL,
category_description VARCHAR( MAX ) NULL,
category_position INT NOT NULL DEFAULT '0',
category_records INT NOT NULL DEFAULT '0',
PRIMARY KEY  (category_id)
);";

$SQL[] = "CREATE INDEX category_database_id ON ccs_database_categories ( category_database_id );";

$SQL[]	= "ALTER TABLE ccs_database_fields ADD field_html BIT NOT NULL DEFAULT '0';";

$SQL[]	= "ALTER TABLE ccs_databases ADD database_template_categories INT NOT NULL DEFAULT '0';";

$SQL[]	= "ALTER TABLE ccs_databases ALTER COLUMN database_template_listing INT NOT NULL DEFAULT '0';";

$SQL[]	= "ALTER TABLE ccs_databases ADD database_field_title VARCHAR( 255 ) NULL";
$SQL[]	= "ALTER TABLE ccs_databases ADD database_field_sort VARCHAR( 255 ) NULL";
$SQL[]	= "ALTER TABLE ccs_databases ADD database_field_direction VARCHAR( 4 ) NOT NULL DEFAULT 'desc'";
$SQL[]	= "ALTER TABLE ccs_databases ADD database_field_perpage INT NOT NULL DEFAULT '25';";
