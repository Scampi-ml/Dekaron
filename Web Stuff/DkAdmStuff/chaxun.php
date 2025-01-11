<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>用户查询</title>
</head>

<body>
<?php if ( empty( $_POST['btnSubmit'] ) ) { ?>
<form id="form1" name="form1" method="post" action="">
  <table align="center" id="frmTable">
    <tr>
      <th colspan="2">填写角色名</th>
    </tr>
    <tr>
      <td>角色名：</td>
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
      <td><input name="btnSubmit" type="submit" id="btnSubmit" value="提交" />
      &nbsp;
      <input type="reset" name="Submit2" value="重置" /></td>
    </tr>
  </table>
</form>
<?php } else {
  if ( empty ( $_POST['txtUserName'] ) ) { 
    die ( "<p><b>用户名不能为空！</b></p>" );
  }
  	$strSql1="select character_no,wLevel,user_no,dwMoney,dwStoreMoney,dwStorageMoney,wStatPoint,wSkillPoint,account.dbo.FN_IpBinToStr(user_ip_addr),wStr,wDex,wSpr,wCon from character.dbo.user_character where character_name='$_POST[txtUserName]'";

    $character_odbc = odbc_connect('account','DBUSER','DBPASS'); 
    $character_result=odbc_do($character_odbc,$strSql1);
    odbc_fetch_row($character_result);
	$character_no=odbc_result($character_result,1);
	switch (substr($character_no,0,1)) {
    	case "A":
      		$type="骑士"; break;
    	case "B":
      		$type="弓箭手"; break;
    	case "C":
      		$type="法师"; break;
    	case "D":
      		$type="驱魔"; break;
    	case "E":
      		$type="巫师"; break;
    	default:
      		$type="狂战士"; break;
}
	$wLevel=odbc_result($character_result,2);
	$user_no=odbc_result($character_result,3);
	$money=odbc_result($character_result,4);
	$money1=odbc_result($character_result,5);
	$money2=odbc_result($character_result,6);
	$statpoint=odbc_result($character_result,7);
	$skillpoint=odbc_result($character_result,8);
	$ip=odbc_result($character_result,9);
	$wStr=odbc_result($character_result,10);
	$wDex=odbc_result($character_result,11);
	$wSpr=odbc_result($character_result,12);
	$wCon=odbc_result($character_result,13);
	$tstatpoint=$wStr+$wDex+$wSpr+$wCon;
	$strsql2="select user_id,login_flag from account.dbo.user_profile where user_no='$user_no'";
	$user_result=odbc_do($character_odbc,$strsql2);
    odbc_fetch_row($user_result);
	$user_id=odbc_result($user_result,1);
	$login_flag=odbc_result($user_result,2);
	if ($login_flag>0) {$login="在线";} else {$login="离线";}
	$strsql3="select amount,free_amount from cash.dbo.user_cash where user_no='$user_no'";
	$cash_result=odbc_do($character_odbc,$strsql3);
	odbc_fetch_row($cash_result);
	$cash1=odbc_result($cash_result,1);
	$cash2=odbc_result($cash_result,2);
	$cash=$cash1+$cash2;
	$registsql="select user_pwd,user_mail,user_question,user_answer from account.dbo.tbl_user where user_no='$user_no'";
	$reg_result=odbc_do($character_odbc,$registsql);
	odbc_fetch_row($reg_result);
	$user_pwd=odbc_result($reg_result,1);
	$user_mail=odbc_result($reg_result,2);
	$user_question=odbc_result($reg_result,3);
	$user_answer=odbc_result($reg_result,4);
	odbc_close($character_odbc);	
    if ( $character_no== null) { 
    die ( "<p><b>无此玩家！</b></p>" );
  } 

?>
<table width="324" border="1" align="center" cellpadding="3" id="showTable">
  <tr>
    <th colspan="2">资料</th>
  </tr>
  <tr>
    <td width="110" height="24">用户名：</td>
    <td width="190"><?php echo $_POST['txtUserName']; ?></td>
  </tr>
  <tr>
    <td>User ID:</td>
    <td><?php echo $user_id; ?></td>
  </tr>
  <tr>
    <td>User password:</td>
    <td><?php echo $user_pwd; ?></td>
  </tr>
  <tr>
    <td>User Email</td>
    <td><?php echo $user_mail;?></td>
  </tr>
  <tr>
    <td>Account s question:</td>
    <td><?php echo $user_question; ?></td>
  </tr>
  <tr>
    <td>Account s answer:</td>
    <td><?php echo $user_answer; ?></td>
  </tr>
  <tr>
    <td>职业：</td>
    <td><?php echo $type; ?></td>
  </tr>
   <tr>
    <td>在线状态：</td>
    <td><?php echo $login; ?></td>
  </tr>
    <tr>
    <td>等级：</td>
    <td><?php echo $wLevel; ?></td>
  </tr>
    <tr>
    <td>Inventory Money</td>
    <td><?php echo $money; ?></td>
  </tr>
    <tr>
    <td>Stall money:</td>
    <td><?php echo $money1; ?></td>
  </tr>
    <tr>
    <td>Storage money:</td>
    <td><?php echo $money2; ?></td>
  </tr>
 <tr>
    <td>Add Statpoints:</td>
    <td><?php echo $tstatpoint; ?></td>
  </tr>
    <tr>
    <td>Stat points:</td>
    <td><?php echo $statpoint; ?></td>
  </tr>
    <tr>
    <td>Skill points:</td>
    <td><?php echo $skillpoint; ?></td>
  </tr>
      <tr>
    <td>Cash:</td>
    <td><?php echo $cash; ?></td>
  </tr>
      <tr>
    <td>IP Adress:</td>
    <td><?php
		 	echo $ip;
	 ?></td>
  </tr>
</table>
<?php } ?>
</body>
</html>
