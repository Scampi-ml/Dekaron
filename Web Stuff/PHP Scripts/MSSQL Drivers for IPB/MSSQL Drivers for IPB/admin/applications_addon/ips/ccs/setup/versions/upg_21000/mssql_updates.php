<?php

$SQL[]	= "ALTER TABLE ccs_database_fields ADD field_topic_format VARCHAR( MAX ) NULL DEFAULT NULL;";

$SQL[]	= "ALTER TABLE ccs_databases ADD database_search BIT NOT NULL DEFAULT '0';";

$SQL[]	= "UPDATE ccs_databases SET database_search=1;";

$SQL[]	= "CREATE TABLE ccs_revisions (
revision_id INT NOT NULL IDENTITY,
revision_type VARCHAR( 32 ) NOT NULL ,
revision_type_id INT NOT NULL ,
revision_content VARCHAR( MAX ) NULL DEFAULT NULL ,
revision_other VARCHAR ( MAX ) NULL ,
revision_date INT NOT NULL DEFAULT '0',
revision_member INT NOT NULL DEFAULT '0',
PRIMARY KEY (revision_id)
);";

$SQL[] = "CREATE INDEX revision_type ON ccs_revisions ( revision_type , revision_type_id, revision_date );";
$SQL[] = "CREATE INDEX revision_member ON ccs_revisions ( revision_member );";

$SQL[]	= "ALTER TABLE ccs_page_wizard ADD wizard_omit_filename BIT NOT NULL DEFAULT '0';";

$SQL[]	= "ALTER TABLE ccs_pages ADD page_omit_filename BIT NOT NULL DEFAULT '0';";

if( !ipsRegistry::DB()->checkForField( 'category_records_queued', 'ccs_database_categories' ) )
{
	$SQL[]	= "ALTER TABLE ccs_database_categories ADD category_records_queued INT NOT NULL DEFAULT '0';";
}

$TABLE[] = "CREATE INDEX tpb_name ON ccs_template_blocks ( tpb_name );";
$TABLE[] = "CREATE INDEX container_type ON ccs_containers ( container_type, container_order );";
