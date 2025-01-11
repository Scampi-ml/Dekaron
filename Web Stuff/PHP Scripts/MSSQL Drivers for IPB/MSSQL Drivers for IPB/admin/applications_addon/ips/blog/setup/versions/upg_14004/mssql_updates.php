<?php

$SQL = array();
$DB  = ipsRegistry::DB();
$PRE = ipsRegistry::dbFunctions()->getPrefix();

$DB->addField( 'blog_moderators', 'moderator_can_feature', 'INT', "'0'" );

