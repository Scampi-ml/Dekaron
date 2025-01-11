<?php
if(ALLOW_OPEN != '1') {
Header('HTTP/1.1 403');
exit;
}
echo '<center><table><tr><td class=header>Experience Bank</td></tr><tr><td class=submenu><a href=?do=expbank&type=bank target=_self>Visit Bank</a> | <a href=?do=expbank&type=gift target=_self>Gift Experience</a> | <a href=?do=expbank&type=list target=_self>List Experience</a> | <a href=?do=expbank&type=listing target=_self>Check Listings</a></td></tr></table>';
if($_GET['type'] == 'bank' || empty($_GET['type'])) 
{
	$charQuery = mssql_query("SELECT character_name, dwExp FROM character.dbo.user_character WHERE user_no = '".mssql_escape($_SESSION['user_no'])."'");
	$characters = mssql_num_rows($charQuery);
	if ($characters > 0)
	{
		$bankedQuery = mssql_query("SELECT expbank FROM account.dbo.user_profile WHERE user_no = '".mssql_escape($_SESSION['user_no'])."'");
		$bankedList = mssql_fetch_array($bankedQuery);
		echo '<table><form name=processexp action=?do=expbank&type=process method=POST><tr><tr><td>Banked Experence: <b>',htmlspecialchars($bankedList[0]),'</b></td></tr><tr><td><select name=oCharList>';
		while ($charList = mssql_fetch_array($charQuery))
		{
			echo '<option value="',htmlspecialchars($charList['character_name']),'">',htmlspecialchars($charList['character_name']),' (',htmlspecialchars($charList['dwExp']),')</option>';
		}
		echo '</select></td></tr>';
		echo '<tr><td>Experience:<br><input type=text name=exp /></td></tr><tr><td><input name=type type=submit value=Deposit /> <input name=type type=submit value="Deposit All" /><br><input name=type type=submit value=Withdraw /> <input name=type type=submit value="Withdraw Max"/></td></tr></form></table>';
	}
	else
	{
		echo 'You have no characters to preform banking operations with!';
	}
}
elseif($_GET['type'] == 'gift')
{
	unset($_SESSION['token']);
	$_SESSION['token'] = sha1(microtime(true).uniqid($_SERVER['REMOTE_ADDR'], true).rand());
	$bankedQuery = mssql_query("SELECT expbank FROM account.dbo.user_profile WHERE user_no = '".mssql_escape($_SESSION['user_no'])."'");
	$bankedList = mssql_fetch_array($bankedQuery);
	echo '<table><form name=processexp action=?do=expbank&type=process method=POST>
	<tr><td>Banked Experence: <b>',htmlspecialchars($bankedList[0]),'</b></td></tr>
	<tr><td>Character:<br><input type=text name=sendTo></input></td></tr>
	<tr><td>Experience:<br><input type=text name=sendExp></input></td></tr>
	<tr><td><input type=hidden name=token value="',htmlspecialchars($_SESSION['token']),'"></input><input type=submit name=type value=Gift></input></td></tr>
	</form></table>Gifting experience requires 1 D-Coin.';
}
elseif($_GET['type'] == 'process' && $_POST['type'] == 'Gift' && isset($_SESSION['token']) && $_POST['token'] == $_SESSION['token'] && !empty($_POST['sendTo']) && !empty($_POST['sendExp']))
{
	unset($_SESSION['token']);
	echo '<table>';
	if(ctype_digit($_POST['sendExp']))
	{
		$query = mssql_query("SELECT (amount + free_amount) as coins, expbank from cash.dbo.user_cash left join account.dbo.user_profile on cash.dbo.user_cash.user_no = account.dbo.user_profile.user_no where cash.dbo.user_cash.user_no = '".mssql_escape($_SESSION['user_no'])."'");
		$count = mssql_num_rows($query);
		if ($count == 1)
		{
			$fetch = mssql_fetch_array($query);
			if ($fetch[0] >= 1 && $fetch[1] >= $_POST['sendExp'])
			{
				$query2 = mssql_query("SELECT character.dbo.user_character.user_no from character.dbo.user_character where character.dbo.user_character.character_name = '".mssql_escape($_POST['sendTo'])."'");
				$count2 = mssql_num_rows($query2);
				if ($count2 == 1)
				{
					$fetch2 = mssql_fetch_array($query2);
					mssql_query("UPDATE cash.dbo.user_cash SET amount = amount - 1 where user_no = '".mssql_escape($_SESSION['user_no'])."'");
					mssql_query("UPDATE character.dbo.siege_info SET dtax = dtax + 1 where siege_tag = 'Y'");
					mssql_query("UPDATE account.dbo.user_profile SET expbank = expbank - ".mssql_escape($_POST['sendExp'])." where user_no = '".mssql_escape($_SESSION['user_no'])."'");
					mssql_query("UPDATE account.dbo.user_profile SET expbank = expbank + ".mssql_escape($_POST['sendExp'])." where user_no = '".mssql_escape($fetch2[0])."'");
					mssql_query("INSERT INTO osds.dbo.bLog (wDate, Method, aid, tax, exp, buyID, IP) VALUES (getdate(),'G','".mssql_escape($_SESSION['user_no'])."','1','".mssql_escape($_POST['sendExp'])."','".mssql_escape($fetch2[0])."','".mssql_escape($_SERVER['REMOTE_ADDR'])."')");
					echo '<tr><td>',htmlspecialchars($_POST['sendTo']),' has successfully received ',htmlspecialchars($_POST['sendExp']),' experience in their bank!</td></tr>';
				}
				else
				{
					echo '<tr><td>Character does not exist!</td></tr>';
				}
			}
			else
			{
				echo '<tr><td>You do not have enough coins and/or that much experience to gift!</td></tr>';
			}
		}
		else
		{
			echo '<tr><td>You have not visited the d-shop and, therefore, do not have enough coins!</td></tr>';
		}
	}
	else
	{
		echo '<tr><td>Experience only consists of whole numbers!</td></tr>';
	}
	echo '</table>';
}
elseif($_GET['type'] == 'process' && ($_POST['type'] == 'Deposit' || $_POST['type'] == 'Deposit All'))
{
	if(!ctype_digit($_POST['exp']) && $_POST['type'] <> 'Deposit All')
	{
		echo 'Experience only consist of whole numbers.<br><a href=?do=expbank&type=bank>Back</a>';
		exit;
	}
	elseif ($_POST['exp'] <= '0' && $_POST['type'] <> 'Deposit All')
	{
		echo 'Experience must be greater than 0!<br><a href=?do=expbank&type=bank>Back</a>';
		exit;
	}
	elseif (empty($_POST['exp']) && $_POST['type'] <> 'Deposit All')
	{
		echo 'Experience cannot be empty!<br><a href=?do=expbank&type=bank>Back</a>';
		exit;
	}
	else
	{
		
		$loginQuery = 	mssql_query("SELECT login_flag FROM account.dbo.USER_PROFILE WHERE user_no = '".mssql_escape($_SESSION['user_no'])."'");
		$loginFlag = mssql_fetch_array($loginQuery);
		if ($loginFlag[0] == '0')
		{
			$infoQuery = mssql_query("SELECT dwExp from character.dbo.user_character where character_name = '".mssql_escape($_POST['oCharList'])."' and user_no = '".mssql_escape($_SESSION['user_no'])."'");
			$isAcct = mssql_num_rows($infoQuery);
			if ($isAcct == '1')
			{
				$info = mssql_fetch_array($infoQuery);
				if ($_POST['type'] == 'Deposit All')
				{
					$_POST['exp'] = $info[0];
				}
				if ($info[0] >= $_POST['exp'] && $_POST['exp'] <> '0')
				{
					$ip=$_SERVER['REMOTE_ADDR'];
					$exp = $info[0] - $_POST['exp'];
					mssql_query("UPDATE character.dbo.user_character set dwEXP = '".mssql_escape($exp)."' where character_name = '".mssql_escape($_POST['oCharList'])."'");
					$bankedQuery = mssql_query("SELECT expbank FROM account.dbo.user_profile WHERE user_no = '".mssql_escape($_SESSION['user_no'])."'");
					$bankedList = mssql_fetch_array($bankedQuery);
					$exp = $bankedList[0] + $_POST['exp'];
					mssql_query("UPDATE account.dbo.user_profile SET expbank = '".mssql_escape($exp)."' where user_no = '".mssql_escape($_SESSION['user_no'])."'");
					mssql_query("INSERT INTO osds.dbo.WDLogs values (getdate(), 'D', '".mssql_escape($_SESSION['user_no'])."','".mssql_escape($_POST['oCharList'])."','".mssql_escape($_POST['exp'])."','".mssql_escape($info[0])."','".mssql_escape($info[0] - $_POST['exp'])."','".mssql_escape($bankedList[0])."','".mssql_escape($bankedList[0] + $_POST['exp'])."','".mssql_escape($ip)."')");
					echo "You have successfully banked ",htmlspecialchars($_POST['exp'])," experience off of ",htmlspecialchars($_POST['oCharList']),"!<br><a href=?do=expbank&type=bank>Back</a>";
				}
				else
				{
					echo 'You don\'t have that much experience to bank!<br><a href=?do=expbank&type=bank>Back</a>';
				}
			}
			else
			{
				echo 'Data access error!';
			}
		}
		else
		{
			echo 'You must be logged out of your account!<br><a href=?do=expbank&type=bank>Back</a>';
		}
		
	}
}
elseif($_GET['type'] == 'process' && ($_POST['type'] == 'Withdraw' || $_POST['type'] == 'Withdraw Max'))
{
	if(!ctype_digit($_POST['exp']) && $_POST['type'] <> 'Withdraw Max')
	{
		echo 'Experience only consist of whole numbers.<br><a href=?do=expbank&type=bank>Back</a>';
		exit;
	}
	elseif ($_POST['exp'] <= '0' && $_POST['type'] <> 'Withdraw Max')
	{
		echo 'Experience must be greater than 0!<br><a href=?do=expbank&type=bank>Back</a>';
		exit;
	}
	elseif (empty($_POST['exp']) && $_POST['type'] <> 'Withdraw Max')
	{
		echo 'Experience cannot be empty!<br><a href=?do=expbank&type=bank>Back</a>';
		exit;
	}
	else
	{
		$loginQuery = 	mssql_query("SELECT login_flag FROM account.dbo.USER_PROFILE WHERE user_no = '".mssql_escape($_SESSION['user_no'])."'");
		$loginFlag = mssql_fetch_array($loginQuery);
		if ($loginFlag[0] == '0')
		{
			$infoQuery = mssql_query("SELECT dwExp from character.dbo.user_character where character_name = '".mssql_escape($_POST['oCharList'])."' and user_no = '".mssql_escape($_SESSION['user_no'])."'");
			$isAcct = mssql_num_rows($infoQuery);
			if ($isAcct == '1')
			{
				$info = mssql_fetch_array($infoQuery);
				$bankedQuery = mssql_query("SELECT expbank from account.dbo.user_profile where user_no = '".mssql_escape($_SESSION['user_no'])."'");
				$bankedList = mssql_fetch_array($bankedQuery);
				if ($_POST['type'] == 'Withdraw Max')
				{
					if ($bankedList[0] >= '2147483648')
					{
						$_POST['exp'] = 2147483648 - $info[0];
					}
					else
					{
						$_POST['exp'] = $bankedList[0];
					}
				}
				if ($bankedList[0] >= $_POST['exp'] && $_POST['exp'] <> '0')
				{
					if (($info[0] + $_POST['exp']) <= '2147483648')
					{
						$ip=$_SERVER['REMOTE_ADDR'];
						$exp = $bankedList[0] - $_POST['exp'];
						mssql_query("UPDATE account.dbo.user_profile SET expbank = '".mssql_escape($exp)."' where user_no = '".mssql_escape($_SESSION['user_no'])."'");
						$exp =  $info[0] + $_POST['exp'];
						mssql_query("UPDATE character.dbo.user_character set dwEXP = '".mssql_escape($exp)."' where character_name = '".mssql_escape($_POST['oCharList'])."'");
						mssql_query("INSERT INTO osds.dbo.WDLogs values (getdate(), 'W', '".mssql_escape($_SESSION['user_no'])."','".mssql_escape($_POST['oCharList'])."','".mssql_escape($_POST['exp'])."','".mssql_escape($info[0])."','".mssql_escape($info[0] + $_POST['exp'])."','".mssql_escape($bankedList[0])."','".mssql_escape($bankedList[0] - $_POST['exp'])."','".mssql_escape($ip)."')");
						echo "You have successfully withdrawn ",htmlspecialchars($_POST['exp'])," experience to ",htmlspecialchars($_POST['oCharList']),"!<br><a href=?do=expbank&type=bank>Back</a>";
					}
					else
					{
						echo 'You cannnot withdraw that much experience because your character\'s experience will exceed its maximum value: 2147483648';
					}
				}
				else
				{
					echo 'You don\'t have that much experience to withdraw!<br><a href=?do=expbank&type=bank>Back</a>';
				}
			}
			else
			{
				echo 'Data access error!';
			}
		}
		else
		{
			echo 'You must be logged out of your account!<br><a href=?do=expbank&type=bank>Back</a>';
		}
		
	}
}

