<?php

error_reporting(0);
ini_set('display_errors',false);

echo "<link href='../config/stylesheet.css' type='text/css' rel='stylesheet'>";
include("../config/mssql.conf.php");
include("../config/mysql.conf.php");
include("../config/login.php");

if($error != '0') {
	echo "<center>".$error."</center>";
} else {
	$file = 'main';
	include("../config/lang.conf.php");
	if(file_exists("../config/language/".$controlpanel_language."/controlpanel/".$file.".php")) {
		include("../config/language/".$controlpanel_language."/controlpanel/".$file.".php");
	} else {
		include("../config/language/english/controlpanel/".$file.".php");
	}
	echo "<center><table class='maintab'>
		<tr>
			<td colspan='2' height='10' align='center'>";
				if($is_gm == '1') {
					echo "<p class='loggeddev'>".$language['loggedindev']."</p>";
				} elseif($is_gm == '2') {
					echo "<p class='loggedopr'>".$language['loggedinopr']."</p>";
				} elseif($is_gm == '3') {
					echo "<p class='loggedgm'>".$language['loggedingm']."</p>";
				} else {
					echo "<p class='loggeduser'>".$language['loggedinuser']."</p>";
				}
			echo "</td>
		</tr>
		<tr>
			<td class='navigate'><b><u>".$language['navigation']."</u><b><br><br>";
			if($is_gm != '0') {
				echo "
				<a href='?function=character&uc=".$uc."' target='_self'>".$language['gm_character']."</a><br>
				<a href='?function=teleport&uc=".$uc."' target='_self'>".$language['gm_teleport']."</a><br>
				<a href='?function=premium&uc=".$uc."' target='_self'>".$language['gm_coins']."</a><br>
				<a href='?function=weapon&uc=".$uc."' target='_self'>".$language['gm_weapon']."</a><br>
				<a href='?function=armor&uc=".$uc."' target='_self'>".$language['gm_armor']."</a><br>
				<a href='?function=item&uc=".$uc."' target='_self'>".$language['gm_item']."</a><br>
				<a href='?function=account&uc=".$uc."' target='_self'>".$language['gm_account']."</a><br>
				<a href='?function=banchar&uc=".$uc."' target='_self'>".$language['gm_banchar']."</a><br>
				<a href='?function=banacc&uc=".$uc."' target='_self'>".$language['gm_banacc']."</a><br>
				";
			} else {
				echo "
				<a href='?function=coins&uc=".$uc."' target='_self'>".$language['user_coins']."</font></a><br>
				<a href='?function=rescue&uc=".$uc."' target='_self'>".$language['user_rescue']."</font></a><br>
				<a href='?function=user&uc=".$uc."' target='_self'>".$language['user_user']."</font></a><br>
				";
			}
			echo "</td>
			<td align='center' valign='top'>";
			if(!empty($_GET['function'])) {
				$incl = $_GET['function'].".php";
			} else {
				$incl = "start.php";
			}

			if(file_exists($incl)) {
				include $incl;
			} else {
				echo "<center><br><br>".$language['no_function']."</center>";
			}
			echo "</td>
		</tr>
		<tr>
			<td colspan='2' height='10' align='center'>Created and Copyright by <a href='mailto:Nicky@AngelZ-World.com'>Nicky</a> @ <a href='http://www.AngelZ-World.com' target='_blank'>AngelZ-World.com</a></td>
		</tr>
	</table></center>";
}
?>
