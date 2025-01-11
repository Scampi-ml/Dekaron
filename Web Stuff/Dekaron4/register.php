	    <div style='padding: 20px 20px 20px 20px; text-align: justify;'>
<span style='color: red;'>*</span> Please protect your account and the registered email, do not share your accounts information with anyone.<br>
<span style='color: red;'>*</span> If you forget your password , please write down your account name, registered email and then email:<br>
<br>
<div id='quote'>
<b>Rocker820</b><br>
Contact: <a href='mailto:rocker@vitalitygaming.info'>rocker@vitalitygaming.info</a><br>
<br>
<b>Darksmasher820</b><br>
Contact: <a href='mailto:darksmasher@vitalitygaming.info'>darksmasher@vitalitygaming.info</a><br>
<br>
<b>Raven</b><br>
Contact: <a href='mailto:raven@vitalitygaming.info'>raven@vitalitygaming.info</a><br>
</div>
<br>
<div id='quote'>
Please enter your details below. Fields marked <span style='color: red;'>*</span> must be completed. Your user name and password is case-sensitive.<br>
</div>
<br>
<?php
$title			=		"reCAPATCHA Dekaron Register by Janvier123";
$registertittle		=		"Vitality Gaming Register Page";
$slogan			=		"Sign up now!";
$server			=		"VitalityGaming.info.org";

$lang_accname		=		"Account Name";
$lang_accpass1		=		"Password";
$lang_accpass2		=		"Password Again";
$lang_email		=		"Your Email";
$lang_button1		=		"Create Account";

$lang_goback		=		"Please go back";

$lang_error_1		=		"You didnt fill in all fields.";
$lang_error_2		=		"This Account name already exists.";
$lang_error_3		=		"This E-Mail is already in use.";
$lang_error_4		=		"The passwords did not match.";
$lang_error_5		=		"Account name and password are the same.";
$lang_error_6		=		"Enter a account name only with 0-9 , a-z and A-Z.";
$lang_error_7		=		"Enter a password only with 0-9 , a-z and A-Z.";
$lang_error_8		=		"Your e-Mail is not correct.";
$lang_error_9		=		"The Accountname must at least 3 indications long and may maximally 15 indications long.";
$lang_error_10		=		"The Password must at least 3 indications long and may maximally 15 indications long.";

$lang_success_1		=		"The account was successfully created. Have fun !";
$lang_success_2		=		"Here is your login info again:";
$lang_success_3		=		"Your account name is:";
$lang_success_4		=		"Your password is:";
$lang_success_5		=		"DO NOT LOOSE THIS INFO, YOU MAY WRITE IS DOWN AND HIDE IT!";

$mssql = array(
			'host' => "YOURHOST",
			'user' => "YOURUSERNAME",
			'pass' => "YOURPASSWORD"
				);

// Get a key from http://recaptcha.net/api/getkey
// WARNING: THIS IS A PUBLIC KEY, ITS HIGHLY RECOMMENDED YOU CHANGE THIS KEY !!!!!!!
$publickey = "6LeiTgoAAAAAAHSR1thygmVf8t_PS7-nJQ14yBAq";
$privatekey = "6LeiTgoAAAAAAHIbzkC1ctWjxr9kniZDUaTBvaFW";

$resp = null;
$error = null;

require_once('recaptchalib.php');

?>
			<dl>
				
