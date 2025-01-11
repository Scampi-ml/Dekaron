<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>My Ip</title>
        <link rel="stylesheet" type="text/css" href="style/login.css" />
	</head>
	<body>
	<div align="center">
	  <div class="maintenance" style="margin-top: 40px;">
		<div class="maintenance_title" align="left">My Ip Adress</div>
		<div class="maintenance_reason" align="left">
            <table width="100%" border="0" cellspacing="2" cellpadding="5" align="center">
                <tr>
                  <td height="37" align="center" ><strong >Your IP address is:</strong><br> <p style="font-size:26px"><?php echo $_SERVER['REMOTE_ADDR']; ?></p></td>
                </tr>
            </table>
        </div>
	  </div>
	</div>
	</body>
</html>
