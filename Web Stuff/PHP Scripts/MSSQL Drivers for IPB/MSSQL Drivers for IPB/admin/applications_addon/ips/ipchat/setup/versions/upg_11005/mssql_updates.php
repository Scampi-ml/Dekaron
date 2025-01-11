<?php


if ( ! defined( 'IN_IPB' ) )
{
	print "<h1>Incorrect access</h1>You cannot access this file directly. If you have recently upgraded, make sure you upgraded all the relevant files.";
	exit();
}

$SQL = array();

$SQL[] = "CREATE TABLE chat_log_archive (
 log_id INT NOT NULL IDENTITY,
 log_room_id INT NOT NULL DEFAULT '0',
 log_time INT NOT NULL DEFAULT '0',
 log_code INT NOT NULL DEFAULT '0',
 log_user VARCHAR( 255 ) NULL DEFAULT NULL ,
 log_message VARCHAR(MAX) NULL,
 log_extra VARCHAR( 255 ) NULL DEFAULT NULL,
 PRIMARY KEY (log_id)
);";