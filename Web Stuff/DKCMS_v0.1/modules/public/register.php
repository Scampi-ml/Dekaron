<center>
<?php

session_start();

$title				=		"reCAPATCHA Dekaron Register by Janvier123";
$registertittle		=		"DKunderground Register Page";
$slogan				=		"Sign up now!";
$server				=		"Dkunderground.org";

$lang_accname		=		"Account Name";
$lang_accpass1		=		"Password";
$lang_accpass2		=		"Password Again";
$lang_email			=		"Your Email";
$lang_button1		=		"Create Account";
$lang_button2		=		"Register";
$lang_name			=		"Real Name";
$lang_lastname		=		"Real Last Name";
$lang_birthday		=		"Your Birthday (DD-MM-YYYY)";
$lang_country		=		"Your Country";
$lang_sex			=		"Your Sex";

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
$lang_secret_nr		=		"Your secret number:";
$lang_success_5		=		"<font color='#FF0000'>DO NOT LOOSE THIS INFO, WRITE IS DOWN AND HIDE IT!</font>";


// Get a key from http://recaptcha.net/api/getkey
// WARNING: THIS IS A PUBLIC KEY, ITS HIGHLY RECOMMENDED YOU CHANGE THIS KEY !!!!!!!
$publickey = "6LeiTgoAAAAAAHSR1thygmVf8t_PS7-nJQ14yBAq";
$privatekey = "6LeiTgoAAAAAAHIbzkC1ctWjxr9kniZDUaTBvaFW";

$resp = null;
$error = null;

require_once('recaptchalib.php');


