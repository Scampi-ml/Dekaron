<?php

$PRE = trim(ipsRegistry::dbFunctions()->getPrefix());
$DB  = ipsRegistry::DB();


$DB->dropIndex( 'downloads_categories', 'cposition' );

$DB->addIndex( 'downloads_categories', 'position_order', 'cparent , cposition' );
$DB->addIndex( 'downloads_urls', 'url_expires', 'url_expires' );
$DB->addIndex( 'downloads_favorites', 'fmid', 'fmid' );
$DB->addIndex( 'downloads_downloads', 'dmid', 'dmid' );
$DB->addIndex( 'downloads_sessions', 'dsess_start', 'dsess_start' );

$DB->changeField( 'downloads_comments', 'comment_date', 'comment_date', 'INT', '0' );
$DB->changeField( 'downloads_comments', 'comment_edit_time', 'comment_edit_time', 'INT', '0' );
$DB->changeField( 'downloads_favorites', 'fupdated', 'fupdated', 'INT', '0' );
$DB->changeField( 'downloads_filebackup', 'b_backup', 'b_backup', 'INT', '0' );
$DB->changeField( 'downloads_filebackup', 'b_updated', 'b_updated', 'INT', '0' );
$DB->changeField( 'downloads_files', 'file_submitted', 'file_submitted', 'INT', '0' );
$DB->changeField( 'downloads_files', 'file_updated', 'file_updated', 'INT', '0' );
$DB->changeField( 'downloads_files', 'file_approvedon', 'file_approvedon', 'INT', '0' );
$DB->changeField( 'downloads_sessions', 'dsess_start', 'dsess_start', 'INT', '0' );
$DB->changeField( 'downloads_sessions', 'dsess_end', 'dsess_end', 'INT', '0' );
$DB->changeField( 'downloads_temp_records', 'record_added', 'record_added', 'INT', '0' );
$DB->changeField( 'downloads_urls', 'url_created', 'url_created', 'INT', '0' );
$DB->changeField( 'downloads_urls', 'url_expires', 'url_expires', 'INT', '0' );
$SQL[] = "delete FROM core_sys_conf_settings WHERE conf_key='idm_guest_report';";

