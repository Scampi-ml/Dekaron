<?php
if(stristr($_SERVER['PHP_SELF'], 'lostsn.php')){
exit("<strong>Error: </strong>Can't be opened directly!");
}
else
if ($_SESSION['kal_login'] != 'yes'){
echo '<SCRIPT LANGUAGE="JavaScript">
		alert("You Must Login First.")
		window.location = "index.php";
</SCRIPT>';
exit();
}
else
if (!isset($_SERVER['HTTP_REFERER'])){die('<br><center>Direct access not allowed. Click <a href="index.php"><b>here</b></a> to back</font><br></center>');}
else {
;echo '';
if($type == 0){
;echo '';
define('UI_ERROR','%s');
if(isset($_POST['DeAca'])) {
$sn = $_POST['sn'];
$error = array();
if (strlen($sn) == 0){
$error['error'] = sprintf(UI_ERROR,$errorstyle1.'Dont Left Secret Number Empty.'.$errorstyle2);
}
else if(!ctype_alnum($sn)) {
$error['error'] = sprintf(UI_ERROR,$errorstyle1.'Dont use illegal characters.'.$errorstyle2);
}
else
if(empty($error)) {
if($connection == 'mssql'){
$db = &ADONewConnection($connection);
$db->Connect($server,$username,$password,$kal_auth);
}elseif($connection == 'odbc'){
$db = &ADONewConnection($connection);
$db->Connect($kal_auth,$username,$password);
}
$querys = $db->Execute("SELECT [Secret Number],[Type] From Login
 WHERE UID = '".$_SESSION['kal_id']."' ");
$rs = $querys->fetchrow();
$sn1 = $rs[0];
$tt = $rs[1];
if($tt == 5) {
$error['error'] = sprintf(UI_ERROR,$errorstyle1.'Account Already Deactivated'.$errorstyle2);
}else
if(empty($sn1)) {
$error['error'] = sprintf(UI_ERROR,$errorstyle1.'Account has no Secret Number!'.$errorstyle2);
}else
if($sn != $sn1) {
$error['error'] = sprintf(UI_ERROR,$errorstyle1.'Secret number not correct.'.$errorstyle2);
}else
{
if(empty($error)) {
if($connection == 'mssql'){
$db = &ADONewConnection($connection);
$db->Connect($server,$username,$password,$kal_auth);
}elseif($connection == 'odbc'){
$db = &ADONewConnection($connection);
$db->Connect($kal_auth,$username,$password);
}
if($type == 0){					 
$plists = $db->Execute("update Login Set Type = 5,  Status = 'Inactivate' Where Type = 0 And UID = '".$_SESSION['kal_id']."' And [Secret Number] = '".$sn."'");
$error['success'] = sprintf(UI_ERROR,$successstyle1.'Account Deactivated Successfully, You Can Activate It Again In Any Time.
'.$errorstyle2.'<META HTTP-EQUIV=Refresh CONTENT="3; URL=index.php">');
}
}
}
}
}
;echo '<h2 class="ico_mug">Deactivate Account</h2>
<br>
 <style type="text/css">

table.frame table td.fieldarea{text-align:right;}
</style>


	 <form action="" method="post">
		
 	';echo @$error['error'];;echo '	';echo @$error['success'];;echo '';
if(!@$error['success']){
;echo '
<center>
				 <style type="text/css">
table.frame{margin:0 0 10px;padding:0;border:0px solid #EBEBEB;border-bottom:0;}
table.frame table td{border-bottom:0px solid #EBEBEB;}
table.frame table td.fieldarea{color:#333;text-align:right;border-right:0px solid #EBEBEB;}
table.frame table td.fieldareas{text-align:right;}
#cc{margin: 0px 0px 0px 8px;}
#ccs{margin: 0px 0px 0px 15px;}
</style>


 <table width="100%" cellspacing="0" cellpadding="0" class="frame">
    <tr>
      <td><table  border="0" cellpadding="0" cellspacing="0">


<tr>
            <td width="150" class="fieldarea"><font color="black">Secret Number</font>&nbsp;</b></td>
            <td><input type="text" maxlength="80" id="cc" name="sn" value="" size="25" /></td>
          </tr>

<tr>
            <td ></td>
            <td><br><input type="submit" name="DeAca" value="Deactivate Account" id="ccs" /></td>
          </tr>

       </table></td>
    </tr>
  </table><br></form></center>
		
';
}
;echo '	';
}
;echo '	
';
if($type == 5){
;echo '';
define('UI_ERROR','%s');
if(isset($_POST['AcaDa'])) {
$sn = $_POST['sn'];
$error = array();
if (strlen($sn) == 0){
$error['error'] = sprintf(UI_ERROR,$errorstyle1.'Dont Left Secret Number Empty.'.$errorstyle2);
}
else if(!ctype_alnum($sn)) {
$error['error'] = sprintf(UI_ERROR,$errorstyle1.'Dont use illegal characters.'.$errorstyle2);
}
else
if(empty($error)) {
if($connection == 'mssql'){
$db = &ADONewConnection($connection);
$db->Connect($server,$username,$password,$kal_auth);
}elseif($connection == 'odbc'){
$db = &ADONewConnection($connection);
$db->Connect($kal_auth,$username,$password);
}
$querys = $db->Execute("SELECT [Secret Number],[Type] From Login
 WHERE UID = '".$_SESSION['kal_id']."' ");
$rs = $querys->fetchrow();
$sn1 = $rs[0];
$tt = $rs[1];
if($tt == 0){
$error['error'] = sprintf(UI_ERROR,$errorstyle1.'Account Already Activated'.$errorstyle2);
}else
if(empty($sn1)) {
$error['error'] = sprintf(UI_ERROR,$errorstyle1.'Account has no Secret Number!'.$errorstyle2);
}else
if($sn != $sn1) {
$error['error'] = sprintf(UI_ERROR,$errorstyle1.'Secret number not correct.'.$errorstyle2);
}else
{
if(empty($error)) {
if($connection == 'mssql'){
$db = &ADONewConnection($connection);
$db->Connect($server,$username,$password,$kal_auth);
}elseif($connection == 'odbc'){
$db = &ADONewConnection($connection);
$db->Connect($kal_auth,$username,$password);
}
if($type == 5){					 
$plists = $db->Execute("update Login Set Type = 0, Status = 'Normal Member' Where Type = 5 And UID = '".$_SESSION['kal_id']."' And [Secret Number] = '".$sn."'");
$error['success'] = sprintf(UI_ERROR,$successstyle1.'Account Activated Successfully, You Can now login.
'.$errorstyle2.'<META HTTP-EQUIV=Refresh CONTENT="3; URL=index.php">');
}
}
}
}
}
;echo '<h2 class="ico_mug">Activate Account</h2>
<br>
 <style type="text/css">

table.frame table td.fieldarea{text-align:right;}
</style>


	 <form action="" method="post">
		
 	';echo @$error['error'];;echo '	';echo @$error['success'];;echo '';
if(!@$error['success']){
;echo '
<center>
				 <style type="text/css">
table.frame{margin:0 0 10px;padding:0;border:0px solid #EBEBEB;border-bottom:0;}
table.frame table td{border-bottom:0px solid #EBEBEB;}
table.frame table td.fieldarea{color:#333;text-align:right;border-right:0px solid #EBEBEB;}
table.frame table td.fieldareas{text-align:right;}
#cc{margin: 0px 0px 0px 8px;}
#ccs{margin: 0px 0px 0px 15px;}
</style>


 <table width="100%" cellspacing="0" cellpadding="0" class="frame">
    <tr>
      <td><table  border="0" cellpadding="0" cellspacing="0">


<tr>
            <td width="150" class="fieldarea"><font color="black">Secret Number</font>&nbsp;</b></td>
            <td><input type="text" maxlength="80" id="cc" name="sn" value="" size="25" /></td>
          </tr>

<tr>
            <td ></td>
            <td><br><input type="submit" name="AcaDa" value="Activate Account" id="ccs" /></td>
          </tr>

       </table></td>
    </tr>
  </table><br></form></center>
		
';
}
;echo '	';
}
;echo '	
';
if($type == 1){
;echo '';
define('UI_ERROR','%s');
if(isset($_POST['AcaCda'])) {
$sn = $_POST['sn'];
$error = array();
if (strlen($sn) == 0){
$error['error'] = sprintf(UI_ERROR,$errorstyle1.'Dont Left Activation Code Empty.'.$errorstyle2);
}
else if(!ctype_alnum($sn)) {
$error['error'] = sprintf(UI_ERROR,$errorstyle1.'Dont use illegal characters.'.$errorstyle2);
}
else
if(empty($error)) {
if($connection == 'mssql'){
$db = &ADONewConnection($connection);
$db->Connect($server,$username,$password,$kal_auth);
}elseif($connection == 'odbc'){
$db = &ADONewConnection($connection);
$db->Connect($kal_auth,$username,$password);
}
$querys = $db->Execute("SELECT [Activation Key],[Type] From Login
 WHERE UID = '".$_SESSION['kal_id']."' ");
$rs = $querys->fetchrow();
$sn1 = $rs[0];
$tt = $rs[1];
if($tt != 1) {
$error['error'] = sprintf(UI_ERROR,$errorstyle1.'Account Already activated'.$errorstyle2);
}else
if(empty($sn1)) {
$error['error'] = sprintf(UI_ERROR,$errorstyle1.'Account has no Activation Code!'.$errorstyle2);
}else
if($sn != $sn1) {
$error['error'] = sprintf(UI_ERROR,$errorstyle1.'Activation Code not correct.'.$errorstyle2);
}else
{
if(empty($error)) {
if($connection == 'mssql'){
$db = &ADONewConnection($connection);
$db->Connect($server,$username,$password,$kal_auth);
}elseif($connection == 'odbc'){
$db = &ADONewConnection($connection);
$db->Connect($kal_auth,$username,$password);
}
if($type == 1){					 
$activeaa = $db->Execute("update Login Set Type = 0, Status = 'Normal Member' Where Type = 1 And UID = '".$_SESSION['kal_id']."' And [Activation Key] = '".$sn."'");
if($activeaa){
$acct = $db->Execute("SELECT [Secret Number],[PWD],[ID],[Email Address] FROM Login
								WHERE
 [Activation Key] = '".$sn."'
");
$rown = $acct->fetchrow();
$pw  = decode($rown[1]);
$sns  = $rown[0];
$emails  = $rown[3];
$id  = $rown[2];
if(SendinfosEmail($emails, $id, $pw, $sns)){};
$error['success'] = sprintf(UI_ERROR,$successstyle1.'Account Activated Successfully, You Can now login.'.$errorstyle2.''.$successstyle1.'You will receive a message on your e-mail with account details'.$errorstyle2.'<META HTTP-EQUIV=Refresh CONTENT="3; URL=index.php">');
}
}
}
}
}
}
;echo '<h2 class="ico_mug">Activate Account</h2>
<br>
 <style type="text/css">

table.frame table td.fieldarea{text-align:right;}
</style>


	 <form action="" method="post">
		
 	';echo @$error['error'];;echo '	';echo @$error['success'];;echo '';
if(!@$error['success']){
;echo '
<center>
				 <style type="text/css">
table.frame{margin:0 0 10px;padding:0;border:0px solid #EBEBEB;border-bottom:0;}
table.frame table td{border-bottom:0px solid #EBEBEB;}
table.frame table td.fieldarea{color:#333;text-align:right;border-right:0px solid #EBEBEB;}
table.frame table td.fieldareas{text-align:right;}
#cc{margin: 0px 0px 0px 8px;}
#ccs{margin: 0px 0px 0px 15px;}
</style>


 <table width="100%" cellspacing="0" cellpadding="0" class="frame">
    <tr>
      <td><table border="0" cellpadding="0" cellspacing="0">


<tr>
            <td width="150" class="fieldarea"><font color="black">Activation Code</font>&nbsp;</b></td>
            <td><input type="text" maxlength="100" id="cc" name="sn" value="" size="25" /></td>
          </tr>

<tr>
            <td ></td>
            <td><br><input type="submit" name="AcaCda" value="Activate Account" id="ccs" /></td>
          </tr>

       </table></td>
    </tr>
  </table><br></form></center>
		
';
}
;echo '	';
}
;echo '	


';
}
;echo '
';?>