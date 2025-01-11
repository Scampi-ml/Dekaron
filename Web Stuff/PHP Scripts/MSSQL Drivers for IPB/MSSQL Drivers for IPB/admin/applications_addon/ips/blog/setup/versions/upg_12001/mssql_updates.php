<?php

$SQL[] = "ALTER TABLE groups ADD g_blog_allowpoll TINYINT NOT NULL DEFAULT 0";

$SQL[] = "ALTER TABLE blog_entries ADD entry_poll_state TINYINT NOT NULL DEFAULT 0";
$SQL[] = "ALTER TABLE blog_entries ADD entry_last_vote INT NOT NULL DEFAULT 0";

$SQL[] = "CREATE TABLE blog_polls (
  poll_id int NOT NULL IDENTITY,
  entry_id int NOT NULL default 0,
  start_date int NULL,
  choices text NULL,
  starter_id int NOT NULL default 0,
  votes smallint NOT NULL default 0,
  poll_question varchar(255) NULL,
  PRIMARY KEY  (poll_id)
)";
$SQL[] = "CREATE INDEX entry_id ON blog_polls (entry_id)";

$SQL[] = "CREATE TABLE blog_voters (
  vote_id int NOT NULL IDENTITY,
  ip_address varchar(16) NOT NULL default '',
  vote_date int NOT NULL default 0,
  entry_id int NOT NULL default 0,
  member_id varchar(32) NULL,
  PRIMARY KEY  (vote_id)
)";
$SQL[] = "CREATE INDEX entry_id ON blog_voters (entry_id, member_id)";
