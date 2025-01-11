<?php
if(isset($_POST['update_version']))
{
	$xml = '<?xml version="1.0" encoding="utf-8" ?>';
	$xml .= '<theupdates>';
	foreach(glob('*.zip', GLOB_NOSORT) as $update)   
	{  
		$pieces = explode(".", $update);
		$xml .= '<update>';
		$xml .= '<version>'.$pieces[0].'</version>';
		$xml .= '<file>'.$update.'</file>';
		$xml .= '</update>';
	}  
	$xml .= '</theupdates>';
	
	file_put_contents("Updates.xml", $xml, LOCK_EX);
	file_put_contents("version.txt", $_POST['update_version'], LOCK_EX);
	echo "All done!";
}
?>

<form action="make_update.php" method="post">
version.txt =><input name="update_version" type="text" />
<input name="submit" type="submit" />
</form>