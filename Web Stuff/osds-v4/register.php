<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Register</title>
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
        <div id="login" class="box">
            <h2>Register</h2>
            <section>
                <form action="osdsv4core.php?register=register" method="post">
                    <input type="hidden" value="register" name="register" id="register" />
                    <dl>
                        <dt><label>Username</label></dt>
                        <dd><input id="accname" type="text" name="accname" size="40" maxlength="40" /></dd>
                    
                        <dt><label>Password</label></dt>
                        <dd><input id="password" name="password" type="password" size="40" maxlength="40" /></dd>
                        
                        <dt><label>Password Again</label></dt>
                        <dd><input id="password2" name="password2" type="password" size="40" maxlength="40" /></dd>

                        <dt><label>Email</label></dt>
                        <dd><input id="email" type="text" name="email" size="40" maxlength="40" /></dd>
                        
                        <dt><label>Email Again</label></dt>
                        <dd><input id="email2" type="text" name="email2" size="40" maxlength="40" /></dd>
                        
                        <dt><label>Gender</label></dt>
                        <dd><select name="gender">
                          			<option value="na" selected="selected">Iam not saying</option>
                          			<option value="male">Boy</option>
                          			<option value="female">Girl</option>
                        	</select>
                        </dd>

                    </dl>
                    <p>
                        <button type="submit" class="button gray" id="loginbtn" >Register</button>
                    </p>
                </form>
            </section>
        </div>
    </body>
</html>