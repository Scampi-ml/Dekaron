<?php

$QUERY = array();

ipsRegistry::DB()->dropTable( 'subscription_currency' );
ipsRegistry::DB()->dropTable( 'subscription_extra' );
ipsRegistry::DB()->dropTable( 'subscription_logs' );
ipsRegistry::DB()->dropTable( 'subscription_methods' );
ipsRegistry::DB()->dropTable( 'subscription_trans' );
ipsRegistry::DB()->dropTable( 'subscriptions' );


