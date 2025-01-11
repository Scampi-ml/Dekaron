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

echo "<a href=?do=banacc target=_self>Ban Account</a> | <a href=?do=banacc&sid=list target=_self>Ban/Unban Logs</a><br>";
if($_GET['sid'] == 'list') 
{
	$result = mssql_query("SELECT wDate, accountname, reason, wBy FROM osds.dbo.banned where type = 'b' order by wDate desc");
	echo "<table>
			<tr><td class=header colspan=5>Ban Log</td></tr>
			<tr><td><b><u>Date</u></b></td><td><b><u>Account</u></b></td>
				<td><b><u>Reason</u></b></td>
				<td><b><u>Issued by:</u></b></tr>";
	while($row = mssql_fetch_row($result)) 
	{
		echo "<tr>
				<td>".htmlspecialchars($row[0])."</td>
				<td>".htmlspecialchars($row[1])."</td>
				<td>".htmlspecialchars($row[2])."</td>
				<td>".htmlspecialchars($row[3])."</td>
				<td><a href='?do=banacc&sid=unban&aid=".htmlspecialchars($row[1])."'>Unban</a></td></tr>";
	}
	echo "</table>";
	
		$result = mssql_query("SELECT wDate, accountname, wBy FROM osds.dbo.banned where type = 'u' order by wDate desc");
			echo "<table>
			<tr><td class=header colspan=4>Unban Log</td></tr>
			<tr><td><b><u>Date</u></b></td>
				<td><b><u>Account</u></b></td>
				<td><b><u>Issued by:</u></b></tr>";
			while($row = mssql_fetch_row($result)) 
			{
				echo "<tr>
				<td>".htmlspecialchars($row[0])."</td>
				<td>".htmlspecialchars($row[1])."</td>
				<td>".htmlspecialchars($row[2])."</td>
			</tr>";
			}	
				echo "</table>";

} 
elseif($_GET['sid'] == 'unban' && !empty($_GET['aid'])) 
{
	$result = mssql_query("SELECT login_tag FROM account.dbo.USER_PROFILE WHERE user_id = '".mssql_escape($_GET['aid'])."'");
	$count = mssql_num_rows($result);
	$row = mssql_fetch_row($result);
	if($count < '1') 
	{
		echo "Could not find the account name<br><a href='javascript:history.back()'>Go Back</a>";
	} 
	elseif($count > '1') 
	{
		echo "There are multiple accounts with the same name found.
		<br>Please check this name in the database.
		<br><a href=javascript:history.back()>Go Back</a>";
	}
	elseif($row[0] == 'Y') 
	{
		echo "The account is not banned.
		<br><a href=javascript:history.back()>Go Back</a>";
	} 
	else 
	{
		mssql_query("UPDATE account.dbo.USER_PROFILE SET login_tag = 'Y' WHERE user_id = '".mssql_escape($_GET['aid'])."'");
		mssql_query("DELETE FROM osds.dbo.banned WHERE accountname = '".mssql_escape($_GET['aid'])."' and type = 'b'");
		mssql_query("INSERT INTO osds.dbo.banned (wDate, accountname, wBy, type) VALUES (getdate(), '".mssql_escape($_GET['aid'])."','".mssql_escape($_SESSION['news'])."', 'u')");
		echo 'The account ',$_GET['aid'],' was unbanned.';
	} 	
} 
else 
{
	if(empty($_POST['select'])) 
	{
			echo "<table><form action=?do=banacc method=POST>
			<tr><td class=header colspan=2>Ban Account</td></tr>
			<tr><td><select name=type><option value=account selected>Account Name</option><option value=charname>Character Name</option></select><input type=text name=dataname maxlength=20></td></tr>
			<tr><td>Reason:<br><input type=text name=reason maxlength=765></td></tr>";
			echo"<tr><td colspan=2><input type=submit name=select value='Ban Account'></td></tr>
			</form></table>";

	} 
	elseif($_POST['select'] == 'Ban Account') 
	{
		if($_POST['type'] == 'account') 
		{
			$result = mssql_query("SELECT login_tag FROM account.dbo.USER_PROFILE WHERE user_id = '".mssql_escape($_POST['dataname'])."'");
			$count = mssql_num_rows($result);
			$row = mssql_fetch_row($result);
			$accountname = $_POST['dataname'];
		} 
		else 
		{
			$result = mssql_query("SELECT account.dbo.user_profile.login_tag,user_id FROM account.dbo.USER_PROFILE left join character.dbo.user_character on character.dbo.user_character.user_no = account.dbo.user_profile.user_no WHERE character_name = '".mssql_escape($_POST['dataname'])."'");
			$count = mssql_num_rows($result);
			$row = mssql_fetch_row($result);
			$accountname = $row[1];
		}
		if($count < '1') 
		{
			echo "Could not find the account name.
			<br><a href=javascript:history.back()>Go Back</a>";
		} 
		elseif($count > '1') 
		{
				echo "Contact the administrator and tell him the shit has hit the fan.
				<br><a href=javascript:history.back()>Go Back</a>";
		} 
		elseif($row[0] == 'N') 
		{
				echo "The account is already banned.
				<br><a href=javascript:history.back()>Go Back</a>";
		} 
		else 
		{
			if (empty($_POST['reason']))
			{
				$_POST['reason'] = 'no reason';
			}
			mssql_query("UPDATE account.dbo.USER_PROFILE SET login_tag = 'N' WHERE user_id = '".mssql_escape($accountname)."'");
			mssql_query("INSERT INTO osds.dbo.banned (wDate, accountname,reason, wBy, type) VALUES (getdate(), '".mssql_escape($accountname)."','".mssql_escape($_POST['reason'])."','".mssql_escape($_SESSION['news'])."', 'b')");
			echo "The account '",htmlspecialchars($accountname),"' was successfully banned!<br>";
			$query = mssql_query("select top 1 Cast(Cast(SubString(conn_ip, 1, 1) AS Int) As Varchar(3)) + '.' + Cast(Cast(SubString(conn_ip, 2, 1) AS Int) As Varchar(3)) + '.' + Cast(Cast(SubString(conn_ip, 3, 1) AS Int) As Varchar(3)) + '.' + Cast(Cast(SubString(conn_ip, 4, 1) AS Int) As Varchar(3)) from account.dbo.user_connlog_key left join account.dbo.user_profile on account.dbo.user_profile.user_no = account.dbo.user_connlog_key.user_no where user_id = '".mssql_escape($accountname)."' and account.dbo.user_profile.login_flag <> '0' order by account.dbo.user_connlog_key.login_time desc");
			$count = mssql_num_rows($query);
			if ($count == '1')
			{
				$fetch = mssql_fetch_array($query);
				system('start '.$cPath.' /close * 5005 '.$fetch[0].' *');
				system('start '.$cPath.' /close * 7880 '.$fetch[0].' *');
				echo 'The account \'',htmlspecialchars($accountname),'\' has been disconnected.<br>';
			}
		}
	} 
	else 
	{
		echo "<br>This action does not exist.";
	}
}
?>