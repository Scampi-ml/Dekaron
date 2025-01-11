<?php

$SQL[]	= "CREATE TABLE ccs_database_moderators (
moderator_id INT NOT NULL IDENTITY,
moderator_database_id INT NOT NULL DEFAULT '0',
moderator_type VARCHAR( 16 ) NULL,
moderator_type_id INT NOT NULL DEFAULT '0',
moderator_delete_record BIT NOT NULL DEFAULT '0',
moderator_edit_record BIT NOT NULL DEFAULT '0',
moderator_lock_record BIT NOT NULL DEFAULT '0',
moderator_unlock_record BIT NOT NULL DEFAULT '0',
moderator_delete_comment BIT NOT NULL DEFAULT '0',
PRIMARY KEY (moderator_id)
);";

$SQL[]	= "CREATE INDEX moderator_database_id ON ccs_database_moderators ( moderator_database_id );";

$SQL[]	= "ALTER TABLE ccs_database_categories ADD category_show_records BIT NOT NULL DEFAULT '1';";


