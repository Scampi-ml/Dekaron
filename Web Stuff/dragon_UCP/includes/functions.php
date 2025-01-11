<?php
if(stristr($_SERVER['PHP_SELF'], 'functions.php')){
exit("<strong>Error: </strong>Can't be opened directly!");
}
function clean_var($var=NULL) {
$newvar = @preg_replace('/[^a-zA-Z0-9\_\-\.\@]/', '', $var);
if (@preg_match('/[^a-zA-Z0-9\_\-\.\@]/', $var)) {
die('Dont Use Illegal Characters in any field');}
return $newvar;
if (preg_match('/select /i', $var) || preg_match('/</i', $var) || preg_match('/>/i', $var) || preg_match('/delete /i', $var) || preg_match('/drop/i', $var) || preg_match('/where /i', $var) || preg_match("/'/i", $var) || preg_match('/;/i', $var) || preg_match('/,/i', $var) || preg_match('/ /i', $var) || preg_match('/%/i', $var)) {
die('Dont Use Illegal Characters in any field');
exit();
}
}
foreach($_GET as $gets){
if (preg_match('/select /i', $gets) || preg_match('/</i', $gets) || preg_match('/:/i', $gets)  || preg_match('/>/i', $gets)  || preg_match('/ * /i', $gets) || preg_match("/ \ /i", $gets) || preg_match('/delete /i', $gets) || preg_match('/drop/i', $gets) || preg_match('/where /i', $gets) || preg_match("/'/i", $gets) || preg_match('/;/i', $gets) || preg_match('/,/i', $gets) || preg_match('/-/i', $gets) || preg_match('/ /i', $gets) || preg_match('/%/i', $gets)) {
die('URL Contains Illegal Characters');
exit();
}}
function SQLinject($var){
if(eregi('union',$var) || eregi('select',$var) || eregi(' ',$var) || eregi(';',$var) || eregi('delete',$var) || eregi('"',$var) || eregi('drop',$var)  || eregi(" \ ",$var)   || eregi(':',$var) || eregi('/',$var) || eregi("'",$var)|| eregi('-',$var)|| eregi("\*",$var)|| eregi('FROM',$var)){
die('URL Contains Illegal Characters');
exit();
}
} 
$idk=array('"', "'", ';', '/', " \ ", "\\", '//','DROP', 'union', 'UNION', 'SELECT', 'drop', 'select','DELETE','delete' , '+' , ':' , '!' , '#' , '$' , '%' , '^' , '&' , '*' , '|' , ')' , '(' , '}' , '{' , '=' , '<' , '>' , '`' , ',' , ' ');
function passConvert($passwords)
{
$encar = array('!'=>'95', '"'=>'88', '#'=>'9D', '$'=>'4C', '%'=>'F2', '&'=>'3E', '\''=>'BB', '('=>'C0', ')'=>'7F', '*'=>'18', '+'=>'70', ','=>'A6', '-'=>'E2', '.'=>'EC', '/'=>'77',
'0'=>'2C', '1'=>'3A', '2'=>'4A', '3'=>'91', '4'=>'5D', '5'=>'7A', '6'=>'29', '7'=>'BC', '8'=>'6E', '9'=>'D4', ':'=>'40', ';'=>'17', '<'=>'2E', '='=>'CB', '>'=>'72', '?'=>'9C',
'@'=>'A1', 'A'=>'FF', 'B'=>'F3', 'C'=>'F8', 'D'=>'9B', 'E'=>'50', 'F'=>'51', 'G'=>'6D', 'H'=>'E9', 'I'=>'9A', 'J'=>'B8', 'K'=>'84', 'L'=>'A8', 'M'=>'14', 'N'=>'38', 'O'=>'CE',
'P'=>'92', 'Q'=>'5C', 'R'=>'F5', 'S'=>'EE', 'T'=>'B3', 'U'=>'89', 'V'=>'7B', 'W'=>'A2', 'X'=>'AD', 'Y'=>'71', 'Z'=>'E3', '['=>'D5', '\\'=>'BF', ']'=>'53', '^'=>'28', '_'=>'44',
'`'=>'33', 'a'=>'48', 'b'=>'DB', 'c'=>'FC', 'd'=>'09', 'e'=>'1F', 'f'=>'94', 'g'=>'12', 'h'=>'73', 'i'=>'37', 'j'=>'82', 'k'=>'81', 'l'=>'39', 'm'=>'C2', 'n'=>'8D', 'o'=>'7D',
'p'=>'08', 'q'=>'4F', 'r'=>'B0', 's'=>'FE', 't'=>'79', 'u'=>'0B', 'v'=>'D6', 'w'=>'23', 'x'=>'7C', 'y'=>'4B', 'z'=>'8E', '{'=>'06', '|'=>'5A', '}'=>'CC', '~'=>'62');
$newpass = '0x';
for ($i = 0;$i < strlen($passwords);$i++)
{
$newpass .= $encar[$passwords[$i]];
}					
return $newpass;
}
function RandomKeys($length)
{
$pattern = '1234567890abcdefghijklmnopqrstuvwxyz';
for($i=0;$i<$length;$i++)
{
if(isset($key))
$key .= $pattern{rand(0,35)};
else
$key = $pattern{rand(0,35)};
}
return $key;
}
function RandomNubmers($length)
{
$pattern = '1234567890';
for($i=0;$i<$length;$i++)
{
if(isset($key))
$key .= $pattern{rand(0,10)};
else
$key = $pattern{rand(0,10)};
}
return $key;
}
function SendEmail($emaill, $subject, $body)
{
global $Email_Host,$Email_Username,$Email_Password,$Email_From,$Email_FromName;
require('class.phpmailer.php');
$mail = new PHPMailer();
$mail->SetLanguage( 'en', 'phpmailer/language/' );
$mail->IsSMTP();
$mail->Host     = $Email_Host;
$mail->SMTPAuth = true;
$mail->Username = $Email_Username;
$mail->Password = $Email_Password;
$mail->From     = $Email_From;
$mail->FromName = $Email_FromName;
$mail->AddAddress($emaill);
$mail->IsHTML(true);
$mail->Subject  =  $subject;
$mail->Body  =  $body;
if(!$mail->Send())
{
return false;
}
else
{
return true;
}
}
function SendActivationEmail($emaill, $usernames, $password2, $sn, $active)
{	
include('settings.php');
$subject = "Account Activation at $Server_Name";
$body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<style>
body {
	font-family:Arial, Helvetica, sans-serif;
	color:#333;
}
</style>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{$subject}</title>
</head>
<body>


Dear <b>'.$usernames.',</strong></font></b><br><br>

<br>
To complete the registration process on '.$Server_Name.', you have to activate your account.<br>
To activate your account you will need to go to the URL below in your web browser<br><br>
'.$Server_Site.'/register/?go=activated&activekey='.$active.'<br><br>
If the above link does not work correctly, go to<br><br>
'.$Server_Site.'/register/?go=activate<br><br>
You will need to enter the following:<br>
==============================================<br>
<b>Activation Code: </b> '.$active.'<br />
==============================================<br><br>
Thank you,<br>
'.$Server_Name.' Team
</body>
</html>

';
if(!SendEmail($emaill,$subject,$body))
{
return false;
}
else
{
return true;
}
}
function SendactiveEmail($emaill, $active, $id)
{	
include('settings.php');
$subject = "Account Activation at $Server_Name";
$body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<style>
body {
	font-family:Arial, Helvetica, sans-serif;
	color:#333;
}
</style>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{$subject}</title>
</head>
<body>


Dear <b>'.$id.',</strong></font></b><br><br>

<br>
To complete the registration process on '.$Server_Name.', you have to activate your account.<br>
To activate your account you will need to go to the URL below in your web browser<br><br>
'.$Server_Site.'/register/?go=activated&activekey='.$active.'<br><br>
If the above link does not work correctly, go to<br><br>
'.$Server_Site.'/register/?go=activate<br><br>
You will need to enter the following:<br>
==============================================<br>
<b>Activation Code: </b> '.$active.'<br />
==============================================<br><br>
Thank you,<br>
'.$Server_Name.' Team
</body>
</html>

';
if(!SendEmail($emaill,$subject,$body))
{
return false;
}
else
{
return true;
}
}
function SendinfosEmail($emails, $id, $pw, $sn)
{	
include('settings.php');
$subject = 'Account Information';
$body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<style>
body {
	font-family:Arial, Helvetica, sans-serif;
	color:#333;
}
</style>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{$subject}</title>
</head>
<body>


Welcome : <strong><font color="red"><b>'.$id.'</strong></font></b><br><br>

<br>
 Congratulation. Account has been activated successfully<br>
Your account details are as follows:<br>
=================================<br>
<b>Username: </b> '.$id.'<br />
<b>Password: </b> '.$pw.'<br />
<b>Secret Number:</b> '.$sn.'<br />
<b>Email Adress: </b> '.$emails.'<br />
=================================<br><br>
<b>Secret Number!</b><br>
It is <b>IMPORTANT</b> that u save this number,<br> 
if you wish to change your password or email address!<br> <br> 

'.$Server_Name.' Team.
</body>
</html>

';
if(!SendEmail($emails,$subject,$body))
{
return false;
}
else
{
return true;
}
}
function SendpasswordEmail($emaill, $id, $pw)
{		
include('settings.php');
$subject = 'Account Password';
$body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<style>
body {
	font-family:Arial, Helvetica, sans-serif;
	color:#333;
}
</style>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{$subject}</title>
</head>
<body>

<center>
<font color="blue" size="4">'.$Server_Name.'</font></div></strong></font></b><br>
</center>
<br>
Hello,<b>'.$id.'</b><br><br>
You Received Account Password Successfully
<br>

Your account password :<br>
=================================<br>
<b>Username: </b> '.$id.'<br />
<b>Password:</b> '.$pw.'<br />
=================================<br><br>
 <br> 
'.$Server_Name.' Team.

</body>
</html>

';
if(!SendEmail($emaill,$subject,$body))
{
return false;
}
else
{
return true;
}
}
function SendsnEmail($emaill,$id,$sn)
{		
include('settings.php');
$subject = 'Account Secret Number';
$body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<style>
body {
	font-family:Arial, Helvetica, sans-serif;
	color:#333;
}
</style>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{$subject}</title>
</head>
<body>

<center>
<font color="blue" size="4">'.$Server_Name.'</font></div></strong></font></b><br>
</center>
<br>
Hello,<b>'.$id.'</b><br><br>
You Received Secret Number Successfully
<br>
Your Secret Number<br>
=================================<br>
<b>Username: </b> '.$id.'<br />
<b>Secret Number:</b> '.$sn.'<br />
<b>E-mail Address:</b> '.$emaill.'<br />
=================================<br><br>
 <br> 
 
'.$Server_Name.' Team.



</body>
</html>

';
if(!SendEmail($emaill,$subject,$body))
{
return false;
}
else
{
return true;
}
}
class Passwords
{
function encode($passwords) {
$encar = array('!'=>'95', '"'=>'88', '#'=>'9D', '$'=>'4C', '%'=>'F2', '&'=>'3E'
,'\''=>'BB', '('=>'C0', ')'=>'7F','*'=>'18', '+'=>'70', ','=>'A6'
,'-'=>'E2', '.'=>'EC', '/'=>'77','0'=>'2C', '1'=>'3A', '2'=>'4A'
,'3'=>'91', '4'=>'5D', '5'=>'7A','6'=>'29', '7'=>'BC', '8'=>'6E'
,'9'=>'D4', ':'=>'40', ';'=>'17', '<'=>'2E', '='=>'CB', '>'=>'72'
,'?'=>'9C','@'=>'A1', 'A'=>'FF', 'B'=>'F3', 'C'=>'F8', 'D'=>'9B'
,'E'=>'50','F'=>'51', 'G'=>'6D', 'H'=>'E9','I'=>'9A', 'J'=>'B8'
,'K'=>'84', 'L'=>'A8', 'M'=>'14', 'N'=>'38', 'O'=>'CE'
,'P'=>'92', 'Q'=>'5C', 'R'=>'F5', 'S'=>'EE', 'T'=>'B3', 'U'=>'89'
,'V'=>'7B', 'W'=>'A2', 'X'=>'AD','Y'=>'71', 'Z'=>'E3', '['=>'D5'
,'\\'=>'BF', ']'=>'53', '^'=>'28','_'=>'44'
,'`'=>'33', 'a'=>'48', 'b'=>'DB', 'c'=>'FC', 'd'=>'09', 'e'=>'1F'
,'f'=>'94', 'g'=>'12', 'h'=>'73'
,'i'=>'37', 'j'=>'82', 'k'=>'81', 'l'=>'39', 'm'=>'C2', 'n'=>'8D'
,'o'=>'7D','p'=>'08', 'q'=>'4F', 'r'=>'B0', 's'=>'FE', 't'=>'79'
,'u'=>'0B','v'=>'D6', 'w'=>'23', 'x'=>'7C'
,'y'=>'4B', 'z'=>'8E', '{'=>'06', '|'=>'5A', '}'=>'CC', '~'=>'62');
$newpass = '0x';
for ($i = 0;$i < strlen($passwords);$i++) {
$newpass .= $encar[$passwords[$i]];
}
return $newpass;
}
function decode($passwords) {
$passwords = bin2hex($passwords);
$encar = array('!'=>'95', '"'=>'88', '#'=>'9D', '$'=>'4C', '%'=>'F2', '&'=>'3E'
,'\''=>'BB', '('=>'C0', ')'=>'7F','*'=>'18', '+'=>'70', ','=>'A6'
,'-'=>'E2', '.'=>'EC', '/'=>'77','0'=>'2C', '1'=>'3A', '2'=>'4A'
,'3'=>'91', '4'=>'5D', '5'=>'7A','6'=>'29', '7'=>'BC', '8'=>'6E'
,'9'=>'D4', ':'=>'40', ';'=>'17', '<'=>'2E', '='=>'CB', '>'=>'72'
,'?'=>'9C','@'=>'A1', 'A'=>'FF', 'B'=>'F3', 'C'=>'F8', 'D'=>'9B'
,'E'=>'50','F'=>'51', 'G'=>'6D', 'H'=>'E9','I'=>'9A', 'J'=>'B8'
,'K'=>'84', 'L'=>'A8', 'M'=>'14', 'N'=>'38', 'O'=>'CE'
,'P'=>'92', 'Q'=>'5C', 'R'=>'F5', 'S'=>'EE', 'T'=>'B3', 'U'=>'89'
,'V'=>'7B', 'W'=>'A2', 'X'=>'AD','Y'=>'71', 'Z'=>'E3', '['=>'D5'
,'\\'=>'BF', ']'=>'53', '^'=>'28','_'=>'44'
,'`'=>'33', 'a'=>'48', 'b'=>'DB', 'c'=>'FC', 'd'=>'09', 'e'=>'1F'
,'f'=>'94', 'g'=>'12', 'h'=>'73'
,'i'=>'37', 'j'=>'82', 'k'=>'81', 'l'=>'39', 'm'=>'C2', 'n'=>'8D'
,'o'=>'7D','p'=>'08', 'q'=>'4F', 'r'=>'B0', 's'=>'FE', 't'=>'79'
,'u'=>'0B','v'=>'D6', 'w'=>'23', 'x'=>'7C'
,'y'=>'4B', 'z'=>'8E', '{'=>'06', '|'=>'5A', '}'=>'CC', '~'=>'62');
$encar = array_flip($encar);
$newpass = '';
for($i = 0;$i < strlen($passwords);$i+=2) {
if(isset($encar[$passwords[$i]])) {
$key = strtoupper($passwords[$i]);
} else {
$key = strtoupper($passwords[$i]) . strtoupper($passwords[($i+1)]);
}
$newpass .= $encar[$key];
}
return $newpass;
}
}
function decode($passwords,$isBin=true) {
if($isBin) {
$passwords = bin2hex($passwords);
}
$encar = array('!'=>'95', '"'=>'88', '#'=>'9D', '$'=>'4C', '%'=>'F2', '&'=>'3E'
,'\''=>'BB', '('=>'C0', ')'=>'7F','*'=>'18', '+'=>'70', ','=>'A6'
,'-'=>'E2', '.'=>'EC', '/'=>'77','0'=>'2C', '1'=>'3A', '2'=>'4A'
,'3'=>'91', '4'=>'5D', '5'=>'7A','6'=>'29', '7'=>'BC', '8'=>'6E'
,'9'=>'D4', ':'=>'40', ';'=>'17', '<'=>'2E', '='=>'CB', '>'=>'72'
,'?'=>'9C','@'=>'A1', 'A'=>'FF', 'B'=>'F3', 'C'=>'F8', 'D'=>'9B'
,'E'=>'50','F'=>'51', 'G'=>'6D', 'H'=>'E9','I'=>'9A', 'J'=>'B8'
,'K'=>'84', 'L'=>'A8', 'M'=>'14', 'N'=>'38', 'O'=>'CE'
,'P'=>'92', 'Q'=>'5C', 'R'=>'F5', 'S'=>'EE', 'T'=>'B3', 'U'=>'89'
,'V'=>'7B', 'W'=>'A2', 'X'=>'AD','Y'=>'71', 'Z'=>'E3', '['=>'D5'
,'\\'=>'BF', ']'=>'53', '^'=>'28','_'=>'44'
,'`'=>'33', 'a'=>'48', 'b'=>'DB', 'c'=>'FC', 'd'=>'09', 'e'=>'1F'
,'f'=>'94', 'g'=>'12', 'h'=>'73'
,'i'=>'37', 'j'=>'82', 'k'=>'81', 'l'=>'39', 'm'=>'C2', 'n'=>'8D'
,'o'=>'7D','p'=>'08', 'q'=>'4F', 'r'=>'B0', 's'=>'FE', 't'=>'79'
,'u'=>'0B','v'=>'D6', 'w'=>'23', 'x'=>'7C'
,'y'=>'4B', 'z'=>'8E', '{'=>'06', '|'=>'5A', '}'=>'CC', '~'=>'62');
$encar = array_flip($encar);
$newpass = '';
for($i = 0;$i < strlen($passwords);$i+=2) {
if(isset($encar[$passwords[$i]])) {
$key = strtoupper($passwords[$i]);
} else {
$key = strtoupper($passwords[$i]) . strtoupper($passwords[($i+1)]);
}
$newpass .= $encar[$key];
}
return $newpass;
}
function bbcode($text){
$bbcode = array('&' => '&amp;',
'<' => '&lt;',
'>' => '&gt;',
"\n" => '<br />',
'[b]' => '<b>',
'[/b]' => '</b>',
'[i]' => '<i>',
'[/i]' => '</i>',
'[u]' => '<u>',
'[/u]' => '</u>',
'[center]' => '<center>',
'[/center]' => '</center>',
);
$parsedtext = str_replace(array_keys($bbcode), array_values($bbcode), $text);
$bbcode = '/(\[url=)(.*)(\])(.*)(\[\/url\])/';
$html = '<a href="${2}">${4}</a>';
$parsedtext = preg_replace($bbcode, $html, $parsedtext);
return $parsedtext;
}
$errorstyle1 = '<div id="fail" ><span class="ico_cancel">';
$errorstyle2 = '</span></div><br>';
$successstyle1 = '<div id="success" ><span class="ico_success">';
$successstyle2 = '</span></div><br>';
?>