<?php
			   
			   if ($_GET['step'] == ""){
			   
				echo "<form action='".$_SEVER['PHP_SELF']."?step=2' method='POST'>";
				echo "<center><table>";
				echo "<tr><td>$lang_accname <span style='color: red;'>*</span></td><td><input type='text' name='accname' maxlength='12'></td></tr>";
				echo "<tr><td>$lang_accpass1 <span style='color: red;'>*</span></td><td><input type='password' name='accpass1' maxlength='12'></td></tr>";
				echo "<tr><td>$lang_accpass2 <span style='color: red;'>*</span></td><td><input type='password' name='accpass2' maxlength='12'></td></tr>";
				echo "<tr><td>$lang_email <span style='color: red;'>*</span></td><td><input type='text' name='accmail' maxlength='50'></td></tr>";
				echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
				echo "<tr><td colspan='2' align='center'>";
				echo recaptcha_get_html($publickey, $error);
				echo "<br><input type='submit' value='$lang_button1'></td></tr>";
				echo "</table></center>";
				echo "</form>";

} else if ($_GET['step'] == "2"){

		if ($_POST["recaptcha_response_field"]) {
				$resp = recaptcha_check_answer ($privatekey,
												$_SERVER["REMOTE_ADDR"],
												$_POST["recaptcha_challenge_field"],
												$_POST["recaptcha_response_field"]);
		
				 if ($resp->is_valid) {
				 
						$con = mssql_connect($mssql['host'],$mssql['user'],$mssql['pass']);
				
						$result1 = mssql_query("SELECT * FROM account.dbo.USER_PROFILE WHERE user_id = '".$_POST['accname']."'",$con);
						$result2 = mssql_query("SELECT * FROM account.dbo.Tbl_user WHERE user_id = '".$_POST['accname']."'",$con);
						$result3 = mssql_query("SELECT * FROM account.dbo.Tbl_user WHERE user_mail = '".$_POST['accmail']."'",$con);
				
						$row1 = mssql_num_rows($result1);
						$row2 = mssql_num_rows($result2);
						$row3 = mssql_num_rows($result3);
						
						$dk_time=strftime("%y%m%d%H%M%S");
						list($usec1, $sec1) = explode(" ",microtime());
						$dk_user_no=$dk_time.substr($usec1,2,2);


								if(empty($_POST['accname']) || empty($_POST['accpass1']) || empty($_POST['accpass2'])|| empty($_POST['accname']) || empty($_POST['accmail'])) {
									echo "<br>$lang_error_1<a href='javascript:history.back()'>$lang_goback</a>";
								} elseif($row1 > '0' || $row2 > '0') {
									echo "<br>$lang_error_2<a href='javascript:history.back()'>$lang_goback</a>";
								} elseif($row3 > '0') {
									echo "<br>$lang_error_3<a href='javascript:history.back()'>$lang_goback</a>";
								} elseif($_POST['accpass1'] != $_POST['accpass2']) {
									echo "<br>$lang_error_4<a href='javascript:history.back()'>$lang_goback</a>";
								} elseif($_POST['accpass1'] == $_POST['accname']) {
									echo "<br>$lang_error_5<a href='javascript:history.back()'>$lang_goback</a>";
								} elseif(!preg_match("/^[0-9a-zA-Z]{3,15}$/i", $_POST['accname'])) {
									echo "<br>$lang_error_6<a href='javascript:history.back()'>$lang_goback</a>";
								} elseif(!preg_match("/^[0-9a-zA-Z]{3,15}$/i", $_POST['accpass1'])) {
									echo "<br>$lang_error_7<a href='javascript:history.back()'>$lang_goback</a>";
								} elseif(!preg_match("/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/i",$_POST['accmail'])) {
									echo "<br>$lang_error_8<a href='javascript:history.back()'>$lang_goback</a>";
								} elseif(strlen($_POST['accname']) < 3 || strlen($_POST['accname']) > 15) {
									echo "<br>$lang_error_9<a href='javascript:history.back()'>$lang_goback</a>";
								} elseif(strlen($_POST['accpass1']) < 3 || strlen($_POST['accpass1']) > 15) {
									echo "<br>$lang_error_10<a href='javascript:history.back()'>$lang_goback</a>";
								} else { 

										$accpass = md5($_POST['accpass1']);
							
										mssql_query("INSERT INTO account.dbo.USER_PROFILE (user_no,user_id,user_pwd,resident_no,user_type,login_flag,login_tag,ipt_time,login_time,logout_time,user_ip_addr,server_id) VALUES ('$dk_user_no','".$_POST['accname']."','".$accpass."','801011000000','1','0','Y','".$date."',null,null,null,'000')",$con);
										mssql_query("INSERT INTO account.dbo.Tbl_user (user_no,user_id,user_pwd,user_mail,user_answer,user_question) VALUES ('$dk_user_no','".$_POST['accname']."','".$_POST['accpass1']."','".$_POST['accmail']."','0','0')",$con);
							
										echo "<center><b>$lang_success_1</b></center><br><br>";
										echo "<center>$lang_success_2</center>";
										echo "<center>$lang_success_3 <b>".$_POST['accname']."</b></center>";
										echo "<center>$lang_success_4 <b>".$_POST['accpass1']."</b></center>";
										echo "<center>$lang_success_5</center>";
								}
								
        			} else {
               	 		$error = $resp->error;
						
        }
		
	}
	
}

?>
			</dl>
	    </div>