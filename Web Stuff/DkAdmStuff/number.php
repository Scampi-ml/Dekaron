<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>在线人数</title>
</head>
<?php 

//04
$online="select count(*) from account.dbo.user_profile where login_flag > 0";
$dk_character04_odbc = odbc_connect('accountvip','DBUSER','DBPASS'); 
$dk_character04_result=odbc_do($dk_character04_odbc,$online);
odbc_fetch_row($dk_character04_result);
$allnumber04=odbc_result($dk_character04_result,1);
odbc_close($dk_character04_odbc); 
//moon
$dk_charactermoon_odbc = odbc_connect('account','DBUSER','DBPASS'); 
$dk_charactermoon_result=odbc_do($dk_charactermoon_odbc,$online);
odbc_fetch_row($dk_charactermoon_result);
$allnumbermoon=odbc_result($dk_charactermoon_result,1);

odbc_close($dk_charactermoon_odbc); 

$numberall=$allnumbermoon+$allnumber04;
?>
	 
	
<body>
  
总计在线人数为<?php echo $allnumbermoon; ?>个 <br> 
<br><br>
</body>
</html>
