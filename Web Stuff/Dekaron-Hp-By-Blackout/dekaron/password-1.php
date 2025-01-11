<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>amp;Change Password</title>
<style type="text/css">
<!--
body {
	background-color: #000000;
}
.STYLE1 {color: #FF0000}
.STYLE4 {color: #000000}
.STYLE7 {
	font-size: xx-large;
	color: #00FFFF;
}
-->
</style></head>
<body>

<h3 class="STYLE1">

</h3>
<form method="post" action="password.php">
  <p class="STYLE1">
  <?=$errorStr ?>
  <input type="hidden" name="step2" value="1">
  <table align="center" id="frmTable">
    <tr>
      <th height="31" colspan="3"><span class="STYLE7">Dekr0nz0rz's Password Retriever</span></th>
    </tr>
    <tr>
    </tr>
    <tr>
      <td><span class="STYLE1">Account Name:</span></td>
      <td><span class="STYLE1">
        <input type="text" name="username" value="" />
      </span></td>
      <td><span class="STYLE1">Enter your Dekr0nz0rz Game Account Name </span></td>
    </tr>
    <tr>
      <td width="117"><span class="STYLE1">E-Mail:</span></td>
      <td width="175"><span class="STYLE1">
        <input type="text" name="mail" value="" />
      </span></td>
      <td width="275"><span class="STYLE1">Please enter your E-Mail you used to create your account with.</span></td>
    </tr>
    <tr>
      <td><span class="STYLE1">Question:</span></td>
      <td><span class="STYLE1">
        <input type="text" name="question" value="" />
      </span></td>
      <td><span class="STYLE1">Enther your secret question:</span></td>
    </tr>
    <tr>
      <td><span class="STYLE1">Secret Answer:</span></td>
      <td><span class="STYLE1">
        <input type="text" name="answer" value="" />
      </span></td>
      <td><span class="STYLE1">Enter Your Secret Answer</span></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><span class="STYLE1">New Password：</span></td>
      <td><span class="STYLE1">
        <input type="password" name="newpwd1" value="" />
      </span></td>
      <td><span class="STYLE1">New Password (Upper and lower case ENGLISH characters, and numbers, and make it atleast 6-12 characters long, m'kay?</span></td>
    </tr>
    <tr>
      <td><span class="STYLE1">Confirm new password：</span></td>
      <td><span class="STYLE1">
        <input type="password" name="newpwd2" value="" />
      </span></td>
      <td><span class="STYLE1"> Confirm your new password. Write it again.</span></td>
    </tr>
    <tr>
      <td><span class="STYLE1"></span></td>
      <td><span class="STYLE1">
        <input type="submit" name="Submit4" value="Submit new password! Yay! ;D" />
        <span class="STYLE4">5677777777</span>
        <input type="reset" name="Submit2" value="I did something wrong. Clear all data, please!" />
      </span></td>
      <td><span class="STYLE1">&nbsp;</span></td>
    </tr>
  </table>
</form>
</body>
</html>
