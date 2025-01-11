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

echo '<table><Form action=?do=vipadmin Method =POST><tr><td class=header>VIP Admin</td></tr>
			<tr><td><select name=type><option value=account selected>Account</option><option value=char>Character</option></select><input name=name type=text></td></tr>
			<tr><td><select name=action><option value=give selected>Add days</option><option value=take>Take days</option></select><input name=days type=text></td></tr>
			<tr><td><input name=submit type=submit value=Go! >';
	if (($_POST['type'] == 'account' or $_POST['type'] == 'char') && ($_POST['action'] == 'give' or $_POST['action'] == 'take') && !empty($_POST['name']) && !empty($_POST['days']))
	{
		if(ctype_digit($_POST['days']))
		{
				if ($_POST['type'] == 'char')
				{
					$query = mssql_query("select user_id, vip from account.dbo.tbl_user left join character.dbo.user_character on character.dbo.user_character.user_no = account.dbo.tbl_user.user_no where character_name = '".mssql_escape($_POST['name'])."'");
					$rows = mssql_num_rows($query);
					if ($rows == '1')
					{
						if ($_POST['action'] == 'give')
						{
							$action = '+';
						}
						else
						{
							$action = '-';
						}
						$fetch = mssql_fetch_array($query);
						if ($fetch[1] == '0')
						{
							if ($action == '+')
							{
							$expire = date("n/j/Y g:i:s A", strtotime($action.$_POST['days']." days"));
							mssql_query("Update account.dbo.tbl_user set vip = '".mssql_escape($expire)."' where user_id = '".mssql_escape($fetch[0])."'");
							$msg = 'The account '.htmlspecialchars($fetch[0]).' VIP expiration date has been set to '.htmlspecialchars($expire).'.';
							}
							else
							{
								$msg = 'You cannot take days from the account '.htmlspecialchars($fetch[0]).' because it never had VIP.';
							}
						}
						else
						{
							$today = strtotime(date("n/j/Y g:i:s A"));
							$expireDate = strtotime($fetch[1]);
							if ($expireDate > $today) 
							{
								$expire = date("n/j/Y g:i:s A", strtotime($fetch[1]." ".$action.$_POST['days']." days"));
							}
							else
							{
								$expire = date("n/j/Y g:i:s A", strtotime($action.$_POST['days']." days"));
							}
							mssql_query("Update account.dbo.tbl_user set vip = '".mssql_escape($expire)."' where user_id = '".mssql_escape($fetch[0])."'");
							$msg = 'The account '.htmlspecialchars($fetch[0]).' VIP expiration date has been set to '.htmlspecialchars($expire).'.';
						}
						echo '<tr><td>',$msg,'</td></tr>';
					}
					elseif ($rows > '1')
					{
						echo '<tr><td>Please contact the administrator and tell them, "the shit has hit the fan!"</td></tr>';
					}
					else
					{
						echo '<tr><td>Character not found!</td></tr>';
					}
				}
				else
				{
					$query = mssql_query("select count(user_id), vip from account.dbo.tbl_user where user_id = '".mssql_escape($_POST['name'])."' group by vip");
					$fetch = mssql_fetch_array($query);
					if ($fetch[0] == '1')
					{
						if ($_POST['action'] == 'give')
						{
							$action = '+';
						}
						else
						{
							$action = '-';
						}
						if ($fetch[1] == '0')
						{
							if ($action == '+')
							{
							$expire = date("n/j/Y g:i:s A", strtotime($action.$_POST['days']." days"));
							mssql_query("Update account.dbo.tbl_user set vip = '".mssql_escape($expire)."' where user_id = '".mssql_escape($_POST['name'])."'");
							$msg = 'The account '.htmlspecialchars($_POST['name']).' VIP expiration date has been set to '.htmlspecialchars($expire).'.';
							}
							else
							{
								$msg = 'You cannot take days from the account '.htmlspecialchars($_POST['name']).' because it never had VIP.';
							}
						}
						else
						{
							$today = strtotime(date("n/j/Y g:i:s A"));
							$expireDate = strtotime($fetch[1]);
							if ($expireDate > $today) 
							{
								$expire = date("n/j/Y g:i:s A", strtotime($fetch[1]." ".$action.$_POST['days']." days"));
							}
							else
							{
								$expire = date("n/j/Y g:i:s A", strtotime($action.$_POST['days']." days"));
							}
							mssql_query("Update account.dbo.tbl_user set vip = '".mssql_escape($expire)."' where user_id = '".mssql_escape($_POST['name'])."'");
							$msg = 'The account '.htmlspecialchars($_POST['name']).' VIP expiration date has been set to '.htmlspecialchars($expire).'.';
						}
						echo '<tr><td>',$msg,'</td></tr>';
					}
					elseif ($rows > '1')
					{
						echo '<tr><td>Please contact the administrator and tell them, "the shit has hit the fan!"</td></tr>';
					}
					else
					{
						echo '<tr><td>Account not found!</td></tr>';
					}
				}
			
		}
		else
		{
			echo '<tr><td>Give and take input only consists of whole numbers!</td></tr>';
		}
	}
	elseif (empty($_POST['type']))
	{}
	else
	{
			echo '<tr><td>Invald action!</td></tr>';
	}
	echo '</form></table>';
?>