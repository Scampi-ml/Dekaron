<?php
$ms_con = mssql_pconnect("localhost","account","account");
if ($ms_con == false)
{
	echo '<tr><td><center>The database is offline. Please check back later.</center></td></tr></table></body></head></html>';
	exit(0);
}
$mapsPath = 'C:\maplist.csv';
$weapPath="C:\itemweapon.csv";
$armPath="C:\itemarmor.csv";
$etcPath="C:\itemetc.csv";
$monPath="C:\monster.csv";
$cPath = 'C:\xampp\php\cports.exe';
function mssql_escape($str, $a=0)
{
	if (strlen($str) > 100 && $a=0)
	{
		Header('HTTP/1.1 403');
		exit(0);
	}
	else
	{
		return preg_replace('/\'/','\'\'', $str);
	}
}

function vipcheck()
{
	$query = mssql_query("Select vip, vCredits, dTotal from account.dbo.tbl_user where user_id = '".mssql_escape($_SESSION['accname'])."'");
	$fetch = mssql_fetch_array($query);
	if ($fetch[0] != 0)
	{
	
		$today = strtotime(date("n/j/Y g:i:s A"));
		$expiration_date = strtotime($fetch[0]);
		
		if ($expiration_date > $today) 
		{
			$_SESSION['VIP'] = 1;
			return array(0 => 'VIP valid until '.htmlspecialchars($fetch[0]).'.', 1 => $fetch[1], 2 => $fetch[2]);
		}
		else 
		{
		  $_SESSION['VIP'] = 0;
		  return array(0 => 'VIP expired on '.htmlspecialchars($fetch[0]).'!', 1 => $fetch[1], 2 => $fetch[2]);
		}
	}
	else
	{
	$_SESSION['VIP'] = 0;
	return array(0 => 'You do not have VIP!', 1 => $fetch[1], 2 => $fetch[2]);
	}
}
?>
