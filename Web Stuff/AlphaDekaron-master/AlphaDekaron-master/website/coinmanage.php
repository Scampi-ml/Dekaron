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
if(empty($_POST['select'])) 
{
	echo "<form action=?do=coinmanage method=POST>
	<table>
   <tr><td class=header colspan=2 >Coins Admin<br></td></tr>
	<tr><td>Character Name:<br><input type=text name=charname maxlength=20></td></tr>
	<tr><td colspan=2><input type=submit name=select value=Go></td></tr>
	</table></form>";
} 
elseif($_POST['select'] == 'Go') 
{
   $result1 = mssql_query("SELECT character.dbo.user_character.user_no, user_id, amount, free_amount FROM character.dbo.user_character left join cash.dbo.user_cash on cash.dbo.user_cash.user_no = character.dbo.user_character.user_no left join account.dbo.user_profile on account.dbo.user_profile.user_no = character.dbo.user_character.user_no WHERE character_name = '".mssql_escape($_POST['charname'])."'");
   $count1 = mssql_num_rows($result1);
   $info = mssql_fetch_array($result1);
	if($count1 != '1') 
	{
		echo "Could not find the character name.<br><a href='javascript:history.back()'>Go Back</a>";
   } 
   elseif($count1 <> '1')
   {
		echo "Character has not visited the d-shop.<br><a href='javascript:history.back()'>Go Back</a>";
	}
	else 
	{
		$coins = $info['amount'] + $info['free_amount'] ;
		echo "<table><form action=?do=coinmanage method=POST>
        <tr><td colspan=2 class=header>Coins Admin</td></tr>
				<tr><td>Selected Account: ",htmlspecialchars($info[1]),"</td></tr>
				<tr><td>Selected Characters: ",htmlspecialchars($_POST['charname']),"<input type=hidden name=charname value='",htmlspecialchars($_POST['charname']),"'></td></tr>
				<tr><td>Current Coins: <b>",htmlspecialchars($coins),"</b></td></tr>
				<tr><td>Give Coins (+):<br><input type=text name=coins_p maxlength=20 value=0 size=20></td></tr>
				<tr><td>Take Coins (-):<br><input type=text name=coins_m maxlength=20 value=0 size=20></td></tr>
				<tr><td colspan=2><input type=submit name=select value=Update></td></tr>
				</form></table>";
	}
} 
elseif($_POST['select'] == 'Update') 
{
	if(!preg_match("/[0-9]?/",$_POST['coins_p'])) 
	{
		echo "Coins in numbers only.<br><a href='javascript:history.back()'>Go Back</a>";
	} 
	elseif(!preg_match("/[0-9]?/",$_POST['coins_m'])) 
	{
		echo "Coins in numbers only.<br><a href='javascript:history.back()'>Go Back</a>";
	}
	else
	{
		$result1 = mssql_query("SELECT character.dbo.user_character.user_no, user_id, amount, free_amount FROM character.dbo.user_character left join cash.dbo.user_cash on cash.dbo.user_cash.user_no = character.dbo.user_character.user_no left join account.dbo.user_profile on account.dbo.user_profile.user_no = character.dbo.user_character.user_no WHERE character_name = '".mssql_escape($_POST['charname'])."'");
   	$info = mssql_fetch_array($result1);     
		$new_coins = ($info[2] + $_POST['coins_p']) - $_POST['coins_m'];
		mssql_query("UPDATE cash.dbo.user_cash SET amount = '".mssql_escape($new_coins)."' WHERE user_no = '".mssql_escape($info[0])."'");
		$coinquery = mssql_query("SELECT amount,free_amount FROM cash.dbo.user_cash WHERE user_no = '".mssql_escape($info[0])."'");
		$coinfetch = mssql_fetch_row($coinquery);
		$currentcoins = $coinfetch[0] + $coinfetch[1];
		echo "Account ",htmlspecialchars($info[1])," was given ",$_POST['coins_p']," coins and had ",$_POST['coins_m']," coins taken. Their new total is ",$currentcoins," coins. ";    
   }
}

?>