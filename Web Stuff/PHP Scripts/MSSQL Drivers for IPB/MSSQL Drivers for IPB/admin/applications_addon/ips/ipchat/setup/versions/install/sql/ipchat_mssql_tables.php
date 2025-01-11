<?php

$TABLE[] = "ALTER TABLE members ADD chat_banned BIT NOT NULL DEFAULT '0';";

$TABLE[] = "CREATE TABLE chat_log_archive (
 log_id INT NOT NULL IDENTITY,
 log_room_id INT NOT NULL DEFAULT '0',
 log_time INT NOT NULL DEFAULT '0',
 log_code INT NOT NULL DEFAULT '0',
 log_user VARCHAR( 255 ) NULL DEFAULT NULL ,
 log_message VARCHAR(MAX) NULL,
 log_extra VARCHAR( 255 ) NULL DEFAULT NULL,
 PRIMARY KEY (log_id)
);";