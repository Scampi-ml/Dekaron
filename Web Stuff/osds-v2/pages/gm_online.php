
<center>
<?php
	if (ALLOW_OPEN != 1){
	exit("<br><img src='images/error_access.png'>");
	}
include "../config/mssql.conf.php";
/* -------------{The online GMs listing page by Zombe}------------- */ 
//        Don't edit below if you don't know what you are doing.
//			I KNOW WHATE IAM DOING! STOP CALLING ME A LITTLE BABY !
//			Greetz Janvier123 :)


$ms_con = mssql_connect($mssql['host'],$mssql['user'],$mssql['pass']);
 

$result1 = mssql_query(" 
                      SELECT * FROM character.dbo.user_character 
                      WHERE 
                      login_time > logout_time 
                      AND character_name LIKE '_GM%' 
                      ",$ms_con); 
$row1 = mssql_fetch_array($result1); 
$isgmon = $row1[character_name]; 

if ($isgmon) 
{ 
    echo " 
        <center> 
        <b><font size = 5>GMs online:</font><b><br><table border='1'><p>&nbsp 
        <tr> 
        <td align='center'><b>Char. Name</b></td> 
        <td align='center'><b>Class</b></td> 
        </tr> 
    "; 
     
     
    $result = mssql_query(" 
                          SELECT * FROM character.dbo.user_character 
                          WHERE 
                          login_time > logout_time 
                          AND character_name LIKE '_GM%' 
                          ",$ms_con); 
    while ($record = mssql_fetch_array($result)) 
    { 
        if ($record[byPCClass] == 0) $class = 'Azure Knight'; 
        if ($record[byPCClass] == 1) $class = 'Segita Hunter'; 
        if ($record[byPCClass] == 2) $class = 'Incar Magician'; 
        if ($record[byPCClass] == 3) $class = 'Vicious Summoner'; 
        if ($record[byPCClass] == 4) $class = 'Segnale'; 
        if ($record[byPCClass] == 5) $class = 'Bagi Warrior'; 
        if ($record[byPCClass] == 6) $class = 'Aloken'; 
        echo " 
            <tr> 
            <td align='center'>$record[character_name]</td> 
            <td align='center'>$class</td> 
            </tr> 
        "; 
    } 
    echo '</center>'; 
} 
else echo '<center><b><font size = 5>Currently no GMs online.</font></b></center>'; 
?> 


