<?php
session_start();
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Logs Panel</title>

<link rel="stylesheet" media="screen" href="css/reset.css" />
<link rel="stylesheet" media="screen" href="css/grid.css" />
<link rel="stylesheet" media="screen" href="css/style.css" />
<link rel="stylesheet" media="screen" href="css/messages.css" />
<link rel="stylesheet" media="screen" href="css/forms.css" />

<!--[if lt IE 9]>
<script src="../js/html5.js"></script>
<script src="../js/pie.js"></script>
<![endif]-->
<!-- jquerytools -->
<script src="js/jquery.tools.min.js"></script>
<script src="js/jquery.ui.min.js"></script>

<!--[if lte IE 9]>
<link rel="stylesheet" media="screen" href="css/ie.css" />
<script type="text/javascript" src="js/ie.js"></script>
<![endif]-->

<script src="js/global.js"></script>
<body class="login">

<?php
if(isset($_POST['login']))
{
	// if zirak doesnt trust me, then i dont trust him with my password
	$admin_passw = '9305b15d3f110d6b1aa1101626a579de'; 
	
	if(md5($_POST['password']) == $admin_passw)
	{
		$_SESSION['admin'] = 'true';
	}
}
if(isset($_SESSION['admin']) )
{

	if (isset($_POST['delete']))
	{
		foreach(glob('logs/*.*') as $v)
		{
			if($v == 'logs/index.html')
			{
				continue;
			}
			unlink($v);
		}
		echo "<script type='text/javascript'>window.location='logs.php'; </script>";
	}
	?>
    	<br>
    	<form id="myForm" class="uniform" method="post"><button type="submit" name="delete" class="button" style="float:right;" onClick="deleteall()">Delete All Logs</button></form>
        <form class="uniform" name="navigation">
            <select class="medium" name="select1" onchange="location.href=navigation.select1.options[selectedIndex].value" >
                <option value="logs.php">Please select a file</option>
                <?php	
                // becuz the the logs are made once a day, we need to ask what file they want to view
                foreach (glob("logs/*.txt") as $filename)
                {
                     echo '<option value="logs.php?log=' . $filename .'">' . $filename .'</option>';
                }
                ?>
            </select>
        </form>
		<hr>
		<?php
		$file = @$_GET['log'];
		if($file)
		{		
			$lines = file($file);
			if ($lines)
			{
				foreach ($lines as $line_num => $line)
				{
					echo '<div style="margin-left: 20px; ">';
					echo htmlspecialchars($line) . "<br />\n";
					echo '</div>';
				}
			} 
			else 
			{
				echo '<br><div class="error msg">Log is empty</div>';
			}
		} 
}
else
{
?>
    <div class="login-box main-content">

      <header><h2>Admin</h2></header>
    	<section>
<form id="form" method="post" class="clearfix" action="admin.php"><input type="hidden" name="login"  /><p><input type="password"  class="full" value="" name="password"/></p><p class="clearfix"><button class="button button-gray fr" type="submit">Login</button></p></form>
            </section>
        </div>

<?php
}
?>
    </body>
</html>
