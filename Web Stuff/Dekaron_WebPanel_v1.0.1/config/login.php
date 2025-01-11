<?php

$file = 'login';
include("../config/lang.conf.php");
if(file_exists("../config/language/".$controlpanel_language."/controlpanel/".$file.".php")) {
	include("../config/language/".$controlpanel_language."/controlpanel/".$file.".php");
} else {
	include("../config/language/english/controlpanel/".$file.".php");
}

$ms_con = mssql_connect($mssql['host'],$mssql['user'],$mssql['pass']);
$my_con = mysql_connect($mysql['host'],$mysql['user'],$mysql['pass']);

$del_session = time()-1800;
mysql_query("DELETE FROM `".$mysql['data']."`.`session` WHERE `lastActiv` < '".$del_session."'",$my_con);

$ip = getenv(REMOTE_ADDR);
$thetime = time();

if($_POST['log'] == 'login') {
	
	$accname = $_POST['accname'];
	$accpass = $_POST['accpass'];
	$ergebnis1 = $_POST['ergebnis1'];
	$ergebnis2 = $_POST['ergebnis2'];

	$crypt_accpass = md5($accpass);

	//Game Account

	$result1 = mssql_query("SELECT * FROM account.dbo.USER_PROFILE WHERE user_id = '".$accname."'",$ms_con); 
	$count1 = mssql_num_rows($result1); 

	$result2 = mssql_query("SELECT user_pwd,user_no FROM account.dbo.USER_PROFILE WHERE user_id = '".$accname."'",$ms_con); 
	$row2 = mssql_fetch_row($result2); 

	$result3 = mssql_query("SELECT character_name FROM character.dbo.user_character WHERE user_no = '".$row2[1]."'",$ms_con); 
	while($row3 = mssql_fetch_row($result3)) {
		if(preg_match("/[[GM]]/i",$row3[0])) {
			$gm_is = '3';
			$name_gm = $row3[0];
		} 
		if(preg_match("/[[DEV]]/i",$row3[0])) {
			$dev_is = '2';
			$name_dev = $row3[0];
		}
		if(preg_match("/[[OPD]]/i",$row3[0])) {
			$op_is = '1';
			$name_op = $row3[0];
		}
	}

	if(!empty($gm_is) && empty($dev_is) && empty($op_is)) {
		$is_gm = '3';
		$gm_name = $name_gm;
	} elseif(empty($gm_is) && !empty($dev_is) && empty($op_is)) {
		$is_gm = '2';
		$gm_name = $name_dev;
	} elseif(empty($gm_is) && empty($dev_is) && !empty($op_is)) {
		$is_gm = '1';
		$gm_name = $name_op;
	} elseif(!empty($gm_is) && !empty($dev_is) && empty($op_is) || !empty($gm_is) && empty($dev_is) && !empty($op_is) || !empty($gm_is) && !empty($dev_is) && !empty($op_is)) {
		$is_gm = '3';
		$gm_name = $name_gm;
	} elseif(empty($gm_is) && !empty($dev_is) && !empty($op_is)) {
		$is_gm = '2';
		$gm_name = $name_dev;
	} else {
		$is_gm = '0';
		$gm_name = 'NoGM';
	}

	$user_no = $row2[1];
 
	$combi .= $accname.'_'.$ip.'_'.$thetime.'_'.$accpass;
	$uc = sha1($combi);

} else {

	$uc = $_GET['uc'];
	$result1 = mysql_query("SELECT * FROM `".$mysql['data']."`.`session` WHERE `sha`='$uc'",$my_con); 
	$count1 = mysql_num_rows($result1);

	$result2 = mysql_query("SELECT `lastActiv`,`lastIp`,`isgm`,`user_no`,`gm_name` FROM `".$mysql['data']."`.`session` WHERE `sha`='$uc'",$my_con); 
	$row2 = mysql_fetch_row($result2);

	$is_gm = $row2[2];
	$user_no = $row2[3];
	$gm_name = $row2[4];

	$again = time()-1800;

}

if($_POST['log'] == 'login' && $count1 == '0') {
	$error = '<br>'.$language['error1'].'<br><br><a href="../controlpanel.php" target="_self">'.$language['backtologin'].'</a>';
}
elseif($_POST['log'] == 'login' && $row2[0] != $crypt_accpass) {
	$error = '<br>'.$language['error2'].'<br><br><a href="../controlpanel.php" target="_self">'.$language['backtologin'].'</a>';
}
elseif($_POST['log'] == 'login' && $ergebnis1 != $ergebnis2 || $_POST['log'] == 'login' && !$ergebnis2) {
	$error = '<br>'.$language['error3'].'<br><br><a href="../controlpanel.php" target="_self">'.$language['backtologin'].'</a>';
}
elseif($_POST['log'] != 'login' && $count1 == '0') {
	$error = '<br>'.$language['error4'].'<br><br><a href="../controlpanel.php" target="_self">'.$language['backtologin'].'</a>';
}
elseif($_POST['log'] != 'login' && $row2[0] < $again) {
	$error = '<br>'.$language['error5'].'<br><br><a href="../controlpanel.php" target="_self">'.$language['backtologin'].'</a>';
}
elseif($_POST['log'] != 'login' && $row2[1] != $ip) {
	$error = '<br>'.$language['error6'].'<br><br><a href="../controlpanel.php" target="_self">'.$language['backtologin'].'</a>';
}
else {

	if($_POST['log'] == 'login') {

		mysql_query("INSERT INTO `".$mysql['data']."`.`session` (`sha`,`lastActiv`,`lastIp`,`isgm`,`user_no`,`gm_name`) VALUES ('".$uc."','".$thetime."','".$ip."','".$is_gm."','".$row2[1]."','".$gm_name."')",$my_con);

	} else {

		mysql_query("UPDATE `".$mysql['data']."`.`seesion` SET `lastActiv` = '".$thetime."' WHERE `sha1` = '".$uc."'",$my_con);

	}
	$error = '0';
}

?>