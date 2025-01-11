<?php
if(ALLOW_OPEN != '1') {
Header('HTTP/1.1 403');
exit;
}

$vipStr = vipcheck();
$vip30 = 3000;
if ($_POST['vip'] == 'Add 30 days')
{
	unset($_SESSION['token']);
	$_SESSION['token'] = sha1(microtime(true).uniqid($_SERVER['REMOTE_ADDR'], true).rand());
	echo '<table><tr><td class=header>VIP Management</td></tr>
	<tr><td>Are you sure you want to add 30 days of vip to the account ',htmlspecialchars($_SESSION['accname']),'?<br>The cost is ',htmlspecialchars($vip30),' coins.</td></tr>
	<tr><td><form action=?do=vip Method=POST><input name=token type=hidden value="',htmlspecialchars($_SESSION['token']),'"><input name=30answer type=submit value=Yes> <input name=30answer type=submit value=No></td></tr></form></table>';
}
elseif($_POST['vip'] == 'Use 1 credit')
{
unset($_SESSION['token']);
	$_SESSION['token'] = sha1(microtime(true).uniqid($_SERVER['REMOTE_ADDR'], true).rand());
	echo '<table><tr><td class=header>VIP Management</td></tr>
	<tr><td>Are you sure you want to use 1 VIP credit which will add 7 days of vip to the account ',htmlspecialchars($_SESSION['accname']),'?</td></tr>
	<tr><td><form action=?do=vip Method =POST><input name=token type=hidden value="',htmlspecialchars($_SESSION['token']),'"><input name=credanswer type=submit value=Yes> <input name=credanswer type=submit value=No></td></tr></form></table>';
}
elseif ($_POST['credanswer'] == 'Yes' && isset($_SESSION['token']) && $_SESSION['token'] == $_POST['token'] && $_POST['30answer'] <> 'Yes')
{
	unset($_SESSION['token']);
	$query = mssql_query("select vCredits, vip from account.dbo.tbl_user where user_no = '".mssql_escape($_SESSION['user_no'])."'");
	$rows = mssql_num_rows($query);
	if ($rows == 1)
	{
		$fetch = mssql_fetch_array($query);
		if ($fetch[0] >= 1)
		{
			mssql_query("UPDATE account.dbo.tbl_user SET vCredits = vCredits - 1 where user_no = '".mssql_escape($_SESSION['user_no'])."'");
			$today = strtotime(date("n/j/Y g:i:s A"));
			if($fetch[1] <> '0')
			{
				$expireDate = strtotime($fetch[1]);
			}
			else 
			{
				$expireDate = 0;
			}
			if ($expireDate <> 0 && $expireDate > $today) 
			{
				$expire = date("n/j/Y g:i:s A", strtotime($fetch[1]." +7 days"));
			}
			else
			{
				$expire = date("n/j/Y g:i:s A", strtotime("+7 days"));
			}
				mssql_query("Update account.dbo.tbl_user set vip = '".mssql_escape($expire)."' where user_no = '".mssql_escape($_SESSION['user_no'])."'");
			echo '<table><tr><td class=header>VIP Management</td></tr>
			<tr><td>7 days of vip successfully added.<br>VIP Expiration date is ',htmlspecialchars($expire),'.</td></tr></table>';
		}
		else
		{
			echo '<table><tr><td class=header>VIP Management</td></tr>
			<tr><td>You don\'t have enough credits.</td></tr></table>';
		}
	}
	else
	{
			echo '<table><tr><td class=header>VIP Management</td></tr>
	<tr><td>Please contact your system administrator and tell them, "the shit has hit the fan."</td></tr></table>';
	}
}
elseif ($_POST['30answer'] == 'Yes' && isset($_SESSION['token']) && $_SESSION['token'] == $_POST['token'] && $_POST['credanswer'] <> 'Yes')
{
	unset($_SESSION['token']);
	$query = mssql_query("select amount, free_amount, vip from cash.dbo.user_cash left join account.dbo.tbl_user on account.dbo.tbl_user.user_no = cash.dbo.user_cash.user_no where cash.dbo.user_cash.user_no = '".mssql_escape($_SESSION['user_no'])."'");
	$rows = mssql_num_rows($query);
	if ($rows == 1)
	{
		$fetch = mssql_fetch_array($query);
		if ($fetch[0] + $fetch[1] >= $vip30)
		{
			mssql_query("UPDATE cash.dbo.user_cash SET amount = amount - ".mssql_escape($vip30)." where user_no = '".mssql_escape($_SESSION['user_no'])."'");
			$today = strtotime(date("n/j/Y g:i:s A"));
			if($fetch[2] <> '0')
			{
				$expireDate = strtotime($fetch[2]);
			}
			else 
			{
				$expireDate = 0;
			}
			if ($expireDate <> 0 && $expireDate > $today) 
			{
				$expire = date("n/j/Y g:i:s A", strtotime($fetch[2]." +30 days"));
			}
			else
			{
				$expire = date("n/j/Y g:i:s A", strtotime("+30 days"));
			}
				mssql_query("Update account.dbo.tbl_user set vip = '".mssql_escape($expire)."' where user_no = '".mssql_escape($_SESSION['user_no'])."'");
			echo '<table><tr><td class=header>VIP Management</td></tr>
			<tr><td>30 days of vip successfully added.<br>VIP Expiration date is ',htmlspecialchars($expire),'.</td></tr></table>';
		}
		else
		{
			echo '<table><tr><td class=header>VIP Management</td></tr>
			<tr><td>You don\'t have enough coins to purchase 30 days of VIP.</td></tr></table>';
		}
	}
	elseif ($rows > 1)
	{
			echo '<table><tr><td class=header>VIP Management</td></tr>
	<tr><td>Please contact your system administrator and tell them, "the shit has hit the fan."</td></tr></table>';
	}
	else
	{
		echo '<table><tr><td class=header>VIP Management</td></tr>
		<tr><td>Your account has not visited the d-shop in-game. Therefore, you don\'t have any coins.</td></tr></table>';
	}
}
else
{
	unset($_SESSION['token']);
	echo '<table><tr><td class=header>VIP Management</td></tr>
	<tr><td>',htmlspecialchars($vipStr[0]),' (GMT-5)</td></tr>
	<tr><td><form action=?do=vip Method=POST><input name=vip type=submit value="Add 30 days"><br>VIP credits: ',htmlspecialchars($vipStr[1]);
	if ($vipStr[1] > 0)
	{
	echo ' <br><input name=vip type=submit value="Use 1 credit">';
	}
	echo '<br>Total donations: $',htmlspecialchars($vipStr[2]),'</form></tr>';
	if ($_SESSION['VIP'] == 1)
	{
	echo '<tr><td class=header>VIP Island Teleport</td></tr>';
	$query = mssql_query("SELECT character_name from character.dbo.user_character where user_no = '".mssql_escape($_SESSION['user_no'])."'");
	$count = mssql_num_rows($query);
	if ($count > 0)
	{
		echo '<form action=?do=vip method=post><tr><td>Character:<br><select name=tChar>';
		while($fetch = mssql_fetch_array($query))
		{
			echo '<option value="',htmlspecialchars($fetch[0]),'">',htmlspecialchars($fetch[0]),'</option>';
		}
		echo '</select></td></tr><tr><td>Location:<br><select name=area><option value=Outer>Outer</option><option value=Inner>Inner</option></select></td></tr>
		<tr><td><input type=submit name=type value=Teleport></input></td></tr></form>';
		if ($_POST['type'] == 'Teleport' && !empty($_POST['tChar']) && !empty($_POST['area']))
		{
			$query = mssql_query("select login_flag from account.dbo.user_profile where user_no = '".mssql_escape($_SESSION['user_no'])."'");
			$count = mssql_num_rows($query);
			if ($count == 1)
			{
				$fetch = mssql_fetch_array($query);
				if ($fetch[0] == '0')
				{
					$query = mssql_query("select wMapIndex from character.dbo.user_character where user_no = '".mssql_escape($_SESSION['user_no'])."' and character_name = '".mssql_escape($_POST['tChar'])."'");
					$count = mssql_num_rows($query);
					if ($count == 1)
					{
						if ($_POST['area'] == 'Inner')
						{
							mssql_query("Update character.dbo.user_character SET wPosX = '309', wPosY = '272', wMapIndex = '777' where user_no = '".mssql_escape($_SESSION['user_no'])."' and character_name = '".mssql_escape($_POST['tChar'])."'");
							echo '<tr><td>',htmlspecialchars($_POST['tChar']),' successfully teleported to inner VIP Island!</td></tr>';
						}
						else
						{
							mssql_query("Update character.dbo.user_character SET wPosX = '391', wPosY = '359', wMapIndex = '777' where user_no = '".mssql_escape($_SESSION['user_no'])."' and character_name = '".mssql_escape($_POST['tChar'])."'");
							echo '<tr><td>',htmlspecialchars($_POST['tChar']),' successfully teleported to outer VIP Island!</td></tr>';
						}
					}
					else
					{
						echo '<tr><td>Data access error!</td></tr>';
					}
				}
				else
				{
					echo '<tr><td>You must be logged out of your account to teleport your character.</td></tr>';
				}
			}
			else
			{
				echo '<tr><td>Contact your administrator and tell him, "The shit has hit the fan!"</td></tr>';
			}
		}
			}
			else
			{
				echo '<tr ><td>You have no characters to teleport.</td></tr>';
			}
		
		echo'<tr><td class=header>Bonus</td></tr>
		<tr ><td>25% more coins per vote</td></tr>';
	}
	echo '</table>';
}
?>