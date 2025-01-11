<?php
if(stristr($_SERVER['PHP_SELF'], 'check.php')){
exit("<strong>Error: </strong>Can't be opened directly!");
}
if ($_SESSION['kal_login'] != 'yes'){
define('UI_ERROR','%s');
if(isset($_POST['SubmitLoginAcc'])) {
include('settings.php');
include('config.php');
$usernames = clean_var($_POST['usernames']);
$passwords = clean_var($_POST['passwords']);
$error = array();
if(!ctype_alnum($usernames)) {
$error['error'] = sprintf(UI_ERROR,'<div class="msg msg-error"><p><strong>&nbsp;&nbsp;&nbsp;&nbsp;
								ERROR : </strong> Dont Use Illegal Letters in username.</p></div>');
} else
if(!ctype_alnum($passwords)) {
$error['error'] = sprintf(UI_ERROR,'<div class="msg msg-error"><p><strong>&nbsp;&nbsp;&nbsp;&nbsp;
								ERROR : </strong> Illigal characters in the password.</p></div>');
}else
if(empty($error)) {
$passwords = passConvert($passwords);
if($connection == 'mssql'){
$db = &ADONewConnection($connection);
$db->Connect($server,$username,$password,$kal_auth);
}elseif($connection == 'odbc'){
$db = &ADONewConnection($connection);
$db->Connect($kal_auth,$username,$password);
}
$query = $db->Execute("SELECT ID,UID,[Last Date Logged In],[Last IP Logged In] FROM Login WHERE ID = '".$usernames."' AND PWD = ".$passwords.'');
if ($query->numrows() == 1){
for($i=0;$i < $query->numrows();++$i)
{
$r = $query->fetchrow();
$_SESSION['kal_login'] = 'yes';
$_SESSION['kal_username'] = $r[0];
$_SESSION['kal_id'] = $r[1];
$_SESSION['kal_lastip'] = $r[3];
$lasttime = $r[2];
$none = ( "It's first time to login");
if (empty($lasttime)) {
$_SESSION['kal_lastlogin'] = $none;
}
else if(!empty($lasttime)) {
$_SESSION['kal_lastlogin'] = $lasttime;
}	
$ip = $_SERVER['REMOTE_ADDR'];
$date = date( 'M dS Y');
$sql = $db->Execute("UPDATE Login SET [Last Date Logged In] = '$date' , [Last IP Logged In] = '$ip' WHERE UID = '".$_SESSION['kal_id']."'");
die('			 <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"><head><title>Logged In successfully</title>
<div align="center" ><br><br>
<table  width=400 height=350><tr><td style="text-align: center">

 <link rel="stylesheet" type="text/css" href="images/login.css"  />
			 
		<div class="msg msg-succes"><p>You are logged in successfully.<br>
<img src="images/login.gif"></strong></p></div>	

		</center></div></table><META HTTP-EQUIV=Refresh CONTENT="3; URL=index.php">
		');
}
} else {
$error['error'] = sprintf(UI_ERROR,'<div class="msg msg-error"><p><strong>&nbsp;&nbsp;&nbsp;&nbsp;
								ERROR : </strong> Username or Password not correct.</p></div>');
}
}
}
}
?>