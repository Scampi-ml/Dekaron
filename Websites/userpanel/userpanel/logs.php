<?php
session_start();
ob_start();
?>

<body>

<?php
if(isset($_POST['login']))
{
	$admin_passw = 'janvier123';  
	
	if($_POST['password'] == $admin_passw)
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
    	<form id="myForm" class="uniform" method="post" action="logs.php"><button type="submit" name="delete" class="button" style="float:right;" onClick="deleteall()">Delete All Logs</button></form>
        <form class="uniform" name="navigation">
            <select class="medium" name="select1" onChange="location.href=navigation.select1.options[selectedIndex].value" >
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

<form id="form" method="post" class="clearfix" action="logs.php"><input type="hidden" name="login"  /><p><input type="password"  class="full" value="" name="password"/></p><p class="clearfix"><button class="button button-gray fr" type="submit">Login</button></p></form>


<?php
}
?>
    </body>
</html>
