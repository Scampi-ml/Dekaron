<?php
ob_start();
session_start();
//error_reporting(0);
//ini_set('display_errors',false);
echo "<html><head>
<link rel='bookmark icon' href=images/alpha.ico><link href=config/alphanew.css type=text/css rel=stylesheet>
<title>Alpha Dekaron</title></head><body><table cellpadding=0 cellspacing=0 class=main align=center>
		<tr><td colspan=3 class=img></tr>";
include_once("config/login.php");
$aSites = array('irc'=>'irc.php','home' => 'news.php','download' => 'download.php','about' => 'about.php', 'top100'=>'top100.php','guild'=>'guild.php');
if(!isset($_SESSION['accname']) || !isset($_SESSION['accname']))
{
define(ALLOW_OPEN, 2);
$nSites = array('login' => 'login.php','register' => 'register.php');
$aSites = array_merge($aSites, $nSites);
echo "<tr><td id=nav><table cellpadding=0><form action='' method=POST>
			<tr><td>Username: <br><input type=text name=accname maxlength=15 /></td></tr>
			<tr><td>Password: <br><input type=password name=accpass maxlength=15 /></td></tr>
			<tr><td style=padding-bottom:8px;><input type=submit name=log value=Login></form></td></tr>
			<tr><td id=header>Navigation</td></tr>
			<tr><td class=nav style=padding-bottom:10px;><a href=?do=register target=_self>Register</a></td></tr>
			<tr><td class=nav><a href=?do=home target=_self>News</a></td></tr>
			<tr><td class=nav><a href=?do=download target=_self>Client Download</a></td></tr>
			<tr><td class=nav><a href=?do=about target=_self>Server Information</a></td></tr>
			<tr><td class=nav><a href=?do=top100 target=_self>Top 100 Ranks</a></td></tr>
			<tr><td class=nav><a href=http://forum.alphadekaron.com target=_self>Forum</a></td></tr>
			<tr><td class=nav><a href=?do=irc target=_self>IRChat</a></td></tr>";
}
else
{
	define(ALLOW_OPEN, 1);
	if (!isset($_SESSION['ip']) || $_SESSION['ip'] <> $_SERVER['REMOTE_ADDR'])
	{
		mssql_query("INSERT INTO osds.dbo.sessionlog values (getdate(), '".mssql_escape($_SESSION['accname'])."', '".mssql_escape($_SERVER['REMOTE_ADDR'])."', 'Login Success')");
		$_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
	}
	$lSites = array('vote'=>'vote.php','awards'=>'aawards.php','mystats'=>'mystats.php','vip'=>'vip.php','iplog'=>'ipacctlog.php','expbank'=>'expbank.php','guildmanage'=>'guildmanage.php', 'changepass'=>'changepass.php', 'logout'=>'logout.php');
	$aSites = array_merge($aSites, $lSites);
	echo "<tr><td id=nav><table>
	<tr><td id=header>Navigation</td></tr>
	<tr><td class=nav style=padding-bottom:10px;><a href=?do=logout target=_self>Logout</a></td></tr>
	<tr><td class=nav><a href=?do=home target=_self>News</a></td></tr>
	<tr><td class=nav><a href=?do=download target=_self>Client Download</a></td></tr>
	<tr><td class=nav><a href=?do=about target=_self>Server Information</a></td></tr>
	<tr><td class=nav><a href=?do=top100 target=_self>Top 100 Ranks</a></td></tr>
	<tr><td class=nav><a href=http://forum.alphadekaron.com target=_self>Forum</a></td></tr>
	<tr><td class=nav><a href=?do=irc target=_self>IRChat</a></td></tr>
	<tr><td id=header>My Account</td></tr>
	<tr><td class=nav><a href=?do=awards&type=myawards target=_self>Alpha Awards</a></td></tr>
	<tr><td class=nav><a href=?do=changepass target=_self>Change Password</font></a></td></tr>
	<tr><td class=nav><a href=?do=expbank&type=bank target=_self>Experience Banking</a></td></tr>
	<tr><td class=nav><a href=?do=guildmanage target=_self>Guild Management</a></td></tr>
	<tr><td class=nav><a href=?do=iplog target=_self>Login log</a></td></tr>
	<tr><td class=nav><a href=?do=mystats target=_self>PvP Stats</a></td></tr>
	<tr><td class=nav><a href=?do=vip target=_self>VIP Management</a></td></tr>
	<tr><td class=nav><a href=?do=vote target=_self>Vote for coins</a></td></tr>";
	if($_SESSION['isGM'] == '1' || $_SESSION['isGM'] == '2')
	{
		echo "<tr><td id=header>GM Tools</td></tr>
		<tr><td class=nav><a href=?do=banacc target=_self>Ban Account</a></td></tr>
		<tr><td class=nav><a href=?do=cashlog target=_self>Cash Use Log</a></td></tr>
		<tr><td class=nav><a href=?do=list target=_self>CSV Lists</a></td></tr>
		<tr><td class=nav><a href=?do=eupdate target=_self>Events Manage</a></td></tr>
		<tr><td class=nav><a href=?do=playeronline target=_self>Player Online</a></td></tr>
		<tr><td class=nav><a href=?do=lookup target=_self>Master Lookup</a></td></tr>
		<tr><td class=nav><a href=?do=newsupdate target=_self>Site News</a></td></tr>";

		$gmSites = array('eupdate'=>'eventupdate.php','list'=>'list.php', 'lookup'=>'lookup.php','newsupdate' => 'newsupdate.php', 'banacc'=>'banacc.php','cashlog'=>'cash_use_log.php','playeronline'=>'playeronline.php');
		$aSites = array_merge($aSites, $gmSites);
	}
	if($_SESSION['isGM'] == '2')
	{
		$adminSites = array ('vipadmin'=>'vipadmin.php','dtool'=>'dtool.php','teleport'=>'teleport.php','authority'=> 'authority.php','downloadupdate'=>'downloadupdate.php','delinfo'=>'deleteinfo.php', 'sendmail' => 'sendmail.php', 'modaccount'=> 'modaccount.php', 'coinmanage' => 'coinmanage.php');
		$aSites = array_merge($aSites, $adminSites);
		echo "<tr><td id=header>Admin Tools</td></tr>
		<tr><td class=nav><a href=?do=authority target=_self>Authorities</a></td></tr>
		<tr><td class=nav><a href=?do=delinfo target=_self>Character Info Delete</a></td></tr>
		<tr><td class=nav><a href=?do=coinmanage target=_self>Coins Admin</a></td></tr>
		<tr><td class=nav><a href=?do=dtool target=_self>Donation Tool</a></td></tr>
		<tr><td class=nav><a href=?do=downloadupdate target=_self>Downloads Manage</a></td></tr>
		<tr><td class=nav><a href=?do=modaccount target=_self>Modify Account</a></td></tr>
		<tr><td class=nav><a href=?do=sendmail target=_self>Send Mail</a></td></tr>
		<tr><td class=nav><a href=?do=teleport target=_self>Teleport Character</a></td></tr>
		<tr><td class=nav><a href=?do=vipadmin target=_self>VIP Admin</a></td></tr>";
	}
}
echo"</table></td><td class=data>";
if ($error == 0)
{
	if(!empty($_GET['do']) && array_key_exists($_GET['do'], $aSites))
	{
		$page = $aSites[$_GET['do']];
	}
	else 
	{
		$page = $aSites['home'];
	}
	include $page;
}
else
{
	echo $errormsg;
}
echo '</td></tr></table></body></head></html>';
ob_end_flush();
?>
