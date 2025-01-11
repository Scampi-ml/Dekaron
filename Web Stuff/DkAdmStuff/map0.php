<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>用户查询</title>
<style type="text/css">
<!--
.STYLE2 {
	font-size: x-large;
	font-weight: bold;
	color: #FF0000;
}
-->
</style>
</head>

<body>
<div align="center">
  <?php if ( empty( $_POST['btnSubmit'] ) ) { ?>
  <span class="STYLE2">把卡住的人物拖出来</span></div>
<form id="form1" name="form1" method="post" action="">
  <table align="center" id="frmTable">
    <tr>
      <th colspan="2">填写角色名</th>
    </tr>
    <tr>
      <td>角色名：</td>
      <td><input name="Character_name" type="text" id="Character_name" /></td>
    </tr>

    <tr>
      <td valign="top">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input name="btnSubmit" type="submit" id="btnSubmit" value="提交" />
      &nbsp;
      <input type="reset" name="Submit2" value="重置" /></td>
    </tr>
  </table>
</form>
<?php } else {
  if ( empty ( $_POST[Character_name] ) ) { 
    die ( "<p><b>用户名不能为空！</b></p>" );
  }
    	$strSql1="select character_no from character.dbo.user_character where character_name='$_POST[Character_name]'";
    $character_odbc = odbc_connect('account','DBUSER','DBPASS'); 
    $character_result=odbc_do($character_odbc,$strSql1);
    odbc_fetch_row($character_result);
	$character_no=odbc_result($character_result,1);
	if ( $character_no== null) { die ( "<p><b>无此玩家！</b></p>" );} 
  
  
  	$strSql2="update character.dbo.user_character set wPosX=232,wPosY=158,wMapIndex=0 where character_name='$_POST[Character_name]'";
    $character_result=odbc_do($character_odbc,$strSql2);
    odbc_close($character_odbc);

?>
<table width="324" border="1" align="center" cellpadding="3" id="showTable">
        <tr>    <td colspan="2"><div align="center">操作成功</div></td>
  </tr>
      <tr>
    <td colspan="2"><div align="center"><a href="index.html">返回菜单</a></div></td>
  </tr>
</table>
<?php } ?>
</body>
</html>