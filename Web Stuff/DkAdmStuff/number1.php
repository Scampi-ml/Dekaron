<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>��������</title>
</head>
<?php 

//04
$online="select count(*) from account.dbo.user_profile where login_flag > 0";

//moon
$dk_charactermoon_odbc = odbc_connect('account','DBUSER','DBPASS'); 
$dk_charactermoon_result=odbc_do($dk_charactermoon_odbc,$online);
odbc_fetch_row($dk_charactermoon_result);
$allnumbermoon=odbc_result($dk_charactermoon_result,1);

odbc_close($dk_charactermoon_odbc); 

$numberall=$allnumbermoon+$allnumber04;
?>
	 
	
<body>
  
Players online: <?php echo $allnumbermoon; ?>�� <br> 
<br><br>
</body>
</html>