if(isset($_SESSION['id'])){
	echo "<meta http-equiv=refresh content='0; url=?dkcms=ucp'>";

}else{
			   if ($_GET['step'] == ""){
			   
		$query = mssql_query("SELECT * FROM dkcms.dbo.dkcms_rules WHERE id = '1'");
		$row = mssql_fetch_row($query);

			   
		echo "		<fieldset>";
		echo "	<legend>";
		echo "		<b>Register</b>";
		echo "	</legend>";
		echo "		<form action='?dkcms=main&page=register&step=2' method='POST'>";
		echo "		<table>";
		echo "		<tr><td>".$row[1]."</td></tr>";
		echo "		<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
		echo "		<tr><td colspan='2' align='center'>";
		echo "		<input type='submit' value='$lang_button2'></td></tr>";
		echo "		</table>";
		echo "		</form>";

		echo " </fieldset>";


			   } else if ($_GET['step'] == "2"){
			   
		echo "		<fieldset>";
		echo "	<legend>";
		echo "		<b>Register</b>";
		echo "	</legend>";
			   
		echo"		<form action='?dkcms=main&page=register&step=3' method='POST'>";
		echo"		<table>";
		echo"		<tr><td>$lang_accname</td><td><input type='text' name='accname' maxlength='12'></td></tr>";
		echo"		<tr><td>$lang_accpass1</td><td><input type='password' name='accpass1' maxlength='12'></td></tr>";
		echo"		<tr><td>$lang_accpass2</td><td><input type='password' name='accpass2' maxlength='12'></td></tr>";
		echo"		<tr><td>$lang_email</td><td><input type='text' name='accmail' maxlength='50'></td></tr>";
        echo"       <tr><td>$lang_name</td><td><input type='text' name='accrname' maxlength='50'></td></tr>";
		echo"		<tr><td>$lang_lastname</td><td><input type='text' name='accrlastname' maxlength='50'></td></tr>";
        echo"       <tr><td>$lang_birthday</td><td><input type='text' name='accbday' maxlength='50'></td></tr>";
		echo"       <tr><td>$lang_country</td><td><input type='text' name='acccountry' maxlength='50'></td></tr>";
		
		echo" 		<tr><td>$lang_sex</td><td>";	
		echo" 			<input type='radio' name='accsex' value='M'> Male";
		echo" 			<input type='radio' name='accsex' value='F'> Female";
		echo" 		</td></tr>";
		echo"		<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
		echo"		<tr><td colspan='2' align='center'>";
			echo recaptcha_get_html($publickey, $error);
		echo"		<input type='submit' value='$lang_button1'></td></tr>";
		echo"		</table>";
		echo"		</form>";
		echo " </fieldset>";
				
				
} else if ($_GET['step'] == "3"){

		if ($_POST["recaptcha_response_field"]) {
				$resp = recaptcha_check_answer ($privatekey,
												$_SERVER["REMOTE_ADDR"],
												$_POST["recaptcha_challenge_field"],
												$_POST["recaptcha_response_field"]);
		
				 if ($resp->is_valid) {
				 				
						$result1 = mssql_query("SELECT * FROM account.dbo.USER_PROFILE WHERE user_id = '".$_POST['accname']."'");
						$result2 = mssql_query("SELECT * FROM account.dbo.Tbl_user WHERE user_id = '".$_POST['accname']."'");
						$result3 = mssql_query("SELECT * FROM account.dbo.Tbl_user WHERE user_mail = '".$_POST['accmail']."'");
				
						$row1 = mssql_num_rows($result1);
						$row2 = mssql_num_rows($result2);
						$row3 = mssql_num_rows($result3);
						
						$a = str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890');
						$secretnr = substr($a,0,9);
						
						$ip = getenv("REMOTE_ADDR"); 
						
						$dk_time=strftime("%y%m%d%H%M%S");
						list($usec1, $sec1) = explode(" ",microtime());
						$dk_user_no=$dk_time.substr($usec1,2,2);


								if(empty($_POST['accname']) || empty($_POST['accpass1']) ||  empty($_POST['accpass2']) || empty($_POST['accname']) || empty($_POST['accmail']) || empty($_POST['accrname']) || empty($_POST['accrlastname']) || empty($_POST['accbday']) || empty($_POST['acccountry']) || empty($_POST['accsex'])) {
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
							
										mssql_query("
										INSERT INTO account.dbo.USER_PROFILE 
										(
									user_no,
									user_id,
									user_pwd,
									resident_no,
									user_type,
									login_flag,
									login_tag,
									ipt_time,
									login_time,
									logout_time,
									user_ip_addr,
									server_id
										) 
										VALUES 
										(
									'$dk_user_no',
									'".$_POST['accname']."',
									'".$accpass."',
									'801011000000',
									'1',
									'0',
									'Y',
									'".$date."',
									null,
									null,
									null,
									'000'
										)");
										
										mssql_query("
										INSERT INTO account.dbo.Tbl_user 
										(
									user_no,
									user_id,
									user_pwd,
									user_mail,
									user_answer,
									user_question,
									loggedin,
									lastlogin,
									birthday,
									banned,
									gm,
									ip,
									style,
									webadmin,
									sitelogged,
									sex,
									name,
									lastname,
									country,
									secretnr
										) 
										VALUES 
										(
									'$dk_user_no',
									'".$_POST['accname']."',
									'".$_POST['accpass1']."',
									'".$_POST['accmail']."',
									'0',
									'0',
									'0',
									'0',
									'".$_POST['accbday']."',
									'0',
									'0',
									'$ip',
									'1',
									'0',
									'0',
									'".$_POST['accsex']."',
									'".$_POST['accrname']."',
									'".$_POST['accrlastname']."',
									'".$_POST['acccountry']."',
									'$secretnr'
										)");
							
										echo "		<fieldset>";
										echo "	<legend>";
										echo "		<b>Register</b>";
										echo "	</legend>";
	   
										echo "<center><b>$lang_success_1</b></center><br><br>";
										echo "<center>$lang_success_2</center>";
										echo "<center>$lang_success_3 <b>".$_POST['accname']."</b></center>";
										echo "<center>$lang_success_4 <b>".$_POST['accpass1']."</b></center>";
										echo "<center>$lang_secret_nr <b>$secretnr</b></center>";
										echo "<center>$lang_success_5</center>";
										echo " </fieldset>";
								}
								
        			} else {
               	 		$error = $resp->error;
       }
	}
  }
}

?>
</center>