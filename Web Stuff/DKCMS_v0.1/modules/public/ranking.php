<?php 
echo "<center><table border='0' width='100%' >
	<tr>
		<td align='left' class='shadetabs'>Rank</td>
		<td align='left' class='shadetabs'>Character</td>
		<td align='left' class='shadetabs'>Level</td>
		<td align='left' class='shadetabs'>Class</td>
		<td align='left' class='shadetabs'>Guild</td>
	</tr>
	";


$result1 = mssql_query("
	SELECT c.character_name,c.wLevel,c.byPCClass,c.dwPVPPoint,c.wPKCount,
	(SELECT guild_code FROM character.dbo.GUILD_CHAR_INFO WHERE character_name = c.character_name) AS guildcode
	FROM character.dbo.user_character AS c
	WHERE character_name <> '[' AND character_name <> ']' AND user_no < '9999999999' 
	ORDER BY wLevel DESC,dwExp DESC");

$i = '1';

$classes = array(
			'0' => "AK", 
			'1' => "SH", 
			'2' => "IM", 
			'3' => "VS", 
			'4' => "SE", 
			'5' => "BW",
			'6' => "AL"
				);  

while($row1 = mssql_fetch_row($result1)) {

	if($i >= '0' && $i <= '100') { 


		

			if(empty($row1[5])) {
				$guildname = "Guildless";
			} else {
				$result2 = mssql_query("SELECT guild_name FROM character.dbo.GUILD_INFO WHERE guild_code = '".$row1[5]."'");
				$row2 = mssql_fetch_row($result2);
				$guildname = $row2[0];
			}

			echo "<tr>
				<td >".$i."</td>
				<td >".$row1[0]."</td>
				<td >".$row1[1]."</td>
				<td >".$classes[$row1[2]]."</td>
				<td >".$guildname."</td>
			</tr>";

			$i++;

		}


}

echo "</table></center>";
?>

