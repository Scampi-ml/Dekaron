<?php
// Load the core
include "osdsv4core.php";
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>OSDS V4 - Login</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/skins/blue.css">
               
        <link rel="stylesheet" type="text/css" href="css/superfish.css">
        <link rel="stylesheet" type="text/css" href="css/uniform.default.css">
        <link rel="stylesheet" type="text/css" href="css/jquery.wysiwyg.css">
        <link rel="stylesheet" type="text/css" href="css/smoothness/jquery-ui-1.8.8.custom.css">
        
        
        <script type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
        <script type="text/javascript" src="js/jquery-ui-1.8.8.custom.min.js"></script>
        <script type="text/javascript" src="js/jquery.validate.min.js"></script>
        <script type="text/javascript" src="js/jquery.uniform.min.js"></script>
        <script type="text/javascript" src="js/jquery.wysiwyg.js"></script>
        <script type="text/javascript" src="js/superfish.js"></script>
        <script type="text/javascript" src="js/custom.js"></script>
    
    </head>
    <body>
    <?php
    // check for online / offline server status
    // => No need to login to a server that is offline, AND this removes the list of error that comes with it
    // => This is easy and makes a clean page with no errors
    $check_server_status_login = $Config->get( 'check_server_status_login', 'GENERAL');
    if($check_server_status_login == 'true')
    {
        if(checkServer() == 0 ) 
        {
            echo '<br><br><center><h1>Its seems the server is offline.<br />You cannot login.</center></h1>';
            die();
        } 
    }
    
    ?>
    
        <div id="login" class="box">
            <h2>Login</h2>
            <section>
                <form action="osdsv4core.php?login=login" method="post">
                    <input type="hidden" value="login" name="login" id="login" />
                    <dl>
                        <dt><label>Username</label></dt>
                        <dd><input id="accname" type="text" name="accname" size="40" maxlength="40" /></dd>
                    
                        <dt><label>Password</label></dt>
                        <dd><input id="accpass" name="accpass" type="password" size="40" maxlength="40" /></dd>
                    </dl>
                    <p>
                        <button type="submit" class="button gray" id="loginbtn" >LOGIN</button>
                    </p>
                </form>
            </section>
        </div>
    </body>
</html>