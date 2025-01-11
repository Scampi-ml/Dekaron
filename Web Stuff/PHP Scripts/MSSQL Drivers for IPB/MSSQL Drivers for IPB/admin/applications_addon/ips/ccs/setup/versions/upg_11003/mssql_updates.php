<?php

$SQL[]	= "ALTER TABLE ccs_databases ADD database_record_approve BIT NOT NULL DEFAULT '0';";

$SQL[]	= "ALTER TABLE ccs_database_categories ADD category_has_perms BIT NOT NULL DEFAULT '0';";

$SQL[]	= "ALTER TABLE ccs_database_comments ADD comment_approved BIT NOT NULL DEFAULT '0';";

$SQL[]	= "ALTER TABLE ccs_databases ADD database_comment_approve BIT NOT NULL DEFAULT '0';";

$SQL[]	= "ALTER TABLE ccs_database_moderators ADD moderator_approve_record BIT NOT NULL DEFAULT '0';";
$SQL[]	= "ALTER TABLE ccs_database_moderators ADD moderator_approve_comment BIT NOT NULL DEFAULT '0';";
$SQL[]	= "ALTER TABLE ccs_database_moderators ADD moderator_pin_record BIT NOT NULL DEFAULT '0';";


