<?php

$SQL[] = "ALTER TABLE blog_blogs add blog_pinned TINYINT NOT NULL default 0";
$SQL[] = "ALTER TABLE blog_blogs add blog_disabled TINYINT NOT NULL default 0";
