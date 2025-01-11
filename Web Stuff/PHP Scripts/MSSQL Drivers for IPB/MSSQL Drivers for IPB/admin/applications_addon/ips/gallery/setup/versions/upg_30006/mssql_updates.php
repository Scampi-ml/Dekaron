<?php

$SQL = array();
$DB  = ipsRegistry::DB();
$PRE = ipsRegistry::dbFunctions()->getPrefix();

$DB->changeField( 'gallery_images', 'caption', 'caption', 'VARCHAR(255)' );
$DB->changeField( 'gallery_images', 'credit_info', 'credit_info', 'TEXT' );



