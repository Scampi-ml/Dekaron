<?php

$SQL[]	= "ALTER TABLE ccs_database_fields ADD field_default_value VARCHAR( MAX ) NULL,
field_display_listing INT NOT NULL DEFAULT '1',
field_display_display INT NOT NULL DEFAULT '1',
field_format_opts VARCHAR( MAX ) NULL;";