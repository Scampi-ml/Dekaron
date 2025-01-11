<?php

error_reporting(0);
ini_set("display_error", false); 

$file = 'register';
include("config/lang.conf.php");
if(file_exists("config/language/".$controlpanel_language."/script/".$file.".php")) {
	include("config/language/".$controlpanel_language."/script/".$file.".php");
} else {
	include("config/language/english/script/".$file.".php");
}

include("config/mssql.conf.php");

echo "<center>";

if($_POST['activ'] == '1') {
	
		$con = mssql_connect($mssql['host'],$mssql['user'],$mssql['pass']) or die($language['mssql_e1']);

		$result1 = mssql_query("SELECT * FROM account.dbo.USER_PROFILE WHERE user_id = '".$_POST['accname']."'",$con);
		$result2 = mssql_query("SELECT * FROM account.dbo.Tbl_user WHERE user_id = '".$_POST['accname']."'",$con);
		$result3 = mssql_query("SELECT * FROM account.dbo.Tbl_user WHERE user_mail = '".$_POST['accmail']."'",$con);

		$row1 = mssql_num_rows($result1);
		$row2 = mssql_num_rows($result2);
		$row3 = mssql_num_rows($result3);

		if(empty($_POST['accname']) || empty($_POST['accpass1']) || empty($_POST['accpass2']) || empty($_POST['accquest']) || empty($_POST['accname']) || empty($_POST['accansw']) || empty($_POST['accmail']) || empty($_POST['result1'])) {
			echo "<br>".$language['error1']."<a href='javascript:history.back()'>".$language['back']."</a>";
		} elseif($row1 > '0' || $row2 > '0') {
			echo "<br>".$language['error2']."<a href='javascript:history.back()'>".$language['back']."</a>";
		} elseif($row3 > '0') {
			echo "<br>".$language['error3']."<a href='javascript:history.back()'>".$language['back']."</a>";
		} elseif($_POST['accpass1'] != $_POST['accpass2']) {
			echo "<br>".$language['error4']."<a href='javascript:history.back()'>".$language['back']."</a>";
		} elseif($_POST['accpass1'] == $_POST['accname']) {
			echo "<br>".$language['error5']."<a href='javascript:history.back()'>".$language['back']."</a>";
		} elseif(!preg_match("/^[0-9a-zA-Z]{6,12}$/i", $_POST['accname'])) {
			echo "<br>".$language['error6']."<a href='javascript:history.back()'>".$language['back']."</a>";
		} elseif(!preg_match("/^[0-9a-zA-Z]{6,12}$/i", $_POST['accpass1'])) {
			echo "<br>".$language['error7']."<a href='javascript:history.back()'>".$language['back']."</a>";
		} elseif(!preg_match("/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/i",$_POST['accmail'])) {
			echo "<br>".$language['error8']."<a href='javascript:history.back()'>".$language['back']."</a>";
		} elseif(strlen($_POST['accname']) < 6 || strlen($_POST['accname']) > 12) {
			echo "<br>".$language['error9']."<a href='javascript:history.back()'>".$language['back']."</a>";
		} elseif(strlen($_POST['accpass1']) < 6 || strlen($_POST['accpass1']) > 12) {
			echo "<br>".$language['error10']."<a href='javascript:history.back()'>".$language['back']."</a>";
		} elseif(strlen($_POST['accquest']) < 10 || strlen($_POST['accquest']) > 20) {
			echo "<br>".$language['error11']."<a href='javascript:history.back()'>".$language['back']."</a>";
		} elseif(strlen($_POST['accansw']) < 10 || strlen($_POST['accansw']) > 20) {
			echo "<br>".$language['error12']."<a href='javascript:history.back()'>".$language['back']."</a>";
		} elseif($_POST['result1'] != $_POST['result2']) {
			echo "<br>".$language['error13']."<a href='javascript:history.back()'>".$language['back']."</a>";
		} else {

			$accpass = md5($_POST['accpass1']);

			mssql_query("INSERT INTO account.dbo.USER_PROFILE (user_id,user_pwd,resident_no,user_type,login_flag,login_tag,ipt_time,login_time,logout_time,user_ip_addr,server_id) VALUES ('".$_POST['accname']."','".$accpass."','801011000000','1','0','Y','".$date."',null,null,null,'000')",$con);
			mssql_query("INSERT INTO account.dbo.Tbl_user (user_id,user_pwd,user_mail,user_answer,user_question) VALUES ('".$_POST['accname']."','".$_POST['accpass1']."','".$_POST['accmail']."','".$_POST['accquest']."','".$_POST['accansw']."')",$con);

			echo "<center><b><u><font color='#00FF00'><span style='background-color: #000000'>".$language['ready1']."</span></font></b></u></center><br><br>";

		}

} else {

	$con = mssql_connect($mssql['host'],$mssql['user'],$mssql['pass']) or die($language['mssql_e1']);
	$result1 = mssql_query("SELECT * FROM account.dbo.USER_PROFILE",$con);
	$row1 = mssql_num_rows($result1);
	
	$count1 = rand(1,49);
	$count2 = rand(1,49);
	$result2 = $count1+$count2;
	echo "<center><b><u>".$language['head1_1']." ".$row1." ".$language['head1_2']."</b></u></center><br>";
	echo "<form action='".$_SEVER['PHP_SELF']."' method='POST'>";
	echo "<center><table>";
	echo "<tr><td colspan='2' align='center'><b><u>".$language['head2']."</u></b></td></tr>";
	echo "<tr><td>".$language['split1']."</td><td><input type='text' name='accname' maxlength='12'></td></tr>";
	echo "<tr><td>".$language['split2']."</td><td><input type='password' name='accpass1' maxlength='12'></td></tr>";
	echo "<tr><td>".$language['split3']."</td><td><input type='password' name='accpass2' maxlength='12'></td></tr>";
	echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
	echo "<tr><td colspan='2' align='center'><b><u>".$language['head3']."</u></b></td></tr>";
	echo "<tr><td>".$language['split4']."</td><td><input type='text' name='accmail' maxlength='50'></td></tr>";
	echo "<tr><td>".$language['split5']."</td><td><input type='text' name='accquest' maxlength='20'></td></tr>";
	echo "<tr><td>".$language['split6']."</td><td><input type='text' name='accansw' maxlength='20'></td></tr>";
	echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
	echo "<tr><td colspan='2' align='center'><b><u>".$language['head4']."</u></b></td></tr>";
	echo "<td align='center'><font color='#FF0000'><b>".$count1."</b></font> + <font color='#FF0000'><b>".$count2."</b></font> =</td>";
	echo "<td><input type='text' name='result1' maxlength='2'></td>";
	echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
	echo "<tr><td colspan='2' align='center'>
		<input type='hidden' name='result2' value='".$result2."'>
		<input type='hidden' name='activ' value='1'>
		<input type='submit' value='".$language['button1']."'></td></tr>";
	echo "</table></center>";
	echo "</form>";

}

echo "</center>";

?>