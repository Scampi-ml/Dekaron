<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>�û���ѯ</title>
</head>

<body>
<?php if ( empty( $_POST['btnSubmit'] ) ) { ?>
<form id="form1" name="form1" method="post" action="">
  <table align="center" id="frmTable">
    <tr>
      <th colspan="2">��д��ɫ��</th>
    </tr>
    <tr>
      <td>��ɫ����</td>
      <td><input name="txtUserName" type="text" id="txtUserName" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td valign="top">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input name="btnSubmit" type="submit" id="btnSubmit" value="�ύ" />
      &nbsp;
      <input type="reset" name="Submit2" value="����" /></td>
    </tr>
  </table>
</form>
<?php } else {
  if ( empty ( $_POST['txtUserName'] ) ) { 
    die ( "<p><b>�û�������Ϊ�գ�</b></p>" );
  }
  $tiaojian='%'.$_POST['txtUserName'].'%';
   echo $tiaojian;
  	$strSql1="select character_name from character.dbo.user_character where character_name like '$tiaojian'";

    $character_odbc = odbc_connect('account','DBUSER','DBPASS'); 
    $character_result=odbc_do($character_odbc,$strSql1);
	$character_name=odbc_result($character_result,1);
//   if ( $character_name== null) { 
//   die ( "<p><b>�޴���ң�</b></p>" );
//  } 
		echo $character_name; 
		echo '</td></tr>';
?>

</table>
<?php } ?>
</body>
</html>
