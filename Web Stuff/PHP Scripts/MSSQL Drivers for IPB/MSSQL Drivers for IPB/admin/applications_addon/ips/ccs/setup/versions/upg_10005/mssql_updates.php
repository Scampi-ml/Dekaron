<?php

$SQL[]	= "ALTER TABLE  ccs_page_wizard ADD wizard_previous_type VARCHAR( 32 ) NULL;";
$SQL[]	= "ALTER TABLE  ccs_pages ADD page_ipb_wrapper TINYINT NOT NULL DEFAULT '0';";
$SQL[]	= "ALTER TABLE  ccs_page_wizard ADD wizard_ipb_wrapper TINYINT NOT NULL DEFAULT '0';";
