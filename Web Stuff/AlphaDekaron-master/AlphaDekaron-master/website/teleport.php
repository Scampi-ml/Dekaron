<?php
if(ALLOW_OPEN != '1') 
{
	Header('HTTP/1.1 403');
	exit(0);
}
else
{
	
	if ($_SESSION['isGM'] != '2')
	{
		Header('HTTP/1.1 403');
		exit(0);
	}
}
$fd = fopen ($mapsPath, "r");
if ($fd)
{
	$maps = array();
	fgetcsv($fd, 4096);
	while ($buffer = fgetcsv($fd, 4096)) 
	{
		$maps[$buffer[0]] = $buffer[1];
	}
	fclose ($fd);

	if($_POST['go'] == "Teleport" & !empty($_POST['charname']))
	{
		$check = mssql_query("SELECT count(user_no) as count, user_no from character.dbo.user_character where character_name = '".mssql_escape($_POST['charname'])."' group by user_no");
		$count = mssql_fetch_array($check);
		if ($count[0] == '1')
		{
			$onQuery = mssql_query("Select login_flag from account.dbo.user_profile where user_no = '".mssql_escape($count[1])."'");
			$isOn = mssql_fetch_array($onQuery);
			if ($isOn[0] == '0')
			{
				If (!ctype_digit($_POST['xval']) || !ctype_digit($_POST['yval']))
				{
					echo 'X and Y values can only be whole numbers!';
				}
				else
				{
					if (empty($_POST['xval'])){$_POST['xval'] = 0;}
					if (empty($_POST['yval'])){$_POST['yval'] = 0;}
					mssql_query("UPDATE character.dbo.user_character SET wPosX = '".mssql_escape($_POST['xval'])."', wPosY = '".mssql_escape($_POST['yval'])."', wMapIndex = '".mssql_escape($_POST['mapsel'])."' where character_name = '".mssql_escape($_POST['charname'])."'");
					echo htmlspecialchars($_POST['charname']),' successfully teleported!';
				}
			}
			else
			{
				echo 'Account is online.';
			}
		}
		else
		{
			echo 'Character not found!';
		}
	}
	else
	{
		$aValues = array_keys($maps);
		$count = count($aValues);
		echo '<table><form action=?do=teleport method=POST><tr><td class=header>Teleport Character</td></tr>
		<tr><td>Character:<br><input type=text name=charname /></td></tr>
		<tr><td>Map:<br><select name=mapsel>';
		$i=0;
		do 
		{
			echo '<option value="',htmlspecialchars($aValues[$i]),'">',htmlspecialchars($maps[$aValues[$i]]),'</option>';
			$i+=1;
		}while($i <> $count);
		echo '</select></td></tr>
		<tr><td>X: <input type=text name=xval /> Y: <input type=text name=yval /></td></tr>
		<tr><td><input type=submit name=go value=Teleport /></td></tr>
		</form></table>';
	}
}
else
{
	echo 'Unable to open map list!';
}
?>