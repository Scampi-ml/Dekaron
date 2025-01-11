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
echo '<table><tr><td class=header colspan=5>Account Authority Management</td></tr>';
if($_POST['charSet'] == 'Set' && !empty($_POST['charauth']) && !empty($_POST['charname']))
{
	$query = mssql_query("select account.dbo.user_profile.login_flag from account.dbo.user_profile left join character.dbo.user_character on character.dbo.user_character.user_no = account.dbo.user_profile.user_no where character_name = '".mssql_escape($_POST['charname'])."'");
	$count = mssql_num_rows($query);
	if ($count == 1)
	{
		$fetch = mssql_fetch_array($query);
		if ($fetch[0] == '0')
		{
			$name = str_replace('[GM]', '', $_POST['charname']);
			$name = str_replace('[DEV]', '', $name);
			$name = str_replace('[DEKARON]', '', $name);
			if ($_POST['charauth'] == 'none')
			{
				$name = $name;
			}
			else
			{
				$name = '['.$_POST['charauth'].']'.$name;
			}
			$query = mssql_query("select character_name from character.dbo.user_character where character_name = '".mssql_escape($name)."'");
			$count = mssql_num_rows($query);
			if ($count == 0)
			{
				mssql_query("UPDATE character.dbo.user_character set character_name = '".mssql_escape($name)."' where character_name = '".mssql_escape($_POST['charname'])."'");
				echo '<tr><td>',htmlspecialchars($_POST['charname']),' has been succesfully renamed to ',htmlspecialchars($name),'.</td></tr>';
			}
			else
			{
				echo '<tr><td>',htmlspecialchars($name),' is taken.</td></tr>';
			}
		}
		else
		{
			echo '<tr><td>Account is online.</td></tr>';
		}
	}
	else
	{
		echo '<tr><td>Character not found.</td></tr>';
	}
	echo '</table>';
}
elseif (!empty($_GET['acct']))
{
	$query = mssql_query("SELECT account from osds.dbo.auth where account = '".mssql_escape($_GET['acct'])."'");
	$count = mssql_num_rows($query);
	if ($count == '1')
	{
		$query = mssql_query("select character_name from character.dbo.user_character left join account.dbo.tbl_user on account.dbo.tbl_user.user_no = character.dbo.user_character.user_no where account.dbo.tbl_user.user_id = '".mssql_escape($_GET['acct'])."'");
		echo '<form action=?do=authority method=post><tr><td>Character: <select name=charname>';
		while($fetch = mssql_fetch_array($query))
		{
			echo '<option value="',htmlspecialchars($fetch[0]),'" selected>',htmlspecialchars($fetch[0]),'</option>';
		}
		echo '</select></td></tr><tr><td>Authority: <select name=charauth><option value=none selected>None</option><option value=GM>GM</option><option value=DEV>DEV</option><option value=DEKARON>DEKARON</option></select></td></tr><tr><td colspan=2><input type=submit name=charSet value=Set></input></td></tr></form>';
	}
	elseif($count > '1')
	{
		echo '<tr><td>The shit has hit the fan.</td></tr></table>';
	}
	else
	{
		echo '<tr><td>Account is not of elevated authority.</td></tr></table>';
	}
}
else
{
	if($_GET['type'] == 'Delete' && !empty($_GET['delacct']))
	{
		mssql_query("DELETE FROM osds.dbo.auth where account = '".mssql_escape($_GET['delacct'])."'");
		echo '<tr><td>Account ',htmlspecialchars($_GET['delacct']),' successfully removed!</td></tr></table>';
	}
	elseif(empty($_POST['type'])) 
	{
		$acctQuery = mssql_query("SELECT * FROM osds.dbo.auth");
		echo '<form action=?do=authority method=POST><tr><td><b><u>Account</u></b></td><td><b><u>Authority</u></b></td><td><b><u>News Post</u></b></td></tr>';
		while ($acct = mssql_fetch_array($acctQuery))
		{
			if ($acct[1] == '2'){$acct[1] = 'Admin';}
			if ($acct[1] == '1'){$acct[1] = 'GM';}
			echo '<tr><td><a href="?do=authority&acct=',htmlspecialchars($acct[0]),'">',htmlspecialchars($acct[0]),'</a></td>
			<td>',htmlspecialchars($acct[1]),'</td>
			<td>',htmlspecialchars($acct[2]),'</td>
			<td><a href="?do=authority&type=Delete&delacct=',htmlspecialchars($acct[0]),'">Remove</a></td></tr>';
		}
		echo '<tr><td colspan=4>Account: <input type=text name=acct /></td></tr><tr><td colspan=4>News name: <input type=text name=news /></td></tr><tr><td  colspan="4">Authority: <select name="auth"><option value="1" selected>GM</option><option value="2">Admin</option></select></td></tr><tr><td  colspan="4"><input name="type" type="submit" value="Add"/></td></tr></form>';
	}
		
	elseif($_POST['type'] == 'Add' && !empty($_POST['acct']) && !empty($_POST['auth']) && !empty($_POST['news']))
	{
		mssql_query("INSERT INTO osds.dbo.auth (account, auth, news) values ('".mssql_escape($_POST['acct'])."','".mssql_escape($_POST['auth'])."','".mssql_escape($_POST['news'])."')");
		echo '<tr><td>Account ',htmlspecialchars($_POST['acct']),' successfully added!</td></tr></table>';
	}
		
	else
	{
		echo '<tr><td>Invalid action!</td></tr></table>';
	}
}
?>