<?php

$SQL[]	= "CREATE INDEX comment_database_id ON ccs_database_comments ( comment_database_id , comment_record_id , comment_date );";

ipsRegistry::DB()->dropIndex( 'ccs_attachments_map', 'map_database_id' );
$SQL[]	= "CREATE INDEX map_database_id ON ccs_attachments_map ( map_database_id , map_record_id );";

$SQL[]	= "ALTER TABLE ccs_database_fields ADD field_truncate INT NOT NULL DEFAULT '100';";


