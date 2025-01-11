<?php
if(ALLOW_OPEN != '1') 
{
	Header('HTTP/1.1 403');
	exit(0);
}
else
{
	if ($_SESSION['isGM'] == '0')
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
	
	if ($_GET['type'] == 'disconnect' && !empty($_GET['ip']) && !empty($_GET['char']))
	{
		echo "<table><tr><td class=header colspan=1>Disconnect sent</td></tr>";
			system('start '.$cPath.' /close * 5005 '.$_GET['ip'].' *');
			system('start '.$cPath.' /close * 7880 '.$_GET['ip'].' *');
			echo '<tr><td>Disconnect command sent to the ip of "',htmlspecialchars($_GET['ip']),'".</td></tr>';
		echo "</table>";
	}
	else
	{
		$result = mssql_query("select p.user_id as uid, c.character_name as cnm, c.wlevel as clvl, c.wmapindex cmapi, c.bypcclass as ccls, c.login_time, vip FROM character.dbo.user_character c join account.dbo.user_profile p ON c.user_no = p.user_no left join account.dbo.tbl_user on c.user_no = account.dbo.tbl_user.user_no WHERE c.login_time IN (SELECT max(login_time) FROM character.dbo.user_character GROUP BY user_no) AND p.login_flag = '1100' and c.login_time is not null order by c.cnm asc");  
		$playerson = mssql_num_rows($result);
		$today = strtotime(date("n/j/Y g:i:s A"));
		echo "<table><tr><td class=header colspan=7>Players online: ($playerson)</td></tr> 
		        <td><b><u>Character</u></b></td> 
		        <td><b><u>Level</u></b></td>
		        <td><b><u>Class</u></b></td> 
		        <td><b><u>Map</u></b></td>
				<td><b><u>VIP</u></b></td>  
				<td><b><u>IP</u></b></td>
		        </tr>"; 
		while ($record = mssql_fetch_array($result)) 
		{ 
		$query = mssql_query("select top 1 Cast(Cast(SubString(conn_ip, 1, 1) AS Int) As Varchar(3)) + '.' + Cast(Cast(SubString(conn_ip, 2, 1) AS Int) As Varchar(3)) + '.' + Cast(Cast(SubString(conn_ip, 3, 1) AS Int) As Varchar(3)) + '.' + Cast(Cast(SubString(conn_ip, 4, 1) AS Int) As Varchar(3)) from account.dbo.user_connlog_key left join account.dbo.user_profile on account.dbo.user_profile.user_no = account.dbo.user_connlog_key.user_no where user_id = '".mssql_escape($record[uid])."' and account.dbo.user_profile.login_flag <> '0' order by account.dbo.user_connlog_key.login_time desc");
			$ipfetch = mssql_fetch_array($query);
			if ($record[ccls] == 0) $class = 'Knight'; 
			if ($record[ccls] == 1) $class = 'Hunter'; 
			if ($record[ccls] == 2) $class = 'Mage'; 
			if ($record[ccls] == 3) $class = 'Summoner'; 
			if ($record[ccls] == 4) $class = 'Segnale'; 
			if ($record[ccls] == 5) $class = 'Bagi'; 
			if ($record[ccls] == 6) $class = 'Aloken'; 
			if (array_key_exists($record[cmapi], $maps)) 
			{
		    $map = $maps[$record[cmapi]];
		  }
		  else
		  {
				$map = $record[cmapi];
			}
			if ($record['vip'] == '0' or (strtotime($record['vip']) < $today))
			{
				$vipStat = '<span style="color:red;">Expired</span>';
			}
			else
			{
				$vipStat = 'Not expired';
			}
			echo " <tr><td><a href='?do=lookup&type=account&data=",htmlspecialchars($record[uid]),"'>",htmlspecialchars($record[cnm]),"</a></td> 
						<td>",htmlspecialchars($record[clvl]),"</td> 
						<td>",htmlspecialchars($class),"</td> 
						<td>",htmlspecialchars($map),"</td>
						<td>",$vipStat,"</td>
						<td><a href='?do=lookup&type=ip&data=",htmlspecialchars($ipfetch[0]),"'>",htmlspecialchars($ipfetch[0]),"</a></td>
						<td><a href='?do=playeronline&type=disconnect&char=",htmlspecialchars($record[cnm]),"&ip=",htmlspecialchars($ipfetch[0]),"'>Disconnect</td></tr>"; 
		}
		echo '</table>';  
	}
}
?> 
