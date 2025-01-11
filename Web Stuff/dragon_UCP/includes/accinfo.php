<?php

echo '<h2 class="ico_mug">Account Information</h2>
 <style type="text/css">

table.frame table td.fieldarea{text-align:right;}
</style>
';
if(stristr($_SERVER['PHP_SELF'], 'accinfo.php')){
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
else
{
switch($_GET[go]){
default:
if($connection == 'mssql'){
$db = &ADONewConnection($connection);
$db->Connect($server,$username,$password,$kal_auth);
}elseif($connection == 'odbc'){
$db = &ADONewConnection($connection);
$db->Connect($kal_auth,$username,$password);
}
$query = $db->Execute("SELECT ID,[Email Address],[Registration_IP],[Activation Date],[Registration_Date],[Gender],[Date of Birth],[Last IP Logged In] From Login
 WHERE UID = '".$_SESSION['kal_id']."' 
 ");
$r = $query->fetchrow();
$id = $r[0];
$email = $r[1];
$registration_ip = $r[2];
$activation_date = $r[3];
$registration_date = $r[4];
$Gender = $r[5];
$birth = $r[6];
$lastip = $r[7];
if ($site == 'accinfo'){
echo'<br><center><b><font color="#5F5C5C">My Account Information</font></b> | <a href="?page=accinfo&amp;go=changepw">Change Account Password</a> | <a href="?page=accinfo&amp;go=changemail">Change E-mail Address</a> <br><br><br><br></center>';
}
;echo '
 <style type="text/css">
table.frame{margin:0 0 10px;padding:0;border:1px solid #EBEBEB;border-bottom:0;}
table.frame table td{background-color:#FFF;border-bottom:1px solid #EBEBEB;}
table.frame table td.fieldarea{background-color:#F5F5F5;color:#333;text-align:right;border-right:1px solid #EBEBEB;}
table.frame table td.fieldareas{text-align:right;}
</style>


<span style="font-size:20px; color:#3C86DA" >My Account Information<br></span><hr><br>

 <table width="100%" cellspacing="0" cellpadding="0" class="frame">
    <tr>
      <td><table width="100%" border="0" cellpadding="10" cellspacing="0">
          <tr>
            <td width="150" class="fieldarea">Account ID</td>
            <td><input type="text" name="id" value="';echo''.$id.'';;echo '" size="25"  readonly="readonly"/></td>
          </tr>
          <tr>
            <td class="fieldarea">Registration E-mail</td>
            <td><input type="text" name="email" value="';echo''.$email.'';;echo '" size="25"  readonly="readonly"/></td>
          </tr>
          <tr>
            <td class="fieldarea">Registration Date</td>
            <td><input type="text" name="regdate" value="';echo''.$registration_date.'';;echo '" size="25"  readonly="readonly"/></td>
          </tr>
          <tr>
            <td class="fieldarea">Registration IP</td>
            <td><input type="text" name="regip" value="';echo''.$registration_ip.'';;echo '" size="25"  readonly="readonly"/></td>
          </tr>
          <tr>
            <td class="fieldarea">Activation Date</td>
            <td><input type="text" name="actdate" value="';echo''.$activation_date.'';;echo '" size="25" readonly="readonly" /></td>
          </tr>
		            <tr>
            <td class="fieldarea">Gender</td>
            <td><input type="text" name="upip" value="';echo''.$Gender.'';;echo '" size="25" readonly="readonly" /></td>
          </tr>
		  
		  		            <tr>
            <td class="fieldarea">Date of Birth</td>
            <td><input type="text" name="upip" value="';echo''.$birth.'';;echo '" size="25" readonly="readonly" /></td>
          </tr>
		  
          <tr>
            <td class="fieldarea">Last IP Logged In</td>
            <td><input type="text" name="upip" value="';echo''.$_SESSION['kal_lastip'].'';;echo '" size="25" readonly="readonly" /></td>
          </tr>
          <tr>
            <td class="fieldarea">Country</td>
            <td>';echo getCountryFromIP($lastip, ' NamE ');;echo '</td>
          </tr>
       </table></td>
    </tr>
  </table>




';
break;
case'changepw':
define('UI_ERROR','%s');
if(strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
$oldpw = $_POST['oldpw'];
$sn = $_POST['sn'];
$newpw = $_POST['newpw'];
$renewpw = $_POST['renewpw'];
$error = array();
if(!ctype_alnum($oldpw)) {
$error['error'] = sprintf(UI_ERROR,$errorstyle1.'Dont left old password filed empty or use illegal characters.'.$errorstyle2);
}else
if(strlen($oldpw) > 20) {
$error['error'] = sprintf(UI_ERROR,$errorstyle1.'Old password too long.'.$errorstyle2);
}
else
if(!ctype_alnum($newpw)) {
$error['error'] = sprintf(UI_ERROR,$errorstyle1.'Dont left new password filed empty or use illegal characters.'.$errorstyle2);
}else
if((strlen($newpw) < 3) || (strlen($newpw) > 8)) {
$error['error'] = sprintf(UI_ERROR,$errorstyle1.' new Password should be 4-8 characters!'.$errorstyle2);
} 
else if((strlen($renewpw) < 3) || (strlen($renewpw) > 8)) {
$error['error'] = sprintf(UI_ERROR,$errorstyle1.'confirm new Password should be 4-8 characters!'.$errorstyle2);
} else
if(!ctype_alnum($renewpw)) {
$error['error'] = sprintf(UI_ERROR,$errorstyle1.'Dont left confirm new password filed empty or use illegal characters.'.$errorstyle2);
} 
else				
if($newpw !== $renewpw) {
$error['error'] = sprintf(UI_ERROR,$errorstyle1.'Your new passwords dont match!'.$errorstyle2);
}
else if(!ctype_alnum($sn)) {
$error['error'] = sprintf(UI_ERROR,$errorstyle1.'Dont left secret number filed empty or use illegal characters.'.$errorstyle2);
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
$querys = $db->Execute("SELECT [Secret Number],[PWD] From Login
 WHERE UID = '".$_SESSION['kal_id']."' ");
for($i=0;$i < $querys->numrows();++$i)
{
$rs = $querys->fetchrow();
$sn1 = $rs[0];
$oldpw1 = decode($rs[1]);
}
if($oldpw != $oldpw1) {
$error['error'] = sprintf(UI_ERROR,$errorstyle1.'Old Password not correct.'.$errorstyle2);
}else
if(empty($sn1)) {
$error['error'] = sprintf(UI_ERROR,$errorstyle1.'Account has no Secret Number!'.$errorstyle2);
}else
if($sn != $sn1) {
$error['error'] = sprintf(UI_ERROR,$errorstyle1.'Secret number not correct.'.$errorstyle2);
}else
{
if(empty($error)) {		
$newpw = passConvert($newpw);
$change = $db->Execute("UPDATE	Login
SET
[PWD] = $newpw					WHERE 
 UID = '".$_SESSION['kal_id']."' 									
								
");
$error['success']  = sprintf(UI_ERROR,$successstyle1.'Password has been changed successfully.'.$errorstyle2);
}}
}}
echo'<br><center><a href="?page=accinfo">My Account Information</a> | <b><font color="#5F5C5C">Change Account Password</font></b> | <a href="?page=accinfo&amp;go=changemail">Change E-mail Address</a> <br><br><br><br></center>';
;echo '

<span style="font-size:20px; color:#3C86DA" >Change Account Password<br></span><hr><br>
	';echo @$error['error'];;echo '	';echo @$error['success'];;echo '';
if(!@$error['success']){
;echo '<form method=\'post\' action=\'\'>
 <table width="100%" cellspacing="0" cellpadding="0" class="frame">
    <tr>
      <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="150" class="fieldarea">Old Password&nbsp;</td>
            <td><input type="password" name="oldpw" value="" size="25"  /></td>
          </tr>
          <tr>
            <td class="fieldarea">New Password&nbsp;</td>
            <td> <input type="password" name="newpw" value="" size="25"  /></td>
          </tr>
          <tr>
            <td class="fieldarea">Confirm New Password&nbsp;</td>
            <td> <input type="password" name="renewpw" value="" size="25"  /></td>
          </tr>
                    <tr>
            <td class="fieldarea">Secret Number&nbsp;</td>
            <td> <input AutoComplete="off" type="text" name="sn" value="" size="25"  /></td>
          </tr>
    <tr>
            <td class="fieldarea"></td>
            <td><br><input type="submit" value="Change" id="save" /></td>
          </tr>


       </table></td>
    </tr>
  </table><br>
</form>
';
}
;echo '';
break;
case'changemail':
if($connection == 'mssql'){
$db = &ADONewConnection($connection);
$db->Connect($server,$username,$password,$kal_auth);
}elseif($connection == 'odbc'){
$db = &ADONewConnection($connection);
$db->Connect($kal_auth,$username,$password);
}
$query = $db->Execute("SELECT ID,[Email Address],[Registration_Date],[Registration_IP] From Login
 WHERE UID = '".$_SESSION['kal_id']."' 
 ");
$r = $query->fetchrow();
$email = $r[1];
if (empty($email)){ 
die ('<SCRIPT LANGUAGE="JavaScript">
		alert("You cant use this feature because there no email address for this account.")
		window.location = "index.php";
</SCRIPT>');
exit();
}else {
define('UI_ERROR','%s');
if(strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
$sn = $_POST['sn'];
$emaill = preg_replace ('[^A-Za-z0-9]', '', $_POST['txtEmail']);
$emaill = str_replace($idk, '', $emaill);
$reemaill = preg_replace ('[^A-Za-z0-9]', '', $_POST['retxtEmail']);
$reemaill = str_replace($idk, '', $reemaill);
$error = array();
if (empty($_POST['txtEmail'])){
$error['error'] = sprintf(UI_ERROR,$errorstyle1.'Please enter new E-mail Address!'.$errorstyle2);
} else
if (strlen($emaill) == 0){
$error['error'] = sprintf(UI_ERROR,$errorstyle1.'Please enter new E-mail Address!'.$errorstyle2);
} else
if (@preg_match('/[^a-zA-Z0-9\_\-\.\@]/', $_POST['txtEmail'])) {
$error['error'] = sprintf(UI_ERROR,$errorstyle1.'Invalid E-mail Address.'.$errorstyle2);
}else
if($_POST['txtEmail'] != $emaill){
$error['error'] = sprintf(UI_ERROR,$errorstyle1.'Invalid E-mail Address'.$errorstyle2);
}  else
if (strlen($emaill) < 4){
$error['error'] = sprintf(UI_ERROR,$errorstyle1.'E-mail Address should be more than 4 characters!'.$errorstyle2);
}  else
if (strlen($emaill) > 80){
$error['error'] = sprintf(UI_ERROR,$errorstyle1.'E-mail Address should be no more than 40 characters!'.$errorstyle2);
} 
else
if (!ereg('@',$emaill) ) {
$error['error'] = sprintf(UI_ERROR,$errorstyle1.'Invalid E-mail Address'.$errorstyle2);
} 
else
if (empty($_POST['retxtEmail'])){
$error['error'] = sprintf(UI_ERROR,$errorstyle1.'Please enter confirm new E-mail Address!'.$errorstyle2);
} else
if (strlen($reemaill) == 0){
$error['error'] = sprintf(UI_ERROR,$errorstyle1.'Please enter confirm new E-mail Address!'.$errorstyle2);
} else
if (@preg_match('/[^a-zA-Z0-9\_\-\.\@]/', $_POST['retxtEmail'])) {
$error['error'] = sprintf(UI_ERROR,$errorstyle1.'Invalid E-mail Address.'.$errorstyle2);
}else
if($_POST['retxtEmail'] != $reemaill){
$error['error'] = sprintf(UI_ERROR,$errorstyle1.'Invalid E-mail Address'.$errorstyle2);
}  else
if (strlen($reemaill) < 4){
$error['error'] = sprintf(UI_ERROR,$errorstyle1.'E-mail Address should be more than 4 characters!'.$errorstyle2);
}  else
if (strlen($reemaill) > 80){
$error['error'] = sprintf(UI_ERROR,$errorstyle1.'E-mail Address should be no more than 40 characters!'.$errorstyle2);
} 
else
if (!ereg('@',$reemaill) ) {
$error['error'] = sprintf(UI_ERROR,$errorstyle1.'Invalid E-mail Address'.$errorstyle2);
} 
else
if($emaill !== $reemaill) {
$error['error'] = sprintf(UI_ERROR,$errorstyle1.'New E-mails dont match!'.$errorstyle2);
}
else if(!ctype_alnum($sn)) {
$error['error'] = sprintf(UI_ERROR,$errorstyle1.'Dont left secret number filed empty or use illegal characters.'.$errorstyle2);
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
$querys = $db->Execute("SELECT [Secret Number] From Login
 WHERE UID = '".$_SESSION['kal_id']."' ");
$rs = $querys->fetchrow();
$sn1 = $rs[0];
if(empty($sn1)) {
$error['error'] = sprintf(UI_ERROR,$errorstyle1.'Account has no Secret Number!'.$errorstyle2);
}else
if($sn != $sn1) {
$error['error'] = sprintf(UI_ERROR,$errorstyle1.'Secret number not correct.'.$errorstyle2);
}else
{
$querysqm = $db->Execute("SELECT [Email Address] FROM Login WHERE  [Email Address] = '".$emaill."'");
$rss = $querysqm->fetchrow();
$emai2 = $rss[0];
if($emaill == $email) {
$error['error'] = sprintf(UI_ERROR,$errorstyle1.'You Already using this Email Adress.'.$errorstyle2);
}else
if($emai2 == $emaill) {
$error['error'] = sprintf(UI_ERROR,$errorstyle1.'Email Adress Already Used Before. Choose Other One.'.$errorstyle2);
}else
{
$change = $db->Execute("UPDATE	Login
SET
[Email Address] = '".$emaill."'					WHERE 
 UID = '".$_SESSION['kal_id']."'			
");
$error['success']  = sprintf(UI_ERROR,$successstyle1.'E-mail Address has been changed successfully.'.$errorstyle2);
}						
}
}}
}
echo'<br><center><a href="?page=accinfo">My Account Information</a> | <a href="?page=accinfo&amp;go=changepw">Change Account Password</a> | <b><font color="#5F5C5C">Change E-mail Address</font></b> <br><br><br><br></center>';
;echo '
 
 <span style="font-size:20px; color:#3C86DA" >Change E-mail Address<br></span><hr><br>
 	';echo @$error['error'];;echo '	';echo @$error['success'];;echo '';
if(!@$error['success']){
;echo ' <form method=\'post\' action=\'\'>
 <table width="100%" cellspacing="0" cellpadding="0" class="frame">
    <tr>
      <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
           <tr>
            <td width="150" class="fieldarea">Old E-mail&nbsp;</td>
            <td><input type="text" name="email" value="';echo''.$email.'';;echo '" size="25"  readonly="readonly"/></td>
          </tr>
          <tr>
            <td class="fieldarea">New E-mail&nbsp;</td>
            <td><input type="text" name="txtEmail" value="" size="25"  /></td>
          </tr>
          <tr>
            <td class="fieldarea">Confirm New E-mail&nbsp;</td>
            <td><input type="text" name="retxtEmail" value="" size="25"  /></td>
          </tr>
          <tr>
            <td class="fieldarea">Secret Number&nbsp;</td>
            <td><input  AutoComplete="off" type="text" name="sn" value="" size="25" /></td>
          </tr>
<tr>
            <td class="fieldarea"></td>
            <td><br><input type="submit" value="Change" id="save" /></td>
          </tr>

       </table></td>
    </tr>
  </table><br>

  ';
}
;echo ' ';
break;
}
}
?>