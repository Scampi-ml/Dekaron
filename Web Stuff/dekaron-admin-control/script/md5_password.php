<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Create MD5 Password</title>
<link rel="stylesheet" type="text/css" href="../style/error.css" />
</head>
    <body>
        <div align="left">
            <div class="maintenance" style="width: 265px; text-align:center;">
            <?php
			if (isset($_POST) && !empty($_POST))
			{	
				echo "<h3>MD5 password</h3><br><input type='text' size='35' value='".md5($_POST['md5'])."'><br><br>Copy and paste this in the edit account form<br><br>";
			}
			else
			{
			?>
            	<form action="" method="post">
                <br>
                	<b>Enter new password</b>
                    <br>
                    <br>
                    <input type="text" size="30" name="md5">
                    <br>
                    <br>
                    <input type="submit" value="Create MD5"> 
                    <br>  
                    <br>                 
            	</form>
            <?php
			}
			?>
            </div>
        </div>
    </body>
</html>
