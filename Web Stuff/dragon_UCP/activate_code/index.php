<?php

require_once ('../includes/config.php');
define('UI_ERROR','%s');
if(strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
$emaill = preg_replace ('[^A-Za-z0-9]', '', $_POST['email']);
$emaill = str_replace($idk, '', $emaill);
$error = array();
if (@preg_match('/[^a-zA-Z0-9\_\-\.\@]/', $_POST['email'])) {
$error['error'] = sprintf(UI_ERROR,'<div class="msg msg-error"><p><strong>&nbsp;&nbsp;&nbsp;&nbsp;
								ERROR : </strong> Email Adress is not valid.</p></div>');
}
else
if (strlen($emaill) == 0){
$error['error'] = sprintf(UI_ERROR, '<div class="msg msg-error"><p><strong>&nbsp;&nbsp;&nbsp;&nbsp;
								ERROR</strong> Dont left E-mail Address empty</p></div>');
}
else if($_POST['email'] != $emaill){
$error['error'] = sprintf(UI_ERROR,'<div class="msg msg-error"><p><strong>&nbsp;&nbsp;&nbsp;&nbsp;
								ERROR  </strong> Email Adress is not valid.</p></div>');
} 
else if (strlen($emaill) < 4){
$error['error'] = sprintf(UI_ERROR, '<div class="msg msg-error"><p><strong>&nbsp;&nbsp;&nbsp;&nbsp;
								ERROR</strong> Email Adress Too short.</p></div>');
} 
else if (strlen($emaill) > 100){
$error['error'] = sprintf(UI_ERROR, '<div class="msg msg-error"><p><strong>&nbsp;&nbsp;&nbsp;&nbsp;
								ERROR</strong> Email Adress Too Long.</p></div>');
} 
else
if (!ereg('@',$emaill) ) {
$error['error'] = sprintf(UI_ERROR,'<div class="msg msg-error"><p><strong>&nbsp;&nbsp;&nbsp;&nbsp;
								ERROR  </strong> Email Adress is not valid.</p></div>');
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
$error['error'] = sprintf(UI_ERROR, '<div class="msg msg-error"><p><strong>&nbsp;&nbsp;&nbsp;&nbsp;
								ERROR</strong> Email Adress not correct.</p></div>');
}else{
if(empty($error)) {
$plist = $db->Execute("SELECT
           Login.[Activation Key],Login.[ID]
       FROM
            [Login]
        WHERE
                 [Email Address] = '".$emaill."'");
$r = $plist->fetchrow();
$active = $r[0];
$id = $r[1];
if(SendactiveEmail($emaill, $active, $id)){};
$error['success'] = sprintf(UI_ERROR,'
 Aactivation Code Sent You Can Find It In Your Inbox or Spam.<br><br><br><div class="msg msg-ok"><p><strong>&nbsp;&nbsp;&nbsp;&nbsp;
							  Aactivation Code Sent Successfully</strong></p></div><br>You will be redirected automatically to the previous page<br><br>
<META HTTP-EQUIV=Refresh CONTENT="3; URL=../userpanel">');
}
}
}	
}	
;echo '

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
 <title>Resend Activation Code</title>
<link media="only screen and (max-device-width: 480px)" href="images/zero-iph.css" type="text/css" rel="stylesheet"/>
   <br><br><br>
      
<meta name=\'viewport\' content=\'width = device-width, user-scalable = no\'/>

<style type="text/css">
        table {background-position: top center; background-repeat: no-repeat; -moz-border-radius-bottomleft: 10px; -moz-border-radius-bottomright: 10px;}
        table.not-foldable {border: 1px solid black; border-top: none;}
        .topimg {margin: 0 auto; height: 53px; background: url(images/login_to1.png) no-repeat top; width: 500px;}
        h1 {padding-top: 55px; letter-spacing: -1px; margin: 0; font-size: 26px !important; clear: both;}
        p {padding: 0 0 15px 0; margin: 0;}
        td input {background: url(images/bg_intpu.png) repeat-x top; border: 1px solid #a7a7a7; margin: 5px 0 5px 10px;}
                td input[type="checkbox"] {border: none; background: none;}
                td input[type="text"], td input[type="password"] {background: url(images/bg_intpu.png) repeat-x top; border: 1px solid #a7a7a7; padding: 10px; font-size: 15px; font-weight: bold; width: 250px; color: #D0D0D0; -moz-border-radius: 5px; -webkit-border-radius: 5px;}
                td input[type="text"]:focus , td input[type="password"]:focus  {border: 1px solid #5596D9;}
                form hr {display: none;}

                input[type="submit"] {background: url(images/btn_logi.png) no-repeat top; width: 208px; height: 46px; border: none; color: #fff; display: block; margin: 0 auto 10px auto; font-weight: bold; font-size: 20px; text-shadow: 1px 1px 1px #777; padding: 0; text-align: center;}
                input[type="submit"]:hover {background: url(images/btn_logi.png) 0 -46px; cursor: pointer;}


  .ftpinfopopup {width: 583px; border: 2px solid #CCC; background: white; padding: 15px; font-family: Arial, Helvetica, sans-serif; overflow: auto;}
  .ftpinfopopup h2 {font-size: 35px; letter-spacing: -1px; margin: 0; padding: 0; color:#666;}
  .ftpinfopopup p {line-height: 1.8em; color: #666; font-size: 12px; margin: 0; margin-top: 1em; padding: 0;}
  .ftpinfopopup img {float: left; border: none;}
  .ftpinfopopup .closebtn {float: right; clear: both; padding: 0;}
  .ftpinfopopup .popright {width: 510px; float: right;}
  input[type="radio"] {border: none !important;}
  table#top-table {background: url("images/login_pa.png") top center no-repeat;}
  a {color: #D0D0D0;}
  a:hover {color: white;}
</style>
  

  <form action="" method="post">

       
<!-- no core stylesheet -->
</head>

<body class=\'centre\' style=\'margin-top: 15px; text-align: centre; background: #444444; font-family: Tahoma,Verdana,Arial, Sans-serif; font-size: 9pt; color: #D0D0D0;\'>

<div class="topimg"></div>

<div align="center" id=\'effective-body\' class="normal-tables">
<table class=\'not-foldable\' background="images/login_pa1.png" width=467 height=280><tr><td style=\'text-align: center\'>
<h1 style=\'font-size: 130%; height: 1px;\'>&nbsp;</h1>
 

 <link rel="stylesheet" type="text/css" href="images/blue0000.css"  />
 
<br><br>
	';echo @$error['success'];;echo '	';echo @$error['error'];;echo '';
if(!@$error['success']){
;echo '								

<form method=\'post\' action="" method="post">
<table>
<tbody>
<tr>
<th style="width: 25%; text-align: right;">Email Adress</th>
<td>
<input name="email"  type="text" size="30"  type="text" value="" maxlength="50"></td>
</tr>


</tbody>
</table>

<!-- CAPTCHA loaded -->

<input style=\'margin-top: 1.5em\' type="submit" name="sub" value="Send"/>
<br />


 <link rel="stylesheet" type="text/css" href="images/blue0000.css"  />

 


</form>
</center>



</td></tr></tr></table>
';
}
;echo '</div>
</div>

</div>


      
      

 
						';
?>