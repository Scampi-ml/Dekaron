<?php
/**
* Installation Schematic File
*/

$TABLE[] = "CREATE TABLE search_visitors (
  [id] int NOT NULL IDENTITY,
  [member] int,
  [date] int NOT NULL DEFAULT '0',
  [engine] varchar(50) NOT NULL,
  [keywords] varchar(250) NOT NULL,
  [url] varchar(MAX) NOT NULL,
  PRIMARY KEY ([id])
)";

$TABLE[] = "CREATE INDEX idx_date_engine ON search_visitors ( [date], [engine]);";

$TABLE[] = "CREATE TABLE search_keywords (
  [keyword] varchar(250) NOT NULL,
  [count] int NOT NULL DEFAULT '0',
  CONSTRAINT [idx_keyword_unq] UNIQUE ([keyword])
)";

$TABLE[] = "CREATE INDEX idx_kw_cnt ON search_keywords ( [keyword], [count]);";

$TABLE[] = "CREATE TABLE seo_meta (
  [url] varchar(255) NOT NULL DEFAULT '*',
  [name] varchar(50) NOT NULL DEFAULT '',
  [content] VARCHAR( MAX ) NOT NULL
)";