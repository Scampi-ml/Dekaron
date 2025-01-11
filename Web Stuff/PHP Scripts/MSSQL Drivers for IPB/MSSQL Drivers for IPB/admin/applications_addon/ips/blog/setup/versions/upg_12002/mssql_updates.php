<?php

$SQL[] = "DROP INDEX blog_authmembers.blog_id";
$SQL[] = "ALTER TABLE blog_authmembers ADD PRIMARY KEY(blog_id, member_id)";
