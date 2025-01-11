<?php

error_reporting(0);
ini_set("display_error", false); 

$file = 'ranking';
include("config/lang.conf.php");
if(file_exists("config/language/".$controlpanel_language."/script/".$file.".php")) {
	include("config/language/".$controlpanel_language."/script/".$file.".php");
} else {
	include("config/language/english/script/".$file.".php");
}

include("config/mssql.conf.php");

echo "<center>".$language['head1']."<br><font size='1'>".$language['head1small']."</font><br>";

echo "<table border='1'>
	<tr>
		<td align='center'>".$language['split1']."</td>
		<td align='center'>".$language['split2']."</td>
		<td align='center'>".$language['split3']."</td>
		<td align='center'>".$language['split4']."</td>
		<td align='center'>".$language['split5']."</td>
		<td align='center'>".$language['split6']."</td>
		<td align='center'>".$language['split7']."</td>
	</tr>";

$con = mssql_connect($mssql['host'],$mssql['user'],$mssql['pass']) or die($language['mssql_e1']);

$result1 = mssql_query("
	SELECT c.character_name,c.wLevel,c.byPCClass,c.dwPVPPoint,c.wPKCount,
	(SELECT guild_code FROM character.dbo.GUILD_CHAR_INFO WHERE character_name = c.character_name) AS guildcode
	FROM character.dbo.user_character AS c
	WHERE character_name <> '[' AND character_name <> ']' AND user_no < '9999999999' 
	ORDER BY wLevel DESC,dwExp DESC",$con);

$i = '1';

$classes = array('0' => "Azure Knight", '1' => "Segita Hunter", '2' => "Incar Magician", '3' => "Vicious Summoner", '4' => "Segnale", '5' => "Bagi Warrior");  

while($row1 = mssql_fetch_row($result1)) {

	if($i >= '0' && $i <= '50') { 

		if(!preg_match("/[[GM]]/i",$row1[0])) {

			if(empty($row1[5])) {
				$guildname = $language['split5_1'];
			} else {
				$result2 = mssql_query("SELECT guild_name FROM character.dbo.GUILD_INFO WHERE guild_code = '".$row1[5]."'",$con);
				$row2 = mssql_fetch_row($result2);
				$guildname = $row2[0];
			}

			echo "<tr>
				<td align='center'>".$i."</td>
				<td align='center'>".$row1[0]."</td>
				<td align='center'>".$row1[1]."</td>
				<td align='center'>".$classes[$row1[2]]."</td>
				<td align='center'>".$guildname."</td>
				<td align='center'>".$row1[4]."</td>
				<td align='center'>".$row1[3]."</td>
			</tr>";

			$i++;

		}

	}

}

echo "</table></center>";

?>

	

