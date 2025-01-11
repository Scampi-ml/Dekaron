<?php

error_reporting(0);
ini_set("display_error", false); 

$file = 'guild';
include("config/lang.conf.php");
if(file_exists("config/language/".$controlpanel_language."/script/".$file.".php")) {
	include("config/language/".$controlpanel_language."/script/".$file.".php");
} else {
	include("config/language/english/script/".$file.".php");
}

include("config/mssql.conf.php");

echo "<center>";

if(empty($_GET['gid'])) {

	echo $language['head1']."<br><font size='1'>".$language['head1small']."</font><br>";

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
		SELECT g.guild_code,g.guild_name,g.guild_Level,g.ipt_date,g.upt_date,
		(SELECT COUNT(*) FROM character.dbo.GUILD_CHAR_INFO WHERE guild_code = g.guild_code) AS guildcount,
		(SELECT character_name FROM character.dbo.GUILD_CHAR_INFO WHERE guild_code = g.guild_code AND peerage_code = '0') AS guildleader
		FROM character.dbo.GUILD_INFO AS g
		ORDER BY guildcount DESC",$con);

	$i = '1';

	while($row1 = mssql_fetch_row($result1)) {

		if($i >= '1' && $row1[5] >= '1' && $row1[2] < '99' && $i <= '20') {

			list($ipt_month,$ipt_day,$ipt_year,$ipt_data_time) = explode(" ",$row1[3]);
			list($ipt_hour,$ipt_minutes,$ipt_second,$ipt_other) = explode(":",$ipt_data_time);
			list($upt_month,$upt_day,$upt_year,$upt_data_time) = explode(" ",$row1[4]);
			list($upt_hour,$upt_minutes,$upt_second,$upt_other) = explode(":",$upt_data_time);

			if($ipt_other[3] == 'P' && $ipt_other[4] == 'M') {
				$ipt_hour = $ipt_hour+12;
			}

			if($upt_other[3] == 'P' && $upt_other[4] == 'M') {
				$upt_hour = $upt_hour+12;
			}

			$ipt_time = $ipt_day.".".$ipt_month.".".$ipt_year." - ".$ipt_hour.":".$ipt_minutes;
			$upt_time = $upt_day.".".$upt_month.".".$upt_year." - ".$upt_hour.":".$upt_minutes;

			echo "<tr>
				<td align='center'>".$i."</td>
				<td align='center'><a href='".$_SERVER['PHP_SELF']."?gid=".$row1[0]."' target='_self'>".$row1[1]."</a></td>
				<td align='center'>".$row1[2]."</td>
				<td align='center'>".$row1[6]."</td>
				<td align='center'>".$row1[5]."</td>
				<td align='center'>".$ipt_time." ".$language['split_6_7']."</td>
				<td align='center'>".$upt_time." ".$language['split_6_7']."</td>
			</tr>";

			$i++;

		}

	}

	echo "</table>";

} else {

	$con = mssql_connect($mssql['host'],$mssql['user'],$mssql['pass']) or die($language['mssql_e1']);

	$result1 = mssql_query("
		SELECT g.character_name,g.ipt_time,
		(SELECT peerage_name FROM character.dbo.GUILD_PEERAGE WHERE guild_code = g.guild_code AND peerage_code = g.peerage_code) AS peeragename,
		(SELECT wLevel FROM character.dbo.user_character WHERE character_name = g.character_name) AS charlevel
		FROM character.dbo.GUILD_CHAR_INFO AS g
		WHERE guild_code = '".$_GET['gid']."'",$con);

	$result2 = mssql_query("SELECT guild_name FROM character.dbo.GUILD_INFO WHERE guild_code = '".$_GET['gid']."'",$con);
	$row2 = mssql_fetch_row($result2);

	echo "<center>".$language['head2']." <b>".$row2[0]."</b><br><font size='1'>".$language['head2small']."</font><br>";

	echo "<table border='1'>
		<tr>
			<td align='center'>".$language['split8']."</td>
			<td align='center'>".$language['split9']."</td>
			<td align='center'>".$language['split10']."</td>
			<td align='center'>".$language['split11']."</td>
		</tr>";

	while($row1 = mssql_fetch_row($result1)) {

			echo "<tr>
				<td align='center'>".$row1[0]."</td>
				<td align='center'>".$row1[3]."</td>
				<td align='center'>".$row1[2]."</td>
				<td align='center'>".$row1[1]." ".$language['split_6_7']."</td>
			</tr>";

	}

	echo "</table><br><a href='".$_SERVER['PHP_SELF']."' target='_self'>".$language['back']."</a>";

}

echo "</center>";

?>

	

