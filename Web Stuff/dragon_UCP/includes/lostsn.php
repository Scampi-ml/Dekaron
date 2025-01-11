<?php

echo '<h2 class="ico_mug">Lost Secret Number</h2>';

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
else
{
;echo '';
define('UI_ERROR','%s');
if(strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
$emaill = preg_replace ('[^A-Za-z0-9]', '', $_POST['email']);
$idk=array('"', "'", ';', '/', " \ ", 'DROP', 'union','UNION', 'SELECT', 'drop', 'select','DELETE','delete' , '+' , ':' , '!' , '#' , '$' , '%' , '^' , '&' , '*' , '|' , ')' , '(' , '}' , '{' , '=' , '<' , '>' , '`' , ',' , ' ');
$emaill = str_replace($idk, '', $emaill);
$error = array();
if (strlen($emaill) == 0){
$error['mail'] = sprintf(UI_ERROR,$errorstyle1.'Dont Left Email Adress Empty.'.$errorstyle2);
}
else if (@preg_match('/[^a-zA-Z0-9\_\-\.\@]/', $_POST['email'])) {
$error['mail'] = sprintf(UI_ERROR,$errorstyle1.'Invalid E-mail Address.'.$errorstyle2);
}
else if($_POST['email'] != $emaill){
$error['mail'] = sprintf(UI_ERROR,$errorstyle1.'Invalid E-mail Address.'.$errorstyle2);
} 
else if (strlen($emaill) < 4){
$error['mail'] = sprintf(UI_ERROR, $errorstyle1.'E-mail Adress Too Short.'.$errorstyle2);
} 
else if (strlen($emaill) > 80){
$error['mail'] = sprintf(UI_ERROR, $errorstyle1.'E-mail Adress Too Long.'.$errorstyle2);
} 
else
if (!ereg('@',$emaill) ) {
$error['mail'] = sprintf(UI_ERROR,$errorstyle1.'Invalid E-mail Address.'.$errorstyle2);
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
$sql = $db->Execute("SELECT [Email Address] FROM Login
								WHERE
 [Email Address] = '".$emaill."'
");
$row = $sql->fetchrow();
if(empty($row[0])){
$error['mail'] = sprintf(UI_ERROR,$errorstyle1.'Email Adress Not Correct.'.$errorstyle2);
}else{
if(empty($error)) {
if($connection == 'mssql'){
$db = &ADONewConnection($connection);
$db->Connect($server,$username,$password,$kal_auth);
}elseif($connection == 'odbc'){
$db = &ADONewConnection($connection);
$db->Connect($kal_auth,$username,$password);
}
$plists = $db->Execute("SELECT ID,[Secret Number]
       FROM
            [Login]
        WHERE
                 [Email Address] = '".$emaill."'");
$r = $plists->fetchrow();
$id = $r[0];
$sn = $r[1];
if(SendsnEmail($emaill,$id,$sn)){};
$error['success'] = sprintf(UI_ERROR,$successstyle1.'Secret Number has been Sent Successfully.
'.$errorstyle2.'<META HTTP-EQUIV=Refresh CONTENT="3; URL=index.php">');
}
}
}	
}
;echo '<br>
 <style type="text/css">

table.frame table td.fieldarea{text-align:right;}
</style>


	 <form action="" method="post">
		
 	';echo @$error['mail'];;echo '	';echo @$error['success'];;echo '';
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
            <td width="150" class="fieldarea"><font color="black">E-mail Address</font>&nbsp;</b></td>
            <td><input type="text" maxlength="80" id="cc" name="email" value="" size="25" /></td>
          </tr>

<tr>
            <td ></td>
            <td><br><input type="submit" value="Send Secret Number" id="ccs" /></td>
          </tr>

       </table></td>
    </tr>
  </table><br></form></center>
		
';
}
;echo '		


';
}
;echo '

';?>