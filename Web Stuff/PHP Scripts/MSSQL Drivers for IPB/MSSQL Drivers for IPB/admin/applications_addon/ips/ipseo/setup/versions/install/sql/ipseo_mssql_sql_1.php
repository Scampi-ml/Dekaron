<?php

$SQL = array();
$SQL[] = 'DELETE FROM core_applications WHERE app_directory = \'searchactivity\'';
$SQL[] = 'DELETE FROM core_hooks_files WHERE hook_classname = \'searchActivityTracking\'';
$SQL[] = 'DELETE FROM core_hooks WHERE hook_key = \'searchactivity_tracking\'';
$SQL[] = 'DELETE FROM task_manager WHERE task_key IN (\'task_sitemap\', \'searchactivity_daily_clean\')';
$SQL[] = 'DELETE FROM core_sys_module WHERE sys_module_application = \'searchactivity\'';