<?php

$SQL[] = "ALTER TABLE  downloads_files ADD  file_cost varchar(32) NOT NULL DEFAULT '0.00';";
$SQL[] = "ALTER TABLE groups ADD idm_bypass_paid BIT NOT NULL DEFAULT '0';";
$SQL[] = "ALTER TABLE groups ADD idm_add_paid BIT NOT NULL DEFAULT '0';";
$SQL[] = "delete FROM core_sys_conf_settings WHERE conf_key='idm_guest_report';";

