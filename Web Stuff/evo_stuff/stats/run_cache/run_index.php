<?php
if(stristr($_SERVER['PHP_SELF'], 'run_index.php'))
{
	die("<strong>Error: </strong>Can't be opened directly!");
}

$query1 = $dekaron->SQLquery("SELECT character_no FROM character2.dbo.user_character");
$stats1 = $dekaron->SQLfetchNum($query1);

$query2 = $dekaron->SQLquery("SELECT user_id FROM account2.dbo.user_profile");
$stats2 = $dekaron->SQLfetchNum($query2);

$query3 = $dekaron->SQLquery("SELECT user_id FROM account2.dbo.user_profile WHERE login_flag = '1100' ");
$stats3 = $dekaron->SQLfetchNum($query3);

$query4 = $dekaron->SQLquery("SELECT user_id FROM account2.dbo.user_profile WHERE login_tag = 'N' ");
$stats4 = $dekaron->SQLfetchNum($query4);

$query5 = $dekaron->SQLquery("SELECT guild_code FROM character2.dbo.guild_info ");
$stats5 = $dekaron->SQLfetchNum($query5);



$stats_array = array($stats1, $stats2, $stats3, $stats4, $stats5);
$serialized_array = serialize($stats_array);

unlink("cache/index.cache");

$file_name = "cache/index.cache";
$handle = fopen($file_name, 'w+');
fwrite($handle, $serialized_array);
fclose($handle);

?>