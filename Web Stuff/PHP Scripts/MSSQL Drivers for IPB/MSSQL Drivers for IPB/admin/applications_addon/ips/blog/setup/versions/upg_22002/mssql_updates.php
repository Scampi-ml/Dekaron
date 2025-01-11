<?php

$DB  = ipsRegistry::DB();
$PRE = ipsRegistry::dbFunctions()->getPrefix();

$DB->changeField( 'blog_lastinfo','blog_tag_cloud', 'blog_tag_cloud', 'VARCHAR(MAX)' );
$SQL[] = "UPDATE blog_lastinfo SET blog_tag_cloud='';";

