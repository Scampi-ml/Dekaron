<?php
date_default_timezone_set('Europe/Paris');

$today = array(
'Monday' => "10% HP",
'Tuesday' => "10% MP",
'Wednesday' => "10% Str",
'Thursday' => "10% Dex",
'Friday' => "10% Con",
'Saturday' => "10% Spr",
'Sunday' => "10% Dil"
);
$now = date("l");

echo $today[$now];
?>