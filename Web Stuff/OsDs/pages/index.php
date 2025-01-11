<?php
define(ALLOW_OPEN, 1);
error_reporting(0);
ini_set('display_errors',false);

echo "<link href='../config/stylesheet.css' type='text/css' rel='stylesheet'>";
include("../config/mssql.conf.php");
include("../config/login.php");

if($error != '0') {

	echo "<center><table width='517' height='90' border='0'>
			  <tr>
				<th height='100%' background='images/error.png'><table width='517' border='0'>
				  <tr>
					<td width='148'>&nbsp;</td>
					<td width='359'>&nbsp;</td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td>".$error."</td>
				  </tr>
				</table></th>
			  </tr>
			</table>
		</center>";
} else {
	//start html
echo "</head>
		<body>
			<table align='center' cellspacing='0' cellpadding='0' class='main' style='border-bottom: 1px solid #000000;'>
		<tr>
			<td><img src='images/banner.jpg' width='785' height='146' alt='Banner' />
			<table align='left' width='137' cellspacing='0' cellpadding='0' style='margin-left: 5px; margin-top: 5px; margin-bottom: 5px; border: 1px solid #000000;' bgcolor='#E5E5E5'>
				<tr valign='top'>
					<td>
						<img src='images/bar_a_mode.jpg' width='137' height='20' />";
					if($is_gm == '1') {
					echo "<br><br><center><img src='images/mode/dev.png'/></center><br>";
				} elseif($is_gm == '2') {
					echo "<br><br><center><img src='images/mode/opr.png'/></center><br>";
				} elseif($is_gm == '3') {
					echo "<br><br><center><img src='images/mode/gm.png'/></center><br>";
				} else {
					echo "<br><br><center><img src='images/mode/user.png'/></center><br>";
				}

				echo"</td>
					<tr>
					<td>
						<img src='images/bar_mainnav.jpg' width='137' height='20' />
				</td>
			</tr>
				</tr>
				<tr>
					<td style='padding: 3px;'>";
				if($is_gm != '0') {
				echo "
				&nbsp;+ <a href='?do=start&id=".$id."' target='_self'>Home</a><br>
				&nbsp;+ <a href='logout.php' target='_self'>Logout</a><br><br>
				<b>General Tools</b><br>
				&nbsp;+ <a href='?do=character&id=".$id."' target='_self'>Modify Character</a><br>
				&nbsp;+ <a href='?do=teleport&id=".$id."' target='_self'>Teleport Character</a><br>
				&nbsp;+ <a href='?do=coinsadmin&id=".$id."' target='_self'>Coins Admin</a><br>
				&nbsp;+ <a href='?do=weapon&id=".$id."' target='_self'>Send Weapon</a><br>
				&nbsp;+ <a href='?do=armor&id=".$id."' target='_self'>Send Armor</a><br>
				&nbsp;+ <a href='?do=item&id=".$id."' target='_self'>Send Item</a><br>
				&nbsp;+ <a href='?do=account&id=".$id."' target='_self'>Modify Account</a><br>
				&nbsp;+ <a href='?do=banchar&id=".$id."' target='_self'>Ban Character</a><br>
				&nbsp;+ <a href='?do=banacc&id=".$id."' target='_self'>Ban Account</a><br><br>
				<b>Logs</b><br>
				&nbsp;+ <a href='?do=cash_use_log&id=".$id."' target='_self'>Cash Use Log</a><br>
				&nbsp;+ <a href='?do=char_logout_log&id=".$id."' target='_self'>Character Logout Log</a><br>
				&nbsp;+ <a href='?do=char_login_log&id=".$id."' target='_self'>Character Login Log</a><br><br>
				<b>Other</b><br>
				&nbsp;+ <a href='?do=df_log&id=".$id."' target='_self'>Dead Front List</a><br>
				&nbsp;+ <a href='?do=gm_online&id=".$id."' target='_self'>Gm Online List</a><br>
				&nbsp;+ <a href='?do=playeronline&id=".$id."' target='_self'>Player Online</a><br>
				&nbsp;+ <a href='?do=getcharacter&id=".$id."' target='_self'>Get Chars From Acc</a><br><br>
				<b>Deleting Tools</b><br>
				&nbsp;+ <a href='?do=delskill&id=".$id."' target='_self'>Delete Skills</a><br>
				&nbsp;+ <a href='?do=deldquest&id=".$id."' target='_self'>Delete Active Quests</a><br>
				&nbsp;+ <a href='?do=delinv&id=".$id."' target='_self'>Delete Inventory</a><br>
				&nbsp;+ <a href='?do=delpost&id=".$id."' target='_self'>Delete Mailbox</a><br>
				&nbsp;+ <a href='?do=delpshop&id=".$id."' target='_self'>Delete Personal Shop</a><br>
				&nbsp;+ <a href='?do=delstorage&id=".$id."' target='_self'>Delete Storage</a><br>
				&nbsp;+ <a href='?do=deldoquest&id=".$id."' target='_self'>Delete Done Quests</a><br>
				&nbsp;+ <a href='?do=delskillbar&id=".$id."' target='_self'>Deleted Skillbar</a><br>
				&nbsp;+ <a href='?do=delsuit&id=".$id."' target='_self'>Delete Equipped Items</a><br><br>
				<b>Website Tools</b><br>
				&nbsp;+ <a href='?do=rules&id=".$id."' target='_self'>Site Rules</a><br>
				&nbsp;+ <a href='?do=about&id=".$id."' target='_self'>Site About</a><br>
				&nbsp;+ <a href='?do=news&id=".$id."' target='_self'>Site News</a><br>
				&nbsp;+ <a href='?do=download&id=".$id."' target='_self'>Download Link</a><br><br>
				<b>Your Personal Account</b><br>
				&nbsp;+ <a href='?do=exchange&id=".$id."' target='_self'>Your Coins</font></a><br>
				&nbsp;+ <a href='?do=unstuck&id=".$id."' target='_self'>Unstuck Yourself</font></a><br>
				&nbsp;+ <a href='?do=user&id=".$id."' target='_self'>My Account</font></a><br><br>
				</tr>
				<tr>
					<td>
						<img src='images/bar_update.jpg' width='137' height='20' />
						&nbsp;+ <a href='?do=check&id=".$id."' target='_self'>Check for updates</font></a><br><br>
					</td>
				</tr>
				";
			} else {
				echo "
				<b>User Actions</b><br>
				&nbsp;+ <a href='?do=exchange&id=".$id."' target='_self'>Your Coins</font></a><br>
				&nbsp;+ <a href='?do=unstuck&id=".$id."' target='_self'>Unstuck Yourself</font></a><br>
				&nbsp;+ <a href='?do=user&id=".$id."' target='_self'>My Account</font></a><br>
				";
			}

			echo"</td>
					</table>
				<table align='center' width='445' cellspacing='0' style='margin-top: 5px; margin-bottom: 5px;'>
					<tr>
						<td>&nbsp;<br><br>";
						
			if(!empty($_GET['do'])) {
				$incl = anti_injection($_GET['do'].".php");
			} else {
				$incl = "start.php";
			}

			if(file_exists($incl)) {
				include $incl;
			} else {
				echo "<center><br><br><img src='images/error_action.png'/></center>";
			}

			echo "		</td>
					</tr>
				</table>
					</td>
				</tr>
				</table>
				<tr>
					<td>
						<center>|--- Made By <a href='http://www.elitepvpers.de/forum/members/528942-janvier123.html'>Janvier123</a> No Copyright 2009 - <a href='http://www.elitepvpers.de/forum/2moons-pserver-hosting/339168-release-osds-control-panel.html'>Support</a> - Version: OsDs V2 Beta 1 R151009 ---|</center>
					</td>
				</tr>
			</body>
		</html>";
}
?>