elseif($_GET['type'] == 'list')
{
	unset($_SESSION['token']);
	$_SESSION['token'] = sha1(microtime(true).uniqid($_SERVER['REMOTE_ADDR'], true).rand());
	$bankedQuery = mssql_query("SELECT expbank FROM account.dbo.user_profile WHERE user_no = '".mssql_escape($_SESSION['user_no'])."'");
	$bankedList = mssql_fetch_array($bankedQuery);
	echo '<table><form name=processexp action=?do=expbank&type=process method=POST><tr><td>Banked Experence: <b>',htmlspecialchars($bankedList[0]),'</b></td></tr>';
	echo '<tr><td>Experience:<br><input type=text name=exp /></td></tr><tr><td>D-Coins:<br><input type=text name=dcoins /></td></tr><tr><td><input name=type type=submit value=List /><input type=hidden name=token value="',$_SESSION['token'],'"></td></tr></form></table>You will recieve 95% of your total D-Coin listing value due to a 5% tax.<br>Minimum listing price is 20 D-Coins.';

}
elseif($_GET['type'] == 'process' && $_POST['type'] == 'List' && isset($_SESSION['token']) && $_POST['token'] == $_SESSION['token'])
{
	unset($_SESSION['token']);
	if(!ctype_digit($_POST['exp']) || !ctype_digit($_POST['dcoins']))
	{
		echo 'Experience and D-Coins only consist of whole numbers.<br><a href=?do=expbank&type=list>Back</a>';
		exit;
	}
	elseif ($_POST['exp'] <= '0' || $_POST['dcoins'] < '20')
	{
		echo 'Experience must be greater than 0 and D-Coins must be greater than 20!<br><a href=?do=expbank&type=list>Back</a>';
		exit;
	}
	elseif (empty($_POST['exp']) || empty($_POST['dcoins']))
	{
		echo 'Experience and D-Coins cannot be empty!<br><a href=?do=expbank&type=list>Back</a>';
		exit;
	}
		elseif ($_POST['exp'] > '9223372036854775807' || $_POST['dcoins'] > '2147483647')
	{
		echo 'Experience value cannot exceed 9223372036854775807 and D-Coin value cannot exceed 2147483647!<br><a href=?do=expbank&type=list>Back</a>';
		exit;
	}
	else
	{
		

		$infoQuery = mssql_query("SELECT expbank from account.dbo.user_profile where user_no = '".mssql_escape($_SESSION['user_no'])."'");
		$info = mssql_fetch_array($infoQuery);
		if ($info[0] >= $_POST['exp'])
		{
			$ip=$_SERVER['REMOTE_ADDR'];
			$exp = $info[0] - $_POST['exp'];
			mssql_query("UPDATE account.dbo.user_profile SET expbank = '".mssql_escape($exp)."' where user_no = '".mssql_escape($_SESSION['user_no'])."'");
			$exp =  $_POST['exp'];
			mssql_query("INSERT INTO osds.dbo.blist (aid, exp, coins) values ('".mssql_escape($_SESSION['user_no'])."','".mssql_escape($_POST['exp'])."','".mssql_escape($_POST['dcoins'])."')");
			$auctionQuery = mssql_query("SELECT TOP 1 auctionID FROM osds.dbo.blist where aid = '".mssql_escape($_SESSION['user_no'])."'");
			$getID = mssql_fetch_array($auctionQuery);
			mssql_query("INSERT INTO osds.dbo.bLog (wDate, Method, auctionID, aid, exp, dCoins, sBankBefore, sBankAfter, IP) VALUES (getdate(),'L','".mssql_escape($getID[0])."','".mssql_escape($_SESSION['user_no'])."','".mssql_escape($_POST['exp'])."','".mssql_escape($_POST['dcoins'])."','".mssql_escape($info[0])."','".mssql_escape($info[0] - $_POST['exp'])."','".mssql_escape($ip)."')");
			echo "You have successfully listed ",htmlspecialchars($_POST['exp'])," experience for ",htmlspecialchars($_POST['dcoins'])," D-Coins!<br><a href=?do=expbank&type=list>Back</a>";
		}
		else
		{
			echo 'You don\'t have that much experience in your bank to list!<br><a href=?do=expbank&type=list>Back</a>';
		}
		
		
	}
}
elseif($_GET['type'] == 'listing')
{
	$acctQuery = mssql_query("SELECT amount, free_amount from cash.dbo.user_cash where user_no = '".mssql_escape($_SESSION['user_no'])."'");
	$isdshop = mssql_num_rows($acctQuery);
	if ($isdshop == '1')
	{
		$listQuery = mssql_query("SELECT * from osds.dbo.blist");
		$acctCoins = mssql_fetch_array($acctQuery);
		$totalCoins = $acctCoins[0] + $acctCoins[1];
		echo "Your D-Coins: <b>$totalCoins</b>";
		echo '<table><tr><td><b><u>Experience</u></b></td><td><b><u>Price</u></b></td></tr>';
		while ($listings = mssql_fetch_array($listQuery))
		{
			echo '<tr><td>',htmlspecialchars($listings[2]),'</td><td>',htmlspecialchars($listings[3]),'</td>';
			if ($listings[1] == $_SESSION['user_no'])
			{
				echo '<td><a style=color:red; href=?do=expbank&type=deletelisting&aid=',htmlspecialchars($listings[0]),'>Delete</a></td></tr>';
			}
			elseif($listings[1] <> $_SESSION['user_no'] && $listings[3] <= $totalCoins)
			{
				echo '<td><a href=?do=expbank&type=buylisting&aid=',htmlspecialchars($listings[0]),'>Buy</a></td></tr>';
			}
			else
			{
			echo '</tr>';
			}
		}
		echo '</table>';
	}
	elseif ($isdshop == '0')
	{
		echo 'You have not visited the d-shop yet in-game. You cannot participate in buying experience!';
	}
	else
	{
		echo 'D-Shop error has occured. Please contact your administrator and tell them, "the shit has hit the fan".';
	}
}
elseif($_GET['type'] == 'deletelisting' && !empty($_GET['aid']) && ctype_digit($_GET['aid']))
{
	$auQuery = mssql_query("Select * FROM osds.dbo.blist where auctionID = '".mssql_escape($_GET['aid'])."'");
	$isAU = mssql_num_rows($auQuery);
	if ($isAU == '1')
	{
		$auInfo = mssql_fetch_array($auQuery);
		if ($auInfo['aid'] == $_SESSION['user_no'])
		{
			$ip=$_SERVER['REMOTE_ADDR'];
			mssql_query("DELETE FROM osds.dbo.blist where auctionID = '".mssql_escape($auInfo['auctionID'])."'");
			$bankQuery = mssql_query("SELECT expbank from account.dbo.user_profile where user_no = '".mssql_escape($_SESSION['user_no'])."'");
			$bankInfo = mssql_fetch_array($bankQuery);
			$exp = $bankInfo[0] + $auInfo['exp'];
			mssql_query("UPDATE account.dbo.user_profile SET expbank = '".mssql_escape($exp)."' where user_no = '".mssql_escape($_SESSION['user_no'])."'");
			mssql_query("INSERT INTO osds.dbo.bLog (wDate, Method, auctionID, aid, exp, sBankBefore, sBankAfter, IP) VALUES (getdate(),'D','".mssql_escape($auInfo['auctionID'])."','".mssql_escape($_SESSION['user_no'])."','".mssql_escape($auInfo['exp'])."','".mssql_escape($bankInfo[0])."','".mssql_escape($bankInfo[0] + $auInfo['exp'])."','".mssql_escape($ip)."')");
			echo 'Auction ',htmlspecialchars($auInfo['auctionID']),' successfully deleted and ',htmlspecialchars($auInfo['exp']),' experience returned to your bank.';
		}
		else
		{
	 		echo 'Unable to delete listing because you do not own this auction.';
		}
	}
	else
	{
	echo 'Auction no longer exists to delete.';
	}
}
elseif($_GET['type'] == 'buylisting' && !empty($_GET['aid']) && ctype_digit($_GET['aid']))
{
	$auQuery = mssql_query("Select * FROM osds.dbo.blist where auctionID = '".mssql_escape($_GET['aid'])."'");
	$isAU = mssql_num_rows($auQuery);
	if ($isAU == '1')
	{
		$auInfo = mssql_fetch_array($auQuery);
		if ($auInfo['aid'] <> $_SESSION['user_no'])
		{
			$acctQuery = mssql_query("SELECT amount, free_amount from cash.dbo.user_cash where user_no = '".mssql_escape($_SESSION['user_no'])."'");
			$acctCoins = mssql_fetch_array($acctQuery);
			$totalCoins = $acctCoins[0] + $acctCoins[1];
			if ($totalCoins >= $auInfo['coins'])
			{
				$ip=$_SERVER['REMOTE_ADDR'];
				$totalCoins = $acctCoins[0] - $auInfo['coins'];
				mssql_query("UPDATE cash.dbo.user_cash SET amount = '".mssql_escape($totalCoins)."' where user_no = '".mssql_escape($_SESSION['user_no'])."'");
				mssql_query("DELETE FROM osds.dbo.blist where auctionID = '".mssql_escape($auInfo['auctionID'])."'");
				$sellQuery = mssql_query("SELECT amount, free_amount from cash.dbo.user_cash where user_no = '".mssql_escape($auInfo['aid'])."'");
				$sellList = mssql_fetch_array($sellQuery);
				mssql_query("UPDATE cash.dbo.user_cash SET amount = amount + ".mssql_escape($auInfo['coins'] - round($auInfo['coins'] * .05))." where user_no = '".mssql_escape($auInfo['aid'])."'");
				mssql_query("UPDATE character.dbo.siege_info SET dtax = dtax + ".mssql_escape(round($auInfo['coins'] * .05))." where siege_tag = 'Y'");
				$bankQuery = mssql_query("SELECT expbank from account.dbo.user_profile where user_no = '".mssql_escape($_SESSION['user_no'])."'");
				$bankInfo = mssql_fetch_array($bankQuery);
				$exp = $bankInfo[0] + $auInfo['exp'];
				mssql_query("UPDATE account.dbo.user_profile SET expbank = '".mssql_escape($exp)."' where user_no = '".mssql_escape($_SESSION['user_no'])."'");
				mssql_query("INSERT INTO osds.dbo.bLog (wDate, Method, auctionID, aid, tax, exp, dCoins, sCoinsBefore, sCoinsAfter, buyID, bCoinsBefore, bCoinsAfter, bBankBefore, bBankAfter, IP) values(getdate(), 'B','".mssql_escape($auInfo['auctionID'])."','".mssql_escape($auInfo['aid'])."','".mssql_escape(round($auInfo['coins'] * .05))."','".mssql_escape($auInfo['exp'])."', '".mssql_escape($auInfo['coins'])."', '".mssql_escape($sellList[0] + $sellList[1])."','".mssql_escape($sellList[0] + $sellList[1] + ($auInfo['coins'] - round($auInfo['coins'] * .05)) )."', '".mssql_escape($_SESSION['user_no'])."', '".mssql_escape($acctCoins[0] + $acctCoins[1])."' ,'".mssql_escape($acctCoins[0] + $acctCoins[1] - $auInfo['coins'])."', '".mssql_escape($bankInfo[0])."', '".mssql_escape($bankInfo[0] + $auInfo['exp'])."','".mssql_escape($ip)."')");
				echo 'Auction ',htmlspecialchars($auInfo['auctionID']),' successfully bought and ',htmlspecialchars($auInfo['exp']),' experience has been added to your bank.';
			}
			else
			{
				echo 'You do not have enough coins to buy this auction.';
			}
		}
		else
		{
	 		echo 'Unable to buy listing because you own this auction.';
		}
	}
	else
	{
	echo 'Auction no longer exists to buy.';
	}
}
else
{
	unset($_SESSION['token']);
	echo 'Invalid Action!';
}
echo '</center>';
?>