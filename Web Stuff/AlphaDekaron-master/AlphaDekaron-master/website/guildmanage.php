<?php
if(ALLOW_OPEN != 1) {
Header('HTTP/1.1 403');
exit(0);
}
if(empty($_GET['gid']) && empty($_GET['cid']) && $_POST['tax'] <> 'Collect') 
{
	$guildlist = mssql_query("SELECT character_no, character.dbo.user_character.character_name, character.dbo.guild_char_info.guild_code, peerage_code, guild_name FROM character.dbo.user_character left join character.dbo.guild_char_info on character.dbo.guild_char_info.character_name = character.dbo.user_character.character_name left join character.dbo.guild_info on character.dbo.guild_char_info.guild_code = character.dbo.guild_info.guild_code WHERE user_no = '".$_SESSION['user_no']."' and peerage_code = '0'");
	$hasLead = mssql_num_rows($guildlist);
	if ($hasLead > 0)
	{
		echo "<table><tr><td colspan=2 class=header>Guild Management</td></tr><tr><td><b><u>Guild</u></b></td><td><b><u>Character</u></b></td></tr><tr>";
		while($list = mssql_fetch_array($guildlist))
		{
			echo '<td><a href="?do=guildmanage&gid='.$list['guild_code'].'&cid='.$list['character_no'].'">'.htmlspecialchars($list['guild_name']).'</a></td>';
			echo "<td>".$list[1]."</td></tr><tr>";
		}
		echo "</tr></table>";
	}
	else
	{
		echo 'None of your characters own any guilds to manage.';
	}
}
elseif (!empty($_GET['gid']) && !empty($_GET['cid']) && $_POST['tax'] <> 'Collect')
{
	$charQ = mssql_query("SELECT character.dbo.user_character.character_name, peerage_code FROM character.dbo.user_character left join character.dbo.guild_char_info on character.dbo.guild_char_info.character_name = character.dbo.user_character.character_name WHERE character_no = '".mssql_escape($_GET['cid'])."' AND user_no = '".mssql_escape($_SESSION['user_no'])."'");
	$num = mssql_num_rows($charQ);
	$charInfo = mssql_fetch_array($charQ);
	if ($num == '1' && $charInfo[1] == '0')
	{
		echo "<table><tr><td colspan=4 class=header>Guild Management</td></tr><tr><td><b><u>Name</u></b></td><td><b><u>Rank</u></b></td><td><b><u>Last Login</u></b></td><td><b><u>Level</u></b></td></tr><tr>";
		$guildList = mssql_query("SELECT character.dbo.guild_char_info.character_name, wLevel, login_time, peerage_name FROM character.dbo.guild_char_info left join character.dbo.user_character on character.dbo.user_character.character_name = character.dbo.guild_char_info.character_name left join character.dbo.guild_peerage on character.dbo.guild_peerage.peerage_code = character.dbo.guild_char_info.peerage_code where character.dbo.guild_peerage.guild_code = '".mssql_escape($_GET['gid'])."' and character.dbo.guild_char_info.guild_code = '".mssql_escape($_GET['gid'])."' order by character.dbo.guild_char_info.peerage_code asc, login_time desc");
		while ($guildArray = mssql_fetch_array($guildList))
		{
			echo "<td>",htmlspecialchars($guildArray[0]),"</td><td>",htmlspecialchars($guildArray[3]),"</td><td>",htmlspecialchars($guildArray[2]),"</td><td>",htmlspecialchars($guildArray[1]),"</td></tr><tr>";
		}
		echo "</tr>";
		$siege = mssql_query("SELECT guild_code, dtax FROM character.dbo.siege_info where siege_tag = 'Y'");
		$siegeInfo = mssql_fetch_array($siege);
		if ($siegeInfo[0] == $_GET['gid'])
		{
			echo '<tr><td colspan=4 class=header>Siege Owner</td></tr><form action=?do=guildmanage method=POST><tr><td colspan=4>D-coin taxes: ',htmlspecialchars($siegeInfo[1]),'</td><tr><td colspan=4><input type=submit name=tax value=Collect></td></tr></form></table>';		
		}
		else
		{
			echo '</table>';
		}
		
	}
	else
	{
		echo 'Data access error!';
	}

}
elseif ($_POST['tax'] == 'Collect')
{
	$ownQuery = mssql_query("select character.dbo.siege_info.guild_code, character.dbo.guild_char_info.character_name, user_no from character.dbo.siege_info left join character.dbo.guild_char_info on character.dbo.siege_info.guild_code = character.dbo.guild_char_info.guild_code and character.dbo.guild_char_info.peerage_code = '0' left join character.dbo.user_character on character.dbo.guild_char_info.character_name = character.dbo.user_character.character_name where siege_tag = 'Y'");
	$isOwner = mssql_fetch_array($ownQuery);
	if ($isOwner[2] == $_SESSION['user_no'])
	{
		$cashQuery = mssql_query("SELECT amount, free_amount FROM cash.dbo.user_cash WHERE user_no = ".mssql_escape($_SESSION['user_no'])."");
		$isCash = mssql_num_rows($cashQuery);
		if ($isCash == '1')
		{
			$taxQuery = mssql_query("SELECT dtax FROM character.dbo.siege_info where siege_tag = 'Y'");
			$isTax = mssql_fetch_array($taxQuery);
			if ($isTax[0] > 0)
			{
				mssql_query("UPDATE character.dbo.siege_info SET dtax = '0' where siege_tag = 'Y'");
				mssql_query("UPDATE cash.dbo.user_cash SET amount = amount + ".mssql_escape($isTax[0])." WHERE user_no = '".mssql_escape($_SESSION['user_no'])."'");
				echo 'You have received ',htmlspecialchars($isTax[0]),' coins.';
			}
			else
			{
				echo 'No taxes to collect!';
			}
		}
		else
		{
			echo 'Your character must visit the d-shop in game at least once before you can collect taxes.';
		}
	}
	else
	{
		echo 'Your account does not contain the character that owns the castle!';
	}
}
else
{
	echo 'Invalid Action!';
}
?>
