<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Account Registration</title>
<style type="text/css">
<!--
body,td,th {
        color: #FFFFFF;
}
body {
        background-color: #000000;
}
.style5 {        FONT-WEIGHT: bold; COLOR: #999999
}
.STYLE13 {FONT-WEIGHT: bold; COLOR: #FFFFFF; }
.STYLE14 {color: #FFFFFF}
.STYLE15 {
        font-size: 30px;
        font-weight: bold;
        color: #990033;
}
-->
</style></head>

<body><center>
<TABLE height=20 cellSpacing=0 cellPadding=0 width=461 border=0 bgcolor="#000000">
<TBODY>
              <TR>
                <TD width=10 rowspan="2" vAlign=top><IMG height=15
                  src="images/type1.gif" width=2></TD>
                <TD><div align="center">
                  <p class="STYLE15">Account registration</p>
                </div></TD>
              </TR>
              <TR>
                <TD><p class="STYLE6">
                  <?=$errorStr ?><br>
</p>
                </TD>
              </TR>
  </TBODY></TABLE>

<table width="778" height="330"
                                border="0" cellpadding="0" cellspacing="0" bgcolor="#000000">
  <form method="post" action="register.php">
    <input type="hidden" name="step2" value="1" />
    <center>
      <tbody>
        <tr>
          <td height="37" class="STYLE13"><div align="left"><span class="STYLE1">Server auswahl:</span></div></td>
          <td class="STYLE13"><p>
            <label>
              <input name="ZoneGroup" type="radio" value="zone1" checked="checked" />
              <span class="STYLE1"> Dream</span></label>
            <span class="STYLE1">
              <label></label>
              <br />
              <label></label>
            </span></p></td>
        </tr>
        <tr height="40">
          <td width="130" class="style5 STYLE14">&nbsp;&nbsp;
              <div align="left">Accountname </div></td>
          <td width="210"><div align="left">
            <input name="username" type="text" value="" />
          </div></td>
          <td width="438" class="STYLE13"><div align="left">Nur Buchstaben und Zahlen sind erlaubt!. Die L&auml;nge muss zwischen 3 und 15 Zeichen lang sein </div></td>
        </tr>
        <tr>
          <td height="40" class="STYLE13">&nbsp;&nbsp;
              <div align="left">Password</div></td>
          <td height="40"><div align="left">
            <input name="password1" type="password" value="" />
          </div></td>
          <td height="40" class="STYLE13"><div align="left">Nur Buchstaben und Zahlen sind erlaubt!. Die L&auml;nge muss zwischen 3 und 15 Zeichen lang sein</div></td>
        </tr>
        <tr>
          <td height="40" class="STYLE13">&nbsp;&nbsp;
              <div align="left">Password Wd.</div></td>
          <td height="40"><div align="left">
            <input name="password2" type="password" value="" />
          </div></td>
          <td height="40" class="STYLE13"><div align="left">Wiederholen Sie das oben eingegebene Passwort.</div></td>
        </tr>
        <tr>
          <td height="40" class="STYLE13">&nbsp;&nbsp;
              <div align="left">Geheimfrage</div></td>
          <td height="40"><div align="left">
            <input name="question" type="text" value="" />
          </div></td>
          <td height="40" class="STYLE13"><div align="left">Frage muss zwischen 5 und 20 Zeichen lang sein.</div></td>
        </tr>
        <tr>
          <td height="40" class="STYLE13">&nbsp;&nbsp;
              <div align="left">Geheim antwort</div></td>
          <td height="40"><div align="left">
            <input name="answer" type="text" value="" />
          </div></td>
          <td height="40" class="STYLE13"><div align="left">Antwort muss zwischen 5 und 20 Zeichen lang sein.</div></td>
        </tr>
        <tr>
          <td height="40" class="STYLE13">&nbsp;&nbsp;
              <div align="left">E-mail</div></td>
          <td height="40"><div align="left">
            <input name="mail" type="text" value="" />
          </div></td>
          <td height="40" class="STYLE13"><div align="left">Bitte geben sie ihre richtige E-mail adresse ein.</div></td>
        </tr>
        <tr>
          <td><div align="left"></div></td>
          <td colspan="2" class="STYLE13"><div align="left">&nbsp;</div></td>
        </tr>
        <tr>
        <tr>
          <td><div align="left"></div></td>
          <td colspan="2" class="STYLE13"><div align="left">Bitte beachten Sie Ihre geheime Frage und geheime Antwort! Sie sind wichtig,damit sie Ihr Passwort &auml;ndern k&ouml;nnen! </div></td>
        </tr>
        <tr>
          <td><div align="left"></div></td>
          <td colspan="2" class="STYLE13"><div align="left">&nbsp;</div></td>
        </tr>
        <tr>
          <td colspan="3" height="10"><div align="left">
            <center>
              <input name="submit" type="submit"  value="Create Account" />
            </center>
          </div></td>
        </tr>
      </tbody>
    </center>
  </form>
</table>
</center>
</body>
</html>