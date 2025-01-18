<?php
$ms_con = mssql_connect($mssql['host'],$mssql['user'],$mssql['pass']);
$del_session = time()-1800;
mssql_query("DELETE FROM osds.dbo.session WHERE lastActiv < '".$del_session."'",$ms_con);

$ip = getenv(REMOTE_ADDR);
$thetime = time();

if($_POST['log'] == 'login') {
	
	$accname = $_POST['accname'];
	$accpass = $_POST['accpass'];

	$crypt_accpass = md5($accpass);

// login to your game account 

	$result1 = mssql_query("SELECT * FROM account.dbo.USER_PROFILE WHERE user_id = '".$accname."'",$ms_con); 
	$count1 = mssql_num_rows($result1); 

	$result2 = mssql_query("SELECT user_pwd,user_no FROM account.dbo.USER_PROFILE WHERE user_id = '".$accname."'",$ms_con); 
	$row2 = mssql_fetch_row($result2); 

	$result3 = mssql_query("SELECT character_name FROM character.dbo.user_character WHERE user_no = '".$row2[1]."'",$ms_con); 
	 
// check if login account is GM or not
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
// get the GM rank for permissions
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

// get user_no and character_name for osds scripting for fast access
	$user_no = $row2[1];
 
// create a custom id for logins
	$combi .= $accname.'_'.$ip.'_'.$thetime.'_'.$accpass;
	$id = sha1($combi);

} else {

// do NOT change osds.dbo.session or it will not connect to the database

	$id = $_GET['id'];
	$result1 = mssql_query("SELECT * FROM osds.dbo.session WHERE sha='$id'",$ms_con); 
	$count1 = mssql_num_rows($result1);

	$result2 = mssql_query("SELECT lastActiv,lastIp,isgm,user_no,gm_name FROM osds.dbo.session WHERE sha='$id'",$ms_con); 
	$row2 = mssql_fetch_row($result2);

	$is_gm = $row2[2];
	$user_no = $row2[3];
	$gm_name = $row2[4];

	$again = time()-1800;

}
// this is the error list
if($_POST['log'] == 'login' && $count1 == '0') {
	$error = '<br>This game account is not found in the database.<br><br><a href="../index.php" target="_self">Back to Login</a>';
}
elseif($_POST['log'] == 'login' && $row2[0] != $crypt_accpass) {
	$error = '<br>Wrong game account password. Try again.<br><br><a href="../index.php" target="_self">Back to Login</a>';
}
elseif($_POST['log'] != 'login' && $count1 == '0') {
	$error = '<br>Login Error, Please login again.<br><br><a href="../index.php" target="_self">Back to Login</a>';
}
elseif($_POST['log'] != 'login' && $row2[0] < $again) {
	$error = '<br>You were inactive for too long. Please login again.<br><br><a href="../index.php" target="_self">Back to Login</a>';
}
elseif($_POST['log'] != 'login' && $row2[1] != $ip) {
	$error = '<br>You were inactive for too long. Please login again.<br><br><a href="../index.php" target="_self">Back to Login</a>';
}
else {
	if($_POST['log'] == 'login') {
		mssql_query("INSERT INTO osds.dbo.session (sha,lastActiv,lastIp,isgm,user_no,gm_name) VALUES ('".$id."','".$thetime."','".$ip."','".$is_gm."','".$row2[1]."','".$gm_name."')",$ms_con);
	} else {
		mssql_query("UPDATE osds.dbo.session SET lastActiv = '".$thetime."' WHERE sha1 = '".$id."'",$ms_con);
	}
	$error = '0';
}
?>