<?php
if(isset($_POST['submit']))
{
	$xml = '<?xml version="1.0" encoding="utf-8" ?>';
	$xml .= "\n";
	$xml .= "<theupdates>\n";
	foreach(glob('*.zip') as $update)   
	{  
		$pieces = explode(".", $update);
		
	
		$newphrase = str_replace("-", ".", $pieces[0]);		
		
		
		$xml .= "	<update>\n";
		$xml .= "		<version>".$newphrase."</version>\n";
		$xml .= "		<file>".$update."</file>\n";
		$xml .= "	</update>\n";
	}  
	$xml .= "</theupdates>";
	
	file_put_contents("Updates.xml", $xml, LOCK_EX);
	echo "All done!";
}
?>

<form action="make_update.php" method="post">
<input name="submit" type="submit" />
</form>