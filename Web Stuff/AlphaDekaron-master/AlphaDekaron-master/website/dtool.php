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
echo '<table><tr><td class=header>Donation Tool</td></tr><form action=?do=dtool method=POST>
	<tr><td><select name=method><option value=acct>Account</option><option value=cName>Character Name</option></select><input type=text name=nData></td></tr>
	<tr><td>Donation amount: <input name=dValue type=text></td></tr>
	<tr><td><input name=type value=Award type=submit></td></tr></form></table>';
If ($_POST['type'] == 'Award' && ctype_digit($_POST['dValue']) && !empty($_POST['nData']) && ($_POST['method'] == 'acct' or $_POST['method'] == 'cName'))
{
	$error = 1;
	if ($_POST['method'] == 'cName')
	{
		$query = mssql_query("SELECT cash.dbo.user_cash.user_no, account.dbo.user_profile.user_id, account.dbo.tbl_user.dExcess FROM cash.dbo.user_cash left join account.dbo.tbl_user on account.dbo.tbl_user.user_no = cash.dbo.user_cash.user_no left join character.dbo.user_character on character.dbo.user_character.user_no = cash.dbo.user_cash.user_no left join account.dbo.user_profile on account.dbo.user_profile.user_no = character.dbo.user_character.user_no where character.dbo.user_character.character_name = '".mssql_escape($_POST['nData'])."'");
		$count = mssql_num_rows($query);
		if ($count == 1)
		{
			$fetch = mssql_fetch_array($query);
			$aNo = $fetch[0];
			$aName = $fetch[1];
			$dExcess = $fetch[2];
			$error = 0;
		}
		elseif ($count > 1)
		{
			$msg = 'The shit has hit the fan.';
		}
		else
		{
			$msg = 'The character does not exist or the account has not visited the d-shop yet.';
		}
	}
	else
	{
		$query = mssql_query ("SELECT cash.dbo.user_cash.user_no, account.dbo.tbl_user.dExcess from cash.dbo.user_cash left join account.dbo.tbl_user on account.dbo.tbl_user.user_no = cash.dbo.user_cash.user_no left join account.dbo.user_profile on account.dbo.user_profile.user_no = cash.dbo.user_cash.user_no where account.dbo.user_profile.user_id = '".mssql_escape($_POST['nData'])."'");
		$count = mssql_num_rows($query);
		if ($count == 1)
		{
			$fetch = mssql_fetch_array($query);
			$aNo = $fetch[0];
			$aName = $_POST['nData'];
			$dExcess = $fetch[1];
			$error = 0; 
		}
		elseif ($count > 1)
		{
			$msg = 'The shit has hit the fan.';
		}
		else
		{
			$msg = 'The account does not exist or has not visited the d-shop yet.';
		}
	}
	if ($error == 0)
	{
		if (($dExcess + $_POST['dValue']) >= 20)
		{
			$i = $dExcess + $_POST['dValue'];
			do
			{
				$i -= 20;
				if ($i >= 0)
				{
					$credits += 1;
					$nExcess = $i;
				}
				
			}while($i > 0);
		}
		else
		{
			$nExcess = $dExcess + $_POST['dValue'];
			$credits = 0;
		}
		if ($_POST['dValue'] >= 20)
		{
		 $coins = $_POST['dValue'] * 133;
		 $increase = $coins * .1;
		 $coins += $increase;
		 
		}
		else
		{
			$coins = $_POST['dValue'] * 133;
		}
		mssql_query("UPDATE cash.dbo.user_cash SET amount = amount + ".mssql_escape($coins)." where user_no = '".mssql_escape($aNo)."'");
		mssql_query("UPDATE account.dbo.tbl_user SET dExcess = '".mssql_escape($nExcess)."', dTotal = dTotal + ".mssql_escape($_POST['dValue']).", vCredits = vCredits + ".mssql_escape($credits)." where account.dbo.tbl_user.user_no = '".mssql_escape($aNo)."'");
		$msg = 'The account '.$aName.' has successfully awarded it\'s donation!';
	}
	echo '',htmlspecialchars($msg),'';
}
else
{
	if (!empty($_POST['type']))
	{
		echo 'Data input error!';
	}
	
}
?>