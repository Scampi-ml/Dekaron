<?php

$SQL = array();

$SQL[] = "EXEC sp_rename 'downloads_filestorage','downloads_filestorage_old'";

$SQL[] = "CREATE TABLE downloads_filestorage (
  storage_id int NOT NULL default 0,
  storage_file text null,
  storage_ss text null,
  storage_thumb text null,
  PRIMARY KEY (storage_id)
);";
