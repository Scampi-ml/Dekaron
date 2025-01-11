<?php
if(stristr($_SERVER['PHP_SELF'], 'login_template.php')){
exit("<strong>Error: </strong>Can't be opened directly!");
}
;echo '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"><head><title>';echo $Server_Name;;echo ' User Panel</title>
<link media="only screen and (max-device-width: 480px)" href="images/zero-iph.css" type="text/css" rel="stylesheet"/>

      <br><br><br>
<meta name=\'viewport\' content=\'width = device-width, user-scalable = no\'/>

<style type="text/css">
        table {background-position: top center; background-repeat: no-repeat; -moz-border-radius-bottomleft: 20px; -moz-border-radius-bottomright: 20px;}
        table.not-foldable {border: 1px solid black; border-top: none;}
        .topimg {margin: 0 auto; height: 53px; background: url(images/login_to.png) no-repeat top; width: 500px;}
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
  



<!-- no core stylesheet -->
</head>

<body class=\'centre\' style=\'margin-top: 15px; text-align: centre; background: #444444; font-family: Tahoma,Verdana,Arial, Sans-serif; font-size: 9pt; color: #D0D0D0;\'>

<div class="topimg"></div>

<div align="center" id=\'effective-body\' class="normal-tables">
<table class=\'not-foldable\' background="images/login_pa.png" width=467 height=350><tr><td style=\'text-align: center\'>
<h1 style=\'font-size: 130%; height: 1px;\'>&nbsp;</h1>
 <br> <br>
<form action="" method="post">
 <link rel="stylesheet" type="text/css" href="images/blue0000.css"  />
			
';
echo @$error['error'];
;echo '
							

<table>
<tbody>
<tr>
<th style="width: 25%; text-align: right;">Username</th>
                
<td>  <input type="text" name="usernames" maxlength="20" id="main"  value="" size="30" /></td>
</tr>
<tr>
<th style=\'text-align: right;\'>Password</th>
<td>                  <input type="password" name="passwords" maxlength="20" id="main"   value="" size="30" /></td>
</tr>

<tr>
  <th colspan=\'2\' style="height: 41px">
    <br><a href=\'../forget_password\'>» Forget Password?</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;


  	<p>&nbsp;</p>
    <a href=\'../activate_code\'>» Resend Activation Code</a>&nbsp;&nbsp;&nbsp;
	  	<p>&nbsp;</p>
    <a href=\'../register\'>» Create An Account</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;


  </th>
</tr>
</tbody>
</table>

<!-- CAPTCHA loaded -->

<input style=\'margin-top: 1.5em\' type="submit" name="SubmitLoginAcc" value="Login"/>

     




</form>

</center>
</div>

</td></tr></tr></table>
</div>

</div>


        
      

 
						';?>