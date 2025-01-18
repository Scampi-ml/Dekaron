<?php
include "header.php";   

// -----------------------------------
// Get the settings
// ----------------------------------- 
$mssql_settings_log_clear = $Config->get( 'mssql_settings_log_clear', 'GENERAL');
$del_logs = $Config->get( 'del_logs', 'GENERAL');


// -----------------------------------
// Add "Clear" Button
// -----------------------------------
if ($mssql_settings_log_clear ==  'true')
{
	if (isset($_POST['clear']))
	{
		$file = $_GET['log'];
		if($file)
		{
			$fp = fopen($file, 'w');
			$nothing = "";
			fwrite($fp, $nothing);
			fclose($fp);
			echo '<div class="success msg">Successfully cleared log "<b>' . $file . '</b>"</div>';
		} else {
			echo '<div class="error msg">I dont have a file, so i dont know what to clear</div>';
		}
	}

	$clear_form_button =  '<form id="myForm" class="uniform" method="post"><button type="submit" name="clear" class="button small red" style="float:right;">Clear Log</button></form>';
		
} else {
	
	// Button is not active, but we still need a variable
	$clear_form_button = "";
}

// -----------------------------------
// Add "Delete" Button
// -----------------------------------
if ($del_logs ==  'true')
{
	if (isset($_POST['delete']))
	{
		foreach(glob('logs/*.*') as $v)
		{
			// delete all files, except index.html
			if($v == 'index.html')
			{
				continue;
			}
			unlink($v);
		}
	}
	$del_form_button =  '<form id="myForm" class="uniform" method="post"><button type="submit" name="delete" class="button small red" style="float:right;" onClick="deleteall()">Delete All Logs</button></form>';

} else {
	// Button is not active, but we still need a variable
	$del_form_button =  '';
}

// -----------------------------------
// Start HTML
// -----------------------------------

echo '
<article>
	<h1>View Logs</h1>';
	
		// display the clear button
		echo $clear_form_button;
		echo $del_form_button;

	echo '
		<form class="uniform" name="navigation">
			<select class="medium" name="select1" onchange="location.href=navigation.select1.options[selectedIndex].value" >
				<option value="view_log.php">Please select a file</option>';
					
				// becuz the the logs are made once a day, we need to ask what file they want to view
				foreach (glob("logs/*.log") as $filename)
				{
					 echo '<option value="view_log.php?log=' . $filename .'">' . $filename .' ( ' . format_bytes(filesize($filename)) .' )</option>';
				}

			echo '
			</select>
		</form>
		<hr>';

		// we need a file do display
		$file = @$_GET['log'];
		if($file)
		{		
			$lines = file($file);
			if ($lines) //If it can be opened
			{
				foreach ($lines as $line_num => $line) {
					echo htmlspecialchars($line) . "<br />\n";
				}
			} 
			else 
			{
				echo '<br><div class="error msg">Log is empty</div>';
			}
		} 

echo '</article>';
			
include "footer.php";

?>