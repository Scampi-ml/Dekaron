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

if (empty($_POST['data']) && empty($_POST['type']) && empty($_GET['type']) && empty($_GET['data']))
{
	echo "<table><Form action=?do=lookup Method=POST><tr><td class=header>Master Lookup</td></tr>
	<tr><td><select name=type><option value=account selected>Account</option><option value=ip>IP</option><option value=char>Character</option></select><input name=data type=text></td></tr>
	<tr><td><input name=submit type=submit value=Go!></td></tr></form></table>";
}
elseif ((!empty($_POST['data']) && $_POST['type'] == 'account') or ($_GET['type'] == 'account' && !empty($_GET['data'])) or (!empty($_POST['data']) && $_POST['type'] == 'char'))
{
	if ($_GET['type'] == 'account')
	{
		$data = $_GET['data'];
	} 
	else 
	{
		$data = $_POST['data'];
	}
	if ($_POST['type'] == 'char')
	{
		$query = mssql_query("select user_id from account.dbo.user_profile left join character.dbo.user_character on account.dbo.user_profile.user_no = character.dbo.user_character.user_no where character_name = '".mssql_escape($data)."'");
		$rows = mssql_num_rows($query);
		if ($rows == '1')
		{
			$fetch = mssql_fetch_array($query);
			$data = $fetch[0];
		}
		else
		{
			$data = '';
			$error = 'Character';
		}
	}
	else
	{
	$error = 'Account';
	}
	
	$query = mssql_query("Select count(user_id), user_no from account.dbo.user_profile where user_id = '".mssql_escape($data)."' group by user_no");
	$fetch = mssql_fetch_array($query);
	if ($fetch[0] == '1')
	{
		echo '<table><tr><td class=header>Account Lookup for ',htmlspecialchars($data),'</td></tr>';
		echo '<tr><td class=header>Characters</td></tr>';
		$query2 = mssql_query("Select character_name from character.dbo.user_character where user_no = '".mssql_escape($fetch[1])."'");
		while ($fetch2 = mssql_fetch_array($query2))
		{
			echo '<tr><td>',htmlspecialchars($fetch2[0]),'</td></tr>';
		}
		$linked = array();
		$query = mssql_query("select distinct Cast(Cast(SubString(conn_ip, 1, 1) AS Int) As Varchar(3)) + '.' + Cast(Cast(SubString(conn_ip, 2, 1) AS Int) As Varchar(3)) + '.' + Cast(Cast(SubString(conn_ip, 3, 1) AS Int) As Varchar(3)) + '.' + Cast(Cast(SubString(conn_ip, 4, 1) AS Int) As Varchar(3)), user_id from account.dbo.user_connlog_key left join account.dbo.user_profile on account.dbo.user_profile.user_no = account.dbo.user_connlog_key.user_no where user_id = '".mssql_escape($data)."'");
		echo '<tr><td class=header>Account Links</td></tr>';
		while ($fetch = mssql_fetch_array($query))
			{
				$query2 = mssql_query("select distinct user_id from account.dbo.user_connlog_key left join account.dbo.user_profile on account.dbo.user_profile.user_no = account.dbo.user_connlog_key.user_no where user_id <> '".mssql_escape($data)."' and Cast(Cast(SubString(conn_ip, 1, 1) AS Int) As Varchar(3)) + '.' + Cast(Cast(SubString(conn_ip, 2, 1) AS Int) As Varchar(3)) + '.' + Cast(Cast(SubString(conn_ip, 3, 1) AS Int) As Varchar(3)) + '.' + Cast(Cast(SubString(conn_ip, 4, 1) AS Int) As Varchar(3)) = '".mssql_escape($fetch[0])."'");
					while ($fetch2 = mssql_fetch_array($query2))
					{
						if (!in_array($fetch2[0], $linked))
						{
							$linked[] = $fetch2[0];
						}
					}
		}
		$count = count($linked);
		if ($count > 0)
		{
			$i = 0;
			do
			{
				echo '<tr><td><a href="?do=lookup&type=account&data=',htmlspecialchars($linked[$i]),'">',htmlspecialchars($linked[$i]),'</a></td></tr>';
				$i += 1;
			}while($i < $count);
		}
		else
		{
			echo '<tr><td>No linked accounts</td></tr>';
		}
		echo '<tr><td class=header>Unique IPs</td></tr>';
		$query = mssql_query("select distinct Cast(Cast(SubString(conn_ip, 1, 1) AS Int) As Varchar(3)) + '.' + Cast(Cast(SubString(conn_ip, 2, 1) AS Int) As Varchar(3)) + '.' + Cast(Cast(SubString(conn_ip, 3, 1) AS Int) As Varchar(3)) + '.' + Cast(Cast(SubString(conn_ip, 4, 1) AS Int) As Varchar(3)), user_id from account.dbo.user_connlog_key left join account.dbo.user_profile on account.dbo.user_profile.user_no = account.dbo.user_connlog_key.user_no where user_id = '".mssql_escape($data)."'");
			$rows = mssql_num_rows($query);
			if ($rows > '0')
			{
				while ($fetch = mssql_fetch_array($query))
				{
				echo '<tr><td><a href="?do=lookup&type=ip&data=',htmlspecialchars($fetch[0]),'">',htmlspecialchars($fetch[0]),'</a></td></tr>';
				}
			}
			else
			{
				echo '<tr><td>No linked IPs</td></tr>';
			}
			echo '</table>';
	}
	elseif($fetch[0] > '1')
	{
		echo "<table><Form action=?do=lookup Method=POST><tr><td class=header>Master Lookup</td></tr>
	<tr><td><select name=type><option value=account selected>Account</option><option value=ip>IP</option><option value=char>Character</option></select><input name=data type=text></td></tr>
	<tr><td><input name=submit type=submit value=Go!></td></tr></form><tr><td>Please contact the administrator and tell him, \"The shit has hit the fan!\"</td></tr></table>";
	}
	else
	{
		echo "<table><Form action=?do=lookup Method=POST><tr><td class=header>Master Lookup</td></tr>
	<tr><td><select name=type><option value=account selected>Account</option><option value=ip>IP</option><option value=char>Character</option></select><input name=data type=text></td></tr>
	<tr><td><input name=submit type=submit value=Go!></td></tr></form><tr><td>",$error," not found!</td></tr></table>";
	}
}
elseif (!empty($_POST['data']) && $_POST['type'] == 'ip' or ($_GET['type'] == 'ip' && !empty($_GET['data'])))
{
	if ($_GET['type'] == 'ip')
	{
		$data = $_GET['data'];
	} 
	else 
	{
		$data = $_POST['data'];
	}
	$query = mssql_query("Select count(conn_ip) from account.dbo.user_connlog_key where Cast(Cast(SubString(conn_ip, 1, 1) AS Int) As Varchar(3)) + '.' + Cast(Cast(SubString(conn_ip, 2, 1) AS Int) As Varchar(3)) + '.' + Cast(Cast(SubString(conn_ip, 3, 1) AS Int) As Varchar(3)) + '.' + Cast(Cast(SubString(conn_ip, 4, 1) AS Int) As Varchar(3)) = '".mssql_escape($data)."'");
	$fetch = mssql_fetch_array($query);
	if ($fetch[0] > '0')
	{
		$query = mssql_query("select distinct user_id from account.dbo.user_connlog_key left join account.dbo.user_profile on account.dbo.user_profile.user_no = account.dbo.user_connlog_key.user_no where Cast(Cast(SubString(conn_ip, 1, 1) AS Int) As Varchar(3)) + '.' + Cast(Cast(SubString(conn_ip, 2, 1) AS Int) As Varchar(3)) + '.' + Cast(Cast(SubString(conn_ip, 3, 1) AS Int) As Varchar(3)) + '.' + Cast(Cast(SubString(conn_ip, 4, 1) AS Int) As Varchar(3)) = '".mssql_escape($data)."'");
		echo '<table><tr><td class="header">IP Lookup for ',htmlspecialchars($data),'</td></tr>';
		while ($fetch = mssql_fetch_array($query))
		{
			echo '<tr><td><a href="?do=lookup&type=account&data=',htmlspecialchars($fetch[0]),'">',htmlspecialchars($fetch[0]),'</a></td></tr>';
		}
		echo '</table>';
	}
	else
	{
		echo "<table><Form action=?do=lookup Method=POST><tr><td class=header>Master Lookup</td></tr>
	<tr><td><select name=type><option value=account>Account</option><option value=ip selected>IP</option><option value=char>Character</option></select><input name=data type=text></td></tr>
	<tr><td><input name=submit type=submit value=Go!></td></tr></form><tr><td>IP not found!</td></tr></table>";
	}
}
else
{
	echo "<table><Form action=?do=lookup Method=POST><tr><td class=header>Master Lookup</td></tr>
	<tr><td><select name=type><option value=account selected>Account</option><option value=ip>IP</option><option value=char>Character</option></select><input name=data type=text></td></tr>
	<tr><td><input name=submit type=submit value=Go!></td></tr></form><tr><td>Invalid Action!</td></tr></table>";
}
?>