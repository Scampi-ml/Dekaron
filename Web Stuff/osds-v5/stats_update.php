<?php
include 'osdscore.php';
flush_this();

$osds_install_path = exo_getglobalvariable('HEPublicationPath', '');

$file_name = $osds_install_path . "Data/stats_cache.php";
$handle = fopen($file_name, 'w+');

$db_account 		= new DbConnect_account();
$db_cash 			= new DbConnect_cash();
$db_character 		= new DbConnect_character();

	
$query1 = $db_character->query("SELECT * FROM user_character");
$stats1 = $db_character->fetchNum($query1);

$query2 = $db_account->query("SELECT * FROM user_profile");
$stats2 = $db_account->fetchNum($query2);

$query3 = $db_account->query("SELECT * FROM user_profile WHERE login_flag = '1100' ");
$stats3 = $db_account->fetchNum($query3);

$query4 = $db_account->query("SELECT * FROM user_profile WHERE login_tag = 'N' ");
$stats4 = $db_account->fetchNum($query4);

$query5 = $db_character->query("SELECT * FROM guild_info ");
$stats5 = $db_character->fetchNum($query5);

$query6 = $db_character->query("SELECT * FROM cm_bcd_item ");
$stats6 = $db_character->fetchNum($query6);

$query7 = $db_character->query("SELECT * FROM del_user_char_list ");
$stats7 = $db_character->fetchNum($query7);

	

$str = "";
$str.= "<?php\r\n";
$str.= "\$server_stats_total_characters = \"$stats1\";\r\n";
$str.= "\$server_stats_total_accounts = \"$stats2\";\r\n";
$str.= "\$server_stats_total_accounts_online = \"$stats3\";\r\n";
$str.= "\$server_stats_total_banned = \"$stats4\";\r\n";
$str.= "\$server_stats_total_guilds = \"$stats5\";\r\n";
$str.= "\$server_stats_total_df = \"$stats6\";\r\n";
$str.= "\$server_stats_total_del_char = \"$stats7\";\r\n";
$str.= "?>\r\n";

fwrite($handle, $str);
fclose($handle);



echo "<script type='text/javascript'>window.location='admin.php';</script>";
die();


?>