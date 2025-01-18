<?php

$query = $db_account->query("SELECT user_no FROM user_profile WHERE user_no LIKE  '" . date('Ymd') . "%' "); 

if(!$query)
{
	echo 'NA';
}
else
{
	echo $db_account->fetchNum($query);
}
?>