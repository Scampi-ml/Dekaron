<?php
error_reporting(0);
$content .= "<table border='0' width='100%' style='margin-left: 5px;'>
				<tr>
					<td align='center'><b>Pos</b></td>
					<td align='left'><b>Guild Name</b></td>
					<td align='center'><b>Level</b></td>
					<td align='left'><b>Leader</b></td>
					<td align='center'><b>Members</b></td>
				</tr>";

$con = mssql_connect("37.59.180.41","SaBaker1893","ImPP8pL0h");

$result1 = mssql_query("
	SELECT g.guild_code,g.guild_name,g.guild_Level,g.ipt_date,g.upt_date,
	(SELECT COUNT(*) FROM character.dbo.GUILD_CHAR_INFO WHERE guild_code = g.guild_code) AS guildcount,
	(SELECT character_name FROM character.dbo.GUILD_CHAR_INFO WHERE guild_code = g.guild_code AND peerage_code = '0') AS guildleader
	FROM character.dbo.GUILD_INFO AS g
	ORDER BY guildcount DESC",$con);

$i = '1';

while($row1 = mssql_fetch_row($result1))
{
	if($i >= '1' && $row1[5] >= '1' && $row1[2] < '99' && $i <= '20')
	{
		$content .= "<tr>
			<td align='center'>".$i."</td>
			<td align='left'>".$row1[1]."</td>
			<td align='center'>".$row1[2]."</td>
			<td align='left'>".$row1[6]."</td>
			<td align='center'>".$row1[5]."</td>
		</tr>";
		$i++;
	}
}
$content .= "</table>";



?>