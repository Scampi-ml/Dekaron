<?php

error_reporting(0);
ini_set("display_error", false); 

$file = 'playeronline';
include("config/lang.conf.php");
if(file_exists("config/language/".$controlpanel_language."/script/".$file.".php")) {
	include("config/language/".$controlpanel_language."/script/".$file.".php");
} else {
	include("config/language/english/script/".$file.".php");
}

include("config/mssql.conf.php");

echo "<center>".$language['head1']."<br>";

echo "<table border='1'>
	<tr>
		<td align='center'>".$language['split1']."</td>
		<td align='center'>".$language['split2']."</td>
		<td align='center'>".$language['split3']."</td>
	</tr>";

$con = mssql_connect($mssql['host'],$mssql['user'],$mssql['pass']) or die($language['mssql_e1']);

$result1 = mssql_query("SELECT user_no FROM account.dbo.USER_PROFILE WHERE login_flag = '1100'",$con);

$classes = array('0' => "Azure Knight", '1' => "Segita Hunter", '2' => "Incar Magician", '3' => "Vicious Summoner", '4' => "Segnale", '5' => "Bagi Warrior");  

while($row1 = mssql_fetch_row($result1)) {
	
	$result2 = mssql_query("SELECT character_name,wLevel,byPCClass FROM character.dbo.user_character WHERE user_no = '".$row1[0]."' ORDER by login_time DESC",$con);
	$row2 = mssql_fetch_row($result2);

	if(!preg_match("/[[GM]]/i",$row2[0])) {

		echo "<tr>
			<td align='center'>".$row2[0]."</td>
			<td align='center'>".$row2[1]."</td>
			<td align='center'>".$classes[$row2[2]]."</td>
		</tr>";

	}

}

echo "</table></center>";

?>