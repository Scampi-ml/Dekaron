<?php

$SQL[] = "CREATE TABLE blog_cblock_cache (
  blog_id INT NOT NULL,
  cbcache_key VARCHAR(32) NOT NULL,
  cbcache_lastupdate INT NOT NULL DEFAULT '0',
  cbcache_refresh SMALLINT NOT NULL DEFAULT '0',
  cbcache_content VARCHAR(MAX) NULL,
  PRIMARY KEY (blog_id,cbcache_key) );";
