<?php
if(ALLOW_OPEN != 1 && ALLOW_OPEN != 2) {
Header('HTTP/1.1 403');
exit(0);
}
$msdb = mssql_select_db("character");
if ($_GET['type'] == 'highlevel' or empty($_GET['type']))
{
	$pplist = mssql_query("select top 100 character.dbo.user_character.character_name, character.dbo.user_character.wLevel, character.dbo.user_character.dwExp, character.dbo.guild_info.guild_name from character.dbo.user_character left join account.dbo.user_profile on character.dbo.user_character.user_no = account.dbo.user_profile.user_no left join character.dbo.guild_char_info on character.dbo.user_character.character_name = character.dbo.guild_char_info.character_name left join character.dbo.guild_info on character.dbo.guild_char_info.guild_code = character.dbo.guild_info.guild_code where account.dbo.user_profile.login_tag <> 'N' and (character.dbo.guild_info.guild_name <> 'Alpha Staff' or character.dbo.guild_info.guild_name is null) order by character.dbo.user_character.wLevel Desc, character.dbo.user_character.dwExp desc");
	$count = 1;
	echo "<table><tr><td colspan=4 class=header>Top 100 Highest Levels</td></tr><tr><td colspan=4 class=submenu><a href=?do=top100&type=highlevel>Highest levels</a> | <a href=?do=top100&type=pk>PKers</a> | <a href=?do=top100&type=pvp>PvPers</a></td></tr>";
	echo "<tr><td><b><u>Rank</u></b></td><td><b><u>Name</u></b></td><td><b><u>Guild</u></b></td><td><b><u>Level</u></b></td></tr>";
	while($list = mssql_fetch_array($pplist))
	{
			echo "<tr><td>$count</td>";	
			echo "<td>",htmlspecialchars($list['character_name']),"</td>";
			$search = strstr($list['guild_name'], "<color=");
			if ($search != false)
			{
				if (preg_match ('/<color=(.*)>(.*)/', $list['guild_name'], $matchesarray))
				{
					if(!preg_match('/[a-fA-F0-9]{6}/', $matchesarray[1], $matchesarray2))
					{
						echo "<td>",htmlspecialchars($list['guild_name']),"</td>";
						
					}
					else
					{
						echo '<td  ';
						if ($matchesarray[1] == '2a2a2a')
						{
							echo 'bgcolor=000000';
						}
						echo '><span style=color:',$matchesarray[1],';>',htmlspecialchars($matchesarray[2]),'</span></td>';
					}
				}
			}
			else
			{
				echo "<td>",htmlspecialchars($list['guild_name']),"</td>";
			}
			
			echo "<td>",htmlspecialchars($list['wLevel']),"</td></tr>";
			$count ++;
	}
		echo "</table>";
}
elseif($_GET['type'] == 'pk')
{
	$pplist = mssql_query("select top 100 user_character.character_name as wChar , wPKCount, guild_name as wGuild from user_character left join account.dbo.user_profile on account.dbo.user_profile.user_no = user_character.user_no left join guild_char_info on user_character.character_name = guild_char_info.character_name left join guild_info on guild_char_info.guild_code = guild_info.guild_code WHERE wPKCount > '0' and account.dbo.user_profile.login_tag = 'Y' and (character.dbo.guild_info.guild_name <> 'Alpha Staff' or character.dbo.guild_info.guild_name is null) order by wPKCount desc");
	$count = 1;
	echo "<table><tr><td colspan=3 class=header>Top 100 PKers</td></tr><tr><td colspan=4 class=submenu><a href=?do=top100&type=highlevel>Highest levels</a> | <a href=?do=top100&type=pk>PKers</a> | <a href=?do=top100&type=pvp>PvPers</a></td></tr>";
	echo "<tr><td><b><u>Rank</u></u></td><td><b><u>Name</u></b></td><td><b><u>PK Points</u></b></td></tr><tr>";

	while($list = mssql_fetch_array($pplist))
	{
			echo "<td>$count</td>";
			echo "<td>",htmlspecialchars($list['wChar']),"</td>";
			echo "<td>",htmlspecialchars( $list['wPKCount']),"</td></tr><tr>";
			$count ++;
	}
	echo "</tr></table>";
}
else
{
	$pplist = mssql_query("select top 100 user_character.character_name as wChar ,dwPVPpoint, wWinRecord, wLoseRecord, wLevel, guild_name as wGuild, round(((case when wLoseRecord=0 then 9999 else cast(wWinRecord as decimal)/cast(wLoseRecord as decimal)end)),3) as ratio from user_character left join account.dbo.user_profile on account.dbo.user_profile.user_no = user_character.user_no left join guild_char_info on user_character.character_name = guild_char_info.character_name left join guild_info on guild_char_info.guild_code = guild_info.guild_code WHERE (wWinRecord > 0 or wLoseRecord > 0) and account.dbo.user_profile.login_tag = 'Y' and (character.dbo.guild_info.guild_name <> 'Alpha Staff' or character.dbo.guild_info.guild_name is null) order by dwPVPpoint desc, ratio desc, wLoseRecord asc, wWinRecord desc");
	$count = 1;
	echo "<table><tr><td colspan=7 class=header>Top 100 PvPers</td></tr><tr><td colspan=7 class=submenu><a href=?do=top100&type=highlevel>Highest levels</a> | <a href=?do=top100&type=pk>PKers</a> | <a href=?do=top100&type=pvp>PvPers</a></td></tr>";
	echo "<tr><td><b><u>Rank</u></b></td><td><b><u>Name</u></b></td><td><b><u>Guild</u></b></td><td><b><u>Points</u></b></td><td><b><u>Wins</u></b></td><td><b><u>Losses</u></b></td><td><b><u>W/L Ratio</u></b></td></tr><tr>";
	
	while($list = mssql_fetch_array($pplist) )
	{
			echo "<td>$count</td>";
			echo "<td>",htmlspecialchars($list['wChar']),"</td>";
			$search = strstr($list['wGuild'], "<color=");
			if ($search != false)
			{
				if (preg_match ('/<color=(.*)>(.*)/', $list['wGuild'], $matchesarray))
				{
					if(!preg_match ('/[a-fA-F0-9]{6}/', $matchesarray[1], $matchesarray2))
					{
						echo "<td>",htmlspecialchars($list['wGuild']),"</td>";
						
					}
					else
					{
						echo '<td  ';
						if ($matchesarray[1] == '2a2a2a')
						{
							echo 'bgcolor=000000';
						}
						echo '><span style=color:',$matchesarray[1],';>',htmlspecialchars($matchesarray[2]),'</span></td>';
					}
				}
			}
			else
			{
				echo "<td>",htmlspecialchars($list['wGuild']),"</td>";
			}
			echo "<td>",htmlspecialchars($list['dwPVPpoint']),"</td>";
			echo "<td>",htmlspecialchars($list['wWinRecord']),"</td>";
			echo "<td>",htmlspecialchars($list['wLoseRecord']),"</td>";
			echo "<td>";
			if ($list['wLoseRecord'] == 0)
			{
				echo "<B>Undefeated!</B>";
			}
			else
			{
				echo htmlspecialchars(round($list['ratio'], 2));
			}
			echo "</td></tr><tr>";
			$count++;
		
	}
		echo "</tr></table>";
}
?>