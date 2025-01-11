<link href='stylesheet.css' rel='stylesheet' type='text/css'>
<?php
$file = 'index';
error_reporting(1);
ini_set('display_errors',true);
include("../config/mssql.conf.php");
include("../config/mysql.conf.php");
include("../config/login.php");
if($error != '0') {
	echo "<center>".$error."</center>";
} else {
	$file = 'main';
	}
	echo "<center>
	<table><img src='images/banner.jpg'>
	<table class='body' width='785' border='0'>
		<tr>
			<td colspan='2' height='10' align='left'>";
				if($is_gm == '1') {
					echo "<p class='loggeddev'>Logged in as [DEV] with full access.</p>";
				} elseif($is_gm == '2') {
					echo "<p class='loggedopr'>Logged in as [OPR] with full access.</p>";
				} elseif($is_gm == '3') {
					echo "<p class='loggedgm'>Logged in as [GM] with full access.</p>";
				} else {
					echo "<p class='loggeduser'>Logged in as normal player with limited access.</p>";
				}
			echo "</td>
		</tr>
		<tr>
			<td width='15%' valign='top'background='images/bg_main.jpg' align='left'>";
			if($is_gm != '0') {
				echo "
				<a href='?function=start&uc=".$uc."' target='_self'>Home</a><br>
				<a href='?function=character&uc=".$uc."' target='_self'>Modify Character</a><br>
				<a href='?function=teleport&uc=".$uc."' target='_self'>Teleport Character</a><br>
				<a href='?function=premium&uc=".$uc."' target='_self'>Character Coins</a><br>
				<a href='?function=weapon&uc=".$uc."' target='_self'>Send Weapon</a><br>
				<a href='?function=armor&uc=".$uc."' target='_self'>Send Armor</a><br>
				<a href='?function=item&uc=".$uc."' target='_self'>Send Item</a><br>
				<a href='?function=account&uc=".$uc."' target='_self'>Modify Account</a><br>
				<a href='?function=banchar&uc=".$uc."' target='_self'>Ban Character</a><br>
				<a href='?function=banacc&uc=".$uc."' target='_self'>Ban Account</a><br><br>
				<b>Admin Logs</b><br>
				<a href='?function=itemsend&uc=".$uc."' target='_self'>Send Items Log</a><br>
				<a href='?function=referred&uc=".$uc."' target='_self'>Referred Log</a><br>
				<a href='?function=cash&uc=".$uc."' target='_self'>Coins Log</a><br><br>
				<b>Other</b><br>
				<a href='?function=playeronline&uc=".$uc."' target='_self'>Characters Online</a><br>
				<a href='?function=guilds&uc=".$uc."' target='_self'>Guilds</a><br>
				<a href='?function=XXXXX&uc=".$uc."' target='_self'>Chracter List</a><br><br>
				<b>Personal</b><br>
				<a href='?function=coins&uc=".$uc."' target='_self'>My Coins</font></a><br>
				<a href='?function=rescue&uc=".$uc."' target='_self'>Rescue me</a><br>
				<a href='?function=user&uc=".$uc."' target='_self'>My Info</font></a><br>
				<a href='?function=usercharacter&uc=".$uc."' target='_self'>My Character Stats</a><br><br>
				<b>Website</b><br>
				<a href='?function=news&uc=".$uc."' target='_self'>News</a><br>
				<a href='?function=banpanel&uc=".$uc."' target='_self'>Register IP Ban</a><br>
				<a href='?function=founderpanel&uc=".$uc."' target='_self'>Game IP Ban</a><br>
				<a href='?function=download&uc=".$uc."' target='_self'>Download</a><br>
				";
			} else {
				echo "
				<a href='?function=usercharacter&uc=".$uc."' target='_self'>user_stats</a><br>
				<a href='?function=coins&uc=".$uc."' target='_self'>user_coins</a><br>
				<a href='?function=rescue&uc=".$uc."' target='_self'>user_rescue</a><br>
				<a href='?function=user&uc=".$uc."' target='_self'>user_user</a><br><br>
				";
			}
			echo "</td>
			<td align='center' width='85%' valign='top' background='images/bg_main.jpg'>";
			if(!empty($_GET['function'])) {
				$incl = $_GET['function'].".php";
			} else {
				$incl = "start.php";
			}

			if(file_exists($incl)) {
				include $incl;
			} else {
				echo "<center><br><br>no_function</center>";
			}
			echo "</td >
		</tr>
	</table>Made By: Janvier123</center>";

?>

