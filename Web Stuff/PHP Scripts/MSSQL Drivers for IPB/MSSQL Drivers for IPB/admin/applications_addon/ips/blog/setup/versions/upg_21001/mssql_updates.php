<?php

# 2.1.0 RC 1

$DB  = ipsRegistry::DB();
$PRE = ipsRegistry::dbFunctions()->getPrefix();


$DB->changeField( 'blog_voters', 'member_id', 'member_id', 'INT', "'0'" );




