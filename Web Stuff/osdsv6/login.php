<?php
session_start();
if (isset($_POST['submitBtn']))
{
	require_once ('engine/class_validate.php');
    $validate = new FormValidator();
	
	$validate->check("sqlserver","req","Please fill in the SQL Server");
	$validate->check("sqlusername","req","Please fill in the SQL Username");
	$validate->check("sqlpassword","req","Please fill in the SQL Password");
	if($validate->ValidateForm() == false)
    {
		$error = $validate->GetErrors();
    }
    else
	{
		$test_connection = @mssql_pconnect($_POST['sqlserver'], $_POST['sqlusername'], $_POST['sqlpassword']);
		if(!$test_connection)
		{
			$error = "<b>Connection test failed!</b> Please check: Server IP, Username, Password";
		}
		else
		{
			$_SESSION['admin_name'] = $_POST['sqlusername'];
			
			$server_ip = @str_replace('.', '_', $_POST['sqlserver']);
			$_SESSION["server"] = $server_ip;
			
			$_SESSION["db_host"] = $_POST['sqlserver'];
			$_SESSION["db_user"] = $_POST['sqlusername'];
			$_SESSION["db_pasw"] = base64_encode($_POST['sqlpassword']);
			
			
			if(!@is_dir("engine/servers/".$server_ip."/"))
			{
				@mkdir("servers/".$server_ip."/", 0777);
				@mkdir("servers/".$server_ip."/".$_POST['sqlusername']."/", 0777);
				
				$default_config_ini =@ file_get_contents('engine/config.ini');
				$file = @fopen("servers/".$server_ip."/".$_POST['sqlusername']."/config.ini", 'w');
				@fwrite($file, $default_config_ini);
				@fclose($file);
				
				$nothing = 'hey hey iam the admin :)';
				$file2 = @fopen("servers/".$server_ip."/".$_POST['sqlusername']."/admin.txt", 'w');
				@fwrite($file2, $nothing);
				@fclose($file2);	
			}
			
			echo '<meta http-equiv="Refresh" content="0; URL=index.php">';
			die();	
		}
	}
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>DAC Login</title>
        <link rel="stylesheet" type="text/css" href="style/login.css" />
    </head>
    <body>
        <div align="center">
            <div class="login" style="margin-top: 100px;">
                <div class="login_title" align="left">Login</div>
                <div class="login_reason" align="left">
                    <?php
                        if (isset($error) && !empty($error))
                        {
                            echo '<p class="msg_error">'.$error.'</p>';
                        }
                    ?>
                    <form action="login.php" method="post" name="loginform" >
                        <table width="100%">                                
                            <tr>
                                <td>SQL Server:</td>
                                <td><input class="text" name="sqlserver" type="text" /></td>
                            </tr>
                            <tr>
                                <td>SQL Username:</td>
                                <td><input class="text" name="sqlusername" type="text" /></td>
                            </tr>
                            <tr>
                                <td>SQL Password:</td>
                                <td><input class="text" name="sqlpassword" type="password" /></td>
                            </tr>
                            <tr>
                                <td colspan="2" align="left">
                                    <br>
                                    <input class="text" type="submit" name="submitBtn" value="Login" />
                                    <span style="float:right;">
                                    	<a href="myip.php" target="_blank">My Ip</a> 
                                        | 
                                    	<a href="agreement.php" target="_blank">Agreement</a> 
                                        | 
                                        <a href="http://www.dkunderground.org/forums/topic/846-login-info/">Info</a>
                                    </span>
                                </td>
                            </tr>
                        </table>
                    </form>  
                </div>
            </div>
        </div>
    </body>
</html>                                                                                                  