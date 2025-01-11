<?php
if(ALLOW_OPEN != 1) {
Header('HTTP/1.1 403');
exit(0);
}
$sError;
function voteSite($votesite, $table)
{
$coins = 25;
$vipbonus = .25;
vipcheck();
if ($_SESSION['VIP'] == 1)
{
	$add =  $coins * $vipbonus;
	$coins += $add;
	$coins = round($coins);
}
$time_needed = "719";
$ip = $_SERVER['REMOTE_ADDR'];
$result2 = mssql_query("SELECT * FROM cash.dbo.user_cash WHERE user_no = '".mssql_escape($_SESSION['user_no'])."'");
$count_coins = mssql_num_rows($result2);
if($count_coins == '0')
{
 	return "This account has not visited the D-shop yet. You cannot receive your coins. Please login into the server, and visit the D-shop then <a href='?do=votenow'>go back and try again</a>.";
} 
elseif($count_coins == '1') 
{
	$result2 = mssql_query("SELECT top 1 * FROM osds.dbo.".mssql_escape($table)." WHERE ip='".mssql_escape($_SERVER['REMOTE_ADDR'])."' or account='".mssql_escape($_SESSION['accname'])."' order by wDate desc");
	$count2 = mssql_num_rows($result2);
	if($count2 == 1)
	{
		$row2 = mssql_fetch_row($result2);
		$voted_id = $row2[0];
		$voted_account = $row2[1];
		$voted_ip = $row2[2];
    		$voted_date = $row2[3];
		$to_time = strtotime($voted_date);
		$from_time = strtotime(date("Y-m-d G:i"));
		$timeleft = date("F jS g:i A",strtotime($voted_date." +12 hours"));
      	if (round(abs($to_time - $from_time) / 60,2) > $time_needed) 
		{ 
			$lQuery = mssql_query("INSERT INTO osds.dbo.".mssql_escape($table)." VALUES ('".mssql_escape($_SESSION['user_no'])."','".mssql_escape($_SESSION['accname'])."','".mssql_escape($ip)."',getdate())");
			if($lQuery != false)
			{
			mssql_query("UPDATE cash.dbo.user_cash SET amount = amount + ".mssql_escape($coins)." WHERE user_no = '".mssql_escape($_SESSION['user_no'])."'");    
			header('Location: '.$votesite);
			}
			else
			{
				return 'Voting insert errors!';
			}
		} 
		else 
		{
			return "You cant vote anymore! Please try again on ".$timeleft." (GMT-5)";
		}
	} 
	else 
	{
		$lQuery = mssql_query("INSERT INTO osds.dbo.".mssql_escape($table)." VALUES ('".mssql_escape($_SESSION['user_no'])."','".mssql_escape($_SESSION['accname'])."','".mssql_escape($ip)."',getdate())");
		if($lQuery != false)
		{
		mssql_query("UPDATE cash.dbo.user_cash SET amount = amount + ".mssql_escape($coins)." WHERE user_no = '".mssql_escape($_SESSION['user_no'])."'");                               
		header('Location: '.$votesite);
		}
		else
		{
			return 'Voting insert error!';
		}
	}
}
else
{
return 'Data access error!';
}       

}
if($_GET['site']==1){$sError = voteSite('http://www.xtremetop100.com/in.php?site=1132314393','vote');}
if($_GET['site']==2){$sError = voteSite('http://www.gtop100.com/in.php?site=64842','vote2');}
echo '<table><tr class=header><td class=header>Vote for Alpha Dekaron</td></tr>
	<tr><td><br/><form action=?do=vote&site=1 method=POST><input type=submit name=vote value="Vote on Xtremetop100 (25 coins)"/></form></td></tr>
	<tr><td><form action=?do=vote&site=2 method=POST><input type=submit name=vote value="Vote on Top 100 Games (25 coins)"/></form></td></tr><tr><td>',$sError,'</td></tr></table>';
?>