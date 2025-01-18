<?php 
include "header.php";

// -----------------------------------
// Get the version ini
// ----------------------------------- 
$GET_VERSION_INI = $_GET['version'];

// -----------------------------------
// Do we have a version ini ?
// -----------------------------------
if ($GET_VERSION_INI == "")
{
	echo '<div class="error msg">Error getting version. Please try again.</div>';
	include "footer.php";
	die();
}

if (isset($_POST['submit']))
{
	// get the file and write it
	$file_url = $Config->get( 'share_root', 'GENERAL') . "". DIRECTORY_SEPARATOR . "version.ini";

	$new_version_ini = $_POST['version'];
	
	$fp = fopen($file_url, 'w');
	fwrite($fp, $new_version_ini);
	fclose($fp);

	echo '<div class="success msg">
				version.ini has been updated!
				<br>
				Your version is now: <b>' . file_get_contents($file_url) . '</b>
	</div>';
	include "footer.php";
	die();
	
}

// -----------------------------------
// Start HTML
// -----------------------------------
// send a WARNING becuz its needed
// wrong settings can realy fuck up your server!!

echo '
<article>
	<h1>Change Version Ini</h1>
	
	<div class="warning msg">
		WARNING!
		<br>
		This will update your version.ini file, be sure you know what you are doing.
		<br>
		This is made for fast access to re-write version.ini
		<br>
		You can turn this function off in the <a href="settings.php?setting=server_version_block">Server Version Block </a>settings.
	</div>

        <form method="post" class="uniform">
			<dl class="inline">
				<dt><label>Change Version</label></dt>
				<dd><input type="text" name="version" class="medium" value="' . $GET_VERSION_INI . '"></dd>
			</dl>
			<div class="buttons"><button type="submit" name="submit" class="button">Submit</button></div>
        </form>
</article>';

include "footer.php";

?>
