<?php
if(ALLOW_OPEN != '1') {
Header('HTTP/1.1 403');
exit;
}
$query = mssql_query("SELECT character_name ,dwPVPpoint, wWinRecord, wLoseRecord from character.dbo.user_character where user_no = '".mssql_escape($_SESSION['user_no'])."' order by dwPVPpoint desc, wWinRecord asc, wLoseRecord asc");
$count = mssql_num_rows($query);
echo '<table><tr><td class=header colspan=5>PVP Stats</tr>';
if ($count > 0)
{
	echo '<tr><td><b><u>Character</u></b></td><td><b><u>Points</u></b></td><td><b><u>Wins</u></b></td><td><b><u>Losses</u></b></td><td><b><u>W/L ratio</u></b></td></tr>';
	while($list = mssql_fetch_array($query))
	{
		echo '<tr><td>',htmlspecialchars($list[0]),'</td>
		<td>',htmlspecialchars($list[1]),'</td>
		<td>',htmlspecialchars($list[2]),'</td>
		<td>',htmlspecialchars($list[3]),'</td>
		<td>';
		if (($list[3] == 0 && $list[2] > 0) || ($list[2] ==0 && $list[3]==0))
		{
			echo "<B>Undefeated!</B>";
		}
		else
		{
			echo htmlspecialchars(round($list[2]/$list[3], 2));
		}
		echo '</td></tr>';
	}
}
else
{
	echo '<tr><td>This account does not have any characters.</td></tr>';
}
echo '</table>';
?>