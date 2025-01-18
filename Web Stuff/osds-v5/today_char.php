<?php
$query = $db_character->query("SELECT character_no FROM user_character WHERE character_no LIKE  '" . date('Ymd') . "%' "); 

if(!$query)
{
	echo 'NA';
}
else
{
	echo $db_character->fetchNum($query);
}
?>