<?php
$content .= "<table>
	<tr>
		<td align='center'>Pos</td>
		<td align='center'>Character Name</td>
		<td align='center'>Level</td>
		<td align='center'>Class</td>
		<td align='center'>Guild</td>
		<td align='center'>PKs</td>
		<td align='center'>PvPs</td>
	</tr>";

$con = mssql_connect("37.59.180.41","SaBaker1893","ImPP8pL0h");

$result1 = mssql_query("
	SELECT c.character_name,c.wLevel,c.byPCClass,c.dwPVPPoint,c.wPKCount,
	(SELECT guild_code FROM character.dbo.GUILD_CHAR_INFO WHERE character_name = c.character_name) AS guildcode
	FROM character.dbo.user_character AS c
	WHERE character_name <> '[' AND character_name <> ']' AND user_no < '9999999999' 
	ORDER BY wLevel DESC,dwExp DESC",$con);

$i = '1';

$classes = array('0' => "Azure Knight", '1' => "Segita Hunter", '2' => "Incar Magician", '3' => "Vicious Summoner", '4' => "Segnale", '5' => "Bagi Warrior", '6' => "Aloken", '9' => "Dark Wizard", '10' => "Concerra", '11' => "Segueriper", '12' => "Half Bagi");
while($row1 = mssql_fetch_row($result1))
{
	if($i >= '0' && $i <= '20')
	{ 
		if(!preg_match("/[[GM]]/i",$row1[0]))
		{
			if(empty($row1[5]))
			{
				$guildname = 'No Guild';
			}
			else
			{
				$result2 = mssql_query("SELECT guild_name FROM character.dbo.GUILD_INFO WHERE guild_code = '".$row1[5]."'",$con);
				$row2 = mssql_fetch_row($result2);
				$guildname = $row2[0];
			}
			$content .= "<tr>
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
$content .= "</table>";
?>