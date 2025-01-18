 <?php

// show errors if any
error_reporting(E_ALL);

// dont let it timeout
set_time_limit(0);

// mssql host
$mssql_host = "46.251.49.201";

// mssql user
$mssql_user = "janvier123";

// mssql password
$mssql_pasw = "0000000000000";


// connect to server
$conn = mssql_pconnect($mssql_host, $mssql_user, $mssql_pasw) or die(mssql_get_last_message());

// the items (CLASS = > ITEM ID)
// CHECK THE IDS!!!!!
//item ids can be found in /share/item/itemetc.csv
$items_array = array(
    '0' => "14685", // Azure Knight
    '1' => "14691", // Segita Hunter 
    '2' => "14697", // Incar Magician
    '3' => "14703", // Vicious Summoner
    '4' => "14709", // Segnale
    '5' => "14715", // Bagi Warrior
    '6' => "14721", // Aloken
    '9' => "14727", // Dark Wizard
    '10' => "14733", // Concerra Summoner
    '11' => "14739", // Segeuriper
    '12' => "14745" // Half Bagi
);


// start count
$i = '0';

// run query
$query = mssql_query("SELECT byPCClass,character_no FROM character.dbo.user_character", $conn);    
while($char = mssql_fetch_array($query))
{


	mssql_query("EXEC character.dbo.SP_POST_SEND_OP2 '".$char['character_no']."','Beyond-Dk',1,'Christmas Gift','Merry Christmas and a Happy New Year!','60008','0','15', 0", $conn);

    $i++;
}

// echo out
echo 'All done, ' . $i . ' items send';

?> 