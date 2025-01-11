<?php
$SQL = array();
$DB  = ipsRegistry::DB();
$PRE = ipsRegistry::dbFunctions()->getPrefix();

$DB->changeField('gallery_albums', 'name_seo', 'name_seo', 'varchar(255)', "''");
$DB->changeField('gallery_categories', 'name_seo', 'name_seo', 'varchar(255)', "''");

